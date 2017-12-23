<?php 
session_start();
$email=$_SESSION['email'];
$flag=0;
if(isset($_GET['userid'])){
$id2=$_GET['userid'];
}
else{	//hidden variable to save userid.	
if(isset($_POST['button'])){
$id2=$_POST['var'];
}
}
if(isset($_POST['button'])){
$temp=$_POST['area'];
echo $temp;
echo'<br>';
}
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
else{
$query="select * from users where email='$email'";
$result_query=mysqli_query($connection,$query);   
$row_loggedin=mysqli_fetch_array($result_query);    
$loggedin_user=$row_loggedin['userid'];
if($loggedin_user==$id2){				// hna 3lshan lw ana 3mlt search 3la nfsi aroh 3la profile bta3y
		header("location:profilescreen.php");
}
    
if(isset($_POST['button'])){//hna isset 3lshan my3mlsh insert le post fady kol ma bad5ol 3la el page. 
	if(($_POST['area']==""||$_POST['area']==NULL)&&(empty($_FILES['image']['tmp_name']))){
		  echo '<script>	alert("empty caption ! please insert caption ")</script>'; 
	}else{
$sql1="select userid,fname,lname from users WHERE email='$email'";				//insert new posts into database.
$result1 = mysqli_query($connection, $sql1); 
$row=mysqli_fetch_array($result1);
$id=$row['userid'];
$fname=$row['fname'];
$lname=$row['lname'];  
$postername=$fname." ".$lname;
//--------------------------------------------------------------------------------------------------------------------------//	
//post an image
if(empty($_FILES['image']['tmp_name'])){ //empty de bt3ml check whether fe sora et3mlha browse wla la
$sql1="insert into posts (caption,userid,postedTime,postername,poster_id) values ('$temp',$id2,NOW(),'$postername','$loggedin_user')";
$result1 = mysqli_query($connection, $sql1); 
}else{
$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); 
 $sql1="insert into posts (caption,userid,postedTime,image,postername,poster_id) values ('$temp',$id2,NOW(),'$image','$postername','$loggedin_user')";
$result1 = mysqli_query($connection, $sql1); 
}
}
}
//--------------------------------------------------------------------------------------------------------------------------------------------//	
$query = "SELECT * FROM users where userid='$id2'";  			//display nick name
$result = mysqli_query($connection, $query); 
$name = mysqli_fetch_array($result);
$fname = $name['Fname'];
$lname = $name['Lname'];
$mail = $name['email'];
$gender = $name['gender'];
$bdate = $name['birthdate'];
$ht = $name['hometown'];
$mt = $name['martialstatus'];
$pp = $name['profilepic']; 
$nn = $name['NickName'];
$userid= $name['userid'];
$requests_counter = $_SESSION['counter'];  
//---------------------------------------------------------------------------------------------------------------------------------------------//				
//-------------------------------------------------------------------------------------------------------------------------------------------//
}
?>
<!DOCTYPE html>
<html>
<title>Social Hub
</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="cssd.css">
<!--<link rel="stylesheet" href="js/theme.css">-->
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link href="Emoji.css" rel="stylesheet">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="dist/emojione.picker.css" rel="stylesheet">
<script src="//code.jquery.com/jquery.min.js">


</script>
<script src="dist/emojione.picker.js">


</script>
<style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
        font-family: 'Roboto', sans-serif;
    }

</style>

<body class="w3-theme-l5">
    <!-- Navbar -->
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-theme-action w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()">
          <i class="fa fa-bars">
          </i>
        </a>
            <a href="homescreen.php" class="w3-bar-item w3-button w3-padding-large">
          <i class="fa fa-home w3-margin-right">
          </i>Social Hub
        </a>
            <a href="profilescreen.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white " title="Profile">
          <i class="fa fa-user">
          </i>
        </a>
            <a href="myfriends.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Friends">
 <i class="fa fa-users" aria-hidden="true"></i> 
        </a>
            <a href="myRequest.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Friends">
<i class="fa fa-user-plus" aria-hidden="true"></i>
          <span class="w3-badge w3-right w3-tiny w3-green"> <?php echo $requests_counter; ?>
            </span>
        </a>
            <div class="w3-bar-item w3-padding-large w3-right w3-hide-small w3-hide-medium ">
                <form method="POST" action="search.php">
                    <input id="search" name="search" type="text" placeholder="Search">
                    <button class="w3-btn w3-theme w3-small" type="submit" id="search button"> <i class="fa fa-search" aria-hidden="true"></i>  Search</button>
                    <select name="search_choice" id="search_choice" class=" w3-round w3-theme">
  <option value="names" >names</option>
  <option value="email" >email</option>
   <option value="caption" >caption</option>
