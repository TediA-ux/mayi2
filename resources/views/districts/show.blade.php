@extends('layouts.master')
@section('title')
    Manage District
@endsection
<?php
  $getDep = new App\Models\User();
?>
@section('css')
    <link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start')

    <body id="body" class="dark-sidebar" data-layout="horizontal">
    @endsection
    @section('content')
        <!-- page title-->
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1')
                Tables
            @endslot
            @slot('title')
                Manage District
            @endslot
        @endcomponent
    @endsection

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="met-profile">
                        <div class="row">
                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                <div class="met-profile-main">
                                    <div class="met-profile-main-pic">
                                        <img src="{{ URL::asset('assets/images/district.jpg') }}"
                                            alt="" height="110" class="rounded-circle">
                                        <span class="met-profile_main-pic-change">
                                            <i class="fas fa-camera"></i>
                                        </span>
                                    </div>
                                    <div class="met-profile_user-detail">
                                        <h5 class="met-user-name">{{ $district->name }} District</h5>

                                       
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                           
                            <!--end col-->

                            

                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end f_profile-->
                </div>
                <!--end card-body-->
                <div class="card-body p-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#constituencies" role="tab"
                                aria-selected="true">Constituencies</a>
                        </li>
                        

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                                @php
                                    Session::forget('success');
                                @endphp
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                                @php
                                    Session::forget('error');
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
                        <div class="tab-pane p-3 active" id="constituencies" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        @can('create-constituency')
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ url('/add/district/constituency/' . $district->id) }}"><b>Add Constituency</b></a>
                                            @endcan
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="datatable_1">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th width="280px">Action</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($data as $key => $constituency)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ $constituency->name }}</td>
                                                    
                                                        <td><a class="btn btn-sm btn-primary" href="/edit/constituency/<?php echo Crypt::encrypt($constituency->id) ?>"><i class="fas fa-pencil-alt"></i></a>
       
       <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$constituency->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a>
                                            <form method="POST" action="{{ route('districts.index', $constituency->id) }}" class="pull-right" id="delete-form-{{ $constituency->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" /></form></td>
                                                       
                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        

                    </div>

                </div>

            </div>

        @endsection
        @section('script')
            <!-- Javascript -->
            <script src="{{ URL::asset('assets/plugins/datatables/simple-datatables.js') }}"></script>
            <script src="{{ URL::asset('assets/pages/datatable.init.js') }}"></script>
            <script src="{{ URL::asset('assets/js/app.js') }}"></script>
        @endsection
        @section('body-end')
</body>
@endsection
