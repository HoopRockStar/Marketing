<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();

include("includes/header.php");
include("includes/footer.php");

$signer1 = $_REQUEST["signer"];
$signer2 = "";

if ($signer1 == "GC") {
	$signer1 = "Gloria Shulman";
	$signer2 = "Curtis Cohen";
}

$_SESSION["signer1"] = $signer1;
$_SESSION["signer2"] = $signer2;

$referal = $_SESSION["referal"];
$company = $_SESSION["company"];
$street = $_SESSION["street"];
$csz = $_SESSION["csz"];

echo "<div class=\"body\">";
echo "<fieldset class=\"fieldset\">";
echo "<legend class=\"fontsize\"><B>Please select a signer:</B></legend>";
echo "<form action=\"printverification2.php\" method=\"post\"><table class=\"fontsize\">";
echo "<td><input type=\"radio\" name =\"signer\" value=\"John Hughes, President\" size=\"40\">John Huges, President</input></td></tr>";
echo "<td><input type=\"radio\" name =\"signer\" value=\"Gloria Shulman\" size=\"40\">Gloria Shulman</input></td></tr>";
echo "<td><input type=\"radio\" name =\"signer\" value=\"Curtis Cohen\" size=\"40\">Curtis Cohen</input></td></tr>";
echo "<td><input type=\"radio\" name =\"signer\" value=\"GC\" size=\"40\">Gloria Shulman and Curtis Cohen</input></td></tr>";
echo "</table></fieldset>";
echo "<input type=\"submit\" value=\"Next\">";
echo "</form>";

echo "</div>";
?>
