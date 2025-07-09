<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran Hasil TBS</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }
        .no-border td, .no-border th {
            border: none;
            text-align: left;
            padding: 2px;
        }
        .text-right {
            text-align: right;
        }
        .text-left {
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .header {
            margin-bottom: 15px;
        }
        .kop {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .kop img {
            width: 80px;
            height: auto;
        }
        .kop-title {
            flex-grow: 1;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 30px;
        }
        .ttd {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

<!-- Kop Surat -->
<div class="kop" style="width: 100%; margin-bottom: 10px;">
    <table style="width: 100%; border: none; border-collapse: collapse;">
        <tr>
            <td style="width: 80px; border: none;">
                <img src="./pohon.jpg" alt="Logo Kiri" style="width: 80px;">
            </td>
            <td style="text-align: center; border: none;">
                <div style="font-size: 16px; font-weight: bold; text-transform: uppercase;">Laporan Pembelian</div>
                <div style="font-size: 14px; margin-top: 4px;">Koperasi Produsen Tunas Muda</div>
            </td>
            <td style="width: 80px; text-align: right; border: none;">
                <img src="./bunga.jpg" alt="Logo Kanan" style="width: 80px;">
            </td>
        </tr>
    </table>
</div>

<!-- Garis Bawah Kop -->
<div style="border-top: 2px solid #000; margin-bottom: 20px;"></div>

<!-- Tabel Transaksi -->
<table>
    <thead>
    <tr>
        <th>NO</th>
        <th>Nama Petani</th>
        <th>Tonase</th>
        <th>Kualitas TBS</th>
        <th>Harga Beli</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($transaksi as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->offer->user->name }}</td>
            <td>{{ $item->offer->tonase }}</td>
            <td>{{ $item->offer->kualitas }}</td>
            <td>{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
            <td>{{ number_format($item->total_bayar, 0, ',', '.') }}</td>
            <td>
                @php
                    $color = match($item->status) {
                        'belum bayar' => 'background-color:#eee; color:#555;',
                        'sudah bayar' => 'background-color:#c8f7c5; color:#2b662e;',
                        default => 'background-color:#eee; color:#555;',
                    };
                @endphp
                <span style="padding: 2px 6px; font-size: 10px; font-weight: bold; border-radius: 4px; {{ $color }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
            <td>{{ $item->created_at->format('d M Y') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="8">Tidak ada data aktif transaksi.</td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>
