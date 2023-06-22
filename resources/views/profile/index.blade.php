@extends('layouts.master')
@section('title')Manage Profile @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('li_1') User @endslot
    @slot('title') Profile @endslot
    @endcomponent
    @endsection

    <div class="row">
        <div class="col-12">
            <div class="card">

            <div class="card-body">
                    <div class="met-profile">
                        <div class="row">
                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                <div class="met-profile-main">
                                    <div class="met-profile-main-pic">
                                        <img src="{{URL::asset('assets/images/users/default_profile.png')}}" alt="" height="110" class="rounded-circle">
                                        <span class="met-profile_main-pic-change">
                                            <i class="fas fa-camera"></i>
                                        </span>
                                    </div>
                                    <div class="met-profile_user-detail">
                                        <h5 class="met-user-name">{{ $log_user->firstname }} {{ $log_user->lastname }}</h5>

                                        <p class="mb-0 met-user-name-post">{{ $user_role }}</p>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-4 ms-auto align-self-center">
                                <ul class="list-unstyled personal-detail mb-0">
                                    <li class=""><i class="las la-phone mr-2 text-secondary font-22 align-middle"></i> <b> Phone </b> :{{ $log_user->contact }} </li>
                                    <li class="mt-2"><i class="las la-envelope text-secondary font-22 align-middle mr-2"></i> <b> Email </b> :{{ $log_user->email }}</li>
                                    <?php if(!empty($log_user->department->name)){ ?><li ><i class="las la-home text-secondary font-22 align-middle mr-2"></i><b> Department </b>: {{   $log_user->department->name }}</li><?php } ?>
                                </ul>

                            </div>
                            <!--end col-->

                            <div class="col-lg-4 ms-auto align-self-center">


                            </div>

                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end f_profile-->
                </div>
                <!--end card-body-->
                <div class="card-body p-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ empty(Session::get('tab')) ? 'active' : '' }}" data-bs-toggle="tab" href="#Users" role="tab" aria-selected="true">Edit Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ !empty(Session::get('tab')) && Session::get('tab') == 'Password' ? 'active' : '' }}" data-bs-toggle="tab" href="#Password" role="tab" aria-selected="true">Change Password</a>
                        </li>



                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                        @endif

                        <!-- Way 1: Display All Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="tab-pane p-3 {{ empty(Session::get('tab')) ? 'active' : '' }}" id="Users" role="tabpanel">

                            <div class="row">
                                <form action="{{ url('/profile/update') }}" role="form" id="" enctype="multipart/form-data" method="POST" class="form-prevent-multiple-submits">
                                    {{ csrf_field() }}
                                    <div class="col-lg-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label text-end ">First Name</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control @error('firstname') is-invalid @enderror" type="text" name="firstname" value="{{ $log_user->firstname }}" id="example-text-input">
                                                        @error('firstname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-email-input" class="col-sm-2 col-form-label text-end">Email</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $log_user->email }}" id="example-email-input">
                                                        @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-tel-input" class="col-sm-2 col-form-label text-end">Alt Phone Number</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" name="alt_contact" value="{{ $log_user->alt_contact }}" id="example-tel-input">
                                                    </div>
                                                </div>



                                            </div>


                                            <div class="col-lg-6">
                                                <div class="mb-3 row">
                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-end">Last Name</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" value="{{ $log_user->lastname }}" id="example-url-input">
                                                        @error('lastname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-date-input" class="col-sm-2 col-form-label text-end">Phone Number</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control @error('contact') is-invalid @enderror" type="text" name="contact" value="{{ $log_user->contact }}" id="example-date-input">
                                                        @error('contact')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <div class="row">
                                    <div class="col-sm-1 ms-auto">
                                        <button type="submit" class="btn btn-danger">Update</button>
                                    </div>
                                </div>
                            </form>
                                <!--end card-->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            <div class="tab-pane p-3 {{ !empty(Session::get('tab')) && Session::get('tab') == 'Password' ? 'active' : '' }}" id="Password" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-12">

                                        <form action="{{ url('/profile/password') }}" role="form" id="" enctype="multipart/form-data" method="POST" class="form-prevent-multiple-submits">
                                            {{ csrf_field() }}
                                            <div class="col-lg-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3 row">
                                                            <label for="example-url-input" class="col-sm-4 col-form-label text-end">New Password</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" value="" id="example-url-input">
                                                                @error('new_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>




                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="mb-3 row">
                                                            <label for="example-email-input" class="col-sm-4 col-form-label text-end">Confirm Password</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control @error('new_confirm_password') is-invalid @enderror" type="password" name="new_confirm_password" value="" id="example-email-input">
                                                                @error('new_confirm_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            <!--end card-body-->
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 ms-auto">
                                                <button type="submit" class="btn btn-danger">Change Password</button>
                                            </div>
                                        </div>
                                    </form>

                                     </div>
                                    <!--end col-->

                                </div>
                                <!--end row-->
                            </div>
                        </div>


                    </div>
                </div>
                <!--end card-body-->


</div>

</div>

</div>

@endsection
    @section('script')

    <!-- Javascript -->
    <script src="{{ URL::asset('assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/datatable.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    @endsection
    @section('body-end')
</body> @endsection
