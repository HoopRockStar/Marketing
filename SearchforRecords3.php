<?php
ob_start();

/*
* SearchforRecords3.php
*/

require("includes/db.php");
include "includes/redirect.php";

if (!session_id()) session_start();

main("Select a Record from the Database:");

// Control the operation of a page
function main($title = "") {
    if (isset($_REQUEST["nextb"])) {
      if (!isset($_REQUEST["record"])) {
        echo "<div class=\"errorz\">Please click on one of the circles below to make a selection</div>";
      } else {
        $record = $_REQUEST["record"];
        $_SESSION["record"] = $record;
        redirect("DisplayRecords.php");
      }
    }

    include("includes/header.php");
    showContent($title);
    include("includes/footer.php");
}

// Display the content of a page
function showContent($title) {
    require "includes/dbconvars.php";
    $dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
        or die(mysql_error());
    mysql_select_db($dbname, $dbCnx)
      or die(mysql_error());

    $category = $_SESSION["category"];
    $selection = $_SESSION["selection"];
    $userEntry = $_SESSION["userEntry"];

    if (!get_magic_quotes_gpc()) {
      $selection = mysql_real_escape_string($selection);
      $userEntry = mysql_real_escape_string($userEntry);
    }


    $sql = "
        SELECT ID, FIRST_NAME, LAST_NAME, COMPANY, STREET
        FROM $category
        WHERE $selection LIKE '$userEntry%'
        ORDER BY LAST_NAME
        ";
    $result = mysql_query($sql);

    if (mysql_num_rows($result) == 0) {
      echo "<h4 color=\"red\">No Results Matched Your Search.  Please Use Your Browser's Back Button and Try Again</h4>";
    }

    echo "<h3>$title</h3>\n";
    echo "<table width=\"55%\">\n";
    showHeading();
    while ($row = mysql_fetch_row($result)) {
        list($id, $fname, $lname, $company, $address) = $row;
        showItem($id, $fname, $lname, $company, $address);
    }
    echo "</table>\n";

  mysql_free_result($result);
  mysql_close($dbCnx);
}

// Display the table heading
function showHeading() {
    echo <<<HTML
<tr>
  <td bgcolor="green">
      <font face="verdana" size="2" color="white">&nbsp;<b>Record</b></font>
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
    <input type="radio" name="record" value="$id" checked>
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
      <input type="submit" name="nextb" value="View">
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

