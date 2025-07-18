<div class="overflow-x-auto bg-white p-4 shadow rounded-xl">
    <h2 class="text-lg font-semibold mb-4">Transaksi Terbaru</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">#</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Petani</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tonase</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kualitas TBS</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Lokasi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Harga TBS</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Total</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
        @forelse ($penawarans as $index => $item)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $penawarans->firstItem() + $index }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->tonase }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->kualitas }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->lokasi }}</td>
                <td class="px-6 py-4 whitespace-nowrap">Rp.{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">Rp.{{ number_format($item->total_bayar, 0, ',', '.') }}</td>
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
                <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data penawaran.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
