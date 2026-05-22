<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test appointment creation
     */
    public function test_appointment_can_be_created(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/appointments', [
                'patient_name' => 'John Doe',
                'clinic_location' => 'Ahmedabad',
                'clinician_id' => $user->id,
                'appointment_date' => now()->format('Y-m-d H:i:s'),
                'status' => 'pending'
            ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('appointments', [
            'patient_name' => 'John Doe'
        ]);
    }
}