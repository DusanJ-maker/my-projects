<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Skola</title>
</head>

<ul>
    <li><a href="index.php">Ucenik</a></li>
    <li><a href="dodaj_profesora.php">Profesor</a></li>
    <li><a href="dodaj_razred.php">Razred</a></li>
    <li><a href="dodaj_predmet.php">Predmet</a></li>
    <li><a href="dodaj_ocjenu.php">Ocjena</a></li>
    <li><a href="info.php">Info</a></li>
    <li><a href="ucenik_detalji.php">Detalji ucenika</a></li>
</ul>

<body>

    <div class="heading">
        <h1>Dodaj ocjenu: </h1>
    </div>

    <br>
    <br>

    <label for="razred">Ocjena:</label><br>
    <input type="text" id="ocjena_id" name="ocjene" placeholder="Ocjena">
    <br><br>



    <?php
    include("./database_connection.php");



    $sqlQuery = "SELECT * FROM Ucenici";

    try {
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo $error;
    }


    ?>
    <select id="ucenici_id" name="ucenici">
        <?php

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


            echo
            "<option value=" . htmlentities($row['ID']) . ">
                            " . htmlentities($row['ime']) . "
                            " . htmlentities($row['prezime']) . "
                        </option>";
        }
        ?>
    </select>

    <br>
    <br>

    <button type="button" onclick="addOcjena()">Dodaj ocjenu </button>




    <br>
    <br>

    <script>
        function addOcjena() {
            var ucenik = document.getElementById("ucenici_id").value
            var ocj = document.getElementById("ocjena_id").value

            console.log(ucenik, ocj)

            const formData = new FormData();
            formData.append('ucenici_id', ucenik);
            formData.append('ocjena_id', ocj);




            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/add_ocjena.php",
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





        function deleteOcj(id) {


            const formData = new FormData();
            formData.append('id', id);





            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/delete_ocjena.php",
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
                inner JOIN ocjene ON ucenici.id = ocjene.ucenik_id;";

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
                <th>Obrisi</th>

                </tr>
                
                ";

    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";

        echo "<td>" . htmlentities($row['id']) . "</td>";
        echo "<td>" . htmlentities($row['ime']) . "</td>";
        echo "<td>" . htmlentities($row['prezime']) . "</td>";
        echo "<td>" . htmlentities($row['ocjene']) . "</td>";
        echo '<td><button class="btn" id="button" onclick="deleteOcj(' . htmlentities($row['id']) . ')">Delete</button></td>';

        echo "<tr>";
    }
    echo "</table>";
                ?>

</body>

</html>