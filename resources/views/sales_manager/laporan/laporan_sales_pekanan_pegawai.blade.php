@extends('layouts.master')

@push('vendorCss')
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
@endpush

@section('breadcrumb')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Laporan Sales Manager /</span> Pekanan
    </h4>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-primary"><b>{{ $dataPegawai->nama_pegawai }}</b></h3>
                    <form method="GET" action="/salesmanager/laporan-sales-pekanan/pegawai">
                        <div class="row">
                            <div class="col-lg-2 col-12">
                                <select class="form-select" name="pegawaiNip" required
                                oninvalid="this.setCustomValidity('Pilih pegawai dulu ya!')"
                                oninput="this.setCustomValidity('')">
                                    <option value="">--Pilih Pegawai--</option>
                                    @foreach ($pegawai as $data)
                                        <option value="{{ $data->nip }}">{{ $data->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-12">
                                <button class="btn btn-primary" type="submit">
                                    Lihat
                                </button>
                                <button class="btn btn-outline-danger" onclick="location.href='/salesmanager/laporan-sales-pekanan'" type="reset">
                                    Reset Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!--STATISTIK CUSTOMER CALL-->
        <div class="col-lg-7 col-12 mb-3">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">Statistik Jumlah Customer Call</h5>
                        <small class="text-muted">Pekan {{ $pekan }} {{ $bulanTahun }}</small>
                        {{-- <br>
                        <small class="text-muted">{{ $awalPekan }} - {{ $akhirPekan }}</small> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                            <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                                <h1 class="mb-0">Total : {{ $jumlahCall }}</h1>
                                {{-- <div class="badge rounded bg-label-success">+4.2%</div> --}}
                            </div>
                            <small class="text-muted">Total dari semua jenis customer call selama satu pekan</small>
                        </div>
                        <div class="col-12 col-md-8">
                            <div id="weeklyEarningReports"></div>
                        </div>
                    </div>
                    <div class="border rounded p-3 mt-2">
                        <div class="row gap-4 gap-sm-0">
                            <!--Cold Call-->
                            <div class="col-12 col-sm-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-info p-1">
                                        <i class="ti ti-phone-calling ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">Cold Call</h6>
                                </div>
                                <h4 class="my-2 pt-1">{{ $jumlahColdCall }} Orang</h4>
                                <div class="progress w-75" style="height: 4px">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{ $persenColdCall }}%" aria-valuenow="{{ $persenColdCall }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!--WARM CALL-->
                            <div class="col-12 col-sm-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-danger p-1"><i class="ti ti-phone-call ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">Warm Call</h6>
                                </div>
                                <h4 class="my-2 pt-1">{{ $jumlahWarmCall }} Orang</h4>
                                <div class="progress w-75" style="height: 4px">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $persenWarmCall }}%" aria-valuenow="{{ $persenWarmCall }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!--LEAD GENERATED-->
                            <div class="col-12 col-sm-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-warning p-1">
                                        <i class="ti ti-id ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">Lead Generated</h6>
                                </div>
                                <h4 class="my-2 pt-1">{{ $jumlahLeadGenerated }} Orang</h4>
                                <div class="progress w-75" style="height: 4px">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $persenLeadGenerated }}%"
                                        aria-valuenow="{{ $persenLeadGenerated }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            <!--SALES CLOSING-->
                            <div class="col-12 col-sm-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-success p-1">
                                        <i class="ti ti-coin ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">Sales Closing</h6>
                                </div>
                                <h4 class="my-2 pt-1">{{ $jumlahSalesClosing }} Orang</h4>
                                <div class="progress w-75" style="height: 4px">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $persenSalesClosing }}%"
                                        aria-valuenow="{{ $persenSalesClosing }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--STATISTIK POIN DAN KOMISI-->
        <div class="col-lg-5 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-1">
                    <h5 class="mb-0 card-title">Statistik Poin Customer Call - <b class="text-primary">Pekan {{ $pekan }} {{ $bulanTahun }}</b></h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h1 class="mb-0 me-2">Total : {{ $totalPoin }} Poin</h1>
                    </div>
                    <div id="totalEarningChart"></div>
                    <!--COLD CALL-->
                    <div class="d-flex align-items-start my-3">
                        <div class="badge rounded bg-label-info p-2 me-3 rounded">
                            <i class="ti ti-phone-calling ti-sm"></i>
                        </div>
                        <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                            <div class="me-2">
                                <h6 class="mb-0">Cold Call</h6>
                                <small class="text-muted">{{ $jumlahColdCall }} Customer</small>
                            </div>
                            <p class="mb-0 text-success">{{ $poinColdCall }} Poin</p>
                        </div>
                    </div>

                    <!--WARM CALL-->
                    <div class="d-flex align-items-start my-3">
                        <div class="badge rounded bg-label-danger p-2 me-3 rounded">
                            <i class="ti ti-phone-call ti-sm"></i>
                        </div>
                        <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                            <div class="me-2">
                                <h6 class="mb-0">Warm Call</h6>
                                <small class="text-muted">{{ $jumlahWarmCall }} Customer</small>
                            </div>
                            <p class="mb-0 text-success">{{ $poinWarmCall }} Poin</p>
                        </div>
                    </div>

                    <!--LEAD GENERATED-->
                    <div class="d-flex align-items-start my-3">
                        <div class="badge rounded bg-label-warning p-2 me-3 rounded">
                            <i class="ti ti-id ti-sm"></i>
                        </div>
                        <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                            <div class="me-2">
                                <h6 class="mb-0">Lead Generated</h6>
                                <small class="text-muted">{{ $jumlahLeadGenerated }} Customer</small>
                            </div>
                            <p class="mb-0 text-success">{{ $poinLeadGenerated }} Poin</p>
                        </div>
                    </div>

                    <!--SALES CLOSING-->
                    <div class="d-flex align-items-start">
                        <div class="badge rounded bg-label-success p-2 me-3 rounded">
                            <i class="ti ti-coin ti-sm"></i>
                        </div>
                        <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                            <div class="me-2">
                                <h6 class="mb-0">Sales Closing</h6>
                                <small class="text-muted">{{ $jumlahSalesClosing }} Customer</small>
                            </div>
                            <p class="mb-0 text-success">{{ $poinSalesClosing }} Poin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Data Riwayat Customer - <b class="text-primary">Pekan {{ $pekan }} {{ $bulanTahun }}</b></h4>
                    <table id="table" class="display wrap dataTable dtr-inline collapsed table table-striped" style="width: 100%;">
                        <thead>
                        <tr>
                            <th class="sorting" aria-controls="table" style="width: 5%;">No</th>
                            <th class="sorting" aria-controls="table" style="width: 20%;">Nama Customer</th>
                            <th class="sorting" aria-controls="table" style="width: 15%;">Nomor HP</th>
                            <th class="sorting" aria-controls="table" style="width: 10%;">Kabupaten</th>
                            <th class="sorting" aria-controls="table" style="width: 10%;">Provinsi</th>
                            <th class="sorting" aria-controls="table" style="width: 10%;">Tanggal</th>
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
                            <td>{{ $data->pelanggan->nama_kabupaten }}</td>
                            <td>{{ $data->pelanggan->nama_provinsi }}</td>
                            <td>{{ $data->created_at->isoFormat('D MMMM Y') }}</td>
                            <td>
                                @if ($data->harga_total == NULL)
                                    -
                                @else
                                {{ 'Rp '.number_format($data->harga_total,0,',','.') }}
                                @endif
                            </td>
                            <td>
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
                            </td>
                            <td>
                                <i class="ti ti-user-circle text-primary"></i>
                                <a href="https://wa.me/{{ $data->pelanggan->prefix_hp }}{{ $data->pelanggan->no_hp }}">
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
    <script src="{{ asset('style/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endpush

