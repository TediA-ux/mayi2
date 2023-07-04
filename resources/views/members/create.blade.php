@extends('layouts.master')
@section('title')Manage MPs @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') Member of Parliament @endslot
    @endcomponent
    @endsection

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Member</h2>
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
                  <p class="text-muted mb-0">Fill in all fields</p>
                </div>
                <!--end card-header-->
                <div class="card-body">
{!! Form::open(array('route' => 'members.store','method'=>'POST', 'enctype' =>'multipart/form-data')) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Title:</strong>
            {!! Form::text('title', null, array('placeholder' => 'Enter  Title','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Surname:</strong>
            {!! Form::text('surname', null, array('placeholder' => 'Enter Surname','class' => 'form-control')) !!}
        </div>
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Other Names:</strong>
            {!! Form::text('other_names',  null,array('placeholder' => 'Other Names','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>DOB:</strong>
    
            <input class="form-control" type="date" id="date-input" name="dob">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Religion:</strong>
            <select class="form-select input-sm" name="religion">
             <option value="">--Select Religion --</option>
             <option value="Catholic">Catholic</option>
             <option value="Anglican">Anglican</option>
             <option value="Pentecostal">Pentecostal</option>
             <option value="Muslim">Muslim</option>
             <option value="Born Again">Born Again</option>
             <option value="Seventh Day Adventist">Seventh Day Adventist</option>
             <option value="Orthodox">Orthodox</option>
             <option value="Other">Other</option>

            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Gender:</strong>
            <select class="form-select input-sm" name="gender">
             <option value="">--Select Gender --</option>
             <option value="Male">Male</option>
             <option value="Female">Female</option>

            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Landline:</strong>
            {!! Form::text('landline', null, array('placeholder' => 'Enter Landline','class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Phone Contact:</strong>
            {!! Form::text('phone_number', null, array('placeholder' => 'Enter Contact','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Other Contact:</strong>
            {!! Form::text('alt_contact',  null,array('placeholder' => 'Other Contact','class' => 'form-control')) !!}
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Marital Status:</strong>
            <select class="form-select input-sm" name="marital_status">
             <option value="">--Select Status --</option>
             <option value="Married">Married</option>
             <option value="Single">Single</option>

            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Photo:</strong><br>
            <input type="file" name="photo" class="form-group" placeholder="image">
        </div>
    </div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Postal Address:</strong>
            {!! Form::text('postal_address', null, array('placeholder' => 'Enter Postal Address','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>District:</strong>
            <select id="district"  class="form-control select"  name="district_id">
                <option value="" selected>Select</option>
                @foreach($districts as $district)
                <option value="{{$district->id}}">{{$district->name}}</option>
              @endforeach

            </select>
        </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Constituency:</strong>
            <select id="constituency" class="form-select" name="constituency_id">
                <option value=""></option>
               

            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Political Party:</strong>
            <select id="party" class="form-select" name="party_id">
                <option value="" selected>Select</option>
                @foreach($parties as $party)
                <option value="{{$party->id}}">{{$party->name}}</option>
              @endforeach

            </select>
        </div>
    </div>
<br>
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

    


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function () {
        $('#district').select2();
        
    });
</script>



<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="district_id"]').on('change',function(){
               var d_id = jQuery(this).val();
               console.log(d_id);
               if(d_id)
               {
                  jQuery.ajax({
                     url : '/district-constituencies/'+ d_id,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="constituency_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="constituency_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="constituency_id"]').empty();
               }
            });
    });
    </script>







    @endsection
    @section('body-end')
</body> @endsection
