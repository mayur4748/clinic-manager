<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [

        'patient_name',
        'clinic_location',
        'clinician_id',
        'appointment_date',
        'status'
    ];
    public function clinician()
    {
        return $this->belongsTo(User::class, 'clinician_id');
    }

    public function scopeUpcoming($query)
    {
        return $query->whereBetween(

            'appointment_date',

            [now(), now()->addDays(7)]

        );
    }
}