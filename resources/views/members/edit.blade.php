@extends('layouts.master')
@section('title')Manage Mps @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') Member of Parliament @endslot
    @endcomponent
    @endsection
    <div class="card">
                <div class="card-header">
                  <p class="text-muted mb-0">Fill in all fields</p>
                </div>
                <!--end card-header-->
                <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Member of Parliament</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('members.index') }}"> Back</a>
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


{!! Form::model($member, ['method' => 'PATCH','route' => ['members.update', $member->id], "enctype"=>'multipart/form-data']) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Title:</strong>
            {!! Form::text('title', null, array('placeholder' => 'Enter  Title','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Surname:</strong>
            {!! Form::text('surname', null, array('placeholder' => 'Enter Surname','class' => 'form-control')) !!}
        </div>
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Other Names:</strong>
            {!! Form::text('other_names',  null,array('placeholder' => 'Other Names','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>DOB:</strong>
            <input class="form-control"  min=<?php
            echo date('Y-m-d'); ?> type="datetime-local" name="dob" value="" id="datetime-local-input">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Religion:</strong>
            {!! Form::text('religion', null, array('placeholder' => 'Enter Religion','class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Gender:</strong>
            <select class="form-select input-sm" name="gender">
             <option value="">--Select Gender --</option>
             <option value="Male">Male</option>
             <option value="Female">Female</option>

            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Landline:</strong>
            {!! Form::text('landline', null, array('placeholder' => 'Enter Landline','class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Phone Contact:</strong>
            {!! Form::text('phone_number', null, array('placeholder' => 'Enter Contact','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Other Contact:</strong>
            {!! Form::text('alt_contact',  null,array('placeholder' => 'Other Contact','class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Marital Status:</strong>
            <select class="form-select input-sm" name="marital_status">
             <option value="">--Select Status --</option>
             <option value="Married">Married</option>
             <option value="Single">Single</option>
             <option value="Divorced">Divorced</option>
             <option value="Separated">Separated</option>
             <option value="Widowed">Widowed</option>

            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Photo:</strong><br>
            <input type="file" name="photo" class="form-group" placeholder="image">
        </div>
    </div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Postal Address:</strong>
            {!! Form::text('postal_address', null, array('placeholder' => 'Enter Postal Address','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>District:</strong>
            <select id="district" class="form-select" name="district_id">
                <option value="" selected>Select</option>
                @foreach($districts as $district)
                <option value="{{$district->id}}">{{$district->name}}</option>
              @endforeach

            </select>
        </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Constituency:</strong>
            <select id="constituency" class="form-select" name="constituency_id">
                <option value=""></option>
               

            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Political Party:</strong>
            <select id="party" class="form-select" name="party_id">
                <option value="" selected>Select Party</option>
                @foreach($parties as $party)
                <option value="{{$party->id}}">{{$party->name}}</option>
              @endforeach

            </select>
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

    <script>
  const districtDropdown = document.getElementById('district');
  const constDropdown = document.getElementById('constituency');

  districtDropdown.addEventListener('change', () => {
      const id = districtDropdown.value;
      constDropdown.innerHTML = '<option value="">Loading...</option>';
      constDropdown.disabled = true;

      fetch(`/district-constituencies/${id}`)
          .then(response => response.json())
          .then(constituencies => {
            constDropdown.innerHTML = '<option value="">Select a constituency</option>';
            constituencies.forEach(constituency => {
                  const option = document.createElement('option');
                  option.value = constituency.id;
                  option.textContent = constituency.name;
                  constDropdown.appendChild(option);
              });
              constDropdown.disabled = false;
          })
          .catch(error => console.error(error));
  });
</script>

    @endsection
    @section('body-end')
</body> @endsection
