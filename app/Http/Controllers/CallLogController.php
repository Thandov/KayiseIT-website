<?php

namespace App\Http\Controllers;

use App\Models\CallLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CallLogController extends Controller
{
    /**
     * Show call logs dashboard
     */
    public function index(Request $request): View
    {
        $query = CallLog::query();

        // Filter by status
        if ($request->has('status') && $request->input('status') !== '') {
            $query->where('status', $request->input('status'));
        }

        // Filter by date range
        if ($request->has('from_date') && $request->input('from_date')) {
            $query->where('created_at', '>=', $request->input('from_date'));
        }

        if ($request->has('to_date') && $request->input('to_date')) {
            $query->where('created_at', '<=', $request->input('to_date') . ' 23:59:59');
        }

        // Search by phone number
        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $query->where('from', 'like', "%$search%")->orWhere('to', 'like', "%$search%");
        }

        // Get paginated results
        $callLogs = $query->orderByDesc('created_at')->paginate(25);

        // Calculate statistics
        $stats = [
            'total_calls' => CallLog::count(),
            'calls_today' => CallLog::whereDate('created_at', today())->count(),
            'calls_this_week' => CallLog::lastDays(7)->count(),
            'average_duration' => number_format(CallLog::avg('duration'), 0) . 's',
            'completed_calls' => CallLog::where('status', 'completed')->count(),
            'failed_calls' => CallLog::where('status', 'failed')->count(),
            'transferred_calls' => CallLog::whereNotNull('transferred_to')->count(),
        ];

        return view('admin.call-logs.index', [
            'callLogs' => $callLogs,
            'stats' => $stats,
        ]);
    }

    /**
     * Show single call details
     */
    public function show(CallLog $callLog): View
    {
        return view('admin.call-logs.show', [
            'callLog' => $callLog,
        ]);
    }

    /**
     * Export call logs to CSV
     */
    public function export(Request $request)
    {
        $query = CallLog::query();

        // Apply same filters as index
        if ($request->has('status') && $request->input('status') !== '') {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('from_date') && $request->input('from_date')) {
            $query->where('created_at', '>=', $request->input('from_date'));
        }

        if ($request->has('to_date') && $request->input('to_date')) {
            $query->where('created_at', '<=', $request->input('to_date') . ' 23:59:59');
        }

        $callLogs = $query->orderByDesc('created_at')->get();

        // Create CSV
        $csv = "Call SID,From,To,Status,Duration (sec),Transferred To,Date,Time\n";
        
        foreach ($callLogs as $log) {
            $csv .= sprintf(
                '"%s","%s","%s","%s",%d,"%s","%s","%s"' . "\n",
                $log->call_sid,
                $log->from,
                $log->to,
                $log->status,
                $log->duration,
                $log->transferred_to ?? '-',
                $log->created_at->format('Y-m-d'),
                $log->created_at->format('H:i:s')
            );
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="call_logs_' . now()->format('Y-m-d_His') . '.csv"',
        ]);
    }

    /**
     * Get analytics data (for charts)
     */
    public function analytics(Request $request)
    {
        $days = (int) ($request->input('days', 30));

        // Calls per day
        $callsPerDay = CallLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Calls by status
        $callsByStatus = CallLog::selectRaw('status, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('status')
            ->get();

        // Calls by hour
        $callsByHour = CallLog::selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(1))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        return response()->json([
            'calls_per_day' => $callsPerDay,
            'calls_by_status' => $callsByStatus,
            'calls_by_hour' => $callsByHour,
            'total_calls' => CallLog::where('created_at', '>=', now()->subDays($days))->count(),
            'average_duration' => number_format(CallLog::where('created_at', '>=', now()->subDays($days))->avg('duration'), 0),
        ]);
    }

    /**
     * Delete old call logs
     */
    public function deleteOldLogs(Request $request)
    {
        $days = (int) ($request->input('days', 90));
        $count = CallLog::where('created_at', '<', now()->subDays($days))->delete();

        return response()->json([
            'message' => "$count call logs deleted.",
            'deleted_count' => $count,
        ]);
    }
}
