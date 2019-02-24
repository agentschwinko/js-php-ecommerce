<?php
$price = array('small'=>2, 'med'=>2.25, 'lrg'=>2.5, 'xlrg'=>2.75);

//validate number of coffee
if(!isset($_POST['numcoff']) || empty($_POST['numcoff']) || !preg_match('/^[0-9]{1,11}$/', $_POST['numcoff'])){
	echo "Please set a valid number of coffee";
	exit();
}

//validate size
if(!isset($_POST['size']) || empty($_POST['size']) || ($_POST['size'] !== 'small' && $_POST['size'] !== 'med' && $_POST['size'] !== 'lrg' && $_POST['size'] !== 'xlrg')){
	echo "Please select a valid size";
	exit();
}
//calculate total price
$cost = $price[$_POST['size']] * $_POST['numcoff'];
$tax = ((13/100)*$cost);
$total = $cost + $tax;

//validate cream input
$creams = 0;
if(!isset($_POST['numcream']) || empty($_POST['numcream'])){
	$creams = 0;
}
else if(preg_match('/^[0-9]{1,11}$/', $_POST['numcream'])){
	$creams = $_POST['numcream'];
}
else{
	echo "Please set a valid number of creams";
	exit();
}

//validate sugar input
if(!isset($_POST['numsugar']) || empty($_POST['numsugar'])){
	$sugars = 0;
}
else if(preg_match('/^[0-9]{1,11}$/', $_POST['numsugar'])){
	$sugars = $_POST['numsugar'];
}
else{
	echo "Please set a valid number of sugars";
	exit();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title></title>
    <link rel="stylesheet" href="Style/style.css" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,700" media="all" /> </head>

<body>
    <header>
        <div class="container">

            <h1><a href="/" class="cc-active">Tim<strong>Hortons</strong></a></h1> </div>
    </header>
	<?php
	for($i = 0; $i < $_POST['numcoff']; $i++){
	?>
	<div class='coffee-div'>
		<img src='Images/cup.jpg' class='<?=$_POST['size']?>' />
		<?php
		for($j = 0; $j < $creams; $j++){
		?>
		<img src='Images/plus.jpg' class='small' />
		<img src='Images/cream.jpg' class='small' />
		<?php
		}
		?>
		<?php
		for($j = 0; $j < $sugars; $j++){
		?>
		<img src='Images/plus.jpg' class='small' />
		<img src='Images/sugar.jpg' class='small' />
		<?php
		}
		?>
	</div>
	<?php
	}
	?>
	<div class='cost-div'>
	Cost: $<?=$cost?> + tax = $<?=round($total,2)?>
	</div>

</body>
</html>



