<?php
    $conn = new mysqli("localhost","root","1234","team3");
    mysqli_set_charset($conn,'utf8');
    if(mysqli_connect_errno()){
	echo '<p>Error: Could not connect to databse.<br/>
	Please try agian later.</p>';
	exit;
    }

    function fill_ride($conn, $int){
	$output = '';
	if($int==1) $sql = "SELECT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=1 GROUP BY ride.ride_id";
	else if($int==2) $sql = "SELECT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=2 GROUP BY ride.ride_id";
	else if($int==3) $sql = "SELECT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=3 GROUP BY ride.ride_id";
	else if($int==4) $sql = "SELECT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=4 GROUP BY ride.ride_id";		
	$result = mysqli_query($conn, $sql) or die(mysqli_error($connect));
	while($row = mysqli_fetch_array($result))
	{
	   $output .= '<div class="column">';  
               $output .= '<a href="http://localhost/inform_4.php?value='.$row["ride_id"].'">';  
               $output .= '<img  src="'.$row["img_link"].'"<br /></a>&nbsp'; 
               $output .= '<p>'.$row["name"].'</p>&nbsp'; 
               $output .= '</div>'; 
	}
	return $output;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>타봤어?</title>
  <link rel="stylesheet" href="main.css">
</head>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<body onload=init()>

    <div id="wrapper">
		<p align = "right">
		 <?php
			session_start();
			if (!isset($_SESSION['user_id']))
			{
				?>
					<a href="./login.html">로그인/회원가입</a>
					<?php
			}else{
				?>
				<a href="writeReview.php">글쓰기</a>
				<a href="logout.php">로그아웃</a>
				<a href="LAB_2.php">내정보</a>
						</p>  
					<?php
			}
		 ?>
		<header id="main_header">
			<a href=1_main.php style="text-decoration:none;color:white;">
				<h1>타봤어?</h1>
				<h4>
					<font color="#FFE400"> 놀이기구 리뷰 어플리케이션</font>
				</h4>
			</a>
		</header>
		<div id="menu">
				<div id="myTab">
					<button class="tab" id="default" onclick="openMenu('Gyung', this, 1)">경주월드</button><button class="tab" onclick="openMenu('Seoul', this, 2)">서울랜드</button><button class="tab" onclick="openMenu('Ever', this, 3)">에버랜드</button><button class="tab" onclick="openMenu('Lotte', this, 4)">롯데월드</button>
				</div>
				<div id = "search">
					<form name="form1" action="main_search.php" method="get"> 
						<input class='auto' name="searchterm" type="text" size="55" placeholder="해시태그를 입력하세요"/>
						<button type="submit" name="submit"> 검색</button>
					</form>
				</div>
				<div id="order">
					<select name="displayOrder" id="displayOrder">
						<option value = "X" selected>정렬</option>
						<option value = "count">인기순</option>
						<option value = "star">별점순</option>
					</select>
				</div>
			</div>

		<section class="main_section">
			<div id="middle">
				<div id='Gyung' class="content">
					<p>
						<div id="show_ride">	  
						  <?php echo fill_ride($conn,1); ?>      
						</div>
					</p>
				</div>
	
				<div id='Seoul' class="content">
					<p>
						<div id="show_ride">	  
						  <?php echo fill_ride($conn,2); ?>      
						</div>
					 </p>
				</div>

				<div id='Ever' class="content">
					<p>
						<div id="show_ride">	  
						  <?php echo fill_ride($conn,3); ?>      
						</div>
					</p>
				</div>

				<div id='Lotte' class="content">
					<p>
						<div id="show_ride">	  
						  <?php echo fill_ride($conn,4); ?>      
						</div>
					</p>
				 </div>
			</div>
		</section>
    </div>
</body>
</html>
 <script>

      $(document).ready(function( ){
	$('#displayOrder').change(function( ){  
               var display = $(this).val();
               var rideN = butt_num;   
               $.ajax({  
                 url: "load_data.php",  
                 method: "POST",  
                 data: {rideN, display},
                 success:function(data){ 
	         $('#show_ride').html(data)
                 }  
              });
	});  
      });
	function openMenu(target, evt, but) {
		butt_num = but;
		var tabMenu, i, tabContent;
		tabContent=document.getElementsByClassName("content");
		for( i=0; i< tabContent.length; i++){
			tabContent[i].style.display="none";
		}
		tabMenu=document.getElementsByClassName("tab");
		for(i=0; i< tabMenu.length ;i++){
			tabMenu[i].className=tabMenu[i].className.replace(" active","");
		}
		document.getElementById(target).style.display="block";
		evt.className += " active";

	} 
                    function init() {
                        var btn;
                        btn = document.getElementById("default");
                        btn.click();
                    }
   </script>
    <?php mysqli_close($conn); ?>