/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/pages/projects-task.init.js ***!
  \***********************************************/
var _options;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

/**
 * Theme: Unikit - Responsive Bootstrap 4 Admin Dashboard
 * Author: Mannatthemes
 * Project-task Js
 */
var options = (_options = {
  series: [44, 55, 67, 83],
  chart: {
    height: 310,
    type: 'radialBar'
  },
  plotOptions: {
    radialBar: {
      hollow: {
        margin: 10,
        size: '55%',
        background: 'transparent'
      },
      dataLabels: {
        name: {
          fontSize: '18px'
        },
        value: {
          fontSize: '16px',
          color: '#50649c'
        },
        total: {
          show: true
        }
      },
      track: {
        show: true
      }
    }
  },
  colors: ["#7680ff", "#80e6e6", "#7ebcff"],
  stroke: {
    lineCap: 'round'
  }
}, _defineProperty(_options, "series", [71, 63, 100]), _defineProperty(_options, "labels", ['Completed', 'Active', 'Assigned']), _defineProperty(_options, "legend", {
  show: true,
  floating: true,
  position: 'left',
  offsetX: -10,
  offsetY: 0
}), _defineProperty(_options, "legend", {
  show: true,
  position: 'bottom'
}), _defineProperty(_options, "responsive", [{
  breakpoint: 480,
  options: {
    legend: {
      show: true,
      floating: true,
      position: 'left',
      offsetX: 10,
      offsetY: 0
    }
  }
}]), _options);
var chart = new ApexCharts(document.querySelector("#task_status"), options);
chart.render();
/******/ })()
;