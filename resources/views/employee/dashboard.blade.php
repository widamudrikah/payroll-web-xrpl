@extends('base')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-semibold">Dashboard Karyawan</h2>
    <div class="row g-4">
        <!-- Presensi -->
        <div class="col-md-6">
            <div class="card dashboard-card h-100 text-center p-4 bg-white">
                <h5 class="card-title text-primary">Data Presensi</h5>
                <p class="card-text">Silahkan masuk untuk melakukan absensi</p>
                <a href="{{ route('attendance.index') }}" class="btn btn-primary">Absebsi</a>
            </div>
        </div>
        <!-- Pyaroll -->
        <div class="col-md-6">
            <div class="card dashboard-card h-100 text-center p-4 bg-white">
                <h5 class="card-title text-primary">Gaji</h5>
                <p class="card-text">Silahkan masuk untuk melihat slip gaji</p>
                <a href="#" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
</div>

@endsection