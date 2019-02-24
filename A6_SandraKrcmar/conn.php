<?php
$link = mysqli_connect('localhost', 'root', '', 'shopcart');
if(!$link){
	echo "Error connecting to db: ".mysqli_connect_error();
	exit();
}
?>
