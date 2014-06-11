<?php
ob_start();
if (!session_id()) session_start();

main("Secure Logout");

// Control the operation of the page
function main($title = "") {
    $redirect = "echo.php";
    $other = "<meta http-equiv=\"Refresh\"";
    $other .= "content=\"5;URL=AdministratorLogin.php\">\n";
    $user = "";
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 86400, '/');
    }
    session_destroy();
    include("includes/header2.php");
    showContent($title, $redirect, $user);
    include("includes/footer.php");
}

// Display the content of the page
function showContent($title, $redirect, $user) {
    $msg = $user;
    if (!$user) {
        $msg = "You are";
    }
    echo "<h1>$title</h1>";
    echo<<<HTML
<p>$msg logged out securely.</p></p>
<p>Click <a href="../index.php">here</a> to continue.</p>
HTML;
echo "</div>";
}
?>
