<?php ob_start()?>
<?php
	require_once "includes/dbconvars.php";
	require "includes/header.php";
	require "includes/footer.php";

	$dbCnx = mysql_connect($dbhost, $dbuser, $dbpwd)
		or die("Could not connect: ".mysql_error());

	mysql_select_db($dbname, $dbCnx)
		or die("Could not select db: ".mysql_error());

	$title="CenTek Capital Group";
 ?>

##<form action="centekdatabase.php" method="POST" name="cust">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
   <fieldset>
   <legend>Enter the client information:</legend>

   <table>
   <tr>
   <td>Where would you like to enter the data?</td>
   <td>
      		<select name="category">
      		<option value="selection">-Select One-</option>
      		<option value="Scratch">Scratch</option>
      		<option value="Scratch_2">Scratch 2</option>
      		<option value="Agents">Agents...Real Estate Agents</option>
      		<option value="Architects">Architects</option>
      		<option value="Attorneys">Attorneys</option>
      		<option value="Bankers">Bankers</option>
      		<option value="Clients">New Clients</option>
      		<option value="CPAs">CPAs</option>
      		<option value="Divorce_Attorneys">Divorce Attorneys</option>
      		<option value="Doctors_Dentists_Vets_Etc">Doctors, Dentists, Vets, etc</option>
      		<option value="General_Business">General Business</option>
      		<option value="Mail">Mail</option>
      		<option value="MLS">MLS</option>
      		<option value="Personal">Personal</option>
      		<option value="PGA_West">PGA West</option>
      		<option value="PNG">Professional Networking Group (PNG)</option>
      		<option value="Prospects">Prospects</option>
      		<option value="Womens_Group">Women's Group</option>
      		<option value="9100_Wilshire">9100 Wilshire</option>
      		</select>
   </td>
   </tr>

   <tr>
   <td>Salutation:</td>
   <td>
   		<select name="salutation">
   		<option value="selection">-Select One-</option>
   		<option value="Dr">Dr.</option>
   		<option value="Mr.">Mr.</option>
   		<option value="Mrs.">Mrs.</option>
   		<option value="Ms.">Ms.</option>
   		<option value="Miss">Miss</option>
   </td>
   </tr>
   <tr>
   <td>First Name:</td>
   <td>
     <input type="text" name="fname" size="35">
   </td>
   </tr>
   <tr>
   <td>Last Name:</td>
   <td>
     <input type="text" name="lname" size="35">
   </td>
   </tr>
   <tr>
   <td>Title:</td>
   <td>
   		<select name="titles">
   			<option value="selection">-Select One-</option>
			<option value="none">none</option>
			<option value="MD">MD</option>
			<option value="Esq">Esq.</option>
			<option value="CPA">CPA</option>
			<option value="DDS">DDS</option>
			<option value="DDM">DDM</option>
			<option value="DVM">DVM</option>
			<option value="VMD">VMD</option>
			<option value="CEO">CEO</option>
			<option value="President">President</option>
			<option value="CFA">CFA</option>
   		</select>
   </td>
   </tr>

   <tr>
   <td>Priority:</td>
   <td>
   		<select name="priority">
			<option value="selection">-Select One-</option>
			<option value="1">Level 1</option>
			<option value="2">Level 2</option>
			<option value="3">Level 3</option>
			<option value="4">Level 4</option>
			<option value="5">Level 5</option>
			<option value="6">Level 6</option>
			<option value="7">Level 7</option>
			<option value="8">Level 8</option>
			<option value="9">Level 9</option>
   		</select>

	<tr>
	   <td>First Name Basis:</td>
	   <td>
	     <input type="radio" name="fnbasis" value="y">Yes</input>
	     <input type="radio" name="fnbasis" value="n" checked>No</input>
	   </td>
   </tr>

   <tr>
      <td>Company:</td>
      <td>
      	<input type="text" name="company" size="35">
      </td>
   </tr>

   <tr>
   <td>Street Address:</td>
   <td>
   	<input type="text" name="street" size="35">
   </td>
   </tr>

   <tr>
   <td>City, State Zip:</td>
   <td>
     <textarea name="csz" cols="30"></textarea>
   </td>
   </tr>

   <tr>
   <td>Telehone Number:</td>
   <td>
   		<input type="text" name="phone" size="35">
   </td>
   </tr>

   <tr>
   <td>Fax Number:</td>
   <td>
   		<input type="text" name="fax" size="35">
   </td>
   </tr>

   <tr>
   <td>Email Address:</td>
   <td>
   		<input type="text" name="email" size="35">
   </td>
   </tr>
   </table>
   </fieldset>

   <p id="formbuttons">
   <input type="button" name="prevb" value="Previous"
     onclick="history.back()">
   <input type="submit" name="nextb" value="Next">
   </p>

</form>

</body>
</html>
