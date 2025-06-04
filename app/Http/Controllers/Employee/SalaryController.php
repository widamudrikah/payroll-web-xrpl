<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan karyawan yang sedang login
        $user = auth()->user();
        $employee = Employee::where('user_id', $user->id)->first();

        if (!$employee) {
            return back()->with('error', 'Data karyawan tidak ditemukan');
        }

        // input bulan dan tahun
        $month = (int) $request->input('month', now()->month);
        $year = (int) $request->input('year', now()->year);

        // validasi bulan dan tahun, 
        if ($month < 1 || $month > 12 || $year < 2000 || $year > now()->year + 1) {
            return back()->with('error', 'Bulan dan tahun tidak valid');
        }
        // start = awal hari pertaman di bulan tersebut
        // end = akhir hari dari bulan yang ada
        try {
            $start = Carbon::createFromDate($year, $month, 1)->startOfDay();
            $end    = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan saat memproses tanggal');
        }
        // Mengambil jumlah presensi dengan status hadir milik user dengan rentang
        //  waktu yang telah ditentukan oleh variabel start dan end
        $presentCount = Attendance::where('user_id', $user->id)  //id nya harus sesuai dengan user yang sedang  login
            ->whereBetween('created_at', [$start, $end]) //created_at harus berada di antara tanggal mulai dna tanggal berakhir
            ->where('status', 'hadir')  //statusnya harus hadir
            ->count();  //hitung


        // rumus gaji = hari masuk/30 x gaji pokok
        $totalSalary = round(($presentCount / 30) * $employee->gaji_pokok, 0);

        return view('employee.salary.index', compact(
            'month',
            'year',
            'presentCount',
            'employee',
            'totalSalary'
        ));
    }

    public function downloadPdf($id)
    {
        $employee = Employee::with('user')->where('user_id', $id)->firstOrFail();
        $month = now()->month;
        $year = now()->year;


        // Rentang tanggal dari awal sampai akhir bulan (pakai endOfMonth agar fleksibel)
        $start = Carbon::create($year, $month, 1)->startOfDay();
        $end = Carbon::create($year, $month, 1)->endOfMonth();


        // Hitung jumlah hadir
        $presentCount = Attendance::where('user_id', $id)
            ->whereBetween('created_at', [$start, $end])
            ->where('status', 'hadir')
            ->count();

        // Hitung gaji: (hadir / 30) x gaji pokok
        $totalSalary = round(($presentCount / 30) * $employee->gaji_pokok, 0);
        // Load dan unduh PDF slip gaji
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('employee.salary.slip', compact(
            'employee',
            'month',
            'year',
            'presentCount',
            'totalSalary'
        ));

        return $pdf->download('slip-gaji-' . $month . '-' . $year . '.pdf');
    }
}
