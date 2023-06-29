@extends('layouts.master')
@section('title')Manage Users @endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/datatables/datatable.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body-start') <body id="body" class="dark-sidebar"> @endsection
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
        <div class="pull-right">
            <a class="btn btn-danger" href="{{ route('members.index') }}"> Back</a>
        </div>
    </div>
</div>

<br>
<div>
<div class = "body">
<div id="sidebar">
    <div id="options">
      <ul>
        <li><a href="#" onclick="changeContent(1)">Qualifications/Education</a></li>
        <li><a href="#" onclick="changeContent(2)">Employment Record</a></li>
        <li><a href="#" onclick="changeContent(3)">Special Interests</a></li>
        <li><a href="#" onclick="changeContent(4)">Next of kin</a></li>
        <!-- <li><a href="#" onclick="changeContent(3)">Option 3</a></li>
        <li><a href="#" onclick="changeContent(4)">Option 4</a></li>
        <li><a href="#" onclick="changeContent(5)">Option 5</a></li>
        <li><a href="#" onclick="changeContent(6)">Option 6</a></li> -->
      </ul>
    </div>
  </div>

  <div id="content">
    <div id="bio-data">
        <h3>Summary</h3>
    <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <div class="flex-container">
            <strong>Title:</strong>
            {{ $member->title }}
         </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Surname:</strong>
            {{ $member->surname }}
         </div>
            
        </div>
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Other Names:</strong>
            {{ $member->other_names }}
         </div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Email:</strong>
            {{ $member->email }}
         </div>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>DOB:</strong>
            {{ $member->dob }}
         </div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Religion:</strong>
            {{ $member->religion }}
         </div>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Gender:</strong>
            {{ $member->gender }}
         </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Landline:</strong>
            {{ $member->landline }}
         </div>
            
        </div>
    </div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Phone Contact:</strong>
            {{ $member->phone_number }}
         </div>
           
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Other Contact:</strong>
            {{ $member->alt_contact }}
         </div>
            
        </div>
    </div>
    
</div>

<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
        <div class="flex-container">
        <strong>Postal Address:</strong>
            {{ $member->postal_address }}
         </div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <div class="flex-container">
            <strong>District:</strong>
            {{ $member->name }}
         </div>
            
        </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <div class="flex-container">
        <strong>Constituency:</strong>
            {{ $member->name }}
         </div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
        <div class="flex-container">
        <strong>Political Party:</strong>
            {{ $member->name }}
         </div>
           
        </div>
    </div>
    <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
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
    <div id="dynamic-content">
      <!-- Default dynamic content for the first option -->
      <h2>Option 1 Content</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
</div>

 


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