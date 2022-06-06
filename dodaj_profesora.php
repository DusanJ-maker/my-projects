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
        <h1>Dodaj profesora: </h1>
    </div>

    <br>
    <br>

    <label for="profesor">Profesor:</label><br>
    <input type="text" id="ime_id" name="ime" placeholder="Ime">
    <input type="text" id="prezime_id" name="prezime" placeholder="Prezime">
    <br><br>



    <?php
    include("./database_connection.php");



    $sqlQuery = "SELECT * FROM predmeti";

    try {
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo $error;
    }


    ?>
    <select id="predmeti_id" name="predmeti">
        <?php

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


            echo
            "<option value=" . htmlentities($row['ID']) . ">
                            " . htmlentities($row['Ime_predmeta']) . "
                        </option>";
        }
        ?>
    </select>

    <br>
    <br>

    <button type="button" onclick="addProf()">Dodaj profesora </button>




    <br>
    <br>

    <script>
        function addProf() {
            var ime = document.getElementById("ime_id").value
            var prezime = document.getElementById("prezime_id").value
            var predmet = document.getElementById("predmeti_id").value

            console.log(ime, prezime, predmet)

            const formData = new FormData();
            formData.append('ime_id', ime);
            formData.append('prezime_id', prezime);
            formData.append('predmeti_id', predmet);




            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/add_profesor.php",
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





        function deleteProf(id) {


            const formData = new FormData();
            formData.append('ID', id);





            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/delete_profesor.php",
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

                $sqlQuery = "SELECT nastavnici.ID, nastavnici.Ime, nastavnici.Prezime, predmeti.Ime_predmeta 
                FROM nastavnici
                inner JOIN predmeti ON nastavnici.Predmet_id = predmeti.ID;";

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
                <th>Predmet</th>
                <th>Obrisi</th>

                </tr>
                
                ";

    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";

        echo "<td>" . htmlentities($row['ID']) . "</td>";
        echo "<td>" . htmlentities($row['Ime']) . "</td>";
        echo "<td>" . htmlentities($row['Prezime']) . "</td>";
        echo "<td>" . htmlentities($row['Ime_predmeta']) . "</td>";
        echo '<td><button class="btn" id="button" onclick="deleteProf(' . htmlentities($row['ID']) . ')">Delete</button></td>';

        echo "<tr>";
    }
    echo "</table>";
                ?>

</body>

</html>