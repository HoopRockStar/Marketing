<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();

include "includes/redirect.php";
include_once("includes/formlib.php");
include "includes/header.php";
include "includes/footer.php";

$db = new DB();

$f = new FormLib("error", HORIZONTAL);

//extract session variables
if (!get_magic_quotes_gpc()) {
    $category = mysql_real_escape_string($_SESSION["category"]);
    $targetdb = mysql_real_escape_string($_SESSION["targetdb"]);
    $salutation = mysql_real_escape_string($_SESSION["salutation"]);
    $salutation2 = mysql_real_escape_string($_SESSION["salutation2"]);
    $fname = mysql_real_escape_string($_SESSION["fname"]);
    $fname2 = mysql_real_escape_string($_SESSION["fname2"]);
    $lname = mysql_real_escape_string($_SESSION["lname"]);
    $lname2 = mysql_real_escape_string($_SESSION["fname2"]);
    $title = mysql_real_escape_string($_SESSION["title"]);
    $title2 = mysql_real_escape_string($_SESSION["title2"]);
    $priority = mysql_real_escape_string($_SESSION["priority"]);
    $fnbasis = mysql_real_escape_string($_SESSION["fnbasis"]);
    $company = mysql_real_escape_string($_SESSION["company"]);
    $street = mysql_real_escape_string($_SESSION["street"]);
    $csz = mysql_real_escape_string($_SESSION["csz"]);
    $phone = mysql_real_escape_string($_SESSION["phone"]);
    $fax = mysql_real_escape_string($_SESSION["fax"]);
    $email = mysql_real_escape_string($_SESSION["email"]);
    $referal=mysql_real_escape_string($_SESSION["referal"]);
    $permission=mysql_real_escape_string($_SESSION["permission"]);
    $newsletter=mysql_real_escape_string($_SESSION["newsletter"]);
    $history=mysql_real_escape_string($_SESSION["history"]);
} else {
    $category = $_SESSION["category"];
    $targetdb = $_SESSION["targetdb"];
    $salutation = $_SESSION["salutation"];
    $salutation2 = $_SESSION["salutation2"];
    $fname = $_SESSION["fname"];
    $fname2 = $_SESSION["fname2"];
    $lname = $_SESSION["lname"];
    $lname2 = $_SESSION["lname2"];
    $title = $_SESSION["title"];
    $title2 = $_SESSION["title2"];
    $priority= $_SESSION["priority"];
    $fnbasis = $_SESSION["fnbasis"];
    $company = $_SESSION["company"];
    $street = $_SESSION["street"];
    $csz = $_SESSION["csz"];
    $phone = $_SESSION["phone"];
    $fax = $_SESSION["fax"];
    $email = $_SESSION["email"];
    $referal = $_SESSION["referal"];
    $permission = $_SESSION["permission"];
    $newsletter = $_SESSION["newsletter"];
    $history = $_SESSION["history"];
}

$id = $_SESSION["id"];
if ($fax != "") {
  $fax_number = "(".substr($fax, 0, 3).") ".substr($fax, 3,3)."-".substr($fax,6,4);
}

if ($phone != "") {
  $phone_number = "(".substr($phone, 0, 3).") ".substr($phone, 3,3)."-".substr($phone,6,4);
}

$sql = "
    SELECT ID
    FROM $category
    WHERE COMPANY='$company' AND FIRST_NAME='$fname' AND LAST_NAME='$lname'
    ";

$result = $db->query($sql);
$numrows = mysql_num_fields($result);
$newid = mysql_result($result, 0, 0);

if ($numrows == 1 && $id != $newid) {
  $newid = mysql_result($result, 0, 0);
  $_SESSION["id"] = $newid;
}

else if ($numrows > 1) {
  $newid = mysql_result($result, 0, 0);
  print("NEWID: $newid");
  $_SESSION["id"] = $newid;
}

$sql = "
    SELECT DATE_ENTERED, X_FERED, NO_CONTACT
    FROM $category
    WHERE COMPANY='$company' AND FIRST_NAME='$fname' AND LAST_NAME='$lname'
    ";
$result = $db->query($sql);
$date = mysql_result($result, 0, 0);
$date_transfered = mysql_result($result, 0, 1);
$contact = mysql_result($result, 0, 2);

$_SESSION["date"] = $date;
$_SESSION["transfered"] = $date_transfered;
$_SESSION["contact"] = $contact;

