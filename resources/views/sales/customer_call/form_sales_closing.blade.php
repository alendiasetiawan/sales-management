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
        <livewire:sales.tambah-sales-closing :jenisCall='$jenisCall' :poinCall='$poinCall' :tanggal='$tanggal' :today='$today'/>
    </div>

    <div class="col-md-6 col-12 mt-3">
        <livewire:sales.sales-closing-hari-ini :tanggal='$tanggal' :today='$today' :jenisCall='$jenisCall'>
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
                timer: 1700,
                customClass: {
                confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
          }, 100);
    })
</script>

<script>
    var rupiah1 = document.getElementById("rupiah1");
    rupiah1.addEventListener("keyup", function(e) {
    rupiah1.value = convertRupiah(this.value, "Rp ");
    });

    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split  = number_string.split(","),
            sisa   = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
        }

    function isNumberKey(evt) {
        key = evt.which || evt.keyCode;
        if ( 	key != 188 // Comma
            && key != 8 // Backspace
            && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            && (key < 48 || key > 57) // Non digit
            )
        {
            evt.preventDefault();
            return;
        }
    }
</script>
@endpush