</select>
                    <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-small w3-hover-white" title="My Account">Logout </a>
                </form>
            </div>
        </div>
    </div>
    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="homescreen.php" class="w3-bar-item w3-button w3-padding-large">Home
      </a>
        <a href="profilescreen.php" class="w3-bar-item w3-button w3-padding-large">Profile
      </a>
        <a href="myfriends.php" class="w3-bar-item w3-button w3-padding-large">Friends
      </a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile
      </a>
    </div>
    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
                <!-- Profile -->
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container">
                        <?php
echo '   <h4 class="w3-center">'.$fname.' '.$lname.'</h4>';
?>
                            <?php
if($pp==NULL||$pp==""){		// lw m5trsh sora y7ot sora default
if($gender=="male"){
$files = glob("pictures/*.*");
$num = $files[0];
echo '<p class="w3-center"><img src="'.$num.'"class="w3-circle" style="height:106px;width:106px"></p>'; 
}	
else if($gender=="female"){ 
$files = glob("pictures/*.*");
$num = $files[1];
echo '<p class="w3-center"><img src="'.$num.'"class="w3-circle" style="height:106px;width:106px"></p>'; 
}
}else{
$num = base64_encode($name['profilepic'] );          
echo '<p class="w3-center"><img src="data:image/jpeg;base64,'.$num.'"class="w3-circle" style="height:106px;width:106px"></p>';  
}

?>
                                <hr>
                                <?php 
echo '<p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> '.$mail.'</p>'
?>
                                <?php
if($gender == "male"){
echo '<p><i class="fa fa-mars fa-fw w3-margin-right w3-text-theme"></i> Male</p>';
}else{
echo '<p><i class="fa fa-venus fa-fw w3-margin-right w3-text-theme"></i> Female</p>'; 
}
?>
                                    <?php
echo '<p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> '.$bdate.'</p>';
?>
                                        <?php
echo ' <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> '.$ht.'</p>';
?>
                                            <?php
echo '<p><i class="fa fa-heart fa-fw w3-margin-right w3-text-theme"></i> '.$mt.'</p>'
?>
                                                <?php
   $friend_query="select friendid from friends where userid='$loggedin_user'";                      
   $friend_result=mysqli_query($connection,$friend_query);
   $friend_id=$id2;	
    $flag=0;
     while($friend_row=mysqli_fetch_array($friend_result)){	
      if($id2==$friend_row['friendid']){// if found as a friend flag=1 and break msh mhtag akml loop
								$flag=1;
								break;
							}  
     }
                         if($flag==1){
                          echo'<p>  FRIENDS </p>';   
                         }else{
                         $pending_query="select pending from friend_request where userid='$loggedin_user' and friendid='$friend_id'";
								$pending_result=mysqli_query($connection,$pending_query);
								$pending_row=mysqli_fetch_array($pending_result);
								if($pending_row['pending']==0){
								echo' <form method="POST" action="addfriend.php" enctype="multipart/form-data"> ';
								echo'<button type="submit" class="w3-button w3-theme" name="add_friend" id="add_friend">
                 <i class="fa fa-user-plus" aria-hidden="true"></i> 
                  </i>  Add Friend
                </button>';
							echo'	<input type="hidden" name="var-insert" value='.$id2.'> ';
								echo'<br><br></form>';
								}else{
							echo'<p> PENDING FRIEND REQUEST </p>';    
                         }
                         }

                        ?>


                    </div>
                </div>
                <br>
                <!-- Accordion -->
                <div class="w3-card w3-round">
                </div>
                <br>
                <!-- Interests -->
                <div class="w3-card w3-round w3-white w3-hide-small">
                </div>
                <br>
            </div>
            <!-- Middle Column -->
            <div class="w3-col m7">
                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding">
                                <form method="post" action="friendscreen.php?" enctype="multipart/form-data">
                                    <textarea contenteditable="true" class="w3-border w3-padding" name="area" id="area" placeholder="Say Something  ..."></textarea>
                                    <input type='hidden' name='var' value='<?php echo "$id2";?>' />
                                    <br>
                                    <button type="submit" class="w3-button w3-theme" name="button" id="button">
                      <i class="fa fa-pencil">
                      </i>  Post
                    </button>
                                    <input type="file" name="image" id="image" class="inputfile" hidden="hidden" />
                                    <label for="image" class="w3-btn  w3-theme" id="uis">
                      <i class="fa fa-picture-o" aria-hidden="true">
                      </i> Upload Image
                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
