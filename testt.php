<?php 
session_start();
$email=$_SESSION['email'];
//$temp="";
// $date = date('Y-m-d H:i:s');
// $timestamp = date("m/d/Y", strtotime($date)); 
if(isset($_POST['button'])){
$temp=$_POST['area'];
echo $temp;
$isPublic=$_POST['isPublic'];//da 3lshan a3ml hwa public wla private
}
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
else{
//-------------------------------------------------------------------------------------------------------------------------------------------------//
 // $sql_test="select * from users WHERE email='$email'";		//query 3lshan ykon m3aya variables		
	 // $result_test = mysqli_query($connection, $sql_test); 
	  // $row=mysqli_fetch_array($result_test);
	  // $id_test=$row['userid'];
	  // $_SESSION['userid']=$id_test;
 //--------------------------------------------------------------------------------------------------------------------------------------------------//
	if(isset($_POST['button'])){//hna isset 3lshan my3mlsh insert le post fady kol ma bad5ol 3la el page. 
	if(($_POST['area']=="")||($_POST['area']==NULL)&&(empty($_FILES['image']['tmp_name']))){
		  echo '<script>alert("empty caption ! please insert caption ")</script>'; 
	}
	else{
	 $sql1="select userid,fname,lname from users WHERE email='$email'";				//insert new posts into database.
	 $result1 = mysqli_query($connection, $sql1); 
	  $row=mysqli_fetch_array($result1);
	//echo$userid['userid'];
	$id=$row['userid'];
	//$_SESSION['userid']=$id;
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
	//$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); 
	  $sql1="insert into posts (caption,userid,postedTime,IsPublic,postername) values ('$temp',$id,NOW(),'$isPublic','$postername')";
	    $result1 = mysqli_query($connection, $sql1); 
	}else{
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); 
	   $sql1="insert into posts (caption,userid,postedTime,IsPublic,image,postername) values ('$temp',$id,NOW(),'$isPublic','$image','$postername')";
	    $result1 = mysqli_query($connection, $sql1); 
	}
	}
}
//--------------------------------------------------------------------------------------------------------------------------------------------//	
				$query = "SELECT NickName FROM users where email='$email'";  			//display nick name
                $result = mysqli_query($connection, $query); 
				$name = mysqli_fetch_array($result);		
				echo$name['NickName'];		
				echo'<br>';			

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
							<form method="POST" action="search.php" >
				<input id="search" name="search" type="text"> 
				<br>
				<input type="submit" value="search button" name="search_button" id="search_button" class="btn btn-info">
					 <select name="search_choice" id="search_choice">
  <option value="names" >names</option>
  <option value="email" >email</option>
   <option value="caption" >caption</option>
</select>
				</form>
                <form method="POST" action="homescreen.php" enctype="multipart/form-data">  
				<input type="file" name="image" id="image" />  
                     <input type="submit" name="button" id="button" value="post button" class="btn btn-info" />  
					 <textarea name="area" id="area"cols="40" rows="4" placeholder="Say Something  ..."></textarea>
					 <select name="isPublic" id="isPublic">
					<!-- <option value="default" ></option>-->
  <option value="PUBLIC" >PUBLIC</option>
  <option value="PRIVATE" >PRIVATE</option>
</select>
                </form>  
                <br />  
<!----------------------------------------------------------------------------------------------------------------------------------------->
				
<!----------------------------------------------------------------------------------------------------------------------------------------->				
				  <?php
				 //hna bageb el id bta3 el logged in user 3lshan m3mlsh echo lel posts el 3ndo 3la el profile
				  $query="select userid from users where email='$email'";
				  $result_query=mysqli_query($connection,$query);
				  $row_query=mysqli_fetch_array($result_query);
				  $user_id=$row_query['userid'];
			//-----------------------------------------------------------------------------	
				  //display posts --> home
			 // $sql="select caption,image,postername from posts where userid<>'$user_id' order by postedTime DESC";
			  // $result=$connection->query($sql);
			  // while($row=mysqli_fetch_assoc($result)){
						// echo$row['postername'];
					// echo'<br>';
					// echo'<table>';
					// echo'<td>';
					// echo $row['caption'];
					// echo'<td>';
					// echo'</table>';
					// echo'<br>';
					// if($row['image']!=NULL){
						// echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-thumnail"   '; 
						// echo'<br>';
						// echo'<br>';
					// }
			 // }
				 ?>
         
<br>
<br>
<?php

                  $query="select * from posts where userid<>'$user_id' or poster_id<>'$user_id' order by postedTime DESC";	// hna bageb kol el posts w b3d kda bmshi 3la post post ngeb el poster id bta3o w b3d kda bashof hwa friend wla la-
																								// lw friend btl3 el private w el public bs lw friend btl3 el public bs 
				  $result_query=mysqli_query($connection,$query);
				  while($row_query=mysqli_fetch_array($result_query)){
					  $friend_id=$row_query['poster_id'];
					  $check="select * from friend_request where userid='$user_id' and friendid='$friend_id' and accepted=1 or userid='$friend_id' and friendid='$user_id'";
					  $check_result=mysqli_query($connection,$check);
					  if($check_result->num_rows>0){
						echo$row_query['posterName'];
					echo'<br>';
					echo'<table>';
					echo'<td>';
					echo $row_query['caption'];
					echo'<td>';
					echo'</table>';
					echo'<br>';
					if($row_query['image']!=NULL){
						echo '<img src="data:image/jpeg;base64,'.base64_encode($row_query['image'] ).'" height="200" width="200" class="img-thumnail"   '; 
						echo'<br>';
						echo'<br>';
					}
					  }else{
						  if(strcmp($row_query['IsPublic'],"PUBLIC")==0){
					echo$row_query['posterName'];
					echo'<br>';
					echo'<table>';
					echo'<td>';
					echo $row_query['caption'];
					echo'<td>';
					echo'</table>';
					echo'<br>';
					if($row_query['image']!=NULL){
						echo '<img src="data:image/jpeg;base64,'.base64_encode($row_query['image'] ).'" height="200" width="200" class="img-thumnail"   '; 
						echo'<br>';
						echo'<br>';
					}
						  }
						  
					  }
				  }
				  

?>
           </div>
		   
    <p> profile ? <a href="profilescreen.php"> profile <a/></p>
			 <p> logout ? <a href="logout.php"> logout <a/></p>		   
      </body>  
 </html>  