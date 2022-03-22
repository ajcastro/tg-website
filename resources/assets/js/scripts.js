(function (window, undefined) {
  'use strict';

  const dt_basic_table = $('.datatable-basic');

  function loadListeners () {
    window.addEventListener("resize", resizeDatatable);
  }

  function initialize () {
    initializeDatatable();
  }

  function initializeDatatable () {
    dt_basic_table.DataTable().clear().destroy();
    dt_basic_table.DataTable(
      {
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      },
    );
  }

  function resizeDatatable () {
    if ($(window).width() > 764) {
      dt_basic_table.removeClass('table-responsive');
    } else {
      dt_basic_table.addClass('table-responsive');
    }

    initializeDatatable();
  }

  loadListeners();
  initialize();
})(window);
