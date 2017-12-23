<?php 
session_start();
$email=$_SESSION['email'];
if(isset($_POST['button'])){
$temp=$_POST['area'];
//---------------------------------------Posting--------------------------------------------------------------//	
$isPublic=$_POST['isPublic'];//da 3lshan a3ml hwa public wla private
}
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
die("connection error".$connection->connect_error);
}
else{
if(isset($_POST['button'])){//hna isset 3lshan my3mlsh insert le post fady kol ma bad5ol 3la el page.
if(($_POST['area']==""||$_POST['area']==NULL)&&(empty($_FILES['image']['tmp_name'])))
{
echo '<script>alert("Empty Caption ! Please Insert Caption ")</script>'; 
}
else
{
$sql1="select userid,fname,lname from users WHERE email='$email'";				//insert new posts into database.
$result1 = mysqli_query($connection, $sql1); 
$row=mysqli_fetch_array($result1);
$id=$row['userid'];
$fname=$row['fname'];
$lname=$row['lname'];  
$postername=$fname." ".$lname;
//--------------------------------------------------------------------------------------------------------------------------//	
if(empty($_FILES['image']['tmp_name'])){ //empty de bt3ml check whether fe sora et3mlha browse wla la
$sql1="insert into posts (caption,userid,postedTime,IsPublic,postername,poster_id) values ('$temp',$id,NOW(),'$isPublic','$postername','$id')";
$result1 = mysqli_query($connection, $sql1); 
}else{
$image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); 
$sql1="insert into posts (caption,userid,postedTime,IsPublic,Image,postername,poster_id) values ('$temp',$id,NOW(),'$isPublic','$image','$postername','$id')";
$result1 = mysqli_query($connection, $sql1); 
}
}
}

//----------------------------------------------Getting User Info----------------------------------------------//	
$query = "SELECT * FROM users where email='$email'";  		
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
$userid = $name['userid'];
$aboutme = $name['aboutme'];
//--------------------------------------------------------------------------------------------------------------//
    
//-----------------------------------------------Requests Counter-----------------------------------------------//
$query="select userid from friend_request where friendid='$userid' and accepted=0";
$result_query=mysqli_query($connection,$query);
$requests_counter=0;
while($requests=mysqli_fetch_array($result_query)){
$requests_counter++;  
    }
$_SESSION['counter']=$requests_counter;
}
//--------------------------------------------------------------------------------------------------------------//
?>
<!DOCTYPE html>
<html>
<title>Social Hub
</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="cssd.css">
<!--<link rel="stylesheet" href="js/theme.css">-->
<link rel="stylesheet" href="css/theme.css">
<link href="Emoji.css" rel="stylesheet">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="dist/emojione.picker.css" rel="stylesheet">
<script src="//code.jquery.com/jquery.min.js"></script>
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
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-theme-action w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()">
          <i class="fa fa-bars">
          </i>
        </a>
            <a href="homescreen.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">
          <i class="fa fa-home">
          </i>
        </a>
            <a href="profilescreen.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4" title="Profile">
          <i class="fa fa-user w3-margin-right"> My Profile
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
                    <button class="w3-btn w3-theme w3-small" type="submit" id="search button"> <i class="fa fa-search" aria-hidden="true"></i>  Search </button>
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
    <!-- End NavBar-->
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
echo '   <h4 class="w3-center">'.$nn.'</h4>';
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
echo '<p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> '.$email.'</p>'
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
echo '<p><i class="fa fa-user-circle fa-fw w3-margin-right w3-text-theme"></i> '.$aboutme.'</p>'
?>
                                                    <form method="POST" action="update.html">
                                                        <button type="submit" class="w3-button w3-theme" name="update" id="update">
     <i class="fa fa-pencil"></i>  Edit Profile
     </button>
                                                    </form>
                                                    <br>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
            <!-- Middle Column -->
            <div class="w3-col m7">
                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding">
                                <form method="post" action="profilescreen.php" enctype="multipart/form-data">
                                    <textarea contenteditable="true" class="w3-border w3-padding" name="area" id="area" placeholder="Say Something  ..."></textarea>
                                    <select name="isPublic" id="isPublic" class="choose  w3-theme">
                      <option value="PUBLIC">PUBLIC
                      </option>
                      <option value="PRIVATE" >PRIVATE
                      </option>
                    </select>
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
$sql="select userid from users where email='$email'";  //display posts
$result=$connection->query($sql);
if($row=mysqli_fetch_assoc($result)){
$id=$row['userid'];
$query = "SELECT caption,postername,image,postedTime FROM posts where userid=$id order by postedTime DESC";  
$result2=$connection->query($query);
while($row2=mysqli_fetch_assoc($result2)){
$content = $row2['caption'];
$postername = $row2['postername'];
$time = $row2['postedTime'];
if($row2['image']==NULL){
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
$num = base64_encode($name['profilepic'] );          
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
<img src="data:image/jpeg;base64,'.base64_encode($row2['image'] ).'" style="width:100%" class="w3-margin-bottom">
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
<img src="data:image/jpeg;base64,'.base64_encode($row2['image'] ).'" style="width:100%" class="w3-margin-bottom">
</div>'; 
}
}else{
$num = base64_encode($name['profilepic'] );            
echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
<img src="data:image/jpeg;base64,'.$num.'"class="w3-left w3-circle w3-margin-right"style="width:60px">
<span class="w3-right w3-opacity">'.$time.'</span>
<h4>'.$postername.'</h4>
<hr class="w3-clear">
<p>'.$content.'</p>
<img src="data:image/jpeg;base64,'.base64_encode($row2['image'] ).'" style="width:100%" class="w3-margin-bottom">
</div>'; 
}
}
}
}
?>
                    <div class="w3-container w3-card w3-white w3-round w3-margin">
                        <!-- End Middle Column -->
                    </div>
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
