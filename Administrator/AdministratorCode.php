<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();
include "includes/redirect.php";

main();

function main() {
  if (isset($_REQUEST["Login"])) {
    $code = $_POST['code'];
    if (get_magic_quotes_gpc()) {
        $code = stripslashes($code);
    }

    processData($code);
  }

  if (isset($_REQUEST["Skip"])) {
    redirect("welcome.php");
  }

  include "includes/header.php";
  displayContents();
  include "includes/footer.php";
}


function processData($code) {
  $db = new DB();
  $sql = "SELECT * FROM users
          WHERE Admincode='$code'
         ";
  $result = $db->query($sql);

  if (mysql_num_rows($result) > 0) {
      redirect("administrator.php");
  } else {
    echo "<div class=\"errorz\">Invalid Administrator Code. Please try again</div>";
  }
}

function displayContents() {
  $self = $_SERVER['PHP_SELF'];
  echo "<br />";
  echo "<p>";
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\">Please Enter Your Administrator Code or Press Skip</legend>";
  echo "<form action=\"$self\" method=\"POST\">";
  echo "<p>Administrator Code: <input type=\"password\" name=\"code\"></p>";
  echo "<p><input type=\"submit\" name=\"Login\" value=\"Log In\">";
  echo "<input type=\"submit\" name=\"Skip\" value=\"Skip\"></p>";
  echo "</form>";
  echo "</fieldset>";
  echo "</p>";
}

?>
