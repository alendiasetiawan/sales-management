<?php

namespace App\Http\Livewire\Sales;

use App\Models\Kabupaten;
use Livewire\Component;

class DaftarCustomerColdCall extends Component
{
    public $provinsi;
    public $kabupaten =[];
    public $pilihProvinsi;
    public $pilihKabupaten;

    public function updatedPilihProvinsi() {
        $this->kabupaten = Kabupaten::where('provinsi_id', $this->pilihProvinsi)->get();
    }

    public function render()
    {
        return view('livewire.sales.daftar-customer-cold-call');
    }
}
