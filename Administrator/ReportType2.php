<?php
ob_start();
if (!session_id()) session_start();
include "includes/redirect.php";
include "includes/formverifier.php";

main("Print a Report");

function main($title = "") {

  $af = $_SESSION["alphafrom"];
  $at = $_SESSION["alphato"];
  $datefrom = $_SESSION["datefrom"];
  $dateto = $_SESSION["dateto"];
  $category = $_SESSION["category"];

  if (isset($_REQUEST["report"])) {
    if ($_REQUEST["report"]=="alphabet")
      redirect("alphabetical.php");
   elseif ($_REQUEST["report"]=="mailer")
      redirect("mailer.php");
   elseif ($_REQUEST["report"]=="gloria")
      redirect("gloriasreport.php");
  }

  include "includes/header3.php";
    displayContent();
  include "includes/footer.php";

}

function displayContent() {
  $self = $_SERVER['PHP_SELF'];

  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\">Select a Report</legend>";
  echo "<form method=\"POST\" action=\"$self\">";
  echo "<input type=\"radio\" name=\"report\" value=\"alphabet\">Alphabetical List</input><br /><br />";
  echo "<input type=\"radio\" name=\"report\" value=\"mailer\">Mailing List</input><br /><br />";
  echo "<input type=\"radio\" name=\"report\" value=\"gloria\">Gloria's Report</input><br />";
  echo "</fieldset>";

  echo "<br/><input type=\"submit\" name=\"submit\" value=\"Submit\">";
}
?>
