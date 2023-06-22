/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/pages/datatable.init.js ***!
  \*******************************************/
/**
 * Theme: Unikit - Responsive Bootstrap 5 Admin Dashboard
 * Author: Mannatthemes
 * Datatables Js
 */
var dataTable = new simpleDatatables.DataTable("#datatable_1", {
  searchable: true,
  fixedHeight: false
});
var dataTable_2 = new simpleDatatables.DataTable("#datatable_2");
document.querySelector("button.csv").addEventListener("click", function () {
  dataTable_2["export"]({
    type: "csv",
    download: true,
    lineDelimiter: "\n\n",
    columnDelimiter: ";"
  });
});
document.querySelector("button.sql").addEventListener("click", function () {
  dataTable_2["export"]({
    type: "sql",
    download: true,
    tableName: "export_table"
  });
});
document.querySelector("button.txt").addEventListener("click", function () {
  dataTable_2["export"]({
    type: "txt",
    download: true
  });
});
document.querySelector("button.json").addEventListener("click", function () {
  dataTable_2["export"]({
    type: "json",
    download: true,
    escapeHTML: true,
    space: 3
  });
});
/******/ })()
;