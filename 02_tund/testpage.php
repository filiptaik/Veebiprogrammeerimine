<?php
	$userName = "Filip Taik";
	$fullTimeNow = date("d.m.Y H:i:s");
	$hourNow = date("H");
	$partOfDay = "hägune aeg";
	
	if($hourNow < 8){
		$partOfDay = "hommik";
	}
	
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
  <?php
  echo $userName;
  ?>
   on saatanast</title>
</head>
<body>
  <?php
  echo "<h1>" . $userName . " ei salli neid haigeid putukaid" . "</h1>";
  ?>
  <p>see veebileht on loodud õppetöö käigus ega sisalda mingit adekvaatset sisu</p>
  <hr>
  <?php
  echo "<p>Lehe avamise hetkel oli aeg: " . $fullTimeNow . ", " . $partOfDay . ".</p>" ; 
  ?>
  <br>
  
</body>
</html>