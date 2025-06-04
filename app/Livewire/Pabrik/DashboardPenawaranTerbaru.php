<?php

namespace App\Livewire\Pabrik;

use App\Models\TbsOffer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardPenawaranTerbaru extends Component
{
    #[\Livewire\Attributes\Computed]
    public function penawaran()
    {
        return TbsOffer::with('user')
            ->latest()
            ->paginate(5);
    }
    public function render()
    {
        return view('livewire.pabrik.dashboard-penawaran-terbaru', [
            'penawarans' => $this->penawaran,
        ]);
    }
}
