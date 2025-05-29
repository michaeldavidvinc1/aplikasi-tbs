<?php

namespace App\Livewire\Pabrik;

use App\Models\HargaTbs;
use App\Models\TbsOffer;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PenawaranMasuk extends Component
{
    use  WithPagination;

    public $tanggal = '';

    #[\Livewire\Attributes\Computed]
    public function penawaran()
    {
        return TbsOffer::query()
            ->where('status', '=', 'menunggu')
            ->when($this->tanggal, fn($q) => $q->whereDate('created_at', Carbon::parse($this->tanggal)))
            ->latest()
            ->paginate(10);
    }

    public function tolakAlert($id){
        LivewireAlert::title('Tolak Penawaran?')
            ->warning()
            ->text('Apakah kamu yakin ingin menolak penawaran ini?')
            ->withConfirmButton()
            ->confirmButtonText('Ya, Tolak')
            ->onConfirm('tolak', ['id' => $id])
            ->withCancelButton()
            ->cancelButtonText('Batal')
            ->cancelButtonColor('red')
            ->show();
    }

    public function setujuAlert($id){
        LivewireAlert::title('Setujui Penawaran?')
            ->info()
            ->text('Apakah kamu yakin ingin menyetujui penawaran ini?')
            ->withConfirmButton()
            ->confirmButtonText('Ya, Setujui')
            ->onConfirm('setuju', ['id' => $id])
            ->withCancelButton()
            ->cancelButtonText('Batal')
            ->cancelButtonColor('#d33')
            ->show();
    }

    public function setuju($payload){
        $id = $payload['id'];
        DB::beginTransaction();
        try {
            $offer = TbsOffer::findOrFail($id);
            $offer->status = 'terima';
            $offer->save();

            $harga = HargaTbs::where('berlaku', '>', Carbon::now())->latest()->first();

            if(!$harga){
                throw new \Exception('Harga tidak ditemukan');
            }

            Transaksi::create([
                'offer_id' => $offer->id,
                'harga_beli' => $harga->harga_per_kilo,
                'total_bayar' =>  $harga->harga_per_kilo * $offer->berat,
            ]);

            DB::commit();
            toastr()->success('Penawaran berhasil diterima');
        } catch (\Exception $ex){
            DB::rollback();
            \Log::error('Gagal menolak penawaran: ' . $ex->getMessage());
            LivewireAlert::title('Error!')
                ->text($ex->getMessage())
                ->error()
                ->withCancelButton('OK')
                ->show();
        }
    }

    public function tolak($payload){
        $id = $payload['id'];
        DB::beginTransaction();
        try {
            $offer = TbsOffer::findOrFail($id);
            $offer->status = 'tolak';
            $offer->save();
            DB::commit();
            toastr()->success('Penawaran berhasil ditolak');
        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error('Gagal menolak penawaran: ' . $ex->getMessage());
            if ($ex->getMessage() === 'Harga terbaru tidak ditemukan') {
                LivewireAlert::title('Harga terbaru tidak ditemukan. Mohon hubungi admin.')->warning();
            } else {
                LivewireAlert::title($ex->getMessage())->error();
            }
        }
    }

    public function render()
    {
        return view('livewire.pabrik.penawaran-masuk', [
            'penawarans' => $this->penawaran,
        ]);
    }

    public function updatingTanggal() { $this->resetPage(); }
}
