<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Yajra\DataTables\Facades\DataTables;
class AppointmentController extends Controller
{
    /**
     * Appointment listing
     */
   public function index(Request $request)
    {
        if ($request->ajax()) {
            $appointments = Appointment::with('clinician');
            // Clinician only own appointments
            if(auth()->user()->role != 'admin') {
                $appointments->where( 'clinician_id', auth()->id() );
            }
            // STATUS FILTER
            if($request->status) {
                $appointments->where( 'status', $request->status );
            }
            // CLINIC FILTER
            if($request->clinic_location) {
                $appointments->where( 'clinic_location', $request->clinic_location );
            }
            return DataTables::of($appointments)
                ->addIndexColumn()
                ->addColumn('clinician_name', function ($row) {
                    return $row->clinician->name ?? 'N/A';
                })
                ->editColumn('appointment_date', function ($row) {
                    return date(
                        'd M Y h:i A',
                        strtotime($row->appointment_date)
                    );
                })
                ->addColumn('status_badge', function ($row) {
                    if($row->status == 'booked') {
                        return ' <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">
                                Booked
                            </span> ';
                    }

                    if($row->status == 'completed')
                    {
                        return '
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                Completed
                            </span>
                        ';
                    }

                    return '
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                            Cancelled
                        </span> ';
                })

                ->addColumn('action', function ($row) {
                    $edit = route( 'appointments.edit', $row->id );
                    $delete = route( 'appointments.destroy', $row->id );
                    return ' <a href="'.$edit.'" class="bg-yellow-400 text-black px-3 py-1 rounded mr-2"> Edit </a>
                        <form action="'.$delete.'" method="POST" style="display:inline-block;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button type="submit" onclick="return confirm(`Delete Appointment?`)" class="bg-red-500 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form> ';
                })
                ->rawColumns([
                    'status_badge',
                    'action'
                ])
                ->make(true);
        }
        return view('appointments.index');
    }

    /**
     * Create form
     */
    public function create()
    {
        $clinicians = User::all();

        return view('appointments.create', compact('clinicians'));
    }

    /**
     * Store appointment
     */
    public function store(Request $request)
    {
        Appointment::create([
            'patient_name' => $request->patient_name,
            'clinic_location' => $request->clinic_location,
            'clinician_id' => $request->clinician_id,
            'appointment_date' => $request->appointment_date,
            'status' => $request->status,
        ]);

         ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Create',
            'module' => 'Appointment',
            'description' => 'Created Appointment: ' . $request->patient_name
        ]);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment created successfully');
    }

    /**
     * Edit form
     */
    public function edit(Appointment $appointment)
    {
        $clinicians = User::all();

        return view('appointments.edit', compact(
            'appointment',
            'clinicians'
        ));
    }

    /**
     * Update appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update([
            'patient_name' => $request->patient_name,
            'clinic_location' => $request->clinic_location,
            'clinician_id' => $request->clinician_id,
            'appointment_date' => $request->appointment_date,
            'status' => $request->status,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Update',
            'module' => 'Appointment',
            'description' => 'Updated appointment: ' . $appointment->patient_name
        ]);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment updated successfully');
    }

    /**
     * Delete appointment
     */
    public function destroy(Appointment $appointment)
    {

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Delete',
            'module' => 'Appointment',
            'description' => 'Deleted Appointment: ' . $appointment->patient_name
        ]);

        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment deleted successfully');
    }
}