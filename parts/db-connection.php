<?php

define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD_DB", "root");
define("DATABASE", "themarket");

// Create connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD_DB, DATABASE);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}