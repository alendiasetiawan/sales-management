<?php

namespace App\Http\Livewire\Sales;

use Carbon\Carbon;
use App\Models\Sales;
use App\Providers\JenisCallProvider;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class LogPelangganPerBulan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $jenisCall;
    public $pilihBulan;

    public function render()
    {
        if ($this->pilihBulan == NULL) {
            $bulanAktif = Carbon::now()->isoFormat('MMMM');
        } else {
            $bulanAktif = $this->pilihBulan;
        }

        $tahunAktif = Carbon::now()->format('Y');
        $pegawaiNip = Auth::user()->email;

        $data = [
            'bulanAktif' => $bulanAktif,
            'tahunAktif' => $tahunAktif,
            'pelanggan' => Sales::pelangganPerBulan($pegawaiNip, $bulanAktif, $this->jenisCall),
            'pelangganTahunan' => Sales::where('pegawai_nip', Auth::user()->email)
            ->where('tahun', $tahunAktif)
            ->where('status_sales', $this->jenisCall)
            ->count(),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
        ];

        return view('livewire.sales.log-pelanggan-per-bulan', $data);
    }
}
