@extends('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.main.main')

@section('pagecss')
@endsection

@section('content')
    <main>
        <section class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center" style="padding-top: 30px;">{{ Setting::info()->data_privacy_title }}</h2>
                        <p>&nbsp;</p>
                        {!! Setting::info()->data_privacy_content !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('pagejs')
@endsection
