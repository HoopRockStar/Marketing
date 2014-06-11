<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();

include "includes/redirect.php";
include "includes/formverifier.php";
include "includes/formlib.php";

// Page starts and stops with this function call
main("Edit Data");

// Form processing logic
function main($title = "") {
    $errors = "";

    $category = $_SESSION["category"];
    $id = $_SESSION["id"];
    $salutation = $_SESSION["salutation"];
    $salutation2 = $_SESSION["salutation2"];
    $fname = $_SESSION["fname"];
    $fname2 = $_SESSION["fname2"];
    $lname = $_SESSION["lname"];
    $lname2 = $_SESSION["lname2"];
    $title = $_SESSION["title"];
    $title2 = $_SESSION["title2"];
    $priority = $_SESSION["priority"];
    $company = $_SESSION["company"];
    $targetdb = $_SESSION["targetdb"];
    $fnbasis = $_SESSION["fnbasis"];
    $street = $_SESSION["street"];
    $csz = $_SESSION["csz"];
    $phone = $_SESSION["phone"];
    $fax = $_SESSION["fax"];
    $email = $_SESSION["email"];
    $referal = $_SESSION["referal"];
    $permission = $_SESSION["permission"];
    $newsletter = $_SESSION["newsletter"];
    $history = $_SESSION["history"];
    $contact = $_SESSION["contact"];
    $date_entered = $_SESSION["date"];
    $date_transfered = $_SESSION["transfered"];


  $db = new DB();
  $f = new Formlib("error", HORIZONTAL);

    if (isset($_POST["submitTest"])) {
        checkForm($f);
        if (!$f->isError()) { // data is OK
            deleteData($db, $category, $id);
            insertData($f, $contact, $date_entered, $date_transfered);
            updateID($db, $category, $company, $fname, $lname);
            redirect("confirmation.php");
        }
    }

    if (isset($_POST["cancel"])) {
        redirect("DisplayRecords2.php");
    }

    include "includes/header.php";
    showContent($errors, $category, $salutation, $salutation2, $fname, $fname2, $lname, $lname2, $title, $title2, $priority, $company, $targetdb, $fnbasis, $street, $csz, $phone, $fax, $email, $referal, $permission, $newsletter, $history, $f);
    include "includes/footer.php";
}

// Check the input form for errors
function checkForm(&$f) {
  $f->isEmpty('category', "Please select a category");
  $f->isInvalidPhone('phone', "Please enter a valid 10-digit phone");
  $f->isInvalidPhone('fax', "Please enter a valid 10-digit fax");
  $f->isInvalidEmail('email', "Please enter a valid email");
}

// Process the data
function insertData($f, $contact, $date_entered, $date_transfered) {
    require "includes/dbconvars.php";
      $dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
          or die(mysql_error());
      mysql_select_db($dbname, $dbCnx)
          or die(mysql_error());

      // Process the query
      $category = $_REQUEST["category"];
      $targetdb = $_REQUEST["targetdb"];
      $salutation = $_REQUEST["salutation"];
      $fname = trim($_REQUEST["fname"]);
      $fname = $f->cleanText($fname);
      $lname = trim($_REQUEST["lname"]);
      $lname = $f->cleanText($lname);
      $title = $_REQUEST["titles"];
      $salutation2 = $_REQUEST["salutation2"];
      $fname2 = trim($_REQUEST["fname2"]);
      $fname2 = $f->cleanText($fname2);
      $lname2 = trim($_REQUEST["lname2"]);
      $lname2 = $f->cleanText($lname2);
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
          $fname = mysql_real_escape_string($fname);
          $lname = mysql_real_escape_string($lname);
          $title = mysql_real_escape_string($title);
          $salutation2 = mysql_real_escape_string($salutation2);
          $fname2 = mysql_real_escape_string($fname2);
          $lname2 = mysql_real_escape_string($lname2);
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

    $_SESSION["category"] = $category;
    $_SESSION["salutation"] = $salutation;
    $_SESSION["fname"] = $fname;
    $_SESSION["lname"] = $lname;
    $_SESSION["title"] = $title;
    $_SESSION["salutation2"] = $salutation2;
    $_SESSION["fname2"] = $fname2;
    $_SESSION["lname2"] = $lname2;
    $_SESSION["title2"] = $title2;
    $_SESSION["priority"] = $priority;
    $_SESSION["company"] = $company;
    $_SESSION["targetdb"] = $targetdb;
    $_SESSION["fnbasis"] = $fnbasis;
    $_SESSION["street"] = $street;
    $_SESSION["csz"] = $csz;
    $_SESSION["phone"] = $phone;
    $_SESSION["fax"] = $fax;
    $_SESSION["email"] = $email;
    $_SESSION["referal"] = $referal;
    $_SESSION["permission"] = $permission;
    $_SESSION["newsletter"] = $newsletter;
    $_SESSION["history"] = $history;

      $sql = "
          INSERT INTO $category(SALUTATION, SALUTATION_2, FIRST_NAME, FIRST_NAME_2, LAST_NAME, LAST_NAME_2, TITLE, TITLE_2, PRIORITY, FIRST_NAME_BASIS, COMPANY, STREET, CITY_STATE_ZIP, TELEPHONE_NUMBER, FAX_NUMBER, EMAIL, TGT_DBF, REFERAL, PERMISSION, NEWSLETTER, HISTORY, CATEGORY, NO_CONTACT, X_FERED, DATE_ENTERED)
          VALUES ('$salutation', '$salutation2', '$fname', '$fname2', '$lname', '$lname2', '$title', '$title2', '$priority', '$fnbasis', '$company', '$street', '$csz', '$phone', '$fax', '$email', '$targetdb', '$referal', '$permission', '$newsletter', '$history', '$category', '$contact', '$date_transfered', '$date_entered')
          ";

      //print "<div class=\"errorz\">$sql</div>";
      mysql_query($sql)
          or die("Query failed: ".mysql_error());
      $addressID = mysql_insert_id();
  mysql_close($dbCnx);
}

