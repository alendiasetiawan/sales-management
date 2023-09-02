@extends('layouts.master')

@push('vendorCss')
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('style/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
@endpush

@section('breadcrumb')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Laporan Sales /</span> Tahunan
    </h4>
@endsection

@section('content')
    <div class="row">
        <!--CHART GARIS JUMLAH CUSTOMER CALL-->
        <div class="col-lg-7 col-12 mb-3">
            <div class="card">
                <div class="card-header header-elements">
                    <div>
                        <h5 class="card-title mb-0">Statistik Jumlah Customer Call</h5>
                        <small class="text-muted">Periode : <b class="text-primary">Tahun {{ $tahun }}</b></small>
                    </div>
                    <div class="card-header-elements ms-auto py-1">
                        <h5 class="fw-bold mb-0 me-3">Total : <span class="badge bg-label-primary">{{ $jumlahCallTahunan }}</span></h5>
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

        <!--POIN DAN KOMISI SALES-->
        <div class="col-lg-5 col-12">
            <!--TOTAL POIN-->
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Total Poin : <span class="badge bg-label-primary">{{ $totalPoin }}</span></h5>
                            <small class="text-muted">Periode : <b class="text-primary">Tahun {{ $tahun }}</b></small>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="p-0 m-0">
                            @foreach ($salesTahunan as $data)
                                @php
                                    $statusSales = $data->nama;
                                @endphp
                                <li class="d-flex mb-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded
                                        @if ($data->nama == $coldCall)
                                            bg-label-info
                                        @elseif ($data->nama == $warmCall)
                                            bg-label-danger
                                        @elseif ($data->nama == $leadGenerated)
                                            bg-label-warning
                                        @else
                                            bg-label-success
                                        @endif
                                        ">
                                            <i class="ti
                                            @if ($data->nama == $coldCall)
                                                ti-phone-calling
                                            @elseif ($data->nama == $warmCall)
                                                ti-phone-call
                                            @elseif ($data->nama == $leadGenerated)
                                                ti-id
                                            @else
                                                ti-coin
                                            @endif
                                            ti-sm"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $data->nama }}</h6>
                                            <small class="text-muted">
                                                {{ $data->sales->where('status_sales', $statusSales)->count() }} Customer
                                            </small>
                                        </div>
                                        <div class="user-progress">
                                            <small>
                                                {{ $data->sales->where('status_sales', $statusSales)->sum('poin') }} Poin
                                            </small>
                                            <a data-bs-toggle="collapse" href="#detailPoin{{ $data->id }}" aria-expanded="false"
                                                aria-controls="detailPoin{{ $data->id }}">
                                                <i class="ti ti-chevron-down text-success"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <div class="collapse mb-3" id="detailPoin{{ $data->id }}">
                                    <ul class="list-group">
                                        @foreach ($refBulan as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Bulan {{ $item->bulan }}
                                            <span class="badge bg-primary">
                                                {{ $data->sales->where('bulan', $item->bulan)->where('tahun', $tahun)->where('status_sales', $statusSales)->sum('poin') }} Poin
                                            </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!--TOTAL KOMISI-->
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
                                <p class="mb-2">Total insentif <b class="text-primary">Tahun {{ $tahun }}</b> :</p>
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
                    <h4>Data Riwayat Customer - <b class="text-primary">Tahun {{ $tahun }}</b></h4>
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


            // Line Chart
            // --------------------------------------------------------------------

            const lineChart = document.getElementById('lineChart');
            if (lineChart) {
                const lineChartVar = new Chart(lineChart, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov',
                            'Des'
                        ],
                        datasets: [{
                                data: [
                                    @foreach ($coldCallTahunan as $cold)
                                        @php
                                            $bulan = $cold->bulan;
                                        @endphp
                                        {{ $cold->sales->where('bulan', $bulan)->count() }},
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
                                    @foreach ($warmCallTahunan as $warm)
                                        @php
                                            $bulan = $warm->bulan;
                                        @endphp
                                        {{ $warm->sales->where('bulan', $bulan)->count() }},
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
                                    @foreach ($leadGeneratedTahunan as $lead)
                                        @php
                                            $bulan = $lead->bulan;
                                        @endphp
                                        {{ $lead->sales->where('bulan', $bulan)->count() }},
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
                                    @foreach ($salesClosingTahunan as $lead)
                                        @php
                                            $bulan = $lead->bulan;
                                        @endphp
                                        {{ $lead->sales->where('bulan', $bulan)->count() }},
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
