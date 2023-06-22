/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/pages/form-wizard.js ***!
  \****************************************/
/**
 * Theme: Unikit - Responsive Bootstrap 4 Admin Dashboard
 * Author: Mannatthemes
 * Form Wizard Js
 */
var step1Next = document.getElementById('step1Next');
var step1Tab = document.getElementById('step1-tab');
var step1 = document.getElementById('step1');
var step2Next = document.getElementById('step2Next');
var step2Prev = document.getElementById('step2Prev');
var step2Tab = document.getElementById('step2-tab');
var step2 = document.getElementById('step2');
var step3Next = document.getElementById('step3Next');
var step3Prev = document.getElementById('step3Prev');
var step3Tab = document.getElementById('step3-tab');
var step3 = document.getElementById('step3');
var step4Finish = document.getElementById('step4Finish');
var step4Prev = document.getElementById('step4Prev');
var step4Tab = document.getElementById('step4-tab');
var step4 = document.getElementById('step4');
step1Next.addEventListener('click', function () {
  step1Tab.classList.remove('active');
  step1.classList.remove('active');
  step2Tab.classList.add('active');
  step2.classList.add('active');
});
step2Prev.addEventListener('click', function () {
  step1Tab.classList.add('active');
  step1.classList.add('active');
  step2Tab.classList.remove('active');
  step2.classList.remove('active');
});
step3Prev.addEventListener('click', function () {
  step2Tab.classList.add('active');
  step2.classList.add('active');
  step3Tab.classList.remove('active');
  step3.classList.remove('active');
});
step4Prev.addEventListener('click', function () {
  step3Tab.classList.add('active');
  step3.classList.add('active');
  step4Tab.classList.remove('active');
  step4.classList.remove('active');
});
step2Next.addEventListener('click', function () {
  step3Tab.classList.add('active');
  step3.classList.add('active');
  step2Tab.classList.remove('active');
  step2.classList.remove('active');
});
step3Next.addEventListener('click', function () {
  step4Tab.classList.add('active');
  step4.classList.add('active');
  step3Tab.classList.remove('active');
  step3.classList.remove('active');
});
/******/ })()
;