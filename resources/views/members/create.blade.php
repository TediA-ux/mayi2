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
{!! Form::open(array('route' => 'members.store','method'=>'POST')) !!}
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
            <input class="form-control"  min=<?php
            echo date('Y-m-d'); ?> type="datetime-local" name="dob" value="" id="datetime-local-input">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Religion:</strong>
            {!! Form::text('religion', null, array('placeholder' => 'Enter Religion','class' => 'form-control')) !!}
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
             <option value="Divorced">Divorced</option>
             <option value="Separated">Separated</option>
             <option value="Widowed">Widowed</option>

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
            <select id="district" class="form-select" name="district_id">
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

    <div class='qualifications'>

    <div id="container">
    <!-- Initially, there can be some input fields -->
    <div>
        <h4>Qualifications/Education</h4>
    </div>
    <div class="input-container form-group" style='margin-bottom: 10px;' name='qualifications[]'>
      <label>Add Qualifications</label>
 
</div>
  </div>
  <div onclick="addInputField()" style='border: 1px solid; width: 50px; border-radius: 5px; padding: 5px;background-color: black; color: white;'>
    <label >More</label>
  </div>
  <br>
<hr>
</div>

<div class='hobby'>

<div id="hobby-container">
<!-- Initially, there can be some input fields -->
<div>
    <h4>Special Interests/Hobbies</h4>
</div>
<div class="hobby-input-container form-group" style='margin-bottom: 10px;' name='hobby_id[]'>
  <label>Add Hobbies</label>
 
 
</div>

</div>
<div onclick="addHobbyInputField()" style='border: 1px solid; width: 50px; border-radius: 5px; padding: 5px; background-color: black; color: white;'>
<label >More</label>
</div>

</div>



  
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

    <!-- Javascript -->
    <script src="{{ URL::asset('assets/pages/form-wizard.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>


<script>
  const districtDropdown = document.getElementById('district');
  const constDropdown = document.getElementById('constituency');

  districtDropdown.addEventListener('change', () => {
      const id = districtDropdown.value;
      constDropdown.innerHTML = '<option value="">Loading...</option>';
      constDropdown.disabled = true;

      fetch(`/district-constituencies/${id}`)
          .then(response => response.json())
          .then(constituencies => {
            constDropdown.innerHTML = '<option value="">Select a constituency</option>';
            constituencies.forEach(constituency => {
                  const option = document.createElement('option');
                  option.value = constituency.id;
                  option.textContent = constituency.name;
                  constDropdown.appendChild(option);
              });
              constDropdown.disabled = false;
          })
          .catch(error => console.error(error));
  });
</script>

<script>
    function addInputField() {
      var container = document.getElementById("container");

      var inputContainer = document.createElement("div");
      inputContainer.className = "input-container";

      var awardTypeLabel = document.createElement("label");
      awardTypeLabel.textContent = "Award Type:";
      var awardTypeInput = document.createElement("input");
      awardTypeInput.type = "text";
      inputContainer.appendChild(awardTypeLabel);
      inputContainer.appendChild(awardTypeInput);

      var awardLabel = document.createElement("label");
      awardLabel.textContent = "Award:";
      var awardInput = document.createElement("input");
      awardInput.type = "text";
      inputContainer.appendChild(awardLabel);
      inputContainer.appendChild(awardInput);

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

    <!-- committee script -->

  <script>
     var committees = <?php echo json_encode($committees); ?>;
    function addCommitteeInputField() {
      var committeeContainer = document.getElementById("committee-container");

      var committeeInputContainer = document.createElement("div");
      committeeInputContainer.className = "committees-input-container form-group";
      committeeInputContainer.style.marginBottom = "10px";

      var committeeLabel = document.createElement("label");
      committeeLabel.textContent = "Committee:";
      hobbyInputContainer.appendChild(committeeLabel);

      var committeeSelect = document.createElement("select");
      committeeSelect.id = "hobby";
      committeeSelect.className = "form-select";
      committeeSelect.name = "hobbies[]";

      var defaultOption = document.createElement("option");
      defaultOption.value = "";
      defaultOption.text = "Select";
      defaultOption.selected = true;
      committeeSelect.appendChild(defaultOption);


    committees.forEach(function(committee) {
        var committeeOption = document.createElement("option");
        committeeOption.value = committee.id;
        committeeOption.text = committee.committee_name;
        committeeSelect.appendChild(committeeOption);
      });

      committeeInputContainer.appendChild(committeeSelect);

      var removeButton = document.createElement("button");
      removeButton.textContent = "Remove";
      removeButton.onclick = function() {
        committeeContainer.removeChild(committeeInputContainer);
      };
      committeeInputContainer.appendChild(removeButton);

      committeeContainer.appendChild(committeeInputContainer);
    }
  </script>


    @endsection
    @section('body-end')
</body> @endsection
