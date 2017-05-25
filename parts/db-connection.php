<?php

define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD_DB", "root");
define("DATABASE", "themarket");

// create connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD_DB, DATABASE);

// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// close connection
function closeConnection()
{
    global $conn;
    $conn->close();
}