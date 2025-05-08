@extends('base')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-semibold">Dashboard Bendahara</h2>
    <div class="row g-4">
        <!-- Karyawan -->
        <div class="col-md-4">
            <div class="card dashboard-card h-100 text-center p-4 bg-white">
                <h5 class="card-title text-primary">Data Karyawan</h5>
                <p class="card-text">Kelola informasi seluruh karyawan.</p>
                <a href="{{ route('manage.employee.index') }}" class="btn btn-primary">Kelola</a>
            </div>
        </div>
        <!-- Presensi -->
        <div class="col-md-4">
            <div class="card dashboard-card h-100 text-center p-4 bg-white">
                <h5 class="card-title text-primary">Presensi</h5>
                <p class="card-text">Lihat dan pantau kehadiran harian.</p>
                <a href="#" class="btn btn-primary">Lihat</a>
            </div>
        </div>
        <!-- Gaji -->
        <div class="col-md-4">
            <div class="card dashboard-card h-100 text-center p-4 bg-white">
                <h5 class="card-title text-primary">Gaji</h5>
                <p class="card-text">Hitung dan kelola gaji berdasarkan presensi.</p>
                <a href="#" class="btn btn-primary">Cek Gaji</a>
            </div>
        </div>
    </div>
</div>
@endsection