<?php
ob_start();
session_start();

include "includes/redirect.php";
include "includes/formverifier.php";
include "includes/header.php";
include "includes/footer.php";
?>

<div class="body">
<fieldset class="fieldset">
<legend class="legend">Select a Database:</legend>
<form action="printreport1.php" method="POST">
<input type="select" name="database" value="Scratch">Scratch</input><br>
<input type="select" name="database" value="Scratch2">Scratch2</input><br>
<input type="select" name="database" value="Agents">Agents</input><br>
<input type="select" name="database" value="Architects">Architects</input><br>
<input type="select" name="database" value="Attorneys">Attorneys</input><br>
<input type="select" name="database" value="Bankers">Bankers</input><br>
<input type="select" name="database" value="Clients">Clients</input><br>
<input type="select" name="database" value="CPAs">CPAs</input><br>
<input type="select" name="database" value="Doctors">Doctors, Dentists, Vets</input><br>
<input type="select" name="database" value="DivorceAttorneys">Divorce Attorneys</input><br>
<input type="select" name="database" value="GeneralBusiness">General Business</input><br>
<input type="select" name="database" value="Mail">Mail</input><br>
<input type="select" name="database" value="MLS">MLS</input><br>
<input type="select" name="database" value="Personal">Personal</input><br>
<input type="select" name="database" value="PGAWest">PGA West</input><br>
<input type="select" name="database" value="PNG">Professional Networking Group</input><br>
<input type="select" name="database" value="Prospects">Prospects</input><br>
<input type="select" name="database" value="WomensGroup">Women's Group</input><br>
<input type="select" name="database" value="9100Wilshire">9100 Wilshire</input><br>

</fieldset>
</div>
