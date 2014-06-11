<?php
ob_start();

/**
* gloriasreport.php
* Creates a pdf version of a report for Gloria
*/

require('includes/fpdf.php');
require_once("includes/dbconvars.php");
//require_once "secure.php";

if (!session_id()) session_start();

$dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
    or die("Could not connect: ".mysql_error());
mysql_select_db($dbname, $dbCnx)
    or die("Could not select db: ".mysql_error());

$category = $_SESSION["category"];
$af = $_SESSION["alphafrom"];
$at = $_SESSION["alphato"];
$datefrom = $_SESSION["datefrom"];
$dateto = $_SESSION["dateto"];

$pdf=new FPDF();
$pdf->AddPage('P', 'Legal');
$pdf->SetLineWidth(.25);

$pdf->SetFont('Times','',14);
$pdf->Cell(0,0, $category, 'R');
$pdf->SetFont('Times','',8);
$pdf->SetX(-35);
$pdf->Cell(0,0, date('F j, Y'));
$pdf->Ln(3);

$pdf->SetFont('Times','',8);


if ($af=="" && ($datefrom=="" || $datefrom=="YYYY-MM-DD")) {
  $sql = "SELECT SALUTATION, FIRST_NAME, LAST_NAME, TITLE, TELEPHONE_NUMBER, FAX_NUMBER, STREET, CITY_STATE_ZIP, NEWSLETTER, PERMISSION, REFERAL, HISTORY, TGT_DBF FROM $category";
  $result = mysql_query($sql)
    or die("Query failed: ".mysql_error());
}


elseif ($datefrom=="" || $datefrom=="YYYY-MM-DD") {
  $sql = "SELECT SALUTATION, FIRST_NAME, LAST_NAME, TITLE, TELEPHONE_NUMBER, FAX_NUMBER, STREET, CITY_STATE_ZIP, NEWSLETTER, PERMISSION, REFERAL, HISTORY, TGT_DBF
  FROM $category
  WHERE LAST_NAME BETWEEN '$af' AND '$at~'";
    $result = mysql_query($sql)
    or die("Query failed: ".mysql_error());
}

elseif ($af!="") {
  $sql = "SELECT SALUTATION, FIRST_NAME, LAST_NAME, TITLE, TELEPHONE_NUMBER, FAX_NUMBER, STREET, CITY_STATE_ZIP, NEWSLETTER, PERMISSION, REFERAL, HISTORY, TGT_DBF
  FROM $category
  WHERE (DATE_ENTERED BETWEEN '$datefrom' AND '$dateto') AND (LAST_NAME BETWEEN '$af' AND '$at~')";
    $result = mysql_query($sql)
    or die("Query failed: ".mysql_error());
}

else {
  $sql = "SELECT SALUTATION, FIRST_NAME, LAST_NAME, TITLE, TELEPHONE_NUMBER, FAX_NUMBER, STREET, CITY_STATE_ZIP, NEWSLETTER, PERMISSION, REFERAL, HISTORY, TGT_DBF
    FROM $category";
      $result = mysql_query($sql)
    or die("Query failed: ".mysql_error());
}

$w=array(65,60,65);

while ($row=mysql_fetch_assoc($result)) {

  $salutation = $row['SALUTATION'];
  $fname = $row['FIRST_NAME'];
  $lname = $row['LAST_NAME'];
  $title = $row['TITLE'];
  $street = $row['STREET'];
  $csz = $row['CITY_STATE_ZIP'];
  $phone = $row['TELEPHONE_NUMBER'];
  $phone = "(".substr($phone, 0, 3).") ".substr($phone, 3,3)."-".substr($phone,6,4);
  $fax = $row['FAX_NUMBER'];
  $fax = "(".substr($fax, 0, 3).") ".substr($fax, 3,3)."-".substr($fax,6,4);
  $newsletter = $row['NEWSLETTER'];
  $permission = $row['PERMISSION'];
  $referal = $row['REFERAL'];
  $history = $row['HISTORY'];
  $targetdb = $row['TGT_DBF'];

  $pdf->Cell($w[0],6,"$salutation $fname $lname $title",'LRT');
  $pdf->Cell($w[1],6,"Target Database: $targetdb",'LRT');
  $pdf->Cell($w[2],6,"ref: $referal",'LRT');
  $pdf->Ln();

  $pdf->Cell($w[0],6,"$street",'LR');
  $pdf->Cell($w[1],6,"Send by: $newsletter",'LR');
  $pdf->Cell($w[2],6,"$history",'LR');
  $pdf->Ln();

  $pdf->Cell($w[0],6,"$csz",'LR');
  $pdf->Cell($w[1],6,"Permission: $permission",'LR');
  $pdf->Cell($w[2],6,"",'LR');
  $pdf->Ln();

  $pdf->Cell($w[0],6,"v: $phone / f: $fax",'LRB');
  $pdf->Cell($w[1],6,"",'LRB');
  $pdf->Cell($w[2],6,"",'LRB');
  $pdf->Ln();

}

$pdf->Output();

?>
