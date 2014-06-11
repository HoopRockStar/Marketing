<?php
ob_start();
require_once "includes/redirect.php";
if (!session_id()) session_start();

include("includes/header2.php");
include("includes/footer.php");

$user = "";
if (isset($_SESSION["user"])) {
    $user = " ".$_SESSION["user"];
}

echo "<div class=\"body\">";
echo "<h2>Welcome!</h2>";
echo "<fieldset class=\"fieldset\">";
echo "<legend class=\"legend\"><B>Please select among the following options:</B></legend>";
echo "<ol><li><a style=\"text-decoration:none\" href=\"Limit.php\">Print a Report</a></li>";
echo "<li><a style=\"text-decoration:none\" href=\"updateTarget.php\">Transfer Records to Target Database</a></li>";
echo "<li><a style=\"text-decoration:none\" href=\"clearRemoved.php\">Clear Removed</a></li>";
echo "<li><a style=\"text-decoration:none\" href=\"bulkMailing.php\">Do a Bulk Mailing</a></li>";
echo "<li><a style=\"text-decoration:none\" href=\"logout.php\">Logout</a></li></ol>";
echo "</fieldset>";
echo "</div>";

?>
