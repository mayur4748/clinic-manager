<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
class AppointmentController extends Controller
{
    /**
     * Appointment listing
     */
    public function index()
    {
        $appointments = Appointment::with('clinician')->latest()->get();

        return view('appointments.index', compact('appointments'));
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