$query= "select * from friend_request where (userid='$id2' and friendid='$loggedin_user' and accepted=1) or (userid='$loggedin_user' and friendid='$id2' and accepted=1)";
$result_query=mysqli_query($connection,$query);
$row_query=mysqli_fetch_array($result_query);
$user_id=$row_query['userid'];
//-----------------------------------------------------------------------------------------------------//
$query2 = "SELECT * FROM posts where userid='$id2' order by postedTime DESC";
$result_query2=mysqli_query($connection,$query2);               
while($row_query2=mysqli_fetch_array($result_query2)){
$friend_id=$row_query2['poster_id'];
$check="select * from friend_request where (userid='$id2' and friendid='$loggedin_user' and accepted=1) or (userid='$loggedin_user' and friendid='$id2' and accepted=1)";
$check_result=mysqli_query($connection,$check);
if($check_result->num_rows>0){
  $content = $row_query2['caption']; 
  $postername = $row_query2['posterName'];
    $time = $row_query2['postedTime'];
    $posterid = $row_query2['poster_id'];
    $sql2= "select * from users where userid='$posterid'";
    $find = $connection->query($sql2);
    $row3 = mysqli_fetch_array($find);
    $pp = $row3['profilepic'];
    if($row_query2['image']==NULL){
if($pp==NULL||$pp==""){		// lw m5trsh sora y7ot sora default
if($gender=="male"){
$files = glob("pictures/*.*");
$num = $files[0];
echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
</div>';  
}	
else if($gender=="female"){
$files = glob("pictures/*.*");
$num = $files[1];
    echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
</div>';  
}
}else{
$num = base64_encode($row3['profilepic'] );
    echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="data:image/jpeg;base64,'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
</div>';  
}
 
}
else{ 
echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="data:image/jpeg;base64,'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
<img src="data:image/jpeg;base64,'.base64_encode($row_query2['image'] ).'" style="width:100%" class="w3-margin-bottom">
</div>';
}
}else{
    if(strcmp($row_query2['IsPublic'],"PUBLIC")==0){
      $content = $row_query2['caption']; 
  $postername = $row_query2['posterName'];
    $time = $row_query2['postedTime'];
    $posterid = $row_query2['poster_id'];
    $sql2= "select * from users where userid='$posterid'";
    $find = $connection->query($sql2);
    $row3 = mysqli_fetch_array($find);
    $pp = $row3['profilepic'];
    if($row_query2['image']==NULL){
if($pp==NULL||$pp==""){		// lw m5trsh sora y7ot sora default
if($gender=="male"){
$files = glob("pictures/*.*");
$num = $files[0];
echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
</div>';  
}	
else if($gender=="female"){
$files = glob("pictures/*.*");
$num = $files[1];
    echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
</div>';  
}
}else{
$num = base64_encode($row3['profilepic'] );
    echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="data:image/jpeg;base64,'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
</div>';  
}
 
}
else{
if($pp==NULL||$pp==""){		// lw m5trsh sora y7ot sora default
if($gender=="male"){
$files = glob("pictures/*.*");
$num = $files[0];
echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
<img src="data:image/jpeg;base64,'.base64_encode($row_query2['image'] ).'" style="width:100%" class="w3-margin-bottom">
</div>';  
}	
else if($gender=="female"){
$files = glob("pictures/*.*");
$num = $files[1];
    echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
<img src="data:image/jpeg;base64,'.base64_encode($row_query2['image'] ).'" style="width:100%" class="w3-margin-bottom">
</div>';  
}
}else{
$num = base64_encode($row3['profilepic'] );
    echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="data:image/jpeg;base64,'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
<img src="data:image/jpeg;base64,'.base64_encode($row_query2['image'] ).'" style="width:100%" class="w3-margin-bottom">
</div>';  
}
}   
    }
     
     
     
     
     }
}                


?>
                    <!-- End Grid -->
            </div>
            <!-- End Page Container -->
        </div>
        <br>
    </div>
    <!-- Footer -->
    <script>
        // Accordion
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-theme-d1";
            } else {
                x.className = x.className.replace("w3-show", "");
                x.previousElementSibling.className =
                    x.previousElementSibling.className.replace(" w3-theme-d1", "");
            }
        }
        // Used to toggle the menu on smaller screens when clicking on the menu button
        function openNav() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

    </script>
    <script type="text/javascript">
        $("textarea").emojionePicker({
            type: "unicode"
        });

    </script>
</body>

</html>
