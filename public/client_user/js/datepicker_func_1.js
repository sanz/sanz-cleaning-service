// An array of highlighting dates ( 'mm-dd-yyyy' )
var highlight_dates = [];
 
 $(function() {
 // Initialize datepicker
 $('#DatePicker').datepicker({
   inline: true,
   altField: '#datepicker_field',
   altFormat: 'dd-mm-yy',
   minDate: new Date(),
  beforeShowDay: function(date){
   var month = date.getMonth()+1;
   var year = date.getFullYear();
   var day = date.getDate();
 
   // Change format of date ( 'mm-dd-yyyy' )
   var newdate = day+"-"+month+'-'+year;

   // Set tooltip text when mouse over date
   var tooltip_text = "Available on " + newdate;

   // Check date in Array
   if(jQuery.inArray(newdate, highlight_dates) != -1){
    return [true, "highlight", tooltip_text ];
   }
   return [true];
  }
 });
 });

$('#datepicker_field').on('change', function() {
    $('#DatePicker').datepicker('setDate', $(this).val());
});