<?php
include("./database_connection.php");

$userName = $_POST['fname'];
$userLname = $_POST['lname'];
$userAdresa = $_POST['adresa'];
$userGrad = $_POST['grad'];
$userRazred = $_POST['razred'];



try {

    $sql = "INSERT INTO Ucenici(ime, prezime, adresa, grad, razred_id)
    VALUES ('$userName', '$userLname', '$userAdresa', '$userGrad', $userRazred)";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}




$conn = null;

?>