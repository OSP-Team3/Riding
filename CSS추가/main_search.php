<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>타봤어?</title>
  <link rel="stylesheet" href="main.css">
</head>
<script> var char; </script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<body onload=init()>
	<?php
    			$conn = new mysqli("localhost","root","1234","team3");
    			mysqli_set_charset($conn,'utf8');
    			if(mysqli_connect_errno()){
	    		echo '<p>Error: Could not connect to databse.<br/>Please try agian later.</p>';
			exit;
    			}
	?>
    <div id="wrapper">
		<div>
			<p align = "right">
				<?php
					session_start();
					if (!isset($_SESSION['user_id']))
					{
						?>
							<a href="./login.html">로그인/회원가입</a>
							<?php
					}
					else{
						?>
						<a href="writeReview.php">글쓰기</a>
						<a href="logout.php">로그아웃</a>
						<a href="LAB_2.php">내정보</a>
							</p>  
					<?php
					}
					?>
		</div>
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
				<button id="default" class="tab" onclick="openMenu1('Gyung', this)">경주월드</button><button class="tab" onclick="openMenu2('Seoul', this)">서울랜드</button><button class="tab" onclick="openMenu3('Ever', this)">에버랜드</button><button class="tab" onclick="openMenu4('Lotte', this)">롯데월드</button>
			</div>
			 <div id = "search">
				<form name="form1" action="main_search.php" method="get"> 
					<input class='auto' name="searchterm" type="text" size="75" placeholder="해시태그를 입력하세요"/>
					<button type="submit" name="submit"> 검색</button>
				</form>
			 </div>
			 <div id="order">
				<select id="displayOrder" onChange="selectCont(this,'')">
					<option value = "X" selected>정렬</option>
					<option value = "G_count">인기순</option>
					<option value = "G_star">별점순</option>
				</select>
			</div>

			<?php $search_term = $_GET['searchterm']; ?>
		</div>
		<section class="main_section">
			<div id='Gyung' class="content">
				</br>
				<div id="X" class="subCont">
                       <?php
						 $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link, review.hash_tag FROM((((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN review on park.ride_id = review.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE (ride.name like '%$search_term%' OR review.hash_tag like '%$search_term%') AND park.park_id=1 GROUP BY ride.ride_id";
						 $result = mysqli_query($conn,$sql);
						if ($result->num_rows > 0) {
						while($row = mysqli_fetch_array($result))
						{ ?>
						<div class="column"> 
              			<a href="http://localhost/inform_4.php?value=<?php echo($row["ride_id"])?>">  
              			<?php echo '<img src="'.$row["img_link"].'"/><br /></a>&nbsp&nbsp&nbsp&nbsp<p>'.$row["name"].'</p>&nbsp&nbsp&nbsp&nbsp</div>';
						} 
						} ?>
						</div>
				</div>


             <div id='Seoul' class="content">
                <div id="X" class="subCont">
                       <?php
		 $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link, review.hash_tag FROM((((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN review on park.ride_id = review.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE (ride.name like '%$search_term%' OR review.hash_tag like '%$search_term%') AND park.park_id=2 GROUP BY ride.ride_id";
		 $result = mysqli_query($conn,$sql);
		if ($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result))
		{ ?>
	   	       <div class="column"> 
              		<a href="http://localhost/inform_4.php?value=<?php echo($row["ride_id"])?>">  
              		<?php echo '<img src="'.$row["img_link"].'"/><br /></a>&nbsp&nbsp&nbsp&nbsp<p>'.$row["name"].'</p>&nbsp&nbsp&nbsp&nbsp</div>';
		} 
		} ?>
                </div>
             </div>


             <div id='Ever' class="content">
                <div id="X" class="subCont">
                       <?php
		 $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link, review.hash_tag FROM((((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN review on park.ride_id = review.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE (ride.name like '%$search_term%' OR review.hash_tag like '%$search_term%') AND park.park_id=3 GROUP BY ride.ride_id";
		 $result = mysqli_query($conn,$sql);
		if ($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result))
		{ ?>
	   	       <div class="column"> 
              		<a href="http://localhost/inform_4.php?value=<?php echo($row["ride_id"])?>">  
              		<?php echo '<img src="'.$row["img_link"].'"/><br /></a>&nbsp&nbsp&nbsp&nbsp<p>'.$row["name"].'</p>&nbsp&nbsp&nbsp&nbsp</div>';
		} 
		} ?>
                </div>
             </div>


             <div id='Lotte' class="content">
                <div id="X" class="subCont">
                       <?php
		 $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link, review.hash_tag FROM((((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN review on park.ride_id = review.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE (ride.name like '%$search_term%' OR review.hash_tag like '%$search_term%') AND park.park_id=4 GROUP BY ride.ride_id";
		 $result = mysqli_query($conn,$sql);
		if ($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result))
		{ ?>
	   	       <div class="column"> 
              		<a href="http://localhost/inform_4.php?value=<?php echo($row["ride_id"])?>">  
              		<?php echo '<img src="'.$row["img_link"].'"/><br /></a>&nbsp&nbsp&nbsp&nbsp<p>'.$row["name"].'</p>&nbsp&nbsp&nbsp&nbsp</div>';
		} 
		} ?>
                </div>
             </div>

         </div>
    </section>
  </div>
</body>
</html>

 <script>

                    function init() {
                        var btn;
                        btn = document.getElementById("default");
                        btn.click();
                    }

                    function openMenu1(target, evt) {

                        var tabMenu, i, tabContent;

                        tabContent = document.getElementsByClassName("content");
                        for (i = 0; i < tabContent.length; i++) {
                            tabContent[i].style.display = "none";
                        }
                        tabMenu = document.getElementsByClassName("tab");
                        for (i = 0; i < tabMenu.length; i++) {
                            tabMenu[i].className = tabMenu[i].className.replace(" active", "");
                        }

                        document.getElementById(target).style.display = "block";
                        evt.className += " active";
                    }

                    function openMenu2(target, evt) {

                        var tabMenu, i, tabContent;

                        tabContent = document.getElementsByClassName("content");
                        for (i = 0; i < tabContent.length; i++) {
                            tabContent[i].style.display = "none";
                        }
                        tabMenu = document.getElementsByClassName("tab");
                        for (i = 0; i < tabMenu.length; i++) {
                            tabMenu[i].className = tabMenu[i].className.replace(" active", "");
                        }

                        document.getElementById(target).style.display = "block";
                        evt.className += " active";
                    }
                    function openMenu3(target, evt) {

                        var tabMenu, i, tabContent;

                        tabContent = document.getElementsByClassName("content");
                        for (i = 0; i < tabContent.length; i++) {
                            tabContent[i].style.display = "none";
                        }
                        tabMenu = document.getElementsByClassName("tab");
                        for (i = 0; i < tabMenu.length; i++) {
                            tabMenu[i].className = tabMenu[i].className.replace(" active", "");
                        }

                        document.getElementById(target).style.display = "block";
                        evt.className += " active";
                    }
                    function openMenu4(target, evt) {

                        var tabMenu, i, tabContent;

                        tabContent = document.getElementsByClassName("content");
                        for (i = 0; i < tabContent.length; i++) {
                            tabContent[i].style.display = "none";
                        }
                        tabMenu = document.getElementsByClassName("tab");
                        for (i = 0; i < tabMenu.length; i++) {
                            tabMenu[i].className = tabMenu[i].className.replace(" active", "");
                        }

                        document.getElementById(target).style.display = "block";
                        evt.className += " active";
                    }
   </script>
    <?php mysqli_close($conn); ?>