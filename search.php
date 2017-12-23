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

else{
	$test=explode("@",$searchText);
	//if(strcmp($test[0],$searchText)==0){	//search bel hometown w el lname w fname
	if(strcmp($choice,"names")==0){
//	$sql ="select fname,Lname from users where Fname LIKE '%$searchText%' OR  Lname LIKE'%$searchText%' OR hometown LIKE '%$searchText%'";
	$sql ="select * from users where Fname LIKE '%$searchText%' OR  Lname LIKE'%$searchText%' OR hometown LIKE '%$searchText%'";

$result = mysqli_query($connection, $sql); 

if($result->num_rows>0){
	while($row= mysqli_fetch_array($result)){
			
		echo '<a href="friendscreen.php?userid='.$row['userid'].'">'.$row['Fname']." ".$row['Lname'].'</a>';
		echo'<br>';
			
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

}

?>
