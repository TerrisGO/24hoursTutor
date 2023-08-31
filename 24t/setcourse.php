<?php  
 //login_success.php 
 require_once('db.php'); 
 session_start();
 require_once("checkbook.php"); 
 require_once("csrf.php");
 $old_sessionid = session_id();
 session_regenerate_id();
 $res = "0";
 if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"] ==="tutor")  
 { 
    if(isset($_GET['del'])){
      $delval = $_GET['del'];
      $delQ = $conn->prepare('DELETE FROM `subject_offer` WHERE `subject_id`=:dl AND `tutor_id` = :id ');
      $delQ->bindParam(':dl', $delval, PDO::PARAM_INT);
      $delQ->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
      $delQ->execute();
    }
    $query = $conn->prepare('SELECT * FROM subject ORDER BY subject_name');
    $query->execute();
    $query->fetch();
    
    $query2 = $conn->prepare('SELECT c.subject_name , d.subject_id , d.offer_id , d.price_perhrs FROM subject c , subject_offer d WHERE d.tutor_id =:id AND c.subject_id = d.subject_id  ORDER BY c.subject_name');
    $query2->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
    $courses = $query2->execute();                                                 //query to show user's subjects
  } else  
  {  
       session_destroy();
       header("location:loging.php");  
  }

    if(isset($_POST['submit'])&& isset($_POST['category']) && $_POST['category'] !=='' && ctype_digit($_POST['category']) && $_POST['category'] != "0"){
      $val1 = $_POST['category'];  $val3 = $_POST['price'];  $set ='';
      try {               // Use to add or update subject price
      foreach ($query2 as $row2) {
        if ($row2['subject_id']==$val1 && coursesIDvalid($val1) && limit($val3)){
          $set = '1';
        }else if ($row2['subject_id']!==$val1 && coursesIDvalid($val1) && limit($val3)){
          $set = '0';
        }else{
          header("location:setcourse.php"); 
        }
      }
      if ($set==1){
      $addsubject = $conn->prepare("UPDATE `subject_offer` SET `price_perhrs`=:v3 WHERE `subject_id`=:v1 AND `tutor_id` =:v2");
      }else if ($set==0){
        $delQ2 = $conn->prepare('DELETE FROM `subject_offer` WHERE `subject_id`=:ct AND `tutor_id` = :id ');
        $delQ2->bindParam(':ct', $_POST['category'], PDO::PARAM_INT);
        $delQ2->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $delQ2->execute();
        $addsubject = $conn->prepare("INSERT INTO `subject_offer` (`subject_id`, `tutor_id`, `price_perhrs`) VALUES ( :v1 , :v2 , :v3)");
      }
      $addsubject->bindParam(':v1', $val1, PDO::PARAM_INT);
      $addsubject->bindParam(':v2', $_SESSION["identity"], PDO::PARAM_INT);
      $addsubject->bindParam(':v3', $val3, PDO::PARAM_INT);
      $addsubject->execute();
      header("location:setcourse.php"); 
    }
  catch(PDOException $e)
      {
      echo "Error: " . $e->getMessage();
      }
      $conn = null;
  }


 $new_sessionid = session_regenerate_id(true);


 function coursesIDvalid($val1){
 foreach ($query as $row) {
     if ($row['subject_id'] = $val1){
         return true;
     }else{
         return false;
     } // use to check whether the POST['category'] match the subject we have in subject table
 }
}

function limit($val3){
    if ($val3 >=5 || $val3 <=200){
        return true;
    }else {
        return false;
    }
}
 ?>  

<html>
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> </head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--below link is bootstrap For drop down select-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
<link rel="stylesheet" href="css/topbar.css">
<link rel="stylesheet" href="css/w3_2.css">
<style>


table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
/****Table****/
<link rel="stylesheet" href="css/userdash.css">
<link rel="stylesheet" href="css/slidebar.css">
</style>
<script>
function sliderChange(val) {
	// Use Ajax post to send the adjusted value to PHP or MySQL storage
	document.getElementById('sliderStatus').innerHTML = val;
}
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
<link rel="stylesheet" href="css/userdash.css">
<link rel="stylesheet" href="css/slidebar.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<br><br>
<div class="w3-top">
  <div class="w3-bar w3-blue w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="map4.php" class="w3-bar-item w3-button w3-padding-large"><img src="24hrs2.png" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"></a>
    <div class="topnav">
    <div class="login-container w3-hide-small">
    <form action="">
       <?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='logout.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>SignOut</a>";
        }
       ?>
    </form>
  </div></div>
    </div>
  </div>
</div>


