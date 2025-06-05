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
    </style>
</head>
<body>

<div class="header">
    <h3 style="text-align: center; margin-bottom: 5px;">KOPERASI UNIT DESA "TUNAS MUDA"</h3>
    <p style="text-align: center; margin: 0;">KAMPUNG TELUK MERBAU KEC DAYUN KAB SIAK</p>
    <h4 style="text-align: center; margin-top: 5px;">BUKTI TRANSAKSI TBS</h4>
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
        <th>Tonase (kg)</th>
        <th>Kualitas</th>
        <th>Lokasi</th>
        <th>Harga Beli (Rp/kg)</th>
        <th>Total (Rp)</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>{{ number_format($transaksi['offer']['tonase'], 0, ',', '.') }}</td>
        <td>{{ $transaksi['offer']['kualitas'] }}</td>
        <td>{{ $transaksi['offer']['lokasi'] }}</td>
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
            <td class="text-center" width="50%">
                <p>Petani,</p>
                <br><br><br>
                <p>( {{ $transaksi['offer']['user']['name'] }} )</p>
            </td>
            <td class="text-center" width="50%">
                <p>Koperasi,</p>
                <br><br><br>
                <p>( Admin Koperasi )</p>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
