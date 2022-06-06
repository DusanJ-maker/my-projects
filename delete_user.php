<?php
include("./database_connection.php");

$idUser = $_POST['ID'];




try {

    $sql = "DELETE FROM Ucenici WHERE id = $idUser ";

    $conn->exec($sql);
}   catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

    echo json_encode('User deleted');


$conn = null;

?>