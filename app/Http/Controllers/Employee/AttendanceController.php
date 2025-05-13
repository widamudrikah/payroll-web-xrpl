<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index() {
        // AMBIL TANGGAL HARI INI DAN USER ID
        // $today = Carbon::now()->toDateString();
        $userId = auth()->id();

        $currentMonth = Carbon::now()->month;
        $attendances = Attendance::where('user_id', $userId)
                        ->whereMonth('created_at', $currentMonth)
                        ->get();
        return view('employee.attendance.index', compact('attendances'));
    }

    // membuat data presensi
    public function store(Request $request) {
        $request->validate([]);

        // mulai menambhakan data baru
        Attendance::create([
            'user_id'   => Auth::id(),
            'status'    => 'Hadir'
        ]);

        return redirect()->route('attendance.index')->with('message', 'Presensi Berhasil');
    }
}
