<?php
include("./database_connection.php");

$userIme = $_POST['imee'];
$userPrezime = $_POST['prezimee'];
$userAdresa = $_POST['adresaa'];
$userGrad = $_POST['gradd'];

$id = $_POST['ID'];



try {

    $sql = "UPDATE Ucenici
    SET ime = '$userIme', prezime = '$userPrezime', adresa = '$userAdresa', grad = '$userGrad' 
    WHERE ID = '$id'";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}




$conn = null;

?>