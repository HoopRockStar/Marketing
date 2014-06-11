<?php
ob_start();
require("includes/db.php");
include "includes/redirect.php";
if (!session_id()) session_start();

main("Select a Record to Update:");

// Control the operation of a page
function main($title = "") {
    $category = $_SESSION["category"];
    $id = $_SESSION["id"];


    if (isset($_REQUEST["contact_setting"])) {
          if (!isset($_REQUEST["contact"])) {
            print "<div class=\"errorz\">Please make a selection below or use your browser's back button to cancel</div>";
          } else {
            $nocontact = $_REQUEST["contact"];
            $db = new DB();
            $sql = "UPDATE $category
                    SET NO_CONTACT = '$nocontact'
                    WHERE ID = '$id';
                    ";
            $_SESSION["id"] = $id;
            $_SESSION["category"] = $category;
            $result = $db->query($sql);
            print($sql);
            redirect("DisplayRecords2.php");
          }

      }
    include "includes/header.php";
    showcontent();
    include "includes/footer.php";
}


function showContent() {
  $self = $_SERVER['PHP_SELF'];
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\">Change Contact Setting:</legend>";
  echo "<form method=\"POST\" action=\"$self\">";
  echo "<input type=\"radio\" name=\"contact\" value=\"Contact\">Contact</option>";
  echo "<br />";
  echo "<br />";
  echo "<input type=\"radio\" name=\"contact\" value=\"No Contact\">No Contact</option>";
  echo "</fieldset>";
  echo "<input type=\"submit\" name=\"contact_setting\" value=\"Update\">";
  echo "</form>";

}

?>
