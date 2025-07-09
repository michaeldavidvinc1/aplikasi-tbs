<?php

namespace App\Livewire\Pimpinan;

use App\Models\Transaksi;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class SemuaTransaksi extends Component
{
    use  WithPagination;

    public $status = '';
    public $tanggal = '';

    #[\Livewire\Attributes\Computed]
    public function pembayaran()
    {
        return Transaksi::with('offer.user')
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->tanggal, fn($q) => $q->whereDate('created_at', Carbon::parse($this->tanggal)))
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.pimpinan.semua-transaksi', [
            'pembayarans' => $this->pembayaran,
        ]);
    }
}
