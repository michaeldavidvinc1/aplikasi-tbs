<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-600 dark:text-white">Kirim Penawaran</h1>
        </div>
        <div class="text-sm ">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="#" separator="slash">Beranda</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Kirim Penawaran</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>
    <div class="">
        <form wire:submit.prevent="save" class="space-y-6 max-w-xl w-full">
            <flux:field>
                <flux:label>Harga TBS</flux:label>
                <flux:input type="number" value="{{ $harga->harga_per_kilo ?? 0 }}" readonly />
                @if(!$harga)
                    <p class="text-xs text-red-500">* Tidak ada harga tbs yang berlaku silahkan hubungi admin</p>
                @endif
            </flux:field>

            <flux:field>
                <flux:label>Tonase</flux:label>
                <flux:input type="number" wire:model.defer="tonase" />
                <flux:error name="tonase" />
            </flux:field>

            <flux:field>
                <flux:label>Kualitas TBS</flux:label>
                <flux:input type="text" wire:model.defer="kualitas" />
                <flux:error name="kualitas" />
            </flux:field>

            <flux:field>
                <flux:label>Lokasi</flux:label>
                <flux:input type="text" wire:model.defer="lokasi" />
                <flux:error name="lokasi" />
            </flux:field>
            <flux:button type="submit" variant="primary">Tambah</flux:button>
        </form>
    </div>
</div>
