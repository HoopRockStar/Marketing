<?php
ob_start();
session_start();

include "includes/redirect.php";
include "includes/formverifier.php";
include "includes/header.php";
include "includes/footer.php";
$category = $_REQUEST["category"];
$_SESSION["category"] = $category;

echo "<div class=\"body\">";
echo "<h2>Which report would you like to print?</h2>";

echo "<fieldset class=\"fieldset\">";
echo "<legend class=\"fontsize\"><B>Click on one of the options below:</B></legend>";
echo "<table>";
echo "<tr></tr>";
echo "<tr><td><a href=\"gloriasreport.php\" class=\"bottombandelement2\">Gloria's Report</a></td></tr>";
echo "<tr></tr>";
echo "<tr><td><a href=\"mailinglist.php\" class=\"bottombandelement2\">Mailing List</a></td></tr>";
echo "<tr></tr>";
echo "<tr><td><a href=\"abbreviatedlist.php\" class=\"bottombandelement2\">Abbreviated List</a></td></tr>";
echo "</table>";
echo "</fieldset>";

echo "</div>";

?>
