<?php
ob_start();
require('includes/fpdf.php');
if (!session_id()) session_start();

$addressee = $_REQUEST["addressee"];
$property_address= $_REQUEST["address"];
$price = $_REQUEST["price"];
$amount = $_REQUEST["amount"];
$expiration = $_REQUEST["expiration"];
$greeting = $_SESSION["greeting"];

$pdf=new FPDF();
$pdf->AddPage();

$pdf->Image('images/centeklogo.jpg',140,15,65);

$pdf->SetFont('Times',"",14);
$pdf->Cell(0,50, date('F j, Y'));
$pdf->Ln(68);
$pdf->SetFont('Times',"B",14);
$pdf->Cell(0,0, "PRE-LOAN APPROVAL CONFIRMATION");
$pdf->Ln(12);

$pdf->SetFont('Times',"",14);
$file='preapprovalparagraph1.txt';
$f=fopen($file,'r');
$txt=fread($f,filesize($file));
fclose($f);
$pdf->MultiCell(0,5,$txt);
$pdf->Ln(10);

$pdf->SetFont('Times',"B",14);
$pdf->Cell(90,6,'BORROWER:');
$pdf->SetFont('Times',"",14);
$pdf->Cell(40,6, "$addressee");
$pdf->Ln(6);

$pdf->SetFont('Times',"B",14);
$pdf->Cell(90,6,'PROPERTY ADDRESS:');
$pdf->SetFont('Times',"",14);
$pdf->Cell(40,6, "$property_address");
$pdf->Ln(6);

$pdf->SetFont('Times',"B",14);
$pdf->Cell(90,6, 'SALES PRICE:');
$pdf->SetFont('Times',"",14);
$pdf->Cell(40,6, "$price");
$pdf->Ln(6);

$pdf->SetFont('Times',"B",14);
$pdf->Cell(90,6, 'APPROXIMATE LOAN AMOUNT:');
$pdf->SetFont('Times',"",14);
$pdf->Cell(40,6, "$amount");
$pdf->Ln(6);


$pdf->SetFont('Times',"B",14);
$pdf->Cell(90,6, 'EXPIRATION OF LOAN APPROVAL:');
$pdf->SetFont('Times',"",14);
$pdf->Cell(40,6, "$expiration");
$pdf->Ln(17);

$pdf->SetFont('Times',"B",14);
$pdf->Cell(0,0, "CONDITIONS FOR FUNDING:");
$pdf->Ln(5);
$pdf->SetFont('Times',"",14);
$pdf->Cell(18,0,"");
$pdf->Cell(0,0, "Purchase Agreement and Escrow Instructions Verifying Terms");
$pdf->Ln(5);
$pdf->Cell(18,0,"");
$pdf->Cell(0,0, "Satisfactory Preliminary Title Report");
$pdf->Ln(5);
$pdf->Cell(18,0,"");
$pdf->Cell(0,0, "Satisfactory Appraisal");
$pdf->Ln(5);
$pdf->Cell(18,0,"");
$pdf->Cell(0,0, "Maintenance of All Information Provided");
$pdf->Ln(12);

$pdf->SetFont('Times',"B",14);
$pdf->Cell(0,0, "COMMENTS:");
$pdf->Ln(3);
$pdf->Cell(18,0,"");
$pdf->SetFont('Times',"",14);
$pdf->MultiCell(0,5, "CenTek Capital is prepared to close within the escrow time frame required. Credit, tax returns, and source of down payment are satisfactory, and have been approved. $greeting is an excellent potential buyer for this property.");
$pdf->Ln(30);

$pdf->Cell(0,0, "___________________________________________");
$pdf->Ln(5);
$pdf->Cell(0,0, "Gloria Shulman");
$pdf->Ln(30);

$pdf->SetFont('Times','I',12, 'R');
$file='footerlogo.txt';
$f=fopen($file,'r');
$txt=fread($f,filesize($file));
fclose($f);
$pdf->MultiCell(0,5,$txt);


$pdf->Output();
?>
