<?php

if(!isset($_POST['name']) || empty($_POST['name'])){
	echo "Please supply your name";
	exit();
}
if(!isset($_POST['phone']) || empty($_POST['phone'])){
	echo "Please supply your phone number";
	exit();
}

if(!isset($_POST['feedback']) || empty($_POST['feedback'])){
	echo "Please supply your feedback for us";
	exit();
}

require 'conn.php';

$sql = "INSERT INTO feedback SET username = ?, phone = ?, message = ?";
if($stm = $link->prepare($sql)){
	$stm->bind_param('sss', $_POST['name'], $_POST['phone'], $_POST['feedback']);
	$stm->execute();
	$stm->close();
}
else{
	echo "Error inserting feedback: ".mysqli_error($link);
}
$link->close();

header("Location:feedbackcopy.php?msg=Feedback recieved. Thanks.");

?>
