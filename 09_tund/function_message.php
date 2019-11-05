<?php
function storeMessage($myMessage){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpmsg (userid, message) VALUES(?,?)"); // alati kui on küsimärgid, on vaja bindida
	echo $conn->error;
	$stmt -> bind_param("is", $_SESSION["userID"], $myMessage);
	if ($stmt->execute()){
		$notice= "Sõnum salvestati";
	} else {	
		$notice = "Sõnumi salvestamisel tekkis tõrge! " .$stmt->error;
	
	}
		
	
	
	$stmt -> close();
	$conn -> close();
	return $notice;
}

function readAllMessages() {
	$messagesHTML = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT message, created FROM vpmsg WHERE deleted is NULL");
	echo $conn->error;
	$stmt->bind_result($messageFromDb, $createdFromDb);
	$stmt->execute();
	while($stmt -> fetch()){
		$messagesHTML .= "<li>" .$messageFromDb ." Lisatud " .$createdFromDb ."</li> \n";
	}
	if(!empty($messagesHTML)){
		$messagesHTML = "<ul> \n" .$messagesHTML ."</ul> \n";
 	} else {
		$messagesHTML = "<p>Sõnumeid pole \n</p>";
	}
	
	
	$stmt -> close();
	$conn -> close();
	return $messagesHTML;
}
function readMyMessages() {
	$limit = 5; 
	$messagesHTML = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT message, created FROM vpmsg WHERE userid = ? AND deleted is NULL ORDER BY created DESC LIMIT ?");
	echo $conn->error;
	$stmt ->bind_param("ii", $_SESSION["userID"], $limit);   // bindin userID selle küsimärgiga mis userid ees on
	$stmt->bind_result($messageFromDb, $createdFromDb);
	$stmt->execute();
	while($stmt -> fetch()){
		$messagesHTML .= "<li>" .$messageFromDb ." Lisatud " .$createdFromDb ."</li> \n";
	}
	if(!empty($messagesHTML)){
		$messagesHTML = "<ul> \n" .$messagesHTML ."</ul> \n";
 	} else {
		$messagesHTML = "<p>Sõnumeid pole \n</p>";
	}
	
	
	$stmt -> close();
	$conn -> close();
	return $messagesHTML;
}