@extends('layouts.master')

@section('content')
    <div class="row">
        <!--CHART SALES CLOSING-->
        <div class="col-lg-4 col-12 mb-3">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <div class="card-title mb-auto">
                            <h4 class="mb-1 text-nowrap">Sales Closing</h4>
                            <small class="text-primary"><b>{{ $bulan }} {{ $tahun }}</b></small>
                        </div>
                        <div class="chart-statistics">
                            <h3 class="card-title mb-1">{{ 'Rp ' . number_format($transaksiPerBulan, 0, ',', '.') }}</h3>
                            <span class="badge bg-primary">
                                {{ $unitPerBulan }} Unit
                            </span>
                        </div>
                    </div>
                    <div id="generatedLeadsChart"></div>
                </div>
            </div>
        </div>

        <!--JUMLAH CUSTOMER CALL HARIAN-->
        @foreach ($salesHarian as $data)
            <div class="col-lg-2 col-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div
                            class="badge p-2
                        @if ($data->nama == $coldCall) bg-label-info
                        @elseif ($data->nama == $warmCall)
                            bg-label-danger
                        @elseif ($data->nama == $leadGenerated)
                            bg-label-warning
                        @else
                            bg-label-success @endif
                        mb-2 rounded">
                            <i
                                class="ti
                            @if ($data->nama == $coldCall) ti-phone-calling
                            @elseif ($data->nama == $warmCall)
                                ti-phone-call
                            @elseif ($data->nama == $leadGenerated)
                                ti-id
                            @else
                                ti-coin @endif
                            ti-sm"></i>
                        </div>
                        <h5 class="card-title mb-1 pt-1">{{ $data->nama }}</h5>
                        <small class="text-muted">{{ $hariIni }}</small>
                        <div class="pt-3">
                            <span class="badge bg-label-primary">
                                {{ $data->sales->where('status_sales', $data->nama)->count() }} Customer
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <!--DATA CUSTOMER CALL TERBARU-->
        <div class="col-lg-5 col-12 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title m-0 me-2 pt-1 mb-2">Data Customer Call Terbaru</h4>
                </div>
                <div class="card-body pb-0">
                    <ul class="timeline ms-1 mb-0">
                        @foreach ($customerTerakhir as $data)
                            <li class="timeline-item timeline-item-transparent ps-3 @if ($loop->last) border-0 @endif">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">{{ $data->pelanggan->nama }}</h6>
                                        <small class="text-muted">{{ $data->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">
                                        Up : {{ $data->pelanggan->nama_pegawai }}
                                    </p>
                                    <div class="d-flex flex-wrap pt-1">
                                        <span
                                        @if ($data->status_sales == $coldCall)
                                            class="badge bg-label-info"
                                        @elseif ($data->status_sales == $warmCall)
                                            class="badge bg-label-danger"
                                        @elseif ($data->status_sales == $leadGenerated)
                                            class="badge bg-label-warning"
                                        @else
                                            class="badge bg-label-success"
                                        @endif
                                        >{{ $data->status_sales }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!--CHART GARIS JUMLAH CALL BULANAN-->
        <div class="col-lg-7 col-12">
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
    <script src="{{ asset('style/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/chartjs/chartjs.js') }}"></script>
@endpush

@push('pageScript')
    <script>
        /**
         * Statistics Cards
         */

        'use strict';

        (function() {
            let cardColor, shadeColor, labelColor, headingColor, barBgColor, borderColor;

            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                labelColor = config.colors_dark.textMuted;
                headingColor = config.colors_dark.headingColor;
                shadeColor = 'dark';
                barBgColor = '#8692d014';
                borderColor = config.colors_dark.borderColor;
            } else {
                cardColor = config.colors.cardColor;
                labelColor = config.colors.textMuted;
                headingColor = config.colors.headingColor;
                shadeColor = '';
                barBgColor = '#4b465c14';
                borderColor = config.colors.borderColor;
            }

            // Donut Chart Colors
            const chartColors = {
                donut: {
                    series1: config.colors.success,
                    series2: '#28c76fb3',
                    series3: '#28c76f80',
                    series4: config.colors_label.success
                }
            };

            // Generated Leads Chart
            // --------------------------------------------------------------------
            const generatedLeadsChartEl = document.querySelector('#generatedLeadsChart'),
                generatedLeadsChartConfig = {
                    chart: {
                        height: 147,
                        width: 130,
                        parentHeightOffset: 0,
                        type: 'donut'
                    },
                    labels: ['{{ $coldCall }}', '{{ $warmCall }}', '{{ $leadGenerated }}',
                        '{{ $salesClosing }}'
                    ],
                    series: [
                        @foreach ($salesBulanan as $data)
                            {{ $data->sales->where('status_sales', $data->nama)->count() }},
                        @endforeach
                    ],
                    colors: [
                        chartColors.donut.series1,
                        chartColors.donut.series2,
                        chartColors.donut.series3,
                        chartColors.donut.series4,
                    ],
                    stroke: {
                        width: 0
                    },
                    dataLabels: {
                        enabled: false,
                        formatter: function(val, opt) {
                            return parseInt(val) + '%';
                        }
                    },
                    legend: {
                        show: false
                    },
                    tooltip: {
                        theme: false
                    },
                    grid: {
                        padding: {
                            top: 15,
                            right: -20,
                            left: -20
                        }
                    },
                    states: {
                        hover: {
                            filter: {
                                type: 'none'
                            }
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    value: {
                                        fontSize: '1.375rem',
                                        fontFamily: 'Public Sans',
                                        color: headingColor,
                                        fontWeight: 600,
                                        offsetY: -15,
                                        formatter: function(val) {
                                            return parseInt(val) + '%';
                                        }
                                    },
                                    name: {
                                        offsetY: 20,
                                        fontFamily: 'Public Sans'
                                    },
                                    total: {
                                        show: true,
                                        showAlways: true,
                                        color: config.colors.success,
                                        fontSize: '.8125rem',
                                        label: 'Total',
                                        fontFamily: 'Public Sans',
                                        formatter: function(w) {
                                            return '{{ $totalSalesClosing }}';
                                        }
                                    }
                                }
                            }
                        }
                    }
                };
            if (typeof generatedLeadsChartEl !== undefined && generatedLeadsChartEl !== null) {
                const generatedLeadsChart = new ApexCharts(generatedLeadsChartEl, generatedLeadsChartConfig);
                generatedLeadsChart.render();
            }
        })();
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
