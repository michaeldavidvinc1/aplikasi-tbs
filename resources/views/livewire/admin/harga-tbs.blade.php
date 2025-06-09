<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-600 dark:text-white">Harga TBS</h1>
        </div>
        <div class="text-sm ">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="#" separator="slash">Beranda</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Harga TBS</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>
    <div class="flex justify-end">
        <flux:modal.trigger name="create-harga-tbs">
            <flux:button wire:click="resetForm">Tambah</flux:button>
        </flux:modal.trigger>
    </div>
    <div>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Harga Per Kilo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Berlaku</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Action</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($harga_tbs as $index => $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->harga_per_kilo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->berlaku }}</td>
                        <td class="px-6 py-4">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <flux:modal.trigger name="create-harga-tbs">
                                <flux:button size="sm" class="text-xs" wire:click="edit({{ $item->id }})">Edit</flux:button>
                            </flux:modal.trigger>
                            <flux:modal.trigger name="delete-data">
                                <flux:button variant="danger" size="sm" class="text-xs" wire:click="$set('selectedId', {{ $item->id }})">Delete</flux:button>
                            </flux:modal.trigger>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data harga tbs.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
{{--            {{ $penawarans->links() }}--}}
        </div>
    </div>

{{--    Modal--}}
    <flux:modal name="create-harga-tbs" variant="flyout">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Harga TBS</flux:heading>
                <flux:text class="mt-2">Masukkan detail harga TBS yang akan diberlakukan.</flux:text>
            </div>
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'create' }}" class="space-y-6 max-w-xl w-full">
                <flux:input label="Harga Per Kilo" type="number" wire:model.defer="harga_per_kilo" />
                <flux:input label="Berlaku" type="date" wire:model.defer="berlaku" />
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Tambah' }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
    <flux:modal name="delete-data" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete data?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to delete this data.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="destroy({{ $selectedId }})">Delete data</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
