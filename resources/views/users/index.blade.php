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
    @slot('title') Users @endslot
    @endcomponent
    @endsection
    <div class="card">

                <!--end card-header-->
                <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-danger" href="{{ route('users.create') }}"> Create New User</a>
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
   <th>Full Name</th>
   <th>Email</th>
   <th>Contact</th>
   <th>Role</th>
   <th>Status</th>
   <th>Date Registered</th>
   <th >Action</th>
 </tr>
</thead>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->contact }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label>{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td><?php if($user->status == '0'){ ?>

        <span class="badge bg-danger">Pending Activation</span>

        <?php } elseif ($user->status == '1') { ?>
            <span class="badge bg-success">Active</span>
        <?php } else{ ?>
            <span class="badge bg-warning">Suspended</span>
    <?php } ?>
     </td>
     <td>{{ $user->created_at }}</td>
    <td>
       <a class="btn btn-sm btn-primary" href="{{ route('users.edit',Crypt::encrypt($user->id)) }}"><i class="fas fa-pencil-alt"></i></a>
       <?php if($user->status == '0'){ ?>
        <a class="btn btn-sm btn-success" title="Activate User" onClick="if(confirm('Are you sure you want to Activate this user?')){document.getElementById('activate-form-{{$user->id}}').submit();}else{event.preventDefault();}" href="#"><i class="fas fa-check-square"></i></a>
        <?php } ?>
        <?php if($user->status == '1'){ ?>
        <a class="btn btn-sm btn-danger" title="De-Activate User" onClick="if(confirm('Are you sure you want to De-activate this user?')){document.getElementById('delete-form-{{$user->id}}').submit();}else{event.preventDefault();}" href="#"><i class="fas fa-times
         "></i></a>
         <?php } ?>

         <a class="btn btn-sm btn-info" href="#" title="Delete User" onClick="if(confirm('Are you sure you want to Delete this user?')){document.getElementById('deletes-form-{{$user->id}}').submit();}else{event.preventDefault();}" href="#"><i class="fas fa-trash
            "></i></a>
         <!-- <a class="btn btn-sm btn-success" title="Send Mail"  data-bs-toggle="modal" data-bs-target="#Sendmail-{{ $user->id }}"><i class="fas fa-envelope"></i></a> -->

         <form method="POST" action="{{ url('/user/deactivate/'.$user->id) }}" class="pull-right" id="delete-form-{{ $user->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" /></form>

                                            <form method="POST" action="{{ url('/user/activate/'.$user->id) }}" class="pull-right" id="activate-form-{{ $user->id }}" >
                                                {{ csrf_field() }}
                                                <input name="_method" type="hidden" value="POST" /></form>

       <form method="POST" action="{{ url('/delete/user/'.$user->id) }}" class="pull-right" id="deletes-form-{{ $user->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" /></form>
      <form method="POST" action="{{ url('/send/user/mail'.$user->id) }}" class="pull-right" id="deletes-form-{{ $user->id }}" >
                                              {{ csrf_field() }}
                                              <input name="_method" type="hidden" value="POST" /></form>

                                              <div class="modal fade" id="Sendmail-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        {{-- <div class="modal-header">
                                                            <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Enter Name</h6>
                                                        </div> --}}
                                                        <!--end modal-header-->
                                                        <div class="modal-body">
                                                            <div class="card-body p-0 auth-header-box">
                                                                <div class="text-center">
                                                                    <a href="#" class="logo logo-admin">
                                                                        <img src="{{URL::asset('assets/images/logo-sm.png')}}" height="50" alt="logo" class="auth-logo">
                                                                    </a>

                                                                </div>
                                                            </div>
                                                            <div class="card-body">

                                                                <!-- Tab panes -->

                                                                    <div class="tab-pane px-3 pt-3" id="Register_Tab" role="tabpanel">
                                                                        <form action="{{ url('/send/user/mail') }}" role="form" id="" enctype="multipart/form-data" method="POST" class="">
                                                                            {{ csrf_field() }}

                                                                            <div class="form-group">
                                                                                <div class="input-group mb-3">
                                                                                    {{ $user->accountholdername }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                              <div class="input-group mb-3">
                                                                                  <label for="username">Subject: </label>
                                                                                  <input type="text" required class="form-control" id="username" name="subject" placeholder=" ">
                                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                                                </div>
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <div class="input-group mb-3">
                                                                                <label for="message">Message Body: </label>
                                                                                <textarea class="form-control" required id="message" name="message" rows="4" cols="50" placeholder="Enter your message here..."></textarea>

                                                                              </div>
                                                                        </div>
                                                                            <!--end form-group-->




                                                                            <div class="form-group mb-0 row">
                                                                                <div class="col-12 mt-2">
                                                                                    <div class="d-grid">
                                                                                        <button class="btn btn-primary" type="submit">Send <i class="fas fa-sign-in-alt ml-1"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                                <!--end col-->
                                                                            </div>
                                                                            <!--end form-group-->
                                                                        </form>

                                                                </div>
                                                            </div>
                                                            <!--end card-body-->

                                                        </div>
                                                        <!--end modal-body-->

                                                    </div>
                                                    <!--end modal-content-->
                                                </div>
                                                <!--end modal-dialog-->
                                            </div>
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
