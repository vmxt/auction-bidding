<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>Admin Panel | {{ Setting::info()->company_name }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage').'/icons/'.Setting::getFaviconLogo()->website_favicon }}">

    <!-- vendor css -->
    <link href="{{ asset('lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link href="{{ asset('css/dashforge.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashforge.auth.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-admin.css') }}" rel="stylesheet">
</head>

<body id="scroll1">

<div class="content-auth">
    <div class="row no-gutters">
        <div class="col-lg-6">
            <div class="signin-hero"></div>
        </div>
        <div class="col-lg-6">
            <div class="sign-wrapper">
                @if($message = Session::get('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i data-feather="alert-circle" class="mg-r-10"></i> {{ $message }}
                    </div>
                @endif

                @if($message = Session::get('msg'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i data-feather="alert-circle" class="mg-r-10"></i> {{ $message }}
                    </div>
                @endif
                <div class="wd-100p">
                    <h3 class="mg-b-3">{{ __('Reset Password') }}</h3>
                    <p class="tx-color-03 tx-14 mg-b-40">{{ __('passwords.reset_title') }}</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mg-b-10">

                            @if($message = Session::get('msg'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <i data-feather="alert-circle" class="mg-r-10"></i> {{ $message }}
                                </div>
                            @endif

                            <label class="d-block">{{ __('passwords.email') }}</label>
                            <fieldset>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="useremail@domain.com" name="email" value="{{ $email ?? old('email') }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" readonly required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>

                            <label class="d-block mg-t-20">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="d-block mg-t-20">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control  @error('password') is-invalid @enderror" name="password_confirmation"  required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">{{ __('Reset Password') }}</button>
                        <a href="{{route('login')}}" class="btn btn-outline-secondary btn-sm" type="cancel">Cancel</a>
                    </form>
                </div>
            </div><!-- sign-wrapper -->
        </div>
    </div>
</div><!-- content -->

<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lib/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('js/dashforge.js') }}"></script>

</body>

</html>
