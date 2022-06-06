<?php
include("./database_connection.php");

$userIme = $_POST['ime_id'];
$userPrezime = $_POST['prezime_id'];
$userPredmet = $_POST['predmeti_id'];

try {

    $sql = "INSERT INTO Nastavnici(Ime, Prezime, Predmet_id)
    VALUES ('$userIme', '$userPrezime', '$userPredmet')";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}




$conn = null;

?>