<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembelian TBS</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        .no-border td {
            border: none;
            padding: 2px;
        }
        .kop-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .subkop {
            text-align: center;
            font-size: 12px;
            margin-top: 4px;
        }
        .email {
            text-align: center;
            font-size: 11px;
            margin-top: 2px;
        }
        .logo {
            width: 80px;
        }
        .status-badge {
            padding: 2px 6px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 4px;
            display: inline-block;
        }
        .sudah-bayar {
            background-color: #c8f7c5;
            color: #2b662e;
        }
        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .ttd {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .ttd div {
            width: 30%;
            text-align: center;
        }
        .ttd .center {
            width: 30%;
        }
    </style>
</head>
<body>

<!-- Header -->
<table class="no-border">
    <tr>
        <td style="width: 80px;"><img src="{{ public_path('./pohon.jpg') }}" class="logo" alt="logo kiri"></td>
        <td style="text-align: center;">
            <div class="kop-title">KOPERASI PRODUSEN <br><span style="color: red;">“TUNAS MUDA“</span></div>
            <div class="subkop">Jl. Panglima Besar Kampung Teluk Merbau Kec.dayun Kab.Siak – Riau</div>
            <div class="email">Email. Kud.tunasmuda1991@gmail.com</div>
            <div class="email">Kode Pos. 28656</div>
        </td>
        <td style="width: 80px;"><img src="{{ public_path('./bunga.jpg') }}" class="logo" alt="logo kanan"></td>
    </tr>
</table>

<hr style="margin: 10px 0; border: 1px solid black;">

<!-- Judul -->
<h3 style="text-align: center; margin-bottom: 10px;">Laporan Pembelian TBS</h3>

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
    @php $totalHarga = 0; @endphp
    @forelse ($transaksi as $index => $item)
        @php $totalHarga += $item->total_bayar; @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->offer->user->name }}</td>
            <td>{{ $item->offer->tonase }}</td>
            <td>{{ $item->offer->kualitas }}</td>
            <td>{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
            <td>{{ number_format($item->total_bayar, 0, ',', '.') }}</td>
            <td>
                    <span class="status-badge sudah-bayar">
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

<!-- Total -->
<table style="width: 50%; float: right; margin-top: 10px;">
    <tr>
        <td><strong>Total Harga yang Diterima</strong></td>
    </tr>
    <tr>
        <td>Jumlah: <strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></td>
    </tr>
</table>

<div style="clear: both;"></div>

<!-- TTD -->
<!-- Footer Tanda Tangan -->
<div style="width: 100%; margin-top: 60px;">

    <!-- Kiri: Diketahui Oleh -->
    <div style="width: 45%; float: left; text-align: center;">
        <div style="margin-bottom: 60px;">Diketahui Oleh</div>
        <div>( Pimpinan )</div>
    </div>

    <!-- Kanan: Dayun, Tanggal & Koperasi -->
    <div style="width: 45%; float: right; text-align: center;">
        <div>Dayun, .................. 20</div>
        <div style="margin-bottom: 60px;">Dibuat Oleh</div>
        <div>( Koperasi )</div>
    </div>

</div>

<!-- Clear Float -->
<div style="clear: both;"></div>


</body>
</html>
