<?php
ob_start();
require("includes/db.php");
include "includes/redirect.php";
include("includes/header.php");
include("includes/footer.php");

echo "<div class=\"body\">";
echo "<fieldset class=\"fieldset\">";
echo "<legend class=\"legend\">How do you want to search?</legend>";
echo "<ol><li><a style=\"text-decoration:none; font-size:medium\" href=\"SearchforRecords.php\">Search by Database</a></li>";
echo "<li><a style=\"text-decoration:none; font-size:medium\" href=\"SearchAll.php\">Search All</a></li></ol>";
echo "</fieldset>";

?>