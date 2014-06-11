<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();

include("includes/header.php");
include("includes/footer.php");

echo "<div class=\"body\">";
echo "<form action=\"checkphone2.php\" method=\"post\"><table class=\"fontsize\">";
echo "<tr><td>Phone Number to Test:</td>";
echo "<td><input type=\"select\" name=\"phone\" value=\"phone\" size=\"40\"></input></td></tr>";
echo "</table></fieldset>";
echo "<input type=\"submit\" value=\"Next\">";
echo "</form>";
echo "</div>";
?>