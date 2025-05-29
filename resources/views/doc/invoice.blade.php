<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
<h1>Invoice #{{ $transaksi->offer->user->name }}</h1>
<p>Nama: {{ $transaksi->offer->berat }}</p>
<p>Total: Rp{{ number_format($transaksi->total_bayar, 0, ',', '.') }}</p>
</body>
</html>
