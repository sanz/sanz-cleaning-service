/*=========================================================================================
    File Name: review-orders.js
    Author: Sanz
==========================================================================================*/
$(document).ready(function () {

  var isRtl;
  isRtl = $('html').attr('data-textdirection') === 'rtl';

  //  Rendering rating in Rating column
  var customRatingHTML = function ({value}) {
    var ratingicons = document.createElement("span");
    ratingicons.setAttribute("class", "font-medium-3");
    ratingicons.setAttribute("data-value", value);
    var rateicon = '<i class="fa fa-star text-warning"></i>';
    var ratehalficon = '<i class="fa fa-star-half-o text-warning"></i>';
    var unrateicon = '<i class="fa fa-star text-secondary"></i>';
    if(value <= 5){
      var first = value % 1;
      var second = value - first;

      for (var i = 0; i < second; i++) {
        ratingicons.appendChild($.parseHTML(rateicon)[0]);
      }
      if (first !== 0) {
        ratingicons.appendChild($.parseHTML(ratehalficon)[0]);
        for (i = 0; i < (5 - value) - 1; i++){
          ratingicons.appendChild($.parseHTML(unrateicon)[0]);
        }
      } else {
        for (i = 0; i < (5 - value); i++){
          ratingicons.appendChild($.parseHTML(unrateicon)[0]);
        }
      }
    }
    return ratingicons
  }

// ag-grid
  /*** COLUMN DEFINE ***/

  var columnDefs = [{
    
      headerName: 'Service Name',
      field: 'service-name',
      filter: true,
      width: 310
    },
    {
      headerName: 'Rating',
      field: 'rating',
      filter: true,
      width: 150,
      cellRenderer: customRatingHTML
    },
    {
      headerName: 'ClientId',
      field: 'clientId',
      filter: true,
      width: 170,
    },
    {
      headerName: 'UserId',
      field: 'userId',
      filter: true,
      width: 170,
    },
    {
      headerName: 'Feedback',
      field: 'feedback',
      filter: true,
      width: 350,
    }
  ];

  /*** GRID OPTIONS ***/
  var gridOptions = {
    defaultColDef: {
      sortable: true,
      resizable: true,
      suppressColumnVirtualisation: true,
      autoHeight: true
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
    domLayout: "autoHeight",
    autoSizeAllColumns: true,
    overlayNoRowsTemplate:
      '<span class="pt-5">No Data To Show</span>'
  };
  if (document.getElementById("myGrid-revworder")) {
    /*** DEFINED TABLE VARIABLE ***/
    var gridTable = document.getElementById("myGrid-revworder");

    function getTableData(data = "all") {
      agGrid
        .simpleHttpRequest({
          url: "/admin/review-order-show/" + data,
        })
        .then(function (data) {

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
});
