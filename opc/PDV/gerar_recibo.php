<?php
if (isset($_POST['recibo'])) {
    $recibo = $_POST['recibo'];
    require_once('../tcpdf/tcpdf.php');

    $pdf = new TCPDF();
    $pdf->SetTitle('Recibo de Vendas');
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(0, 10, $recibo, 0, 'L');
    $pdf_content = $pdf->Output('', 'S');

    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="recibo.pdf"');
    header('Content-Length: ' . strlen($pdf_content));

    echo $pdf_content;
} else {
    echo "Nenhuma informação do recibo encontrada.";
}
?>
