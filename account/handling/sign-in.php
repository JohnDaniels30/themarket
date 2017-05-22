<?php

/**
 * THIS AUTHENTICATION SYSTEM BASED ON COOKIE IS NOT SECURE
 * There are no encrypting or other methods that can stop intruders
 * Do not use this code in a production setting
 */

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// fetching input data
	$login = $_POST["login"];
	$password = $_POST["password"];

	$initialErrorMessage = "<div class='alert alert-danger'><ul>";
	$errorMessage = $initialErrorMessage;

    function checkUser()
    {
		global $login, $password, $errorMessage;

    	$servername = "localhost";
		$username = "root";
		$passwordDB = "root";
		$database = "themarket";

		// creating connection
		$conn = new mysqli($servername, $username, $passwordDB, $database);

		// checking connection
		if ($conn->connect_error) {
		    $errorMessage .= "<li><b>DATABASE CONNECTION FAILED</b></li>";
			return false;
		}

		$sql = "SELECT *
				FROM users 
				WHERE login='$login' AND password='$password';";

		$result = $conn->query($sql);
		$conn->close();

		if ($result->num_rows == 0) {
		    $errorMessage .= "<li>wrong login & password combination</li>";
		    return false;
		}

		return true;
    }

	function authentication()
	{
		global $errorMessage, $initialErrorMessage;

		checkUser();

	    // check function adds information about failure if no match is found
	    if ($errorMessage != $initialErrorMessage) {
	    	return false;
	    }

	    return true;
	}

    if (authentication()) {
    	$_SESSION["authenticationErrMsg"] = "";
    	// set cookie that will expire after 24 hours
    	setcookie(	"authorized", 
    				$login, 
    				(time() + 86400), 
    				"/", 
    				"themarket.com"
    	);
	} else {
		$_SESSION["authenticationErrMsg"] = $errorMessage . "</ul></div>";
	}

	header("Location: /account/index.php");
	exit();
}