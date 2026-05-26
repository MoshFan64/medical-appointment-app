<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
        protected $fillable = [
        'user_id',
        'specialty_id',
        'medical_license_number',
        'phone_clinic',
        'biography',
        'is_active'
    ];

    // Relación inversa: Un doctor pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Un doctor tiene una especialidad
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function getLicenseNumberAttribute()
    {
        return $this->medical_license_number;
    }

    public function setLicenseNumberAttribute($value)
    {
        $this->attributes['medical_license_number'] = $value;
    }
}
