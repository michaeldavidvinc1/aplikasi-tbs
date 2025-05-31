<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-600">Riwayat Pembelian</h1>
        </div>
        <div class="text-sm ">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="#" separator="slash">Beranda</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Riwayat Pembelian</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>
    <div class="mb-6 flex items-center gap-4">
        <div class="flex flex-col gap-2">
            <label class="block text-sm font-medium ">Tanggal</label>
            <flux:input type="date" wire:model.live="tanggal" />
        </div>
    </div>
    <div>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Berat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kualitas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Harga Beli</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Total Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($transaksis as $index => $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaksis->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->berat }}</td>
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
        </div>

        <div class="mt-4">
            {{ $transaksis->links() }}
        </div>
    </div>
</div>
