
<?php

$db_host = "localhost";
 $db_user = "root";
 $db_passwd = "1234";
 $db_name = "openplatform";
$db_name="amuse";
 $conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
		
                 session_start();
            

                    $myID = $_SESSION['user_id'];


		
		$filename = $_FILES["fileToUpload"]["name"];
		
		$size = $_FILES["fileToUpload"]["size"];

		include_once 'get.php';
		
		 $query="UPDATE `User` SET `profile`='$filename' WHERE `name`='$myID'";
mysqli_query($conn,$query );   
		
		

        echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
		
    echo "<script>alert('사진이 등록되었습니다.');history.back();location.reload();location.replace('LAB_2.php'); </script>";
   

    

 
  }
    
    
?>

	



