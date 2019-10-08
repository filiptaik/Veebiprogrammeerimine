<?php
 require("functions_user.php");
	$database = "if19_filip_ta_2";
	$mydescription = null;
	$mytxtcolor = null;
	$mybgcolor = null;
	$notice = null;
	
	//veateated
	
	$mydescriptionError = null;
	//kui on nuppu vajutatud!
	if (isset($_POST["submitProfile"])){
		if (isset($_POST["mydescription"]) and !empty ($_POST["mydescription"])){
		$name = test_input($_POST["mydescription"]);
	} else {
		$mydescriptionError = "Palun sisesta oma kirjeldus!"; // siin jäin pooleli, kopeeri newuser.phpd
		
		
		
		
	}// nupp vajutatud

  ?>
  <!DOCTYPE html>
<html lang="et">
  <head>
  <meta charset="utf-8">			
  <title>Lisa profiil</title>

</head>
<body>
  <p>see veebileht on loodud õppetöö käigus ega sisalda mingit adekvaatset sisu</p>
  <hr>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil">
	</form>
</body>
</html>
  
</body>
</html>