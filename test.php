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
