<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define model state.
     */
    public function definition(): array
    {
        return [
            'patient_name' => fake()->name(),
            'clinic_location' => 'Ahmedabad',
            'clinician_id' => 1,
            'appointment_date' => now()->addDays(2),
            'status' => 'pending'
        ];
    }
}