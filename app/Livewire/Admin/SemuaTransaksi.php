<?php

namespace App\Livewire\Admin;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        return view('livewire.admin.semua-transaksi', [
            'pembayarans' => $this->pembayaran,
        ]);
    }
}
