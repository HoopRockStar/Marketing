<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Form Test</title></head>
<body>
<?php
    require_once "includes/dbconvars.php";

    $dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
	    or die("Could not connect: ".mysql_error());

	mysql_select_db($dbname, $dbCnx)
	    or die("Could not select db: ".mysql_error());


$category= $_REQUEST["category"];
print "<p>Category: $category</p>";

$salutation = $_REQUEST["salutation"];
print "<p>Salutation: $salutation</p>";


$fname = trim($_REQUEST["fname"]);
print "<p>First Name: $fname</p>";

$lname = $_REQUEST["lname"];
print "<p>Last Name: $lname</p>";

$titles = $_REQUEST["titles"];
print "<p>Title: $titles</p>";


$priority = $_REQUEST["priority"];
print "<p>Priority: $priority</p>";

$fnbasis = $_REQUEST["fnbasis"];
print "<p>First Name Basis: $fnbasis</p>";


$company = $_REQUEST["company"];
print "<p>Company: $company</p>";

$street = $_REQUEST["street"];
print "<p>Street: $street</p>";

$csz = $_REQUEST["csz"];
print "<p>City, State Zip: $csz</p>";

$phone = preg_replace("/[^a-zA-Z0-9\s]/", "", trim($_REQUEST["phone"]));
print "<p>Phone: $phone</p>";

$fax = $_REQUEST["fax"];
print "<p>Fax: $fax</p>";

$email = trim($_REQUEST["email"]);
print "<p>Email: $email</p>";

?>

</body>
</html>