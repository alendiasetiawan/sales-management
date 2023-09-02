<?php

namespace App\Http\Livewire\Sales;

use Carbon\Carbon;
use App\Models\Sales;
use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Pelanggan;
use App\Models\PoinSales;
use App\Models\PoinSalesBulanan;
use App\Models\PoinSalesPekanan;
use App\Models\PoinSalesTahunan;
use App\Providers\JenisCallProvider;
use App\Services\PelangganService;
use App\Services\PoinSalesService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TambahCustomer extends Component
{
    public $today;
    public $provinsi;
    public $kabupaten = [];
    public $kecamatan = [];
    public $pilihProvinsi;
    public $pilihKabupaten;
    public $pilihKecamatan;
    public $namaProvinsi;
    public $namaKabupaten;
    public $namaKecamatan;
    public $idProvinsi;
    public $idKabupaten;
    public $idKecamatan;
    public $pelangganHariIni;
    public $kodePelanggan;

    public $noHp;
    public $prefixHp = 62;
    public $nama;
    public $jk;
    public $alamat;
    public $tanggal;
    public $poinCall;
    public $jenisCall;
    public $dataNoHp = NULL;
    public $dataLama = NULL;
    public $coldCall;
    public $warmCall;

    protected $pelangganService;
    protected $poinSalesService;

    public function mount() {
        $this->provinsi = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        $this->coldCall = JenisCallProvider::COLD_CALL;
        $this->warmCall = JenisCallProvider::WARM_CALL;
    }

    public function boot(PelangganService $pelanggan, PoinSalesService $poinSales) {
        $this->pelangganService = $pelanggan;
        $this->poinSalesService = $poinSales;
    }

    public function updatedPilihProvinsi() {
        $this->kabupaten = Kabupaten::where('provinsi_id', $this->pilihProvinsi)
        ->orderBy('nama_kabupaten', 'asc')
        ->get();

        $this->reset(['pilihKabupaten', 'pilihKecamatan']);
    }

    public function updatedPilihKabupaten() {
        $this->kecamatan = Kecamatan::where('kabupaten_id', $this->pilihKabupaten)
        ->orderBy('nama_kecamatan', 'asc')
        ->get();
    }

    public function gunakanDataLama($no_hp) {
        $this->dataLama = 1;

        $dataPelanggan = Pelanggan::where('no_hp', $no_hp)->first();
        $this->nama = $dataPelanggan->nama;
        $this->jk = $dataPelanggan->jk;
        $this->pilihProvinsi = $dataPelanggan->provinsi_id;
        $this->pilihKabupaten = $dataPelanggan->kabupaten_id;
        $this->pilihKecamatan = $dataPelanggan->kecamatan_id;
        $this->alamat = $dataPelanggan->alamat;
        $this->kodePelanggan = $dataPelanggan->kode;

        $provinsi = Provinsi::where('id', $this->pilihProvinsi)->first();
        $this->namaProvinsi = $provinsi->nama_provinsi;

        $kabupaten = Kabupaten::where('id', $this->pilihKabupaten)->first();
        $this->namaKabupaten = $kabupaten->nama_kabupaten;

        $kecamatan = Kecamatan::where('id', $this->pilihKecamatan)->first();
        $this->namaKecamatan = $kecamatan->nama_kecamatan;
    }

    public function simpanCustomer() {

        $pekanAktif = Carbon::now()->weekOfMonth;
        $bulanAktif = Carbon::now()->isoFormat('MMMM');
        $tahunAktif = Carbon::now()->format('Y');
        $pegawaiNip = Auth::user()->email;
        $dataLama = $this->dataLama;

        if($this->dataLama == 1) {
            $kodePelanggan = $this->kodePelanggan;
        } else {
            $kodePelanggan = $this->pelangganService->kodePelanggan($this->pilihKabupaten);
        }

        $poinPekanan = $this->poinSalesService->poinPekanan($pegawaiNip, $pekanAktif, $bulanAktif, $tahunAktif, $this->poinCall);
        $poinBulanan = $this->poinSalesService->poinBulanan($pegawaiNip, $bulanAktif, $tahunAktif, $this->poinCall);
        $poinTahunan = $this->poinSalesService->poinTahunan($pegawaiNip, $tahunAktif, $this->poinCall);

        DB::transaction(function () use($kodePelanggan, $pegawaiNip, $bulanAktif, $tahunAktif, $poinBulanan, $poinTahunan, $dataLama, $pekanAktif, $poinPekanan) {
            if ($dataLama != 1) {
                Pelanggan::create([
                    'kode' => $kodePelanggan,
                    'nama' => $this->nama,
                    'jk' => $this->jk,
                    'alamat' => $this->alamat,
                    'provinsi_id' => $this->pilihProvinsi,
                    'kabupaten_id' => $this->pilihKabupaten,
                    'kecamatan_id' => $this->pilihKecamatan,
                    'prefix_hp' => $this->prefixHp,
                    'no_hp' => $this->noHp,
                    'pegawai_nip' => $pegawaiNip,
                ]);
            }

            Sales::create([
                'pelanggan_kode' => $kodePelanggan,
                'pegawai_nip' => $pegawaiNip,
                'tanggal' => $this->tanggal,
                'status_sales' => $this->jenisCall,
                'pekan' => $pekanAktif,
                'bulan' => $bulanAktif,
                'tahun' => $tahunAktif,
                'poin' => $this->poinCall,
            ]);

            PoinSalesPekanan::updateOrCreate([
                'pegawai_nip' => $pegawaiNip,
                'pekan' => $pekanAktif,
                'bulan' => $bulanAktif,
                'tahun' => $tahunAktif,
            ], [
                'total_poin' => $poinPekanan,
            ]);

            PoinSalesBulanan::updateOrCreate([
                'pegawai_nip' => $pegawaiNip,
                'bulan' => $bulanAktif,
                'tahun' => $tahunAktif,
            ], [
                'total_poin' => $poinBulanan
            ]);

            PoinSalesTahunan::updateOrCreate([
                'pegawai_nip' => $pegawaiNip,
                'tahun' => $tahunAktif,
            ], [
                'total_poin' => $poinTahunan,
            ]);
        });

        $this->dispatchBrowserEvent('tambahCustomer');

        $this->reset([
            'noHp',
            'prefixHp',
            'nama',
            'jk',
            'alamat',
            'pilihProvinsi',
            'pilihKabupaten',
            'pilihKecamatan',
            'dataNoHp'
        ]);

        $this->emit('simpanDataCustomer');
    }

    public function updatedNoHp() {
        $hp = $this->noHp;

        $this->dataNoHp = Pelanggan::where('no_hp', $hp)->get();
    }

    public function render()
    {
        return view('livewire.sales.tambah-customer');
    }
}
