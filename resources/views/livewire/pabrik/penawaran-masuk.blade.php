<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-600 dark:text-white">Penawaran Masuk</h1>
        </div>
        <div class="text-sm ">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="#" separator="slash">Beranda</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Penawaran Masuk</flux:breadcrumbs.item>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Petani</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tonase</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kualitas TBS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Action</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($penawarans as $index => $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $penawarans->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->tonase }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->kualitas }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->lokasi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $color = match($item->status) {
                                    'menunggu' => 'bg-gray-100 text-gray-800',
                                    'terima' => 'bg-green-100 text-green-800',
                                    'tolak' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 flex gap-4">
                            <flux:button size="sm" class="text-xs" wire:click="setujuAlert({{ $item->id }})" >Setuju</flux:button>
                            <flux:button variant="danger" size="sm" class="text-xs" wire:click="tolakAlert({{ $item->id }})">Tolak</flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data penawaran.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $penawarans->links() }}
        </div>
    </div>
</div>
