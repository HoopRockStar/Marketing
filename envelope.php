<?php
ob_start();
require('includes/fpdf.php');
if (!session_id()) session_start();

$greeting = $_SESSION["greeting"];
$addressee= $_SESSION["addressee"];
$company = $_SESSION["company"];
$street = $_SESSION["street"];
$csz = $_SESSION["csz"];
$signer1 = $_SESSION["signer1"];
$signer2 = $_SESSION["signer2"];
$referal = $_SESSION["referal"];

$pdf=new FPDF();
$pdf->AddPage('L', 'Legal');

$pdf->SetLineWidth(1.5);
$pdf->SetFont('Times','',16);

$pdf->SetY(55);
$pdf->Cell(100,100,"");
$pdf->Cell(120,8,"  $company", 'LRT');
$pdf->Ln();
$pdf->Cell(100,100,"");
$pdf->Cell(120,8,"  $street", 'LR');
$pdf->Ln();
$pdf->Cell(100,100,"");
$pdf->Cell(120,8,"  $csz", 'LR');
$pdf->Ln(8);
$pdf->Cell(100,100,"");
$pdf->Cell(120,12,"  Attn: $addressee", 'LRB');

$pdf->SetFont('Times','I',16);
$pdf->Ln(12);
$pdf->Cell(100,100,"");
$pdf->Cell(120,12,"  *Personal and Confidential*");

$pdf->SetY(175);
$pdf->SetX(250);
$pdf->Cell(0,0, "Ref: $referal");


$pdf->Output();

?>


