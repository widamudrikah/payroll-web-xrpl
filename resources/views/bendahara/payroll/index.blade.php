@extends('base')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Kelola Gaji Karyawan</h2>
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <select name="month" class="form-select">
                @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="year" class="form-select">
                @for($y = now()->year; $y >= now()->year - 5; $y--)
                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered bg-white align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Gaji Pokok / hari</th>
                    <th>Jumlah Hadir</th>
                    <th>Total Gaji</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payrolls as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['email'] }}</td>
                    <td>{{ $data['jabatan'] }}</td>
                    <td>Rp {{ number_format($data['base_salary']) }}</td>
                    <td>{{ $data['present_days'] }}</td>
                    <td><strong>Rp {{ number_format($data['total_salary']) }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection