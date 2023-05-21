<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/select.css">
    
    <title>Calendar</title>
    <style>

    </style>
</head>
<body>
    <script src="js/navbar.js"></script>

    <div class="topnav">
        <a href="index.php">Acasa</a>
        <a href="add_events.php">Adaugare Evenimente</a>
        <a href="select.php" class="active">Calendar</a>
    </div>

    <div class="filter-form">
        <form method="GET">
            <label for="filter-status">Filter by Status:</label>
            <select name="filter-status" id="filter-status">
                <option value="">All</option>
                <option value="Important">Important</option>
                <option value="Realizat">Realizat</option>
                <option value="Nu merg">Nu merg</option>
            </select>

            <label for="filter-location">Filter by Location:</label>
            <select name="filter-location" id="filter-location">
                <option value="">All</option>
                <?php
                    $link = mysqli_connect("localhost", "root", "", "evenimente");

                    if ($link === false) {
                        die("ERROR: Connection could not be established. " + mysqli_connect_error());
                    }

                    $locationQuery = "SELECT DISTINCT Locatie FROM intrari";
                    if ($locationResult = mysqli_query($link, $locationQuery)) {
                        while ($locationRow = mysqli_fetch_array($locationResult)) {
                            $location = $locationRow['Locatie'];
                            echo "<option value=\"$location\">$location</option>";
                        }
                        mysqli_free_result($locationResult);
                    }

                    mysqli_close($link);
                ?>
            </select>

            <input type="submit" value="Filter">
        </form>
    </div>


    <?php 
        $link = mysqli_connect("localhost", "root", "", "evenimente");

        if ($link === false) {
            die("ERROR: Conexiunea nu a putut fi realizată " + mysqli_connect_error() );
        }

        $filterStatus = isset($_GET['filter-status']) ? $_GET['filter-status'] : '';
        $filterLocation = isset($_GET['filter-location']) ? $_GET['filter-location'] : '';

        $sql = "SELECT * FROM intrari WHERE 1=1";
        
        if (!empty($filterType)) {
            $filterType = mysqli_real_escape_string($link, $filterType);
            $sql .= " WHERE Status = '$filterType'";
        }

        $sql .= " ORDER BY Data ASC";

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
                echo "<div class='no-records'>No records found.</div>";
            }
        } else {
            echo "<div class='no-records'>Query execution failed.</div>";
        }

        mysqli_close($link);
    ?>

    <a href="add_events.php" class="insert-link">Inserează</a>
</body>
</html>
