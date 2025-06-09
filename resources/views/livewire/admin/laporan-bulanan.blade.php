<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-600 dark:text-white">Laporan Bulanan</h1>
        </div>
        <div class="text-sm ">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="#" separator="slash">Beranda</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Laporan Bulanan</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>
    <div class="mb-6 flex items-center gap-4">
        <div class="flex flex-col gap-2">
            <label class="block text-sm font-medium ">Bulan</label>
            <flux:select wire:model.live="bulan">
                <option value="">-- Pilih Bulan --</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                @endfor
            </flux:select>
        </div>
        <div class="flex flex-col gap-2">
            <label class="block text-sm font-medium ">Tahun</label>
            <flux:select wire:model.live="tahun">
                <option value="">-- Pilih Tahun --</option>
                @for ($y = now()->year; $y >= 2022; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </flux:select>
        </div>

    </div>
    <div>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Petani</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tonase</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kualitas TBS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Harga Beli</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Total Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($pembayarans as $index => $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pembayarans->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->tonase }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->offer->kualitas }}</td>
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
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data riwayat pembayaran.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pembayarans->links() }}
        </div>
    </div>
</div>
