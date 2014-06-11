<?php
ob_start();
include "includes/redirect.php";
include "includes/formverifier.php";
require_once "secure.php";

if (!session_id()) session_start();

main();

function main() {
  if (isset($_REQUEST["nextb"])) {
    if ($_REQUEST["category"]=="selection") {
      print "<div class=\"errorz\">Please make a selection</div>";
    } else {
    $category = $_REQUEST["category"];
    $_SESSION["category"] = $category;
    redirect("gloriasreport.php");
    }
  }
  include "includes/header3.php";
  displayContents();
  include "includes/footer.php";

}

function displayContents() {
  $self = $_SERVER['PHP_SELF'];
  echo "<h2>Print a Report</h2>";
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\"=>Select the database you would like to print from</legend>";
  echo "<form action=\"$self\" method=\"POST\">";
  echo "<table>";
  echo "<tr>";
  echo "<td>Select a Database:</td>";
  echo "<td>";
  echo "<select name=\"category\">";
  echo "<option value=\"selection\">-Select One-</option>";
  echo "<option value=\"Scratch\">Scratch</option>";
  echo "<option value=\"Scratch2\">Scratch 2</option>";
  echo "<option value=\"Prospects\">Prospects</option>";
  echo "</select>";
  echo "</td>";
  echo "</tr>";
  echo "</table>";
  echo "</fieldset>";
  echo "<p>";
  echo "<input type=\"submit\" name=\"nextb\" value=\"Go\">";
  echo "</p>";
  echo "</form>";
}
?>
