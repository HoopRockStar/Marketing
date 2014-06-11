<?php
ob_start();
require("includes/formverifier.php");
if (!session_id()) session_start();

include("includes/header.php");
include("includes/footer.php");

$f = new formVerifier();
$phone = trim($_REQUEST["phone"]);
$phone = $f->cleanPhone($phone);

echo "<div class=\"body\">";
echo "Phone: $phone";
echo "</div>";


?>