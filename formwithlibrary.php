<?php
ob_start();

include "includes/redirect.php";
include_once("includes/formlib.php");

date_default_timezone_set("America/Los_Angeles");

// Page starts and stops with this function call
main("");

function main($title = "") {
    $f = new FormLib("error", HORIZONTAL);
    //destroySession($f);

    if (isset($_REQUEST["process"])) {
      checkForm($f);
      if (!$f->isError()) { // data is OK
        makeSession($f);
        processData($f);
            redirect("confirmation.php");
         }
    }

    include("includes/header.php");
    showContent($title, $f);
    include("includes/footer.php");
}

// Check the input form for errors
function checkForm(&$f) {
  $f->isEmpty('category', "Please select a category");
  $f->isInvalidPhone('phone', "Please enter a valid 10-digit phone");
  $f->isInvalidPhone('fax', "Please enter a valid 10-digit fax");
  $f->isInvalidEmail('email', "Please enter a valid email");
}

// Process the data
function processData($f) {

    // Process the verified data here.
    // This is where you save data in the database.

    require "includes/dbconvars.php";
  $dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
      or die(mysql_error());
  mysql_select_db($dbname, $dbCnx)
      or die(mysql_error());

  // Process the query
  $category = $_REQUEST["category"];
  $targetdb = $_REQUEST["targetdb"];
  $salutation = $_REQUEST["salutation"];
  $salutation2 = $_REQUEST["salutation2"];
  $fname = trim($_REQUEST["fname"]);
  $fname = $f->cleanText($fname);
  $fname2 = trim($_REQUEST["fname2"]);
  $fname2 = $f->cleanText($fname2);
  $lname = trim($_REQUEST["lname"]);
  $lname = $f->cleanText($lname);
  $lname2 = trim($_REQUEST["lname2"]);
  $lname2 = $f->cleanText($lname2);
  $title = $_REQUEST["titles"];
  $title2 = $_REQUEST["titles2"];
  $priority = $_REQUEST["priority"];
  $fnbasis = $_REQUEST["fnbasis"];
  $company = trim($_REQUEST["company"]);
  $street = trim($_REQUEST["street"]);
  $street = $f->cleanText($street);
  $csz = trim($_REQUEST["csz"]);
  $csz = $f->cleanText($csz);
  $phone = trim($_REQUEST["phone"]);
  $phone = $f->cleanPhone($phone);
  $fax = trim($_REQUEST["fax"]);
  $fax = $f->cleanPhone($fax);
  $email = trim($_REQUEST["email"]);
  $referal = trim($_REQUEST["referal"]);
  $referal = $f->cleanText($referal);
  $permission = $_REQUEST["permission"];
  $newsletter = $_REQUEST["newsletter"];
  $history = trim($_REQUEST["history"]);

  if (!get_magic_quotes_gpc()) {
      $category = mysql_real_escape_string($category);
      $targetdb = mysql_real_escape_string($targetdb);
      $salutation = mysql_real_escape_string($salutation);
      $salutation2 = mysql_real_escape_string($salutation2);
      $fname = mysql_real_escape_string($fname);
      $fname2 = mysql_real_escape_string($fname2);
      $lname = mysql_real_escape_string($lname);
      $lname2 = mysql_real_escape_string($lname2);
      $title = mysql_real_escape_string($title);
      $title2 = mysql_real_escape_string($title2);
      $priority = mysql_real_escape_string($priority);
      $fnbasis = mysql_real_escape_string($fnbasis);
      $company = mysql_real_escape_string($company);
      $street = mysql_real_escape_string($street);
      $csz = mysql_real_escape_string($csz);
      $phone = mysql_real_escape_string($phone);
      $fax = mysql_real_escape_string($fax);
      $email = mysql_real_escape_string($email);
      $referal=mysql_real_escape_string($referal);
      $history=mysql_real_escape_string($history);
  }

$today = date("Y-m-d");


  $sql = "
      INSERT INTO $category(SALUTATION, SALUTATION_2, FIRST_NAME, LAST_NAME, FIRST_NAME_2, LAST_NAME_2, TITLE, TITLE_2, PRIORITY, FIRST_NAME_BASIS, COMPANY, STREET, CITY_STATE_ZIP, TELEPHONE_NUMBER, FAX_NUMBER, EMAIL, TGT_DBF, REFERAL, PERMISSION, NEWSLETTER, HISTORY, CATEGORY, DATE_ENTERED)
      VALUES ('$salutation', '$salutation2', '$fname', '$lname', '$fname2', '$lname2', '$title', '$title2', '$priority', '$fnbasis', '$company', '$street', '$csz', '$phone', '$fax', '$email', '$targetdb', '$referal', '$permission', '$newsletter', '$history', '$category', '$today')
      ";

  mysql_query($sql)
      or die("Query failed: ".mysql_error());
  $addressID = mysql_insert_id();
  mysql_close($dbCnx);

}

