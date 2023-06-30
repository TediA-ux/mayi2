@extends('layouts.master')
@section('title')Manage Constituencies @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('li_1') District @endslot
    @slot('title') Constituency @endslot
    @endcomponent
    @endsection
    <div class="card">
                
                <!--end card-header-->
                <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit  Constituency</h2>
        </div>
        <div class="pull-right">
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


<div class="card">
               
                <!--end card-header-->
                <div class="card-body">
{!! Form::open(array('url' => '/update/district/constituency/','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Constituency Name:</strong>
            {!! Form::text('name', $constituency->name, array('placeholder' => 'Constituency Name','class' => 'form-control')) !!}
           
            
        </div>
    </div>
    
</div>

    <br>
    <br> <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-danger float-end">Submit</button>
    </div>
</div></br>
</div></div>
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
