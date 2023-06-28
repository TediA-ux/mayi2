@extends('layouts.master')
@section('title')Manage MPs @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') MPs @endslot
    @endcomponent
    @endsection
    <div class="card">

                <!--end card-header-->
                <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Members of Parliament Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-danger" href="{{ route('members.create') }}"> Create New Member</a>
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
   <th>Title</th>
   <th>Surname</th>
   <th>Other Names</th>
   <th>Email</th>
   <th>DOB</th>
   <th>Gender</th>
   <th>Religion</th>
   <th >Action</th>
 </tr>
</thead>
 @foreach ($data as $key => $member)
  <tr>
    <td>{{ $member->title }}</td>
    <td>{{ $member->surname }}</td>
    <td>{{ $member->other_names }}</td>
    <td>{{ $member->email }}</td>
    <td>{{ $member->dob }}</td>
    <td>{{ $member->gender }}</td>
    <td>{{ $member->religion }}</td>
    <td>
    <a class="btn btn-sm btn-primary" href="{{ route('members.edit',Crypt::encrypt($member->id)) }}"><i class="fas fa-pencil-alt"></i></a>
       <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$member->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a>
                                            <form method="POST" action="{{ route('members.index', $member->id) }}" class="pull-right" id="delete-form-{{ $member->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" /></form>

     </td>

  </tr>
 @endforeach
</table>

</div></div>
</div></div>



@endsection
    @section('script')

    <!-- Javascript -->
    <script src="{{ URL::asset('assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/datatable.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    @endsection
    @section('body-end')
</body> @endsection
