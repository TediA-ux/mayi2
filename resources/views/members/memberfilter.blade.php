@extends('layouts.master')
@section('title')Manage MPs @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
<form action="{{ url('/members/filter/mps') }}" id="filterAccountsOpenned" role="form" method="get">
    @csrf
    
    <div id="filter2" class="row all_entries_row  mb-3">
    
        <div class="col-md-2 ">
    
            <div class="form-group">
                    <Strong for="">Name</Strong>
                    <input type="text" name="name" class="form-control select" value="<?php echo request()->query('name'); ?>" placeholder="">
                 </div>
        </div>
       
        <div class="col-md-3 ">

            <div class="form-group">
                <div class="col-md-12" for="district"><strong >District</strong></div>
                <select id="district" class="form-select" name="district_id">
                    <option value="" @if(!request()->has('district_id')) selected @endif>Select</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" @if(request()->input('district_id') == $district->id) selected @endif>{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <strong>Constituency:</strong>
                <select id="constituency" class="form-select" name="constituency_id">
                    <option value="">Select</option>
                    @foreach ($constituencies as $constituency)
                        <option value="{{ $constituency->id }}" @if(request()->input('constituency_id') == $constituency->id) selected @endif>{{ $constituency->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-2 ">
            <div class="form-group">
                <div class="form-group">
                    <strong for="party">Political Party</strong>
                    <select id="party" class="form-select" name="party_id">
                        <option value="" @if(!request()->has('party_id')) selected @endif>Select</option>
                        @foreach($parties as $party)
                            <option value="{{ $party->id }}" @if(request()->input('party_id') == $party->id) selected @endif>{{ $party->name }}</option>
                        @endforeach
                    </select>
                </div> 
    
                
            </div>
        </div> 
       
        
        {{-- <div class="col-md-2 ">
            <div class="form-group">
                    <strong >Parliament:</strong>
                      <select class="form-select" name="parliament_id" required>
                        <option value="" selected>Select</option>
                          @foreach($parliaments as $parliament)
                      <option value="{{$parliament->id}}">{{$parliament->type}}</option>
                     @endforeach
                      </select>
            </div>
        </div> --}}
            <div class="col-md-2" >
                <button type="submit" style="margin-top: 25px;" class="btn btn-danger btn-sm journal-search-btn" > Filter</button>
            
        </div>
        
    </div>
      
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
    </form>

    
<div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-striped" id="">
                            <thead class="table-dark">
 <tr>
   <th>Title</th>
   <th>Surname</th>
   <th>Other Names</th>
   <th>Email</th>
   <th>Photo</th>
   <th>Gender</th>
   <th>Religion</th>
 </tr>
</thead>
 @foreach ($data as $key => $member)
  <tr>
    <td>{{ $member->title }}</td>
    <td>{{ $member->surname }}</td>
    <td>{{ $member->other_names }}</td>
    <td>{{ $member->email }}</td>
    <td><img width="50px" src="{{ asset('identification_photos/'.$member->photo) }}" style='border:3px solid {{$member->color}}'/></td>
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
