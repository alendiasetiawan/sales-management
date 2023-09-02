@extends('layouts.master')

@push('vendorCss')
<link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/animate-css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endpush

@section('breadcrumb')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $jenisCall }} /</span> Tambah Customer
</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <livewire:sales.tambah-customer :jenisCall='$jenisCall' :poinCall='$poinCall' :tanggal='$tanggal' :today='$today'/>
    </div>

    <div class="col-md-6 col-12 mt-3">
        <livewire:sales.pelanggan-hari-ini :tanggal='$tanggal' :today='$today' :jenisCall='$jenisCall'>
    </div>
</div>
@endsection

@push('vendorScript')
<script src="{{ asset('style/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endpush

@push('pageScript')
<script>
    $('form').submit(function (event) {
        if ($(this).hasClass('submitted')) {
            event.preventDefault();
        }
        else {
            $(this).find(':submit').html('<span class="spinner-border spinner-border-sm p-1" role="status"></span> <span class="ms-25 align-middle"></span>');
            $(this).addClass('submitted');
            document.getElementById("submit").disabled = true;
        }
    });
</script>
{{-- <script src="{{ asset('style/assets/js/extended-ui-sweetalert2.js') }}"></script> --}}
<script>
    window.addEventListener('tambahCustomer', event => {
          'use strict';
          var isRtl = $('html').attr('data-textdirection') === 'rtl';

          // On load Toast
          setTimeout(function () {
            Swal.fire({
                title: 'Yey!',
                text: 'Data berhasil disimpan!',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000,
                customClass: {
                confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
          }, 100);
    })
</script>
@endpush
