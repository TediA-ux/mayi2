@extends('layouts.master')
@section('title')Hobby @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') Hobby @endslot
    @endcomponent
    @endsection
    <div class="card">
                <div class="card-header">
                  <p class="text-muted mb-0">Fill in all fields</p>
                </div>
                <!--end card-header-->
                <div class="card-body">
                @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>{{ session()->get('message') }}</strong>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 @endif
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Education Record</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('members.show',Crypt::encrypt($record->member_id)) }}"> Back</a>
            <br>
        </div>
    </div>
</div>

@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


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


{!! Form::model($record, ['method' => 'PATCH','route' => ['education.update', $record->id]]) !!}
<div id="education-formContainer">
                    <div class="education-form-container form-control">
                    
                    <input type="text" value="{{$record->member_id}}" hidden name="member_id" required>
                    
                    <label >Education:</label>
                    <select class="form-select" name="award_id" required>
                        <option value="{{$record->id}}">{{$record->award}}</option>
                        @foreach($qualifications as $qualification)
                    <option value="{{$qualification->id}}">{{$qualification->award_type}}</option>
                  @endforeach
                    </select>

                    <label >Institution:</label>
                    {!! Form::text('institution', null, array('placeholder' => 'Enter Institution','class' => 'form-control')) !!}

                      <label >Year Attained:</label>
                      <input value="{{$record->year}}" class="form-control"  type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="YYYY" required oninput="limitDigits(this, 4)">

                    
                    
                   
                    </div>
                </div>
                
            
                <br>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-danger float-end">Submit</button>
            </div>
<div></div>

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
