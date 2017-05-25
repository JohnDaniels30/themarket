<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// fetching input data
	$name = $_POST["name"];
	$birthdate = $_POST["birthdate"];
	$login = $_POST["login"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirmation = $_POST["confirmation"];

	$initialErrorMessage = "<div class='alert alert-danger'><ul>";
	$errorMessage = $initialErrorMessage;

	function checkName($name)
	{
		global $errorMessage;
		$pattern = "/^[A-Za-zА-Яа-яЁё\s]{4,50}$/";

		if (empty($name)) {
			$errorMessage .= "<li><b>name</b> should not be empty</li>";
			return false;
		}

		if (!preg_match($pattern, $name)) {
			$errorMessage .= "<li><b>name</b> must contain only letters (with spaces) and must be between 4 and 50 characters long (inclusive)</li>";
			return false;
		}

		return true;
	}

	function checkBirthdate($birthdate)
	{
		global $errorMessage;

		if (empty($birthdate)) {
			$errorMessage .= "<li><b>birthdate</b> should not be empty</li>";
			return false;
		}

		return true;
	}

	function checkLogin($login)
	{
		global $errorMessage;
		$pattern = "/^[A-Za-z]([A-Za-z0-9-_]{2,5})$/";

		if (empty($login)) {
			$errorMessage .= "<li><b>login</b> should not be empty</li>";
			return false;
		}

		if (!preg_match($pattern, $login)) {
			$errorMessage .= "<li><b>login</b> must start with a letter and must be between 3 and 6 characters long (inclusive)</li>";
			return false;
		}

		return true;
	}

	function checkEmail($email)
	{
		global $errorMessage;
        $pattern = "/^([A-Za-z]{2,32})@([\da-z\.-]{2,10})\.([a-z\.]{2,6})$/";

		if (empty($email)) {
			$errorMessage .= "<li><b>email</b> should not be empty</li>";
			return false;
		}

		if (!preg_match($pattern, $email)) {
	        $errorMessage .= "<li><b>email</b> first part must consist only letters, then \"@\" symbol and correct domain (with dot and 16 characters maximum)</li>";
	        return false;
        }

	    return true;
    }

    function checkPassword($password, $confirmation)
    {
    	global $errorMessage;

        if (empty($password) || 
        	empty($confirmation) || 
        	($password != $confirmation)
        ) {
            $errorMessage .= "<li><b>passwords</b> must match and not be empty</li>";
            return false;
        }

        return true;
    }

    function saveUser()
    {
		global $conn, $name, $birthdate, $login, $email, 
	   		   $password, $confirmation, $errorMessage;

		$sql = "INSERT INTO users (login, password, email, name, birthdate)
		VALUES ('$login', '$password', '$email', '$name', '$birthdate');";
		$result = $conn->query($sql);

		$conn->close();

		if (!$result) {
		    $errorMessage .= "<li><b>DATABASE WRITE ERROR</b></li>";
		    return false;
		}

		return true;
    }

	function validate()
	{
		global $name, $birthdate, $login, $email, 
			   $password, $confirmation, $errorMessage, $initialErrorMessage;

		checkName($name);
    	checkBirthdate($birthdate);
	    checkLogin($login);
	    checkEmail($email);
	    checkPassword($password, $confirmation);

	    // each check function adds information about invalid data
	    if ($errorMessage != $initialErrorMessage) {
	    	return false;
	    }

	    return true;
	}

    if (validate() && saveUser()) {
    	// redirecting to success page
    	$_SESSION['registrationErrMsg'] = "";
    	header("Location: /account/welcome.php");
    	exit();
	} else {
		// refreshing and displaying error message
		$_SESSION['registrationErrMsg'] = $errorMessage . "</ul></div>";
		header("Location: /account/sign-up.php");
		exit();
	}
}