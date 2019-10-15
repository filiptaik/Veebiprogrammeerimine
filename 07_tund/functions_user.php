<?php
//võtan kasutusele sessiooni
	require("../../../config_vp2019.php");
	$database = "if19_filip_ta_2";
	
	session_start();
	//var_dump($_SESSION);



	function signUp($name, $surName, $email, $gender, $birthDate, $password){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
	echo $conn->error;
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	$stmt->bind_param("sssiss", $name, $surName, $birthDate, $gender, $email, $pwdhash);
	if($stmt->execute()){
		$notice = "Kasutaja loomine õnnestus";
	} else {
			$notice = "Kasutaja loomisel tekkis tehniline viga: " .$stmt->error;
	}
	
	$stmt -> close();
	$conn -> close();
	return $notice;
}
 function signIn($email, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT password FROM vpusers WHERE email=?");
	echo $mysqli->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($passwordFromDb);
	if($stmt->execute()){
		//kui päring õnnestus
	  if($stmt->fetch()){
		//kasutaja on olemas
		if(password_verify($password, $passwordFromDb)){
		  //kui salasõna klapib
		  $stmt->close();
		  $stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM vpusers WHERE email=?");
		  echo $mysqli->error;
		  $stmt->bind_param("s", $email);
		  $stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb);
		  $stmt->execute();
		  $stmt->fetch();
		  $notice = "Sisse logis " .$firstnameFromDb ." " .$lastnameFromDb ."!";
		  	
		//annan sessiooni muutujatele väärtused
			$_SESSION["userFirstname"] = $firstnameFromDb;
			$_SESSION["userLastname"] = $lastnameFromDb;
			$_SESSION["userID"] = $idFromDb;

			  //loeme kasutajaprofiili
		  $stmt->close();
		  $stmt = $mysqli->prepare("SELECT bgcolor, txtcolor FROM vpuserprofiles WHERE userid=?");
		  echo $mysqli->error;
		  $stmt->bind_param("i", $_SESSION["userID"]);
		  $stmt->bind_result($bgColorFromDb, $txtColorFromDb);
		  $stmt->execute();
		  if($stmt->fetch()){
			$_SESSION["bgColor"] = $bgColorFromDb;
	        $_SESSION["txtColor"] = $txtColorFromDb;
		  } else {
		    $_SESSION["bgColor"] = "#FFFFFF";
	        $_SESSION["txtColor"] = "#000000";
		  }
		  


			
		//kuna siirdume teisele lehele, sulgeme andmebaasi ühendused
			$stmt->close();
			$mysqli->close();	  
		//siirdume teisele lehele
			header("Location: home.php");
		//katkestame edasise tegevuse siin	
			exit();
		
		
		} else {
		  $notice = "Vale salasõna!";
		}
	  } else {
		$notice = "Sellist kasutajat (" .$email .") ei leitud!";  
	  }
	} else {
	  $notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
	}
	
	$stmt->close();
	$mysqli->close();
	return $notice;
  }//sisselogimine lõppeb
  
  
  function storeProfile($mydescription, $mybgcolor, $mytxtcolor){
  	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT id FROM vpuserprofiles WHERE userid=?");
	echo $conn->error;
	$stmt->bind_param("i", $_SESSION["userID"]);
	$stmt->bind_result($idFromDb);
	$stmt->execute();
	if($stmt->fetch()){
		//profiil juba olemas, uuendame
		$stmt->close();
		$stmt = $conn->prepare("UPDATE vpuserprofiles SET description = ?, bgcolor = ?, txtcolor = ? WHERE userid= ?");
		echo $conn->error;
		$stmt->bind_param("sssi", $mydescription, $mybgcolor, $mytxtcolor, $_SESSION["userID"]);
		if($stmt->execute()){
			$notice = "Profiil uuendatud";
			$_SESSION["bgColor"] = $mybgcolor;
	        $_SESSION["txtColor"] = $mytxtcolor;
		} else {
			$notice = "Profiili uuendamisel tekkis tõrge! ";
		}
	} else {
		//profiili pole, salvestame
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor) VALUES(?,?,?,?)");
		echo $conn->error;
		$stmt->bind_param("isss", $_SESSION["userID"], $description, $mybgolor, $mytxtcolor);
		if($stmt->execute()){
			$notice = "Profiil edukalt salvestatud!";
		} else {
			$notice = "Profiili salvestamisel tekkis tõrge! " .$stmt->error;
		}
	}
	$stmt->close();
	$conn->close();
	return $notice;
  }
  
   function showMyDesc(){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT description FROM vpuserprofiles WHERE userid=?");
	echo $conn->error;
	$stmt->bind_param("i", $_SESSION["userId"]);
	$stmt->bind_result($descriptionFromDb);
	$stmt->execute();
    if($stmt->fetch()){
	  $notice = $descriptionFromDb;
	}
	$stmt->close();
	$conn->close();
	return $notice;
  }
	
	  
	  
	  
	  
 //funktsiooni lõpp