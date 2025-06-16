<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Buku Tamu</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            margin: 30px;
            color: #333;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin: 10px 0;
        }

        h2 {
            font-size: 18px;
            color: #2c3e50;
            margin-top: 30px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            vertical-align: top;
        }

        th {
            background-color: #f1f1f1;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 11px;
            color: #777;
        }

        .meta {
            margin-bottom: 10px;
            font-size: 13px;
        }

        body::before {
            content: "";
            position: fixed;
            top: 40%;
            left: 25%;
            width: 400px;
            height: 400px;
            background-image: url('{{ public_path('logo_transparan.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.04;
            z-index: -1;
        }
    </style>
</head>
<body>

<header>
    <h1>Laporan Buku Tamu</h1>
    <p>Dinas Pendidikan Provinsi Jawa Timur</p>
</header>

<div class="meta">
    <strong>Filter:</strong><br>
    @if($filterInfo['search']) Pencarian: "{{ $filterInfo['search'] }}"<br> @endif
    @if($filterInfo['month'])
        Bulan: {{ \Carbon\Carbon::createFromDate(null, (int) $filterInfo['month'], 1)->translatedFormat('F') }}<br>
    @endif
    @if($filterInfo['year']) Tahun: {{ $filterInfo['year'] }}<br> @endif
    <br>
    <strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}
</div>

<h2>Daftar Tamu</h2>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Pekerjaan</th>
            <th>No. Telp</th>
            <th>Alamat</th>
            <th>Keperluan</th>
            <th>Jenis Kelamin</th>
            <th>Identitas</th>
            <th>Bidang</th>
            <th>Rekomendasi</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($guests as $index => $guest)
        <tr>
            <td style="text-align: center;">{{ $index + 1 }}</td>
            <td>{{ $guest->name }}</td>
            <td>{{ $guest->nik }}</td>
            <td>{{ $guest->pekerjaan }}</td>
            <td>{{ $guest->phone }}</td>
            <td>{{ $guest->alamat }}</td>
            <td>{{ $guest->keperluan }}</td>
            <td style="text-align: center;">{{ $guest->gender }}</td>
            <td>{{ $guest->identitas }}</td>
            <td>{{ optional($guest->bidang)->nama ?? '-' }}</td>
            <td>{{ optional($guest->rekomendasi)->nama ?? '-' }}</td>
            <td style="text-align: center;">{{ $guest->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<footer>
    Dicetak pada {{ now()->format('d-m-Y') }}
</footer>

<script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script(function ($pageNumber, $pageCount, $pdf) {
            $pdf->text(520, 820, "Halaman $pageNumber dari $pageCount", null, 10);
        });
    }
</script>

</body>
</html>