@push('pageScript')
    <script>
        $(document).ready( function () {
        var lang = 'Indonesian';
        $('#table')
            .addClass( 'wrap' )
            .dataTable( {
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
            } );
        } );
    </script>
    <script>
        'use strict';

        (function() {
            let cardColor, headingColor, legendColor, labelColor, borderColor;
            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                labelColor = config.colors_dark.textMuted;
                legendColor = config.colors_dark.bodyColor;
                headingColor = config.colors_dark.headingColor;
                borderColor = config.colors_dark.borderColor;
            } else {
                cardColor = config.colors.cardColor;
                labelColor = config.colors.textMuted;
                legendColor = config.colors.bodyColor;
                headingColor = config.colors.headingColor;
                borderColor = config.colors.borderColor;
            }

            // Earning Reports Bar Chart
            // --------------------------------------------------------------------
            const weeklyEarningReportsEl = document.querySelector('#weeklyEarningReports'),
                weeklyEarningReportsConfig = {
                    chart: {
                        height: 202,
                        parentHeightOffset: 0,
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            barHeight: '60%',
                            columnWidth: '38%',
                            startingShape: 'rounded',
                            endingShape: 'rounded',
                            borderRadius: 4,
                            distributed: true
                        }
                    },
                    grid: {
                        show: false,
                        padding: {
                            top: -30,
                            bottom: 0,
                            left: -10,
                            right: -10
                        }
                    },
                    colors: [
                        config.colors.primary,
                        config.colors.primary,
                        config.colors.primary,
                        config.colors.primary,
                        config.colors.primary,
                        config.colors.primary,
                        config.colors.primary
                    ],
                    dataLabels: {
                        enabled: true
                    },
                    series: [{
                        data: [{{ $callSatu }}, {{ $callDua }}, {{ $callTiga }},
                            {{ $callEmpat }}, {{ $callLima }}, {{ $callEnam }},
                            {{ $callTujuh }}
                        ]
                    }],
                    legend: {
                        show: false
                    },
                    xaxis: {
                        categories: [
                            '{{ $hari1 }}', '{{ $hari2 }}', '{{ $hari3 }}',
                            '{{ $hari4 }}', '{{ $hari5 }}', '{{ $hari6 }}',
                            '{{ $hari7 }}'
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '13px',
                                fontFamily: 'Public Sans'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            show: false
                        }
                    },
                    tooltip: {
                        enabled: false
                    },
                    responsive: [{
                        breakpoint: 1025,
                        options: {
                            chart: {
                                height: 199
                            }
                        }
                    }]
                };
            if (typeof weeklyEarningReportsEl !== undefined && weeklyEarningReportsEl !== null) {
                const weeklyEarningReports = new ApexCharts(weeklyEarningReportsEl, weeklyEarningReportsConfig);
                weeklyEarningReports.render();
            }

            // Total Earning Chart - Bar Chart
            // --------------------------------------------------------------------
            const totalEarningChartEl = document.querySelector('#totalEarningChart'),
                totalEarningChartOptions = {
                    series: [{
                            name: 'Earning',
                            data: [{{ $poinColdCall }}, {{ $poinWarmCall }}, {{ $poinLeadGenerated }}, {{ $poinSalesClosing }}]
                        },

                    ],
                    chart: {
                        height: 225,
                        parentHeightOffset: 0,
                        stacked: true,
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
                    },
                    tooltip: {
                        enabled: true
                    },
                    legend: {
                        show: false
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            columnWidth: '18%',
                            borderRadius: 5,
                            startingShape: 'rounded',
                            endingShape: 'rounded'
                        }
                    },
                    colors: [config.colors.success, config.colors.primary],
                    dataLabels: {
                        enabled: true
                    },
                    grid: {
                        show: true,
                        padding: {
                            top: -40,
                            bottom: -10,
                            left: -15,
                            right: -2
                        }
                    },
                    xaxis: {
                        labels: {
                            show: true
                        },
                        axisTicks: {
                            show: true
                        },
                        axisBorder: {
                            show: true
                        }
                    },
                    yaxis: {
                        labels: {
                            show: true
                        }
                    },
                    responsive: [{
                            breakpoint: 1468,
                            options: {
                                plotOptions: {
                                    bar: {
                                        columnWidth: '22%'
                                    }
                                }
                            }
                        },
                        {
                            breakpoint: 1197,
                            options: {
                                chart: {
                                    height: 228
                                },
                                plotOptions: {
                                    bar: {
                                        borderRadius: 8,
                                        columnWidth: '26%'
                                    }
                                }
                            }
                        },
                        {
                            breakpoint: 783,
                            options: {
                                chart: {
                                    height: 232
                                },
                                plotOptions: {
                                    bar: {
                                        borderRadius: 6,
                                        columnWidth: '28%'
                                    }
                                }
                            }
                        },
                        {
                            breakpoint: 589,
                            options: {
                                plotOptions: {
                                    bar: {
                                        columnWidth: '16%'
                                    }
                                }
                            }
                        },
                        {
                            breakpoint: 520,
                            options: {
                                plotOptions: {
                                    bar: {
                                        borderRadius: 6,
                                        columnWidth: '18%'
                                    }
                                }
                            }
                        },
                        {
                            breakpoint: 426,
                            options: {
                                plotOptions: {
                                    bar: {
                                        borderRadius: 5,
                                        columnWidth: '20%'
                                    }
                                }
                            }
                        },
                        {
                            breakpoint: 381,
                            options: {
                                plotOptions: {
                                    bar: {
                                        columnWidth: '24%'
                                    }
                                }
                            }
                        }
                    ],
                    states: {
                        hover: {
                            filter: {
                                type: 'none'
                            }
                        },
                        active: {
                            filter: {
                                type: 'none'
                            }
                        }
                    }
                };
            if (typeof totalEarningChartEl !== undefined && totalEarningChartEl !== null) {
                const totalEarningChart = new ApexCharts(totalEarningChartEl, totalEarningChartOptions);
                totalEarningChart.render();
            }

        })();
    </script>
@endpush
