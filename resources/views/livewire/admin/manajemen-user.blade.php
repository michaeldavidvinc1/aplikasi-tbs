<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-600">Manajemen User</h1>
        </div>
        <div class="text-sm ">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="#" separator="slash">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Manajemen User</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>
    <div class="mb-6 flex items-center justify-between gap-4">
        <div class="flex flex-col gap-2">
            <label class="block text-sm font-medium ">Role</label>
            <flux:select wire:model.live="roleFilter" placeholder="Pilih Role...">
                <option value="">Semua</option>
                <option value="PETANI">Petani</option>
                <option value="ADMIN">Admin</option>
                <option value="PABRIK">Pabrik</option>
            </flux:select>
        </div>
        <flux:modal.trigger name="user">
            <flux:button wire:click="resetForm">Tambah</flux:button>
        </flux:modal.trigger>
    </div>
    <div>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Action
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($users as $index => $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $users->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $color = match($item->role) {
                                    'PETANI' => 'bg-gray-100 text-gray-800',
                                    'ADMIN' => 'bg-green-100 text-green-800',
                                    'PABRIK' => 'bg-blue-100 text-blue-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                {{ ucfirst($item->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 flex gap-4">
                            <flux:modal.trigger name="change-password">
                                <flux:button size="sm" class="text-xs" wire:click="edit({{ $item->id }})">Change
                                    Password
                                </flux:button>
                            </flux:modal.trigger>
                            <flux:modal.trigger name="user">
                                <flux:button size="sm" class="text-xs" wire:click="edit({{ $item->id }})">Edit
                                </flux:button>
                            </flux:modal.trigger>
                            <flux:modal.trigger name="delete-data">
                                <flux:button variant="danger" size="sm" class="text-xs"
                                             wire:click="$set('selectedId', {{ $item->id }})">Delete
                                </flux:button>
                            </flux:modal.trigger>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data users.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    {{--    Modal--}}
    <flux:modal name="change-password" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ganti Password</flux:heading>
                <flux:text class="mt-2">Enter a new password to update account security.</flux:text>
            </div>
            <flux:input label="Name" placeholder="Your name"/>
            <flux:input label="Date of birth" type="date"/>
            <div class="flex">
                <flux:spacer/>
                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
    <flux:modal name="user" variant="flyout">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah User</flux:heading>
                <flux:text class="mt-2">Masukkan detail user yang ingin ditambahkan.</flux:text>
            </div>
            <form wire:submit.prevent="{{ $mode === 'edit' ? 'update' : 'create' }}" class="space-y-6 max-w-xl w-full">
                <flux:input label="Nama" type="text" wire:model.defer="name"/>
                <flux:input label="Email" type="email" wire:model.defer="email"/>
                <flux:select label="Role" wire:model.defer="role" placeholder="Pilih Role...">
                    <option value="PETANI">Petani</option>
                    <option value="ADMIN">Admin</option>
                    <option value="PABRIK">Pabrik</option>
                </flux:select>
                @if($mode !== 'edit')
                    <flux:input
                        wire:model="password"
                        :label="__('Password')"
                        type="password"
                        required
                        :placeholder="__('Password')"
                        viewable
                    />
                @endif
                <div class="flex">
                    <flux:spacer/>
                    <flux:button type="submit" variant="primary">
                        {{ $mode === 'edit' ? 'Simpan Perubahan' : 'Tambah' }}
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
                <flux:spacer/>
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="destroy({{ $selectedId }})">Delete data
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
