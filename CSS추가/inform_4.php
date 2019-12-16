<?php
session_start();
$db=mysqli_connect("localhost","root","1234","team3");
mysqli_set_charset($db,'utf8');

$rideIDX = $_GET['value'];  
$sql = "select * from ride where ride_id = '$rideIDX'";
$result = $db->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$review = $db->query("select * from review where ride_id='$rideIDX'");
$imgrsc = $db->query("select img_link from ride_img where ride_id='$rideIDX'");
$rideName = $row['name'];
$videorsc = $db->query("select video_link from ride_video where ride_id='$rideIDX'");
//mysqli_set_charset($db,'utf8');

if(isset($_SESSION['user_id'])){
    $myID = $_SESSION['user_id'];
}else{
    $myID = '-1';
}


if(isset($_POST['like'])){
    if (!isset($_SESSION['user_id']))
    {
        echo "<script>alert('로그인 후 좋아요를 누를 수 있습니다.')";
	
    }else{
        $userNAME = $_SESSION['user_id'];
        $myID = $db->query("select user_id from user where name='$userNAME'");
        $myID = $myID ->fetch_array(MYSQLI_ASSOC);
        $myID = $myID['user_id'];
        $checkLike = $db->query("select * from user_like where user_id='$myID' and ride_id='$rideIDX'"); 
        if($checkLike->num_rows==1){
            $deleteInsert = $db->query("delete from user_like where user_id='$myID' and ride_id='$rideIDX'");
        }else{
            $likeInsert = $db->query("insert ignore into user_like(user_id, ride_id) values('$myID','$rideIDX')");
        }
    }
}
?>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="inform.css" type="text/css" />
    <title>Ride Information</title>
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
    <section id="main_section">
		<div id="main_contents">
			<header id="title_header">
				<hgroup>
					<h2 id="ride_name"><?php echo($rideName)?></h2>
				</hgroup>
				<div id="ride_desc">
					<?php echo($row['description']);?>
				</div>
			</header>

			<div id="media">
				<div id="L_arrow">
					<img src="leftArrow.png" onclick="plusDivs(-1)" />
				</div>
				<div id="img">
					<?php
							while($r = $imgrsc->fetch_array(MYSQLI_ASSOC)){
								$myImg = $r['img_link'];
						?>
								<img class="mySlides" src="<?php echo($myImg)?>" width="560" height="315">
                            
							<?php  }?>
						<?php
							if ($videorsc->num_rows >=1 ){
								while($r = $videorsc->fetch_array(MYSQLI_ASSOC)){
									echo $r['video_link'];
								}
							}
						?>
				</div>
				<div id="R_arrow">
					<img src="rightArrow.png" onclick="plusDivs(1)" />
				</div>
			</div>
			<div id="like">
				<form method="post">
						<button type=submit name="like" value="like" id="btn2" style="background-collor:transparent">
					<?php
					if(isset($_SESSION['user_id'])){
						$myID = $_SESSION['user_id'];
						$userNAME = $_SESSION['user_id'];
						$userNAME = $db->query("select user_id from user where name='$userNAME'");
						$userNAME = $userNAME ->fetch_array(MYSQLI_ASSOC);
						$userNAME = $userNAME['user_id'];
						$checkLike = $db->query("select * from user_like where user_id='$userNAME' and ride_id='$rideIDX'"); 
						if($checkLike->num_rows==1){
						?>
						<img src=like.png width="20" heigth="20">
						<?php
						}else{
						?>
						<img src=unlike.png width="20" heigth="20">
							<?php
						}
					}else{
						?>
						<img src=unlike.png width="20" heigth="20">
						<?php
					}
						?>

						</button>
					</form>
			</div>
			<article>
				<table id="ride_info">
					<tr>
						<td><b>탑승정원:</b></td> 
						<td align=right><?php echo $row['passenger'];?>명</td>
					</tr>
					<tr>
						<td><b>키제한:</b></td> 
						<td align=right><?php echo ($row['min_height']."cm~".$row['max_height']."cm");?></td>
					</tr>
				</table>
				<table id="rate">
					<tr>
						<td id="hash_tag">#스릴감</td>
						<td>
							<?php 
							$sql = "select avg(thrill) from review where ride_id='$rideIDX'";
							$result = $db->query($sql);
							$result = $result->fetch_array(MYSQLI_ASSOC);
							echo $result['avg(thrill)'];
							?>
						</td>
					</tr>
					<tr>
						<td id="hash_tag">#대기시간</td>
						<td><?php 
							$sql = "select avg(wait) from review where ride_id='$rideIDX'";
							$result = $db->query($sql);
							$result = $result->fetch_array(MYSQLI_ASSOC);
							echo $result['avg(wait)'];
							?>
						</td>
					</tr>
					<tr>
						<td id="hash_tag">#운행시간</td>
						<td><?php 
							$sql = "select avg(op_time) from review where ride_id='$rideIDX'";
							$result = $db->query($sql);
							$result = $result->fetch_array(MYSQLI_ASSOC);
							echo $result['avg(op_time)'];
							?>
						</td>
					</tr>
					<tr>
						<td id="hash_tag">#젖음</td>
						<td><?php 
							$sql = "select avg(wet) from review where ride_id='$rideIDX'";
							$result = $db->query($sql);
							$result = $result->fetch_array(MYSQLI_ASSOC);
							echo $result['avg(wet)'];
							?>
						</td>
					</tr>
				</table>
			</article>
			<article id="ride_review">
				<p id="riding_review">REVIEW</p>
				<ul id="user_review">
					<?php
					while($r=$review->fetch_array(MYSQLI_ASSOC)){?>
					<li>
						<div id="review">
							<div>
								<div id="profile">
									<figure>
									<?php
										$user_id = $r['user_id'];
										$user = $db->query("select name,profile from user where user_id='$user_id'");
										$user = $user->fetch_array(MYSQLI_ASSOC);
										$user_img = $user['profile'];
										$user_name = $user['name'];
									?>
									<img src="<?php echo($user_img)?>" width="80" height="80" />
									</figure>
									<span id="score">
											<?php echo $r['satisfy'];?> 점 
									</span>
								</div>
								<div>
									<span id="title">
										<?php echo $r['title'];?>
									</span>
									<p id="total_review">
										<?php echo $r['review'];?>
									</p>
									<span>
										<?php 
										if($r['hash_tag'] != NULL){
											$b = explode("#",$r['hash_tag']);
											$leng = count($b);
											$c = 0;
											for($c = 1;$c<$leng;$c++){
												echo("<a href='main_search.php?searchterm=#".$b[$c]."'>#".$b[$c]."</a>");
												echo("<br/>");
											}
										}
										?>
									</span>
									<span id="user">
										<?php 
										echo($user['name']);?>
									</span>
									<span id="time">
										<?php echo($r['date']);?>
									</span>
								</div>
								<div id="rewrite">
									<?php
										if($user_name == $myID){ ?>
									<a href="reWrite.php?ride=<?php echo($rideIDX)?>" >
										수정하기
									</a>
									<?php
										}
									?>
								</div>
							</div>
						</div>
					</li>
					<?php
					}
					?>
				</ul>
			</article>
		</div>
	</section>
    <footer id="main_footer">Copyright &copy; 2019</footer>
    </div>
    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            };
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "block";
        }
    </script>
</body>

</html>

