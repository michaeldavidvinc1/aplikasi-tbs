<?php

namespace App\Livewire\Pimpinan;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TotalTransaksi extends Component
{
    public $labels = [];
    public $data = [];


    public function mount()
    {
        $results = DB::table('transaksis')
            ->join('tbs_offers', 'transaksis.offer_id', '=', 'tbs_offers.id')
            ->selectRaw("DATE_FORMAT(transaksis.created_at, '%Y-%m') as bulan_kode, MONTHNAME(transaksis.created_at) as nama_bulan, YEAR(transaksis.created_at) as tahun, SUM(transaksis.total_bayar) as total")
            ->where('transaksis.status', 'sudah bayar')
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
        return view('livewire.pimpinan.total-transaksi');
    }
}
