/*
    File Name: service-manage.js
*/

$(document).ready(function () {

    var isRtl;
    isRtl = $('html').attr('data-textdirection') === 'rtl';

    //  Rendering badge in status column
    var customBadgeHTML = function (params) {
        switch (params.value['val']) {
            case 'Pending':
                return '<div class="badge-pill bg-rgba-warning status-set-text" data-id="' + params.value['id'] + '" ><span class="text-warning font-weight-bold" >Pending</span></div>'

            case 'Rejected':
                return '<div class="badge-pill bg-rgba-secondary status-set-text" data-id="' + params.value['id'] + '" ><span class="text-secondary font-weight-bold" >Rejected</span></div>'

            case 'Active':
                return '<div class="badge-pill bg-rgba-success status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Active" ><span class="text-success font-weight-bold" >Active</span></div>'

            case 'Blocked':
                return '<div class="badge-pill bg-rgba-danger status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Blocked" ><span class="text-danger font-weight-bold" >Blocked</span></div>'

            case 'Inactive':
                return '<div class="badge-pill bg-rgba-danger status-set-text status_btn" data-id="' + params.value['id'] + '" data-action="Inactive" ><span class="text-danger font-weight-bold" >Inactive</span></div>'

        }
    }

    // Renering Icons in Actions column
    var customIconsHTML = function (params) {
        var usersIcons = document.createElement("span");
        var editIconHTML = '<a href="#" class="modal_btn" data-id="' + params.value['id'] + '"><i class="feather icon-eye mr-50 "></i></a>';
        usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
        return usersIcons
    }

    // Renering Approval Icons in Actions column
    var customApproveIconsHTML = function (params) {
        var id = document.createAttribute("data-id");
        id.value = params.value['id'];

        var usersIcons = document.createElement("span");
        var acceptIconHTML = '<i class="users-accept-icon feather icon-user-check btn_approve" data-action="Approve" data-id="' + id.value + '"></i>';
        var rejectIconHTML = document.createElement('i');

        var attr = document.createAttribute("class");
        attr.value = " ml-2 users-delete-icon feather icon-user-x btn_reject";
        rejectIconHTML.setAttributeNode(attr);
        rejectIconHTML.setAttributeNode(id);
        var attr2 = document.createAttribute("data-action");
        attr2.value = "Rejected";
        rejectIconHTML.setAttributeNode(attr2);

        var passIconHTML = document.createElement('i');
        attr = document.createAttribute("class");
        attr.value = "users-accept-icon feather icon-check"
        passIconHTML.setAttributeNode(attr);

        var failIconHTML = document.createElement('i');
        attr = document.createAttribute("class");
        attr.value = "users-delete-icon feather icon-slash"
        failIconHTML.setAttributeNode(attr);

        switch (params.value['val']) {
            case 'Pending':
                usersIcons.appendChild($.parseHTML(acceptIconHTML)[0]);
                usersIcons.appendChild(rejectIconHTML);
                break;

            case 'Rejected':
                usersIcons.appendChild($.parseHTML(acceptIconHTML)[0]);
                break;

            case 'Active':
                usersIcons.appendChild(passIconHTML);
                break;

            case 'Blocked':
                usersIcons.appendChild(failIconHTML);
                break;

            case 'Inactive':
                usersIcons.appendChild(failIconHTML);
                break;
        }
        return usersIcons
    }

    //  Rendering avatar in username column
    var customAvatarHTML = function (params) {
        var img = params.value['img'] || (window.location.origin + '/images/default-img/user.png');
        return "<span class='avatar'><img src='" + img + "' height='32' width='32'></span>" + params.value['name']
    }

    var customEmailHTML = function (params) {
        return "<a href='mailto:" + params.value + "'>" + params.value + "</a>"
    }

    var customPhoneHTML = function (params) {
        return "<a href='tel:" + params.value + "'>" + params.value + "</a>"
    }

    var parseResult = function (result) {
        return (typeof result === 'string') ? JSON.parse(result) : result;
    }

    // Renering Links in Government Id Column
    var customLinkHTML = function (params) {
        var usersIcons = document.createElement("span");
        var url = params.value['url'] || '#';
        var linkHTML = '<a href="' + url + '" target="_blank" title="' + params.value['name'] + '">' + params.value['name'] + '</a>';
        usersIcons.appendChild($.parseHTML(linkHTML)[0]);
        return usersIcons
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
        headerName: 'Shop Name',
        field: 'shop-name',
        filter: true,
        width: 200,
        cellRenderer: customAvatarHTML,
    },
    {
        headerName: 'Service',
        field: 'service-name',
        filter: true,
        width: 200,
    },
    {
        headerName: 'Category',
        field: 'category',
        filter: true,
        width: 150,
    },
    {
        headerName: 'Client Id',
        field: 'client-id',
        filter: true,
        width: 150,
    },
    {
        headerName: 'Client Name',
        field: 'client-name',
        filter: true,
        width: 200
    },
    {
        headerName: 'Location',
        field: 'location',
        filter: true,
        width: 150
    },
    {
        headerName: 'Experience',
        field: 'experience',
        filter: true,
        width: 140
    },
    {
        headerName: 'Avalibility',
        field: 'avalibility',
        filter: true,
        width: 200,
        cellStyle: {
            "text-align": "left"
        }
    },
    {
        headerName: 'Mobile No.',
        field: 'mobileNo',
        filter: true,
        width: 150,
        cellRenderer: customPhoneHTML
    },
    {
        headerName: 'Email',
        field: 'email',
        filter: true,
        cellRenderer: customEmailHTML,
        width: 200
    },
    {
        headerName: 'ID Proof',
        field: 'IDProof',
        filter: true,
        width: 125,
        cellRenderer: customLinkHTML,
        cellStyle: {
            "text-align": "center"
        }
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
        headerName: 'Approval',
        field: 'approval',
        width: 125,
        cellRenderer: customApproveIconsHTML,
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

    if (document.getElementById("myGrid-serviceManage")) {
        /*** DEFINED TABLE VARIABLE ***/
        var gridTable = document.getElementById("myGrid-serviceManage");

        function getTableData() {
            agGrid
                .simpleHttpRequest({
                    url: "/admin/services-show",
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


    // change status of services of client
    $(document).on( "click", ".status_btn, .btn_approve, .btn_reject" ,function (e) {
        var status = $(this).attr("data-action");
        var btn_color = ""; var btn_text = "";
        if(status == "Active" || status == "Rejected" || status == "Inactive") {
            btn_color = "#df4759";
            btn_text = (status == "Active" || status == "Inactive") ? "Block" : "Rejecte";
        } else if (status == "Blocked" || status == "Approve" ) {
            btn_color = "#28a745";
            btn_text = (status == "Blocked") ? "Active" : "Approve";
        }

        Swal.fire({
            icon : 'warning',
            title: 'Do you want to approve service?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: btn_text,
            confirmButtonColor: btn_color,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                HoldOn.open(options);
                var url = "/admin/services-update";
                var data = {
                    "main_id" : $(this).attr("data-id"),
                    "action" : "status",
                    "data_action" : status,
                    "_token" :  $("meta[name='csrf-token']").attr("content"),
                };
                $.post( url, data, function (result) {
                    $(".bg_ser_list").text(result);
                    getTableData();
                })
                    .always( function () {
                        HoldOn.close();
                    });
            }
        });

    });

    // Show modal with data
    $(document).on('click', ".modal_btn", function (e) {
        HoldOn.open(options);
        var id = $(this).attr("data-id");
        var url = "/admin/show-service-list";
        var form = $("#viewServiceModal");
        var data = {
            "id": id,
            "_token" :  $("meta[name='csrf-token']").attr("content"),
        }
        $.post(url, data, function (result) {
            result = parseResult(result) || {};
            if (result['img']) {
                form.find(".service_img").attr("src", result['img']);
            } else {
                form.find(".service_img").attr("src", window.location.origin + '/images/default-img/user.png');
            }

            form.find('.provider_name').text(result['name']);
            form.find('.provider_exp').text(result['exp']);
            form.find('.service_name').text(result['service_name']);
            form.find('.service_cate').text(result['service_cat']);

            form.find('.ser_phone').text(result['phone']);
            if (!result['email']) {
                form.find('.ser_email').text("NA");
                form.find('.ser_email').attr("href", "#");
            } else {
                form.find('.ser_email').attr("href", "mailto:" + result['email']).text(result['email']);
            }
            form.find('.ser_des').html(result['dec']);

            form.find(".view_doc").attr("href", result['doc_img'] || '#');
            form.find('.doc_num').html(result['doc_num']);

            form.find('.city').text(result['city']);
            form.find('.state').text(result['state']);
            form.find('.address').text(result['address']);
            form.find('.pin_code').text(result['pin_code']);

            // Social Media Link
            form.find(".social").empty();
            if (result['web'] != "" && result['web'] != null) {
                var html = "<a href='" + result['web'] + "'  target='_blank' class='social-icon globe'><i class='fa fa-globe fa-2x'></i></a>";
                form.find(".social").append(html);
            }
            if (result['fb'] != "" && result['fb'] != null) {
                var html = "<a href='" + result['fb'] + "'  target='_blank' class='social-icon facebook'><i class='fa fa-facebook-f fa-2x'></i></a>";
                form.find(".social").append(html);
            }
            if (result['tw'] != "" && result['tw'] != null) {
                var html = "<a href='" + result['tw'] + "'  target='_blank' class='social-icon twitter'><i class='fa fa-twitter fa-2x'></i></a>";
                form.find(".social").append(html);
            }
            if (result['linkedin'] != "" && result['linkedin'] != null) {
                var html = "<a href='" + result['linkedin'] + "'  target='_blank' class='social-icon  linkedin'><i class='fa fa-linkedin fa-2x'></i></a>";
                form.find(".social").append(html);
            }
            // if (result['insta'] != "" && result['insta'] != null) {
            //     var html = "<a href='" + result['insta'] + "'  target='_blank' class='social-icon instagram'><i class='fa fa-instagram fa-2x'></i></a>";
            //     form.find(".social").append(html);
            // }

            if (form.find(".social").html() == "") {
                form.find(".social").text("No Data Available !!!");
            }

            // Availability Table
            form.find(".day_time tbody").empty();
            if (result['days'] != "" && result['days_time'] != "") {
                var days = result['days'].split(",");
                var time = result['days_time'].split(",");

                if (days[0] == "CUSTOM") {
                    for (var  i = 0; i < time.length - 1; i++) {
                        var temp = "";
                        time[i] = time[i].split("-");
                        if ( time[i][0] == "H" || time[i][1] == "H" )
                            temp = "Holiday";
                        else {
                            temp = time[i][0] + ":00 To " + time[i][1] + ":00";
                        }
                        form.find(".day_time tbody").append("<tr><td>" + days[i+1] + "</td><td>" + temp + "</td></tr>");
                    }
                } else if (days[0] == "5D") {
                    time = time[0].split("-");
                    form.find(".day_time tbody").append("<tr><td>5 Days (Mon-Fri)</td><td>" + time[0] + ":00 To " + time[1] + ":00</td></tr>");
                } else if (days[0] == "6D") {
                    time = time[0].split("-");
                    form.find(".day_time tbody").append("<tr><td>6 Days (Mon-Sat)</td><td>" + time[0] + ":00 To " + time[1] + ":00</td></tr>");
                } else if (days[0] == "ALL") {
                    time = time[0].split("-");
                    form.find(".day_time tbody").append("<tr><td>All Days</td><td>" + time[0] + ":00 To " + time[1] + ":00</td></tr>");
                }
            } else {
                form.find(".day_time tbody").append("<tr><td colspan='2'>No Data Available !!!</td></tr>");
            }

            // Pricing Table
            form.find(".list_item tbody").empty();
            var items = Array.isArray(result['item']) ? result['item'] : [];
            if (items.length !== 0) {
                $.each(items, function (key, value) {
                    var html = '<tr  class="d-flex"><td class="col-md-3">' + value['iName'] + '</td><td class="col-md-2">$CA ' + value['iPrice'] + '</td><td class="col-md-7">' + value['iDes'] + '</td></tr>';
                    form.find(".list_item tbody").append(html);
                });
            } else {
                form.find(".list_item tbody").append("<tr><td colspan='3'>No Data Found !!!</td></tr>");
            }

            HoldOn.close();
            $("#viewServiceModal").modal("show");
        })
            .fail(function () {
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