<div class="container">
<div class="row">
    <div class="col-sm-3">
    
        <ul class="nav nav-pills nav-stacked nav-email shadow mb-20">
            <li class="active">
                <a href="login_success.php">
                    <i class="fa fa-inbox"></i> <?php echo $_SESSION["firstname"]." ".$_SESSION["lastname"] ?><span class="label pull-right">7</span>
                </a>
            </li>
            <li>
                <a href="searching.php"><i class="fa fa-search"></i> Searching</a>
            </li>
            <?php
                $value ="<span class='badge pull-right'>$countotal</span>";
                if ($_SESSION['actype'] ==='tutor'){
                    echo "<li><a href='setcourse.php'><i class='fa fa-sliders'></i>Set course</a></li>";
                    echo "<li><a href='match.php'><i class='fas fa-chalkboard-teacher'></i>Match$value</a></li>";
                }else{
                    echo "<li><a href='match.php'><i class='fas fa-chalkboard-teacher'></i>Match$value</a></li>";
                }
                ?>
            <li>
            <a href="calendar.php">
                    <i class="fa fa-calendar-o"></i> Schedule
                </a>
            </li>
            <li>
            <a href="history.php">
                    <i class="fas fa-history"></i> History <!--span class="label label-info pull-right inbox-notification">35</span-->
                </a>
             </li>
            
        </ul><!-- /.nav -->
    </div>
    <div class="col-sm-9">

        <!--  statitics -->
        <div class="row">
            <div class="col-lg-3">
            	<div class="panel panel-info">
        			<div class="panel-heading">
        				<div class="row">
        					<div class="col-xs-6">
        						<i class="fa fa-envelope-o fa-5x"></i>
        					</div>
        					<div class="col-xs-6 text-right">
                  <p class="announcement-heading label label-success"><?=$countotal2?></p>
        					<!--	<p class="announcement-text">Users</p> -->
        					</div>
        				</div>
        			</div>
        			<a href="chat.php">
        				<div class="panel-footer announcement-bottom">
        					<div class="row">
        						<div class="col-xs-6">
        							Messages
        						</div>
        						<div class="col-xs-6 text-right">
        							<i class="fa fa-arrow-circle-right"></i>
        						</div>
        					</div>
        				</div>
        			</a>
        		</div>
        	</div>
        	<div class="col-lg-3">
        		<div class="panel panel-warning">
        			<div class="panel-heading">
        				<div class="row">
        					<div class="col-xs-6">
        						<i class="fa fa-thumbs-up fa-5x"></i>
        					</div>
        					<div class="col-xs-6 text-right">
                  <p class="announcement-heading  label label-success"><?=$countotal3?></p>
        						<!-- <p class="announcement-text"> Items</p> -->
        					</div>
        				</div>
        			</div>
        			<a href="favourite.php">
        				<div class="panel-footer announcement-bottom">
        					<div class="row">
        						<div class="col-xs-6">
        							Interests
        						</div>
        						<div class="col-xs-6 text-right">
        							<i class="fa fa-arrow-circle-right"></i>
        						</div>
        					</div>
        				</div>
        			</a>
        		</div>
        	</div>
     
        </div><!-- /.row -->  
        
        <!-- tabs -->
        <div class="card">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Set Course</a></li>
            </ul>
    
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <section class="comment-list">
                    <article class="row">
                    <form action ='setcourse.php' method='POST'>
                    <div class="form-group"> 
                    <div class="col-lg-4">
                    <select id="multipleSelect1" class="selectpicker show-menu-arrow form-control" single name='category'>
                    <option value="0"> Subject </option>
                    <?php
                    foreach ($query as $row) {
                      echo "<option value='".$row['subject_id']."'>".$row['subject_name']."</option>";
                    }   
                    ?>
                    </select></div><br>
                    <h3><span class="label label-primary">
                    Rm <span id='sliderStatus'><?php echo $res;?></span>   Per Hour </span></h3>
                    <br><input class='form-control' type='range' min='5' max='200'     margin-left: 215px; value='<?php echo $res;?>' step='1' name='price' onChange='sliderChange(this.value)' />
                    <br />       
                            <div class="col-sm-offset-9 col-sm-10">
                                <button type="submit" class="btn btn-default" name="submit">Add / Edit</button>
                                </form>  
                        </div>
                      </article>      
                    </section><br>
                    <table>
                    <tr>
                      <th>Subject</th>
                      <th>Price Per Hours( RM )</th>
                    </tr>
                    <?php 
                    foreach ($query2 as $row) {
                    echo "<tr><td>".$row['subject_name']."</td> <td>".$row['price_perhrs']."</td><td> <a href='setcourse.php?del=".$row['subject_id']."'><i class='fa fa-trash'></i>Delete</a></td> </tr>";
                    }   
                    ?>
                    </table>
                </div>
               </div>
        <!-- tabs -->
    </div>
</div>

</body>
</html>