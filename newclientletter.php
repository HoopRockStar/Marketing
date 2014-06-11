<?php
ob_start();
require('includes/fpdf.php');
require("includes/db.php");
if (!session_id()) session_start();

date_default_timezone_set("America/Los_Angeles");

$greeting = $_SESSION["greeting"];
$addressee= $_SESSION["addressee"];
$company = $_SESSION["company"];
$street = $_SESSION["street"];
$csz = $_SESSION["csz"];
$id = $_SESSION["id"];
$category = $_SESSION["category"];


$signer1 = $_SESSION["signer1"];
$signer2 = $_SESSION["signer2"];

$db = new DB();

$sql = "
        UPDATE $category
        SET LETTER = 'Yes'
        WHERE ID='$id'
      ";

$result = $db->query($sql);


$sql = "
        SELECT HISTORY
        FROM $category
        WHERE ID='$id'
      ";

$result = $db->query($sql);

$history = mysql_result($result, 0, 0);

$date = date('m/d/y');

$history .= " New client Letter $date";

$sql = "
        UPDATE $category
        SET HISTORY = '$history'
        WHERE ID = $id
        ";

$result = $db->query($sql);

$pdf=new FPDF();
$pdf->AddPage();

$pdf->Image('images/centeklogo.jpg',140,15,65);

$pdf->SetFont('Times','',12);
$pdf->Cell(0,40, date('F j, Y'));
$pdf->Ln(40);
$pdf->Cell(0,0, "$addressee");
$pdf->Ln(5);
$pdf->Cell(0,0, "$company");
$pdf->Ln(5);
$pdf->Cell(0,0, "$street");
$pdf->Ln(5);
$pdf->Cell(0,0, "$csz");
$pdf->Ln(20);
$pdf->Cell(0,0,"Dear $greeting:");
$pdf->Ln(5);

$file='newclientletter.txt';
$f=fopen($file,'r');
$txt=fread($f,filesize($file));
fclose($f);
$pdf->MultiCell(0,5,$txt);
$pdf->Ln(14);

$pdf->Cell(90,6, "$signer1");
$pdf->Cell(40,6, "$signer2");
$pdf->Ln(6);

$pdf->SetFont('Times','I',12, 'R');
$file='footerlogo.txt';
$f=fopen($file,'r');
$txt=fread($f,filesize($file));
fclose($f);
$pdf->MultiCell(0,5,$txt);

$pdf->Output();
?>
