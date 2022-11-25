@extends('layout.master')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
@endpush


@section('nav')
 @include('inc.nav')
@endsection

@section('ads')
    @include('inc.ads')
@endsection

@section('content')
    @include('inc.news_info')
@endsection

@section('footer')
    @include('inc.footer')
@endsection

@push('push')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

