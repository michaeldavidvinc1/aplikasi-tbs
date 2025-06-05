<?php

namespace App\Livewire\Admin;

use App\Models\HargaTbs;
use App\Models\TbsOffer;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalUser;
    public $totalTransaksi;
    public $tonaseTbs;
    public $hargaTbs;

    public function mount(){
        $this->totalUser = User::count();
        $this->totalTransaksi = Transaksi::count();
        $this->tonaseTbs = TbsOffer::where('status', '=', 'terima')->sum('tonase');
        $this->hargaTbs = HargaTbs::where('berlaku', '>', Carbon::now())->latest()->first();
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
