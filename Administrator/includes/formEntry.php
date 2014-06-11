<?php
class formEntry {

	public function insertIntoDatabase($category, $salutation, $fname, $lname, $priority, $fnbasis, $company, $street, $csz, $phone, $fax, $email, $titles)
	{
		$sql = "LOCK TABLE $category WRITE";
		mysql_query($sql)
		or die("Query failed: ".mysql_error());

			if ($titles=="none")
			{
				$sql = "
						INSERT INTO $category (SALUTATION, FIRST_NAME, LAST_NAME, PRIORITY, FIRST_NAME_BASIS, COMPANY, STREET, CITY_STATE_ZIP, TELEPHONE_NUMBER, FAX_NUMBER, EMAIL)
						VALUES ('$salutation', '$fname', '$lname', '$priority', '$fnbasis', '$company', '$street', '$csz', '$phone', '$fax', '$email')
							";


				mysql_query($sql)
				or die("Query failed: ".mysql_error());

				print "<p>sql=$sql</p>\n";

				$numRows = mysql_affected_rows();
				print "Rows affected: $numRows\n";
			}

			else
			{
					$sql = "
						   INSERT INTO $category (SALUTATION, FIRST_NAME, LAST_NAME, TITLE, PRIORITY, FIRST_NAME_BASIS, COMPANY, STREET, CITY_STATE_ZIP, TELEPHONE_NUMBER, FAX_NUMBER, EMAIL)
							VALUES ('$salutation', '$fname', '$lname', '$titles', '$priority', '$fnbasis', '$company', '$street', '$csz', '$phone', '$fax', '$email')
				";


					mysql_query($sql)
						or die("Query failed: ".mysql_error());

					print "<p>sql=$sql</p>\n";

					$numRows = mysql_affected_rows();
					print "Rows affected: $numRows\n";
			}

		$sql = "UNLOCK TABLES";
		mysql_query($sql)
		or die("Query failed: ".mysql_error());

	}

	function noEntry($field, $message)
	{

		if (!isset($field))
		{
			print $message;
		}

		else if ($field=="")
		{
			print $message;
		}

		else if ($field=="selection")
		{
			print $message;
		}
	}

	function printer($field)
	{
		print $field;
	}

	function cleanPhone($field)
	{
		$field = preg_replace("/[^a-zA-Z0-9\s]/", "", trim($field));
		return $field;
	}

	function cleanText($field)
	{
			$field = preg_replace("/[^'a-zA-Z0-9\s-]/", "", trim($field));
			return $field;
	}

	function isInvalidPhone($field, $message)
	{
		if (!is_numeric($field))
		{
			print $message;
		}

		else if (($field < 1000000000) || ($field > 9999999999))
		{
			print $message;
		}

	}

	function isInvalidEmail($field, $message)
	{
	        $pattern = "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*";
	        $pattern .= "@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";
	        if(!preg_match($pattern, $field)) {
	        	print $message;
	        }
	}


}

?>