<?php
require_once('db.php');
session_start();
require_once("csrf.php");


 if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
 {  
  if (isset($_POST["submit"])){
        $val1 = $_POST["subject"];
        $val2 = $_POST["zip"];
        $val3 = $_POST["price-min"];
        $val4 = $_POST["price-max"];

      if ($val2 != ""){
      if (ctype_digit($val2) && preg_match('#[0-9]{5}#', $val2)){
        $query1 = "SELECT d.tutor_id ,`t_fname` ,`t_lname` , `t_profilepic`, `t_travel` , `t_job`, `t_intro` 
        FROM subject f ,subject_offer e, tutor d 
        WHERE e.subject_id =f.subject_id 
        AND f.subject_name = :subject 
        AND d.t_zip =:zip
        AND d.tutor_id = e.tutor_id 
        AND d.t_officialcheck = '1' 
        AND e.price_perhrs BETWEEN :min AND :max";
        // searching by zip code= "d.t_zip";

        $search=$conn->prepare($query1);
        $search->bindParam(':subject', $val1, PDO::PARAM_STR);
        $search->bindParam(':zip', $val2, PDO::PARAM_INT);
        $search->bindParam(':min', $val3, PDO::PARAM_INT);
        $search->bindParam(':max', $val4, PDO::PARAM_INT);
        $search->execute();
        $total = $search->rowCount(); 
      }else{
        $query1 = "SELECT d.tutor_id ,`t_fname` ,`t_lname` , `t_profilepic`, `t_travel` , `t_job`, `t_intro` 
        FROM subject f ,subject_offer e, tutor d 
        WHERE e.subject_id =f.subject_id 
        AND f.subject_name = :subject 
        AND d.t_district =:dis
        AND d.tutor_id = e.tutor_id
        AND d.t_officialcheck = '1' 
        AND e.price_perhrs BETWEEN :min AND :max";
        // searching by district = "d.district";
        $search=$conn->prepare($query1);
        $search->bindParam(':subject', $val1, PDO::PARAM_STR);
        $search->bindParam(':dis', $val2, PDO::PARAM_STR);
        $search->bindParam(':min', $val3, PDO::PARAM_INT);
        $search->bindParam(':max', $val4, PDO::PARAM_INT);
        $search->execute();
        $total = $search->rowCount();
      }
    }else{
      $query1 = "SELECT d.tutor_id ,`t_fname` ,`t_lname` , `t_profilepic`, `t_travel` , `t_job`, `t_intro` 
      FROM subject f ,subject_offer e, tutor d 
      WHERE e.subject_id =f.subject_id 
      AND f.subject_name = :subject 
      AND d.tutor_id = e.tutor_id
      AND d.t_officialcheck = '1' 
      AND e.price_perhrs BETWEEN :min AND :max";
      // searching by district = "d.district";
      $search=$conn->prepare($query1);
      $search->bindParam(':subject', $val1, PDO::PARAM_STR);
      $search->bindParam(':min', $val3, PDO::PARAM_INT);
      $search->bindParam(':max', $val4, PDO::PARAM_INT);
      $search->execute();
      $total = $search->rowCount();
    }
      
  }
  
  }
 else  
 {  
      session_destroy();
      header("location:loging.php");  
 }
 $old_sessionid = session_id();
 session_regenerate_id();
 $new_sessionid = session_regenerate_id(true);
?>
<html>
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script><!--problem here-->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"  media="screen">


<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
					var x = document.getElementById("navDemo");
					if (x.className.indexOf("w3-show") == -1) {
							x.className += " w3-show";
					} else { 
							x.className = x.className.replace(" w3-show", "");
					}
			}

			// When the user clicks anywhere outside of the modal, close it
			var modal = document.getElementById('ticketModal');
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
</script>
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<style>
    #hello1 {
	border-radius: 25px;
    border: 1px white;
    margin-top: 20px;
    margin-bottom: 100px;
    margin-right: 80px;
    margin-left: 80px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05) inset, 0px 0px 8px rgba(82, 168, 236, 0.6);
}

  #hello {
	border-radius: 25px;
    border: 1px white;
    margin-top: 100px;
    margin-bottom: 100px;
    margin-right: 150px;
    margin-left: 80px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05) inset, 0px 0px 8px rgba(82, 168, 236, 0.6);
}
#example1 {
    box-sizing: content-box;    
    width: 600px;
    height: 50px;
    padding: 30px;    
    border: 10px white;
}

