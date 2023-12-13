@extends('layouts.master')
@section('title')Manage Posts @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') Posts @endslot
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
            <h2>Create New Post</h2>
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
                <div class="card-header">
                  <p class="text-muted mb-0">Fill in all fields and attach a role</p>
                </div>
                <!--end card-header-->
                <div class="card-body">
{!! Form::open(array('route' => 'posts.store','method'=>'POST', "enctype"=>'multipart/form-data')) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Title:</strong>
            {!! Form::text('title', null, array('placeholder' => 'Provide post title','class' => 'form-control')) !!}
        </div>
    </div>
</div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Description:</strong>
            {!! Form::textarea('description', null, array('placeholder' => 'Enter Description','class' => 'form-control')) !!}
        </div>
    </div>
    {{-- <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Image:</strong>
            {!! Form::text('cover_image', null, array('placeholder' => 'Enter Image','class' => 'form-control')) !!}
        </div>
    </div> --}}
    
   
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cover Image:</strong>
            <input type="file" name="cover_image" class="form-control" placeholder="image">
        </div>
    </div>
    
</div>

<div class="row">
  
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
