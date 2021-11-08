<?php
require_once(__DIR__ . "/fpdf.php");

class Imprimir{

    
public static function generarPDF(){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'get');
        $pdf->Output();
}

} 
