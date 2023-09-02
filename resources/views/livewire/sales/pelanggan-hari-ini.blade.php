<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title m-0 me-2">
                <h5 class="m-0 me-2">Pelanggan Hari Ini</h5>
                <small class="text-muted">{{ $today->isoFormat('dddd, D MMMM Y') }}</small>
            </div>
        </div>
        <div class="card-body">
            <ul class="p-0 m-0">
                @if ($pelangganHariIni->count() == 0)
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <span class="alert-icon text-danger me-2">
                        <i class="ti ti-user ti-user-x"></i>
                    </span>
                    Upss.. Kamu belum input data pelanggan hari ini!
                </div>
                @else
                <div class="scroller">
                    @foreach ($pelangganHariIni as $data)
                        <li class="d-flex mb-3 pb-1 align-items-center">
                            <div class="badge bg-label-info me-3 rounded p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ $data->pelanggan->nama }}</h6>
                                    <small
                                        class="text-muted d-block">+{{ $data->pelanggan->prefix_hp }}{{ $data->pelanggan->no_hp }}</small>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <span
                                        class="badge @if ($data->pelanggan->jk == 'Laki-Laki') bg-success @else bg-danger @endif">{{ $data->pelanggan->jk }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </div>
                @endif
            </ul>
        </div>
    </div>
</div>
