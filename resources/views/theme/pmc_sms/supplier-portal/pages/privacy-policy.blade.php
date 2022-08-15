@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.main')

@section('pagecss')
@endsection

@section('content')
    <main>
        <section class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 style="text-align: center;">{{ Setting::info()->data_privacy_title }}</h2>
                        {!! Setting::info()->data_privacy_content !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('pagejs')
@endsection
