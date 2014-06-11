<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();

include("includes/header.php");
include("includes/footer.php");

echo "<div class=\"body\">";
echo "<h2 class=\"greenfont\">Preapproval Letter</h2>";
echo "<fieldset class=\"fieldset\">";
echo "<legend class=\"fontsize\"><B>Please enter the information below:</B></legend>";

$id = $_SESSION["id"];
$category = $_SESSION["category"];

$db = new DB();

$sql = "
        UPDATE $category
        SET APPROVAL_SENT = 'Yes'
        WHERE ID='$id'
      ";

  $result = $db->query($sql);


$sql = "SELECT SALUTATION, FIRST_NAME, LAST_NAME, TITLE
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
}

if ($title != "none") {

  $addressee = $salutation." ".$fname." ".$lname.", ".$title;
}

else {

  $addressee = $salutation." ".$fname." ".$lname;
}

$greeting = $salutation." ".$lname;
$_SESSION["greeting"] = $greeting;

echo "<form action=\"preapproval2.php\" method=\"post\"><table class=\"fontsize\">";
echo "<tr><td>Borrower:</td>";
echo "<td><input type=\"select\" name=\"addressee\" value=\"$addressee\" size=\"40\"></input></td></tr>";
echo "<tr><td>Property Address:</td>";
echo "<td><input type=\"select\" name=\"address\" size=\"40\"></input></td></tr>";
echo "<tr><td>Sales Price:</td>";
echo "<td><input type=\"select\" name=\"price\" size=\"40\" value=\"$\"></input></td></tr>";
echo "<tr><td>Approximate Loan Amount:</td>";
echo "<td><input type=\"select\" name=\"amount\" size=\"40\" value=\"$\"></input></td></tr>";
echo "<tr><td>Expiration of Loan Approval:</td>";
echo "<td><select name=\"expiration\">";
echo "<option value =\"15 days\">15 days</option>";
echo "<option value =\"30 days\">30 days</option>";
echo "<option value =\"45 days\">45 days</option>";
echo "<option value=\"60 days\">60 days<option>";
echo "</select></td></tr>";
echo "</table></fieldset>";
echo "<input type=\"submit\" value=\"Next\">";
echo "</form>";

echo "</div>";
?>
