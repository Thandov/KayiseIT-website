<?php

namespace App\Http\Controllers;

use App\Helpers\StaffFolderHelper;
use App\Models\Employee;
use App\Models\JobTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StaffProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $can = $user && (
            $user->hasStaffPermission('profile.own')
            || ($user->isStaffMember() && $user->employee)
        );
        if (! $can) {
            abort(403);
        }

        $employee = $user->employee;
        if (! $employee) {
            return redirect()->route('profile.edit')
                ->with('error', 'No staff profile is linked to this account.');
        }

        $employee->load('assignedTitle.permissionGroups.permissions');
        $jobTitles = JobTitle::active()->orderBy('name')->get();

        return view('admin.dashboard.profile.show', compact('employee', 'jobTitles'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $can = $user && (
            $user->hasStaffPermission('profile.own')
            || ($user->isStaffMember() && $user->employee)
        );
        if (! $can) {
            abort(403);
        }

        $employee = $user->employee;
        if (! $employee) {
            abort(404);
        }

        $validated = $request->validate([
            'phone' => 'required|string|max:255',
            'personal_email' => 'nullable|email|max:255',
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
        ]);

        if ($request->file('profile_picture')) {
            $file = $request->file('profile_picture');
            if (! $file->isValid()) {
                throw ValidationException::withMessages([
                    'profile_picture' => StaffFolderHelper::uploadErrorMessage($file),
                ]);
            }
            StaffFolderHelper::ensureDirectory($employee->first_name, $employee->last_name);
            StaffFolderHelper::deleteStored($employee->profile_picture);
            $validated['profile_picture'] = StaffFolderHelper::storeUpload(
                $file,
                $employee->first_name,
                $employee->last_name
            );
        }

        $employee->update($validated);

        return redirect()
            ->route('dashboard.profile')
            ->with('success', 'Your profile was updated.');
    }
}
