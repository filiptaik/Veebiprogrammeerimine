<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  require("function_message.php");
  $database = "if19_filip_ta_2";
  
  
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
  
  $notice = null;
  $myMessage = null;
  
  if(isset($_POST["submitMessage"])){
	$myMessage = test_input($_POST["message"]);
	if(!empty($myMessage)){
		$notice = storeMessage($myMessage);
	} else {
		$notice = "Tühja sõnumit ei salvestata";
	}
  }
  
  //$messagesHTML = readAllMessages();
  $messagesHTML = readMyMessages();
  
  require("header.php");
?>



  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> 
  <p>Tagasi <a href="home.php">avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu sõnum (256 märki)</label><br>
	  <textarea rows="5" cols="51" name="message" placeholder="Kirjuta siia oma sõnum ..."></textarea>
	  <br>
	  <input name="submitMessage" type="submit" value="Salvesta sõnum"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	<h2>Senised sõnumid:</h2>
	<?php
	echo $messagesHTML;
	?>
</body>
</html>