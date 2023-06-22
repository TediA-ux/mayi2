@extends('layouts.master')
@section('title')Manage Users @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') Users @endslot
    @endcomponent
    @endsection
    <div class="card">
                <div class="card-header">
                  <p class="text-muted mb-0">Fill in all fields and attach a role</p>
                </div>
                <!--end card-header-->
                <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], "enctype"=>'multipart/form-data']) !!}
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Account Holder Name:</strong>
            {!! Form::text('accountholdername', null, array('placeholder' => 'Enter  Name','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Phone Contact:</strong>
            {!! Form::text('contact', null, array('placeholder' => 'Enter Contact','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>NIN Number:</strong>
            {!! Form::text('nin', null, array('placeholder' => 'NIN','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Section:</strong>
            {!! Form::text('section', null, array('placeholder' => 'Enter Section','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Group:</strong>
            {!! Form::text('group', null, array('placeholder' => 'Enter Group','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Card Number:</strong>
            {!! Form::text('cardnumber', null, array('placeholder' => 'Enter Card Number','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Card Pin:</strong>
            {!! Form::password('card_pin',  array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>DOB:</strong>
            {!! Form::text('dob', null, array('placeholder' => 'Enter D.O.B','class' => 'form-control','type'=> 'date')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Gender:</strong> (Male/Female)
            {!! Form::text('gender', null, array('placeholder' => 'Enter Gender','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Address:</strong>
            {!! Form::text('address', null, array('placeholder' => 'Enter Address','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles', $roles,$userRole, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Identification Photo Front:</strong>
            <input type="file" name="id_front" class="form-control" placeholder="image">
            <br>
            @if (isset($user->id_front))
            <img width="250px" src="{{ asset('identification_photos/'. $user->id_front) }}" alt="">

        @else
            no.image.png
        @endif
        <a href="{{ asset('identification_photos/'. $user->id_front) }}" class="btn btn-primary float-end" >Download</a>

        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Identification Photo Back:</strong>
            <input type="file" name="id_back" class="form-control" placeholder="image">

            <br>
            @if (isset($user->id_back))
            <img width="250px" src="{{ asset('identification_photos/'. $user->id_back) }}" alt="">

        @else
            no.image.png
        @endif
        <a href="{{ asset('identification_photos/'. $user->id_back) }}" class="btn btn-primary float-end" >Download</a>
        </div>
    </div>
    <br> </br>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center mb-2">
        <button type="submit" class="btn btn-danger float-end">Submit</button>
    </div>
</div>
</div></div>
{!! Form::close() !!}

@endsection
    @section('script')

    <!-- Javascript -->
    <script src="{{ URL::asset('assets/pages/form-wizard.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    @endsection
    @section('body-end')
</body> @endsection
