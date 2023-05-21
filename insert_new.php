<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Insert</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f9f9f9;
			padding: 20px;
		}

		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		.form-container {
			max-width: 400px;
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
		}

		h2 {
			text-align: center;
			margin-bottom: 20px;
		}

		.form-group {
			margin-bottom: 20px;
		}

		.form-group label {
			display: block;
			margin-bottom: 5px;
		}

		.form-group input[type="text"],
		.form-group input[type="number"] {
			width: 100%;
			padding: 8px;
			font-size: 14px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		.form-group select {
			width: 100%;
			padding: 8px;
			font-size: 14px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		.button-container {
			text-align: center;
		}

		.button-container button {
			padding: 10px 20px;
			font-size: 14px;
			background-color: #4caf50;
			color: #fff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		.button-container button:hover {
			background-color: #45a049;
		}

		.message-container {
			margin-top: 20px;
			text-align: center;
		}

		.message-container p {
			font-size: 16px;
			color: #4caf50;
		}

		.error-message {
			color: #f44336;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="form-container">
			<h2>Insert Event</h2>
			<form action="insert.php" method="POST">
				<div class="form-group">
					<label for="data">Date:</label>
					<input type="date" id="data" name="data" required>
				</div>
				<div class="form-group">
					<label for="eveniment">Event:</label>
					<input type="text" id="eveniment" name="eveniment" required>
				</div>
				<div class="form-group">
					<label for="locatie">Location:</label>
					<input type="text" id="locatie" name="locatie" required>
				</div>
				<div class="form-group">
					<label for="participanti">Participants:</label>
					<input type="number" id="participanti" name="participanti" required>
				</div>
				<div class="form-group">
					<label for="status">Status:</label>
					<select id="status" name="status" required>
						<option value="Pending">Pending</option>
						<option value="Confirmed">Confirmed</option>
						<option value="Cancelled">Cancelled</option>
					</select>
				</div>
				<div class="button-container">
					<button type="submit">Save</button>
				</div>
			</form>
			<div class="message-container">
				<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$link = mysqli_connect("localhost", "root", "", "evenimente");

						if ($link === false) {
							die("ERROR: Connection could not be established. " . mysqli_connect_error());
						} else {
							$data = $_REQUEST['data'];
							$eveniment = $_REQUEST['eveniment'];
							$locatie = $_REQUEST['locatie'];
							$participanti = $_REQUEST['participanti'];
							$status = $_REQUEST['status'];

							$sql = "INSERT INTO intrari (Data, Eveniment, Locatie, Participanti, Status) VALUES (?, ?, ?, ?, ?)";

							if ($stmt = mysqli_prepare($link, $sql)) {
								mysqli_stmt_bind_param($stmt, "sssis", $data, $eveniment, $locatie, $participanti, $status);

								if (mysqli_stmt_execute($stmt)) {
									echo '<p class="success-message">Data has been saved.</p>';
								} else {
									echo '<p class="error-message">Unable to execute the query. ' . mysqli_error($link) . '</p>';
								}
							} else {
								echo '<p class="error-message">Unable to prepare the statement. ' . mysqli_error($link) . '</p>';
							}

							mysqli_stmt_close($stmt);
							mysqli_close($link);
						}
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>
