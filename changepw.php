<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>회원가입 폼</title>
	<link rel="stylesheet" href="changePW.css">
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
		<div id="find">
		  <form method="post" action="member_pw_update_ok.php">
			<input type="password"size="35" name="pw" placeholder="새 비밀번호를 입력하세요">
			<input type="submit" value="변경하기" />

		  </form>
		  <div id="back"><?php echo "<a href=LAB_2.php>돌아가기</a>"; ?><div>
		</div>
	</div>
</body>
</html>
