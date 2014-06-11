<?php
ob_start();
session_start();

include "includes/formverifier.php";
include "includes/header2.php";
include "includes/footer.php";


?>
<div class="body">
<h2>Print a Report</h2>
<fieldset class="fieldset">
<legend class="legend"=>Select the database you would like to print from</legend>
<form action="Limit.php" method="POST" >
   <table>
   <tr>
   <td>Select a Database:</td>
   <td>
          <select name="category">
          <option value="selection">-Select One-</option>
          <option value="9100_wilshire">9100 Wilshire</option>
          <option value="agents">Agents</option>
          <option value="architects">Architects</option>
          <option value="attorneys">Attorneys</option>
          <option value="bankers">Bankers</option>
          <option value="clients">Clients</option>
          <option value="cpas">CPAs</option>
          <option value="divorce_attorneys">Divorce Attorneys</option>
          <option value="general_business">General Business</option>
          <option value="mail">Mail</option>
          <option value="medical">Medical</option>
          <option value="mls">MLS</option>
          <option value="personal">Personal</option>
          <option value="pga_west">PGA West</option>
          <option value="professional_networking_group">Professional Networking Group</option>
          <option value="prospects">Prospects</option>
          <option value="removed">Removed</option>
          <option value="scratch">Scratch</option>
          <option value="scratch2">Scratch 2</option>
          <option value="Scratch">Scratch</option>
          <option value="womens_group">Women's Group</option>
          </select>
   </td>
   </tr>
    </table>
      </fieldset>

      <p>
      <input type="submit" name="nextb" value="Go">
      </p>
</form>
