<?php
session_start();
$email=$_SESSION['email'];
$searchText=$_POST['search'];
$choice=$_POST['search_choice'];
$flag=0;
$caption_flag=0;
echo$searchText;
echo'<br>';
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
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
$nn = $name['NickName'];
$pp = $name['profilepic']; 

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
                <div class="w3-bar-item w3-padding-large w3-right">
                    <form method="POST" action="search.php">
                        <input id="search" name="search" type="text" placeholder="Search">
                        <button class="w3-button w3-theme" type="submit" id="search button"> <i class="fa fa-search" aria-hidden="true"></i>  Search</button>
                        <select name="search_choice" id="search_choice" class=" w3-round w3-theme">
  <option value="names" >names</option>
  <option value="email" >email</option>
   <option value="caption" >caption</option>
</select>
                    </form>
                </div>
                <a href="homescreen.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">
          <i class="fa fa-home w3-margin-right">
          </i>Social Hub
        </a>
                <a href="profilescreen.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Profile">
          <i class="fa fa-user">
          </i>
        </a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Friends">
 <i class="fa fa-users" aria-hidden="true"></i> 
          <span class="w3-badge w3-right w3-tiny w3-green"> 3
            </span>
        </a>

                <!---  <div class="w3-dropdown-hover w3-hide-small">
          <button class="w3-button w3-padding-large" title="Notifications">
            <i class="fa fa-bell">
            </i>
            <span class="w3-badge w3-right w3-small w3-green">3
            </span>
          </button>
        </div>  --->


                <!---- End Navbar---->
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
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
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
                                    <?php
                                    
	$test=explode("@",$searchText);
	//if(strcmp($test[0],$searchText)==0){	//search bel hometown w el lname w fname
	if(strcmp($choice,"names")==0){
//	$sql ="select fname,Lname from users where Fname LIKE '%$searchText%' OR  Lname LIKE'%$searchText%' OR hometown LIKE '%$searchText%'";
	$sql ="select * from users where Fname LIKE '%$searchText%' OR  Lname LIKE'%$searchText%' OR hometown LIKE '%$searchText%'";

$result = mysqli_query($connection, $sql); 

if($result->num_rows>0){
	while($row= mysqli_fetch_array($result)){
		echo '<a href="friendscreen.php?userid='.$row['userid'].'">'.$row['Fname']." ".$row['Lname'].'</a>';		
		echo '<br>';	
	}

	// foreach($array as $row ){
		// echo $row['userid'].'<br>';
	// }
	
	$flag=1;
	}

		}
else if (strcmp($choice,"email")==0){ 	//hna lw search bel email 
	//$sql ="select fname,Lname from users where email='$searchText'";
	$sql ="select * from users where email='$searchText'";

	$result = mysqli_query($connection, $sql); 
if($result->num_rows>0){
	while($row= mysqli_fetch_array($result)){
			echo '<a href="friendscreen.php?userid='.$row['userid'].'">'.$row['Fname']." ".$row['Lname'].'</a>';
			echo'<br>';
//$_SESSION['userid']=$row['userid'];
	}
	$flag=1;
	//$caption_flag=1;
	}
}
//	$sql2 = "select postername from posts where caption Like '%$searchText%'"; // uncomment it after inserting poster name.
if(strcmp($choice,"caption")==0){
	$sql2 = "select * from posts where caption Like '%$searchText%'"; // uncomment it after inserting poster name.
	$result2 = mysqli_query($connection, $sql2); 
	if($result2->num_rows>0){
		while($row2=mysqli_fetch_array($result2)){
			echo '<a href="friendscreen.php?userid='.$row2['poster_id'].'">'.$row2['posterName'].'</a>';
			echo'<br>';
		}
		$flag=1;
	}
}
if($flag==0){
	echo"user not found";
}

                                    
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
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

