@extends('backend.layouts.backendLayout')
@section('content')
<link rel="stylesheet" href="{{ asset('page-css/patient.css') }}">

<div class="card">
    item master
</div>

@endsection
@push('scripts')
<script src="{{ asset('assets/backend-page-js/itemmaster.js') }}"></script>
@endpush