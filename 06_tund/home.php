<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
	$database = "if19_filip_ta_2";
	
	//kontrollime kas on sisse logitud
	if(!isset($_SESSION["userId"])){
		header("Location: testpage.php");
		exit();
	}
	
	//logime välja	
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: testpage.php");
		exit();
	}
	
	$userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
	
	require("header.php");

  echo "<h1>" . $userName . " ei salli neid haigeid putukaid" . "</h1>";
  ?>
  <p>see veebileht on loodud õppetöö käigus ega sisalda mingit adekvaatset sisu</p>
  <hr>

	<p><?php echo $userName; ?> | Logi <a href="?logout=1">välja!</a></p>
 
  <br>
  <p>Loo <a href="profiil.php">profiil!</a></p>
   

   <!--<img src="../Photos/tlu_terra_600x400_1.jpg" alt="TLU Terra õppehoone">-->
 <!-- Pildi kõrvuti panemine!!!!<div class="column">
	<img src="../Photos/tlu_terra_600x400_2.jpg" alt="TLU Terra õppehoone 2">
	</div>-->
  
</body>
</html>