<?php
ob_start();

/*
* All2.php
* Allows user input to search all CenTek databases for a specific record
*/

include "includes/redirect.php";
include "includes/formverifier.php";

if (!session_id()) session_start();

main();

function main() {
  if (isset($_REQUEST["submit"])) {
    if ($_REQUEST["userEntry"]=="") {
      print "<div class=\"errorz\">Please enter the information below</div>";
    } else {
      $selection = $_SESSION["selection"];
      $userEntry = $_REQUEST["userEntry"];
      $_SESSION["userEntry"] = $userEntry;
      if ($selection == "PRIORITY" && $userEntry < 1 || $userEntry > 10) {
        echo "<div class=\"errorz\">Please enter a valid priority level (1-10)</div>";
      } else if ($selection == "PRIORITY" && !is_numeric($userEntry)) {
         echo "<div class=\"errorz\">Please enter a valid priority level (1-10)</div>";
      } else {
        redirect("All3.php");
      }
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
    if ($selection != "PRIORITY") {
        echo "<h2>Search for a Record</h2>";
        echo "<fieldset class=\"fieldset\">";
        echo "<legend class=\"legend\">Enter the $searchCriteria or the First Few $lettersOrNumbers of the $searchCriteria</legend>";
        echo "<form action=\"$self\" method=\"POST\">";
        echo "<B>$searchCriteria: </B>&nbsp<input type=\"text\" name=\"userEntry\"></input>";
        echo "<p><input type=\"submit\" name =\"submit\" value=\"Submit\"></p>";
        echo "</form>";
        echo "</fieldset>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "<h2>Search for a Record</h2>";
        echo "<fieldset class=\"fieldset\">";
        echo "<legend class=\"legend\">Enter the $searchCriteria below</legend>";
        echo "<form action=\"$self\" method=\"POST\">";
        echo "<B>$searchCriteria: </B>&nbsp<input type=\"text\" name=\"userEntry\"></input>";
        echo "<p><input type=\"submit\" name =\"submit\" value=\"Submit\"></p>";
        echo "</form>";
        echo "</fieldset>";
        echo "</body>";
        echo "</html>";
    }
}
?>
