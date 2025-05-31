<?php

namespace App\Livewire\Pabrik;

use App\Models\Transaksi;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatPembelian extends Component
{

    use  WithPagination;

    public $tanggal = '';

    #[\Livewire\Attributes\Computed]
    public function transaksi()
    {
        return Transaksi::with('offer.user')
            ->where('status', 'sudah bayar')
            ->when($this->tanggal, fn($q) => $q->whereDate('created_at', Carbon::parse($this->tanggal)))
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.pabrik.riwayat-pembelian', [
            'transaksis' => $this->transaksi(),
        ]);
    }
}
