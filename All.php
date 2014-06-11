<?php
ob_start();

/*
* All.php
* Allows user to select a criterion by which to search
*/

require("includes/db.php");
include "includes/redirect.php";

if (!session_id()) session_start();

main();

function main() {
  if(isset($_REQUEST["nextb"])) {
    if($_REQUEST["selection"]=="selectone") {
      print "<div class=\"errorz\">Please select an option by which to search</div>";
    } else {
      $selection = $_REQUEST["selection"];
      $_SESSION["selection"] = $selection;
      redirect("All2.php");
    }
  }
  include("includes/header.php");
  displayContents();
  include("includes/footer.php");
}

function displayContents() {
  $self = $_SERVER['PHP_SELF'];
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\">Please select your search criteria</legend>";
  echo "<form action=\"$self\" method=\"POST\">";
  echo "<table>";
  echo "<tr><td>Search by:</td>";
  echo "<td>";
    echo "<select name=\"selection\">";
    echo "<option value=\"selectone\">-Select One-</option>";
    echo "<option value=\"FIRST_NAME\">First Name</option>";
    echo "<option value=\"LAST_NAME\">Last Name</option>";
    echo "<option value=\"TELEPHONE_NUMBER\">Phone Number</option>";
    echo "<option value=\"COMPANY\">Company</option>";
    echo "<option value=\"PRIORITY\">Priority</option>";
   echo "</td>";
   echo "</tr>";
  echo "</table>";
  echo "</fieldset>";
  echo "<p>";
     echo "<input type=\"submit\" name=\"nextb\" value=\"Search\">";
  echo "</p>";
  echo "</form>";
  echo "</div>";
}
?>