body {font-family: "Lato", sans-serif}
.mySlides {display: none}
.topnav .login-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width:120px;
}

.topnav .login-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background-color: #555;
  color: white;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .login-container button:hover {
  background-color: green;
}

@media screen and (max-width: 600px) {
  .topnav .login-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .login-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-blue w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="map4.php"  data-ajax="false" class="w3-bar-item w3-button w3-padding-large"><img src="24hrs2.png" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"></a>
    <div class="topnav">
    <div class="login-container w3-hide-small">
    <form  data-ajax="false">
       <?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' data-ajax='false' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Main Menu</a>";
        }else{
          echo "<a href='registering.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Register</a>";
          echo "<a href='loging.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Login</a>";
          echo "<a href='reset.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>?</a>";
        }
       ?>
    </form>
  </div></div>
    </div>
  </div>

<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
<?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a>";
        }
       ?>
</div>

</div><br></br><br>

    <h1>Find your tutor</h1>
  </div>
   <div id="hello1">
  <div data-role="main" class="ui-content">
    <form method="post" action="searching.php" data-ajax="false">
    <div id="box" class="form-group row">
      <div class="col-xs-6">
      <label for="usr">Subject</label>
      <input type="text" class="form-control" id="subject" name="subject">
    </div>
    <div id="box" class="col-xs-6">
      <label for="pwd">ZIP Code / District Name </label>
      <input type="text" class="form-control" id="zip" name="zip">
    </div>
    </div>
      <div data-role="rangeslider" id="example1" >
        <label for="price-min">Price:</label>
        <input type="range" name="price-min" id="price-min" value="0" min="0" max="200">
        <label for="price-max">Price:</label>
        <input type="range" name="price-max" id="price-max" value="200" min="0" max="200">
      </div>
      <?php
       echo "<input type='hidden' name='csrf' value='$csrf'>" ;
        ?>
		<div class="col-md-4 text-center"> 
        <input class="button two" type="submit" id="sub" data-inline="true"  value="Search" name="submit">
        </div>
        <p><?php if(empty( $_POST["subject"]) && empty($_POST["zip"])){
        echo 'please put something in order to search';
        }else{
          echo 'Finding your best tutor on your range';
        }?></p>
      </form>
  </div>
  <div>
                    <?php 
                    if (isset($_POST["submit"])  && !empty( $_POST["subject"])){
                      echo "<h3>".$total."  total results</h3>";
                      foreach ($search as $row) {
                        echo "<div id='hello'>";
                        echo "<div class='well well-sm' >";
                        echo "<div class='media'>";
                        echo "<a class='thumbnail pull-left' href='#'>";
                        echo "<img class='media-object' src=uploads/$row[t_profilepic] style='width:120px; height:80px'></a>";
                        echo "<div class='media-body'>";
                        echo "<h3 class='media-heading'>$row[t_lname] </h3>";
                        echo "<div>$row[t_job]</div>";
                        $sub = substr($row['t_intro'], 2, 300);
                        echo "<!--p><span class='label label-info'>10 Best Review</span> <span class='label label-primary'>89 Students</span></p--><p>
                            <a href='#' class='btn btn-default btn-sm'  data-ajax='false'><span class='glyphicon glyphicon-heart'></span> Favorite</a>";
                            echo "<a href=profile.php?profile=$row[tutor_id] class='btn btn-default btn-sm'   data-ajax='false'><span class='glyphicon glyphicon-eye-open'></span> More Info</a></p>
                            <h5>$sub....</h5>
                    </div>
                </div>
            </div>
         </div>";
                    } 
                    }
                      
                    ?>
  </div>
</div> 
</body>
</html>
