@extends('layouts.master')
@section('title')Manage MP @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('title') Datatables @endslot
    @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Member Info</h2>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="pull-right">
            <div style = "display:flex">
                <a class="btn btn-danger" href="{{ route('members.index') }}"> Back</a>
                <div class="ms-auto"> 
                <a class="btn btn-sm btn-primary" href="{{ route('members.edit',Crypt::encrypt($member->id)) }}"><i class="fas fa-pencil-alt"> Edit</i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<div>
<div class = "body">

  <div id="content">
    
    <div id="bio-data">
      <div style="display:flex;align-items: center;">
         <div class="profile-img">
      <img src="path/to/profile-image.jpg" alt="Profile Image">
    </div>
        <h3>Summary</h3>
      </div>
   <br>
    <div class="row ">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
          <div class="flex-container">
            <strong>Title:</strong>
            {{ $member->title }}
         </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Surname:</strong>
            {{ $member->surname }}
         </div>
            
        </div>
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Other Names:</strong>
            {{ $member->other_names }}
         </div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Email:</strong>
            {{ $member->email }}
         </div>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>DOB:</strong>
            {{ $member->dob }}
         </div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Religion:</strong>
            {{ $member->religion }}
         </div>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Gender:</strong>
            {{ $member->gender }}
         </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Landline:</strong>
            {{ $member->landline }}
         </div>
            
        </div>
    </div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Phone Contact:</strong>
            {{ $member->phone_number }}
         </div>
           
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Other Contact:</strong>
            {{ $member->alt_contact }}
         </div>
            
        </div>
    </div>
    
</div>

<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Postal Address:</strong>
            {{ $member->postal_address }}
         </div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
            <div class="flex-container">
            <strong>District:</strong>
            {{ $member->district }}
         </div>
            
        </div>
</div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Constituency:</strong>
            {{ $member->constituency }}
         </div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Political Party:</strong>
            {{ $member->party }}
         </div>
           
        </div>
    </div>
</div>
    <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group faint-border-bottom pb-1">
        <div class="flex-container">
        <strong>Marital Status:</strong>
            {{ $member->marital_status }}
         </div>
            
        </div>
    </div>
    
</div>



    </div>
    </div>
</div>
<br>
<div class="pull-right">
<a class="btn btn-danger" href="{{ route('members.addmore', Crypt::encrypt($member->id)) }}) }}"> Add Info</a>
              
        </div>
<br>
    <div id="bio-data">
      <!-- Default dynamic content for the first option -->
      <h3>Education Record</h3>
      <div class="table-responsive">
                        <table class="table table-striped" id="datatable_1">
                            <thead class="table-dark">
 <tr>
   <th>Year</th>
   <th>Award</th>
   <th>Institution</th>
   <th >Action</th>
 </tr>
</thead>
@foreach ($qualifications as $key => $qualification)
  <tr>
    <td>{{ $qualification->year }}</td>
    <td>{{ $qualification->award }}</td>
    <td>{{ $qualification->institution }}</td>
    <td>
    
    <a class="btn btn-sm btn-primary" href="{{ route('education.edit',Crypt::encrypt($qualification->id)) }}"><i class="fas fa-pencil-alt"></i></a>
       <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$qualification->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a>
                                            <form method="POST" action="{{ route('members.index', $qualification->id) }}" class="pull-right" id="delete-form-{{ $member->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" /></form>

     </td>

  </tr>
  @endforeach
</table>

</div>
    </div>

    <br>
    <div id="bio-data">
      <!-- Default dynamic content for the first option -->
      <h3>Work Experience</h3>
      <div class="table-responsive">
                        <table class="table table-striped" id="datatable_2">
                            <thead class="table-dark">
 <tr>
   <th>Profession</th>
   <th>Organization</th>
   <th>From</th>
   <th>To</th>
   <th >Action</th>
 </tr>
