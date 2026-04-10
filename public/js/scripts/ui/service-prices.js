/*=========================================================================================
    File Name: service-prices.js
    Author: Sanz
==========================================================================================*/
$(document).ready(function () {

  // ----------------------- START: Custom JS ----------------------- //

  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-left',
    showConfirmButton: true,
    showCancelLink: true,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  const confirmbox = Swal.mixin({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  });

  $('#ServicePricesFormDiv').on('hidden.bs.modal', function () {
    $(this).find('form').trigger("reset");
    $(this).find('form button[type="submit"]').attr('data-action', 'insert').removeAttr('data-id').removeClass('btn-outline-success').addClass('btn-outline-primary');

    //removing validation
    $("#ServicePricesForm").find(".error").removeClass("error");
    $("#ServicePricesForm").find("ul").remove();
  });

  $('.modal').on('shown.bs.modal', function () {
    $('#ServicePrices-serviceName').focus();
  });

  // ----------------------- END: Custom JS ----------------------- //

  var isRtl;
  isRtl = $('html').attr('data-textdirection') === 'rtl';

  //  Rendering badge in status column
  var customBadgeHTML = function (params) {
    var color = "";
    if (params.value['text'] === "Enable") {
      color = "success";
      return '<div class="badge-pill bg-rgba-success status-set-text status_btn" data-id="' + params.value['id'] + '" ><span class="text-success font-weight-bold" > ' + params.value['text'] + '</span></div>'
    } else if (params.value['text'] === "Disable") {
      color = "danger";
      return '<div class="badge-pill bg-rgba-danger status-set-text status_btn" data-id="' + params.value['id'] + '" ><span class="text-danger font-weight-bold" > ' + params.value['text'] + '</span></div>'
    }
  }

  // Renering Icons in Actions column
  var customIconsHTML = function (params) {
    var usersIcons = document.createElement("span");
    var editIconHTML = '<i class="users-edit-icon feather icon-edit-1 mr-50 upd_btn" data-id="' + params.data['main_id'] + '"></i>';
    var deleteIconHTML = document.createElement('i');
    var attr = document.createAttribute("class")
    attr.value = "users-delete-icon feather icon-trash-2"
    deleteIconHTML.setAttributeNode(attr);
    var attr2 = document.createAttribute("data-id")
    attr2.value = params.data['main_id']
    deleteIconHTML.setAttributeNode(attr2);


    // selected row delete functionality
    deleteIconHTML.addEventListener("click", function () {
      var id = $(this).attr('data-id');
      confirmbox.fire({
        showLoaderOnConfirm: true,
        preConfirm: () => {
          $.ajax({
            url: '/admin/service-prices-update',
            type: 'GET',
            data: {action: 'delete', id: id},
            success: function (result) {
              deleteArr = [
                params.data
              ];
              gridOptions.api.updateRowData({
                remove: deleteArr
              });
              toastFire('Data Deleted Successfully.');
            },
            error: function (error) {
              swalError();
            }
          });
        }
      });
    });
    usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
    usersIcons.appendChild(deleteIconHTML);
    return usersIcons
  }

// ag-grid
  /*** COLUMN DEFINE ***/

  var columnDefs = [{
    headerName: '#',
    field: '#',
    width: 160,
    filter: true,
    checkboxSelection: true,
    headerCheckboxSelectionFilteredOnly: true,
    headerCheckboxSelection: true,
    cellStyle: {
      "text-align": "center"
    }
  },
    {
      headerName: 'Service Name',
      field: 'service-name',
      filter: true,
      width: 300,
    },
    {
      headerName: 'Visit (%)',
      field: 'visit-charge-brokrage',
      filter: true,
      width: 180,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Service (%)',
      field: 'service-charge-brokrage',
      filter: true,
      width: 180,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Status',
      field: 'status',
      filter: true,
      width: 190,
      cellRenderer: customBadgeHTML,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Actions',
      field: 'transactions',
      width: 160,
      cellRenderer: customIconsHTML,
      cellStyle: {
        "text-align": "center"
      }
    }
  ];

  /*** GRID OPTIONS ***/
  var gridOptions = {
    defaultColDef: {
      sortable: true,
      resizable: true
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
    domLayout: 'autoHeight',
    overlayNoRowsTemplate:
      '<span class="pt-5">No Data To Show</span>'
  };
  if (document.getElementById("myGrid-servicePrices")) {
    /*** DEFINED TABLE VARIABLE ***/
    var gridTable = document.getElementById("myGrid-servicePrices");

    function getTableData() {
      agGrid
        .simpleHttpRequest({
          url: "/admin/service-prices-show"
        })
        .then(function (data) {
          console.log(data);
          gridOptions.api.setRowData(data);
        });
    }

    getTableData();

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

    /*** INIT TABLE ***/
    new agGrid.Grid(gridTable, gridOptions);
  }


  // Input, Select, Textarea validations except submit button validation initialization
  if ($(".users-edit").length > 0) {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  }


  function swalError(msg = 'Something went wrong!!!') {
    confirmbox.fire({
      icon: 'error',
      title: 'Oops...',
      text: msg,
      showCancelButton: false
    });
  }

  function toastFire(title = 'Title', icon = 'success') {
    Toast.fire({
      icon: icon,
      title: title
    });
  }

  function getFormValue(form_id) {
    var dataObj = {};
    $.each($(form_id).serializeArray(), function (i, field) {
      dataObj[field.name] = field.value;
    })
    return dataObj;
  }


  // START: Fetch Data
  $(document).on('click', '.upd_btn', function (e) {
    var id = $(this).attr('data-id');
    $.ajax({
      url: '/admin/service-prices-edit/' + id,
      method: 'GET',
      success: function (result) {
        result = (typeof result === 'string') ? JSON.parse(result) : result;
        $('#sp_sername').val(result['service_name']);
        $('#sp_visitbrokrage').val(result['visit_charge']);
        $('#sp_servicebrokrage').val(result['service_charge']);
        $('#sbt_btn').attr('data-id', result['main_id']);
        $("#ServicePricesFormDiv").modal('show');
      },
      error: function (error) {
        swalError();
      }
    })
  });
  // END: Fetch Data

  // START: Update Data
  $(document).on('submit', '#ServicePricesForm', function (e) {
    var data = getFormValue(this);
    data['id'] = $('#sbt_btn').attr('data-id');
    data['action'] = 'update';
    $.ajax({
      url: '/admin/service-prices-update',
      method: 'GET',
      data: data,
      success: function (result) {
        $('#ServicePricesFormDiv').modal('toggle');
        getTableData();
        toastFire("Successfully data changed.")
      },
      error: function (error) {
        swalError();
      }

    });
  });
  // END: Update Data

  // START: Status
  $(document).on('click', '.status_btn', function (e) {
    var btn = $(this);
    var text = "";
    var id = btn.attr('data-id');
    var hasClass = btn.hasClass('bg-rgba-success');
    if (hasClass) {
      text = 'This will Disable services on website';
    } else {
      text = 'This will Enable services on website';
    }
    confirmbox.fire({
      showLoaderOnConfirm: true,
      text: text,
      preConfirm: () => {
        $.ajax({
          url: '/admin/service-prices-update',
          type: 'GET',
          data: {
            "action": "status",
            "id": id,
            "hasClass": hasClass
          },
          success: function (result) {
            if (hasClass) {
              btn.removeClass("bg-rgba-success").addClass("bg-rgba-danger");
              btn.find('span').removeClass('text-success').addClass("text-danger").text("Disable");
            } else {
              btn.removeClass("bg-rgba-danger").addClass("bg-rgba-success");
              btn.find('span').addClass('text-success').removeClass("text-danger").text("Enable");
            }

            toastFire("Changed Status.");
          },
          error: function (error) {
            swalError();
          }
        })
      }
    });
  });
  // END: Status
});
