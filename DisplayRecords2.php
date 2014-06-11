<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();

include "includes/redirect.php";
include "includes/formverifier.php";

main("");

// Control the operation of a page
function main($title = "") {
  $id = $_SESSION["id"];
  $category = $_SESSION["category"];
  include("includes/header.php");
  showContent($title, $category, $id);
  include("includes/footer.php");
}

// Display the content of a page
function showContent($title, $category, $id) {

    $db = new DB();

    $sql = "
          SELECT SALUTATION as 'Salutation:', FIRST_NAME as 'First Name:', LAST_NAME as 'Last Name:', TITLE as 'Title:', SALUTATION_2 as 'Salutation(2):', FIRST_NAME_2 as 'First Name(2):', LAST_NAME_2 as 'Last Name(2):', TITLE_2 as 'Title(2):', FIRST_NAME_BASIS as 'First Name Basis:', COMPANY as 'Company:', STREET as 'Address:', CITY_STATE_ZIP as 'City, State Zip:'
          FROM $category
          WHERE ID='$id';
          ";

    $result = $db->query($sql);
    $row = mysql_fetch_row($result);

    $_SESSION["salutation"] = mysql_result($result, 0, 0);
    $salutation = mysql_result($result, 0, 0);
    $_SESSION["fname"] = mysql_result($result, 0, 1);
    $fname = mysql_result($result, 0, 1);
    $_SESSION["lname"] = mysql_result($result, 0, 2);
    $lname = mysql_result($result, 0, 2);
    $_SESSION["title"] = mysql_result($result, 0, 3);
    $title = mysql_result($result, 0, 3);
    $_SESSION["salutation2"] = mysql_result($result, 0, 4);
    $salutation2 = mysql_result($result, 0, 4);
    $_SESSION["fname2"] = mysql_result($result, 0, 5);
    $fname2 = mysql_result($result, 0, 5);
    $_SESSION["lname2"] = mysql_result($result, 0, 6);
    $lname2 = mysql_result($result, 0, 6);
    $_SESSION["title2"] = mysql_result($result, 0, 7);
    $title2 = mysql_result($result, 0, 7);
    $_SESSION["fnbasis"] = mysql_result($result, 0, 8);
    $fnbasis = mysql_result($result, 0, 8);
    $_SESSION["company"] = mysql_result($result, 0, 9);
    $company = mysql_result($result, 0, 9);
    $_SESSION["street"] = mysql_result($result, 0, 10);
    $street = mysql_result($result, 0, 10);
    $_SESSION["csz"] = mysql_result($result, 0, 11);
    $csz = mysql_result($result, 0, 11);

   $sql = "
             SELECT TELEPHONE_NUMBER as 'Phone:', FAX_NUMBER as 'Fax:', EMAIL as 'Email:', PRIORITY as 'Priority:', REFERAL as 'Referal:', PERMISSION as 'Permission:', NEWSLETTER as 'Newsletter:', TGT_DBF as 'Target Database:', HISTORY as 'History:', NO_CONTACT as 'No Contact?', X_FERED as 'Date Transfered:', DATE_ENTERED as 'Date Entered:'
             FROM $category
             WHERE ID='$id';
             ";

       $result = $db->query($sql);
    $row = mysql_fetch_row($result);


   $_SESSION["phone"] = mysql_result($result, 0, 0);
   $phone = mysql_result($result, 0, 0);
   $_SESSION["fax"] = mysql_result($result, 0, 1);
   $fax = mysql_result($result, 0, 1);
   $_SESSION["email"] = mysql_result($result, 0, 2);
   $email = mysql_result($result, 0, 2);
   $_SESSION["priority"] = mysql_result($result, 0, 3);
   $priority = mysql_result($result, 0, 3);
   $_SESSION["referal"] = mysql_result($result, 0, 4);
   $referal = mysql_result($result, 0, 4);
   $_SESSION["permission"] = mysql_result($result, 0, 5);
   $permission = mysql_result($result, 0, 5);
   $_SESSION["newsletter"] = mysql_result($result, 0, 6);
   $newsletter = mysql_result($result, 0, 6);
   $_SESSION["targetdb"] = mysql_result($result, 0, 7);
   $targetdb = mysql_result($result, 0, 7);
   $_SESSION["history"] = mysql_result($result, 0, 8);
   $history = mysql_result($result, 0, 8);
   $_SESSION["contact"] = mysql_result($result, 0, 9);
   $nocontact = mysql_result($result, 0, 9);
   $_SESSION["transfered"] = mysql_result($result, 0, 10);
   $date_transfered = mysql_result($result, 0, 10);
   $_SESSION["date"] = mysql_result($result, 0, 11);
   $date_entered = mysql_result($result, 0, 11);

   echo "<div class=\"partition1\">";
   echo "<table border=\"0\">\n";

  echo "<tr>";
  echo "<td class=\"cat\" colspan=\"2\">$category<td>";

  if ($targetdb != $category) {
    echo "<td class=\"cat5\" colspan=\"2\">Target Database: $targetdb</td>";
  }
  echo "</tr>";

  echo "<tr>";

  darkgreen("Salutation");
  lightgreen("$salutation");

  echo "<td rowspan=\"12\" bgcolor=\"white\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>";

  $phone = "(".substr($phone, 0, 3).") ".substr($phone, 3,3)."-".substr($phone,6,4);
  darkgreen("Phone");
  lightgreen("$phone");

  echo "</tr>";

  echo "<tr>";

    darkgreen("First Name");
    lightgreen("$fname");

    $fax= "(".substr($fax, 0, 3).") ".substr($fax, 3,3)."-".substr($fax,6,4);
    darkgreen("Fax");
    lightgreen("$fax");

  echo "</tr>";

  echo "<tr>";

    darkgreen("Last Name");
    lightgreen("$lname");

    darkgreen("Email");
    lightgreen("$email");

  echo "</tr>";

  echo "<tr>";

  darkgreen("Title");
  lightgreen("$title");

  echo "<td colspan=\"2\"></td>";

  echo "</tr>";

  echo "<tr>";

  echo "<td colspan=\"2\"></td>";
  darkgreen("Company");
  lightgreen("$company");

  echo "</tr>";

  echo "<tr>";

  darkgreen("Salutation(2)");
  lightgreen("$salutation2");


  echo "<td bgcolor=\"green\" class=\"td3\" rowspan=\"2\">";
  echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
  echo "Address:";
  echo "</B></font>";

  echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\" rowspan=\"2\">";
  echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";
  echo "$street";
  echo "<br />";
  echo "$csz";
  echo "</B></font>";

  echo "</tr>";

  echo "<tr>";

  darkgreen("First Name(2)");
  lightgreen("$fname2");

  echo "</tr>";

  echo "<tr>";

  darkgreen("Last Name(2)");
  lightgreen("$lname2");

  echo "<td colspan=\"2\"></td>";

  echo "</tr>";

  echo "<tr>";

  darkgreen("Title(2)");
  lightgreen("$title2");

  darkgreen("Permission");
  lightgreen("$permission");

  echo "</tr>";

  echo "<tr>";

  echo "<td colspan=\"2\"></td>";

  darkgreen("Newsletter");
  lightgreen("$newsletter");

  echo "</tr>";

  echo "<tr>";

  darkgreen("Priority");
  lightgreen("$priority");

  darkgreen("Contact");
  lightgreen("$nocontact");

  echo "</tr>";

  echo "<tr>";
  darkgreen("First Name Basis");
  lightgreen("$fnbasis");

  echo "<td colspan=\"2\"></td>";
  echo "</tr>";

  echo "<tr>";

  echo "<td bgcolor=\"green\" class=\"td3\" rowspan=\"3\">";
  echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
  echo "History:";
  echo "</B></font>";

  echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\" rowspan=\"3\" colspan=\"4\">";
  echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";
  echo "$history";
  echo "</B></font>";
  echo "</tr>";

  echo "<tr>";
  echo "<td colspan=\"2\"></td>";
  echo "</tr>";

   echo "</table>\n";
   echo "</div>";

   echo "<table class=\"lowerband\">";
   echo "<tr>";
   echo "<td><a href=\"edit2.php\" class=\"bottombandelement\">Edit</a></td>";
   echo "<td><a href=\"remove.php\" class=\"bottombandelement\">Remove</a></td>";
   echo "<td><a href=\"nocontact.php\" class=\"bottombandelement\">No Contact</a></td>";
   echo "<td><a href=\"printrecord.php\" class=\"bottombandelement\">Print Record</a></td>";
   echo "<td><a href=\"printverification.php\" class=\"bottombandelement\">Print Letter</a></td>";
   echo "<td><a href=\"preapproval.php\" class=\"bottombandelement\">Print Pre-Approval</a></td>";
   echo "</tr>";

   echo "<tr></tr>";

   echo "<tr><td width=\"100%\" colspan=\"7\">";
   echo "<hr size=\"1\" color=\"green\" noshade>";
   echo "</td></tr>";

   echo "<tr><td width=\"100%\" colspan=\"7\">";
   echo "<hr size=\"1\" color=\"green\" noshade>";
   echo "</td></tr>";

   echo "<tr><td width=\"100%\" colspan=\"7\">";
   echo "<hr size=\"1\" color=\"green\" noshade>";
   echo "</td></tr>";

   echo "</table>";
}
  function darkgreen($heading) {
    echo "<td bgcolor=\"green\" class=\"td3\">";
    echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
    echo "$heading:";
    echo "</B></font>";
  }

  function lightgreen($item) {
    echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\">";
    echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";
    echo "$item";
    echo "</B></font>";
  }






/**
if (mysql_field_name($result, $i)=="Phone:" || mysql_field_name($result, $i)=="Fax:") {
              $row[$i] = "(".substr($row[$i], 0, 3).") ".substr($row[$i], 3,3)."-".substr($row[$i],6,4);
              echo $row[$i];
            }

     else {
           echo $row[$i];
           */

?>
