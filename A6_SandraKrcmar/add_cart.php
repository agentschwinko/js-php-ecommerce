<?php

@session_start();
if(!isset($_SESSION['useremail']) || empty($_SESSION['useremail'])){
	header("Location:index.php");
	exit();
}
if(!isset($_POST['productId']) || empty($_POST['productId']) || !preg_match('/^[0-9]{1,10}$/', $_POST['productId'])){
	echo 'Invalid product id given';
	exit();
}

if(!isset($_POST['productName']) || empty($_POST['productName'])){
	echo 'Invalid product name given';
	exit();
}

if(!isset($_POST['price']) || empty($_POST['price']) || !preg_match('/^[0-9.]{1,10}$/', $_POST['price'])){
	echo 'Invalid product price given';
	exit();
}

if(!isset($_POST['quantity']) || empty($_POST['quantity']) || !preg_match('/^[0-9]{1,10}$/', $_POST['quantity'])){
	echo 'Invalid product quantity given';
	exit();
}

require 'conn.php';

$sql = 'select useremail from cart where useremail = ? and productname = ?';
if($stm = $link->prepare($sql)){
	$stm->bind_param('ss', $_SESSION['useremail'], $_POST['productName']);
	$stm->bind_result($email);
	$stm->execute();
	$stm->fetch();

	$stm->close();
}
else{
	echo 'Error checking cart item: '.mysqli_error($link);
	exit();
}


if(empty($email)){
		$sq = "INSERT INTO cart SET useremail = ?, productid = ?, orderqty = ?, orderprice = ?, productname = ?";
		if($st = $link->prepare($sq)){
			$price = $_POST['price'] * $_POST['quantity'];
			$st->bind_param('siiss', $_SESSION['useremail'], $_POST['productId'], $_POST['quantity'], $price, $_POST['productName']);
			$st->execute();
		}
		else{
			echo 'Error inserting cart item: '.mysqli_error($link);
			exit();
		}
	}
	else{
		$sql = "UPDATE cart SET orderqty = ?, orderprice = ? WHERE  useremail = ? AND productname = ?";
		if($stmt = $link->prepare($sql)){
			$price = $_POST['price'] * $_POST['quantity'];
			$stmt->bind_param('isss', $_POST['quantity'], $price, $_SESSION['useremail'], $_POST['productName']);
			$stmt->execute();
		}
		else{
			echo 'Error updating cart item: '.mysqli_error($link);
			exit();
		}
	}

$link->close();
header("Location:shop.php?msg=cart updated!!");
?>
