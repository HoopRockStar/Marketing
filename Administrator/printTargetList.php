<?php
ob_start();
require("includes/db.php");
include "includes/redirect.php";

main("Records to Update:");

// Control the operation of a page
function main($title = "") {

    if (isset($_REQUEST["9100_wilshire"])) {
      if (!session_id()) session_start();
      $_SESSION["category"] = "9100_wilshire";
      $id = $_REQUEST["record"];
      $_SESSION["id"] = $id;
      //redirect("DisplayRecords2.php");
      }

    else if (isset($_REQUEST["agents"])) {
          if (!session_id()) session_start();
          $_SESSION["category"] = "agents";
          $id = $_REQUEST["record"];
          $_SESSION["id"] = $id;
          redirect("DisplayRecords2.php");
      }

    else if (isset($_REQUEST["architects"])) {
          if (!session_id()) session_start();
          $_SESSION["category"] = "architects";
          $id = $_REQUEST["record"];
          $_SESSION["id"] = $id;
          redirect("DislpayRecords2.php");
      }

   else if (isset($_REQUEST["attorneys"])) {
        if (!session_id()) session_start();
        $_SESSION["category"] = "attorneys";
        $id = $_REQUEST["record"];
        $_SESSION["id"] = $id;
        redirect("DisplayRecords2.php");
      }


    else if (isset($_REQUEST["Scratch"])) {
          if (!session_id()) session_start();
          $_SESSION["category"] = "Scratch";
          $category = "Scratch";
          $id = $_REQUEST["record"];
          $_SESSION["id"] = $id;
          removeRecord($category, $id);
          //redirect("DisplayRecords2.php");
      }
    //include("includes/header2.php");
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

    echo "<h3>$title</h3>\n";
    echo "<table width=\"70%\">\n";
    showHeading();

    $result = queryDB("9100_wilshire");

    while ($row = mysql_fetch_row($result)) {
        list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
        showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("agents");

    while ($row = mysql_fetch_row($result)) {
      list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
      showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("attorneys");

    while ($row = mysql_fetch_row($result)) {
       list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
       showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("bankers");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("clients");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("cpas");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("divorce_attorneys");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("general_business");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("mail");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("medical");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("mls");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("personal");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("pga_west");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("professional_networking_group");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("prospects");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("removed");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("scratch");

    while ($row = mysql_fetch_row($result)) {
      list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
      showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
    }

    $result = queryDB("scratch2");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
     }

     $result = queryDB("womens_group");

        while ($row = mysql_fetch_row($result)) {
          list($id, $fname, $lname, $company, $address, $category, $targetdb) = $row;
          showItem($id, $fname, $lname, $company, $address, $category, $targetdb);
     }


    echo "</table>\n";

    echo "<p class=\"bottombutton\"><form>";
    echo "<input type=\"button\" value=\"Print List\" onClick=\"window.print()\">";
    echo "</form></p>";


  mysql_free_result($result);
  mysql_close($dbCnx);
}

function queryDB($dbname) {

    $sql = "
        SELECT ID, FIRST_NAME, LAST_NAME, COMPANY, STREET, CATEGORY, TGT_DBF
        FROM $dbname
        WHERE $dbname.TGT_DBF != $dbname.CATEGORY
        ORDER BY LAST_NAME
        ";
    $result = mysql_query($sql);
    return $result;
}

// Process the data
function removeRecord($category, $id) {

    $db = new DB();

    $sql = "
              SELECT TGT_DBF
              FROM $category
              WHERE ID='$id';
              ";

    $result = $db->query($sql);
    $row = mysql_fetch_row($result);

    $targetdb = mysql_result($result, 0, 0);

    $sql = "
      UPDATE $category
      SET category = '$targetdb'
      WHERE ID='$id'
      ";

    $result = $db->query($sql);

    $sql = "INSERT INTO $targetdb
      SELECT *
      FROM $category
      WHERE ID = '$id'
      ";
  $result = $db->query($sql);


  $sql = "
      DELETE FROM $category
      WHERE ID='$id';
      ";

  $result = $db->query($sql);

}

// Display the table heading
function showHeading() {
    echo <<<HTML
<tr>
  <td bgcolor="green" width="150">
      <font face="verdana" size="2" color="white">&nbsp;<b>Select One</b></font>
  </td>
  <td bgcolor="green" width="150">
    <font face="verdana" size="2" color="white">&nbsp;<b>First Name</b></font>
  </td>
  <td bgcolor="green" width="150">
    <font face="verdana" size="2" color="white">&nbsp;<b>Last Name</b>&nbsp;</font>
  </td>
  <td bgcolor="green" width="150">
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
<tr>
  <td width="100%" colspan="7">
    <hr size="1" color="red" noshade>
  </td>
</tr>

HTML;
}

// Display each table item
function showItem($id, $fname, $lname, $company, $street, $category, $targetdb) {
$self = $_SERVER['PHP_SELF'];

    echo <<<HTML
<form action="$self" method="POST">
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

