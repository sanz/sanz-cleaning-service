/*=========================================================================================
    File Name: app-user.js
    Description: User page JS
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(document).ready(function () {

  var isRtl;
  isRtl = $('html').attr('data-textdirection') === 'rtl';

  //  Rendering badge in status column
  var customBadgeHTML = function (params) {
    var color = "";
    if (params.value === "Enable") {
      color = "success";
      return '<div class="badge-pill bg-rgba-success status-set-text" ><span class="text-success font-weight-bold" > ' + params.value + '</span></div>'
    } else if (params.value === "Disable") {
      color = "danger";
      return '<div class="badge-pill bg-rgba-danger status-set-text" ><span class="text-danger font-weight-bold" > ' + params.value + '</span></div>'
    }
  }

  // Renering Icons in Actions column
  var customIconsHTML = function (params) {
    var usersIcons = document.createElement("span");
    var editIconHTML = '<a href="#locationFormDiv" data-toggle="modal" ><i class="users-edit-icon feather icon-edit-1 mr-50"></i></a>'
    var deleteIconHTML = document.createElement('i');
    var attr = document.createAttribute("class")
    attr.value = "users-delete-icon feather icon-trash-2"
    deleteIconHTML.setAttributeNode(attr);
    // selected row delete functionality
    deleteIconHTML.addEventListener("click", function () {
      deleteArr = [
        params.data
      ];
      // var selectedData = gridOptions.api.getSelectedRows();
      gridOptions.api.updateRowData({
        remove: deleteArr
      });
    });
    usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
    usersIcons.appendChild(deleteIconHTML);
    return usersIcons
  }

  //  Rendering avatar in username column
  // var customAvatarHTML = function (params) {
  //   return params.value
  // }

  // ag-grid
  /*** COLUMN DEFINE ***/

  var columnDefs = [{
      headerName: 'ID',
      field: 'id',
      width: 125,
      filter: true,
      checkboxSelection: true,
      headerCheckboxSelectionFilteredOnly: true,
      headerCheckboxSelection: true,
    },
    {
      headerName: 'State',
      field: 'state',
      filter: true,
      width: 175,
      cellRenderer: customAvatarHTML,
    },
    {
      headerName: 'City',
      field: 'city',
      filter: true,
      width: 175,
    },
    {
      headerName: 'Area-Agent',
      field: 'area-agent',
      filter: true,
      width: 225,
    },
    {
      headerName: 'Services',
      field: 'services',
      filter: true,
      width: 175,
    },
    {
      headerName: 'Status',
      field: 'status',
      filter: true,
      width: 125,
      cellRenderer: customBadgeHTML,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Actions',
      field: 'transactions',
      width: 125,
      cellRenderer: customIconsHTML,
    }
  ];

  /*** GRID OPTIONS ***/
  var gridOptions = {
    defaultColDef: {
      sortable: true
    },
    enableRtl: isRtl,
    columnDefs: columnDefs,
    rowSelection: "multiple",
    floatingFilter: true,
    filter: true,
    pagination: true,
    paginationPageSize: 20,
    pivotPanelShow: "always",
    colResizeDefault: "shift",
    animateRows: true,
    resizable: true
  };
  if (document.getElementById("myGrid")) {
    /*** DEFINED TABLE VARIABLE ***/
    var gridTable = document.getElementById("myGrid");

    /*** GET TABLE DATA FROM URL ***/
    agGrid
      // .simpleHttpRequest({
      //   url: "data/users-list.json"
      // })
      .then(function (data) {
        gridOptions.api.setRowData(data);
      });

    /*** FILTER TABLE ***/
    function updateSearchQuery(val) {
      gridOptions.api.setQuickFilter(val);
    }

    $(".ag-grid-filter").on("keyup", function () {
      updateSearchQuery($(this).val());
    });

    /*** CHANGE DATA PER PAGE ***/
    function changePageSize(value) {
      gridOptions.api.paginationSetPageSize(Number(value));
    }

    $(".sort-dropdown .dropdown-item").on("click", function () {
      var $this = $(this);
      changePageSize($this.text());
      $(".filter-btn").text("1 - " + $this.text() + " of 50");
    });

    /*** EXPORT AS CSV BTN ***/
    $(".ag-grid-export-btn").on("click", function (params) {
      gridOptions.api.exportDataAsCsv();
    });

    //  filter data function
    var filterData = function agSetColumnFilter(column, val) {
      var filter = gridOptions.api.getFilterInstance(column)
      var modelObj = null
      if (val !== "all") {
        modelObj = {
          type: "equals",
          filter: val
        }
      }
      filter.setModel(modelObj)
      gridOptions.api.onFilterChanged()
    }
    //  filter inside state
    $("#filter-state").on("change", function () {
      var filterState = $("#filter-state").val();
      filterData("state", filterState)
    });
    //  filter inside city
    $("#filter-city").on("change", function () {
      var filterCity = $("#filter-city").val();
      filterData("city", filterCity)
    });
    //  filter inside services
    $("#filter-services").on("change", function () {
      var filterServices = $("#filter-services").val();
      filterData("services", filterServices)
    });
    //  filter inside status
    $("#filter-status").on("change", function () {
      var filterStatus = $("#filter-status").val();
      filterData("status", filterStatus)
    });
    // filter reset
    $(".users-data-filter").click(function () {
      $('#filter-city').prop('selectedIndex', 0).change();
      $('#filter-state').prop('selectedIndex', 0).change();
      $('#filter-services').prop('selectedIndex', 0).change();
      $('#filter-status').prop('selectedIndex', 0).change();
    });

    /*** INIT TABLE ***/
    new agGrid.Grid(gridTable, gridOptions);
  }
  // // users language select
  // if ($("#users-language-select2").length > 0) {
  //   $("#users-language-select2").select2({
  //     dropdownAutoWidth: true,
  //     width: '100%'
  //   });
  // }
  // // users music select
  // if ($("#users-music-select2").length > 0) {
  //   $("#users-music-select2").select2({
  //     dropdownAutoWidth: true,
  //     width: '100%'
  //   });
  // }
  // // users movies select
  // if ($("#users-movies-select2").length > 0) {
  //   $("#users-movies-select2").select2({
  //     dropdownAutoWidth: true,
  //     width: '100%'
  //   });
  // }
  // // users birthdate date
  // if ($(".birthdate-picker").length > 0) {
  //   $('.birthdate-picker').pickadate({
  //     format: 'mmmm, d, yyyy'
  //   });
  // }
  // Input, Select, Textarea validations except submit button validation initialization
  if ($(".users-edit").length > 0) {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  }
});
