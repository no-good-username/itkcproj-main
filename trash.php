<?php

require 'vendor/autoload.php';
include 'db.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Dompdf options
$options = new Options();
$options->set('defaultFont', 'Courier');
$options->set('isRemoteEnabled', true); // Enable loading of remote content (images, CSS, etc.)

$dompdf = new Dompdf($options);

// HTML content for the PDF
$html = '<h1>Survey Report</h1>';

// Image path
$fname = "http://localhost/itkcproj-main/uploads/Screenshot.png";

// Uncomment this line to include the image
$html .= '<p><strong>Lab Picture:</strong> <img src="' . $fname . '" alt="Lab Picture" style="max-width: 300px;"></p>';

$dompdf->loadHtml($html);

// Set the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the PDF
$dompdf->render();

// Stream the PDF to the browser
$dompdf->stream('survey_report.pdf', array("Attachment" => 1));

