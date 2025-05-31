<?php

namespace App\Livewire\Petani;

use App\Models\HargaTbs;
use App\Models\TbsOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class KirimPenawaran extends Component
{

    #[Validate('required|numeric')]
    public $tonase;
    #[Validate('required')]
    public $kualitas;
    #[Validate('required')]
    public $lokasi;

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            TbsOffer::create([
                'user_id' => Auth::user()->id,
                'tonase' => $this->tonase,
                'kualitas' => $this->kualitas,
                'lokasi' => $this->lokasi,
            ]);

            DB::commit();
            toastr()->success('Penawaran berhasil dikirim');
            $this->reset(['tonase', 'kualitas', 'lokasi']);
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

    public function render()
    {
        $harga = HargaTbs::where('berlaku', '>', Carbon::now())->latest()->first();
        return view('livewire.petani.kirim-penawaran',[
            'harga' => $harga
        ]);
    }
}
