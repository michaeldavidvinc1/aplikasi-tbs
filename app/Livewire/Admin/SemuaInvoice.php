<?php

namespace App\Livewire\Admin;

use App\Models\Invoice as ModelsInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SemuaInvoice extends Component
{
    use  WithPagination;

    public $tanggal = '';

    #[\Livewire\Attributes\Computed]
    public function invoice()
    {
        return ModelsInvoice::with(['transaksi.offer.user'])
            ->when($this->tanggal, fn($q) => $q->whereDate('created_at', Carbon::parse($this->tanggal))
            )
            ->latest()
            ->paginate(10);
    }
    public function render()
    {
        return view('livewire.admin.semua-invoice', [
            'invoices' => $this->invoice,
        ]);
    }
}
