@extends('base')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Monitoring Presensi Karyawan</h2>
    <form method="GET" class="row g-3 mb-4">
        <!-- bulan -->
        <div class="col-md-3">
            <select name="month" class="form-select">
                @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
                @endforeach
            </select>
        </div>
        <!-- tahun -->
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
        <table class="table table-bordered align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Jam (WIB)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $index => $attendance)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $attendance->user->name ?? '-' }}</td>
                    <td>{{ $attendance->user->email ?? '-' }}</td>
                    <td>{{ ucfirst($attendance->status) }}</td>
                    <td>{{ $attendance->created_at->timezone('Asia/Jakarta')->format('d M Y') }}</td>
                    <td>{{ $attendance->created_at->timezone('Asia/Jakarta')->format('H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data presensi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection