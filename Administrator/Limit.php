<?php
ob_start();

/**
* Limit.php
* Allows user to delimit search criteria
*/

if (!session_id()) session_start();
include "includes/redirect.php";
include "includes/formverifier.php";
//require_once "secure.php";

main("Print a Report");

//controls the content of the page
function main($title = "") {

  include "includes/header2.php";
  displayContent();
  include "includes/footer.php";

  if (isset($_REQUEST["submit_button"])) {
    if ($_REQUEST["category"] == "selection") {
      print "<div class=\"errorz\">Please select a database</div>";
    } else {

      $alphafrom = $_REQUEST["alphafrom"];
      $alphato = $_REQUEST["alphato"];
      $datefrom = $_REQUEST["datefrom"];
      $dateto = $_REQUEST["dateto"];
      $category = $_REQUEST["category"];

      $_SESSION["alphafrom"] = $alphafrom;
      $_SESSION["alphato"] = $alphato;
      $_SESSION["datefrom"] = $datefrom;
      $_SESSION["dateto"] = $dateto;
      $_SESSION["category"] = $category;

      redirect("ReportType2.php");
    }
 }


}

//displays the contents of the page
function displayContent() {
  $self = $_SERVER['PHP_SELF'];

  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\">Select a Database</legend>";
  echo "<form action=\"$self\" method=\"POST\">";
  echo "<table>";

  echo"<tr><td>Select a Database:</td>";
     echo "<td>
            <select name=\"category\">
            <option value=\"selection\">-Select One-</option>
            <option value=\"9100_wilshire\">9100 Wilshire</option>
            <option value=\"agents\">Agents</option>
            <option value=\"architects\">Architects</option>
            <option value=\"attorneys\">Attorneys</option>
            <option value=\"bankers\">Bankers</option>
            <option value=\"clients\">Clients</option>
            <option value=\"cpas\">CPAs</option>
            <option value=\"divorce_attorneys\">Divorce Attorneys</option>
            <option value=\"general_business\">General Business</option>
            <option value=\"mail\">Mail</option>
            <option value=\"medical\">Medical</option>
            <option value=\"mls\">MLS</option>
            <option value=\"personal\">Personal</option>
            <option value=\"pga_west\">PGA West</option>
            <option value=\"professional_networking_group\">Professional Networking Group</option>
            <option value=\"prospects\">Prospects</option>
            <option value=\"removed\">Removed</option>
            <option value=\"scratch\">Scratch</option>
            <option value=\"scratch2\">Scratch 2</option>
            <option value=\"womens_group\">Women's Group</option>
            </select>
     </td>
   </tr>";
  echo "</table>";
  echo "<br /><B>Enter data below to limit your search -- or simply press submit:</B><br /><br />";
  echo "<table>";
  echo "<tr><td>Last name from: </td>";
  echo "<td><input type=\"text\" name=\"alphafrom\" value=\"A\"></td>";
  echo "<td>to:</td>";
  echo "<td><input type=\"select\" name=\"alphato\" value =\"Z\"></td></tr>";
  echo "<tr></tr><tr></tr>";
  echo "<tr><td>Dates from: </td>";
  echo "<td><input type=\"select\" name=\"datefrom\" value=\"YYYY-MM-DD\"></td>";
  echo "<td>to:</td>";
  echo "<td><input type=\"select\" name=\"dateto\" value=\"YYYY-MM-DD\"></td></tr>";
  echo "<tr></tr><tr></tr><tr><td><input type=\"submit\" name=\"submit_button\" value=\"Submit\"></td></tr>";
  echo "</form>";
  echo "</table>";
  echo "</fieldset>";

}
?>
