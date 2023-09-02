@extends('layouts.master')

@push('vendorCss')
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('style/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
@endpush

@section('breadcrumb')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Laporan Sales /</span> Bulanan
    </h4>
@endsection

@section('content')
    <div class="row">
        <!--CHART PIE JUMLAH CALL-->
        <div class="col-lg-5 col-12 mb-4">
            <div class="card">
                <h5 class="card-header">
                    Jumlah Customer Call - <b class="text-primary">{{ $bulan }} {{ $tahun }}</b>
                    <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span class="ti ti-caret-down"></span>
                    </button>
                    @if ($cari == 1)
                        <button type="button" class="btn btn-icon btn-danger"
                            onclick="location.href='/sales/laporan-sales-bulanan'">
                            <span class="ti ti-refresh"></span>
                        </button>
                    @endif
                    <div class="collapse mt-2" id="collapseExample">
                        <div class="d-grid d-sm-flex p-3 border">
                            <form class="form" method="GET" action="/sales/laporan-sales-bulanan">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <label class="form-label">Bulan</label>
                                        <select class="form-select" name="pilihBulan" required>
                                            <option>{{ $bulan }}</option>
                                            @foreach ($refBulan as $data)
                                                @if ($data->bulan != $bulan)
                                                    <option>{{ $data->bulan }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-2">
                                        <label class="form-label">Tahun</label>
                                        <select class="form-select" name="pilihTahun" required>
                                            @php
                                                $tahun1 = $tahun - 1;
                                                $tahun2 = $tahun - 2;
                                            @endphp
                                            <option>{{ $tahun }}</option>
                                            <option>{{ $tahun1 }}</option>
                                            <option>{{ $tahun2 }}</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <button class="btn btn-primary me-sm-3 me-1" type="submit">Lihat</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </h5>
                <div class="card-body">
                    @if ($jumlahCall == 0)
                        <div class="alert alert-danger d-flex align-items-center mt-2" role="alert">
                            <span class="alert-icon text-danger me-2">
                                <i class="ti ti-user ti-user-x"></i>
                            </span>
                            Tidak ada data pelanggan yang bisa ditampilkan, silahkan ganti bulan!
                        </div>
                    @else
                        <span class="badge bg-label-primary">
                            Total : {{ $jumlahCall }}
                        </span>
                        <canvas id="doughnutChart" class="chartjs mb-4" data-height="300"></canvas>
                    @endif

                    <div class="row">
                        <div class="col-6 mb-2">
                            <li class="ct-series-0 d-flex flex-column">
                                <h6 class="mb-0 fw-bold">Cold Call</h6>
                                <button type="button" class="btn btn-info btn-sm">
                                    {{ $persenColdCall }}%
                                    <span class="badge bg-white text-info badge-center ms-1">{{ $jumlahColdCall }}</span>
                            </li>
                        </div>

                        <div class="col-6 mb-2">
                            <li class="ct-series-1 d-flex flex-column">
                                <h6 class="mb-0 fw-bold">Warm Call</h6>
                                <button type="button" class="btn btn-danger btn-sm">
                                    {{ $persenWarmCall }}%
                                    <span class="badge bg-white text-danger badge-center ms-1">{{ $jumlahWarmCall }}</span>
                            </li>
                        </div>

                        <div class="col-6">
                            <li class="ct-series-2 d-flex flex-column">
                                <h6 class="mb-0 fw-bold">Lead Generated</h6>
                                <button type="button" class="btn btn-warning btn-sm">
                                    {{ $persenLeadGenerated }}%
                                    <span
                                        class="badge bg-white text-warning badge-center ms-1">{{ $jumlahLeadGenerated }}</span>
                            </li>
                        </div>

                        <div class="col-6">
                            <li class="ct-series-4 d-flex flex-column">
                                <h6 class="mb-0 fw-bold">Sales Closing</h6>
                                <button type="button" class="btn btn-success btn-sm">
                                    {{ $persenSalesClosing }}%
                                    <span
                                        class="badge bg-white text-success badge-center ms-1">{{ $jumlahSalesClosing }}</span>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--STATISTIK POIN DAN KOMISI-->
        <div class="col-lg-7 col-12">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Jumlah Poin : <span class="badge bg-label-primary">{{ $totalPoin }}</span></h5>
                        <small class="text-muted"><b class="text-primary">{{ $bulan }} {{ $tahun }}</b></small>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row gy-3">
                            <!--COLD CALL-->
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-info me-3 p-2">
                                        <i class="ti ti-phone-calling ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ $poinColdCall }} Poin</h5>
                                        <small>Cold Call</small>
                                    </div>
                                </div>
                            </div>

                            <!--WARM CALL-->
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                        <i class="ti ti-phone-call ti-sm"></i>
                                    </div>
                                    <div class="card-danger">
                                        <h5 class="mb-0">{{ $poinWarmCall }} Poin</h5>
                                        <small>Warm Call</small>
                                    </div>
                                </div>
                            </div>

                            <!--LEAD GENERATED-->
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-warning me-3 p-2">
                                        <i class="ti ti-id ti-sm"></i>
                                    </div>
                                    <div class="card-warning">
                                        <h5 class="mb-0">{{ $poinLeadGenerated }} Poin</h5>
                                        <small>Lead Generated</small>
                                    </div>
                                </div>
                            </div>

                            <!--SALES CLOSING-->
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                                        <i class="ti ti-coin ti-sm"></i>
                                    </div>
                                    <div class="card-success">
                                        <h5 class="mb-0">{{ $poinSalesClosing }} Poin</h5>
                                        <small>Sales Closing</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-7">
                            <div class="card-body text-nowrap">
                                <h5 class="card-title mb-0">Performa :
                                    @if ($totalPoin >= $poinExcellent)
                                        <b class="text-success">Excellent</b>
                                    @else
                                        <b class="text-danger">Evaluasi</b>
                                    @endif
                                </h5>
                                <p class="mb-2">Total insentif bulan <b class="text-primary">{{ $bulan }} {{ $tahun }}</b> :</p>
                                <h4 class="text-primary mb-1">{{ 'Rp ' . number_format($totalInsentif, 0, ',', '.') }}
                                </h4>
                                <a href="#" class="btn btn-primary" data-bs-toggle="collapse"
                                    data-bs-target="#detailInsentif" aria-expanded="false"
                                    aria-controls="detailInsentif">Lihat Rincian</a>

                                <div class="collapse mt-2" id="detailInsentif">
                                    Insentif : <b>{{ 'Rp ' . number_format($insentif, 0, ',', '.') }}</b> <br>
                                    Komisi Tambahan :
                                    <b>
                                        @if ($totalPoin >= $poinExcellent)
                                            {{ 'Rp ' . number_format($komisiTambahan, 0, ',', '.') }}
                                        @else
                                            0
                                        @endif
                                    </b>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('style/assets/img/illustrations/page-pricing-standard.png') }}"
                                    height="140" alt="view sales" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!--TABEL RIWAYAT CUSTOMER-->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Data Riwayat Customer - <b class="text-primary">{{ $bulan }} {{ $tahun }}</b></h4>
                    <table id="table" class="display wrap dataTable dtr-inline collapsed table table-striped"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="sorting" aria-controls="table" style="width: 5%;">No</th>
                                <th class="sorting" aria-controls="table" style="width: 20%;">Nama Customer</th>
                                <th class="sorting" aria-controls="table" style="width: 15%;">Nomor HP</th>
                                <th class="sorting" aria-controls="table" style="width: 15%;">Tanggal</th>
                                <th class="sorting" aria-controls="table" style="width: 10%;">Unit</th>
                                <th class="sorting" aria-controls="table" style="width: 10%;">Total Transaksi</th>
                                <th class="sorting" aria-controls="table" style="width: 10%;">Status</th>
                                <th class="sorting" aria-controls="table" style="width: 10%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($customer as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->pelanggan->nama }}</td>
                                    <td>+{{ $data->pelanggan->prefix_hp }}{{ $data->pelanggan->no_hp }}</td>
                                    <td>{{ $data->created_at->isoFormat('D MMMM Y') }}</td>
                                    <td>
                                        @if ($data->unit == NULL)
                                            -
                                        @else
                                        {{ $data->unit }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->harga_total == null)
                                            -
                                        @else
                                            {{ 'Rp ' . number_format($data->harga_total, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="badge
                                @if ($data->status_sales == $coldCall) bg-info
                                @elseif ($data->status_sales == $warmCall)
                                    bg-danger
                                @elseif ($data->status_sales == $leadGenerated)
                                    bg-warning
                                @else
                                    bg-success @endif
                                ">
                                            {{ $data->status_sales }}
                                        </span>
                                    </td>
                                    <td>
                                        <i class="ti ti-user-circle text-primary"></i>
                                        <a
                                            href="https://wa.me/{{ $data->pelanggan->prefix_hp }}{{ $data->pelanggan->no_hp }}">
                                            <i class="ti ti-brand-whatsapp text-success"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendorScript')
    <script src="{{ asset('style/assets/vendor/libs/chartjs/chartjs.js') }}"></script>
@endpush

@push('pageScript')
    <script src="{{ asset('style/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script>
        $(document).ready(function() {
            var lang = 'Indonesian';
            $('#table')
                .addClass('wrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [

                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/' + lang + '.json',
                        paginate: {
                            // remove previous & next text from pagination
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    }
                });
        });
    </script>

    <script>
        'use strict';

        (function() {
            // Color Variables
            const purpleColor = '#836AF9',
                yellowColor = '#ffe800',
                cyanColor = '#28dac6',
                orangeColor = '#FF8132',
                orangeLightColor = '#FDAC34',
                oceanBlueColor = '#299AFF',
                greyColor = '#4F5D70',
                greyLightColor = '#EDF1F4',
                blueColor = '#2B9AFF',
                blueLightColor = '#84D0FF';

            let cardColor, headingColor, labelColor, borderColor, legendColor;

            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                headingColor = config.colors_dark.headingColor;
                labelColor = config.colors_dark.textMuted;
                legendColor = config.colors_dark.bodyColor;
                borderColor = config.colors_dark.borderColor;
            } else {
                cardColor = config.colors.cardColor;
                headingColor = config.colors.headingColor;
                labelColor = config.colors.textMuted;
                legendColor = config.colors.bodyColor;
                borderColor = config.colors.borderColor;
            }

            // Set height according to their data-height
            // --------------------------------------------------------------------
            const chartList = document.querySelectorAll('.chartjs');
            chartList.forEach(function(chartListItem) {
                chartListItem.height = chartListItem.dataset.height;
            });

            // Doughnut Chart
            // --------------------------------------------------------------------

            const doughnutChart = document.getElementById('doughnutChart');
            if (doughnutChart) {
                const doughnutChartVar = new Chart(doughnutChart, {
                    type: 'doughnut',
                    data: {
                        labels: ['Cold Call', 'Warm Call', 'Lead Generated', 'Sales Closing'],
                        datasets: [{
                            data: [{{ $jumlahColdCall }}, {{ $jumlahWarmCall }},
                                {{ $jumlahLeadGenerated }}, {{ $jumlahSalesClosing }}
                            ],
                            backgroundColor: [config.colors.info, config.colors.danger, config.colors
                                .warning, config.colors.success
                            ],
                            borderWidth: 0,
                            pointStyle: 'rectRounded'
                        }]
                    },
                    options: {
                        responsive: true,
                        animation: {
                            duration: 300
                        },
                        cutout: '60%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.labels || '',
                                            value = context.parsed;
                                        const output = ' ' + label + ' : ' + value + ' Customer';
                                        return output;
                                    }
                                },
                                // Updated default tooltip UI
                                rtl: isRtl,
                                backgroundColor: cardColor,
                                titleColor: headingColor,
                                bodyColor: legendColor,
                                borderWidth: 1,
                                borderColor: borderColor
                            }
                        }
                    }
                });
            }
        })();
    </script>
@endpush
