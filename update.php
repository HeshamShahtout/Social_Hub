<?php
session_start();
$email=$_SESSION['email'];

$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
else{


$firstname=$_POST['fname'];
//echo "welcome ".$firstname;
if($firstname!=""&&$firstname!=null)
{$sql = "UPDATE users SET Fname='$firstname' WHERE email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
}
}



$lastname=$_POST['lname'];
if($lastname!=""&&$lastname!=null){
$sql = "UPDATE users SET Lname='$lastname' where Email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }
}


$nickname=$_POST['Nname'];
if($nickname!=""&&$nickname!=null){
$sql = "UPDATE users SET NickName='$nickname' where Email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }
	  }


$emailupdated=$_POST['email'];
if($emailupdated!=""&&$emailupdated!=null){
$sql = "UPDATE users SET Email='$emailupdated' where Email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }}


	
$password=$_POST['password'];
if($password!=""&&$password!=null){
	$hashed=md5($password);
	echo $password;
	echo $email;
	echo $hashed;
$sql2 = "UPDATE users SET PASSWORD='$hashed' where Email='".$email."'";
 if($connection->query($sql2))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }
}


$birthdate=$_POST['Bdate'];
if($birthdate!=""&&$birthdate!=null){
$sql = "UPDATE users SET birthdate='$birthdate' where Email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }}


	

//if($gender!=""&&$gender!=null){
	if(isset($_POST['Gender'])){
$gender=$_POST['Gender'];
$sql = "UPDATE users SET Gender='$gender' where Email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }
}


$hometown=$_POST['hometown'];
if($hometown!=""&&$hometown!=null){
$sql = "UPDATE users SET hometown='$hometown' where Email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }}


$aboutme=$_POST['aboutMe'];
if($aboutme!=""&&$aboutme!=null){
$sql = "UPDATE users SET aboutme='$aboutme' where Email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }}


	//$martialstatus=$_POST['MartialStatus'];
	//if($martialstatus!=""&&$martialstatus!=null){
		if(isset($_POST['MaritalStatus'])){
			$martialstatus=$_POST['MaritalStatus'];
	$sql = "UPDATE users SET martialstatus='$martialstatus' where Email='".$email."'";
 if($connection->query($sql))  
      {  
           echo '<script>	alert(" Inserted into Database")</script>'; 	   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }
            
}
}

header("Location:profilescreen.php");

?>
