<?php
require '../vendor/autoload.php';

$idFacture = $_GET['idFacture'];

use Dompdf\Dompdf;
use Dompdf\Options;

ob_start();
include '../vue/facture.php';
$html = ob_get_clean();

$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream('facture.pdf', array('Attachment' => 0));
