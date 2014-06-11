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
echo "<h2>$user has been successfully registered</h2>";


?>
