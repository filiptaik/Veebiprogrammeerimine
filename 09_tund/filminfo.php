<?php
	require("../../../config_vp2019.php");
	require("functions_film.php");
	//echo $serverHost;
	$userName = "Filip Taik";
	$database = "if19_filip_ta_2";
	
    $filmInfoHTML = readAllFilms();

  require("header.php");
  echo "<h1>" . $userName . " ei salli neid haigeid putukaid" . "</h1>";
  ?>
  <p>see veebileht on loodud õppetöö käigus ega sisalda mingit adekvaatset sisu</p>
  <hr>

  <hr>
  <h2>Eesti filmid</h2>
  <p>Praegu on meie andmebaasis järgmised filmid:</p>
  <?php
  echo $filmInfoHTML; 
 ?>
  
  <br>
  
</body>
</html>