</thead>
@foreach ($jobs as $key => $job)
  <tr>
    <td>{{ $job->work }}</td>
    <td>{{ $job->organization }}</td>
    <td>{{ $job->year_from }}</td>
    <td>{{ $job->year_to }}</td>
    <td>
    
    <a class="btn btn-sm btn-primary" href="{{ route('work.edit',Crypt::encrypt($job->id)) }}"><i class="fas fa-pencil-alt"></i></a>
       <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$member->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a>
                                            <form method="POST" action="{{ route('members.index', $member->id) }}" class="pull-right" id="delete-form-{{ $member->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" /></form>

     </td>

  </tr>
  @endforeach
</table>

</div>
    </div>
 
   


    <br>
    <div class="three-sections" style="display:flex">
        <div class="item">
      <!-- Default dynamic content for the first option -->
      <h4>Parliaments</h4>
      <div class="table-responsive">
                        <table class="table table-striped" id="datatable_3">
                            <thead class="table-dark">
 <tr>
   <th>Type</th>
   <th>Responsibility</th>
   <th>Action</th>
 
 </tr>
</thead>
@foreach($ptypes as $key => $ptype)
  <tr>
    <td>{{ $ptype->type }}</td>
    <td>{{ $ptype->responsibility }}</td>
    <td>
    
    <a class="btn btn-sm btn-primary" href="{{ route('member-parliament-type.edit',Crypt::encrypt($ptype->id)) }}"><i class="fas fa-pencil-alt"></i></a>
       <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$member->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a>
                                            <form method="POST" action="{{ route('members.index', $member->id) }}" class="pull-right" id="delete-form-{{ $member->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" /></form>

     </td>

  </tr>
  @endforeach
</table>

</div>
    </div>

    <div class="item">
      <!-- Default dynamic content for the first option -->
      <h4>Special Interest</h4>
      <div class="table-responsive">
                        <table class="table table-striped" id="datatable_4">
                            <thead class="table-dark">
 <tr>
   <th>Hobbies</th>
   <th>Action</th>
 </tr>
</thead>
@foreach ($hobbies as $key => $hobby)
  <tr>
    <td>{{ $hobby->hobby}}</td>
    <td>
    
    <a class="btn btn-sm btn-primary" href="{{ route('member-hobbies.edit',Crypt::encrypt($hobby->id)) }}"><i class="fas fa-pencil-alt"></i></a>
       <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$hobby->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a>
                                            <form method="POST" action="{{ route('members.index', $hobby->id) }}" class="pull-right" id="delete-form-{{ $hobby->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST" /></form>

     </td>

  </tr>
  @endforeach
</table>

</div>
    </div>

    <div class="item">
      <!-- Default dynamic content for the first option -->
      <h4>Associations/Memberships</h4>
      <div class="table-responsive">
                        <table class="table table-striped" id="datatable_5">
                            <thead class="table-dark">
 <tr>
   <th>Professional Body</th>
   <th>Action</th>
 </tr>
</thead>
@foreach ($memberships as $key => $membership)
  <tr>
    <td>{{ $membership->body}}</td>
    <td>
    
    <a class="btn btn-sm btn-primary" href="{{ route('memberships.edit',Crypt::encrypt($membership->id)) }}"><i class="fas fa-pencil-alt"></i></a>
       <a class="btn btn-sm btn-danger" onClick="if(confirm('Are you sure you want to delete this?')){document.getElementById('delete-form-{{$membership->id}}').submit();}else{event.preventDefault();}" href="#"><i class="far fa-trash-alt"></i></a>
                                            <form method="DELETE" action="{{ route('memberships.destroy', $membership->id) }}" class="pull-right" id="delete-form-{{ $membership->id }}" >
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE" /></form>

     </td>

  </tr>
  @endforeach
</table>

</div>

    </div>
    

    </div>
    

    <br><br>
</div>

