$(document).ready(function () {
   
    // print invoice with button
    $(".btn-print").on( "click", function () {
        window.print();
    });

    // Downlod PDF
    $("#download").on("click", function () {
        const invoice = $("#invoice").html();
        var opt = {
            margin: 0.5,
            filename: 'invoice.pdf',
            image: { type: 'jpeg', quality: 1 },
            // html2canvas: { scale: 1 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(invoice).set(opt).toPdf().save();
    });
});