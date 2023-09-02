@extends('layouts.master')

@push('vendorCss')
<link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
<link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
@endpush

@section('breadcrumb')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $jenisCall }} /</span> Customer
</h4>
@endsection

@section('content')
<livewire:sales.log-sales-closing :jenisCall='$jenisCall'/>
@endsection

@push('vendorScript')
<script src="{{ asset('style/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ asset('style/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
<script src="{{ asset('style/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('style/assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
@endpush

@push('pageScript')
<script src="{{ asset('style/assets/js/modal-edit-user.js') }}"></script>
@endpush
