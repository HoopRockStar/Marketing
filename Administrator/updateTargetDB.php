<?php
ob_start();
require_once "includes/redirect.php";
if (!session_id()) session_start();

// Page starts and stops with this function call
main("Remove Record?");

// Form processing logic
function main($title = "") {
    $category = $_SESSION["category"];
    $lname = $_SESSION["lname"];
    $fname= $_SESSION["fname"];
    $id = $_SESSION["id"];
    if (isset($_POST["Yes"])) {
        removeRecord($category, $id);
        redirect("removalConfirmation.php");
        }
    else if (isset($_POST["No"])) {
    	redirect("SearchforRecords.php");
    }
    include "includes/header.php";
    showContent($title, $category, $lname, $fname);
    include "includes/footer.php";
}


// Process the data
function removeRecord($category, $id) {
    require("includes/db.php");

    $db = new DB();

    $sql = "
    	UPDATE $category
    	SET TGT_DBF = 'removed'
    	WHERE ID='$id'
    	";

    $result = $db->query($sql);


    $sql = "INSERT INTO REMOVED
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

	$db->showQuery();

}

// Display the content of the page
function showContent($title, $category, $lname, $fname) {
    echo "<h1>$title</h1>\n";
    echo "<h3>Are you certain you wish to delete $fname $lname from $category?"
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>"
  method="post">
<input type="submit" name="Yes" value="Yes">
<input type="submit" name="No" value="No">
</form>

<?php
}
?>
