<?php
include("./database_connection.php");

$userUcenik = $_POST['ucenici_id'];
$userOcjena = $_POST['ocjena_id'];



try {

    $sql = "INSERT INTO Ocjene(ucenik_id, ocjene)
    VALUES ('$userUcenik', '$userOcjena')";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}




$conn = null;

?>