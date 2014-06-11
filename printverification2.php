<?php
ob_start();
if (!session_id()) session_start();
include("includes/header.php");
include("includes/footer.php");

$greeting = $_SESSION["greeting"];
$addressee = $_SESSION["addressee"];
$company = $_SESSION["company"];
$street = $_SESSION["street"];
$csz = $_SESSION["csz"];
$referal = $_SESSION["referal"];
$id = $_SESSION["id"];
$category = $_SESSION["category"];


$signer1 = $_SESSION["signer"];
$signer2 = "";

if ($signer1 == "GC") {
  $signer1 = "Gloria Shulman";
  $signer2 = "Curtis Cohen";
}

$_SESSION["signer1"] = $signer1;
$_SESSION["signer2"] = $signer2;

echo "<div class=\"body\">";
echo "<h2>Which document would you like to print?</h2>";

echo "<fieldset class=\"fieldset\">";
echo "<legend class=\"fontsize\"><B>Click on one of the options below:</B></legend>";
echo "<table>";
echo "<tr></tr>";
echo "<tr><td><a href=\"newclientletter.php\" class=\"bottombandelement2\">New Client Letter</a></td></tr>";
echo "<tr></tr>";
echo "<tr><td><a href=\"PRLetter.php\" class=\"bottombandelement2\">PR Letter</a></td></tr>";
echo "<tr></tr>";
echo "<tr><td><a href=\"envelope.php\" class=\"bottombandelement2\">Envelope</a></td></tr>";
echo "</table>";
echo "</fieldset>";

echo "</div>";

?>
