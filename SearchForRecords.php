<?php
ob_start();

/*
* SearchForRecords.php
*/

session_start();
include "includes/redirect.php";
include "includes/formverifier.php";

if (!session_id()) session_start();

main();

function main() {
  if (isset($_REQUEST["nextb"])) {
    if ($_REQUEST["category"] == "selection") {
      print "<div class=\"errorz\">Please select a database</div>";
    } elseif ($_REQUEST["selection"] == "selectone") {
      print "<div class=\"errorz\">Please select an option by which to search</div>";
    } else {
        $category = $_REQUEST["category"];
        $_SESSION["category"] = $category;
        $selection = $_REQUEST["selection"];
        $_SESSION["selection"] = $selection;
        redirect("SearchForRecords2.php");
    }
  }
  include "includes/header.php";
  displayContents();
  include "includes/footer.php";
}

function displayContents() {
  $self = $_SERVER['PHP_SELF'];
  echo "<h2>Search for a Record</h2>";
  echo "<fieldset class=\"fieldset\">";
  echo "<legend class=\"legend\"=>Please select your search criteria</legend>";
  echo "<form action=\"$self\" method=\"POST\">";
     echo "<table>";
     echo "<tr>";
     echo "<td>Select a Database:</td>";
     echo "<td>";
            echo "<select name=\"category\">";
            echo "<option value=\"selection\">-Select One-</option>";
            echo "<option value=\"Scratch\">Scratch</option>";
            echo "<option value=\"Scratch_2\">Scratch 2</option>";
            echo "<option value=\"Agents\">Agents...Real Estate Agents</option>";
            echo "<option value=\"Architects\">Architects</option>";
            echo "<option value=\"Attorneys\">Attorneys</option>";
            echo "<option value=\"Bankers\">Bankers</option>";
            echo "<option value=\"Clients\">New Clients</option>";
            echo "<option value=\"CPAs\">CPAs</option>";
            echo "<option value=\"Divorce_Attorneys\">Divorce Attorneys</option>";
            echo "<option value=\"Medical\">Doctors, Dentists, Vets, etc</option>";
            echo "<option value=\"General_Business\">General Business</option>";
            echo "<option value=\"Mail\">Mail</option>";
            echo "<option value=\"MLS\">MLS</option>";
            echo "<option value=\"Personal\">Personal</option>";
            echo "<option value=\"PGA_West\">PGA West</option>";
            echo "<option value=\"PNG\">Professional Networking Group (PNG)</option>";
            echo "<option value=\"Prospects\">Prospects</option>";
            echo "<option value=\"Womens_Group\">Women's Group</option>";
            echo "<option value=\"9100_Wilshire\">9100 Wilshire</option>";
            echo "</select>";
     echo "</td>";
     echo "</tr>";
     echo "<tr>";
     echo "<td>Search by:</td>";
     echo "<td>";
        echo "<select name=\"selection\">";
        echo "<option value=\"selectone\">-Select One-</option>";
        echo "<option value=\"FIRST_NAME\">First Name</option>";
        echo "<option value=\"LAST_NAME\">Last Name</option>";
        echo "<option value=\"TELEPHONE_NUMBER\">Phone Number</option>";
        echo "<option value=\"COMPANY\">Company</option>";
        echo "<option value=\"PRIORITY\">Priority</option>";
     echo "</td>";
     echo "</tr>";
     echo "</table>";
     echo "</fieldset>";

     echo "<p>";
     echo "<input type=\"submit\" name=\"nextb\" value=\"Search\">";
     echo "</p>";
  echo "</form>";

}

?>
