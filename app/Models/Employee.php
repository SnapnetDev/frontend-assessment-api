<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

        use HasFactory;

    protected $fillable = [
        'full_name',
        'name_nok',
        'job_title',
        'image_url',
        'spouse',
        'dob',
        'email',
        'phone_no',
        'phone_no_nok',
        'department',
        'address',
        'location',
        'employment_type',
        'start_date',
        'status',
        'current_salary',
        'manager'
    ];

    /**
     * return string for date
     *
     * @return void
     */
    public function getTenureDetailedAttribute()
    {
        $diff = $this->start_date->diff(now());

        $years = $diff->y;
        $months = $diff->m;

        if ($years > 0 && $months > 0) {
            return "{$years} years, {$months} months";
        } elseif ($years > 0) {
            return "{$years} years";
        } elseif ($months > 0) {
            return "{$months} months";
        } else {
            return "Less than a month";
        }
    }

    protected $casts = [
        'current_salary' => 'integer'
    ];
}
