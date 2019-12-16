<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>타봤어?</title>
    <link rel="stylesheet" href="LAB.css?after">
    <style>
        table {
            table-layout: fixed;
            word-wrap: break-word;

        }
    </style>
    <style type="text/css">
        table td,
        table th {
            border: 1px solid;
            padding: 2px 5px 2px 5px;
            Text-align: center;
        }

        table img {
            Width: 50px;
            border-spacing: 0;

        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("#upload_file").on('change', function() {

            readURL(this);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>



<body onload=init()>

    <div id="wrapper">

    <header id="main_header">
        <a href=1_main.php style="text-decoration:none;color:white;">
            <h1>타봤어?</h1>
            <h4>
                <font color="#FFE400"> 놀이기구 리뷰 어플리케이션</font>
            </h4>
        </a>
    </header>

        <section class="main_section">
            <div id="wrapper">
                <p align="right">
                    <a href="./writeReview.php">글쓰기</a>
                    <a href="./LAB_2.php"> 내 정보</a>
                    <a href="./logout.php">로그아웃</a>
                </p>
            </div>

            <div id="myInfo">
                <figure>

                    <form enctype="multipart/form-data" action="get.php" method="Post">

                        <?php
    $db_host = "localhost";
    $db_user = "root";
   $db_passwd = "1234";
   $db_name = "openplatform";
  //  $db_name="amuse";
    $conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
    
    
    session_start();
    
    
    $myID = $_SESSION['user_id'];
    
    
    $query = "SELECT * FROM User where name='$myID' ";
    $result = mysqli_query($conn, $query);
    
    while($data = mysqli_fetch_array($result)){
        
        if( empty($data['profile']))
            echo '<img src="https://www.clipartwiki.com/clipimg/detail/197-1979569_no-profile.png" heigh"200" width=200><br>';
        Else
       echo '<img src="/img/'.$data['profile'].'" width=200><br>';
        
    }
    
    ?>
                        <input type="file" name="fileToUpload"> <input type="submit" value="Upload">

                    </form>
                </figure>

                <div>


                    <?php
    
    
    $myID = $_SESSION['user_id'];
    
    
    $sql = "select name, email from user where name='$myID';";
    $res = $conn->query($sql);
    if($res->num_rows==1){
        $row=$res->fetch_array(MYSQLI_ASSOC);
        echo "<p>ID: $myID</p>";
        
        echo "<p>EMAIL: {$row['email']}</p>";
    }
    
    
    ?><form method="post" action="changepw.php">

                        <input type="submit" value="정보변경" />
                    </form>

                </div>
            </div>

            <div id="myTab">
                <button class="tab" onclick="openMenu('RecRide', this)">추천 기구</button>
                <button class="tab" onclick="openMenu('RecCourse', this)">스탬프</button>
                <button id="default" class="tab" onclick="openMenu2('myReview', this)">작성한 리뷰</button>


                <div id="RecRide" class="content">


                    </br>
                    &nbsp
                    <img height="23" width="23" src="/img/ma.png">&nbsp 추천하는 놀이기구를 이용해보세요</br>&nbsp <img height="23" width="23" src="/img/ma.png">&nbsp 빈도수가 가장 높은 해시태그를 반영한 '좋아요'를 표시한 놀이기구가 추천됩니다. </br></br>
                    <select id="place" onChange="selectCont(this,'')">
                        <option value="X" selected>놀이공원</option>
                        <option value="kyung">경주월드</option>
                        <option value="Seoul">서울랜드</option>
                        <option value="Ever">에버랜드</option>
                        <option value="Lotte">롯데월드</option>
                    </select>

                    </br></br>
                    <div id="Lotte" class="subCont">
                        <?php
    
    $sql = "SELECT  img_link,Ride.name, Ride.ride_id FROM User,Ride,User_like, Ride_img where Ride.ride_id >400  and (Ride.ride_id= Ride_img.ride_id) and User_like.user_id=User.user_id and Ride.ride_id=User_like.ride_id and User.name='$myID'";
    
    $result = $conn->query($sql);
    
    
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            
            $sql1 = "SELECT User_like.ride_id FROM User_like where User_like.ride_id=$row[ride_id] ";
            $result_set = mysqli_query($conn, $sql1);
            $count = mysqli_num_rows($result_set);
            
            $sql2= "select  hash_tag from HashTag where ride_id=$row[ride_id]  and count in  (select max(count) from HashTag where ride_id=$row[ride_id])";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = $result2->fetch_assoc();
            
            
            
            ?>
                        
            <div class="column">
	              <a href="http://localhost/inform_4.php?value=<?php echo($row['ride_id'])?>">
                      <?php
                echo'
            <img src="' . $row['img_link'] . '" /><br />
            
            
            
            </a>
            
            &nbsp&nbsp&nbsp&nbsp<img id="n" src="/img/love.png" >&nbsp&nbsp'.$count.'&nbsp&nbsp&nbsp&nbsp'. $row2['hash_tag'].'</img><p>'. $row["name"].'</div>';
            
        }
        
    }
    
    
    
    
    
    ?> </div>

                    <div id="kyung" class="subCont">
<?php
    
    
    
    $sql = "SELECT  img_link,Ride.name, Ride.ride_id FROM User,Ride,User_like, Ride_img where Ride.ride_id <200  and (Ride.ride_id= Ride_img.ride_id) and User_like.user_id=User.user_id and Ride.ride_id=User_like.ride_id and User.name='$myID'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            
            $sql1 = "SELECT User_like.ride_id FROM User_like where User_like.ride_id=$row[ride_id] ";
            $result_set = mysqli_query($conn, $sql1);
            $count = mysqli_num_rows($result_set);
            
            $sql2= "select  hash_tag from HashTag where ride_id=$row[ride_id]  and count in  (select max(count) from HashTag where ride_id=$row[ride_id])";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = $result2->fetch_assoc();
            
            
            ?>
                        
            <div class="column">
	              <a href="http://localhost/inform_4.php?value=<?php echo($row['ride_id'])?>">
                      <?php
                echo'
            <img src="' . $row['img_link'] . '" /><br />
            
            
            
            </a>
            
            &nbsp&nbsp&nbsp&nbsp<img id="n" src="/img/love.png" >&nbsp&nbsp'.$count.'&nbsp&nbsp&nbsp&nbsp'. $row2['hash_tag'].'</img><p>'. $row["name"].'</div>';
            
        }
        
    }
    
    ?> </div>

                    <div id="Seoul" class="subCont">
                        <?php
    
    $sql = "SELECT  img_link,Ride.name, Ride.ride_id FROM User,Ride,User_like, Ride_img where Ride.ride_id >200 && Ride.ride_id<300  and (Ride.ride_id= Ride_img.ride_id) and User_like.user_id=User.user_id and Ride.ride_id=User_like.ride_id and User.name='$myID'";
    
    $result = $conn->query($sql);
    
    
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            
            $sql1 = "SELECT User_like.ride_id FROM User_like where User_like.ride_id=$row[ride_id] ";
            $result_set = mysqli_query($conn, $sql1);
            $count = mysqli_num_rows($result_set);
            
            $sql2= "select  hash_tag from HashTag where ride_id=$row[ride_id]  and count in  (select max(count) from HashTag where ride_id=$row[ride_id])";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = $result2->fetch_assoc();
            
            
            ?>
                        
            <div class="column">
	              <a href="http://localhost/inform_4.php?value=<?php echo($row['ride_id'])?>">
                      <?php
                echo'
            <img src="' . $row['img_link'] . '" /><br />
            
            
            
            </a>
            
            &nbsp&nbsp&nbsp&nbsp<img id="n" src="/img/love.png" >&nbsp&nbsp'.$count.'&nbsp&nbsp&nbsp&nbsp'. $row2['hash_tag'].'</img><p>'. $row["name"].'</div>';
            
        }
        
    }
    ?>

                    </div>



                    <div id="Ever" class="subCont">
                        <?php
    
    $conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
    
    
    $sql = "SELECT  img_link,Ride.name, Ride.ride_id FROM User,Ride,User_like, Ride_img where Ride.ride_id >300 && Ride.ride_id<400  and (Ride.ride_id= Ride_img.ride_id) and User_like.user_id=User.user_id and Ride.ride_id=User_like.ride_id and User.name='$myID'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            
            $sql1 = "SELECT User_like.ride_id FROM User_like where User_like.ride_id=$row[ride_id] ";
            $result_set = mysqli_query($conn, $sql1);
            $count = mysqli_num_rows($result_set);
           ?>
                        
            <div class="column">
	              <a href="http://localhost/inform_4.php?value=<?php echo($row['ride_id'])?>">
                      <?php
                echo'
            <img src="' . $row['img_link'] . '" /><br />
            
            </a>
            &nbsp&nbsp&nbsp&nbsp<img id="n" src="/img/love.png" >&nbsp&nbsp'.$count.'</img><p>'. $row["name"].'</div>';
            
        }
        
    }
    
    
    ?>
                    </div>
                </div>


                <div id="RecCourse" class="content">
                    </br>
                    &nbsp
                    <img  height=" 23" width="23" src="/img/ma.png">&nbsp 놀이기구 스탬프를 보여줍니다. 리뷰를 해보세요
                    <p>
                        <select name="course" onchange="selectCont(this, 'S')" onload="selectCont(this, 'S')">
                            <option value="X" selected>놀이공원</option>
                            <option value="Lotte">롯데월드</option>
                            <option value="Ever">에버랜드</option>
                            <option value="Seoul">서울랜드</option>
                        </select>


                    </p>


                    <div id="LotteS" class="subContS">

                        <?php
    
    
    $myID = $_SESSION['user_id'];
    
    
    
    
    $sql1 = "SELECT img_link,Ride.ride_id, name FROM Ride, Ride_img WHERE (Ride.ride_id >400 )and (Ride.ride_id= Ride_img.ride_id) and Ride.ride_id NOT IN (SELECT ride_id FROM Review,User where  User.name='$myID' )";
    
    
    $sql2 = "SELECT Ride_img.ride_id ,img_link FROM Review,Ride_img,User WHERE (Review.ride_id >400)and Review.ride_id=Ride_img.ride_id and User.user_id=Review.user_id and User.name='$myID'" ;
    $result2 = $conn->query($sql2);
    $result = $conn->query($sql1);
    
    ?>

                        <?php
    //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
    while($row = $result->fetch_assoc()  ) {
        
        
        ?>


                        <div class="column1">


                            <?php
    
    
    Echo ' <img  class="image" src="' . $row['img_link'] .' " />';
    
    
    
    
    
    ?>
                            <div class="middle">
                                <div class="text"><?php
    Echo  $row['name'];
    ?></div>
                            </div>
                        </div>

                        <?php
    }
    ?>


                        <?php
    //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
    while($row2 = $result2->fetch_assoc()  ) {
        
        
        ?>


                        <div class="column2">


                            <?php
    
    
    Echo ' <img  class="image1" src="' . $row2['img_link'] .' " />';
    
    ?>


                        </div>

                        <?php
    }
    ?>

                    </div>



                    <div id="SeoulS" class="subContS">

                        <?php
    
    
    $myID = $_SESSION['user_id'];
    
    
    
    
    $sql1 = "SELECT img_link,Ride.ride_id, name FROM Ride, Ride_img WHERE (Ride.ride_id >200 && Ride.ride_id <300)and (Ride.ride_id= Ride_img.ride_id) and Ride.ride_id NOT IN (SELECT ride_id FROM Review,User where  User.name='$myID' )";
    
    
    $sql2 = "SELECT Ride_img.ride_id ,img_link FROM Review,Ride_img,User WHERE (Review.ride_id >200 && Review.ride_id <300)and Review.ride_id=Ride_img.ride_id and User.user_id=Review.user_id and User.name='$myID'" ;
    $result2 = $conn->query($sql2);
    $result = $conn->query($sql1);
    
    ?>

                        <?php
    //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
    while($row = $result->fetch_assoc()  ) {
        
        
        ?>


                        <div class="column1">


                            <?php
    
    
    Echo ' <img  class="image" src="' . $row['img_link'] .' " />';
    
    
    
    
    
    ?>
                            <div class="middle">
                                <div class="text"><?php
    Echo  $row['name'];
    ?></div>
                            </div>
                        </div>

                        <?php
    }
    ?>


                        <?php
    //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
    while($row2 = $result2->fetch_assoc()  ) {
        
        
        ?>


                        <div class="column2">


                            <?php
    
    
    Echo ' <img  class="image1" src="' . $row2['img_link'] .' " />';
    
    
    
    
    
    ?>


                        </div>

                        <?php
    }
    ?>

                    </div>


                    <div id="EverS" class="subContS">

                        <?php
    
    
    $myID = $_SESSION['user_id'];
    
    
    
    
    $sql1 = "SELECT img_link,Ride.ride_id, name FROM Ride, Ride_img WHERE (Ride.ride_id >300 && Ride.ride_id <400)and (Ride.ride_id= Ride_img.ride_id) and Ride.ride_id NOT IN (SELECT ride_id FROM Review,User where  User.name='$myID' )";
    
    
    $sql2 = "SELECT Ride_img.ride_id ,img_link FROM Review,Ride_img,User WHERE (Review.ride_id >300 && Review.ride_id <400)and Review.ride_id=Ride_img.ride_id and User.user_id=Review.user_id and User.name='$myID'" ;
    $result2 = $conn->query($sql2);
    $result = $conn->query($sql1);
    
    ?>

                        <?php
    //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
    while($row = $result->fetch_assoc()  ) {
        
        
        ?>


                        <div class="column1">


                            <?php
    
    
    echo ' <img  class="image" src="' . $row['img_link'] .' " />';
    
    
    
    
    ?>
                            <div class="middle">
                                <div class="text"><?php
    echo  $row['name'];
    ?></div>
                            </div>
                        </div>

                        <?php
    }
    ?>


                        <?php
    //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
    while($row2 = $result2->fetch_assoc()  ) {
        
        
        ?>


                        <div class="column2">


                            <?php
    
    
    Echo ' <img  class="image1" src="' . $row2['img_link'] .' " />';
    
    
    
    ?>


                        </div>

                        <?php
    }
    ?>

                    </div>

                </div>

                <div id="myReview" class="content">


                    <div id="Rev" class="subContRev">



                        <?php
 
  /* 검색 변수 */
  $catagory = $_GET['catgo'];
  $search_con = $_GET['search'];
