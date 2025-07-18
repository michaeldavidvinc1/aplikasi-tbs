<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TonaseMasuk extends Component
{
    public $labels = [];
    public $data = [];


    public function mount()
    {

        $results = DB::table('tbs_offers')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as bulan_kode, MONTHNAME(created_at) as nama_bulan, YEAR(created_at) as tahun, SUM(tonase) as total")
            ->where('status', 'terima')
            ->groupBy('bulan_kode', 'nama_bulan', 'tahun')
            ->orderBy('bulan_kode')
            ->get();

        foreach ($results as $row) {
            $this->labels[] = "{$row->nama_bulan} {$row->tahun}";
            $this->data[] = $row->total;
        }

    }
    public function render()
    {
        return view('livewire.admin.tonase-masuk');
    }
}
