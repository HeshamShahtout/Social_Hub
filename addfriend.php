<?php
session_start();
$email=$_SESSION['email'];
$friend_id=$_POST['var-insert'];
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}

else{
	$query="select userid from users where email='$email'"; // get id of logged in user.
	$result=mysqli_query($connection,$query);
	$row=mysqli_fetch_array($result);
	$loggedin_user=$row['userid'];
//--------------------------------------------------------------------//
	// insert request in database.
	$insert_query="INSERT INTO friend_request (friendid,userid,accepted,pending) VALUES ('$friend_id','$loggedin_user',0,1)";
	if($connection->query($insert_query)){
		echo"done";
		header ("location:friendscreen.php?userid=$friend_id");
	}else{
		echo"failed"; 
	}
}
?>