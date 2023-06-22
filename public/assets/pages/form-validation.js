/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/pages/form-validation.js ***!
  \********************************************/
/**
 * Theme: Unikit - Responsive Bootstrap 4 Admin Dashboard
 * Author: Mannatthemes
 * Form Validation Js
 */
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'; // Fetch all the forms we want to apply custom Bootstrap validation styles to

  var forms = document.querySelectorAll('.needs-validation'); // Loop over them and prevent submission

  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      form.classList.add('was-validated');
    }, false);
  });
  var form = document.getElementById('form-validation-2');
  var username = document.getElementById('username');
  var email = document.getElementById('email');
  var password = document.getElementById('password');
  var password2 = document.getElementById('password2'); //Show input error messages

  function showError(input, message) {
    var formControl = input.parentElement;
    console.log(formControl.children);
    formControl.children[1].classList.add('error');
    var small = formControl.querySelector('small');
    small.innerText = message;
    small.classList.add('error');
    small.classList.remove('success');
  } //show success colour


  function showSucces(input) {
    var formControl = input.parentElement;
    formControl.children[1].classList.remove('error');
    formControl.children[1].classList.add('success');
    var small = formControl.querySelector('small');
    small.classList.add('success');
    small.classList.remove('error');
  } //check email is valid


  function checkEmail(input) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (re.test(input.value.trim())) {
      showSucces(input);
    } else {
      showError(input, 'Email is not invalid');
    }
  } //checkRequired fields


  function checkRequired(inputArr) {
    inputArr.forEach(function (input) {
      if (input.value.trim() === '') {
        showError(input, "".concat(getFieldName(input), " is required"));
      } else {
        showSucces(input);
      }
    });
  } //check input Length


  function checkLength(input, min, max) {
    if (input.value.length < min) {
      showError(input, "".concat(getFieldName(input), " must be at least ").concat(min, " characters"));
    } else if (input.value.length > max) {
      showError(input, "".concat(getFieldName(input), " must be les than ").concat(max, " characters"));
    } else {
      showSucces(input);
    }
  } //get FieldName


  function getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
  } // check passwords match


  function checkPasswordMatch(input1, input2) {
    if (input1.value !== input2.value) {
      showError(input2, 'Passwords do not match');
    }
  } //Event Listeners


  form.addEventListener('submit', function (e) {
    e.preventDefault();
    checkRequired([username, email, password, password2]);
    checkLength(username, 3, 15);
    checkLength(password, 6, 25);
    checkEmail(email);
    checkPasswordMatch(password, password2);
  });
})();
/******/ })()
;