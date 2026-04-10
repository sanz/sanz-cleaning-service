/*
 File Name: client-details.js
 */
//-------------------------------------------------------------------------------------------


$(document).ready(function () {

      // Range slider
      $('input[type="range"]').rangeslider({
            polyfill: false,
            onInit: function () {
                  console.log(this);
                  this.output = $(this.$element).siblings('div').children('strong').html(this.$element.val());
            },
            onSlide: function (position, value) {
                  this.output.html(value);
            }
      });
      
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

      $(document).on('click', '#review-submit-btn', function () {
            $('#reviewForm').validate({
                  rules: {
                        resp_revw: {
                              required: true,
                              min: 1
                        },
                        serv_revw: {
                              required: true,
                              min: 1
                        },
                        comm_revw: {
                              required: true,
                              min: 1
                        },
                        price_revw: {
                              required: true,
                              min: 1
                        },
                        revw_title: "required",
                        revw_text: "required",
                        revw_fileupload: {
                              accept: "jpg,png,jpeg,gif"
                        }
                  },
                  messages: {
                        resp_revw: {
                              required: 'Please select this range.',
                              min: 'Please select value greater than or equal to 1.'
                        },
                        serv_revw: {
                              required: 'Please select this range.',
                              min: 'Please select value greater than or equal to 1.'
                        },
                        comm_revw: {
                              required: 'Please select this range.',
                              min: 'Please select value greater than or equal to 1.'
                        },
                        price_revw: {
                              required: 'Please select this range.',
                              min: 'Please select value greater than or equal to 1.'
                        },
                        revw_title: 'Please enter title.',
                        revw_text: "Please enter review message.",
                        revw_fileupload: {
                              accept: "Only image type jpg/png/jpeg/gif is allowed"
                        }
                  },
                  submitHandler: function (form) {
                        form.submit();
                  }
            });
      })
})