<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/add_events.css">
    <title>Adaugare Evenimente</title>
</head>
<body>
    <script src="js/navbar.js"></script>

    <div class="topnav">
        <a href="index.php">Acasa</a>
        <a href="add_events.php" class="active">Adaugare Evenimente</a>
        <a href="select.php">Calendar</a>
    </div>

    <div class="content">
        <h2>Adaugare Eveniment</h2>

        <form action="" method="POST">
            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required>
            </div>
            <div class="form-group">
                <label for="eveniment">Eveniment:</label>
                <input type="text" name="eveniment" id="eveniment" required>
            </div>
            <div class="form-group">
                <label for="locatie">Locatie:</label>
                <input type="text" name="locatie" id="locatie" required>
            </div>
            <div class="form-group">
                <label for="participanti">Participanti:</label>
                <input type="number" name="participanti" id="participanti" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Important">Important</option>
                    <option value="Realizat">Realizat</option>
                    <option value="Nu merg">Nu merg</option>
                </select>
            </div>
            <button type="submit" name="submit">Adauga Eveniment</button>
        </form>

        <div class="message-container">
            <?php
            if (isset($_POST['submit'])) {
                $link = mysqli_connect("localhost", "root", "", "evenimente");

                if ($link === false) {
                    die("ERROR: Conexiunea nu a putut fi realizata " . mysqli_connect_error());
                } else {
                    $data = $_POST['data'];
                    $eveniment = $_POST['eveniment'];
                    $locatie = $_POST['locatie'];
                    $participanti = $_POST['participanti'];
                    $status = $_POST['status'];

                    $sql = "INSERT INTO intrari (Data, Eveniment, Locatie, Participanti, Status) VALUES (?, ?, ?, ?, ?)";

                    if ($stmt = mysqli_prepare($link, $sql)) {
                        mysqli_stmt_bind_param($stmt, "sssis", $data, $eveniment, $locatie, $participanti, $status);

                        if (mysqli_stmt_execute($stmt)) {
                            echo '<p class="success-message">Datele au fost salvate.</p>';
                        } else {
                            echo '<p class="error-message">Nu a putut fi executat: ' . mysqli_error($link) . '</p>';
                        }
                    } else {
                        echo '<p class="error-message">Nu a putut fi executat: ' . mysqli_error($link) . '</p>';
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                }
            }
            ?>
        </div>
    </div>

</body>
</html>
