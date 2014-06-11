<?php
ob_start();

/*
* All3.php
* Displays records by last name, not in database order
*/


require("includes/db.php");
include "includes/redirect.php";

main("Select a Record from the Database:");

// Control the operation of a page
function main($title = "") {

    if (isset($_REQUEST["9100_Wilshire"])) {
      if (!session_id()) session_start();

      if (!isset($_REQUEST["record"])) {
        print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
      } else {
        $_SESSION["category"] = "9100_Wilshire";
        $id = $_REQUEST["record"];
        $_SESSION["id"] = $id;
        redirect("DisplayRecords2.php");
      }
    }

    else if (isset($_REQUEST["Agents"])) {
          if (!session_id()) session_start();

          if (!isset($_REQUEST["record"])) {
              print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
          } else {
            $_SESSION["category"] = "Agents";
            $id = $_REQUEST["record"];
            $_SESSION["id"] = $id;
            redirect("DisplayRecords2.php");
         }
      }

    else if (isset($_REQUEST["Architects"])) {
          if (!session_id()) session_start();

          if (!isset($_REQUEST["record"])) {
            print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
          } else {
            $_SESSION["category"] = "Architects";
            $id = $_REQUEST["record"];
            $_SESSION["id"] = $id;
            redirect("DisplayRecords2.php");
          }
      }

   else if (isset($_REQUEST["Attorneys"])) {
        if (!session_id()) session_start();

        if (!isset($_REQUEST["record"])) {
          print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
        } else {
          $_SESSION["category"] = "Attorneys";
          $id = $_REQUEST["record"];
          $_SESSION["id"] = $id;
          redirect("DisplayRecords2.php");
        }
      }

  else if (isset($_REQUEST["Bankers"])) {
          if (!session_id()) session_start();

          if (!isset($_REQUEST["record"])) {
            print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
          } else {
            $_SESSION["category"] = "Bankers";
            $id = $_REQUEST["record"];
            $_SESSION["id"] = $id;
            redirect("DisplayRecords2.php");
          }
      }


  else if (isset($_REQUEST["Clients"])) {
          if (!session_id()) session_start();

          if (!isset($_REQUEST["record"])) {
            print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
          } else {
            $_SESSION["category"] = "Clients";
            $id = $_REQUEST["record"];
            $_SESSION["id"] = $id;
            redirect("DisplayRecords2.php");
          }
      }

   else if (isset($_REQUEST["CPAs"])) {
           if (!session_id()) session_start();

           if (!isset($_REQUEST["record"])) {
            print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
           } else {
             $_SESSION["category"] = "CPAs";
             $id = $_REQUEST["record"];
             $_SESSION["id"] = $id;
             redirect("DisplayRecords2.php");
           }
   }

    else if (isset($_REQUEST["Divorce_Attorneys"])) {
            if (!session_id()) session_start();

            if (!isset($_REQUEST["record"])) {
              print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
            } else {
              $_SESSION["category"] = "Divorce_Attorneys";
              $id = $_REQUEST["record"];
              $_SESSION["id"] = $id;
              redirect("DisplayRecords2.php");
            }
      }

      else if (isset($_REQUEST["General_Business"])) {
              if (!session_id()) session_start();

              if (!isset($_REQUEST["record"])) {
                print "<div class=\"errorz\">Please use the radio buttons (cicles next to each entry) to make a selection</div>";
              } else {
                $_SESSION["category"] = "General_Business";
                $id = $_REQUEST["record"];
                $_SESSION["id"] = $id;
                redirect("DisplayRecords2.php");
              }
      }

      else if (isset($_REQUEST["Mail"])) {
              if (!session_id()) session_start();

              if (!isset($_REQUEST["record"])) {
                print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
              } else {
                $_SESSION["category"] = "Mail";
                $id = $_REQUEST["record"];
                $_SESSION["id"] = $id;
                redirect("DisplayRecords2.php");
              }
      }

      else if (isset($_REQUEST["Medical"])) {
              if (!session_id()) session_start();

              if (!isset($_REQUEST["record"])) {
                print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
              } else {
                $_SESSION["category"] = "Medical";
                $id = $_REQUEST["record"];
                $_SESSION["id"] = $id;
                redirect("DisplayRecords2.php");
             }
      }

      else if (isset($_REQUEST["MLS"])) {
              if (!session_id()) session_start();

              if (!isset($_REQUEST["record"])) {
                print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
              } else {
                $_SESSION["category"] = "MLS";
                $id = $_REQUEST["record"];
                $_SESSION["id"] = $id;
                redirect("DisplayRecords2.php");
              }
      }

      else if (isset($_REQUEST["Personal"])) {
              if (!session_id()) session_start();

              if (!isset($_REQUEST["record"])) {
                print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
              } else {
                $_SESSION["category"] = "Personal";
                $id = $_REQUEST["record"];
                $_SESSION["id"] = $id;
                redirect("DisplayRecords2.php");
             }
      }

      else if (isset($_REQUEST["PGA_West"])) {
              if (!session_id()) session_start();

              if (!isset($_REQUEST["record"])) {
                print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
              } else {
                $_SESSION["category"] = "PGA_West";
                $id = $_REQUEST["record"];
                $_SESSION["id"] = $id;
                redirect("DisplayRecords2.php");
              }
      }

     else if (isset($_REQUEST["Professional_Networking_Group"])) {
              if (!session_id()) session_start();

              if (!isset($_REQUEST["record"])) {
                print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
              } else {
                $_SESSION["category"] = "Professional_Networking_Group";
                $id = $_REQUEST["record"];
                $_SESSION["id"] = $id;
                redirect("DisplayRecords2.php");
             }
      }

    else if (isset($_REQUEST["Prospects"])) {
            if (!session_id()) session_start();

            if (!isset($_REQUEST["record"])) {
              print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
            } else {
              $_SESSION["category"] = "Prospects";
              $id = $_REQUEST["record"];
              $_SESSION["id"] = $id;
              redirect("DisplayRecords2.php");
            }
      }

    else if (isset($_REQUEST["Removed"])) {
                if (!session_id()) session_start();

                if (!isset($_REQUEST["record"])) {
                  print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
                } else {
                  $_SESSION["category"] = "Removed";
                  $id = $_REQUEST["record"];
                  $_SESSION["id"] = $id;
                  redirect("DisplayRecords2.php");
                }
      }

    else if (isset($_REQUEST["Scratch"])) {
          if (!session_id()) session_start();

          if (!isset($_REQUEST["record"])) {
            print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
          } else {
            $_SESSION["category"] = "Scratch";
            $id = $_REQUEST["record"];
            $_SESSION["id"] = $id;
            redirect("DisplayRecords2.php");
          }
      }

    else if (isset($_REQUEST["Scratch2"])) {
            if (!session_id()) session_start();

            if (!isset($_REQUEST["record"])) {
              print "<div class=\"errorz\">Please use the radio buttons (circles next to each entry) to make a selection</div>";
            } else {
              $_SESSION["category"] = "Scratch2";
              $id = $_REQUEST["record"];
              $_SESSION["id"] = $id;
              redirect("DisplayRecords2.php");
            }
      }

    else if (isset($_REQUEST["Womens_Group"])) {
        if (!session_id()) session_start();

        if (!isset($_REQUEST["record"])) {
          print "<div clas=\"errorz\">Please use the radio butons (circles next to each entry) to make selection</div>";
        } else {
          $_SESSION["category"] = "Womens_Group";
          $id = $_REQUEST["record"];
          $_SESSION["id"] = $id;
          redirect("DisplayRecords2.php");
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

    if (!session_id()) session_start();
    $selection = $_SESSION["selection"];

    if (isset($_REQUEST["userEntry"])) {
      $userEntry = $_REQUEST["userEntry"];
      if (!get_magic_quotes_gpc()) {
         $selection = mysql_real_escape_string($selection);
         $userEntry = mysql_real_escape_string($userEntry);
      }

      $_SESSION["userEntry"] = $userEntry;

    }

    $userEntry = $_SESSION["userEntry"];

    echo "<h3>$title</h3>\n";
    echo "<table width=\"55%\">\n";
    showHeading();

    clearDB();

    populateDB($selection, $userEntry, "9100_Wilshire");
    populateDB($selection, $userEntry, "Agents");
    populateDB($selection, $userEntry, "Architects");
    populateDB($selection, $userEntry, "Attorneys");
    populateDB($selection, $userEntry, "Bankers");
    populateDB($selection, $userEntry, "Clients");
    populateDB($selection, $userEntry, "Cpas");
    populateDB($selection, $userEntry, "Divorce_Attorneys");
    populateDB($selection, $userEntry, "General_Business");
    populateDB($selection, $userEntry, "Mail");
    populateDB($selection, $userEntry, "Medical");
    populateDB($selection, $userEntry, "MLS");
    populateDB($selection, $userEntry, "Personal");
    populateDB($selection, $userEntry, "pga_west");
    populateDB($selection, $userEntry, "Professional_Networking_Group");
    populateDB($selection, $userEntry, "Prospects");
    populateDB($selection, $userEntry, "Removed");
    populateDB($selection, $userEntry, "Scratch");
    populateDB($selection, $userEntry, "Scratch2");
    populateDB($selection, $userEntry, "Womens_Group");

    $result = queryDB();

    if (mysql_num_rows($result) == 0) {
      echo "No Results Were Found. Please Use Your Browser's Back Button to Try Again.";
    }

    else {
      while ($row = mysql_fetch_row($result)) {
          list($fname, $lname, $company, $address, $category, $id) = $row;
          showItem($fname, $lname, $company, $address, $category, $id);
      }
    }


  echo "</table>\n";

  mysql_free_result($result);
  mysql_close($dbCnx);
}

function populateDB($selection, $userEntry, $dbname) {

  $sql = "INSERT INTO `combined`
          SELECT SALUTATION, LAST_NAME, FIRST_NAME, TITLE, COMPANY, STREET, CITY_STATE_ZIP, TELEPHONE_NUMBER, CATEGORY, ID, DATE_ENTERED
          FROM $dbname
          WHERE $selection LIKE '$userEntry%'
          ";

  $result = mysql_query($sql);
}

function clearDB() {

  $sql = "TRUNCATE TABLE `combined`
          ";

  $result = mysql_query($sql);
}

function queryDB() {

    $sql = "
        SELECT FIRST_NAME, LAST_NAME, COMPANY, STREET, CATEGORY, ID
        FROM `combined`
        ORDER BY LAST_NAME
        ";
    $result = mysql_query($sql);
    return $result;
}


// Display the table heading
function showHeading() {
    echo <<<HTML
<tr>
  <td bgcolor="green">
      <font face="verdana" size="2" color="white">&nbsp;<b>Record</b>&nbsp;</font>
  </td>
  <td bgcolor="green">
    <font face="verdana" size="2" color="white">&nbsp;<b>First Name</b>&nbsp;</font>
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
</tr>

HTML;
}

// Display each table item
function showItem($fname, $lname, $company, $street, $category, $id) {
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
        <font face="verdana" size="2" color="black">$category</font>
  </td>
  <td>
      <input type="submit" name="$category" value="View">
  </td>
</tr>
<tr>
  <td width="100%" colspan="6">
    <hr size="1" color="red" noshade>
  </td>
</tr>
</form>

HTML;
}

?>

