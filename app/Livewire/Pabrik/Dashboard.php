<?php

namespace App\Livewire\Pabrik;

use App\Models\HargaTbs;
use App\Models\TbsOffer;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalPembelian;
    public $totalTonase;
    public $transaksiAktif;
    public $hargaTbs;

    public function mount(){
        $this->totalPembelian = Transaksi::where('status', 'sudah bayar')->sum('total_bayar');
        $this->totalTonase = DB::table('transaksis')
            ->join('tbs_offers', 'transaksis.offer_id', '=', 'tbs_offers.id')
            ->where('transaksis.status', 'sudah bayar')
            ->sum('tbs_offers.tonase');
        $this->transaksiAktif = Transaksi::where('status', 'belum bayar')->count();
        $this->hargaTbs = HargaTbs::where('berlaku', '>', Carbon::now())->latest()->first();
    }
    public function render()
    {
        return view('livewire.pabrik.dashboard');
    }
}
