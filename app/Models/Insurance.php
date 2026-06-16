<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'company_name',
        'agreement_code',
        'coverage_percentage',
        'notes',
        'is_active',
    ];
}