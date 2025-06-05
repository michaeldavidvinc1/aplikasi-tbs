<?php

namespace App\Livewire\Petani;

use App\Models\Transaksi;
use App\Models\Invoice as ModelsInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Invoice extends Component
{

    use  WithPagination;

    public $tanggal = '';

    #[\Livewire\Attributes\Computed]
    public function invoice()
    {
        return ModelsInvoice::with(['transaksi.offer'])
            ->whereHas('transaksi.offer', fn($q) => $q->where('user_id', Auth::id()))
            ->when($this->tanggal, fn($q) => $q->whereDate('created_at', Carbon::parse($this->tanggal))
            )
            ->latest()
            ->paginate(10);
    }


    public function render()
    {
        return view('livewire.petani.invoice', [
            'invoices' => $this->invoice,
        ]);
    }
}
