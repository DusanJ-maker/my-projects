<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Skola</title>
</head>

<div class = "navbar">
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




    <div class="heading">
        <h1>Dodaj ucenika: </h1>
    </div>

    <br>
    <br>

    <label for="fname">Ime:</label><br>
    <input type="text" id="fname" name="fname" placeholder="Ime" value="Test"><br>
    <label for="lname">Prezime:</label><br>
    <input type="text" id="lname" name="lname" placeholder="Prezime"><br>
    <label for="fname">Adresa:</label><br>
    <input type="text" id="adresa" name="adresa" placeholder="Adresa"><br>
    <label for="fname">Grad:</label><br>
    <input type="text" id="grad" name="grad" placeholder="Grad"><br>
    <label for="">Razred:</label><br>



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


    ?>
    <select id="razred" name="razred_id">
        <?php

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


            echo
            "<option value=" . htmlentities($row['ID']) . ">
                            " . htmlentities($row['razred']) . "
                        </option>";
        }
        ?>
    </select>


    <br><br>
    <button type="button" onclick="addUser()">Dodaj ucenika </button>

    <br>
    <br>

    <script>
        function addUser() {
            var fname = document.getElementById("fname").value
            var lname = document.getElementById("lname").value
            var adresa = document.getElementById("adresa").value
            var grad = document.getElementById("grad").value
            var razred = document.getElementById("razred").value
            console.log(fname, lname, adresa, grad, razred)

            const formData = new FormData();
            formData.append('fname', fname);
            formData.append('lname', lname);
            formData.append('adresa', adresa);
            formData.append('grad', grad);
            formData.append('razred', razred);




            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/add_user.php",
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





        function deleteU(id) {


            const formData = new FormData();
            formData.append('ID', id);





            // Fire off the request to /form.php
            request = $.ajax({
                url: "http://localhost/projects/skola-projekt/delete_user.php",
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

    $sqlQuery = "SELECT ucenici.ID, ucenici.ime, ucenici.prezime, ucenici.adresa, ucenici.grad, razredi.razred
    FROM ucenici 
    INNER JOIN razredi  ON ucenici.razred_id = razredi.ID;";

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
                <th>Adresa</th>
                <th>Grad</th>
                <th>Razred</th>
                <th>Detalji</th>
                <th>Obrisi</th>

                </tr>
                
                ";

    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";

        echo "<td>" . htmlentities($row['ID']) . "</td>";
        echo "<td>" . htmlentities($row['ime']) . "</td>";
        echo "<td>" . htmlentities($row['prezime']) . "</td>";
        echo "<td>" . htmlentities($row['adresa']) . "</td>";
        echo "<td>" . htmlentities($row['grad']) . "</td>";
        echo "<td>" . htmlentities($row['razred']) . "</td>";
        echo '<td> <a href="./ucenik_detalji.php?id=' . htmlentities($row['ID']) . ' "> Otvori Detalje </a> </td>';
        echo '<td><button class="btn" id="button" onclick="deleteU(' . htmlentities($row['ID']) . ')">Delete</button></td>';

        echo "<tr>";
    }
    echo "</table>";
    ?>



</body>

</html>