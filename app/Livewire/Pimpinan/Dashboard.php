<?php

namespace App\Livewire\Pimpinan;

use App\Models\HargaTbs;
use App\Models\TbsOffer;
use App\Models\Transaksi;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalUser;
    public $totalTransaksi;
    public $tonaseTbs;
    public $hargaTbs;

    public $isExpired;

    public function mount(){
        $this->totalUser = User::count();
        $this->totalTransaksi = Transaksi::count();
        $this->tonaseTbs = TbsOffer::where('status', '=', 'terima')->sum('tonase');
        $hargaLatest = HargaTbs::where('berlaku', '>', now())->latest()->first();

        if (!$hargaLatest) {
            // Ambil data expired terbaru
            $hargaLatest = HargaTbs::latest()->first();
            $this->isExpired = true;
        } else {
            $this->isExpired = false;
        }

        $this->hargaTbs = $hargaLatest;
    }
    public function render()
    {
        return view('livewire.pimpinan.dashboard');
    }
}
