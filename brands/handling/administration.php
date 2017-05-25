<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

function addBrand($name, $description)
{
    global $conn;

    $sql = "INSERT INTO brands (name, description) 
            VALUES ('$name', '$description')";
    $conn->query($sql);

    $conn->close();
}

function editBrand($oldId, $newId, $name, $description)
{
    global $conn;

    $sql = "UPDATE brands 
            SET id=$newId,
                name='$name',
                description='$description'
            WHERE id=$oldId";
    $conn->query($sql);
    
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // add record
    if (isset($_POST["add"])) {
        addBrand($_POST["name"], $_POST["description"]);
        header("Location: /brands/brands-records.php");
        exit();
    }

    // update record
    if (isset($_POST["edit"])) {
        editBrand($_POST["oldId"], $_POST["newId"], 
                  $_POST["name"],  $_POST["description"]);
        header("Location: /brands/brands-records.php");
        exit();
    }
}