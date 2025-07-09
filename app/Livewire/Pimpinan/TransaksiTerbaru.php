<?php

namespace App\Livewire\Pimpinan;

use App\Models\Transaksi;
use Livewire\Component;

class TransaksiTerbaru extends Component
{
    #[\Livewire\Attributes\Computed]
    public function penawaran()
    {
        return Transaksi::with('offer.user')
            ->latest()
            ->paginate(5);
    }
    public function render()
    {
        return view('livewire.pimpinan.transaksi-terbaru', [
            'penawarans' => $this->penawaran
        ]);
    }
}
