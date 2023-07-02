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
            <h2> Update Info</h2>
        </div>
        <div class="pull-right">
                <a class="btn btn-danger" href="{{ route('members.show',Crypt::encrypt($member->id)) }}"> Back</a>
                
      
        </div>
    </div>
</div>
@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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

<br>
<div>
<div class = "flex-container">
<div id="sidebar">
    <div id="options">
      <ul>
        <li><a href="#" onclick="changeContent(1)">Qualifications/Education</a></li>
        <li><a href="#" onclick="changeContent(2)">Employment Record</a></li>
        <li><a href="#" onclick="changeContent(3)">Special Interests</a></li>
        <li><a href="#" onclick="changeContent(4)">Professional Memberships</a></li>
      </ul>
    </div>
  </div>

      <div id="dynamic-content">
      <!-- Default dynamic content for the first option -->
      <div id="education-formContainer">
                <h4>Qualifications/Education</h3>
                <div class="education-form-container">
                <input type="text" hidden name="member_id" required>
                
                <label >Education:</label>
                <select name="qualification_id" required>
                    <option value="">Select</option>
                    @foreach($qualifications as $qualification)
                <option value="{{$qualification->id}}">{{$qualification->award_type}}</option>
              @endforeach
                </select>

                <label >Institution:</label>
                  <input type="text" name="institution">

                  <label >Year Attained:</label>
                  <input type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="YYYY" required oninput="limitDigits(this, 4)">

                
                
                <div class="add-remove-buttons">
                    <button class="remove" onclick="removeeducationForm(this)">Remove</button>
                </div>
                </div>
            </div>
            
            <div class="add-remove-buttons">
                <button onclick="addEducationForm()">Add</button>
            </div>
            
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-danger float-end">Submit</button>
    </div>
    </div>
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
            <form action="{{ route('store.education') }}" method="POST">
              @csrf
                <div id="education-formContainer">
                    <h4>Qualifications/Education</h3>
                    <div class="education-form-container form-control">
                    <input type="text" value="{{$member->id}}" hidden name="member_id[]" required>
                    
                    <label >Education:</label>
                    <select class="form-select" name="award_id[]" required>
                        <option value="">Select</option>
                        @foreach($qualifications as $qualification)
                    <option value="{{$qualification->id}}">{{$qualification->award_type}}</option>
                  @endforeach
                    </select>

                    <label >Institution:</label>
                      <input class="form-control" type="text" name="institution[]">

                      <label >Year Attained:</label>
                      <input class="form-control" type="number" id="year" name="year[]" min="1900" max="2099" step="1" placeholder="YYYY" required oninput="limitDigits(this, 4)">

                    
                    
                    <div class="add-remove-buttons">
                        <button class="remove" onclick="removeeducationForm(this)">Remove</button>
                    </div>
                    </div>
                </div>
                
                <div class="add-remove-buttons">
                    <button onclick="addEducationForm()">Add</button>
                </div>
                <br>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-danger float-end">Submit</button>
            </div>
        </form>
       </div>
            `;
          break;
        case 2:
          dynamicContent.innerHTML = `
          <form action="{{ route('store.experience') }}" method="POST">
              @csrf
              <div id="employment-formContainer">
                  <h4>Employment Record</h3>
                  <div class="employment-form-container form-group">
                  <input type="text" value="{{$member->id}}" hidden name="member_id[]" required>
                  
                  <label >Profession:</label>
                  <select class="form-select" name="profession_id[]" required>
                      <option value="">Select</option>
                      @foreach($professions as $profession)
                  <option value="{{$profession->id}}">{{$profession->name}}</option>
                @endforeach
                  </select>

                  <label >Organization:</label>
            <input type="text" name="organization[]" class="form-control">

            <label >From:</label>
            <input class="form-control" type="number" id="year" name="year_from[]" min="1900" max="2099" step="1" placeholder="YYYY" required oninput="limitDigits(this, 4)">

            <label >To:</label>
            <input class="form-control" type="number" id="year" name="year_to[]" min="1900" max="2099" step="1" placeholder="YYYY" required oninput="limitDigits(this, 4)">
                  
                  
                  <div class="add-remove-buttons">
                      <button class="remove" onclick="removeemploymentForm(this)">Remove</button>
                  </div>
                  </div>
              </div>
              
              <div class="add-remove-buttons">
                  <button onclick="addEmploymentForm()">Add</button>
              </div>
              <br>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-danger float-end">Submit</button>
          </div>
        </form>
       </div>
                `;

          break;
        case 3:
            dynamicContent.innerHTML = `
            <form action="{{ route('store.hobbies') }}" method="POST">
              @csrf
              <div id="hobby-formContainer">
                  <h4>Special Interests</h3>
                  <div class="hobby-form-container form-group">
                  <input type="text" value="{{$member->id}}" hidden name="member_id[]" required>
                  
                  <label >Hobby:</label>
                  <select class="form-select" name="hobby_id[]" required>
                      <option value="">Select</option>
                      @foreach($hobbies as $hobby)
                  <option value="{{$hobby->id}}">{{$hobby->hobbies}}</option>
                @endforeach
                  </select>
                  
                  
                    <div class="add-remove-buttons">
                        <button class="remove" onclick="removehobbyForm(this)">Remove</button>
                    </div>
                    </div>
                </div>
                
                <div class="add-remove-buttons">
                    <button onclick="addHobbyForm()">Add</button>
                </div>
                <br>
              <button type="submit" class="btn btn-danger float-end">Submit</button>
            </form>
          </div>
                `;

          break;
        case 4:
            dynamicContent.innerHTML = `
            <form action="{{ route('store.memberships') }}" method="POST">
              @csrf
                  <div id="formContainer">
                      <h4>Professional Memberships/Associations</h3>
                      <div class="form-container form-group">
                      <input type="text" value="{{$member->id}}" hidden name="member_id[]" required>
                      
                      <label >Professional Body:</label>
                      <select class="form-select" name="professional_body_id[]" required>
                          <option value="">Select</option>
                          @foreach($professionalbodies as $professionalbodie)
                      <option value="{{$professionalbodie->id}}">{{$professionalbodie->name}}</option>
                    @endforeach
                      </select>
                      
                      
                      <div class="add-remove-buttons">
                          <button class="remove" onclick="removeForm(this)">Remove</button>
                      </div>
                      </div>
                  </div>
                  
                  <div class="add-remove-buttons">
                      <button onclick="addForm()">Add</button>
                  </div>
                  <br>
                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-danger float-end">Submit</button>
                </form>
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
    var qualifications = <?php echo json_encode($qualifications); ?>;
    function addEducationForm() {
      var formContainer = document.getElementById('education-formContainer');
      
      var newForm = document.createElement('div');
      newForm.className = 'education-form-container form-control';
      
      newForm.innerHTML = `
            <input type="text" value="{{$member->id}}" hidden name="member_id[]" required>
            
            <label >Award Type:</label>
            <select class="form-select" name="award_id[]" required>
                <option value="">Select</option>
                ${generateQualificationOptions(qualifications)}
            </select>

            <label >Institution:</label>
            <input type="text" class="form-control" name="institution[]">

            <label >Year Attained:</label>
            <input type="number" class="form-control" id="year" name="year[]" min="1900" max="2099" step="1" placeholder="YYYY" required oninput="limitDigits(this, 4)">

                
                
                <div class="add-remove-buttons">
                <button class="remove" onclick="removeeducationForm(this)">Remove</button>
                </div>
      `;
      
      formContainer.appendChild(newForm);
    }

    function generateQualificationOptions(qualifications) {
        var options = '';
        qualifications.forEach(qualification => {
            options += `<option value="${qualification.id}">${qualification.award_type}</option>`;
        });
        return options;
    }
    
    function removeeducationForm(button) {
      var formContainer = document.getElementById('education-formContainer');
      var form = button.closest('.education-form-container');
      
      formContainer.removeChild(form);
    }
  </script>


      <!-- Employment Record -->
  <script>
    var professions = <?php echo json_encode($professions); ?>;
    function addEmploymentForm() {
      var formContainer = document.getElementById('employment-formContainer');
      
      var newForm = document.createElement('div');
      newForm.className = 'employment-form-container form-control';
      
      newForm.innerHTML = `
            <input type="text" value="{{$member->id}}" hidden name="member_id[]" required>

            <label>Profession:</label>
            <select class="form-select" name="profession_id[]" required>
                <option value="">Select</option>
                ${generateEmploymentOptions(professions)}
            </select>

            <label >Organization:</label>
            <input type="text" name="organization[]">

            <label >From:</label>
            <input class="form-control" type="number" id="year" name="year_from[]" min="1900" max="2099" step="1" placeholder="YYYY" oninput="limitDigits(this, 4)" required>

            <label >To:</label>
            <input class="form-control" type="number" id="year" name="year_to[]" min="1900" max="2099" step="1" placeholder="YYYY" oninput="limitDigits(this, 4)" required>

                
                
                <div class="add-remove-buttons">
                <button class="remove" onclick="removeemploymentForm(this)">Remove</button>
                </div>
      `;
      
      formContainer.appendChild(newForm);
    }

    function generateEmploymentOptions(professions) {
        var options = '';
        professions.forEach(profession => {
            options += `<option value="${profession.id}">${profession.name}</option>`;
        });
        return options;
    }
    
    function removeemploymentForm(button) {
      var formContainer = document.getElementById('employment-formContainer');
      var form = button.closest('.employment-form-container');
      
      formContainer.removeChild(form);
    }
  </script>




    <!-- hobby script -->

