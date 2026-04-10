$(document).ready(function () {

    var isRtl;
    isRtl = $('html').attr('data-textdirection') === 'rtl';
    
    // $('#viewUserModal').modal('show');

    //  Rendering badge in status column
    var customBadgeHTML = function (params) {
        if (params.value['text'] === "Active") {
            return '<div class="badge-pill bg-rgba-success status-set-text status_btn" data-id="' + params.value['id'] + '" ><span class="text-success font-weight-bold" >Active</span></div>'
        } else if (params.value['text'] === "Inactive") {
            return '<div class="badge-pill bg-rgba-danger status-set-text status_btn" data-id="' + params.value['id'] + '" ><span class="text-danger font-weight-bold" >Inactive</span></div>'
        }
    }

    // Renering Icons in Actions column
    var customIconsHTML = function (params) {
        var usersIcons = document.createElement("span");
        var editIconHTML = '<a href="#" class="modal_btn" data-id="' + params.value['id'] + '"><i class="feather icon-eye mr-50 "></i></a>';
        usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
        return usersIcons
    }

    var parseResult = function (result) {
        return (typeof result === 'string') ? JSON.parse(result) : result;
    }


    // ag-grid
    /*** COLUMN DEFINE ***/

    var columnDefs = [{
        headerName: '#',
        field: '#',
        width: 125,
        filter: true,
        checkboxSelection: true,
        headerCheckboxSelectionFilteredOnly: true,
        headerCheckboxSelection: true,
        cellStyle: {
            "text-align": "center"
        }
    },

    {
        headerName: 'User Id',
        field: 'user-id',
        filter: true,
        width: 160,
    },
    {
        headerName: 'User Name',
        field: 'user-name',
        filter: true,
        width: 210,
        cellStyle: {
            "text-align": "left"
        }
    },
    {
        headerName: 'Mobile No.',
        field: 'mobileNo',
        filter: true,
        width: 150,
        cellStyle: {
            "text-align": "left"
        }
    },
    {
        headerName: 'Email',
        field: 'email',
        filter: true,
        width: 280,
        cellStyle: {
            "text-align": "left"
        }
    },
    {
        headerName: 'Status',
        field: 'user-status',
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
    if (document.getElementById("myGrid-userManage")) {
        /*** DEFINED TABLE VARIABLE ***/
        var gridTable = document.getElementById("myGrid-userManage");


        function getTableData() {
            agGrid
                .simpleHttpRequest({
                    url: "/admin/user-manage-show"
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


    // Input, Select, Textarea validations except submit button validation initialization
    if ($(".users-edit").length > 0) {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    }

    // START: Change status
    $(document).on('click', '.status_btn', function (e) {
        var btn = $(this); var text = "";
        var id = btn.attr('data-id');
        var hasClass = btn.hasClass('bg-rgba-success');
        if (hasClass) {
            text = 'This will Disable services on website';
        } else {
            text = 'This will Enable services on website';
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: '/admin/user-manage-update',
                    type: 'GET',
                    data: {
                        "action": "status",
                        "hasClass": hasClass,
                        'id': id
                    },
                    success: function (result) {
                        if (hasClass) {
                            btn.removeClass("bg-rgba-success").addClass("bg-rgba-danger");
                            btn.find('span').removeClass('text-success').addClass("text-danger").text("Inactive");
                        } else {
                            btn.removeClass("bg-rgba-danger").addClass("bg-rgba-success");
                            btn.find('span').addClass('text-success').removeClass("text-danger").text("Active");
                        }

                        toastFire(Swal, "Changed Status.");
                    },
                    error: function (error) {
                        swalFire(Swal, "Something went wrong!", "Oops...", "error");
                    }
                })
            }
        });
    });
    // END: Change status

    //show modal woth data
    $(document).on('click', ".modal_btn", function (e) {
        HoldOn.open(options);
        var id = $(this).attr("data-id");
        var url = "/admin/show-user-data";
        var form = $("#viewUserModal");
        var data = {
            "id": id,
            "_token" :  $("meta[name='csrf-token']").attr("content"),
        }
        $.post(url, data, function (result) {
            var payload = parseResult(result) || [];
            var row = Array.isArray(payload) ? (payload[0] || {}) : payload;

            var houseNo = row['address_1'] || row['sUserHouseNo'] || '';
            var area = row['address_2'] || row['sUserArea'] || '';
            var city = row['user_city'] || row['sUserCity'] || '';
            var state = row['user_state'] || row['sUserState'] || '';
            var userCode = row['user_code'] || row['sUserID'] || '';
            var userName = row['user_name'] || row['sUserName'] || 'NA';
            var userGender = row['user_gender'] || row['sUserGender'] || 'NA';
            var userEmail = row['user_email'] || row['sUserEmail'] || '';
            var userMobile = row['user_mobile'] || row['sUserMobile'] || '';
            var userPincode = row['user_pincode'] || row['sUserPincode'] || null;
            var statusValue = (typeof row['user_status'] !== 'undefined') ? row['user_status'] : row['bUserStatus'];
            var isActive = statusValue === true || statusValue === 1 || statusValue === '1' || String(statusValue).toLowerCase() === 'active';

            var text = houseNo ? (houseNo + ' ') : "";
            text += area ? (area + ' ') : "";
            text += city ? (city + ' ') : "";
            text += state ? state : "";

            form.find('.userId').text(userCode ? ('#' + userCode) : 'NA');
            form.find('.user_name').text(userName);
            form.find('.user_gender').text(userGender);
            form.find('.user_email').attr("href", userEmail ? ("mailto:" + userEmail) : '#').text(userEmail || 'NA');
            form.find('.user_moblie').attr("href", userMobile ? ("tel:" + userMobile) : '#').text(userMobile || 'NA');
            form.find('.user_address').text(text ? text : "NA");
            form.find('.user_pincode').text((userPincode) ? userPincode : "NA");

            form.find('.user_status').removeClass('badge-success badge-danger');
            if(isActive){
                form.find('.user_status').addClass('badge-success').text('Active');
            } else {
                form.find('.user_status').addClass('badge-danger').text('Inactive');
            }
            HoldOn.close();
            form.modal("show");
        })
            .fail(function (error) {
                swalError();
            })
            .always(function () {   
                HoldOn.close();
            });
    });

});

function  swalError() {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
    });
}