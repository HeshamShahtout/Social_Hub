<?php 
session_start();
$email=$_SESSION['email'];
//$id2=$_GET['userid'];
//echo$id2;
//$temp="";
// $date = date('Y-m-d H:i:s');
// $timestamp = date("m/d/Y", strtotime($date)); 
if(isset($_POST['button'])){
$temp=$_POST['area'];
echo $temp;
echo'<br>';
$isPublic=$_POST['isPublic'];//da 3lshan a3ml hwa public wla private
}
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
else{
	if(isset($_POST['button'])){//hna isset 3lshan my3mlsh insert le post fady kol ma bad5ol 3la el page. 
	 $sql1="select userid,fname,lname from users WHERE email='$email'";				//insert new posts into database.
	 $result1 = mysqli_query($connection, $sql1); 
	  $row=mysqli_fetch_array($result1);
	//echo$userid['userid'];
	$id=$row['userid'];
	$fname=$row['fname'];
	$lname=$row['lname'];
	$postername=$fname." ".$lname;
	echo$postername;
	echo'<br>';
	   // $sql="insert into posts (caption,userid,postedTime,IsPublic,postername) values ('$temp',$id,NOW(),'$isPublic','$postername')";	//now de btgbli time w el date now
	// $result = mysqli_query($connection, $sql); 
	   // $result2 =$connection->query($sql);
	//echo$_FILES['image']['tmp_name'];// hna lma b3ml upload le sora by7otha fe folder tmp fe el xamp folder in c
//--------------------------------------------------------------------------------------------------------------------------//	
	//post an image
	 
	if(empty($_FILES['image']['tmp_name'])){ //empty de bt3ml check whether fe sora et3mlha browse wla la
	  $sql1="insert into posts (caption,userid,postedTime,IsPublic,postername) values ('$temp',$id,NOW(),'$isPublic','$postername')";
	    $result1 = mysqli_query($connection, $sql1); 
	}else{
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); 
	   $sql1="insert into posts (caption,userid,postedTime,IsPublic,image,postername) values ('$temp',$id,NOW(),'$isPublic','$image','$postername')";
	    $result1 = mysqli_query($connection, $sql1); 
	}
}
//--------------------------------------------------------------------------------------------------------------------------------------------//	
				$query = "SELECT NickName FROM users where email='$email'";  			//display nick name
                $result = mysqli_query($connection, $query); 
				$name = mysqli_fetch_array($result);		
				echo$name['NickName'];		
				echo'<br>';
//---------------------------------------------------------------------------------------------------------------------------------------------//				
$sql = "select profilepic from users where email='$email'";				//display profile picture
// the result of the query
$result = mysqli_query($connection, $sql); 
// there should only be 1 result (if img_id = the primary index)
$pic = mysqli_fetch_array($result);
// if($pic['profilepic']==null||$pic['profilepic']==""){
	// echo '    <img src="data:image/jpeg;base64,'.base64_encode('D\:7th term\database\default-image-man.jpg' ).'" height="200" width="200" class="img-thumnail"   '; 

// }
// show the image
//echo "<img src='picture/".$pic['profilepic']."' width='300' height='300'/>";
echo '    <img src="data:image/jpeg;base64,'.base64_encode($pic['profilepic'] ).'" height="200" width="200" class="img-thumnail"   '; 

//-------------------------------------------------------------------------------------------------------------------------------------------//
}

?>

 <!DOCTYPE html>  
 <html>  
      <head>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:500px;">  
                <h3 align="center"> write post </h3>  
                <br />  
                <form method="POST" action="profilescreen.php" enctype="multipart/form-data">  
				<input type="file" name="image" id="image" /> 
                     <input type="submit" name="button" id="button" value="post caption" class="btn btn-info" /> 
				<!--	<input type="submit" name="button_image" id="button_image" value="post photo" class="btn btn-info" /> -->					 
					 <textarea name="area" id="area"cols="40" rows="4" placeholder="Say Something  ..."></textarea>
					 <select name="isPublic" id="isPublic">
					<!-- <option value="default" ></option>-->
			<option value="PUBLIC" >PUBLIC</option>
  <option value="PRIVATE" >PRIVATE</option>
</select>
				 
       
                </form>  
                <br />  
				 <?php
				$sql="select userid from users where email='$email'";  //display posts
			    $result=$connection->query($sql);
			    if($row=mysqli_fetch_assoc($result)){
				 $id=$row['userid'];
				   $query = "SELECT caption,postername,image FROM posts where userid=$id";  
                   $result2=$connection->query($query);
				  while($row2=mysqli_fetch_assoc($result2)){
					echo$row2['postername'];
					echo'<br>';
					echo $row2['caption'];
					echo'<br>';
					if($row2['image']!=NULL){
						echo '<img src="data:image/jpeg;base64,'.base64_encode($row2['image'] ).'" height="200" width="200" class="img-thumnail"   '; 
						echo'<br>';
						echo'<br>';
					}
				 }
			 }
				 ?>
             
<br>

<p> home ? <a href="homescreen.php"> home <a/></p>

<p> logout ? <a href="logout.php"> logout <a/></p>
           </div>  
      </body>  
 </html>  