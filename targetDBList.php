<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();

main("Select a Record from the Database:");

// Control the operation of a page
function main($title = "") {
    include("includes/header.php");
    $db = new DB();
    showContent($db);
    include("includes/footer.php");
}

function showContent($db) {
echo "<div class=\"body\">";
echo "<fieldset class=\"fieldset\">";
echo "<legend class=\"legend\">Select the Entries to Update or Click View for More Information</legend>";

$sql = "SELECT ID, FIRST_NAME, LAST_NAME, COMPANY, STREET, CATEGORY, TGT_DBF
		FROM *
		WHERE CATEGORY != TGT_DBF AND TGT_DBF != 'Removed'
		";

$result = $db->query($sql);

echo "<h3>$title</h3>\n";
echo "<table width=\"55%\">\n";
showHeading();

while ($row=mysql_fetch_row($result)) {
	list($id, $fname, $lname, $company, $street, $category, $targetdb) = $row;
    showItem($id, $fname, $lname, $company, $street, $category, $targetdb);
}

echo "</table>\n";
}

?>

function showHeading() {
    echo <<<HTML
<tr>
  <td bgcolor="green">
      <font face="verdana" size="2" color="white">&nbsp;<b>Update</b></font>
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
  <td bgcolor="green" width="150">
      <font face="verdana" size="2" color="white">&nbsp;<b>Database</b></font>
  </td>
  <td bgcolor="green" width="150">
      <font face="verdana" size="2" color="white">&nbsp;<b>Target</b></font>
  </td>
</tr>

HTML;
}

function showItem($id, $fname, $lname, $company, $street, $category, $targetdb) {

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
      <font face="verdana" size="2" color="black">$street</font>
  </td>
  <td>
        <font face="verdana" size="2" color="black">$category</font>
  </td>
  <td>
        <font face="verdana" size="2" color="black">$targetdb</font>
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
