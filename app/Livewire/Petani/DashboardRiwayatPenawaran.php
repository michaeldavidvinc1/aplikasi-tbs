<?php

namespace App\Livewire\Petani;

use App\Models\TbsOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardRiwayatPenawaran extends Component
{
    #[\Livewire\Attributes\Computed]
    public function penawaran()
    {
        return TbsOffer::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.petani.dashboard-riwayat-penawaran', [
            'penawarans' => $this->penawaran,
        ]);
    }
}
