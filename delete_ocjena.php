<?php
include("./database_connection.php");

$idUser = $_POST['id'];




try {

    $sql = "DELETE FROM Ocjene WHERE ID = $idUser ";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

    echo json_encode('User deleted');


$conn = null;

?>