@endsection
    @section('script')

    <!-- Javascript -->
    <script src="{{ URL::asset('assets/plugins/datatables/simple-datatables.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/datatable.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script>
    // JavaScript code
    function changeContent(option) {
      var dynamicContent = document.getElementById('dynamic-content');
      
      // Clear previous content
      dynamicContent.innerHTML = '';

      switch (option) {
        case 1:
            dynamicContent.innerHTML = `
            <h2>Qualifications/Education</h2>
            <div id="container">
            
            </div>
            <button onclick="addInputField()" >Add</button>
            `;
          break;
        case 2:
          dynamicContent.innerHTML = '<h2>Option 2 Content</h2><p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>';
          break;
        case 3:
            dynamicContent.innerHTML = `
                <div class="hobby">
                    <div id="hobby-container">
                    <!-- Initially, there can be some input fields -->
                    <div>
                        <h4>Special Interests/Hobbies</h4>
                    </div>
                    <div class="hobby-input-container form-group" style="margin-bottom: 10px;" name="hobby_id[]">
                        <label>Add Hobbies</label>
                    </div>
                    </div>
                    <button onclick="addHobbyInputField()" >Add</button>
                   
                </div>
                `;

          break;
        default:
          dynamicContent.innerHTML = '<p>No content available for the selected option.</p>';
          break;
      }
    }
  </script>

  <!-- Education -->
  <script>
    function addInputField() {
      var container = document.getElementById("container");

      var inputContainer = document.createElement("div");
      inputContainer.className = "input-container";

      var awardTypeLabel = document.createElement("label");
      awardTypeLabel.textContent = "Award Type:";
      var awardTypeInput = document.createElement("input");
      awardTypeInput.type = "select";
      inputContainer.appendChild(awardTypeLabel);
      inputContainer.appendChild(awardTypeInput);


      
      var institutionLabel = document.createElement("label");
      institutionLabel.textContent = "Institution:";
      var institutionInput = document.createElement("input");
      institutionInput.type = "text";
      inputContainer.appendChild(institutionLabel);
      inputContainer.appendChild(institutionInput);

      var yearLabel = document.createElement("label");
      yearLabel.textContent = "Year Attained:";
      var yearInput = document.createElement("input");
      yearInput.type = "text";
      inputContainer.appendChild(yearLabel);
      inputContainer.appendChild(yearInput);

      var removeButton = document.createElement("button");
      removeButton.textContent = "Remove";
      removeButton.onclick = function() {
        container.removeChild(inputContainer);
      };
      inputContainer.appendChild(removeButton);

      container.appendChild(inputContainer);
    }
  </script>

    <!-- hobby script -->

    <script>
     var hobbies = <?php echo json_encode($hobbies); ?>;
    function addHobbyInputField() {
      var hobbyContainer = document.getElementById("hobby-container");

      var hobbyInputContainer = document.createElement("div");
      hobbyInputContainer.className = "hobby-input-container form-group";
      hobbyInputContainer.style.marginBottom = "10px";

      var hobbyLabel = document.createElement("label");
      hobbyLabel.textContent = "Hobby:";
      hobbyInputContainer.appendChild(hobbyLabel);

      var hobbySelect = document.createElement("select");
      hobbySelect.id = "hobby";
      hobbySelect.className = "form-select";
      hobbySelect.name = "hobbies[]";

      var defaultOption = document.createElement("option");
      defaultOption.value = "";
      defaultOption.text = "Select";
      defaultOption.selected = true;
      hobbySelect.appendChild(defaultOption);


    hobbies.forEach(function(hobby) {
        var hobbyOption = document.createElement("option");
        hobbyOption.value = hobby.id;
        hobbyOption.text = hobby.hobbies;
        hobbySelect.appendChild(hobbyOption);
      });

      hobbyInputContainer.appendChild(hobbySelect);

      var removeButton = document.createElement("button");
      removeButton.textContent = "Remove";
      removeButton.onclick = function() {
        hobbyContainer.removeChild(hobbyInputContainer);
      };
      hobbyInputContainer.appendChild(removeButton);

      hobbyContainer.appendChild(hobbyInputContainer);
    }
  </script>

    @endsection
    @section('body-end')
</body> @endsection

 


 

  


