<?php
ob_start();

/*
* SearchForRecords2.php
*/

include "includes/redirect.php";
include "includes/formverifier.php";

if (!session_id()) session_start();

main();

function main() {

  if (isset($_REQUEST["submit"])) {
    $userEntry = $_REQUEST["userEntry"];
    $_SESSION["userEntry"] = $userEntry;
    if ($userEntry == "") {
      print "<div class=\"errorz\"> Please enter the information in the box below</div>";
    } else {
      redirect("SearchForRecords3.php");
    }

  }

  include "includes/header.php";
  displayContents();
  include "includes/footer.php";

}

function displayContents() {

  require "includes/dbconvars.php";
  $dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
      or die(mysql_error());
  mysql_select_db($dbname, $dbCnx)
      or die(mysql_error());


  $category = $_SESSION["category"];
  $selection = $_SESSION["selection"];
  $self = $_SERVER['PHP_SELF'];

  if (!get_magic_quotes_gpc()) {
      $selection = mysql_real_escape_string($selection);
    }

  $sql = "SELECT ID, $selection FROM $category ORDER BY $selection";
  $result = mysql_query($sql, $dbCnx)
    or die("Query failed: ".mysql_error());

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

  mysql_free_result($result);
  $addressID = mysql_insert_id();
  mysql_close($dbCnx);

  $_SESSION["category"] = $category;
  $_SESSION["selection"] = $selection;

}
?>
