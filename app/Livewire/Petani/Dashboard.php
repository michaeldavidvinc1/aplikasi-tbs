<?php

namespace App\Livewire\Petani;

use Livewire\Component;

class Dashboard extends Component
{

    public $totalTbs;
    public $totalPendapatan;
    public $transaksiDiterima;
    public $hargaTbs;

    public function mount(){

    }

    public function render()
    {
        return view('livewire.petani.dashboard');
    }
}
