<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
</head>
<body>
	 <nav id="meniu">
        <ul class="nav-bar">
            <a>
			Gestionarea Calendar 
		</a>
        </ul>
    <div class="container">
			<aside id="side-meniu">
				<a href="index.php">Acasa<i class="fas fa-home"></i></a>
				<br>
				<a href="Adaugare evenimente.php">Adaugare Evenimente<i class="fa-solid fa-calendar"></i></a>
				<br>
			    <a href="select.php">Calendar<i class="fas fa-calendar"></i></a>
			</aside>
			
<?php
	$link = mysqli_connect("localhost", "root", "", "evenimente");
 
	if ($link === false) {
		die("ERROR: Conexiunea nu a putut fi realizata " . mysqli_connect_error() );
	} else {
		echo "Valori inserate";
	}
 
	$sql = "INSERT INTO intrari (Data, Eveniment , Locatie, Participanti,Status) VALUES (?, ?, ?, ?, ?)";
 
	if ($stmt = mysqli_prepare($link, $sql)) {
		mysqli_stmt_bind_param($stmt, "sssis", $data, $eveniment, $locatie, $participanti, $status);
 
		$data = $_REQUEST['data'];
		$eveniment = $_REQUEST['eveniment'];
        $locatie = $_REQUEST['locatie'];
        $participanti = $_REQUEST['participanti'];
        $status = $_REQUEST['status'];
 
 
		if (mysqli_stmt_execute($stmt)) {
			echo "Datele au fost salvate";

		} else {
			echo "Nu a putut fi executat: $sql. " . mysqli_error($link);
		}
	} else {
		echo "Nu a putut fi executat: $sql. " . mysqli_error($link);
	}
 
	mysqli_stmt_close($stmt);
	mysqli_close($link);
?>

</body>

</html>
