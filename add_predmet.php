<?php
include("./database_connection.php");


$userPredmet = $_POST['predmet_id'];



try {

    $sql = "INSERT INTO predmeti(Ime_predmeta)
    VALUES ('$userPredmet')";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}




$conn = null;

?>