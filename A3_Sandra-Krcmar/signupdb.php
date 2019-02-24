<html>

<body>
    <?php

if($_SERVER['REQUEST_METHOD']=="POST")
{
	$User=$_POST['uname'];
	$Pass=$_POST['pwd'];
	$Fname=$_POST['fname'];
	$Lname=$_POST['lname'];
	$Email=$_POST['email'];
	$Phone=$_POST['phone'];
	$Addr=$_POST['addr'];
	$link=mysqli_connect("localhost","root","","shopcart");
	$result=mysqli_query($link,"select * from signup where username='".$User."'");
	if($rows=mysqli_num_rows($result)>0)
	{
		echo "<script>alert('User already registered');</script>";
		 header("location: signup1.html");
	}
	else
	{
		if(mysqli_query($link,"insert into signup
		(username,password,firstname,lastname,email,phone,addr)
		values('".$User."','".$Pass."','".$Fname."','".$Lname."','".
		$Email."',".$Phone.",'".$Addr."')"))
		{
			echo "<script>alert('User registered successfully');</script>";
			  header("location: shop.html");
		}
	}
    mysqli_close($link);
}
?>
</body>

</html>
