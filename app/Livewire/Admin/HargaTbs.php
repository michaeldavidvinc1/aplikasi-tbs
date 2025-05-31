<?php

namespace App\Livewire\Admin;

use App\Models\TbsOffer;
use App\Models\HargaTbs as HargaTbsModel;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class HargaTbs extends Component
{

    #[Validate('required|numeric')]
    public $harga_per_kilo;
    #[Validate('required')]
    public $berlaku;

    public $isEdit = false;
    public $editId = null;

    public $selectedId;

    public function create()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            HargaTbsModel::create([
                'harga_per_kilo' => $this->harga_per_kilo,
                'berlaku' => $this->berlaku,
            ]);

            Flux::modal('create-harga-tbs')->close();

            DB::commit();
            toastr()->success('Harga TBS berhasil ditambahkan');
            $this->resetForm();
        } catch (\Exception $ex) {
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
        $this->resetForm();
        $data = HargaTbsModel::findOrFail($id);

        $this->editId = $id;
        $this->harga_per_kilo = $data->harga_per_kilo;
        $this->berlaku = $data->berlaku;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $data = HargaTbsModel::findOrFail($this->editId);

            $data->update([
                'harga_per_kilo' => $this->harga_per_kilo,
                'berlaku' => $this->berlaku,
            ]);

            Flux::modal('create-harga-tbs')->close();
            DB::commit();
            toastr()->success('Harga TBS berhasil diperbarui');
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
            $data = HargaTbsModel::findOrFail($id);
            $data->delete();
            Flux::modal('delete-data')->close();
            DB::commit();
            toastr()->success('Harga TBS berhasil di hapus');
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
        $this->reset(['harga_per_kilo', 'berlaku', 'isEdit', 'editId']);
    }

    public function render()
    {
        return view('livewire.admin.harga-tbs', [
            'harga_tbs' => HargaTbsModel::all()
        ]);
    }
}