// Display the content of the page
function showContent($errors, $category, $salutation, $salutation2, $fname, $fname2, $lname, $lname2, $title, $title2, $priority, $company, $targetdb, $fnbasis, $street, $csz, $phone, $fax, $email, $referal, $permission, $newsletter, $history, $f) {
        //$f = new formlib();
        echo $f->reportErrors();
        echo $f->start();

      echo "<fieldset class=\"fieldset\">";
      echo "<legend class=\"legend\">Please Enter the Data Below:</legend>";
      echo "<table width=\"70%\" cellpadding=\"2px\">";

     echo "<tr><td class=\"tabledata\">";
       echo $f->formatOnError('category', 'Database Category:');
       echo "</td>\n<td class=\"tabledata\">";
       $category_list = array("-Select One-"=>"selection", "Agents...Real Estate Agents"=>"Agents", "Architects"=>"Architects",
         "Attorneys"=>"Attorneys", "Bankers"=>"Bankers", "Clients"=>"Clients", "CPAs"=>"CPAs", "Divorce Attorneys"=>"Divorce_Attorneys", "Doctors, Dentists, Vets, etc"=>"Medical",
         "General Business"=>"General_Business", "Mail"=>"Mail", "MLS"=>"MLS", "Personal"=>"Personal", "PGA West"=>"PGA_West", "Professional Networking Group"=>"Professional_Networking_Group",
         "Prospects"=>"Prospects", "Scratch"=>"Scratch", "Scratch2"=>"Scratch2", "Women's Group"=>"Womens_Group", "9100 Wilshire"=>"9100_Wilshire", "Removed"=>"Removed");

       echo $f->makeSelect('category', $category_list, $category);
       echo $f->showMessageOnError('category');
       echo "</td>\n</tr></col>\n";

       echo"<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('targetdb', 'Target Database:');
       echo "</td>\n<td class=\"tabledata\">";
       $target_list = array("-Select One-"=>"selection", "Agents...Real Estate Agents"=>"Agents", "Architects"=>"Architects",
         "Attorneys"=>"Attorneys", "Bankers"=>"Bankers", "Clients"=>"Clients", "CPAs"=>"CPAs", "Divorce Attorneys"=>"Divorce_Attorneys", "Doctors, Dentists, Vets, etc"=>"Medical",
         "General Business"=>"General_Business", "Mail"=>"Mail", "MLS"=>"MLS", "Personal"=>"Personal", "PGA West"=>"PGA_West", "Professional Networking Group"=>"Professional_Networking_Group",
         "Prospects"=>"Prospects", "Women's Group"=>"Womens_Group", "9100 Wilshire"=>"9100_Wilshire", "Removed"=>"Removed");
       echo $f->makeSelect('targetdb', $target_list, $targetdb);
       echo $f->showMessageOnError('targetdb');
       echo "</td>\n</tr>\n";

       echo"<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('salutation', 'Salutation:');
       echo "</td>\n<td class=\"tabledata\">";
       $salutation_list = array("-Select One-"=>"", "Mr."=>"Mr.", "Mrs."=>"Mrs.", "Ms."=>"Ms.", "Miss"=>"Miss", "Dr."=>"Dr.");
        echo $f->makeSelect('salutation', $salutation_list, $salutation);
        echo $f->showMessageOnError('salutation');
        echo "</td>";

        echo "<td class=\"tabledata\">";
          echo $f->formatOnError('salutation2', 'Salutation(2):');
          echo "</td>\n<td class=\"tabledata\">";
          $salutation_list = array("-Select One-"=>"", "Mr."=>"Mr.", "Mrs."=>"Mrs.", "Ms."=>"Ms.", "Miss"=>"Miss", "Dr."=>"Dr.");
        echo $f->makeSelect('salutation2', $salutation_list, $salutation2);
        echo $f->showMessageOnError('salutation2');
        echo "</td>\n</tr>\n";

         echo "<tr>\n<td class=\"tabledata\">";
         echo $f->formatOnError('fname', 'First Name:');
         echo "</td>\n<td class=\"tabledata\">";
         echo $f->makeTextInput('fname', 30, $fname);
         echo $f->showMessageOnError('first name');
         echo "</td>";

         echo "<td class=\"tabledata\">";
         echo $f->formatOnError('fname2', 'First Name(2):');
         echo "</td>\n<td class=\"tabledata\">";
         echo $f->makeTextInput('fname2', 30, $fname2);
         echo $f->showMessageOnError('first name 2');
         echo "</td>\n</tr>\n";

         echo "<tr>\n<td class=\"tabledata\">";
         echo $f->formatOnError('lname', 'Last Name:');
         echo "</td>\n<td class=\"tabledata\">";
         echo $f->makeTextInput('lname', 30, $lname);
         echo $f->showMessageOnError('last name');
         echo "</td>";

         echo "<td class=\"tabledata\">";
         echo $f->formatOnError('lname2', 'Last Name(2):');
         echo "</td>\n<td class=\"tabledata\">";
         echo $f->makeTextInput('lname2', 30, $lname2);
         echo $f->showMessageOnError('last name');
         echo "</td>\n</tr>\n";

         echo"<tr>\n<td class=\"tabledata\">";
         echo $f->formatOnError('titles', 'Title:');
         echo "</td>\n<td class=\"tabledata\">";
          $title_list = array("-Select One-"=>"", "none"=>"",  "CEO"=>"CEO", "CFA"=>"CFA", "CPA"=>"CPA", "DDM"=>"DDM", "DDS"=>"DDS", "DVM"=>"DVM",  "Esq."=>"Esq", "MD"=>"MD", "PhD"=>"PhD", "President"=>"President",
          "Principal"=>"Principal", "VDM"=>"VDM", "VP"=>"VP");
       echo $f->makeSelect('titles', $title_list, $title);
          echo $f->showMessageOnError('titles');
          echo "</td>";

          echo "<td class=\"tabledata\">";
          echo $f->formatOnError('titles2', 'Title(2):');
              echo "</td>\n<td class=\"tabledata\">";
              /*$title_list = array("-Select One-"=>"", "none"=>"", "MD"=>"MD", "Esq."=>"Esq", "CPA"=>"CPA",
              "DDS"=>"DDS", "DDM"=>"DDM", "DVM"=>"DVM", "VDM"=>"VDM", "CEO"=>"CEO", "President"=>"President",
              "Principal"=>"Principal", "VP"=>"VP", "CFA"=>"CFA");*/
               echo $f->makeSelect('titles2', $title_list, $title2);
               echo $f->showMessageOnError('titles2');
          echo "</td>\n</tr>\n";

         echo"<tr>\n<td class=\"tabledata\">";
         echo $f->formatOnError('priority', 'Priority:');
         echo "</td>\n<td class=\"tabledata\">";
         $priority_list = array("-Select One-"=>"selection", "Level 1"=>"1", "Level 2"=>"2", "Level 3"=>"3", "Level 4"=>"4",
         "Level 5"=>"5", "Level 6"=>"6", "Level 7"=>"7", "Level 8"=>"8", "Level 9"=>"9");
         echo $f->makeSelect('priority', $priority_list, $priority);
         echo $f->showMessageOnError('priority level');
         echo "</td>\n</tr>\n";

         echo"<tr>\n<td class=\"tabledata\">";
         echo $f->formatOnError('fnbasis', 'First Name Basis:');
         echo "</td>\n<td class=\"tabledata\">";
         $first_name_basis_list = array("Yes"=>"Yes", "No"=>"No");
         echo $f->makeRadioGroup('fnbasis', $first_name_basis_list, $fnbasis);
         echo $f->showMessageOnError('first name basis');
         echo "</td>\n</tr>\n";

       echo "<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('company', 'Company:');
       echo "</td>\n<td class=\"tabledata\">";
       echo $f->makeTextInput('company', 35, $company);
       echo $f->showMessageOnError('company');
       echo "</td>\n</tr>\n";

       echo "<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('street', 'Street Address:');
       echo "</td>\n<td class=\"tabledata\">";
       echo $f->makeTextInput('street', 35, $street);
       echo $f->showMessageOnError('street address');
       echo "</td>\n</tr>\n";

       echo "<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('csz', 'City, State, Zip:');
       echo "</td>\n<td class=\"tabledata\">";
       echo $f->makeTextInput('csz', 35, $csz);
       echo $f->showMessageOnError('csz');
       echo "</td>\n</tr>\n";

       echo "<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('phone', 'Telephone Number:');
       echo "</td>\n<td class=\"tabledata\">";
       echo $f->makeTextInput('phone', 15, $phone);
       echo $f->showMessageOnError('phone');
       echo "</td>\n</tr>\n";

       echo "<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('fax', 'Fax Number:');
       echo "</td>\n<td class=\"tabledata\">";
       echo $f->makeTextInput('fax', 15, $fax);
       echo $f->showMessageOnError('fax');
         echo "</td>\n</tr>\n";

       echo "<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('email', 'Email:');
       echo "</td>\n<td class=\"tabledata\">";
       echo $f->makeTextInput('email', 35, $email);
       echo $f->showMessageOnError('email');
       echo "</td>\n</tr>\n";

       echo "<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('referal', 'Referal:');
       echo "</td>\n<td class=\"tabledata\">";
       echo $f->makeTextInput('referal', 35, $referal);
       echo $f->showMessageOnError('referal');
       echo "</td>\n</tr>\n";

       echo"<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('permission', 'Permission Given:');
       echo "</td>\n<td class=\"tabledata\">";
       $permission_list = array("Verbal"=>"Verbal", "Written"=>"Written", "Declined"=>"Declined");
       echo $f->makeRadioGroup('permission', $permission_list, $permission);
       echo $f->showMessageOnError('permission');
         echo "</td>\n</tr>\n";

         echo"<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('newsletter', 'Send Newsletter By:');
       echo "</td>\n<td class=\"tabledata\">";
       $newsletter_list = array("Email"=>"Email", "Fax"=>"Fax");
       echo $f->makeRadioGroup('newsletter', $newsletter_list, $newsletter);
       echo $f->showMessageOnError('newsletter');
         echo "</td>\n</tr>\n";

       echo "<tr>\n<td class=\"tabledata\">";
       echo $f->formatOnError('history', 'History:');
       echo "</td>\n<td class=\"tabledata\">";
       echo $f->makeTextArea('history', 5, 30, $history);
       echo $f->showMessageOnError('history');
       echo "</td></tr>";
       echo "</div>";
       $self = $_SERVER['PHP_SELF'];
       echo "<tr><td>";
       echo "<form action=\"$self\" method=\"post\">";
       echo "<input type=\"submit\" name=\"submitTest\" value=\"Submit\">";
       echo "</form>";

       echo "</td><td>";
       echo "<form action=\"$self\" method=\"post\">";
       echo "<input type=\"submit\" name=\"cancel\" value=\"Cancel\">";
       echo "</form>";
       echo "</td></tr>";
       echo "</table>";
       echo "</fieldset>";
       echo "</div>";
?>


<?php echo $f->finish();
   }

function deleteData($db, $category, $id) {

  $sql = "
  DELETE FROM $category
  WHERE ID='$id';
  ";
  $result = $db->query($sql);

}

function updateID($db, $category, $company, $fname, $lname) {
  $sql = "
    SELECT ID
    FROM $category
    WHERE COMPANY='$company' AND FIRST_NAME='$fname' AND LAST_NAME='$lname'
    ";

  $result = $db->query($sql);
  $newid = mysql_result($result, 0, 0);
  print("NEWID: $newid");
  $_SESSION["id"] = $newid;


}
?>

