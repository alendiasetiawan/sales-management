<?php

namespace App\Models;

use App\Providers\JenisCallProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $guarded = [];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_kode', 'kode');
    }

    public function refBulan(): BelongsTo
    {
        return $this->belongsTo(RefBulan::class, 'bulan', 'bulan');
    }

    public function poinSales(): BelongsTo
    {
        return $this->belongsTo(PoinSales::class, 'status_sales', 'nama');
    }

    public function refPekan(): BelongsTo
    {
        return $this->belongsTo(RefPekan::class, 'pekan', 'pekan');
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_nip', 'nip');
    }

    public function poinSalesPekanan(): BelongsTo
    {
        return $this->belongsTo(PoinSalesPekanan::class, 'pegawai_nip', 'pegawai_nip');
    }

    //Looping data customer terakhir
    public static function customerTerakhir($pegawaiNip) {
        return Sales::with([
            'pelanggan'
        ])
        ->where('pegawai_nip', $pegawaiNip)
        ->orderBy('id', 'desc')
        ->limit(7)
        ->get();
    }

    //Looping data customer terakhir Manager
    public static function customerTerakhirManager() {
        return Sales::with([
            'pelanggan' => function ($query) {
                $query->join('pegawai', 'pelanggan.pegawai_nip', 'pegawai.nip')
                ->select('pegawai.nama_pegawai', 'pelanggan.*');
            }
        ])
        ->orderBy('id', 'desc')
        ->limit(5)
        ->get();
    }

    //Data pelanggan per hari
    public static function pelangganHariIni($pegawaiNip, $tanggal, $jenisCall) {
        return Sales::with([
            'pelanggan'
        ])
        ->where('pegawai_nip', $pegawaiNip)
        ->where('tanggal', $tanggal)
        ->where('status_sales', $jenisCall)
        ->orderBy('id', 'desc')
        ->get();
    }

    //Data pelanggan per bulan
    public static function pelangganPerBulan($pegawaiNip, $bulan, $jenisCall) {
        return Sales::with([
            'pelanggan' => function ($query) {
                $query->join('provinsi', 'pelanggan.provinsi_id', 'provinsi.id')
                ->join('kabupaten', 'pelanggan.kabupaten_id', 'kabupaten.id');
            }
        ])
        ->where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('status_sales', $jenisCall)
        ->orderBy('id', 'desc')
        ->paginate(6);
    }

    //Data pelanggan per pekan
    public static function pelangganPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::with([
            'pelanggan' => function ($query) {
                $query->join('provinsi', 'pelanggan.provinsi_id', 'provinsi.id')
                ->join('kabupaten', 'pelanggan.kabupaten_id', 'kabupaten.id');
            }
        ])
        ->where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->orderBy('id', 'desc')
        ->get();
    }

    //Data pelanggan per pekan
    public static function pelangganPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::with([
            'pelanggan' => function ($query) {
                $query->join('provinsi', 'pelanggan.provinsi_id', 'provinsi.id')
                ->join('kabupaten', 'pelanggan.kabupaten_id', 'kabupaten.id');
            },
            'pegawai' => function ($query) {
                $query->where('role_id', 1);
            }
        ])
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->orderBy('id', 'desc')
        ->get();
    }

    //Data pelanggan per bulan
    public static function riwayatPelangganPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::with([
            'pelanggan' => function ($query) {
                $query->join('provinsi', 'pelanggan.provinsi_id', 'provinsi.id')
                ->join('kabupaten', 'pelanggan.kabupaten_id', 'kabupaten.id');
            }
        ])
        ->where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->orderBy('id', 'desc')
        ->get();
    }

    //Data pelanggan per tahun
    public static function riwayatPelangganPerTahun($pegawaiNip, $tahun) {
        return Sales::with([
            'pelanggan' => function ($query) {
                $query->join('provinsi', 'pelanggan.provinsi_id', 'provinsi.id')
                ->join('kabupaten', 'pelanggan.kabupaten_id', 'kabupaten.id');
            }
        ])
        ->where('pegawai_nip', $pegawaiNip)
        ->where('tahun', $tahun)
        ->orderBy('id', 'desc')
        ->get();
    }

    //Hitung jumlah call per pekan
    public static function jumlahCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->count();
    }

    //Hitung jumlah COLD call per pekan
    public static function jumlahColdCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->count();
    }

    //Hitung jumlah WARM call per pekan
    public static function jumlahWarmCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->count();
    }

    //Hitung jumlah Lead Generated per pekan
    public static function jumlahLeadGeneratedPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->count();
    }

    //Hitung jumlah Sales Closing per pekan
    public static function jumlahSalesClosingPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->count();
    }

    //Hitung jumlah total poin per pekan
    public static function totalPoinPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->sum('poin');
    }

    //Hitung jumlah poin Cold Call per pekan
    public static function poinColdCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->sum('poin');
    }

    //Hitung jumlah poin Warm Call per pekan
    public static function poinWarmCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->sum('poin');
    }

    //Hitung jumlah poin Lead Generated per pekan
    public static function poinLeadGeneratedPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->sum('poin');
    }

    //Hitung jumlah poin Sales Closing per pekan
    public static function poinSalesClosingPerPekan($pegawaiNip, $pekan, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->sum('poin');
    }

    //Hitung jumlah Cold Call per bulan
    public static function jumlahColdCallPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->count();
    }

    //Hitung jumlah Warm Call per bulan
    public static function jumlahWarmCallPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->count();
    }

    //Hitung jumlah Lead Generated per bulan
    public static function jumlahLeadGeneratedPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->count();
    }

    //Hitung jumlah Sales Closing per bulan
    public static function jumlahSalesClosingPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->count();
    }

    //Hitung jumlah semua Call per bulan
    public static function jumlahCallPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->count();
    }

    //Hitung jumlah poin Cold Call per bulan
    public static function poinColdCallPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->sum('poin');
    }

    //Hitung jumlah poin Warm Call per bulan
    public static function poinWarmCallPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->sum('poin');
    }

    //Hitung jumlah poin Lead Generated per bulan
    public static function poinLeadGeneratedPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->sum('poin');
    }

    //Hitung jumlah poin Sales Closing per bulan
    public static function poinSalesClosingPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->sum('poin');
    }

    //Hitung jumlah total poin per bulan
    public static function totalPoinPerBulan($pegawaiNip, $bulan, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->sum('poin');
    }

    //Loop data cold call per tahun
    public static function coldCallPerTahun($pegawaiNip, $tahun) {
        return RefBulan::with([
            'sales' => function ($query) use($tahun, $pegawaiNip) {
                $query->where('status_sales', JenisCallProvider::COLD_CALL)
                ->where('pegawai_nip', $pegawaiNip)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data warm call per tahun
    public static function warmCallPerTahun($pegawaiNip, $tahun) {
        return RefBulan::with([
            'sales' => function ($query) use($tahun, $pegawaiNip) {
                $query->where('status_sales', JenisCallProvider::WARM_CALL)
                ->where('pegawai_nip', $pegawaiNip)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data lead generated per tahun
    public static function leadGeneratedPerTahun($pegawaiNip, $tahun) {
        return RefBulan::with([
            'sales' => function ($query) use($tahun, $pegawaiNip) {
                $query->where('status_sales', JenisCallProvider::LEAD_GENERATED)
                ->where('pegawai_nip', $pegawaiNip)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data sales closing per tahun
    public static function salesClosingPerTahun($pegawaiNip, $tahun) {
        return RefBulan::with([
            'sales' => function ($query) use($tahun, $pegawaiNip) {
                $query->where('status_sales', JenisCallProvider::SALES_CLOSING)
                ->where('pegawai_nip', $pegawaiNip)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Hitung jumlah total poin sales per tahun
    public static function totalPoinPerTahun($pegawaiNip, $tahun) {
        return Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tahun', $tahun)
        ->sum('poin');
    }

    //Hitung jumlah Cold Call per bulan
    public static function coldCallPerBulanManager($bulan, $tahun) {
        return Sales::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->count();
    }

    //Hitung jumlah Warm Call per bulan
    public static function warmCallPerBulanManager($bulan, $tahun) {
        return Sales::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->count();
    }

    //Hitung jumlah Lead Generated per bulan
    public static function leadGeneratedPerBulanManager($bulan, $tahun) {
        return Sales::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->count();
    }

    //Hitung jumlah Sales Closing per bulan
    public static function salesClosingPerBulanManager($bulan, $tahun) {
        return Sales::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->count();
    }

}
