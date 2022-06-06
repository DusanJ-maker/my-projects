<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Skola</title>
</head>

<div class="navbar">
    <ul>
        <li><a href="index.php">Ucenik</a></li>
        <li><a href="dodaj_profesora.php">Profesor</a></li>
        <li><a href="dodaj_razred.php">Razred</a></li>
        <li><a href="dodaj_predmet.php">Predmet</a></li>
        <li><a href="dodaj_ocjenu.php">Ocjena</a></li>
        <li><a href="info.php">Info</a></li>
        <li><a href="ucenik_detalji.php">Detalji ucenika</a></li>
    </ul>
</div>

<body>

    <br>
    <br>
    <br>








    <?php

    include("./database_connection.php");

    $id = $_GET['id'];
    $sqlQuery = "select * from ucenici where ID =:id";

    try {
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo $error;
    }

    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


        echo '<td><label for="fname">Ime:</label></td><br>';
        echo '<td><input class="text" type="text" id="imee" name="txtLogin" value="' . htmlentities($row['ime']) . '"></td><br>';
        echo '<td><label for="fname">Prezime:</label></td><br>';
        echo '<td><input class="text" type="text" id="prezimee" name="txtLogin" value="' . htmlentities($row['prezime']) . '"></td><br>';
        echo '<td><label for="fname">Adresa:</label></td><br>';
        echo '<td><input class="text" type="text" id="adresaa" name="txtLogin" value="' . htmlentities($row['adresa']) . '"></td><br>';
        echo '<td><label for="fname">Grad:</label></td><br>';
        echo '<td><input class="text" type="text" id="gradd" name="txtLogin" value="' . htmlentities($row['grad']) . '"></td><br>';

        echo '<td><button class="btn" id="button" onclick="updateUser(' . htmlentities($row['ID']) . ')">Update</button></td>';
    }

    ?>



    <script>
        function updateUser(id) {
            var ime = document.getElementById("imee").value
            var prezime = document.getElementById("prezimee").value
            var adresa = document.getElementById("adresaa").value
            var grad = document.getElementById("gradd").value
            console.log(ime, prezime, adresa, grad)

            const formData = new FormData();
            formData.append('imee', ime);
            formData.append('prezimee', prezime);
            formData.append('adresaa', adresa);
            formData.append('gradd', grad);
            formData.append('ID', id);




            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/update_user.php",
                type: "post",
                cache: false,
                processData: false,
                contentType: false,
                data: formData
            });

            // Callback handler that will be called on success
            request.done(function(response, textStatus, jqXHR) {
                // Log a message to the console
                location.reload();
            });

            // Callback handler that will be called on failure
            request.fail(function(jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error(
                    "The following error occurred: " +
                    textStatus, errorThrown
                );
            });

        }
    </script>


    <?php

    include("./database_connection.php");

    $sqlQuery = "SELECT ocjene.id, ucenici.ime, ucenici.prezime, ocjene.ocjene
        FROM ucenici
        inner JOIN ocjene ON ucenici.id = ocjene.ucenik_id
        WHERE ucenici.id='$id'";

    try {
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo $error;
    }




    echo "
        <table id='customers'>
        <tr>
        <th>ID</th>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Ocjena</th>

        </tr>

        ";

    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";

        echo "<td>" . htmlentities($row['id']) . "</td>";
        echo "<td>" . htmlentities($row['ime']) . "</td>";
        echo "<td>" . htmlentities($row['prezime']) . "</td>";
        echo "<td>" . htmlentities($row['ocjene']) . "</td>";

        echo "<tr>";
    }
    echo "</table>";
    ?>


</body>

</html>