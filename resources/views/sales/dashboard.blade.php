@extends('layouts.master')

@section('content')
    <div class="row">
        <!--TOTAL GAJI-->
        <div class="col-lg-5 col-12 mb-4">
            <div class="card h-100">
                <div class="d-flex align-items-end row">
                    <div class="col-7">
                        <div class="card-body text-nowrap">
                            <h5 class="card-title mb-0">
                                Hi, {{ $namaUser }}! 👋
                            </h5>
                            <p class="mb-4">Total insentif kamu di bulan <b class="text-primary">{{ $bulan }} {{ $tahun }}</b> :</p>
                            <h4 class="text-primary mb-2">{{ 'Rp ' . number_format($totalInsentif, 0, ',', '.') }}
                            </h4>
                            <a href="#" class="btn btn-primary" data-bs-toggle="collapse"
                                data-bs-target="#detailInsentif" aria-expanded="false" aria-controls="detailInsentif">Lihat
                                Rincian</a>

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

        <!--STATISTIK JUMLAH CUSTOMER CALL-->
        <div class="col-lg-7 col-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Jumlah Poin : <span class="badge bg-label-primary">{{ $totalPoin }}</span></h5>
                    <small class="text-primary"><b>{{ $bulan }} {{ $tahun }}</b></small>
                </div>
                <div class="card-body pt-1">
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
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="btn-group">
                                <button
                                  type="button"
                                  class="btn btn-primary dropdown-toggle"
                                  data-bs-toggle="dropdown"
                                  aria-expanded="false"
                                >
                                  Tambah
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="/sales/cold-call/tambah">{{ $coldCall }}</a></li>
                                  <li><a class="dropdown-item" href="/sales/warm-call/tambah">{{ $warmCall }}</a></li>
                                  <li><a class="dropdown-item" href="/sales/lead-generated/tambah">{{ $leadGenerated }}</a></li>
                                  <li><a class="dropdown-item" href="/sales/sales-closing/tambah">{{ $salesClosing }}</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!--DATA CUSTOMER TERAKHIR-->
        <div class="col-lg-4 col-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                  <div class="card-title mb-0">
                    <h5 class="mb-0">Data Customer Terbaru</h5>
                    <small class="text-muted">
                        @foreach ($customerTerakhir as $data)
                            @if ($loop->first)
                                Update Terakhir : {{ $data->created_at->diffForHumans() }}
                            @endif
                        @endforeach
                    </small>
                  </div>
                </div>
                <div class="card-body">
                    @if ($customerTerakhir->count() == 0)
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <span class="alert-icon text-danger me-2">
                            <i class="ti ti-user ti-user-x"></i>
                        </span>
                        Upss.. Kamu belum input data pelanggan.
                    </div>
                    @else
                    <ul class="list-unstyled mb-0">
                        @foreach ($customerTerakhir as $data)
                        <li @if ($loop->last) class="mb-0" @else class="mb-3" @endif>
                            <div class="d-flex align-items-start">
                            <div class="badge bg-label-secondary p-2 me-3 rounded">
                                <i class="ti ti-user ti-sm"></i>
                            </div>
                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ $data->pelanggan->nama }}</h6>
                                    <small class="text-muted">
                                        {{ $data->created_at->format('d/m/Y') }}
                                        <span class="badge
                                        @if ($data->status_sales == $coldCall)
                                            bg-info
                                        @elseif ($data->status_sales == $warmCall)
                                            bg-danger
                                        @elseif ($data->status_sales == $leadGenerated)
                                            bg-warning
                                        @else
                                            bg-success
                                        @endif
                                        ">
                                            {{ $data->status_sales }}
                                        </span>
                                    </small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="https://wa.me/{{ $data->pelanggan->prefix_hp }}{{ $data->pelanggan->no_hp }}">
                                        <i class="ti ti-brand-whatsapp text-success"></i>
                                    </a>
                                </div>
                            </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                </div>
              </div>
        </div>

        <!--CHART GARIS JUMLAH CALL BULANAN-->
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header header-elements">
                    <div>
                        <h5 class="card-title mb-0">Statistik Jumlah Customer Call</h5>
                        <small class="text-muted">Periode : <b class="text-primary">{{ $bulan }} {{ $tahun }}</b></small>
                    </div>
                    <div class="card-header-elements ms-auto py-1">
                        <h5 class="fw-bold mb-0 me-3">Total : <span class="badge bg-label-primary">{{ $jumlahCallBulanan }}</span></h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <canvas id="lineChart" class="chartjs" data-height="400"></canvas>
                    </div>

                    <div class="row mt-1">
                        <div class="col-lg-3 col-12">
                            <button type="button" class="btn btn-info btn-sm">
                                {{ $coldCall }}
                            <span class="badge bg-white text-info badge-center ms-1">{{ $jumlahColdCall }}</span>
                        </div>

                        <div class="col-lg-3 col-12">
                            <button type="button" class="btn btn-danger btn-sm">
                                {{ $warmCall }}
                            <span class="badge bg-white text-danger badge-center ms-1">{{ $jumlahWarmCall }}</span>
                        </div>

                        <div class="col-lg-3 col-12">
                            <button type="button" class="btn btn-warning btn-sm">
                                {{ $leadGenerated }}
                            <span class="badge bg-white text-warning badge-center ms-1">{{ $jumlahLeadGenerated }}</span>
                        </div>

                        <div class="col-lg-3 col-12">
                            <button type="button" class="btn btn-success btn-sm">
                                {{ $salesClosing }}
                            <span class="badge bg-white text-success badge-center ms-1">{{ $jumlahSalesClosing }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('vendorScript')
<script src="{{ asset('style/assets/vendor/libs/chartjs/chartjs.js') }}"></script>
@endpush

@push('pageScript')
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


        // Line Chart
        // --------------------------------------------------------------------

        const lineChart = document.getElementById('lineChart');
        if (lineChart) {
            const lineChartVar = new Chart(lineChart, {
                type: 'line',
                data: {
                    labels: ['Pekan 1', 'Pekan 2', 'Pekan 3', 'Pekan 4', 'Pekan 5'
                    ],
                    datasets: [{
                            data: [
                                @foreach ($coldCallBulanan as $cold)
                                    {{ $cold->sales->where('pekan', $cold->pekan)->count() }},
                                @endforeach
                            ],
                            label: '{{ $coldCall }}',
                            borderColor: config.colors.info,
                            tension: 0.5,
                            pointStyle: 'circle',
                            backgroundColor: config.colors.info,
                            fill: false,
                            pointRadius: 1,
                            pointHoverRadius: 5,
                            pointHoverBorderWidth: 5,
                            pointBorderColor: 'transparent',
                            pointHoverBorderColor: cardColor,
                            pointHoverBackgroundColor: config.colors.info
                        },
                        {
                            data: [
                                @foreach ($warmCallBulanan as $warm)
                                    {{ $warm->sales->where('pekan', $warm->pekan)->count() }},
                                @endforeach
                            ],
                            label: '{{ $warmCall }}',
                            borderColor: config.colors.danger,
                            tension: 0.5,
                            pointStyle: 'circle',
                            backgroundColor: config.colors.danger,
                            fill: false,
                            pointRadius: 1,
                            pointHoverRadius: 5,
                            pointHoverBorderWidth: 5,
                            pointBorderColor: 'transparent',
                            pointHoverBorderColor: cardColor,
                            pointHoverBackgroundColor: config.colors.danger
                        },
                        {
                            data: [
                                @foreach ($leadGeneratedBulanan as $lead)
                                    {{ $lead->sales->where('pekan', $lead->pekan)->count() }},
                                @endforeach
                            ],
                            label: '{{ $leadGenerated }}',
                            borderColor: config.colors.warning,
                            tension: 0.5,
                            pointStyle: 'circle',
                            backgroundColor: config.colors.warning,
                            fill: false,
                            pointRadius: 1,
                            pointHoverRadius: 5,
                            pointHoverBorderWidth: 5,
                            pointBorderColor: 'transparent',
                            pointHoverBorderColor: cardColor,
                            pointHoverBackgroundColor: config.colors.warning
                        },
                        {
                            data: [
                                @foreach ($salesClosingBulanan as $lead)
                                    {{ $lead->sales->where('pekan', $lead->pekan)->count() }},
                                @endforeach
                            ],
                            label: '{{ $salesClosing }}',
                            borderColor: config.colors.success,
                            tension: 0.5,
                            pointStyle: 'circle',
                            backgroundColor: config.colors.success,
                            fill: false,
                            pointRadius: 1,
                            pointHoverRadius: 5,
                            pointHoverBorderWidth: 5,
                            pointBorderColor: 'transparent',
                            pointHoverBorderColor: cardColor,
                            pointHoverBackgroundColor: config.colors.success
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: {
                                color: borderColor,
                                drawBorder: false,
                                borderColor: borderColor
                            },
                            ticks: {
                                color: labelColor
                            }
                        },
                        y: {
                            scaleLabel: {
                                display: true
                            },
                            min: 0,
                            max: {{ $maxData }},
                            ticks: {
                                color: labelColor,
                                stepSize: 1
                            },
                            grid: {
                                color: borderColor,
                                drawBorder: false,
                                borderColor: borderColor
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            // Updated default tooltip UI
                            rtl: isRtl,
                            backgroundColor: cardColor,
                            titleColor: headingColor,
                            bodyColor: legendColor,
                            borderWidth: 1,
                            borderColor: borderColor
                        },
                        legend: {
                            position: 'top',
                            align: 'start',
                            rtl: isRtl,
                            labels: {
                                usePointStyle: true,
                                padding: 10,
                                boxWidth: 6,
                                boxHeight: 6,
                                color: legendColor
                            }
                        }
                    }
                }
            });
        }

    })();
</script>
@endpush