<script>
    var hobby = <?php echo json_encode($hobbies); ?>;
    function addHobbyForm() {
      var formContainer = document.getElementById('hobby-formContainer');
      
      var newForm = document.createElement('div');
      newForm.className = 'hobby-form-container form-group';
      
      newForm.innerHTML = `
      <input type="text" value="{{$member->id}}" hidden name="member_id[]" required>
      
      <label >Hobby:</label>
      <select class="form-select" name="hobby_id[]" required>
        <option value="">Select</option>
        ${generateHobbyOptions(hobby)}
      </select>
        
        
        <div class="add-remove-buttons">
          <button class="remove" onclick="removehobbyForm(this)">Remove</button>
        </div>
      `;
      
      formContainer.appendChild(newForm);
    }

    // Generate the hobby options dynamically
    function generateHobbyOptions(hobby) {
        var options = '';
        hobby.forEach(hob => {
            options += `<option value="${hob.id}">${hob.hobbies}</option>`;
        });
        return options;
    }
    
    function removehobbyForm(button) {
      var formContainer = document.getElementById('hobby-formContainer');
      var form = button.closest('.hobby-form-container');
      
      formContainer.removeChild(form);
    }
  </script>

  <!-- Professional Memberships script -->

<script>
     var bodies = <?php echo json_encode($professionalbodies); ?>;
    function addForm() {
      var formContainer = document.getElementById('formContainer');
      
      var newForm = document.createElement('div');
      newForm.className = 'form-container';
      
      newForm.innerHTML = `
      <input type="text" value="{{$member->id}}" hidden name="member_id[]" required>
      
      <label >Professional Body:</label>
      <select class="form-select" name="professional_body_id[]" required>
        <option value="">Select</option>
        ${generateBodyOptions(bodies)}
      </select>
        
        
        <div class="add-remove-buttons">
          <button class="remove" onclick="removeForm(this)">Remove</button>
        </div>
      `;
      
      formContainer.appendChild(newForm);
    }

    function generateBodyOptions(bodies) {
        var options = '';
        bodies.forEach(body => {
            options += `<option value="${body.id}">${body.name}</option>`;
        });
        return options;
    }
    
    function removeForm(button) {
      var formContainer = document.getElementById('formContainer');
      var form = button.closest('.form-container');
      
      formContainer.removeChild(form);
    }
  </script>

<script>
function limitDigits(input, maxLength) {
  if (input.value.length > maxLength) {
    input.value = input.value.slice(0, maxLength);
  }
}
</script>

    @endsection
    @section('body-end')
</body> @endsection

 


 

  


