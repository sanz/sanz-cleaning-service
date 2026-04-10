/*
  *  Filename   : client-service-listing.js
  *  Author	      : Sanz
  */

$(document).ready(function () {

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-left',
        showConfirmButton: false,
        showCancelLink: true,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    //Close modal by click ESC key
    $(document).on('keyup', function (e) {
        if (e.keyCode === 27) {
            $('#viewservicemodal').modal('hide');
        }
    });

    //status change
    $(document).on('click', '.s_status', function (e) {

        var btn = $(this);
        var status = (btn.attr("data-action") == "Active") ? "Inactive" : "Active";
        var btn_color = (btn.attr("data-action") == "Active") ? "#df4759" : "#28a745";
        var id = btn.attr("data-id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: btn_color,
            cancelButtonColor: '#757575',
            confirmButtonText: status
        }).then((result) => {

            if (result.isConfirmed) {
                HoldOn.open(options);
                var url = "/clients/services/update";
                var data = {
                    "action": "status",
                    "id": id,
                    "status": btn.attr("data-status"),
                    "_token" :  $("meta[name='csrf-token']").attr("content"),
                }
                $.post( url, data, function (result) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Status Changed'
                    });
                    if (status == 'Inactive') {
                        btn.removeClass('approve').addClass('delete').text('Inactive').attr("data-action", "Inactive").attr("data-status", result).prepend('<i class="fa fa-fw fa-ban mr-1"></i>');
                    } else {
                        btn.removeClass('delete').addClass('approve').text('Active').attr("data-action", "Active").attr("data-status", result).prepend('<i class="fa fa-fw fa-check mr-1"></i>');
                    }
                })
                    .fail(function () {
                        swalError();
                    })
                    .always(function () {   
                        HoldOn.close();
                    });         
            }
        });
    });

    // Model Open
    $(document).on('click', ".modal_btn", function (e) {
        HoldOn.open(options);
        var id = $(this).attr("data-id");
        var url = "/clients/services/list";
        var form = $("#viewServiceModal");
        form.find(".social").empty();
        var data = {
            "id": id,
        }
        $.get(url, data, function (result) {
            result = JSON.parse(result);
            form.find(".service_img").attr("src", result['img']);
            form.find(".provider_name").text(result['name']);
            form.find(".provider_exp").text(result['exp']);
            form.find(".service_name").text(result['service_name']);
            form.find(".service_cate").text(result['service_cat']);
            form.find(".ser_phone").text(result['phone']);
            if( result['email'] == "" ) {
                form.find(".ser_email").text("NA");
            } else {
                form.find('.ser_email').attr("href", "mailto:" + result['email']).text(result['email']);
            }

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

            if (form.find(".social").html() == "") {
                form.find(".social").text("No Data Available !!!");
            }

            form.find(".ser_des").html(result['dec']);
            form.find(".view_doc").attr("href", result['doc_img']);
            form.find(".doc_num").text(result['doc_num']);

            form.find(".state").text(result['state']);
            form.find(".city").text(result['city']);
            form.find(".address").text(result['address']);
            form.find(".pin_code").text(result['pin_code']);

            if (result['days'] != "" && result['days_time'] != "") {
                form.find(".day_time tbody").empty();
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
            }

            form.find(".list_item tbody").empty();
            if (result['item'].length != 0) {
                $.each(result['item'], function (key, value) {
                    var html = '<tr  class="d-flex"><td class="col-md-3">' + value['iName'] + '</td><td class="col-md-2">$CA ' + value['iPrice'] + '</td><td class="col-md-7">' + value['iDes'] + '</td></tr>';
                    form.find(".list_item tbody").append(html);
                });
            } else {
                form.find(".list_item tbody").text("No Data Found !!!");
            }

            form.find(".edit_btn").attr("href", "/clients/services/" + result['main_id']);
            HoldOn.close();

            $("#viewServiceModal").modal("show");
        })
            .fail(function () {
                HoldOn.close();
                swalError();
            });
        
    });

    $(".btn_status").on( "click", function () {

        var action = $(this).attr("data-action");
        var msg = ""; var icon = "";
        switch(action) {
            case "Blocked" : 
                icon = "error";
                msg = "Your service blocked by the team."
                break;
            
            case "Rejected":
                icon = "error";
                msg = "Your service rejected by the team.";
                break;

            case "Pending":
                var icon = "info";
                var msg = "Your service is successfully submitted. \nWait for verified by the team.";
                break;

        }
        Toast.fire({
            icon: icon,
            title: msg
        });
    });
    
});

function swalError(msg = "Something went wrong!", title = "Oops...") {
    Swal.fire({
        icon: 'error',
        title: title,
        text: msg,
    }).then((result) => {
        location.reload();
    });
}