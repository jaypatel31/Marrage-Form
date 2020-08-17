

<?php
$content= file_get_contents('file.html');
require '../dompdf/autoload.inc.php';
			// reference the Dompdf namespace
			use Dompdf\Dompdf;

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();
			$dompdf->loadHtml($content);

			// Render the HTML as PDF
			$dompdf->render();

			// Output the generated PDF to Browser
			$dompdf->stream();

?>


