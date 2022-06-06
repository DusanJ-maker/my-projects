<?php
include("./database_connection.php");

$userRazr = $_POST['razred'];



try {

    $sql = "INSERT INTO Razredi(razred)
    VALUES ('$userRazr')";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}




$conn = null;

?>