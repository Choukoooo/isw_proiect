<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>lab6</title>
</head>
<body>
    <h2>Hello WORLD</h2>
    <?php 
        $link = mysqli_connect("localhost", "root", "", "evenimente");

        if ($link === false) {
            die("ERROR: Conexiunea nu a putut fi realizata " + mysqli_connect_error() );
        }

        $sql = "SELECT * FROM intrari ORDER BY Data asc";

        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Data</th>";
                        echo "<th>Eveniment</th>";
                        echo "<th>Locatie</th>";
                         echo "<th>Participanti</th>";
                          echo "<th>Status</th>";
                    echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Data'] . "</td>";
                        echo "<td>" . $row['Eveniment'] . "</td>";
                        echo "<td>" . $row['Locatie'] . "</td>";
                        echo "<td>" . $row['Participanti'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";

                    echo "</tr>";
                }
                echo "</table>";
                
                mysqli_free_result($result);
            } else {
                echo "Nu au fost gasite inregistrari";
            }
        } else {
            echo "Nu a putut fi executat queryu";
        }

        mysqli_close($link);
    ?>
    <br/>
    <br/>
    <br/>
    <a href="index.php">Insereaza</a>
</body>
</html>