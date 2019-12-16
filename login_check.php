<html>
<head>
    <title>타봤어?</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="wrapper">
        <header id="main_header">
            <a href=1_main.php style="text-decoration:none;color:white;">
                <h1>타봤어?</h1>
                <h4>
                    <font color="#FFE400"> 놀이기구 리뷰 어플리케이션</font>
                </h4>
            </a>
        </header>
    </div>
    
</body>
</html>

<?php
session_start();
$id=$_POST['id'];
$pw=$_POST['pw'];
$mysqli=mysqli_connect("localhost","root","1234","team3");
$check="SELECT * from user where name = '$id'";
$result=$mysqli->query($check);
if($result->num_rows==1){
	$row=$result->fetch_array(MYSQLI_ASSOC);
		if($row['password']==$pw){
		$_SESSION['user_id']=$id;
			if(isset($_SESSION['user_id'])){
				header('Location: ./1_main.php');
			}
			else{
				echo "세션 실패!";
			}
		}
		else{
			echo "<b style='color:red;'>아이디 혹은 패스워드 오류</b>";
            echo "<p/>";
			echo "<a href=login.html>다시 로그인하기</a>";
            echo "<p/>";
            echo "<a href=signUp.html>회원가입</a>";
		}
}
else{
	echo "<b style='color:red;'>아이디가 존재하지 않습니다</b>";
    echo "<p/>";
	echo "<a href=login.html>다시 로그인하기</a>";
    echo "<p/>";
	echo "<a href=signUp.html>회원가입</a>";
}
?>

