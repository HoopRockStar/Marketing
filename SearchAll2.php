<?php
ob_start();
session_start();

include "includes/redirect.php";
include "includes/formverifier.php";

if (!session_id()) session_start();

main();

function main() {
  if (isset($_REQUEST["submit"])) {
    if($_REQUEST["userEntry"]=="") {
      print "<div class=\"errorz\">Please enter the information in the box below</div>";
    } else {
      $userEntry = $_REQUEST["userEntry"];
      $_SESSION["userEntry"] = $userEntry;
      redirect("SearchAll3.php");
    }
  }

  include "includes/header.php";
  displayContents();
  include "includes/footer.php";

}

function displayContents() {
  $selection = $_SESSION["selection"];

  if ($selection == "LAST_NAME") {
    $searchCriteria = "Last Name";
    $lettersOrNumbers = "Letters";
  }

  else if ($selection == "FIRST_NAME") {
    $searchCriteria = "First Name";
    $lettersOrNumbers = "Letters";
  }

  else if ($selection == "TELEPHONE_NUMBER") {
    $searchCriteria = "Phone Number";
    $lettersOrNumbers = "Numbers";
  }

  else if ($selection == "COMPANY") {
    $searchCriteria = "Company";
    $lettersOrNumbers = "Letters";
  }

  else if ($selection == "PRIORITY") {
    $searchCriteria = "Priority";
  }

  $self = $_SERVER['PHP_SELF'];

  echo "<h2>Search for a Record</h2>";
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\">Enter the $searchCriteria or the First Few $lettersOrNumbers of the $searchCriteria</legend>";
  echo "<form action=\"$self\" method=\"POST\">";
  echo "<B>$searchCriteria: </B>&nbsp<input type=\"text\" name=\"userEntry\"></input>";
  echo "<p><input type=\"submit\" name=\"submit\" value=\"Submit\"></p>";
  echo "</form>";
  echo "</fieldset>";
  echo "</body>";
  echo "</html>";
}

?>
