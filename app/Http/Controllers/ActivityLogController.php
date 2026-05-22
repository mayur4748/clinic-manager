<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
   public function index(Request $request)
    {
        if ($request->ajax()) {

            $logs = ActivityLog::with('user');

            // IF NOT ADMIN
            // SHOW ONLY LOGIN USER LOGS

            if(auth()->user()->role != 'admin')
            {
                $logs->where(
                    'user_id',
                    auth()->id()
                );
            }

            return DataTables::of($logs)

                ->addIndexColumn()

                ->addColumn('user_name', function ($row) {

                    return $row->user->name ?? 'N/A';
                })

                ->editColumn('created_at', function ($row) {

                    return date(
                        'd M Y h:i A',
                        strtotime($row->created_at)
                    );
                })

                ->make(true);
        }

        return view('activity-logs.index');
    }
}