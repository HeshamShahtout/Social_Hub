    <?php
		  session_start();
    $email=$_SESSION['email'];
	//echo $email;
	
$connection=new mysqli ('localhost','root','','finalproject');
if($connection->connect_error)
{
    die("connection error".$connection->connect_error);
}
else{
 if(isset($_POST["insert"]))  
 {  
	 // $sql1="select * from users WHERE email='$email'";				
	 // $result1 = mysqli_query($connection, $sql1); 
	  // $row=mysqli_fetch_array($result1);
//---------------------------------------------------------------------//

      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
      $query = "UPDATE  users SET profilepic='$file' WHERE email='$email'";  
      if($connection->query($query))  
      {  
           echo '<script>	alert("Image Inserted into Database")</script>'; 
		    // session_start();
	  // $_SESSION['email']=$email;
	  header("Location:profilescreen.php");
		   
      }  
	  else{
		  
		  echo '<script>	alert("error in connection")</script>';  
	  }
 }  
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Social Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Trendy Tab Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="css/choosephoto.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!--web font-->
    <!-- //web font -->
    <!-- js -->
    <script src="js/jquery.min.js"></script>
    <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
    <!-- //js -->
<body>
    <!-- main -->
    <div class="main">
        <h1>Social Hub</h1>
        <div class="login-form">
            <div class="sap_tabs w3ls-tabs">
                <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                    <ul class="resp-tabs-list">
                        <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Choose Photo</span></li>
                    </ul>
                    <div class="clear"> </div>
                    <div class="resp-tabs-container">
                        <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                            <div class="login-agileits-top">
                                <form action="choosephoto.php" method="post" enctype="multipart/form-data">
                     <input type="file" name="image" id="image" class="inputfile" />
                                    <label for="image">Choose a file</label>  
                     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" /> 
                                    <p id="choose"> Choose Later?</p>
                                     <a href="profilescreen.php"> <span>Profile</span></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ResponsiveTabs js -->
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#horizontalTab').easyResponsiveTabs({
                        type: 'default', //Types: default, vertical, accordion           
                        width: 'auto', //auto or any width like 600px
                        fit: true // 100% fit in a container
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    $("#countries").msDropdown();
                })
            </script>
            <!-- //ResponsiveTabs js -->
        </div>
    </div>
    <!-- //main -->
    <!-- copyright -->
    <div class="copyright">
        <p></p>
    </div>
    <!-- //copyright -->

</body>

</html>
