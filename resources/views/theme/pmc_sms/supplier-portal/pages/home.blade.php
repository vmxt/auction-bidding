@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.supplier-portal.main')

@section('pagecss')
@endsection

@section('content')
    {!! $page->contents !!}
@endsection

@section('pagejs')
@endsection

@section('customjs')
@endsection
