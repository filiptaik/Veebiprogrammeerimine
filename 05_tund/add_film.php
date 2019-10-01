<?php
	require("../../../config_vp2019.php");
	require("functions_film.php");
	//echo $serverHost;
	$userName = "Filip Taik";
	$database = "if19_filip_ta_2";
	
    //var_dump($_POST);
	if (isset($_POST["submitFilm"])){
		echo "asd";
	storeFilmInfo($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"], $_POST["filmGenre"], $_POST["filmStudio"], $_POST["filmDirector"]);
	}
	//$filmInfoHTML = readAllFilms();

  require("header.php");
  echo "<h1>" . $userName . " ei salli neid haigeid putukaid" . "</h1>";
  ?>
  <p>see veebileht on loodud õppetöö käigus ega sisalda mingit adekvaatset sisu</p>
  <hr>

  <h2>Eesti filmid</h2>
  <p>Lisa uus film andmebaasi</p>
  <hr>
	<form method="POST">
		<label>Kirjuta filmi pealkiri</label>
		<input type="text" name="filmTitle">
   <br>
   <div>
		<label>Filmi tootmisaasta</label>
		<input type="number" min="1912" max="2019" value="2019" name="filmYear">
	<br>
	<div>
		<label>Filmi kestus</label>
		<input type="number" min="1" max="300" value="80" name="filmDuration">
	<br>
	<div>
	<label>Filmi zanr</label>
		<input type="text" name="filmGenre">
		<br>
	<div>
	<label>Filmi tootja</label>
		<input type="text" name="filmStudio">
	<br>
	<div>
	<label>Filmi lavastaja</label>
		<input type="text" name="filmDirector">
	<br>
		<input type="submit" value="Talleta filmi info" name="submitFilm">
  </form>
  
</body>
</html>