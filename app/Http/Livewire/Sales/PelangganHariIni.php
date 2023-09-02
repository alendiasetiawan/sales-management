<?php

namespace App\Http\Livewire\Sales;

use Carbon\Carbon;
use App\Models\Sales;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PelangganHariIni extends Component
{
    public $tanggal;
    public $today;
    public $jenisCall;

    protected $listeners = [
        'simpanDataCustomer' => 'render'
    ];

    public function render()
    {
        $pegawaiNip = Auth::user()->email;

        $data = [
            'pelangganHariIni' => Sales::pelangganHariIni($pegawaiNip, $this->tanggal, $this->jenisCall),
        ];

        return view('livewire.sales.pelanggan-hari-ini', $data);
    }
}
