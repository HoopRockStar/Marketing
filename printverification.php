<?php
ob_start();
require("includes/db.php");
include "includes/redirect.php";
if (!session_id()) session_start();

main();

function main() {
  if (isset($_REQUEST["next"])) {
    if ($_REQUEST["addressee"]=="" || $_REQUEST["greeting"]=="") {
      print "<div class=\"errorz\">Please enter the information below</div>";
    } else {
      $addressee = $_REQUEST["addressee"];
      $_SESSION["addressee"] = $addressee;
      $greeting = $_REQUEST["greeting"];
      $_SESSION["greeting"] = $greeting;
      redirect("printverification1.php");
    }
  }

  include("includes/header.php");
  displayContents();
  include("includes/footer.php");
}

function displayContents() {
  echo "<h2 class=\"greenfont\">How would you like the letter to be addressed?</h2>\n";
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"fontsize\"><B>Please make any changes to the information below:</B></legend>";

  $id = $_SESSION["id"];
  $category = $_SESSION["category"];

  $db = new DB();

  $sql = "SELECT SALUTATION, FIRST_NAME, LAST_NAME, TITLE, COMPANY, STREET, CITY_STATE_ZIP, REFERAL, FIRST_NAME_BASIS, FIRST_NAME_2, LAST_NAME_2, SALUTATION_2, TITLE_2
      FROM $category
      WHERE ID='$id'
      ";

  $result = $db->query($sql);
  $row = mysql_fetch_row($result);
  $i = 0;

  while ($i < mysql_num_fields($result)) {

    $salutation = $row[$i];
    $i++;
    $fname = $row[$i];
    $i++;
    $lname = $row[$i];
    $i++;
    $title = $row[$i];
    $i++;
    $company = $row[$i];
    $_SESSION["company"] = $company;
    $i++;
    $street = $row[$i];
    $_SESSION["street"] = $street;
    $i++;
    $csz = $row[$i];
    $_SESSION["csz"] = $csz;
    $i++;
    $referal = $row[$i];
    $_SESSION["referal"] = $referal;
    $i++;
    $fnbasis = $row[$i];
    $i++;
    $fname2 = $row[$i];
    $_SESSION["fname2"];
    $i++;
    $lname2 = $row[$i];
    $_SESSION["lname2"] = $lname2;
    $i++;
    $salutation2 = $row[$i];
    $_SESSION["salutation2"];
    $i++;
    $title2 = $row[$i];
    $_SESSION["title2"] = $row[$i];
    $i++;
  }

  if ($lname2=="") {
    if ($fnbasis == "Yes") {
      $greeting = $fname;
    }

    else {
      $greeting = $salutation." ".$lname;
    }

    if ($title != "none") {

      $addressee = $salutation." ".$fname." ".$lname.", ".$title;
    }

    else {

      $addressee = $salutation." ".$fname." ".$lname;
    }
  }

  else {
    if ($fnbasis == "Yes") {
      $greeting = $fname." and ".$fname2;
    }

    else {
      if ($lname == $lname2) {
      	$greeting = $salutation." and ".$salutation2." ".$lname;
      }
      else {
      	$greeting = $salutation." ".$lname." and ".$salutation2." ".$lname2;
      }
    }

    if ($title != "none" && $title2 != "none") {

      $addressee = $salutation." ".$fname." ".$lname.", ".$title." and ".$salutation2." ".$fname2." ".$lname2.", ".$title2;
    }

    elseif ($title != "none") {

      $addressee = $salutation." ".$fname." ".$lname.", ".$title." and ".$salutation2." ".$fname2." ".$lname2;

    }

    elseif ($title != "none") {

      $addressee = $salutation." ".$fname." ".$lname." and ".$salutation2." ".$fname2." ".$lname2.", ".$title2;

    }

    else {

      $addressee = $salutation." ".$fname." ".$lname." and ".$salutation2." ".fname2." ".$lname2;
    }
  }

  $self = $_SERVER['PHP_SELF'];
  echo "<form action=\"$self\" method=\"post\"><table class=\"fontsize\">";
  echo "<tr><td>Send to:</td>";
  echo "<td><input type=\"select\" name=\"addressee\" value=\"$addressee\" size=\"40\"></input></td></tr>";
  echo "<tr><td></td>";
  echo "<td>$company</td></tr>";
  echo "<tr><td></td>";
  echo "<td>$street</td></tr>";
  echo "<tr><td></td>";
  echo "<td>$csz</td></tr>";
  echo "<tr><td>Dear</td>";
  echo "<td><input type=\"select\" name=\"greeting\" value=\"$greeting\" size=\"40\"></input></td></tr>";
  echo "</table></fieldset>";
  echo "<input type=\"submit\" name=\"next\" value=\"Next\">";
  echo "</form>";
  echo "</div>";
}
?>
