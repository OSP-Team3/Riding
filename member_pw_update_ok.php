<?php
 $db_host = "localhost";
 $db_user = "root";
 $db_passwd = "1234";
// $db_name = "openplatform";
$db_name = "amuse";
 $mysqli  = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
session_start();
$myID = $_SESSION['user_id'];
$pw=$_POST['pw'];

if( $pw==NULL ){
    echo "빈칸을  채워주세요";
    echo "<p/>";
    echo "<a href=changepw.php>돌아가기</a>";
    exit();
}
$sql = mysqli_query($mysqli,"update user set password='".$pw."' where name = '".$_SESSION['user_id']."'");

echo "<script>alert('정보변경이 완료되었습니다'); document.location.href='./LAB_2.php';</script>";


?>