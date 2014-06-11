<?php
ob_start();
require("includes/db.php");

main("Select a Record to View or Update or Print the List of Records Below:
");

// Control the operation of a page
function main($title = "") {
    include("includes/header2.php");
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

    $sql = "
        SELECT ID, FIRST_NAME, LAST_NAME, COMPANY, CATEGORY, TGT_DBF
        FROM scratch
        WHERE scratch.TGT_DBF != scratch.CATEGORY
        ORDER BY LAST_NAME
        ";
    $result = mysql_query($sql);

    echo "<div =\"body\">";

    echo "<h3 class=\"greenfont\">Scratch</h3>";
    echo "<table width=\"75%\">\n";
    showHeading();
    while ($row = mysql_fetch_row($result)) {
        list($id, $fname, $lname, $company, $category, $targetdb) = $row;
        showItem($id, $fname, $lname, $company, $category, $targetdb);
    }
    echo "</table>\n";
    echo "<input type=\"submit\" name=\"UpdateScratch\" value=\"Update Scratch\">";

    if(isset($POST["UpdateScratch"])) {


    $sql = "
	        SELECT ID, FIRST_NAME, LAST_NAME, COMPANY, CATEGORY, TGT_DBF
	        FROM removed
	        WHERE removed.TGT_DBF != removed.CATEGORY
	        ORDER BY LAST_NAME
	        ";
	    $result = mysql_query($sql);

	    echo "<h3 class=\"greenfont\">Removed</h3>";
	    echo "<table width=\"75%\">\n";
	    showHeading();
	    while ($row = mysql_fetch_row($result)) {
	        list($id, $fname, $lname, $company, $category, $targetdb) = $row;
	        showItem($id, $fname, $lname, $company, $category, $targetdb);
	    }
    echo "</table>\n";

    echo "<p>";
    echo "<a href=\"printTargetList.php\" class=\"bottombandelement\">Print List</a>";
	echo "</p>";
	echo "</div>";

	mysql_free_result($result);
	mysql_close($dbCnx);

}

// Display the table heading
function showHeading() {
    echo <<<HTML
<tr>
  <td bgcolor="green">
      <font face="verdana" size="2" color="white"><b>Select</b></font>
  </td>
  <td bgcolor="green">
    <font face="verdana" size="2" color="white"><b>First Name</b></font>
  </td>
  <td bgcolor="green">
    <font face="verdana" size="2" color="white"><b>Last Name</b>&nbsp;</font>
  </td>
  <td bgcolor="green">
    <font face="verdana" size="2" color="white"><b>Company</b></font>
  </td>
  <td bgcolor="green" width="150">
    <font face="verdana" size="2" color="white"><b>Database</b></font>
  </td>
  <td bgcolor="green" width="150">
      <font face="verdana" size="2" color="white"><b>Target Database</b></font>
  </td>
  <td bgcolor="green" width="150">
      <font face="verdana" size="2" color="white"><b>More Info</b></font>
  </td>
</tr>

HTML;
}

// Display each table item
function showItem($id, $fname, $lname, $company, $category, $targetdb) {

    echo <<<HTML
<form action="DisplayRecords.php" method="POST">
<tr>
  <td>
    <input type="checkbox" name="record" value="$id">
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
      <font face="verdana" size="2" color="black">$category</font>
  </td>
  <td>
        <font face="verdana" size="2" color="black">$targetdb</font>
  </td>
  <td>
      <input type="submit" name="View" value="View">
  </td>
</tr>
<tr>
  <td width="100%" colspan="7">
    <hr size="1" color="red" noshade>
  </td>
</tr>
</form>

HTML;
}

?>

