<?php
 require("functions_user.php");
	$database = "if19_filip_ta_2";
	$mydescription = null;
	$mytxtcolor = "#000000";
	$mybgcolor = "#FFFFFF";
	$notice = null;

	//kui pole sisseloginud
  if(!isset($_SESSION["userID"])){
	  //siis jõuga sisselogimise lehele
	 header("Location: testpage.php");
	  exit();
  }

  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: testpage.php");
	  exit();
  }

   $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
	
	//veateated
	
	$mydescriptionError = null;
	//kui on nuppu vajutatud!
	if (isset($_POST["submitProfile"])){
		$notice = storeProfile($_POST["description"], $_POST["bgcolor"], $_POST["txtcolor"]);
		if(!empty($_POST["description"])){
	  	$myDescription = $_POST["description"];
		}
		$_SESSION["mytxtcolor"] = $_POST["txtcolor"];
 			 } else {
				$myProfileDesc = showMyDesc();
					if(!empty($myProfileDesc)){
	  					$myDescription = $myProfileDesc;
    }
  
	
		
		
}// nupp vajutatud

require ("header.php")

?>


<body>
  <p>see veebileht on loodud õppetöö käigus ega sisalda mingit adekvaatset sisu</p>
  <hr>

  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>

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