function showContent($title, $f) {
  echo "<h1 class=\"ttle\">$title</h1>\n";
    echo $f->reportErrors();
    echo $f->start();

  echo "<div class=\"body2\">";
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\">Please Enter the Data Below:</legend>";
  echo "<table width=\"100%\" cellpadding=\"2px\">";

  echo "<tr><td class=\"tabledata\">";
  echo $f->formatOnError('category', 'Database Category:');
  echo "</td>\n<td class=\"tabledata\">";
  $category_list = array("Scratch"=>"Scratch", "Scratch 2"=>"Scratch2");
  echo $f->makeSelect('category', $category_list);
  echo $f->showMessageOnError('category');
  echo "</td>\n</tr></col>\n";

  echo"<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('targetdb', 'Target Database:');
  echo "</td>\n<td class=\"tabledata\">";
  $target_list = array("-Select One-"=>"", "Agents...Real Estate Agents"=>"Agents", "Architects"=>"Architects",
    "Attorneys"=>"Attorneys", "Bankers"=>"Bankers", "Clients"=>"Clients", "CPAs"=>"CPAs", "Divorce Attorneys"=>"Divorce_Attorneys", "Doctors, Dentists, Vets, etc"=>"Medical",
    "General Business"=>"General_Business", "Mail"=>"Mail", "MLS"=>"MLS", "Personal"=>"Personal", "PGA West"=>"PGA_West", "Professional Networking Group"=>"Professional_Networking_Group",
    "Prospects"=>"Prospects", "Women's Group"=>"Womens_Group", "9100 Wilshire"=>"9100_Wilshire");
  echo $f->makeSelect('targetdb', $target_list);
  echo $f->showMessageOnError('targetdb');
  echo "</td>\n</tr>\n";

  echo"<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('salutation', 'Salutation:');
  echo "</td>\n<td class=\"tabledata\">";
  $salutation_list = array("-Select One-"=>"", "Mr."=>"Mr.", "Mrs."=>"Mrs.", "Ms."=>"Ms.", "Miss"=>"Miss", "Dr."=>"Dr.");
   echo $f->makeSelect('salutation', $salutation_list);
   echo $f->showMessageOnError('salutation');
   echo "</td>";

   echo "<td class=\"tabledata\">";
     echo $f->formatOnError('salutation2', 'Salutation(2):');
     echo "</td>\n<td class=\"tabledata\">";
     $salutation_list = array("-Select One-"=>"", "Mr."=>"Mr.", "Mrs."=>"Mrs.", "Ms."=>"Ms.", "Miss"=>"Miss", "Dr."=>"Dr.");
   echo $f->makeSelect('salutation2', $salutation_list);
   echo $f->showMessageOnError('salutation2');
   echo "</td>\n</tr>\n";

    echo "<tr>\n<td class=\"tabledata\">";
    echo $f->formatOnError('fname', 'First Name:');
    echo "</td>\n<td class=\"tabledata\">";
    echo $f->makeTextInput('fname', 30);
    echo $f->showMessageOnError('first name');
    echo "</td>";

    echo "<td class=\"tabledata\">";
    echo $f->formatOnError('fname2', 'First Name(2):');
    echo "</td>\n<td class=\"tabledata\">";
    echo $f->makeTextInput('fname2', 30);
    echo $f->showMessageOnError('second first name');
    echo "</td>\n</tr>\n";

    echo "<tr>\n<td class=\"tabledata\">";
    echo $f->formatOnError('lname', 'Last Name:');
    echo "</td>\n<td class=\"tabledata\">";
    echo $f->makeTextInput('lname', 30);
    echo $f->showMessageOnError('last name');
    echo "</td>";

    echo "<td class=\"tabledata\">";
    echo $f->formatOnError('lname2', 'Last Name(2):');
    echo "</td>\n<td class=\"tabledata\">";
    echo $f->makeTextInput('lname2', 30);
    echo $f->showMessageOnError('last name');
    echo "</td>\n</tr>\n";

    echo"<tr>\n<td class=\"tabledata\">";
    echo $f->formatOnError('titles', 'Title:');
    echo "</td>\n<td class=\"tabledata\">";
    $title_list = array("-Select One-"=>"", "none"=>"",  "CEO"=>"CEO", "CFA"=>"CFA", "CPA"=>"CPA", "DDM"=>"DDM", "DDS"=>"DDS", "DVM"=>"DVM", "Esq."=>"Esq", "MD"=>"MD", "PhD"=>"PhD", "President"=>"President",
    "Principal"=>"Principal", "VDM"=>"VDM", "VP"=>"VP");
     echo $f->makeSelect('titles', $title_list);
     echo $f->showMessageOnError('titles');
     echo "</td>";

     echo "<td class=\"tabledata\">";
     echo $f->formatOnError('titles2', 'Title(2):');
         echo "</td>\n<td class=\"tabledata\">";
         /*$title_list = array("-Select One-"=>"", "none"=>"", "MD"=>"MD", "Esq."=>"Esq", "CPA"=>"CPA",
         "DDS"=>"DDS", "DDM"=>"DDM", "DVM"=>"DVM", "VDM"=>"VDM", "CEO"=>"CEO", "President"=>"President",
         "Principal"=>"Principal", "VP"=>"VP", "CFA"=>"CFA");*/
          echo $f->makeSelect('titles2', $title_list);
          echo $f->showMessageOnError('titles2');
     echo "</td>\n</tr>\n";

    echo"<tr>\n<td class=\"tabledata\">";
    echo $f->formatOnError('priority', 'Priority:');
    echo "</td>\n<td class=\"tabledata\">";
    $priority_list = array("-Select One-"=>"0", "Level 1"=>"1", "Level 2"=>"2", "Level 3"=>"3", "Level 4"=>"4",
    "Level 5"=>"5", "Level 6"=>"6", "Level 7"=>"7", "Level 8"=>"8", "Level 9"=>"9");
    echo $f->makeSelect('priority', $priority_list);
    echo $f->showMessageOnError('priority level');
    echo "</td>\n</tr>\n";

    echo"<tr>\n<td class=\"tabledata\">";
    echo $f->formatOnError('fnbasis', 'First Name Basis:');
    echo "</td>\n<td class=\"tabledata\">";
    $first_name_basis_list = array("Yes"=>"Yes", "No"=>"No");
    echo $f->makeRadioGroup('fnbasis', $first_name_basis_list, "No");
    echo $f->showMessageOnError('first name basis');
    echo "</td>\n</tr>\n";

  echo "<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('company', 'Company:');
  echo "</td>\n<td class=\"tabledata\">";
  echo $f->makeTextInput('company', 35);
  echo $f->showMessageOnError('company');
  echo "</td>\n</tr>\n";

  echo "<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('street', 'Street Address:');
  echo "</td>\n<td class=\"tabledata\">";
  echo $f->makeTextInput('street', 35);
  echo $f->showMessageOnError('street address');
  echo "</td>\n</tr>\n";

  echo "<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('csz', 'City, State, Zip:');
  echo "</td>\n<td class=\"tabledata\">";
  echo $f->makeTextInput('csz', 35);
  echo $f->showMessageOnError('csz');
  echo "</td>\n</tr>\n";

  echo "<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('phone', 'Telephone Number:');
  echo "</td>\n<td class=\"tabledata\">";
  echo $f->makeTextInput('phone', 15);
  echo $f->showMessageOnError('phone');
  echo "</td>\n</tr>\n";

  echo "<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('fax', 'Fax Number:');
  echo "</td>\n<td class=\"tabledata\">";
  echo $f->makeTextInput('fax', 15);
  echo $f->showMessageOnError('fax');
    echo "</td>\n</tr>\n";

  echo "<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('email', 'Email:');
  echo "</td>\n<td class=\"tabledata\">";
  echo $f->makeTextInput('email', 35);
  echo $f->showMessageOnError('email');
  echo "</td>\n</tr>\n";

  echo "<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('referal', 'Referal:');
  echo "</td>\n<td class=\"tabledata\">";
  echo $f->makeTextInput('referal', 35);
  echo $f->showMessageOnError('referal');
  echo "</td>\n</tr>\n";

  echo"<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('permission', 'Permission Given:');
  echo "</td>\n<td class=\"tabledata\">";
  $permission_list = array("Verbal"=>"Verbal", "Written"=>"Written", "Declined"=>"Declined");
  echo $f->makeRadioGroup('permission', $permission_list, "Verbal");
  echo $f->showMessageOnError('permission');
    echo "</td>\n</tr>\n";

    echo"<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('newsletter', 'Send Newsletter By:');
  echo "</td>\n<td class=\"tabledata\">";
  $newsletter_list = array("Email"=>"Email", "Fax"=>"Fax");
  echo $f->makeRadioGroup('newsletter', $newsletter_list, "Email");
  echo $f->showMessageOnError('newsletter');
    echo "</td>\n</tr>\n";

  echo "<tr>\n<td class=\"tabledata\">";
  echo $f->formatOnError('history', 'History:');
  echo "</td>\n<td class=\"tabledata\">";
  echo $f->makeTextArea('history', 5, 30);
  echo $f->showMessageOnError('history');
  echo "</div>";

    echo "<tr>";
    echo "<td><input type=\"submit\" name=\"process\" value=\"Save Data\"></td>";
    echo "</tr>";
    echo "</table>";
    echo "</fieldset>";
    echo "</div>";

    echo $f->finish();
}

