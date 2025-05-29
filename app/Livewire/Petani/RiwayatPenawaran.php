<?php

namespace App\Livewire\Petani;

use App\Models\TbsOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatPenawaran extends Component
{
    use  WithPagination;

    public $status = '';
    public $tanggal = '';

    #[\Livewire\Attributes\Computed]
    public function penawaran()
    {
        return TbsOffer::query()
            ->where('user_id', Auth::id())
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->tanggal, fn($q) => $q->whereDate('created_at', Carbon::parse($this->tanggal)))
            ->latest()
            ->paginate(10);
    }



    public function render()
    {
        return view('livewire.petani.riwayat-penawaran', [
            'penawarans' => $this->penawaran,
        ]);
    }

    public function updatingStatus() { $this->resetPage(); }
    public function updatingTanggal() { $this->resetPage(); }
}
