<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StaffOrganogramController extends Controller
{
    /**
     * Persist organogram assignments (manager + sibling order).
     *
     * Body: { assignments: [{ id, manager_id, sort_order }, ...] }
     */
    public function update(Request $request): JsonResponse
    {
        if (! auth()->user() || ! auth()->user()->isDashboardAdmin()) {
            return response()->json(['success' => false, 'message' => 'Only admins can edit the organogram.'], 403);
        }

        $validated = $request->validate([
            'assignments' => 'required|array|min:1',
            'assignments.*.id' => 'required|integer|exists:employees,id',
            'assignments.*.manager_id' => 'nullable|integer|exists:employees,id',
            'assignments.*.sort_order' => 'required|integer|min:0',
        ]);

        $assignments = $validated['assignments'];
        $ids = collect($assignments)->pluck('id')->map(fn ($id) => (int) $id)->all();

        if (count($ids) !== count(array_unique($ids))) {
            throw ValidationException::withMessages([
                'assignments' => 'Each employee may appear only once in the assignments list.',
            ]);
        }

        $employees = Employee::query()->whereIn('id', $ids)->get()->keyBy('id');

        // Build proposed manager map (merge with unchanged employees for cycle checks)
        $proposedManagers = Employee::query()->pluck('manager_id', 'id')->map(fn ($v) => $v !== null ? (int) $v : null)->all();
        foreach ($assignments as $row) {
            $id = (int) $row['id'];
            $managerId = $row['manager_id'] !== null ? (int) $row['manager_id'] : null;
            if ($managerId === $id) {
                throw ValidationException::withMessages([
                    'assignments' => 'An employee cannot report to themselves.',
                ]);
            }
            $proposedManagers[$id] = $managerId;
        }

        foreach ($assignments as $row) {
            $id = (int) $row['id'];
            $managerId = $row['manager_id'] !== null ? (int) $row['manager_id'] : null;
            if ($managerId !== null && $this->formsCycle($id, $managerId, $proposedManagers)) {
                $employee = $employees->get($id);
                $name = $employee ? trim($employee->first_name.' '.$employee->last_name) : (string) $id;
                throw ValidationException::withMessages([
                    'assignments' => "Cannot assign that manager for {$name}: it would create a reporting cycle.",
                ]);
            }
        }

        DB::transaction(function () use ($assignments, $employees) {
            foreach ($assignments as $row) {
                $employee = $employees->get((int) $row['id']);
                if (! $employee) {
                    continue;
                }
                $employee->manager_id = $row['manager_id'] !== null ? (int) $row['manager_id'] : null;
                $employee->sort_order = (int) $row['sort_order'];
                $employee->save();
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Organogram updated.',
        ]);
    }

    /**
     * @param  array<int, int|null>  $managerMap
     */
    private function formsCycle(int $employeeId, int $managerId, array $managerMap): bool
    {
        $current = $managerId;
        $seen = [];

        while ($current !== null) {
            if ($current === $employeeId) {
                return true;
            }
            if (isset($seen[$current])) {
                return true;
            }
            $seen[$current] = true;
            $current = $managerMap[$current] ?? null;
            if ($current !== null) {
                $current = (int) $current;
            }
        }

        return false;
    }
}
