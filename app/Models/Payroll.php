<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'total_present_days',
        'total_salary',
    ];

    // relasi ke model employee
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
