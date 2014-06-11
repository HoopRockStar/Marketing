<?php ob_start() ?>
<?php
require_once "includes/dbconvars.php";
$dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
    or die("Could not connect: ".mysql_error());
mysql_select_db($dbname, $dbCnx)
    or die("Could not select db: ".mysql_error());

include "includes/formEntry.php";
require_once "includes/redirect.php";

//create new formEntry object
$f = new formEntry();
$errors = "";

//Extract user information entered in form and verify no errors
$category = $_REQUEST["category"];
$errors.=$f->noEntry($category, "Please enter a category");

$salutation = $_REQUEST["salutation"];
$errors.=$f->noEntry($salutation, "Please enter a salutation (Mr., Ms., Mrs., Dr., etc)");

$fname = $_REQUEST["fname"];
$errors.=$f->noEntry($fname, "Please enter a first name");
$fname = $f->cleanText($fname);
addslashes($fname);

$lname = $_REQUEST["lname"];
$errors.=$f->noEntry($lname, "Please enter a last name");
$lname = $f->cleanText($lname);
addslashes($lname);

$titles = $_REQUEST["titles"];
$errors.=$f->noEntry($titles, "Please enter a title (none, MD, CPA, etc)");

$priority = $_REQUEST["priority"];
$errors.=$f->noEntry($priority, "Please enter a priority level (1-9)");

$fnbasis = $_REQUEST["fnbasis"];
$errors.=$f->noEntry($fnbasis, "Please indicate whether the client is on a first name basis");

$company = $_REQUEST["company"];
$errors.=$f->noEntry($company, "Please enter a company name");
$company = $f->cleanText($company);
addslashes($company);

$street = $_REQUEST["street"];
$errors.=$f->noEntry($street, "Please enter a street address");
$street = $f->cleanText($street);
addslashes($street);

$csz = $_REQUEST["csz"];
$errors.=$f->noEntry($csz, "Please enter a city, state and zip code");
$csz = $f->cleanText($csz);
addslashes($csz);

$phone = $_REQUEST["phone"];
$phone = $f->cleanPhone($phone);
$errors.=$f->noEntry($phone, "Please enter a phone number");
$errors.=$f->isInvalidPhone($phone, "Please enter a valid 10 digit phone number");

$fax = $_REQUEST["fax"];
$fax = $f->cleanPhone($fax);
$errors.=$f->noEntry($fax, "Please enter a phone number");
$errors.=$f->isInvalidPhone($fax, "Please enter a valid 10 digit fax number");

$email = $_REQUEST["email"];
$errors.=$f->noEntry($email, "Please enter an email address");
$errors.=$f->isInvalidEmail($email, "Please enter a valid email");
addslashes($email);

print $errors;

if ($errors == "")
{
	$f->insertIntoDatabase($category, $salutation, $fname, $lname, $priority, $fnbasis, $company, $street, $csz, $phone, $fax, $email, $titles);
}

?>
