<div>
    <!--Modal Tambah Customer-->
    <div class="modal fade" id="tambahCustomer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-2">
                        <h3 class="mb-2">Tambah Customer</h3>
                        <p class="text-muted">Isi data untuk custmer dengan progress <b>Cold Call</b></p>
                    </div>
                    <form id="editUserForm" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nomor HP</label>
                            <div class="input-group">
                                <span class="input-group-text">ID (+62)</span>
                                <input type="number" name="no_hp" class="form-control phone-number-mask"
                                    placeholder="85775745484" step="any" required />
                            </div>
                            <input type="hidden" value="62" name="prefix_hp">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required />
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="jk" id="lakiLaki" required />
                                <label class="form-check-label" for="lakiLaki">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="perempuan" />
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Provinsi</label>
                            <select name="provinsi_id" class="form-select" data-allow-clear="true"
                                wire:model="pilihProvinsi">
                                <option value="">--Pilih--</option>
                                @foreach ($provinsi as $data)
                                    <option value="{{ $data->id }}" selected>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Kabupaten</label>
                            <select name="kabupaten_id" class="form-select" data-allow-clear="true"
                                wire:model="pilihKabupaten">
                                <option value="">--Pilih--</option>
                                @foreach ($kabupaten as $data)
                                    <option value="{{ $data->id }}" selected>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserLastName">Last Name</label>
                            <input type="text" id="modalEditUserLastName" name="modalEditUserLastName"
                                class="form-control" placeholder="Doe" />
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
