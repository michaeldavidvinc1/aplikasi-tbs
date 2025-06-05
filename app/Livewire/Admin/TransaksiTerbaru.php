<?php

namespace App\Livewire\Admin;

use App\Models\TbsOffer;
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
        return view('livewire.admin.transaksi-terbaru', [
            'penawarans' => $this->penawaran
        ]);
    }
}
