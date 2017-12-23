<?php
$email=$_POST['email'];
$password=$_POST['LoginPassword'];
$hashPassword=md5($password);
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
else{
$sql ="SELECT * FROM users where email='".$email."'";

  $result =$connection->query($sql);
    
   if($result->num_rows >0 )
   {
	
	$sql2 ="SELECT Password FROM users where email='".$email."'";
	
	$result2 =$connection->query($sql2);
	if($row = mysqli_fetch_assoc($result2))
	{
		if($hashPassword==($row['Password'])){
		session_start();
		$_SESSION['email']=$email;
	 header("Location:profilescreen.php");
		}
		else{
				$message = "wrong password ";
echo "<script type='text/javascript'>alert('$message')</script>";
echo "<META http-equiv=\"refresh\" content=\"0;URL=index.html\">";

		}
		
	}
	else{
			$message = "error occured";
echo "<script type='text/javascript'>alert('$message')</script>";
echo "<META http-equiv=\"refresh\" content=\"0;URL=index.html\">";
	}
   }else{
	   	$message = "wrong email  ! user not found user";
echo "<script type='text/javascript'>alert('$message')</script>";
echo "<META http-equiv=\"refresh\" content=\"0;URL=index.html\">";
   }
 
}   


?>
