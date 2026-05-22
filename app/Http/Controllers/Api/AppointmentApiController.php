<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentApiController extends Controller
{
    /**
     * Appointment list
     */
    public function index()
    {
        return response()->json(

            Appointment::with('clinician')->get()

        );
    }

    /**
     * Store appointment
     */
    public function store(Request $request)
    {
        $appointment = Appointment::create([

            'patient_name' => $request->patient_name,

            'clinic_location' => $request->clinic_location,

            'clinician_id' => $request->clinician_id,

            'appointment_date' => $request->appointment_date,

            'status' => $request->status,

        ]);

        return response()->json($appointment);
    }

    /**
     * Show appointment
     */
    public function show(Appointment $appointment)
    {
        return response()->json($appointment);
    }

    /**
     * Update appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        return response()->json($appointment);
    }

    /**
     * Delete appointment
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json([

            'message' => 'Appointment deleted'

        ]);
    }
}