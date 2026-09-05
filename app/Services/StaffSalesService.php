<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\StaffSale;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class StaffSalesService
{
    /**
     * @return array{start: Carbon, end: Carbon, label: string}
     */
    public function financialYearBounds(?Carbon $today = null): array
    {
        $today = $today ? $today->copy() : now();
        $start = $today->copy()->month(4)->day(1)->startOfDay();
        if ((int) $today->format('n') < 4) {
            $start->subYear();
        }
        $end = $start->copy()->addYear()->subDay()->endOfDay();

        return [
            'start' => $start,
            'end' => $end,
            'label' => 'Apr '.$start->format('Y').' - Mar '.$end->format('Y'),
        ];
    }

    /**
     * Monthly sale totals for one employee (or all staff when $employeeId is null).
     *
     * @return list<array{label: string, total: float, trend: ?string}>
     */
    public function salesByMonth(?int $employeeId = null, ?Carbon $today = null): array
    {
        $fy = $this->financialYearBounds($today);
        $query = StaffSale::query()
            ->selectRaw('YEAR(sale_date) as year, MONTH(sale_date) as month, SUM(COALESCE(amount, 0)) as total')
            ->whereBetween('sale_date', [$fy['start']->toDateString(), $fy['end']->toDateString()])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month');

        if ($employeeId !== null) {
            $query->where('employee_id', $employeeId);
        }

        $rows = $query->get()->keyBy(fn ($r) => sprintf('%04d-%02d', $r->year, $r->month));

        $monthNames = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $salesByMonth = [];
        $prevTotal = null;

        for ($i = 0; $i < 12; $i++) {
            $date = $fy['start']->copy()->addMonths($i);
            $key = $date->format('Y-m');
            $row = $rows->get($key);
            $total = (float) ($row->total ?? 0);
            $trend = null;
            if ($prevTotal !== null) {
                $trend = $total >= $prevTotal ? 'up' : 'down';
            }
            $prevTotal = $total;
            $salesByMonth[] = [
                'label' => $monthNames[(int) $date->format('n')].' '.$date->format('Y'),
                'total' => $total,
                'trend' => $trend,
            ];
        }

        return $salesByMonth;
    }

    /**
     * Ranked staff totals for the financial year. Commission is never included.
     *
     * @return Collection<int, object{
     *   employee_id: int,
     *   first_name: string,
     *   last_name: string,
     *   job_title: ?string,
     *   profile_picture: ?string,
     *   total_sales: float,
     *   rank: int
     * }>
     */
    public function leaderboard(?Carbon $today = null): Collection
    {
        $fy = $this->financialYearBounds($today);

        $totals = StaffSale::query()
            ->selectRaw('employee_id, SUM(COALESCE(amount, 0)) as total_sales')
            ->whereBetween('sale_date', [$fy['start']->toDateString(), $fy['end']->toDateString()])
            ->groupBy('employee_id')
            ->pluck('total_sales', 'employee_id');

        $employees = Employee::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $ranked = $employees
            ->map(function (Employee $employee) use ($totals) {
                return (object) [
                    'employee_id' => (int) $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'full_name' => $employee->full_name,
                    'job_title' => $employee->job_title,
                    'profile_picture_url' => $employee->photo_url,
                    'initials' => $employee->initials,
                    'total_sales' => (float) ($totals[$employee->id] ?? 0),
                ];
            })
            ->sortByDesc('total_sales')
            ->values();

        return $ranked->map(function ($row, $index) {
            $row->rank = $index + 1;

            return $row;
        });
    }

    public function employeeFyTotal(int $employeeId, ?Carbon $today = null): float
    {
        $fy = $this->financialYearBounds($today);

        return (float) StaffSale::query()
            ->where('employee_id', $employeeId)
            ->whereBetween('sale_date', [$fy['start']->toDateString(), $fy['end']->toDateString()])
            ->sum('amount');
    }

    public function employeeMonthTotal(int $employeeId, ?Carbon $today = null): float
    {
        $today = $today ? $today->copy() : now();

        return (float) StaffSale::query()
            ->where('employee_id', $employeeId)
            ->whereYear('sale_date', $today->year)
            ->whereMonth('sale_date', $today->month)
            ->sum('amount');
    }

    public function employeeCommissionFyTotal(int $employeeId, ?Carbon $today = null): float
    {
        $fy = $this->financialYearBounds($today);

        return (float) StaffSale::query()
            ->where('employee_id', $employeeId)
            ->whereBetween('sale_date', [$fy['start']->toDateString(), $fy['end']->toDateString()])
            ->sum('commission');
    }
}
