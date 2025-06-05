<?php

namespace App\Livewire\Pabrik;

use App\Models\Invoice;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class TransaksiAktif extends Component
{

    use  WithPagination;

    public $tanggal = '';

    #[\Livewire\Attributes\Computed]
    public function transaksi()
    {
        return Transaksi::with('offer')
            ->where('status', 'belum bayar')
            ->when($this->tanggal, fn($q) => $q->whereDate('created_at', Carbon::parse($this->tanggal)))
            ->latest()
            ->paginate(10);
    }

    public function bayar($id){
        $transaksi = Transaksi::with('offer.user')->findOrFail($id);
//        dd($transaksi->toArray());
        DB::beginTransaction();
        try {
            $transaksi->status = 'sudah bayar';

            $pdf = Pdf::loadView('doc.invoice', compact('transaksi'));
            $fileName = 'invoice_' . Str::random(20) . '.pdf';
            $path = 'invoices/' . $fileName;
            Storage::disk('public')->put($path, $pdf->output());

            Invoice::create([
                'transaksi_id' =>  $transaksi->id,
                'file_path' => $path,
            ]);
            $transaksi->save();

            DB::commit();
            toastr()->success('Pembayaran sukses dilakukan!');
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

    public function render()
    {
        return view('livewire.pabrik.transaksi-aktif', [
            'transaksis' => $this->transaksi,
        ]);
    }
}
