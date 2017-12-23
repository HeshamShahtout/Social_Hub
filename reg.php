<?php
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$nickname=$_POST['Nname'];
if($nickname==null||$nickname==""){ /*3lshan y3ml el nick name lw fady be el first w last */
$nickname=$firstname.$lastname;
}
$phone=($_POST['phoneNo']);
$phoneArray=explode(",",$phone);//split 3la el comma 3lshan ykon m3aya kaza phone number
foreach($phoneArray as $element)	//loop 3lehom w atb3 
{
echo $element;
echo'<br>';
}
$email=$_POST['email'];
$password=$_POST['password'];
$birthdate=$_POST['Bdate'];
$gender=$_POST['Gender'];
$hometown=$_POST['hometown'];
$hash = md5($password);
echo "<br>";
//$martialstatus=$_POST['MartialStatus'];
$aboutme=$_POST['aboutMe'];
$ms = $_POST['MartialStatus'];
if(!isset($ms)){
	$ms = null;
}

/* $date = date('Y-m-d H:i:s');
$timestamp = date("m/d/Y", strtotime($date)); */

$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
else
 { 
$sql2="SELECT * FROM users where Email='".$email."'";
    $result2 =$connection->query($sql2);

   if($result2->num_rows>0)
	{
	  // echo"email already exists";
	   	$message = "error ! email already exists";
echo "<script type='text/javascript'>alert('$message')</script>";
echo "<META http-equiv=\"refresh\" content=\"0;URL=index.html\">";
   }
  
   else
   { 
	$sql="insert into users(Fname,Lname,NickName,PASSWORD,email,gender,birthdate,hometown,martialstatus,aboutme) 
	   values('$firstname','$lastname','$nickname','$hash','$email','$gender','$birthdate','$hometown','$ms','$aboutme')";
	   
	   if($connection->query($sql))
	{ 
     //echo "welcome ".$username;
          $sql3="select userid from users where email='$email'";
	  $result1 = mysqli_query($connection, $sql3); 
	  $row=mysqli_fetch_array($result1);
	  $id=$row['userid'];
foreach($phoneArray as $element)	//loop 3lehom w insert 
{
	$sql2="insert into phoneno(phone,userid) 
	   values('$element',$id)";
	   $result2=$connection->query($sql2);
}	
		  session_start();
	  $_SESSION['email']=$email;
	 // $_SESSION['userid']=$id;
	 header("Location:choosephoto.php");
	 //echo "done";	
	}
 
	else
	{
     echo "failed";
	}
   }
   
}

?>
