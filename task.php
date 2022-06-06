

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

            $stmtC->execute();
            while ($rowC = $stmtC->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";

                echo "<td>" . htmlentities($rowC['invTkey']) . "</td>";
                echo "<td>" . htmlentities($rowC['invDate']) . "</td>";
                echo "<td>" . htmlentities($rowC['invWhouse']) . "</td>";
                echo "<td>" . htmlentities($rowC['invUser']) . "</td>";
                echo "<td>" . htmlentities($rowC['invTransType']) . "</td>";
                echo "<td>" . htmlentities($rowC['invQtyChange']) . "</td>";
                echo '<td> <a href="./ucenik_detalji.php?id=' . htmlentities($row['ID']) . ' "> Otvori Detalje </a> </td>';
                echo '<td><button class="btn" id="button" onclick="deleteU(' . htmlentities($row['ID']) . ')">Delete</button></td>';

                echo "<tr>";
            }
            echo "</table>";