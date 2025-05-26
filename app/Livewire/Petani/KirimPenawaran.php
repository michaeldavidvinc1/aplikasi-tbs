<?php

namespace App\Livewire\Petani;

use App\Models\TbsOffer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class KirimPenawaran extends Component
{

    #[Validate('required|numeric')]
    public $berat;
    #[Validate('required')]
    public $kualitas;
    #[Validate('required')]
    public $lokasi;

    public function save()
    {
        $this->validate();

        TbsOffer::create([
            'user_id' => Auth::user()->id,
            'berat' => $this->berat,
            'kualitas' => $this->kualitas,
            'lokasi' => $this->lokasi,
        ]);

        toastr()->success('Penawaran berhasil dikirim');

        // reset form (opsional)
        $this->reset(['berat', 'kualitas', 'lokasi']);
    }

    public function render()
    {
        return view('livewire.petani.kirim-penawaran');
    }
}
