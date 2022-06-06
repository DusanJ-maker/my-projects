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

<br>
<br>
<br>
    
    <?php

    include("./database_connection.php");

    $sqlQuery = "select ucenici.ID, ucenici.ime, ucenici.prezime, ucenici.adresa, ucenici.grad, razredi.razred, ocjene.ocjene
    from ((ucenici 
    inner join razredi on ucenici.razred_id = razredi.id)
    inner join ocjene on ucenici.id = ocjene.ucenik_id);";

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
                <th>Ocjena</th>
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
        echo "<td>" . htmlentities($row['ocjene']) . "</td>";
        echo '<td><button class="btn" id="button" onclick="deleteU(' . htmlentities($row['ID']) . ')">Delete</button></td>';

        echo "<tr>";
    }
    echo "</table>";
    ?>



</body>

</html>