<?php
ob_start();

include "includes/redirect.php";
include_once("includes/formlib.php");
include "includes/header.php";
include "includes/footer.php";
include "includes/db.php";

$f = new formLib("error", HORIZONTAL);
echo $f->start();

$db = new DB("warn");
showContents($f);

//displays contents of page
function showContents($f)
{
//prompt user for initial search criteria
	echo "How would you like to search?";

	$list = array("Category"=>"category", "First Name"=>"fname", "Last Name"=>"lname", "Company"=>"company",
			"Priority Level"=>"priority", "Phone Number"=>"phone", "Email"=>"email");
	$selection = array("category");
	echo $f->makeSelect('search', $list, $category);

	echo "<input type=\"submit\" name=\"searchButton\" value=\"Submit\"> </p>";

	if (isset($_REQUEST["searchButton"])) {

//refine search
		foreach ($_REQUEST['search'] as $item) {
			if($item=="category");
				echo "Please select a category:";
				$category_list = array("-Select One-"=>"selection", "Scratch"=>"Scratch", "Scratch_2"=>"Scratch_2", "Agents...Real Estate Agents"=>"Agents", "Architects"=>"Architects",
						"Attorneys"=>"Attorneys", "Bankers"=>"Bankers", "Clients"=>"Clients", "CPAs"=>"CPAs", "Divorce Attorneys"=>"Divorce Attorneys", "Doctors, Dentists, Vets, etc"=>"Doctors",
						"General Business"=>"General_Business", "Mail"=>"Mail", "MLS"=>"MLS", "Personal"=>"Personal", "PGA West"=>"PGA_West", "Professional Networking Group"=>"PNG",
						"Prospects"=>"Prospects", "Women's Group"=>"Womens_Group", "9100 Wilshire"=>"9100_Wilshire");
				$f->makeSelect('category', $category_list);

			} else if ($item=="fname") {
				echo "Please enter a first name:";
				echo $f->makeTextInput('fname', 30);
				echo $f->showMessageOnError('fname');

			} else if ($item=="lname") {
				echo "Please enter a last name:";
				echo $f->makeTextInput('lname', 30);
				echo $f->showMessageOnError('lname');

			} else if ($item=="company") {
				echo "Please enter a company name:";
				echo $f->makeTextInput('company', 30);
				echo $f->showMessageOnError('company');

			} else if ($item=="priority") {
				echo "Please enter a priority level:";
				$priority_list = array("-Select One-"=>"selection", "Level 1"=>"1", "Level 2"=>"2", "Level 3"=>"3", "Level 4"=>"4",
						"Level 5"=>"5", "Level 6"=>"6", "Level 7"=>"7", "Level 8"=>"8", "Level 9"=>"9");
						 echo $f->makeSelect('priority', $priority_list);
				echo $f->showMessageOnError('priority level');

			} else if ($item=="phone") {
				echo "Please enter a phone number:";
				echo $f->makeTextInput('phone', 15);
				echo $f->showMessageOnError('phone');

			} else if ($item=="email") {
				echo "Please enter an email address: ";
				echo $f->makeTextInput('email', 50);
				echo $f->showMessageOnError('email');
			}

		}
}

function processData($f,$db)
{
	$db->connect();

	if (isset($_REQUEST["category"])) {
		$category = $_REQUEST["category"];
		$sql ="SELECT * FROM $category";
		$db->query($sql);
	} else if (isset($_REQUEST["fname"])) {
		$fname = $_REQUEST["fname"];
		$sql = "SELECT $fname FROM *";
		$db->query($sql);
	} else if (isset($_REQUEST["lname"])) {
		$lname = $_REQUEST["lname"];
		$sql = "SELECT $lname FROM *";
		$db->query($sql);
	} else if (isset($_REQUEST["priority"])) {
		$priority = $_REQUEST["priority"];
		$sql = "SELECT $priority FROM *";
		$db->query($sql);
	} else if (isset($_REQUEST["phone"])) {
		$phone = $_REQUEST["phone"];
		$sql = "SELECT $phone FROM *";
		$db->query($sql);
	} else if (isset($_REQUEST["email"]) {
		$email = $_REQUEST["email"];
		$sql = "SELECT $email FROM *"";
		$db->query($sql);
	}
}

echo $f->finish();

}




?>