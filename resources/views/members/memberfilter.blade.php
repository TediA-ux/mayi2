@extends('layouts.master')
@section('title')Manage MPs @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
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
            <h2>Members of Parliament</h2>
        </div>
      

    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable_1">
                            <thead class="table-dark">
 <tr>
   <th>Title</th>
   <th>Surname</th>
   <th>Other Names</th>
   <th>Email</th>
   <th>Photo</th>
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
    <td><img width="50px"  src="{{ asset('identification_photos/'.$member->photo) }}" width="70px" height="70px" alt="" /></td>
    <td>{{ $member->gender }}</td>
    <td>{{ $member->religion }}</td>
    

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
