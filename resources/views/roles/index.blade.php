@extends('layouts.master')
@section('title')Manage Users @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') Roles @endslot
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
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-danger" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-striped" id="datatable_1">
  <tr>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ $role->name }}</td>
        <td>
            @can('role-edit')
                <a class="btn btn-sm btn-primary" href="{{ route('roles.edit',Crypt::encrypt($role->id)) }}"><i class="fas fa-pencil-alt"></i></a>
            @endcan
            @can('role-delete')
           <!-- <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$role->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a> -->
                                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="pull-right" id="delete-form-{{ $role->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" />
                                            </form>
            @endcan

        </td>
    </tr>
    @endforeach
</table>



<div></div>

@endsection
    @section('script')

    <!-- Javascript -->
    <script src="{{ URL::asset('assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/datatable.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    @endsection
    @section('body-end')