//make a session to store data for future retrieval
function makeSession($f) {

  if (!session_id()) session_start();

  $_SESSION["category"] = $_REQUEST["category"];
  $_SESSION["targetdb"]= $_REQUEST["targetdb"];
  $_SESSION["salutation"] = $_REQUEST["salutation"];
  $_SESSION["salutation2"] = $_REQUEST["salutation2"];
  $_SESSION["fname"] = $f->cleanText(trim($_REQUEST["fname"]));
  $_SESSION["lname"] = $f->cleanText(trim($_REQUEST["lname"]));
  $_SESSION["fname2"] = $f->cleanText(trim($_REQUEST["fname2"]));
  $_SESSION["lname2"] = $f->cleanText(trim($_REQUEST["lname2"]));
  $_SESSION["title"] = $_REQUEST["titles"];
  $_SESSION["title2"] = $_REQUEST["titles2"];
  $_SESSION["priority"] = $_REQUEST["priority"];
  $_SESSION["fnbasis"] = $_REQUEST["fnbasis"];
  $_SESSION["company"] = trim($_REQUEST["company"]);
  $_SESSION["street"] = $f->cleanText(trim($_REQUEST["street"]));
  $_SESSION["csz"] = $f->cleanText(trim($_REQUEST["csz"]));
  $_SESSION["phone"] = $f->cleanPhone(trim($_REQUEST["phone"]));
  $_SESSION["fax"] = $f->cleanPhone(trim($_REQUEST["fax"]));
  $_SESSION["email"] = trim($_REQUEST["email"]);
  $_SESSION["referal"] = mysql_real_escape_string(trim($_REQUEST["referal"]));
  $_SESSION["newsletter"] = $_REQUEST["newsletter"];
  $_SESSION["permission"] = $_REQUEST["permission"];
  $_SESSION["history"] = trim($_REQUEST["history"]);
  $_SESSION["id"] = trim($_REQUEST["id"]);
}

//destroy session
function destroySession($f)
{
// Initialize the session before destroying it
  if (!session_id()) session_start();

// Clear all of the session variables
  $_SESSION = array();

// Remove the session cookie
  if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 86400, '/');
  }
// Finally, destroy the session
  session_destroy();
}

?>

