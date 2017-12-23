<?php 
session_start();
$email=$_SESSION['email'];
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
//--------------------------------------------------------------------------------------------------------------------------------------------//	
$query = "SELECT * FROM users where email='$email'";  			//display nick name
$result = mysqli_query($connection, $query); 
$name = mysqli_fetch_array($result);
$fname = $name['Fname'];
$lname = $name['Lname'];
$pp = $name['profilepic'];
$loggedin_id=$name['userid'];

$query = "SELECT * FROM users where email='$email'";  			//display nick name
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
$userid = $nn = $name['userid'];
$query="select userid from friend_request where friendid='$userid' and accepted=0";
    $result_query=mysqli_query($connection,$query);
    $requests_counter=0;
    while($requests=mysqli_fetch_array($result_query)){
      $requests_counter++;  
    }
//-------------------------------------------------------------------------------------------------------------------------------
  if(isset($_POST['accept']))// lw das accept
	{
	  $requester=$_POST['accept'];	//id bta3 el requester 
	  $accept="insert into friends (friendid,userid) values('$requester','$loggedin_id') ";	// add to database (add to table friends)
	  $accept_result=mysqli_query($connection,$accept);
	  $accept_1="insert into friends (userid,friendid) values('$requester','$loggedin_id') ";	// hna b5lehom fe el table both friends y3ni 1 ykon friend 3nd 2 w fe nfs el w2t 2 ykon friend 3nd 1
	  $accept_result_1=mysqli_query($connection,$accept_1);
//-----------------------------------------------------------------------------------------------------------//
				//update request where accepted =1 and pending=0
	  $update_query="update friend_request set pending=0,accepted=1 where userid='$requester' AND friendid='$loggedin_id'";
	  $update_result=mysqli_query($connection,$update_query);
	//echo$_POST['accept'];
	header("location:myRequest.php");
	}
	else if(isset($_POST['reject']))// lw das reject
	{
		$requester=$_POST['reject'];					// lw 3ml reject bashelo mn el database 5als .
		$delete_query="delete from friend_request where userid='$requester' AND friendid='$loggedin_id'";
		$delete_result=mysqli_query($connection,$delete_query);
	//	echo$_POST['reject'];
	header("location:myRequest.php");
	}	

?>
<!DOCTYPE html>
<html>
<title>Social Hub
</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!--<link rel="stylesheet" href="js/theme.css">-->
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
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
            <a href="profilescreen.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white " title="Profile">
          <i class="fa fa-user">
          </i>
        </a>
            <a href="myfriends.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Friends">
 <i class="fa fa-users" aria-hidden="true"></i> 
        </a>
            <a href="myRequest.php" class="w3-theme-d4 w3-bar-item w3-button w3-padding-large" title="Friends">
<i class="fa fa-user-plus  w3-margin-right" aria-hidden="true"></i> My Requests
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
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1
      </a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2
      </a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3
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
                        <br>
                        <br>
                        <br>
                        <?php
echo '   <h4 class="w3-center">'.$fname.' '.$lname.'</h4>';
?>
                            <?php
$pp = $name['profilepic']; 
if($pp==NULL||$pp==""){		// lw m5trsh sora y7ot sora default
if($gender=="male"){
$files = glob("pictures/*.*");
$num = $files[0];
echo '<p class="w3-center"><img src="'.$num.'"class="w3-circle" style="height:106px;width:106px"></p>';
}	
else if(strcmp($pic['gender'],"female")==0){
$files = glob("pictures/*.*");
$num = $files[1];
echo '<p class="w3-center"><img src="'.$num.'"class="w3-circle" style="height:106px;width:106px"></p>';
}
}else{
$num = base64_encode($name['profilepic'] );
echo '    <p class="w3-center"><img src="data:image/jpeg;base64,'.$num.'"class="w3-circle" style="height:106px;width:106px"></p>';
}

?>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
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
            <?php
            $query="select userid from friend_request where friendid='$loggedin_id' and accepted=0";
$result_query=mysqli_query($connection,$query);	
$requests_counter=0;
	while($requests=mysqli_fetch_array($result_query)){	//array of friends.
        $friendid=$requests['userid'];
        $friend_query="select * from users where userid='$friendid'";
        $friend_result=mysqli_query($connection,$friend_query);
        $friend_request=mysqli_fetch_array($friend_result);
		$id=$friend_request['userid'];
        $fname=$friend_request['Fname'];
        $lname=$friend_request['Lname'];
        $pp = $friend_request['profilepic'];
        $gender = $friend_request['gender'];
//$row3=mysqli_fetch_array($result2);
//$pp = $row3['profilepic']; 
//$result_query=mysqli_query($connection,$query);
//$row_query=mysqli_fetch_array($result_query);
if($pp==NULL||$pp==""){		// lw m5trsh sora y7ot sora default
if($gender=="male"){
$files = glob("pictures/*.*");
$num2 = $files[0];
    echo ' <div class="w3-col m4">
                    <div class="w3-row-padding">
                        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                            <div class="w3-round w3-white w3-center">
<a href="friendscreen.php?userid='.$id.'">'.$friend_request['Fname']." ".$friend_request['Lname'].'</a>
<br>
<br>
                                    <img src="'.$num2.'" alt="Avatar" style="width:50%"><br>

                                 <div class="w3-row w3-opacity">
                                 <form method="POST" action="myRequest.php" enctype="multipart/form-data">
            <div class="w3-half">
              <button class="w3-button w3-block w3-section w3-green" name="accept"  title="Accept" value='.$friend_request['userid'].' type="submit"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" title="Decline" name="reject" value='.$friend_request['userid'].' type="submit"><i class="fa fa-remove"></i></button>
            </div>
            </form>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
}	
else if($gender=="female"){
$files = glob("pictures/*.*");
$num2 = $files[1];
     echo ' <div class="w3-col m4">
                    <div class="w3-row-padding">
                        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                            <div class="w3-round w3-white w3-center">
<a href="friendscreen.php?userid='.$id.'">'.$friend_request['Fname']." ".$friend_request['Lname'].'</a>
<br>
<br>
                                    <img src="'.$num2.'" alt="Avatar" style="width:50%"><br>
                                 <div class="w3-row w3-opacity">
                                 <form method="POST" action="myRequest.php" enctype="multipart/form-data">
            <div class="w3-half">
              <button class="w3-button w3-block w3-section w3-green" name="accept"  title="Accept" value='.$friend_request['userid'].' type="submit"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" title="Decline" name="reject" value='.$friend_request['userid'].' type="submit"><i class="fa fa-remove"></i></button>
            </div>
            </form>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
}
}else{
$num2 = base64_encode($friend_request['profilepic'] );
   echo ' <div class="w3-col m4">
                    <div class="w3-row-padding">
                        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                            <div class="w3-round w3-white w3-center">
<a href="friendscreen.php?userid='.$id.'">'.$friend_request['Fname']." ".$friend_request['Lname'].'</a>
<br>
<br>
                                    <img src="data:image/jpeg;base64,'.$num2.'" alt="Avatar" style="width:50%"><br>
                                <div class="w3-row w3-opacity">
                                 <form method="POST" action="myRequest.php" enctype="multipart/form-data">
            <div class="w3-half">
              <button class="w3-button w3-block w3-section w3-green" name="accept"  title="Accept" value='.$friend_request['userid'].' type="submit"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" title="Decline" name="reject" value='.$friend_request['userid'].' type="submit"><i class="fa fa-remove"></i></button>
            </div>
            </form>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
}

	}
          
    ?>
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
