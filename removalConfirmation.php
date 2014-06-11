<?php
ob_start();
if (!session_id()) session_start();

// Page starts and stops with this function call
main("Record Removed");

// Form processing logic
function main($title = "") {
    $category = $_SESSION["category"];
    $lname = $_SESSION["lname"];
    $fname= $_SESSION["fname"];
    $id = $_SESSION["id"];

    include "includes/header.php";
    include "includes/footer.php";

    echo "<div class=\"body\">";
    echo "<fieldset class=\"fieldset\">";
    echo "<h3>The Target Database of $fname $lname was changed to 'Removed'</h3>";
    echo "</fieldset>";
    echo "</body>";

    echo "<td><a href=\"DisplayRecords2.php\" class=\"bottombandelement\">Return to Record</a></td>";
}
