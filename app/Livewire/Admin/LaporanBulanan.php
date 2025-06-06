<?php

namespace App\Livewire\Admin;

use App\Models\Transaksi;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanBulanan extends Component
{
    use  WithPagination;

    public $bulan;
    public $tahun;

    #[\Livewire\Attributes\Computed]
    public function pembayaran()
    {
        return Transaksi::with('offer.user')
            ->when($this->bulan, fn($q) => $q->whereMonth('created_at', $this->bulan))
            ->when($this->tahun, fn($q) => $q->whereYear('created_at', $this->tahun))
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.laporan-bulanan', [
            'pembayarans' => $this->pembayaran,
        ]);
    }
}
