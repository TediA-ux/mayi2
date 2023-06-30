@extends('layouts.master')
@section('title')Manage Committees @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') Parliament Committees @endslot
    @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Committee</h2>
        </div>
        <div class="pull-right">
        </div>
    </div>
</div>

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

<div class="card">
                <div class="card-header">
                  <p class="text-muted mb-0">Fill in all fields</p>
                </div>
                <!--end card-header-->
                <div class="card-body">
{!! Form::open(array('route' => 'committees.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Committee Name:</strong>
            {!! Form::text('committee_name', null, array('placeholder' => 'Enter Committee Name','class' => 'form-control')) !!}

        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
       
        <div class="form-group">
            <strong>Committee Type:</strong>

            <select class="form-select input-sm" name="committee_type">
             <option value="">--Select Type --</option>
             <option value="Sectoral">Sectoral</option>
             <option value="Standing">Standing</option>

            </select>
            
            
        </div>
    </div>
    

    

</div>

    <br>
    <br> <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-danger float-end">Submit</button>
    </div>
</br>
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
