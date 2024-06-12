<html>
  <head>
    <title>Receipt</title>
  </head>
  <body>
    <div id="receipt-container">
      <!-- This will contain the screenshot of the checkout container -->
    </div>
    <script>
      // Get the checkout container HTML
      var checkoutHtml = '<?php echo addslashes(file_get_contents('php://input')); ?>';

      // Create a new div to render the checkout container HTML
      var receiptDiv = document.getElementById('receipt-container');
      receiptDiv.innerHTML = checkoutHtml;

      // Use dom-to-image to capture the screenshot
      domtoimage.toBlob(receiptDiv, { quality: 1 })
        .then(function(blob) {
          // Use jsPDF to create a new PDF document
          var pdf = new jsPDF('p', 'pt', 'a4');
          pdf.addImage(blob, 'PNG', 0, 0);

          // Save the PDF to a file
          var pdfName = 'receipt_' + new Date().getTime() + '.pdf';
          pdf.save(pdfName);
        });
    </script>
  </body>
</html>