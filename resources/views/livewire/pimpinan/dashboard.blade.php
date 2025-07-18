<div class="w-full">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1 -->
        <div class="bg-white shadow-md rounded-2xl p-4 flex items-center">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <flux:icon.users class="size-6"/>
            </div>
            <div class="ml-4">
                <h4 class="text-sm font-medium text-gray-600">Total User</h4>
                <div class="text-xl font-semibold text-gray-800">{{$totalUser}} Akun</div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white shadow-md rounded-2xl p-4 flex items-center">
            <div class="p-3 bg-green-100 text-green-600 rounded-full">
                <flux:icon.inbox-arrow-down class="size-6"/>
            </div>
            <div class="ml-4">
                <h4 class="text-sm font-medium text-gray-600">Total Transaksi</h4>
                <div class="text-xl font-semibold text-gray-800">{{$totalTransaksi}}</div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white shadow-md rounded-2xl p-4 flex items-center">
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                <flux:icon.document-check class="size-6"/>
            </div>
            <div class="ml-4">
                <h4 class="text-sm font-medium text-gray-600">Tonase TBS Keseluruhan</h4>
                <div class="text-xl font-semibold text-gray-800">{{$tonaseTbs}} Kg</div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white shadow-md rounded-2xl p-4 flex items-center">
            <div class="p-3 bg-red-100 text-red-600 rounded-full">
                <flux:icon.banknotes class="size-6"/>
            </div>
            <div class="ml-4">
                <h4 class="text-sm font-medium text-gray-600">Harga TBS Hari Ini</h4>
                <div class="text-xl font-semibold text-gray-800">Rp.{{ number_format($hargaTbs->harga_per_kilo, 0, ',', '.') }}</div>
                @if($isExpired)
                    <div class="text-xs text-red-500 mt-1">
                        *Harga ini sudah tidak berlaku sejak {{ \Carbon\Carbon::parse($hargaTbs->berlaku)->format('d M Y') }}
                    </div>
                @endif
            </div>
        </div>

    </div>
    <div class="mt-4 w-full">
        <div class="flex gap-4 mb-4">
            <livewire:pimpinan.total-transaksi />
            <livewire:pimpinan.tonase-masuk />
        </div>
        <livewire:pimpinan.transaksi-terbaru />
    </div>
</div>
