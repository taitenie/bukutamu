<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Dashboard</title>
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

        header img {
            height: 80px;
        }

        h1 {
            font-size: 24px;
            margin: 10px 0 0 0;
        }

        h2 {
            font-size: 18px;
            color: #2c3e50;
            margin-top: 30px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }

        h4 {
            margin: 15px 0 5px;
            color: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 13px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px 8px;
        }

        th {
            background-color: #f1f1f1;
            text-align: center;
        }

        td {
            text-align: left;
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
    <h1>Laporan Dashboard</h1>
    <p>Dinas Pendidikan Provinsi Jawa Timur</p>
    <p>Periode: {{ $month }}/{{ $year }}</p>
</header>

<hr>

{{-- Bagian Statistik Buku Tamu --}}
<h2>Statistik Buku Tamu</h2>
<table>
    <tr>
        <th>Total Tamu</th>
        <td>{{ $totalTamu }}</td>
    </tr>
    <tr>
        <th>Tamu Bulan Ini</th>
        <td>{{ $tamuBulanIni }}</td>
    </tr>
    <tr>
        <th>Tamu Hari Ini</th>
        <td>{{ $tamuHariIni }}</td>
    </tr>
</table>

{{-- Bidang paling banyak dikunjungi --}}
<h2>Bidang Paling Banyak Dikunjungi</h2>
<table>
    <thead>
        <tr>
            <th>Bidang</th>
            <th>Jumlah Kunjungan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($labelsBidang as $key => $bidang)
        <tr>
            <td>{{ $bidang }}</td>
            <td style="text-align: center;">{{ $dataBidang[$key] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Statistik Tamu per Hari --}}
<h2>Statistik Tamu Bulan Ini (Per Hari)</h2>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jumlah Tamu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($labelsMonth as $key => $day)
        <tr>
            <td>{{ $day }}</td>
            <td style="text-align: center;">{{ $dataMonth[$key] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Statistik Survei --}}
<h2>Statistik Hasil Survei</h2>
@foreach($surveyStats as $question => $answers)
    <h4>{{ $question }}</h4>
    <table>
        <thead>
            <tr>
                <th>Jawaban</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answers as $answer => $count)
            <tr>
                <td>{{ $answer }}</td>
                <td style="text-align: center;">{{ $count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

<footer>
Dicetak pada {{ now()->format('d-m-Y H:i') }}
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
