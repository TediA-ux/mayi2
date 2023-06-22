@extends('layouts.master-without-nav')
@section('title')Email @endsection
@section('body-start') <body id="body" class="auth-page" style="background-image: url('assets/images/p-1.jpg'); background-size: cover; background-position: center center;"> @endsection
    @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <h1>Password Reset Successful</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    @section('script')

    <!-- Javascript -->
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    @endsection
    @section('body-end')
</body> @endsection
