<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index(Request $request) {
        // bulan
        $month = $request->input('month', now()->month);
        // tahun
        $year = $request->input('year', now()->year);

        // tanggal mulai
        $start = Carbon::create($year, $month, 1);
        // tanggal berakhir
        $end = Carbon::create($year, $month, 30);

        // data employee
        $employees = Employee::with('user')->get();

        $payrolls = $employees->map(function($employee) use ($start, $end) {
            $presentDays = Attendance::where('user_id', $employee->user_id)
                            ->whereBetween('created_at', [$start, $end])
                            ->where('status', 'hadir')
                            ->count();

            $totalSalary = ($presentDays / 30) * $employee->gaji_pokok;

            return [
                'name'          => $employee->user->name,
                'email'         => $employee->user->email,
                'jabatan'       => $employee->jabatan,
                'base_salary'   => $employee->gaji_pokok,
                'present_days'  => $presentDays,
                'total_salary'  => $totalSalary
            ];

        });

        // data payroll
        return view('bendahara.payroll.index', compact('payrolls', 'month', 'year'));
    }
}
