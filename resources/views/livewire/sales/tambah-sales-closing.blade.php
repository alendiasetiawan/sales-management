<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="simpanCustomer" class="row g-3">
                @csrf
                <!--Nomor HP-->
                <div class="col-12">
                    <label class="form-label">Nomor HP</label>
                    <div class="input-group">
                        <span class="input-group-text">ID (+62)</span>
                        <input wire:model="noHp" type="number" name="no_hp"
                            class="form-control phone-number-mask" placeholder="85775745484" step="any"
                            required oninvalid="this.setCustomValidity('Wajib mengisi nomor HP')"
                            oninput="this.setCustomValidity('')" />
                    </div>
                    @if ($dataNoHp != null)
                        @if ($dataNoHp->count() != 0)
                            @foreach ($dataNoHp as $data)
                                @if ($loop->last)
                                    <div class="form-text text-danger">
                                        Data pelanggan sudah ada,
                                        <a href="#" wire:click="gunakanDataLama({{ $data->no_hp }})"
                                            role="button" class="btn btn-sm btn-outline-success">
                                            <b>Gunakan Data Lama</b>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endif
                    <input type="hidden" value="62" name="prefix_hp" wire:model="prefixHp">
                </div>

                <!--Nama Lengkap-->
                <div class="col-12 col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input wire:model="nama" type="text" name="nama" class="form-control" required
                        oninvalid="this.setCustomValidity('Siapa namanya?')"
                        oninput="this.setCustomValidity('')" />
                </div>

                <!--Jenis Kelamin-->
                <div class="col-md-6 col-12">
                    <label class="form-label d-block">Jenis Kelamin</label>
                    <div class="form-check form-check-inline mt-3">
                        <input wire:model="jk" class="form-check-input" type="radio" name="jk"
                            id="lakiLaki" value="Laki-Laki" required
                            oninvalid="this.setCustomValidity('Anda lupa mengisi jenis kelamin?')"
                            oninput="this.setCustomValidity('')" />
                        <label class="form-check-label" for="lakiLaki">Laki-Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input wire:model="jk" class="form-check-input" type="radio" name="jk"
                            value="Perempuan" id="perempuan" />
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>

                <!--Provinsi-->
                @if ($dataLama == 1)
                    <div class="col-12 col-md-4">
                        <label class="form-label">Provinsi</label>
                        <input class="form-control" type="text" wire:model="namaProvinsi" disabled />
                    </div>
                @else
                    <div class="col-12 col-md-4">
                        <label class="form-label">Provinsi</label>
                        <select class="form-select" wire:model="pilihProvinsi" required
                        oninvalid="this.setCustomValidity('Tolong diisi ya!')"
                        oninput="this.setCustomValidity('')">
                            <option value="">--Pilih--</option>
                            @foreach ($provinsi as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!--Kabupaten-->
                @if ($dataLama == 1)
                    <div class="col-12 col-md-4">
                        <label class="form-label">Kabupaten</label>
                        <input class="form-control" type="text" wire:model="namaKabupaten" disabled />
                    </div>
                @else
                    <div class="col-12 col-md-4">
                        <label class="form-label">Kabupaten</label>
                        <select class="form-select" wire:model="pilihKabupaten" required
                        oninvalid="this.setCustomValidity('Tolong diisi ya!')"
                        oninput="this.setCustomValidity('')">
                            <option value="">--Pilih--</option>
                            @foreach ($kabupaten as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_kabupaten }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!--Kecamatan-->
                @if ($dataLama == 1)
                    <div class="col-12 col-md-4">
                        <label class="form-label">Kecamatan</label>
                        <input class="form-control" type="text" wire:model="namaKecamatan" disabled />
                    </div>
                @else
                    <div class="col-12 col-md-4">
                        <label class="form-label">Kecamatan</label>
                        <select class="form-select" wire:model="pilihKecamatan" required
                        oninvalid="this.setCustomValidity('Tolong diisi ya!')"
                        oninput="this.setCustomValidity('')">
                            <option value="">--Pilih--</option>
                            @foreach ($kecamatan as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!--Alamat Domisili-->
                <div class="col-12 col-md-6">
                    <label class="form-label">Alamat Domisili</label>
                    <textarea wire:model='alamat' class="form-control" rows="4" placeholder="Isi alamat dengan lengkap"
                        name="alamat" required
                        oninvalid="this.setCustomValidity('Dimana customer tinggal?')"
                        oninput="this.setCustomValidity('')"></textarea>
                </div>

                <!--Tanggal-->
                <div class="col-12 col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input class="form-control" type="text" value="{{ $today->isoFormat('D MMMM Y') }}"
                        disabled>
                    <input wire:model='tanggal' type="hidden" value="{{ $today->format('Y-m-d') }}">
                    <div class="form-text text-danger">Anda tidak bisa mengganti tanggal</div>
                </div>

                <!--Jumlah Poin-->
                <div class="col-12 col-md-3">
                    <label class="form-label">Jumlah Poin</label>
                    <input class="form-control" type="text" value="{{ $poinCall }}" disabled>
                    <input wire:model='poinCall' type="hidden" value="{{ $poinCall }}">
                </div>

                <!--Jumlah Unit-->
                <div class="col-12 col-md-6">
                    <label class="form-label">Unit</label>
                    <input class="form-control" type="number" step="any" wire:model="unit" required
                    oninvalid="this.setCustomValidity('Berapa jumlah barang yang terjual?')"
                    oninput="this.setCustomValidity('')">
                </div>

                <!--Total Transaksi-->
                <div class="col-12 col-md-6">
                    <label class="form-label">Total Transaksi</label>
                    <input class="form-control" type="text" wire:model="totalTransaksi" id="rupiah1" required
                    oninvalid="this.setCustomValidity('Berapa jumlah transaksinya?')"
                    oninput="this.setCustomValidity('')">
                </div>

                <input type="hidden" wire:mode="dataLama" value="{{ $dataLama }}"/>
                <input type="hidden" wire:mode="kodePelanggan" value="{{ $kodePelanggan }}"/>
                <!--Button-->

                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan</button>
                    <a href="/sales/sales-closing/tambah">
                        <button type="button" class="btn btn-outline-primary me-sm-3 me-1">Reset</button>
                    </a>
                    <a href="/sales/sales-closing">
                        <button type="button" class="btn btn-label-secondary">
                            Kembali
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
