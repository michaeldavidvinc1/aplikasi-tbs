<?php

namespace App\Livewire\Petani;

use App\Models\HargaTbs;
use App\Models\TbsOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class KirimPenawaran extends Component
{

    public $hargaTbs;
    #[Validate('required|numeric')]
    public $tonase;
    #[Validate('required')]
    public $kualitas;
    #[Validate('required')]
    public $supir;
    #[Validate('required')]
    public $plat;
    #[Validate('required')]
    public $lokasi;

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {

            if(!$this->hargaTbs){
                throw new \Exception('Harga TBS kosong, silahkan hubungi admin');
            }

            TbsOffer::create([
                'user_id' => Auth::user()->id,
                'tonase' => $this->tonase,
                'kualitas' => $this->kualitas,
                'supir' => $this->supir,
                'plat' => $this->plat,
                'lokasi' => $this->lokasi,
            ]);

            DB::commit();
            toastr()->success('Penawaran berhasil dikirim');
            $this->reset(['tonase', 'kualitas', 'lokasi', 'supir', 'plat']);
        } catch (\Exception $ex){
            DB::rollback();
            \Log::error('Error: ' . $ex->getMessage());
            LivewireAlert::title('Error!')
                ->text($ex->getMessage())
                ->error()
                ->withCancelButton('OK')
                ->show();
        }
    }

    public function render()
    {
        $this->hargaTbs = HargaTbs::where('berlaku', '>', Carbon::now())->latest()->first();
        return view('livewire.petani.kirim-penawaran',[
            'harga' => $this->hargaTbs
        ]);
    }
}
