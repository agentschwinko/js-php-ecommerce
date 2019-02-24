<?php

//Check if user is logged in
@session_start();
if(!isset($_SESSION['useremail']) || empty($_SESSION['useremail'])){
	header("Location:index.html");
	exit();
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Shop</title>
    <link rel="stylesheet" href="Style/style.css" type="text/css" />
    <script src="Script/script.js"></script>
</head>

<body>
    <header>
        <a href="index.html">
            <IMG class="displayed" src="Images/Lumberjack.png" alt="Store
         Logo" width="180" height="150" border="0" align="center"> </a>
    </header>
    <center>
		<div style='color:red;'><?=isset($_GET['msg'])?$_GET['msg']:''?></div>
        <div class='form-wrapper'>
		<form method='post' action='add_cart.php'>
            <div class='product-wrapper'>
                <h3>The Field Desk</h3> <img src='Images/desk.png' />
                <div class='p-detail'>
                    <h3 style='display:inline-block;width:50%'>$<span id='price1'>2500</span><h3>
					<input type='hidden' value='2500' name='price' /><input type='hidden' value='1' name='productId' /><input type='hidden' value='The Field Desk' name='productName' />
				<div style='display:inline-block;width:50%'><input type='number' id='q1' class='fm' min='1' max='20' value='1' style='' name='quantity' /></div>
				<input type='submit' value='Add To Cart' class='btn add-product' data='2' />
			</div>
		</form>
		</div>
		<div class='product-wrapper'>
			<form method='post' action='add_cart.php'>
			<h3>The Jigata Japanese Axe</h3> <img src='Images/axe.png' />
            <div class='p-detail'>
                <h3 style='display:inline-block;width:50%'>$<span id='price2'>1000</span><h3>
				<input type='hidden' value='1000' name='price' /><input type='hidden' value='2' name='productId' /><input type='hidden' value='The Jigata Japanese Axe' name='productName' />
				<div style='display:inline-block;width:50%'><input type='number' id='q2' class='fm' min='1' max='20' value='1' style='' name='quantity' /></div>
				<input type='submit' value='Add To Cart' class='btn add-product' data='2'  />
			</div>
			</form>
		</div>
	</div>

	<form method='post' action='checkout.php'>
	<div class='cart-wrapper'>
		<h2>CART</h2>
		<div style='width:400px;display:inline-block;border-top:1px solid #ccc;'>
			<h3 class='' style='padding-top:10px;display:inline-block;width:180px;font-size:16px;'>
				Select Delivery Method
			</h3>
                        <select id='delivery-type' class='form-control' style='display:inline-block;width:150px;' name='delivery'>
                            <option value='0'>Select</option>
                            <option value='4.99'>Standard Delivery</option>
                            <option value='19.99'>Express Delivery</option>
                        </select>
                    </div>
                    <div style='width:400px;display:inline-block;border-top:1px solid #ccc;'>
                        <h3 class='' style='display:inline-block;width:180px;font-size:20px;font-size:16px;'>
				Select Gift Wrap
			</h3>
                        <input type='checkbox' name='wrap' value='1' id='wrap-gift' class='form-control' style='display:inline-block;width:150px;position:relative;top:10px;' /> </div>
                    <div style='width:400px;display:inline-block;border-top:1px solid #ccc;'>
                        <h3 class='' style='display:inline-block;width:180px;font-size:16px;'>
				Insurance
			</h3>
                        <input type='checkbox' name='insure' value='1' id='insure' class='form-control' style='display:inline-block;width:150px;position:relative;top:10px;' /> </div>
                    <div style='width:400px;display:inline-block;border-top:1px solid #ccc;'>
                        <h3 class='' style='display:inline-block;width:180px;font-size:16px;'>
				Membership Reward
			</h3>
                        <input type='checkbox' name='reward' value='1' id='reward' class='form-control' style='display:inline-block;width:150px;position:relative;top:10px;' /> </div>
                    <a href=></button>
                        <div style='width:400px;display:inline-block;border-top:1px solid #ccc;'>
						<input type='reset' class='btn' id='reset-cart' style='width:100px;display:inline-block;background-color:orange;' value='Reset' />
						<input type='submit' class='btn' id='calculate-cart' style='width:110px;display:inline-block;' value='Checkout'></div>
                </div>
		</form>
    </center>
    </div>
    <div id='toast' class='toast'>This is toast</div>
    <div id='toast-success' class='toast' style='background-color:#000099;'>This is toast</div>
    <div id='checkout-box'>
        <br /> <span onclick='this.parentElement.style.display = "none";' style='float:right;cursor:pointer;'>&times;</span>
        <h3>CHECKOUT</h3>
        <div id='checkout-content'> </div> <a href='feedback.html' class='btn'>Give Us Feedback</a> </div>
</body>

</html>
