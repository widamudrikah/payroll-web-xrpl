<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji - {{ $employee->user->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            line-height: 1.6;
        }


        .slip-container {
            width: 100%;
            padding: 20px;
            border: 1px solid #ddd;
        }


        .header {
            text-align: center;
            margin-bottom: 20px;
        }


        .header h2 {
            margin: 0;
            color: #007bff;
        }


        .info-table,
        .gaji-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }


        .info-table td,
        .gaji-table th,
        .gaji-table td {
            padding: 8px 12px;
            border: 1px solid #ccc;
        }


        .gaji-table th {
            background-color: #f2f2f2;
            text-align: left;
        }


        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #777;
        }


        .total {
            font-weight: bold;
            background-color: #e9ffe9;
        }
    </style>
</head>
<body>
    <div class="slip-container">
        <div class="header">
            <h2>SLIP GAJI KARYAWAN</h2>
            <p><strong>SMK IDN Boarding School Akhwat</strong></p>
            <p>Bulan: {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</p>
        </div>


        <table class="info-table">
            <tr>
                <td><strong>Nama</strong></td>
                <td>{{ $employee->user->name }}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>{{ $employee->user->email }}</td>
            </tr>
            <tr>
                <td><strong>Jabatan</strong></td>
                <td>{{ $employee->jabatan }}</td>
            </tr>
        </table>


        <table class="gaji-table">
            <thead>
                <tr>
                    <th>Gaji Pokok Bulanan</th>
                    <th>Jumlah Hari Hadir</th>
                    <th>Total Gaji Diterima</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rp{{ number_format($employee->gaji_pokok) }}</td>
                    <td>{{ $presentCount }} hari</td>
                    <td class="total">Rp{{ number_format($totalSalary) }}</td>
                </tr>
            </tbody>
        </table>


        <div class="footer">
            <p>Slip ini dihasilkan secara otomatis pada {{ now()->format('d M Y') }}</p>
        </div>
    </div>
</body>
</html>
