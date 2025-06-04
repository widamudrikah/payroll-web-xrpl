@extends('base')

@section('content')

@if(session('error'))
    <div class="alert alert-primary" role="alert">
        {{ session('error') }}
    </div>
    @endif

<div class="container mt-4">
    <h3 class="mb-4 fw-semibold">Slip Gaji Bulan {{ \Carbon\Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y') }}</h3>
    <form method="GET" class="mb-3 row g-2">
        <div class="col-md-3">
            <select name="month" class="form-select">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                    @endfor
            </select>
        </div>
        <div class="col-md-3">
            <select name="year" class="form-select">
                @for($y = now()->year; $y >= now()->year - 2; $y--)
                <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Lihat</button>
        </div>
    </form>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif




    <table class="table table-bordered bg-white">
        <tr>
            <th>Nama</th>
            <td>{{ $employee->user->name }}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>{{ $employee->jabatan }}</td>
        </tr>
        <tr>
            <th>Gaji Pokok</th>
            <td>Rp{{ number_format($totalSalary, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Jumlah Hadir</th>
            <td>{{ $presentCount }} hari</td>
        </tr>
        <tr>
            <th>Total Gaji</th>
            <td>Rp{{ number_format($totalSalary) }}</td>
        </tr>
    </table>

    <a href="{{ route('salary.download', auth()->user()->id) }}" class="btn btn-success mt-3">⬇️ Unduh Slip Gaji PDF</a>
</div>

@endsection