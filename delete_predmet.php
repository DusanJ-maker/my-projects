<?php
include("./database_connection.php");

$idPredmet = $_POST['id'];




try {

    $sql = "DELETE FROM predmeti WHERE ID = $idPredmet ";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

    echo json_encode('User deleted');


$conn = null;

?>