echo "<div class=\"body\">";
echo "<fieldset class=\"fieldset\">";
echo "<h3>Entry Submitted. The following data was entered into the database:</h3>";
echo "<table>";
if ($category == "") {
  echo "<tr class=\"redfont\"><td>Category:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Category:</td><td></td><td>$category</td><td></tr>";
}
if ($targetdb == "") {
  echo "<tr class= \"redfont\"><td>Target Database:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Target Database:</td><td></td><td>$targetdb</td><td></tr>";
}
if ($salutation == "") {
  echo "<tr><td class=\"redfont\">Salutation:</td><td></td><td class=\"redfont\">(empty)</td>";
} else {
  echo "<tr><td>Salutation:</td><td></td><td>$salutation</td>";
}
if ($salutation2 == "") {
  echo "<td class=\"redfont\">Salutation(2):</td><td></td><td class=\"redfont\">(empty)</td></tr>";
} else {
  echo "<td>Salutation(2):</td><td></td><td>$salutation2</td></tr>";
}
if ($fname == "") {
  echo "<tr><td class=\"redfont\">First Name:</td><td></td><td class=\"redfont\">(empty)</td>";
} else {
  echo "<tr><td>First Name:</td><td></td><td>".preg_replace("/[^'a-zA-Z0-9\s-]/", "", stripslashes($fname))."</td>";
}
if ($fname2 == "") {
  echo "<td class=\"redfont\">First Name(2):</td><td></td><td class=\"redfont\">(empty)</td></tr>";
} else {
  echo "<td>First Name(2):</td><td></td><td>".preg_replace("/[^'a-zA-Z0-9\s-]/", "", stripslashes($fname2))."</td></tr>";
}
if ($lname == "") {
  echo "<tr><td div class=\"redfont\">Last Name:</td><td></td><td div class=\"redfont\">(empty)</td>";
} else {
  //$lname = stripslashes($lname);
  echo "<tr><td>Last Name:</td><td></td><td>".preg_replace("/[^'a-zA-Z0-9\s-]/", "", stripslashes($lname))."</td>";
}
if ($lname2 == "") {
  echo "<td class=\"redfont\">Last Name(2):</td><td></td><td class=\"redfont\">(empty)</td></tr>";
} else {

  echo "<td>Last Name(2):</td><td></td><td>".preg_replace("/[^'a-zA-Z0-9\s-]/", "", stripslashes($lname2))."</td></tr>";
}
if ($title == "") {
  echo "<tr><td class=\"redfont\">Title:</td><td></td><td class=\"redfont\">(none)</td>";
} else {
  echo "<tr><td>Title:</td><td></td><td>$title</td>";
}
if ($title2 == "") {
  echo "<td class=\"redfont\">Title(2):</td><td></td><td class=\"redfont\">(none)</td></tr>";
} else {
  echo "<td>Title(2):</td><td></td><td>$title2</td></tr>";
}
if ($priority == "") {
  echo "<tr class=\"redfont\"><td>Priority:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Priority:</td><td></td><td>$priority</td></tr>";
}
if ($fnbasis == "")
{
  echo "<tr class=\"redfont\"><td>First Name Basis:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>First Name Basis:</td><td></td><td>$fnbasis</td></tr>";
}
if ($company == "") {
  echo "<tr class=\"redfont\"><td>Company:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Company:</td><td></td><td>".preg_replace("/[^'a-zA-Z0-9\s-]/", "", $company)."</td></tr>";
}
if ($street == "") {
  echo "<tr class =\"redfont\"><td>Street Address:</td><td></td><td>(empty)</td></tr>";
} else {
  //$street = stripslashes($street);
  echo "<tr><td>Street Address:</td><td></td><td>stripslashes($street)</td></tr>";
}
if ($csz == "") {
  echo "<tr class=\"redfont\"><td>City, State Zip:</td><td></td><td>(empty)</td></tr>";
} else {
  //$csz = stripslashes($csz);
  echo "<tr><td>City, State Zip:</td><td></td><td>stripslashes($csz)</td></tr>";
}
if ($phone == "") {
  echo "<tr class=\"redfont\"><td>Phone:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Phone:</td><td></td><td>$phone_number</td></tr>";
}
if ($fax == "") {
  echo "<tr class=\"redfont\"><td>Fax:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Fax:</td><td></td><td>$fax_number</td></tr>";
}
if ($email == "") {
  echo "<tr class=\"redfont\"><td>Email:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Email:</td><td></td><td>$email</td></tr>";
}
if ($referal == "") {
  echo "<tr class=\"redfont\"><td>Referal:</td><td></td><td>(empty)</td></tr>";
} else {
  //$referal = stripslashes($referal);
  echo "<tr><td>Referal:</td><td></td><td>stripslashes($referal);</td></tr>";
}
if ($permission == "") {
  echo "<tr class=\"redfont\"><td>Permission Given:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Permission Given:</td><td></td><td>$permission</td></tr>";
}
if ($newsletter == "") {
  echo "<tr class=\"redfont\"><td>Send Newsletter Via:</td><td></td><td>(empty)</td></tr>";
} else {
  echo "<tr><td>Send Newsletter Via:</td><td></td><td>$newsletter</td></tr>";
}
if ($history == "") {
  echo "<tr class=\"redfont\"><td>History:</td><td></td><td>(empty)</td></tr>";
} else {
  //$history = stripslashes($history);
  echo "<tr><td>History:</td><td></td><td>stripslashes($history)</td></tr>";
}
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";
echo "<tr></tr>";

echo "<tr><td><a href=\"edit2.php\" class=\"bottombandelement\">Edit</a></td>";
echo "<td></td><td><a href=\"DisplayRecords2.php\" class=\"bottombandelement\">View Record</a></td></tr>";
echo "</table>";
echo "<fieldset>";
echo "</div>";

$_SESSION["category"] = $category;
$_SESSION["targetdb"] = $targetdb;
$_SESSION["salutation"] = $salutation;
$_SESSION["salutation2"] = $salutation2;
$_SESSION["fname"] = $fname;
$_SESSION["fname2"] = $fname2;
$_SESSION["lname"] = $lname;
$_SESSION["lname2"] = $lname2;
$_SESSION["title"] = $title;
$_SESSION["title2"] = $title2;
$_SESSION["priority"] = $priority;
$_SESSION["fnbasis"] = $fnbasis;
$_SESSION["company"] = $company;
$_SESSION["street"] = $street;
$_SESSION["csz"] = $csz;
$_SESSION["phone"] = $phone;
$_SESSION["fax"] = $fax;
$_SESSION["email"] = $email;
$_SESSION["referal"] = $referal;
$_SESSION["permission"] = $permission;
$_SESSION["newsletter"] = $newsletter;
$_SESSION["history"] = $history;
$_SESSION["date"] = $date;
$_SESSION["transfered"] = $date_transfered;
$_SESSION["contact"] = $contact;
?>
