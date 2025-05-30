<?php

namespace App\Livewire\Admin;

use App\Models\HargaTbs as HargaTbsModel;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenUser extends Component
{
    use  WithPagination;

    public $roleFilter = '';

    public $name = '', $email = '', $role = '', $password = '', $confirmation_password = '';

    public $editId = null;
    public $selectedId;
    public $mode = 'create';

    public function rules()
    {
        return match ($this->mode) {
            'edit' => [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->editId,
                'role' => 'required',
            ],
            'change-password' => [
                'password' => 'required|min:8',
                'confirmation_password' => 'required|same:password',
            ],
            default => [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
                'password' => 'required|min:8',
            ]
        };
    }

    public function create()
    {
        $this->mode = 'create';
        $this->validate();

        DB::beginTransaction();
        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => Hash::make($this->password),
            ]);

            Flux::modal('user')->close();
            DB::commit();
            toastr()->success('User berhasil ditambahkan');
            $this->resetForm();
        } catch (\Exception $ex){
            DB::rollback();
            \Log::error('Error: ' . $ex->getMessage());
            LivewireAlert::title('Error!')
                ->text($ex->getMessage())
                ->error()
                ->withCancelButton('OK')
                ->show();
        }
    }

    public function edit($id)
    {
        $this->mode = 'edit';
        $data = User::findOrFail($id);

        $this->editId = $id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->role;
    }

    public function update()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $data = User::findOrFail($this->editId);

            $data->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);

            Flux::modal('user')->close();
            DB::commit();
            toastr()->success('User berhasil diperbarui');
            $this->resetForm();
        } catch (\Exception $ex){
            DB::rollback();
            \Log::error('Error: ' . $ex->getMessage());
            LivewireAlert::title('Error!')
                ->text($ex->getMessage())
                ->error()
                ->withCancelButton('OK')
                ->show();
        }
    }

    public function destroy($id)
    {
        $this->resetForm();

        DB::beginTransaction();
        try {
            $data = User::findOrFail($id);
            $data->delete();
            Flux::modal('delete-data')->close();
            DB::commit();
            toastr()->success('User data berhasil di hapus');
        } catch (\Exception $ex){
            DB::rollback();
            \Log::error('Error: ' . $ex->getMessage());
            LivewireAlert::title('Error!')
                ->text($ex->getMessage())
                ->error()
                ->withCancelButton('OK')
                ->show();
        }
    }

    public function changePassword($id)
    {
        $this->mode = 'change-password';
        $this->validate();
        DB::beginTransaction();
        try {
            $data = User::findOrFail($id);
            $data->update(['password' => Hash::make($this->password)]);

            Flux::modal('change-password')->close();
            DB::commit();
            toastr()->success('Password berhasil diperbarui');
            $this->resetForm();
        } catch (\Exception $ex){
            DB::rollback();
            \Log::error('Error: ' . $ex->getMessage());
            LivewireAlert::title('Error!')
                ->text($ex->getMessage())
                ->error()
                ->withCancelButton('OK')
                ->show();
        }
    }

    public function resetForm()
    {
        $this->mode = 'create';
        $this->reset([
            'name', 'email', 'role', 'password', 'confirmation_password', 'editId'
        ]);
    }

    #[\Livewire\Attributes\Computed]
    public function allUser()
    {
        return User::query()
            ->when($this->roleFilter, fn($q) => $q->where('role', $this->roleFilter))
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.manajemen-user', [
            'users' => $this->allUser,
        ]);
    }

}
