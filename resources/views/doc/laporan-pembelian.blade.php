
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
    <h1 style="text-align: center; margin-bottom: 18px;">Laporan Pembelian</h1>
</div>


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
            <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->user->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->tonase }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->kualitas }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $item->harga_beli }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $item->total_bayar }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $color = match($item->status) {
                                    'belum bayar' => 'bg-gray-100 text-gray-800',
                                    'sudah bayar' => 'bg-green-100 text-green-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                        </td>
                        <td class="px-6 py-4">{{ $item->created_at->format('d M Y') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data aktif transaksi.</td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>
