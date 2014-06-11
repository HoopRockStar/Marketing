<?php
ob_start();

/**
* ReportType.php
* Allows user the option to select amongst report types
*/

if (!session_id()) session_start();
include "includes/redirect.php";
include "includes/formverifier.php";
//require_once "secure.php";

main("Print a Report");

//controls the function of the page
function main($title = "") {

  $af = $_SESSION["alphafrom"];
  $at = $_SESSION["alphato"];
  $datefrom = $_SESSION["datefrom"];
  $dateto = $_SESSION["dateto"];
  $category = $_SESSION["category"];

  if (isset($_REQUEST["submit"])) {
   if (!isset($_REQUEST["report"])) {
      print "<div class=\"errorz\">Please make a selection</div>";
   } else {
      if ($_REQUEST["report"]=="alphabet") {
          redirect("alphabetical.php");
      } if ($_REQUEST["report"]=="mailer") {
          redirect("mailer.php");
      } if ($_REQUEST["report"]=="gloria") {
          redirect("gloriasreport.php");
      } if (!isset($_REQUEST["report"])) {
          echo "<div class=\"print\">Please make a selection</div>";
      }
    }
  }

  include "includes/header2.php";
    displayContent();
  include "includes/footer.php";

}

//displays the content of the page
function displayContent() {
  $self = $_SERVER['PHP_SELF'];

  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\">Select a Report</legend>";
  echo "<form method=\"POST\" action=\"$self\" name=\"report\">";
  echo "<input type=\"radio\" name=\"report\" value=\"alphabet\">Alphabetical List</input><br /><br />";
  echo "<input type=\"radio\" name=\"report\" value=\"mailer\">Mailing List</input><br /><br />";
  echo "<input type=\"radio\" name=\"report\" value=\"gloria\">Gloria's Report</input><br />";
  echo "</fieldset>";

  echo "<br/><input type=\"submit\" name=\"submit\" value=\"Submit\">";
}
?>
