<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-600">Invoice Saya</h1>
        </div>
        <div class="text-sm ">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="#" separator="slash">Beranda</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Invoice</flux:breadcrumbs.item>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tonsae</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kualitas TBS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Invoice</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($invoices as $index => $invoice)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $invoices->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $invoice->transaksi->offer->tonase }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $invoice->transaksi->offer->kualitas }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $invoice->transaksi->offer->lokasi }}</td>
                        <td class="px-6 py-4">{{ $invoice->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <flux:button size="sm">
                                <flux:icon.arrow-down-on-square class="size-4" />
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data invoice.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $invoices->links() }}
        </div>
    </div>
</div>
