<?php
ob_start();
require("includes/db.php");
include "includes/redirect.php";
//require_once "secure.php";

require "includes/dbconvars.php";
    $dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
        or die(mysql_error());
    mysql_select_db($dbname, $dbCnx)
      or die(mysql_error());

if (!session_id()) session_start();

main("Select a Record from the Database:");

// Control the operation of a page
function main($title = "") {
    if (isset($_REQUEST["nextb"])) {
      if (!isset($_REQUEST["record"])) {
        echo "<div class=\"errorz\">Please use the radio buttons below to make a selection</div>";
      } else {
        $record = $_REQUEST["record"];
        $_SESSION["record"] = $record;

        $sql = "
                SELECT FIRST_NAME, LAST_NAME FROM REMOVED
                WHERE ID = $record
               ";
        $result = mysql_query($sql);
        $fname = mysql_result($result, 0, 0);
        $lname = mysql_result($result, 0, 1);

        $sql = "
                DELETE FROM REMOVED
                WHERE ID = $record
                ";
        $result = mysql_query($sql);
        echo "<div class=\"errorz\">$fname $lname has been removed</div>";
      }
    }

    include("includes/header2.php");
    showContent($title);
    include("includes/footer.php");
}

// Display the content of a page
function showContent($title) {

    $sql = "
        SELECT ID, FIRST_NAME, LAST_NAME, COMPANY, STREET
        FROM REMOVED
        ORDER BY LAST_NAME
        ";
    $result = mysql_query($sql);

    echo "<h3>$title</h3>\n";
    echo "<table width=\"55%\">\n";
    showHeading();
    while ($row = mysql_fetch_row($result)) {
        list($id, $fname, $lname, $company, $address) = $row;
        showItem($id, $fname, $lname, $company, $address);
    }
    echo "</table>\n";

  mysql_free_result($result);
  //mysql_close($dbCnx);
}

// Display the table heading
function showHeading() {
    echo <<<HTML
<tr>
  <td bgcolor="green">
      <font face="verdana" size="2" color="white">&nbsp;<b>Select One</b></font>
  </td>
  <td bgcolor="green">
    <font face="verdana" size="2" color="white">&nbsp;<b>First Name</b></font>
  </td>
  <td bgcolor="green">
    <font face="verdana" size="2" color="white">&nbsp;<b>Last Name</b>&nbsp;</font>
  </td>
  <td bgcolor="green">
    <font face="verdana" size="2" color="white">&nbsp;<b>Company</b></font>
  </td>
  <td bgcolor="green" width="150">
    <font face="verdana" size="2" color="white">&nbsp;<b>Address</b></font>
  </td>
</tr>

HTML;
}

// Display each table item
function showItem($id, $fname, $lname, $company, $street) {
  $self = $_SERVER['PHP_SELF'];
    echo <<<HTML
<form action="$self" method="POST">
<tr>
  <td>
    <input type="radio" name="record" value="$id">
  </td>
  <td>
    <font face="verdana" size="2" color="black">$fname</font>
    </input>
  </td>
  <td>
      <font face="verdana" size="2" color="black">$lname</font>
  </td>
  <td>
      <font face="verdana" size="2" color="black">$company</font>
  </td>
  <td>
      <font face="verdana" size="2" color="black">$street</font>
  </td>
  <td>
      <input type="submit" name="nextb" value="Remove">
  </td>
</tr>
<tr>
  <td width="100%" colspan="5">
    <hr size="1" color="red" noshade>
  </td>
</tr>
</form>

HTML;
}

?>

