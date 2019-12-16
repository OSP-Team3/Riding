 <?php  
 //load_data.php  
 $connect = new mysqli("localhost", "root", "1234","num1");  
 $pic_output = '';  
 if(isset($_POST["display"]) || isset($_POST["rideN"])) 
 {  
      if($_POST["display"]=='count')  {
	if($_POST["rideN"]=='1') $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=1 GROUP BY ride.ride_id ORDER BY count DESC";  
	if($_POST["rideN"]=='2') $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=2 GROUP BY ride.ride_id ORDER BY count DESC";
	if($_POST["rideN"]=='3') $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=3 GROUP BY ride.ride_id ORDER BY count DESC";
	if($_POST["rideN"]=='4') $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=4 GROUP BY ride.ride_id ORDER BY count DESC";
      }  
      if($_POST["display"] == 'star') { 
	if($_POST["rideN"]=='1') $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM((((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) LEFT JOIN review on park.ride_id = review.ride_id) WHERE park.park_id=1 GROUP BY ride.ride_id ORDER BY satisfy DESC";
	if($_POST["rideN"]=='2') $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=2 GROUP BY ride.ride_id ORDER BY count DESC";
	if($_POST["rideN"]=='3') $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=3 GROUP BY ride.ride_id ORDER BY count DESC";
	if($_POST["rideN"]=='4') $sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM(((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) WHERE park.park_id=4 GROUP BY ride.ride_id ORDER BY count DESC";
      }  

      if($_POST["display"] == '2_star') {$sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM((((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) LEFT JOIN review on park.ride_id = review.ride_id) WHERE park.park_id=2 GROUP BY ride.ride_id ORDER BY satisfy DESC"; 
      }  

      if($_POST["display"] == '3_star') {$sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM((((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) LEFT JOIN review on park.ride_id = review.ride_id) WHERE park.park_id=3 GROUP BY ride.ride_id ORDER BY satisfy DESC"; 
      }  

      if($_POST["display"] == '4_star') {$sql = "SELECT DISTINCT park_id, ride.ride_id, name, img_link FROM((((park LEFT JOIN ride on park.ride_id = ride.ride_id) LEFT JOIN ride_img on park.ride_id = ride_img.ride_id) LEFT JOIN hashtag on park.ride_id = hashtag.ride_id) LEFT JOIN review on park.ride_id = review.ride_id) WHERE park.park_id=4 GROUP BY ride.ride_id ORDER BY satisfy DESC"; 
      }

      $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
      while($row = mysqli_fetch_array($result))
        {
	$pic_output .= '<div class="column"><a href="inform_4.php?value = '.$row["ride_id"].'"><img src="'.$row["img_link"].'"</a>'; 
	$pic_output .= '<p>'.$row["name"].'</p>'; 
	$pic_output .= '</div>'; 
         }
      echo $pic_output;
 }
 ?>