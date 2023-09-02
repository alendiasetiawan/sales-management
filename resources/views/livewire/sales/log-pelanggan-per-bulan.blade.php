<div class="row">
    <!--Log Call Pelanggan-->
    <div class="col-lg-8 col-12 mb-4">
        <div class="card">
            <h4 class="card-header">
                <span>Daftar Customer <b class="
                    @if ($jenisCall == $coldCall)
                    text-info
                    @elseif ($jenisCall == $warmCall)
                    text-danger
                    @else
                    text-warning
                    @endif
                    ">{{ $jenisCall }} - {{ $bulanAktif }} {{ $tahunAktif }}</b></span>
                <br>
                <button type="button" class="btn btn-sm btn-primary"
                @if ($jenisCall == $coldCall)
                onclick="location.href='/sales/cold-call/tambah'"
                @elseif ($jenisCall == $warmCall)
                onclick="location.href='/sales/warm-call/tambah'"
                @else
                onclick="location.href='/sales/lead-generated/tambah'"
                @endif
                >
                    <span class="ti-xs ti ti-circle-plus me-1"></span>
                    Tambah
                </button>
            </h4>
            <div class="card-body pb-0">
                <div class="col-md-4 col-12">
                    <label>Pilih Bulan</label>
                    <select class="form-select" wire:model="pilihBulan">
                        <option value="" selected>--Pilih--</option>
                        <option>Januari</option>
                        <option>Februari</option>
                        <option>Maret</option>
                        <option>April</option>
                        <option>Mei</option>
                        <option>Juni</option>
                        <option>Juli</option>
                        <option>Agustus</option>
                        <option>September</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Desember</option>
                    </select>
                </div>

                @if ($pelanggan->count() == 0)
                    <div class="alert alert-danger d-flex align-items-center mt-2" role="alert">
                        <span class="alert-icon text-danger me-2">
                            <i class="ti ti-user ti-user-x"></i>
                        </span>
                        Tidak ada data pelanggan yang bisa ditampilkan, silahkan ganti bulan!
                    </div>
                @else
                    <ul class="timeline mt-5 mb-0">
                        @foreach ($pelanggan as $data)
                            <li class="timeline-item timeline-item-danger pb-3 @if ($loop->last) border-0 @else border-left-dashed @endif">
                                <span class="timeline-indicator timeline-indicator-success">
                                    <i class="ti ti-user-circle"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h5 class="mb-0">{{ $data->pelanggan->nama }}</h5>
                                        <span class="text-muted">{{ $data->created_at->isoFormat('D MMMM Y') }}</span>
                                    </div>
                                    <p>
                                        {{ $data->pelanggan->nama_kabupaten }} - {{ $data->pelanggan->nama_provinsi }}
                                    </p>
                                    <hr />
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <p class="mb-0">
                                                    +{{ $data->pelanggan->prefix_hp }}{{ $data->pelanggan->no_hp }}</p>
                                                {{-- <span class="text-muted">{{ $data->pelanggan->nama_kabupaten }} - {{ $data->pelanggan->nama_provinsi }}</span> --}}
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-centers cursor-pointer">
                                            <i class="ti ti-user-circle me-2 text-primary"></i>
                                            <i class="ti ti-brand-whatsapp text-success"
                                            onclick="window.open('https://wa.me/{{ $data->pelanggan->prefix_hp }}{{ $data->pelanggan->no_hp }}', '_blank')"></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    {{ $pelanggan->links() }}
                @endif
            </div>
        </div>
    </div>

    <!--Statistik Pelanggan-->
    <div class="col-lg-4 col-12">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 me-2">{{ $pelanggan->count() }} Pelanggan</h5>
                        <small>Bulan {{ $bulanAktif }} {{ $tahunAktif }}</small>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-success rounded-pill p-2">
                            <i class="ti ti-chart-bar ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 me-2">{{ $pelangganTahunan }} Pelanggan</h5>
                        <small>Tahun {{ $tahunAktif }}</small>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-info rounded-pill p-2">
                            <i class="ti ti-calendar ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
