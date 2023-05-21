<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
</head>
<style>
body {
    background-image: url("imagine.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

</style>
<body>
	 <nav id="meniu">
        <ul class="nav-bar">
            <a>
			Organizare evenimente
		</a>
        </ul>
    <div class="container">
			<aside id="side-meniu">
				<a href="index.php"><button class="button" style="vertical-align:middle"><span>Acasa<i class="fas fa-home"></i></span></button></a>
				
				<a href="Adaugare evenimente.php "><button class="button" style="vertical-align:middle"><span>Adaugare Evenimente</i></span></button></a>
			
			    <a href="select.php"><button class="button"style="vertical-align:middle"><span>Calendar<i class="fas fa-calendar"></i></span></button></a>
			</aside>

	<form action="insert.php">
		<label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
		<p>
			<label for="eveniment">Eveniment</label>
			<input type="text" name="eveniment" id="eveniment">
		</p>
		<p>
			<label for="locatie">Locatie</label>
			<input type="text" name="locatie" id="locatie">
		</p>
		<p>
			<label for="participanti">Participanti</label>
			<input type="number" name="participanti" id="participanti">
		</p>
		
		 <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Important">Important</option>
            <option value="Realizat">Realizat</option>
            <option value="Nu merg">Nu merg</option>
        </select>
		<input type="submit" value="submit">
	</form>
</body>
</html>