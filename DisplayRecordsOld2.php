<?php
ob_start();
require("includes/db.php");
if (!session_id()) session_start();

main("");

// Control the operation of a page
function main($title = "") {
  $id = $_SESSION["id"];
  $category = $_SESSION["category"];
  include("includes/headerWithoutSidebar.php");
  showContent($title, $category, $id);
  include("includes/footer.php");
}

// Display the content of a page
function showContent($title, $category, $id) {

   $db = new DB();

      $sql = "
            SELECT SALUTATION as 'Salutation:', FIRST_NAME as 'First Name:', LAST_NAME as 'Last Name:', TITLE as 'Title:', FIRST_NAME_BASIS as 'First Name Basis:'
            FROM $category
            WHERE ID='$id';
            ";

      $result = $db->query($sql);
      $row = mysql_fetch_row($result);

      echo "<h1>$title</h1>\n";
      echo "<h2 align = \"left\" class=\"cat2\">$category</h2>";
      echo "<div class=\"leftcolumn1\">";
      echo "<table border=\"1\">\n";
      for ($i = 0; $i < mysql_num_fields($result); $i++) {
        echo "<tr>";
        echo "<td bgcolor=\"green\" class=\"td3\">";
        echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
        echo mysql_field_name($result, $i);
        echo "</B></font>";
        echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\">";
        echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";
        echo $row[$i];
        echo "</B></font>";
        echo "</td></tr>\n";
      }
      echo "</table>\n";
      echo "</div>";


      $sql = "
            SELECT SALUTATION_2 as 'Salutation(2):', FIRST_NAME_2 as 'First Name(2):', LAST_NAME_2 as 'Last Name(2):', TITLE_2 as 'Title(2):'
            FROM $category
            WHERE ID='$id';
            ";

      $result = $db->query($sql);
      $row = mysql_fetch_row($result);

      echo "<div class=\"leftcolumn2\">";
      echo "<table border=\"1\">\n";
      for ($i = 0; $i < mysql_num_fields($result); $i++) {
        echo "<tr>";
        echo "<td bgcolor=\"green\" class=\"td3\">";
        echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
        echo mysql_field_name($result, $i);
        echo "</B></font>";
        echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\">";
        echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";
        echo $row[$i];
        echo "</B></font>";
        echo "</td></tr>\n";
      }
      echo "</table>\n";
      echo "</div>";



     $sql = "
               SELECT TGT_DBF
               FROM $category
               WHERE ID='$id';
               ";

    $result = $db->query($sql);
    $row = mysql_fetch_row($result);

    $targetdb = mysql_result($result, 0, 0);

     echo "<h2 class=\"cat3\">Target Database: $targetdb</h2>";

     $sql = "
               SELECT COMPANY as 'Company:', STREET as 'Address:', CITY_STATE_ZIP as 'City, State Zip:'
               FROM $category
               WHERE ID='$id';
               ";

         $result = $db->query($sql);
      $row = mysql_fetch_row($result);


     echo "<div class=\"rightcolumn1\">";
     echo "<table border=\"1\">\n";
     for ($i = 0; $i < mysql_num_fields($result); $i++) {
       echo "<tr>";
       echo "<td bgcolor=\"green\" class=\"td3\">";
       echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
       echo mysql_field_name($result, $i);
       echo "</B></font>";
       echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\">";
       echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";
       echo $row[$i];
       echo "</B></font>";
       echo "</td></tr>\n";
     }
     echo "</table>\n";
   echo "</div>";


   $sql = "
          SELECT TELEPHONE_NUMBER as 'Phone:', FAX_NUMBER as 'Fax:', EMAIL as 'Email:'
          FROM $category
          WHERE ID='$id';
          ";

        $result = $db->query($sql);
        $row = mysql_fetch_row($result);

        echo "<div class=\"leftcolumn3\">";
        echo "<table border=\"1\">\n";
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
          echo "<tr>";
          echo "<td bgcolor=\"green\" class=\"td3\">";
          echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
          echo mysql_field_name($result, $i);
          echo "</B></font>";
          echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\">";
          echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";

          if (mysql_field_name($result, $i)=="Phone:" || mysql_field_name($result, $i)=="Fax:") {
                   $row[$i] = "(".substr($row[$i], 0, 3).") ".substr($row[$i], 3,3)."-".substr($row[$i],6,4);
                   echo $row[$i];
                 }

          else {
                echo $row[$i];
         }

          echo "</B></font>";
          echo "</td></tr>\n";
        }
      echo "</table>\n";
      echo "</div>";

      $sql = "
          SELECT PRIORITY as 'Priority:', PERMISSION as 'Permission', NEWSLETTER as 'Newsletter:', NO_CONTACT as 'No Contact?'
          FROM $category
          WHERE ID='$id';
          ";

        $result = $db->query($sql);
        $row = mysql_fetch_row($result);

        echo "<div class=\"rightcolumn2\">";
        echo "<table border=\"1\">\n";
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
          echo "<tr>";
          echo "<td bgcolor=\"green\" class=\"td3\">";
          echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
          echo mysql_field_name($result, $i);
          echo "</B></font>";
          echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\">";
          echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";
          echo $row[$i];
          echo "</B></font>";
          echo "</td></tr>\n";
        }
      echo "</table>\n";
      echo "</div>";

      $sql = "
              SELECT HISTORY as 'History:'
              FROM $category
              WHERE ID='$id';
            ";

        $result = $db->query($sql);
        $row = mysql_fetch_row($result);

      echo "<div class=\"rightcolumn3\">";
      echo "<table border=\"1\">\n";
      for ($i = 0; $i < mysql_num_fields($result); $i++) {
        echo "<tr>";
        echo "<td bgcolor=\"green\" class=\"td3\">";
        echo "<font face=\"verdana\" size=\"2\" color=\"white\"><B>";
        echo mysql_field_name($result, $i);
        echo "</B></font>";
        echo "</td><td bgcolor=\"#DFFFC8\" class=\"td3\">";
        echo "<font face=\"verdana\" size=\"2\" color=\"black\"><B>";
        echo $row[$i];
        echo "</B></font>";
        echo "</td></tr>\n";
      }
    echo "</table>\n";
      echo "</div>";

      echo "<form class=\"rightcolumn4\"><input type=\"button\" value=\"Print This Record\" onClick=\"window.print()\"></form>";


  /**echo "<p class=\"bottomrow\">";
  echo "<a href=\"index.php\">Home</a>";
  echo "&nbsp&nbsp&nbsp<a href=\"formwithlibrary.php\">Add Record</a>";
  echo "&nbsp&nbsp&nbsp<a href=\"printreport.php\">Reports</a>";
  echo "&nbsp&nbsp&nbsp<a href=\"searchforrecord.php\">Search</a>"; */




}

?>
