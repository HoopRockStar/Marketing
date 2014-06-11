<?php
ob_start();
require("includes/db.php");
include "includes/redirect.php";
include "includes/formVerifier.php";

if (!session_id()) session_start();

main("Select a Record from the Database:");

// Control the operation of a page
function main($title = "") {
    $f = new formVerifier();

    if (isset($_REQUEST["9100_Wilshire"])) {
      if (!session_id()) session_start();

      if (!isset($_REQUEST["record"])) {
        print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
            print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
            print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
          } else {
            $_SESSION["category"] = "Architects";
            $id = $_REQUEST["record"];
            $_SESSION["id"] = $id;
            redirect("DislpayRecords2.php");
          }
      }

   else if (isset($_REQUEST["Attorneys"])) {
        if (!session_id()) session_start();

        if (!isset($_REQUEST["record"])) {
          print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
            print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
            print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
            print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
              print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
            } else {
              $_SESSION["category"] = "Divorce_Attorneys";
              $id = $_REQUEST["record"];
              $_SESSION["id"] = $id;
              redirect("DisplayRecords2.php");
           }
      }

      else if (isset($_REQUEST["General_Business"])) {
              if (!session_id()) session_start();
              $_SESSION["category"] = "General_Business";
              $id = $_REQUEST["record"];
              $_SESSION["id"] = $id;
              redirect("DisplayRecords2.php");
      }

      else if (isset($_REQUEST["Mail"])) {
              if (!session_id()) session_start();

              if (!isset($_REQUEST["record"])) {
                print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
                print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
                print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
                print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
                print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
                print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
              print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
                  print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
            print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
              print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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
          print "<div class=\"errorz\">Please use the radio buttons to make a selection</div>";
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

    $tester1 = true;
    $tester2 = true;
    $tester3 = true;
    $tester4 = true;
    $tester5 = true;
    $tester6 = true;
    $tester7 = true;
    $tester8 = true;
    $tester9 = true;
    $tester10 = true;
    $tester11 = true;
    $tester12 = true;
    $tester13 = true;
    $tester14 = true;
    $tester15 = true;
    $tester16 = true;
    $tester17 = true;
    $tester18 = true;
    $tester19 = true;

    $userEntry = $_SESSION["userEntry"];

    echo "<h3>$title</h3>\n";
    echo "<table width=\"55%\">\n";
    showHeading();

    $result = queryDB($selection, $userEntry, "9100_wilshire");

    if (mysql_num_rows($result) == 0){
      $tester1 = false;
    }

    while ($row = mysql_fetch_row($result)) {
        list($id, $fname, $lname, $company, $address, $category) = $row;
        showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "agents");

    if (mysql_num_rows($result) == 0){
      $tester2 = false;
    }

    while ($row = mysql_fetch_row($result)) {
      list($id, $fname, $lname, $company, $address, $category) = $row;
      showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "attorneys");

    if (mysql_num_rows($result) == 0){
      $tester3 = false;
    }


    while ($row = mysql_fetch_row($result)) {
       list($id, $fname, $lname, $company, $address, $category) = $row;
       showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "bankers");

    if (mysql_num_rows($result) == 0){
      $tester4 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "clients");

    if (mysql_num_rows($result) == 0){
      $tester5 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "cpas");

    if (mysql_num_rows($result) == 0){
      $tester6 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "divorce_attorneys");

    if (mysql_num_rows($result) == 0){
      $tester7 = false;
    }


        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "general_business");

    if (mysql_num_rows($result) == 0){
      $tester8 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "mail");

    if (mysql_num_rows($result) == 0){
      $tester9 = false;
    }


        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "medical");

    if (mysql_num_rows($result) == 0){
      $tester10 = false;
    }


        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "mls");

    if (mysql_num_rows($result) == 0){
      $tester11 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "Personal");

    if (mysql_num_rows($result) == 0){
      $tester12 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "pga_west");

    if (mysql_num_rows($result) == 0){
      $tester13 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "professional_networking_group");

    if (mysql_num_rows($result) == 0){
      $tester14 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "prospects");

    if (mysql_num_rows($result) == 0){
      $tester15 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "removed");

    if (mysql_num_rows($result) == 0){
      $tester16 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "scratch");

    if (mysql_num_rows($result) == 0){
      $tester17 = false;
    }

    while ($row = mysql_fetch_row($result)) {
      list($id, $fname, $lname, $company, $address, $category) = $row;
      showItem($id, $fname, $lname, $company, $address, $category);
    }

    $result = queryDB($selection, $userEntry, "scratch2");

    if (mysql_num_rows($result) == 0){
      $tester18 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
     }

     $result = queryDB($selection, $userEntry, "womens_group");

    if (mysql_num_rows($result) == 0){
      $tester19 = false;
    }

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category) = $row;
          showItem($id, $fname, $lname, $company, $address, $category);
     }

    if ($tester1 == false && $tester2 == false && $tester3 == false && $tester4 == false && $tester5 == false && $tester6 == false && $tester7 == false && $tester8 == false && $tester9 == false && $tester10 == false && $tester11 == false && $tester12 == false && $tester13 == false && $tester14 == false && $tester15 == false && $tester16 == false && $tester17 == false && $tester18 == false && $tester19 == false) {
        echo "No Records Were Found. Please Use Your Browser's Back Button to Search Again.\n";
    }


    echo "</table>\n";

  mysql_free_result($result);
  mysql_close($dbCnx);
}

function queryDB($selection, $userEntry, $dbname) {

    $sql = "
        SELECT ID, FIRST_NAME, LAST_NAME, COMPANY, STREET, CATEGORY
        FROM $dbname
        WHERE $selection LIKE '$userEntry%'
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
  <td bgcolor="green" width="150">
      <font face="verdana" size="2" color="white">&nbsp;<b>Database</b></font>
  </td>
</tr>

HTML;
}

// Display each table item
function showItem($id, $fname, $lname, $company, $street, $category) {
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
        <font face="verdana" size="2" color="black"><B>$category</B></font>
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

