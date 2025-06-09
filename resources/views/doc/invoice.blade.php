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
        .footer {
            margin-top: 30px;
        }
        .ttd {
            display: flex;
            justify-content:  space-between;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="header">
    <h1 style="text-align: center; margin-bottom: 18px;">TUNAS MUDA</h1>
</div>

<table class="no-border">
    <tr>
        <td>Nama Petani</td>
        <td>: {{ $transaksi['offer']['user']['name'] }}</td>
        <td>Tanggal</td>
        <td>: {{ \Carbon\Carbon::parse($transaksi['created_at'])->format('d F Y') }}</td>
    </tr>
    <tr>
        <td>No. Transaksi</td>
        <td>: {{ $transaksi['id'] }}</td>
        <td>Status</td>
        <td>: {{ ucfirst(str_replace('_', ' ', $transaksi['status'])) }}</td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>NO</th>
        <th>Tanggal SPB</th>
        <th>No.SPB</th>
        <th>Supir</th>
        <th>Plat</th>
        <th>Netto</th>
        <th>Harga</th>
        <th>Jumlah</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>{{ \Carbon\Carbon::parse($transaksi['created_at'])->translatedFormat('d F Y') }}</td>
        <td>{{ $transaksi['id'] }}</td>
        <td>{{ $transaksi['offer']['supir'] }}</td>
        <td>{{ $transaksi['offer']['plat'] }}</td>
        <td>{{ $transaksi['offer']['tonase'] }}</td>
        <td>{{ number_format($transaksi['harga_beli'], 0, ',', '.') }}</td>
        <td>{{ number_format($transaksi['total_bayar'], 0, ',', '.') }}</td>
    </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th colspan="2">RINCIAN PEMBAYARAN</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-left">Total Harga</td>
        <td class="text-right">{{ number_format($transaksi['total_bayar'], 0, ',', '.') }}</td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <th class="text-left">TOTAL DITERIMA</th>
        <th class="text-right">{{ number_format($transaksi['total_bayar'], 0, ',', '.') }}</th>
    </tr>
    </tfoot>
</table>

<div class="footer">
    <table class="no-border">
        <tr>
            <td class="text-center" width="33%">
                <p>Petani,</p>
                <br><br><br>
                <p>( {{ $transaksi['offer']['user']['name'] }} )</p>
            </td>
            <td class="text-center" width="33%">
                <p>Koperasi,</p>
                <br><br><br>
                <p>( <span style="display: inline-block; min-width: 100px;">&nbsp;</span> )</p>
            </td>
            <td class="text-center" width="33%">
                <p>Kasir,</p>
                <br><br><br>
                <p>( <span style="display: inline-block; min-width: 100px;">&nbsp;</span> )</p>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