?>
                        </br> --> <?php echo $catagory; ?>에서 '<?php echo $search_con; ?>' 검색결과
<?php
if($catagory == 'user_id')
{
    $sql2 = "SELECT hash_tag,Ride.name, title,User.user_id,date, Ride.ride_id FROM Review, Ride, User where Ride.ride_id=Review.ride_id and User.name='$myID' and Review.user_id=User.user_id ;";

}
else{
  $sql2 = "select hash_tag,Ride.name, title,User.user_id,date, Ride.ride_id from Review, Ride,User where User.name='$myID' and Review.ride_id= Ride.ride_id and $catagory like '%$search_con%'";
}
$result = $conn->query($sql2);              
if($result->num_rows >=1){
    ?>
                    </br>
                            &nbsp&nbsp
                            <img height="23" width="23" src="/img/ma.png">&nbsp내가 작성한 리뷰
                            </br></br>
                    <table class="list-table" align="center">
                            <thead>
                                <tr>
                                    <th width="70">번호</th>
                                    <th width="500">제목</th>
                                    <th width="120">해시태그</th>
                                    <th width="100">작성일</th>
                                </tr>
                            </thead>
                        <?php
    while($board = $result->fetch_array()){
        $title=$board["title"]; 
        if(strlen($title)>30)
        { 
            $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
        }        
        ?>
        <tbody>
            <tr>
                <td width="70"><?php echo $board['name']; ?></td>
                <td width="500">
        <?php 
              $lockimg = "<img src='/img/lock.png' alt='lock' title='lock' with='20' height='20' />";
              if($board['user_id'])
              { ?>
                <form method="post"><a href="reWrite.php?ride=<?php echo $board['ride_id'];?>"><?php echo $title; ?></a></form>
                <?php 
              }else{   
                $boardtime = $board['date']; 
                $timenow = date("Y-m-d");           
                if($boardtime==$timenow){
                    $img = "<img src='/img/new.png' alt='new' title='new' />";
                }else{
                    $img ="";
                }
      ?>
                <span style="background:yellow;"><?php echo $title; }?></span>
                <span class="re_ct"></span></a></td>
                <td width="120"><?php echo $board['hash_tag']?></td>
                <td width="100"><?php echo $board['date']?></td>

            </tr>
        </tbody>

    <?php }
}else{
    ?>
<p>검색하신 내용에 대해 작성한 리뷰가 없습니다.</p>
<?php
}
?>

                        </table>
                        <!-- 18.10.11 검색 추가 -->
                        <div align="center" id="search_box2">
                            </br>
                            <form action="yy.php" method="get">
                                <select name="catgo">
                                    <option value="user_id">전체</option>
                                    <option value="title">제목</option>
                                    <option value="hash_tag">해시태그</option>
                                </select>

                                </select>

                                <input type="text" name="search" size="40" /> <button>검색</button> </form>


                        </div>
                    </div>
                    <script>
                        function selectCont(obj, opt) {
                            var subContent, i;
                            var value = obj.value;
                            subContent = document.getElementsByClassName("subCont" + opt);
                            for (i = 0; i < subContent.length; i++) {
                                subContent[i].style.display = "none";
                            }
                            if (value == "aa") {
                                for (i = 0; i < subContent.length; i++) {
                                    subContent[i].style.display = "none";
                                }
                            }

                            if (value == "X") {
                                for (i = 0; i < subContent.length; i++) {
                                    subContent[i].style.display = "block";
                                }
                            } else {
                                if (value != "aa")
                                    document.getElementById(value + opt).style.display = "block";
                            }
                        }

                        function init() {
                            var btn;
                            btn = document.getElementById("default");
                            btn.click();
                        }

                        function openMenu(target, evt) {

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
                        
                    </script>
</body>

</html>
