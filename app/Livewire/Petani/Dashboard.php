<?php

namespace App\Livewire\Petani;

use App\Models\HargaTbs;
use App\Models\TbsOffer;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    public $totalTbs;
    public $totalPendapatan;
    public $transaksiDiterima;
    public $hargaTbs;

    public function mount(){
        $this->totalTbs = TbsOffer::where('user_id', Auth::user()->id)->sum('tonase');
        $this->totalPendapatan = Transaksi::with('offer')
            ->whereHas('offer', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->sum('total_bayar');
        $this->transaksiDiterima = TbsOffer::where('user_id', Auth::user()->id)
            ->where('status', '=', 'terima')
            ->count();
        $this->hargaTbs = HargaTbs::where('berlaku', '>', Carbon::now())->latest()->first();
    }

    public function render()
    {
        return view('livewire.petani.dashboard');
    }
}
