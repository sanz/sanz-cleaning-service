$(document).ready(function () {
    var isRtl;
    isRtl = $('html').attr('data-textdirection') === 'rtl';

    //  Rendering badge in status column
    var customBadgeHTML = function (params) {
        switch (params.value['val']) {
            
            case 'Active':
                return '<div class="badge-pill bg-rgba-success status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Active" ><span class="text-success font-weight-bold" >Active</span></div>'

            case 'Blocked':
                return '<div class="badge-pill bg-rgba-danger status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Blocked" ><span class="text-danger font-weight-bold" >Blocked</span></div>'

        }
    }

    // Renering Icons in Actions column
    var customIconsHTML = function (params) {
        var usersIcons = document.createElement("span");
        var editIconHTML = '<a href="#" class="modal_btn" data-id="' + params.value['id'] + '"><i class="feather icon-eye mr-50 "></i></a>';
        usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
        return usersIcons
    }

    //  Rendering avatar in username column
    var customAvatarHTML = function (params) {
        return "<span class='avatar'><img src='" + params.data.avatar + "' height='32' width='32'></span>" + params.value
    }

    var customEmailHTML = function (params) {
        return "<a href='mailto:"+params.value+"'>"+params.value+"</a>"
    }

    var customPhoneHTML = function (params) {
        return "<a href='tel:"+params.value+"'>"+params.value+"</a>"
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
        headerCheckboxSelection: true
    },

    {
        headerName: 'Client Id',
        field: 'client-id',
        filter: true,
        width: 150,
    },
        {
            headerName: 'Name',
            field: 'client-name',
            filter: true,
            width: 245,
            cellRenderer: customAvatarHTML,
        },
        {
            headerName: 'Email',
            field: 'email',
            filter: true,
            cellRenderer: customEmailHTML,
            width: 250
        },
        {
            headerName: 'Mobile No.',
            field: 'mobileNo',
            filter: true,
            width: 150,
            cellRenderer: customPhoneHTML
        },        
        {
            headerName: 'Status',
            field: 'client-status',
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
            resizable: true,
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
        overlayNoRowsTemplate:
            '<span class="pt-5">No Data To Show</span>'
    };
    if (document.getElementById("myGrid-clientManage")) {
        /*** DEFINED TABLE VARIABLE ***/
        var gridTable = document.getElementById("myGrid-clientManage");

        function getTableData() {
            agGrid
                .simpleHttpRequest({
                    url: "/admin/client-manage-show",
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

    // START: Approve Data
    $(document).on('click', '.status_btn', function (e) {
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-action');
        if(status == "Active")
            status = "Blocked"
        else if (status == "Blocked")
            status = "Active"

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#78d278',
            cancelButtonColor: '#d33',
            confirmButtonText: status
        }).then((result) => {
            if (result.isConfirmed) {
               HoldOn.open(options);
                $.ajax({
                    url : '/admin/client-manage-update',
                    type : 'GET',
                    data : {
                        action: "status",
                        status: status,
                        id: id
                    },
                    success : function (result){
                        getTableData();
                        if(status == "Active")
                           getPendingCount();
                        toastFire(Swal,"Changed Status.");
                        HoldOn.close();
                    },
                    error : function (error) {
                        swalFire(Swal, "Something went wrong!", "Oops...", "error");
                       HoldOn.close();
                    }
                });

            }
        })
    });
    // END: Approve Data

    // getPendingCount();
    function getPendingCount() {
        $.ajax({
            url : '/admin/client-manage-show',
            type: 'GET',
            data: {
                action: "Pending"
            },
            success: function (result) {
                if(result > 0)
                    $('a[href="client-manage"] span:last').text(result);
                else
                    $('a[href="client-manage"] span:last').text("");
            }
        });
    }

    //show modal woth data
    $(document).on('click', ".modal_btn", function (e) {
        HoldOn.open(options);
        var id = $(this).attr("data-id");
        var url = "/admin/show-client-data";
        var form = $("#viewClientModal");
        var html = "";
        var data = {
            "id": id,
            "_token" :  $("meta[name='csrf-token']").attr("content"),
        }
        $.post(url, data, function (result) {
            var rows = parseResult(result) || [];
            if (!Array.isArray(rows) || rows.length === 0) {
                swalError();
                return;
            }

            var client = rows[0];
            var clientCode = client['client_code'] || client['sClientID'] || '';
            var clientImage = client['client_photo_url'] || client['sClPhotoURL'] || '';
            var clientName = client['client_name'] || client['sClName'] || 'NA';
            var clientGender = client['client_gender'] || client['sClGender'] || 'NA';
            var clientEmail = client['client_email'] || client['sClEmail'] || '';
            var clientMobile = client['client_mobile'] || client['sClMobile'] || '';
            var clientStatus = client['client_status'] || client['sClientStatus'] || 'Blocked';

            form.find('.clientId').text(clientCode ? ('#' + clientCode) : 'NA');
            if (clientImage) {
                form.find('.client_img').attr('src', clientImage);
            } else {
                form.find('.client_img').removeAttr('src');
            }
            form.find('.client_name').text(clientName);
            form.find('.client_gender').text(clientGender);
            form.find('.client_email').attr("href", clientEmail ? ("mailto:" + clientEmail) : '#').text(clientEmail || 'NA');
            form.find('.client_moblie').attr("href", clientMobile ? ("tel:" + clientMobile) : '#').text(clientMobile || 'NA');

            form.find('.client_status').removeClass('badge-success badge-danger');
            if (String(clientStatus).toLowerCase() === 'active') {
                form.find('.client_status').addClass('badge-success').text('Active');
            } else {
                form.find('.client_status').addClass('badge-danger').text('Blocked');
            }

            form.find(".service_list tbody").empty();
            $.each(rows, function (key, value) {
                var providerName = value['name'] || value['ser_pro_name'] || '';
                var serviceName = value['service_name'] || value['serviceName'] || '';
                var serviceCategory = value['service_category'] || value['serviceCategory'] || '';

                if (!providerName && !serviceName && !serviceCategory) {
                    return;
                }

                html += '<tr><th scope="row">' + (key + 1) + '</th><td>' + providerName + '</td><td>' + serviceName + '</td><td>' + serviceCategory + '</td></tr>';
            });

            if (html) {
                form.find(".service_list tbody").append(html);
            } else {
                html =  '<tr class="text-center"><td colspan="4">Services not Added.</td></tr>';
                form.find(".service_list tbody").append(html);
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