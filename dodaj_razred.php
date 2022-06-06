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
        <h1>Dodaj razred: </h1>
    </div>

    <br>
    <br>

    <label for="razred">Razred:</label><br>
    <input type="text" id="razred_id" name="razred" placeholder="Razred">
    <br><br>
    <button type="button" onclick="addRaz()">Dodaj razred </button>




    <br>
    <br>

    <script>
        function addRaz() {
            var raz = document.getElementById("razred_id").value
            console.log(raz)

            const formData = new FormData();
            formData.append('razred', raz);



            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/add_razred.php",
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





        function deleteRaz(id) {


            const formData = new FormData();
            formData.append('ID', id);





            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/delete_razred.php",
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

    $sqlQuery = "SELECT * FROM Razredi";

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
                <th>Razred</th>
                <th>Obrisi</th>
                

                </tr>
                
                ";

    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";

        echo "<td>" . htmlentities($row['ID']) . "</td>";
        echo "<td>" . htmlentities($row['razred']) . "</td>";
        echo '<td><button class="btn" id="button" onclick="deleteRaz(' . htmlentities($row['ID']) . ')">Delete</button></td>';

        echo "<tr>";
    }
    echo "</table>";
    ?>

</body>

</html>