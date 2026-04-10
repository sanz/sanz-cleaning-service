/**
 *  Filename   : client-service-listing.js
 *  Author       : Sanz
 */

 $(document).ready(function () {

    // Accept a value from a file input based on a required mimetype
    $.validator.addMethod("accept", function (value, element, param) {
        var typeParam = typeof param === "string" ? param.replace(/\s/g, "") : "image/*",
                optionalValue = this.optional(element),
                i, file, regex;

        if (optionalValue) {
            return optionalValue;
        }

        if ($(element).attr("type") === "file") {
            typeParam = typeParam
                .replace(/[\-\[\]\/\{\}\(\)\+\?\.\\\^\$\|]/g, "\\$&")
                .replace(/,/g, "|")
                .replace(/\/\*/g, "/.*");

            // Check if the element has a FileList before checking each file
            if (element.files && element.files.length) {
                regex = new RegExp(".?(" + typeParam + ")$", "i");
                for (i = 0; i < element.files.length; i++) {
                    file = element.files[i];

                    // Grab the mimetype from the loaded file, verify it matches
                    if (!file.type.match(regex)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }, $.validator.format("Please enter a value with a valid mimetype."));

    var action = ""; var ser_id = "";
    $(window).on('load', function () {
        HoldOn.open(options);
        // for Add Options to select input field Dynamicaly
        action = $("#sbt_btn").attr("data-action").trim();
        ser_id = $("#sbt_btn").attr("data-id").trim();
        if (action == "update") {
            var des = $("#ser_des").val();
            $('#summernote').summernote('code', des);
            // $('.note-editable').empty().html(des);
            var ser_days = $("#days").val().split(",");
            var ser_days_time = $("#days_time").val().split(",");
            $("input[name='days'][value='" + ser_days[0] + "']").attr("checked", true);
            if (ser_days[0] == "CUSTOM") {
               printDays(ser_days, ser_days_time);
               var mon_time = ser_days_time[0].split("-");
               var mon = $("#add-day-div").find(".add-day-data:first");
               mon.find("select.start_time option[value='" + mon_time[0].trim() + "']").attr("selected", true);
               mon.find("select.end_time option[value='" + mon_time[1].trim() + "']").attr("selected", true);

            } else {
                var temp = ser_days_time[0].split("-");
                $("select.optime option[value='" + temp[0].trim() + "']").attr("selected", true);
                $("select.cltime option[value='" + temp[1].trim() + "']").attr("selected", true);
            }
        }
        HoldOn.close();
    });

   // For Location
    $("#ser_state").on("click", function (e) {
        if($(this).attr("readonly")){
            swalWarning("Select service name.", "Warning.");
        }
    });


    // Category Value
    $(document).on('change', '#ser_name', function (e) {
        var serviceCategory = $(this).find("option:selected").attr("data-category");
        if (serviceCategory == null || serviceCategory == undefined || serviceCategory == ""){
            swalError();
        } else {
            $("#ser_category").val(serviceCategory);
            $("#ser_pin_no, #ser_address").attr("readonly", true).val("");
            $("#ser_city").attr("readonly", true).empty().append('<option value="-1" selected disabled>Not Found !!</option>');
            var url = "/service-listing-location";
            var data = {
                action : "state",
                service_id : $(this).find("option:selected").attr("data-id"),
                _token : $("input[name='_token']").val()
            };
            HoldOn.open(options);
            $.post(url, data, function (result) {
                result = JSON.parse(result);
                var select = $("#ser_state");
                select.attr("readonly", false).empty();
                select.append('<option value="-1" selected disabled>Select State</option>');
                for (var i = 0; i < result.length; i++) {
                  select.append("<option value='" + result[i]['main_id'] + "'>" + result[i]['state'] + "</option>");
                }
            })    
                .always(function () {   
                    HoldOn.close();
                });
        }
    });

    // Change State
    $("#ser_state").on("change", function (e) {

        HoldOn.open(options);
        $("#ser_pin_no, #ser_address").attr("readonly", false);
        var select = $("#ser_city");
        select.attr("readonly", false).empty();
        select.append('<option value="-1" selected disabled>Select City</option>');

        var url = "/service-listing-location";
        var data = {
            action : "city",
            service_id : $("#ser_name").find("option:selected").attr("data-id"),
            state_id : $(this).find("option:selected").val(),
            _token : $("input[name='_token']").val()
        }
        $.post(url, data, function (result) {
            result = JSON.parse(result);
            var select = $("#ser_city");
            select.attr("readonly", false).empty();
            select.append('<option value="-1" selected disabled>Select City</option>');
            for (var i = 0; i < result.length; i++) {
                select.append("<option value='" + result[i]['main_id'] + "'>" + result[i]['city'] + "</option>");
            }
        })
            .always(function () {   
                HoldOn.close();
            });
    });

   $("#SL_ser_state").append(
       '<option value="-1" selected disabled>Select</option>'
   );

    $(".optime, .start_time").append(
        '<option value="-1" disabled selected>Opening Time</option>'
    );

    $(".cltime, .end_time").append(
        '<option value="-1" disabled selected>Closing Time</option>'
    );

    for (var i = 0; i < 24; i++) {
        $(".styled-select-value").append(
            '<option value="' + i + '">' + i + "</option>"
        );
    }

    // Add Days On Select WORKING DAYS
    var data;
    $('input[name = "days"]').change(function () {
        if ($(this).val() === "CUSTOM") {
            printDays();
        } else {
            $("#add-day-div")
                .attr("hidden", "hidden")
                .find(".add-day-data:not(:first)")
                .remove();
            $("#def_days").show();
            var days = "";
            if ($(this).val() === "ALL") {
                days = "All Days";
            } else if ($(this).val() === "5D") {
                days = "Mon - Fri";
            } else {
                days = "Mon - Sat";
            }
            $("#days_name").html(days);
        }
    });

    function printDays(ser_day = "", ser_day_time = "") {

        $("#add-day-div").removeAttr("hidden");
        $("#def_days").hide();
        var days = ['Tuesday', 'wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        for (var j = 2; j <= 7; j++) {
            if ($("#add-day-div").is("*")) {
                var newElem = $(".add-day-data").first().clone();
                if (newElem.is("*")) {
                    data = newElem;
                }
                if (ser_day_time != "") {
                    var temp = ser_day_time[j - 1].split("-");
                    data.find("select.start_time option[value='" + temp[0].trim() + "']").attr("selected", true);
                    data.find("select.end_time option[value='" + temp[1].trim() + "']").attr("selected", true);
                }
                data.find("label.fix_spacing").text(days[j - 2]);
                data.find(".add-day-data").addClass("add-day-data-extra");
                data.appendTo("#add-day-div");
            }
        }
    }

    $(".custom-file-input").change(function (e) {
        $(this).siblings(".custom-file-label").text(e.target.files[0].name);
    });

    // Form Validation
    $("#sbt_btn").on("click", function (e) {
        $("#sbt_btn").attr("type", "submit");   

        $("#addServiceListForm").validate({
            
            rules : {
                ser_name : { required : true },
                provider_name : { required : true },
                ser_exp : { required : true },
                ser_img : { accept: "jpg,png,jpeg" },
                ser_doc_img : { accept: "jpg,png,jpeg,pdf" },
                ser_doc_no : { required : true, minlength : 12, maxlength : 12 },
                ser_state : { required : true },
                ser_city : { required : true },
                ser_address : { required : true },
                ser_pin_no : { required : true, minlength : 6, maxlength : 6 },
                ser_city : { required : true },
            },
            messages : { 
                ser_img : { accept : "Upload only jpg / jpeg / png file." },
                ser_doc_img : { accept : "Upload only jpg / jpeg / pdf / png file." }
            },
            submitHandler: function (form) {
                $("#sbt_btn").attr("type", "button");
                var obj = getFormValue("#addServiceListForm");
                obj['days'] = $("input[name='days']:checked").val();
                if( obj['opening_time'] == undefined || obj['closing_time'] == undefined ) {
                    obj['time'] = null;
                } else {
                    obj['time'] = obj['opening_time'] + "-" + obj['closing_time'];
                }
                
                if (obj['days'].toUpperCase() == "CUSTOM") {
                    var data = getDayTime("#add-day-div");
                    obj['days'] = data["days"];
                    obj['time'] = data["time"];
                }
                obj['items'] = getItemValue("#pricing-list-container");
                    
                if ( obj['time'] != null ) {
                    if ( !jQuery.isEmptyObject(obj['items']) ) {
                        HoldOn.open(options);
                        uploadImg("addServiceListForm", "/clients/services/image", "POST")
                        .then((path) => {

                            var url = "";
                            obj['action'] = action;

                            if (action == "insert") {
                                url = "/clients/services";
                            } else if (action == "update") {
                                obj['id'] = ser_id;
                                url = "/clients/services/update";
                            } else {
                                swalError();
                            }

                            // var dec_msg = $('.note-editable').html();
                            var img = ( path['ser_img'] == undefined || path['ser_img'] == "" ) ? obj['ser_img_file'] : path['ser_img'];
                            var doc_file = (path['doc_img'] == undefined || path['doc_img'] == "") ? obj['ser_doc_file'] : path['doc_img'];

                            obj['dec_msg'] = $('#summernote').summernote('code');
                            obj['ser_img'] = img;
                            obj['doc_img'] = doc_file;

                            obj['service_id'] = $("#ser_name option:selected").attr("data-id");
                            delete obj['ser_doc_file']
                            delete obj['ser_img_file'];

                            $.ajax({
                                url: url,
                                type: "POST",
                                data: obj,
                                success: function (result) {
                                    HoldOn.close();
                                    swalSuccess("/clients/services", "");
                                },
                                error: function (error) {
                                    HoldOn.close();
                                    swalError();
                                }
                            });
                        })
                            .catch((error) => {
                                HoldOn.close();
                                swalError();
                            });
                    } else {
                        swalWarning("Enter at least one Item !!!", "Missing...");
                    }
                } else {
                    swalWarning("Complete Availability !!!", "Missing...");
                }   
            }

        });
    });

   numberValidation("#ser_phone");
   numberValidation("#item_price");
   numberValidation("#ser_pin_no");
   numberValidation(".num_valid");
});

function swalWarning( msg = "Something went wrong!", title = "Warning..." ) {
    Swal.fire({
        icon: 'warning',
        title: title,
        text: msg,
    });
}

function swalError(msg = "Something went wrong!", title = "Oops...") {
   Swal.fire({
       icon: 'error',
       title: title,
       text: msg,
   }).then((result) => {
       location.reload();
   });
}

function swalSuccess(url, msg = 'Successfuly saved Data!', title = 'Success!') {
   Swal.fire({
       icon: 'success',
       title: title,
       text: msg,
   }).then((result) => {
       window.location = url;
   });
}

function getDayTime(id) {
   var obj = {}; var days = "CUSTOM, "; var time = "";
   $('div.add-day-data').each(function (e) {
       var opening = $(this).find("div div select.start_time");
       var closing = $(this).find("div div select.end_time");

       var opening_val = opening.find(":selected").val();
       var closing_val = closing.find(":selected").val();
       if(opening_val == -1 || closing_val == -1) {
          opening_val = closing_val = "H";
       }

       var day = $(this).find("div label.fix_spacing").text();

       days += day.trim().slice(0, 3).toLocaleUpperCase() + ", ";
       time += opening_val + "-" + closing_val + ", ";
   });
   obj["days"] = days;
   obj["time"] = time;
   return obj;
}


function getItemValue(id) {
   var obj = {}; var i = 0;
   $(id).find("tr").each(function () {
       var data = {};
       $(this).find("input").each(function (i, field) {
           if (field.value != "" && field.value != null) {
               data[field.name] = field.value;
           }
       });
       if (!jQuery.isEmptyObject(data)) {
           obj[i] = data;
           i++;
       }
   });
   return obj;
}


function numberValidation(input_id) {
   $(input_id).keypress(function (event) {
       return /\d/.test(String.fromCharCode(event.keyCode));
   });
}

function getFormValue(form_id) {
   var dataObj = {};
   $.each($(form_id).serializeArray(), function (i, field) {
       dataObj[field.name] = field.value;
   });
   return dataObj;
}

function uploadImg(form_id, url, method) {
    let myform = document.getElementById(form_id);
    let formData = new FormData(myform);

    return new Promise((resolve, reject) => {
        $.ajax({
            url: url,
            type: method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                resolve(data)
            },
            error: function (error) {
                reject(error)
            },
        })
    })
}