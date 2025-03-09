<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $table = 'scholarships'; // Ensure this matches your database table name
    protected $fillable = [
        'type',
        'name',
        'participating_programmes',
        'eligibility_criteria',
        'scholarship_value',
        'documents_required',
        'application_procedure',
        'application_deadline',
        'terms_conditions',
        'further_info'
    ];
}
