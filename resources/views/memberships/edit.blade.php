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
            <h2>Edit Membership/Association</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('members.show',Crypt::encrypt($membership->member_id)) }}"> Back</a>
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


{!! Form::model($membership, ['method' => 'PATCH','route' => ['memberships.update', $membership->id]]) !!}
<div id="formContainer">
                      <div class="form-container form-group">
                      <input type="text" value="{{$membership->member_id}}" hidden name="member_id" required>
                      
                      <label >Professional Body:</label>
                      <select class="form-select" name="professional_body_id" required>
                          <option value="{{$membership->id}}">{{$membership->body}}</option>
                          @foreach($bodies as $body)
                      <option value="{{$body->id}}">{{$body->name}}</option>
                    @endforeach
                      </select>
                      
                      
                   
                      </div>
                  </div>
                  
                
                  <br>
                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-danger float-end">Submit</button>
</div>
          </div>
                
               
                <br>
                <div>

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
