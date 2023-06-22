/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/pages/file-upload.init.js ***!
  \*********************************************/
/**
 * Theme: Unikit - Responsive Bootstrap 5 Admin Dashboard
 * Author: Mannatthemes
 * Dropzone Js
 */
var handleChange = function handleChange() {
  var fileUploader = document.querySelector('#input-file');
  var getFile = fileUploader.files;

  if (getFile.length !== 0) {
    var uploadedFile = getFile[0];
    readFile(uploadedFile);
  }
};

var readFile = function readFile(uploadedFile) {
  if (uploadedFile) {
    var reader = new FileReader();

    reader.onload = function () {
      var parent = document.querySelector('.preview-box');
      parent.innerHTML = "<img class=\"preview-content\" src=".concat(reader.result, " />");
    };

    reader.readAsDataURL(uploadedFile);
  }
};

var uppy = Uppy.Core().use(Uppy.Dashboard, {
  inline: true,
  target: '#drag-drop-area'
}).use(Uppy.Tus, {
  endpoint: 'https://google.com'
});
uppy.on('complete', function (result) {
  console.log('Upload complete! We’ve uploaded these files:', result.successful);
});
/******/ })()
;