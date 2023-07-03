@extends('layouts.master')
@section('title')Manage Professional Bodies @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('li_1') Tables @endslot
    @slot('title') Professional Bodies @endslot
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
            <h2>Manage Professional Bodies</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-danger" href="{{ route('professional-bodies.create') }}"> Create New Professional Body</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable_1">
                            <thead class="table-dark">
 <tr>
   <th>No</th>
   <th>Name</th>
  


   <th width="280px">Action</th>
 </tr>
</thead>
 @foreach ($data as $key => $body)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $body->name }}</td>
 

    <td>
      
       <a class="btn btn-sm btn-primary" href="{{ route('professional-bodies.edit',Crypt::encrypt($body->id)) }}"><i class="fas fa-pencil-alt"></i></a>
       <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$body->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a>
    <form method="POST" action="{{ route('professional-bodies.destroy', $body->id) }}" class="pull-right" id="delete-form-{{ $body->id }}" >
    @csrf
    @method('delete')
</form>
    </td>
  </tr>
 @endforeach
</table>

</div></div>
<div></div>


{!! $data->render() !!}

@endsection
    @section('script')

    <!-- Javascript -->
    <script src="{{ URL::asset('assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/datatable.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    @endsection
    @section('body-end')
</body> @endsection
