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
$signer1 = $_SESSION["signer1"];
$signer2 = $_SESSION["signer2"];
$id = $_SESSION["id"];
$category = $_SESSION["category"];

$db = new DB();

$sql = "
        UPDATE $category
        SET PR_SENT = 'Yes'
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

$la_time = new DateTimeZone('America/Los_Angeles');
$datetime->setTimezone($la_time);

$date = date('m/d/y');

$history .= " PR Letter $date";

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
$pdf->Cell(0,70, date('F j, Y'));
$pdf->Ln(55);
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

$file='prletter.txt';
$f=fopen($file,'r');
$txt=fread($f,filesize($file));
fclose($f);
$pdf->MultiCell(0,5,$txt);
$pdf->Ln(18);

$pdf->Cell(90,6, "$signer1");
$pdf->Cell(40,6, "$signer2");
$pdf->Ln(40);

$pdf->SetFont('Times','I',12, 'R');
$file='footerlogo.txt';
$f=fopen($file,'r');
$txt=fread($f,filesize($file));
fclose($f);
$pdf->MultiCell(0,5,$txt);

$pdf->Output();
?>
