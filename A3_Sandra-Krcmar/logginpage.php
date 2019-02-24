<html>
<body>
<?php

if($_SERVER['REQUEST_METHOD']=="POST")
{
	$User=$_POST['uname'];
	$Pass=$_POST['psw'];

	$link=mysqli_connect("localhost","root","","shopcart");
//    echo "ll";
    	$result=mysqli_query($link,
	"select * from signup where username='".$User."' and password='".$Pass."'");
	if(($rows=mysqli_num_rows($result))>0)
	{
		echo "<script>alert('Welcome');</script>";
		echo header("location: shop.html");

	}
	else
	{
		echo "<script>alert('Not authorised');</script>";
        echo header("location: signup1.html");

	}



    mysqli_close($link);
}
?>

    </body>

</html>



