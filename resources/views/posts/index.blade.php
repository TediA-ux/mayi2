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
                  <p class="text-muted mb-0">Fill in all fields</p>
                </div>
                <!--end card-header-->
                <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Post Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-danger" href="{{ route('posts.create') }}"> Create New Post</a>
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
   <th>Description</th>
   <th>Image</th>
   <th>Slug</th>
   <th>Status</th>
   <th >Action</th>
 </tr>
</thead>
 @foreach ($data as $key => $posts)
  <tr>
    <td>{{ $posts->title }}</td>
    <td>{{ $posts->description }}</td>
    <td>{{ $posts->cover_image }}</td>
    <td>{{ $posts->slug}}</td>
    
    <td><?php if($posts->status == '0'){ ?>

        <span class="badge bg-danger">Pending Activation</span>

        <?php } elseif ($posts->status == '1') { ?>
            <span class="badge bg-success">Active</span>
        <?php } else{ ?>
            <span class="badge bg-warning">Inactive</span>
    <?php } ?>
     </td>
     <td>
        <a  class="btn btn-sm btn-info" href="{{ route('posts.show',$posts->id) }}"><i class="fas fa-list-ul"></i></a>
        {{-- <a  class="btn btn-sm btn-info" href="{{ route('companies.show',Crypt::encrypt("$company->id")) }}"><i class="fas fa-list-ul"></i></a> --}}
  
         {{-- <a data-bs-toggle="modal" data-bs-target="#UserModalShow" class="btn btn-sm btn-info" href="#"><i class="fas fa-list-ul"></i></a> --}}
         <a class="btn btn-sm btn-primary" href="{{ route('posts.edit',$posts->id) }}"><i class="fas fa-pencil-alt"></i></a>
         <?php if($posts->status == '0'){ ?>
          <a class="btn btn-sm btn-success" title="Activate Post" onClick="if(confirm('Are you sure you want to Activate this Post?')){document.getElementById('activate-form-{{$posts->id}}').submit();}else{event.preventDefault();}" href="#"><i class="fas fa-check-square"></i></a>
          <?php } ?>
          <?php if($posts->status == '1'){ ?>
          <a class="btn btn-sm btn-danger" title="De-Activate Post" onClick="if(confirm('Are you sure you want to De-activate this Post?')){document.getElementById('delete-form-{{$posts->id}}').submit();}else{event.preventDefault();}" href="#"><i class="fas fa-times
           "></i></a>
           <?php } ?>
                                              <form method="POST" action="{{ url('/post/deactivate/'.$posts->id) }}" class="pull-right" id="delete-form-{{ $posts->id }}" >
                                              {{ csrf_field() }}
                                              <input name="_method" type="hidden" value="POST" /></form>
  
                                              <form method="POST" action="{{ url('/post/activate/'.$posts->id) }}" class="pull-right" id="activate-form-{{ $posts->id }}" >
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
