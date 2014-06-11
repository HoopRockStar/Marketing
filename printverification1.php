<?php
ob_start();
require("includes/db.php");
include "includes/redirect.php";
if (!session_id()) session_start();

main();

function main() {

  if (isset($_REQUEST["next"])) {
    if (!isset($_REQUEST["signer"])) {
      print "<div class=\"errorz\">Please make a selection</div>";
    } else {
      $signer = $_REQUEST["signer"];
      $_SESSION["signer"] = $signer;
      redirect("printverification2.php");
    }
  }
  include("includes/header.php");
  displayContents();
  include("includes/footer.php");

}

function displayContents() {
  $greeting = $_SESSION["greeting"];
  $addressee = $_SESSION["addressee"];
  $referal = $_SESSION["referal"];

  $_SESSION["greeting"] = $greeting;
  $_SESSION["addressee"] = $addressee;

  $id = $_SESSION["id"];
  $company = $_SESSION["company"];
  $street = $_SESSION["street"];
  $csz = $_SESSION["csz"];
  $category = $_SESSION["category"];

  $self = $_SERVER['PHP_SELF'];
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"fontsize\"><B>Please select a signer:</B></legend>";
  echo "<form action=\"$self\" method=\"post\"><table class=\"fontsize\">";
  echo "<td><input type=\"radio\" name =\"signer\" value=\"John Hughes, President\" size=\"40\">John Hughes, President</input></td></tr>";
  echo "<td><input type=\"radio\" name =\"signer\" value=\"Gloria Shulman\" size=\"40\">Gloria Shulman</input></td></tr>";
  echo "<td><input type=\"radio\" name =\"signer\" value=\"Curtis Cohen\" size=\"40\">Curtis Cohen</input></td></tr>";
  echo "<td><input type=\"radio\" name =\"signer\" value=\"GC\" size=\"40\">Gloria Shulman and Curtis Cohen</input></td></tr>";
  echo "</table></fieldset>";
  echo "<input type=\"submit\" name=\"next\" value=\"Next\">";
  echo "</form>";
  echo "</div>";
}

?>
