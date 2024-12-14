<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kategori {{ $category }}</title>
    <style>
        @page {
            margin: 100px 25px;
        }
        header {
            position: fixed;
            top: -80px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            line-height: 35px;
        }
        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 40px;
            text-align: center;
            line-height: 35px;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap: break-word;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center; /* Pusatkan teks secara horizontal */
            vertical-align: middle; /* Pusatkan teks secara vertikal */
        }
        th {
            background-color: #f2f2f2;
        }
        /* Tetapkan lebar tetap untuk kolom Gambar */
        th:nth-child(5),
        td:nth-child(5) {
            width: 10%; /* Sesuaikan sesuai kebutuhan */
        }
        /* Batasi ukuran gambar dan pusatkan */
        .report-image {
            max-width: 80px; /* Atur lebar maksimal gambar */
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <header>
        <h2>Nama Perusahaan Anda</h2>
    </header>

    <footer>
        <p>Halaman {PAGE_NUM} dari {PAGE_COUNT}</p>
    </footer>

    <h2>Laporan Kategori: {{ ucfirst($category) }}</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelapor</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Gambar</th>
                <th>Status</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Kategori</th>
                <th>Dibuat pada</th>
                <th>Diperbarui pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->user->name }}</td>
                <td>{{ $report->desc }}</td>
                <td>{{ $report->location }}</td>
                <td>
                    @if($report->image_url)
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $report->image_url))) }}" alt="Gambar" class="report-image">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $report->status }}</td>
                <td>{{ $report->lat }}</td>
                <td>{{ $report->lng }}</td>
                <td>
                    @if($report->categories->count())
                        {{ $report->categories->pluck('name')->implode(', ') }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($report->created_at)->format('d-m-Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($report->updated_at)->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
