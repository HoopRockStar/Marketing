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
echo "<h2>Congratulations, $user, you have successfully registered!</h2>";
echo "<fieldset class=\"fieldset\">";
echo "<legend class=\"legend\"><B>Please select among the following options:</B></legend>";
echo "<ol><li>Click <a href=\"AdministratorCode.php\">here</a> if you have an administrator code</li>";
echo "<li>Otherwise click <a style=\"text-decoration:none\" href=\"welcome.php\">here</a></li></ol>";
echo "</fieldset>";
echo "</div>";


?>
