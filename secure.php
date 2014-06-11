<?php
/**
* secure.php
* Include file for securing pages
*/
require_once "includes/redirect.php";
if (!session_id()) session_start();

requireLogin();

// Returns True if user is authenticated, otherwise False
function requireLogin() {
    if (!isAuthenticated()) {
        $_SESSION['refPage'] = $_SERVER['PHP_SELF'];
        redirect("login.php");
    } else {
        if (isset($_SESSION["refPage"])) {
            unset($_SESSION["refPage"]);
        }
        echo "<!-- Validated at ".date('Y-m-d H:i:s')." -->";
    }
}

// Returns 1 if current user is authenticated, otherwise 0
function isAuthenticated() {
    if (!isset($_SESSION['user'])) {
        return 0;
    } else {
        return 1;
    }
}
?>
