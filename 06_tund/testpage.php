<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
	$database = "if19_filip_ta_2";
	
    $notice = "";
    $email = "";
    $emailError = "";
    $passwordError = "";
	$userName = "Filip Taik";
	$notice = "";
    $email = "";
    $emailError = "";
    $passwordError = "";
	
	$photoDir = "../Photos/";
	$photoTypes = ["image/jpeg", "image/png"];
	
	$fullTimeNow = date("d.m.Y H:i:s");
	$hourNow = date("H");
	$partOfDay = "hägune aeg";
	
	if($hourNow < 8){
		$partOfDay = "hommik";
	}
	
	//info semestri kulgemise kohta
	$semesterStart = new DateTime ("2019-9-2");
	$semesterEnd = new DateTime ("2019-12-13");
	$semesterDuration = $semesterStart -> diff ($semesterEnd);
	$today = new DateTime ("now");
	$semesterElapsed = $semesterStart -> diff ($today);
	//echo $semesterStart;
	//var_dump($semesterStart);
	//var_dump($semesterDuration);
	 //<p>semester on täies hoos:
  	//<meter min="0" max="112" value="16">13%</meter>
  //</p>
  $semesterInfoHTML = null;
  if($semesterElapsed -> format("%r%a") >= 0) {
	$semesterInfoHTML = "<p>semester on täies hoos:";
	$semesterInfoHTML .=  '<meter min="0" max="' .$semesterDuration -> format("%r%a") .'" ';
	$semesterInfoHTML .= 'value="' .$semesterElapsed -> format("%r%a") . '">' ;
	$semesterInfoHTML .= round($semesterElapsed -> format("%r%a") /  $semesterDuration -> format("%r%a") * 100, 1) . "%" ;
	$semesterInfoHTML .= "</meter></p>";
  }
  
  //foto näitamine lehel
  $fileList = array_slice(scandir($photoDir), 2);
  //var_dump($fileList);
  $photoList = [];
  
  foreach ($fileList as $file){
  $fileInfo = getImagesize($photoDir .$file);
	  //var_dump($fileInfo);                               mingi jama!
	  if (in_array($fileInfo["mime"], $photoTypes));{
	  array_push($photoList, $file);
	  }
  }
  
  $photoList = ["tlu_terra_600x400_1.jpg", "tlu_terra_600x400_2.jpg", "tlu_terra_600x400_3.jpg"]; //array ehk massiiv 
  //var_dump($photoList); mõitad, et progemises alustatakse nullist, seepärast ei saa järgmises stringis kasutada numbrit 3, kuna pole 4ja pilti
  $photoCount = count($photoList);
  //echo $photoCount;
  $photoNum = mt_rand(0, $photoCount -1);
  echo $photoList[$photoNum];
  //<img src="../Photos/tlu_terra_600x400_1.jpg" alt="TLU Terra õppehoone">
  $randomImgHTML = '<img src="' .$photoDir .$photoList[$photoNum] .'" alt="Juhuslik foto">';
  
  
	require("header.php");

  echo "<h1>" . $userName . " ei salli neid haigeid putukaid" . "</h1>";
  ?>
  <p>see veebileht on loodud õppetöö käigus ega sisalda mingit adekvaatset sisu</p>
  <hr>
<?php
 echo $semesterInfoHTML ;
?>
  <hr>
  <?php
  echo "<p>Lehe avamise hetkel oli aeg: " . $fullTimeNow . ", " . $partOfDay . ".</p>" ; 
  echo $randomImgHTML;
 ?>
  <br>
  <br>
   <?php
  if(isset($_POST["submitUserData"])){
  if(isset($_POST["username"]) and !empty($_POST["username"])){
    $email = $_POST["username"];
  } else {
    $emailError = "Palun sisestage enda kasutajatunnus!";
  }
  if(empty($_POST["password"])){
    $passwordError = "Palun sisestage parool!";
  }
  if(empty($passwordError) and empty($emailError)){
    $notice = signIn($email, $_POST["password"]);
    $email = null;
  }
}
?>
 <form method = "POST" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
  <label>E-mail(kasutajatunnus): </label><br>
  <input type="email" name="username" value="<?php echo $email;?>"> <?php echo $emailError;?>
  <br>
  <label>Parool: </label><br>
  <input type="password" name="password"><?php echo $passwordError;?><br>
  <br>
  <input type="submit" name="submitUserData" value="Logi sisse"><?php echo $notice;?>
</form>
<br>
<h2>Kui pole kasutajakontot</h2>
<p>Loo <a href="newuser.php">kasutajakonto</a></p>
</body>
</html>
  
</body>
</html>