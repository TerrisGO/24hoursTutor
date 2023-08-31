<?php  
 //login_success.php 
 require_once('db.php');
 session_start();
 require_once("checkbook.php"); 
 require_once("csrf.php");
 $old_sessionid = session_id();
 session_regenerate_id();
 //var_dump($_SESSION);
$target_path   = 'uploads/';

if (isset($_POST["submit"])){
  if (hash_equals($csrf, $_POST['csrf'])) {
  //DEBUG   echo "running";
    try{
    if ($_SESSION["actype"] ==="tutor"){
        $stmt_tutor = $conn->prepare("UPDATE `tutor` SET `t_zip`=:zip,`t_addr`=:addr ,`t_phone`=:pho , `t_birthdate`=:bd , `t_gender`=:gd , `t_travel`=:tv , `t_intro`=:intro , `t_job`=:job , `t_qualifications`=:ql , `t_district`=:dst WHERE `tutor_id` =:id");
        $stmt_tutor->bindParam(':zip', $_POST["zip"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':addr', $_POST["address"], PDO::PARAM_STR);
        $stmt_tutor->bindParam(':pho', $_POST["phone"], PDO::PARAM_STR);
        $stmt_tutor->bindParam(':bd', $_POST["birthd"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':gd', $_POST["gender"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':tv', $_POST["travel"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':intro', $_POST["intro"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':job', $_POST["job"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':ql', $_POST["qualify"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':dst', $_POST["dist"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':id', $_SESSION["identity"] , PDO::PARAM_STR);
        
        $stmt_tutor->execute();
     }
     if ($_SESSION["actype"] ==="student"){
        $stmt_stud = $conn->prepare("UPDATE `student` SET `stud_zip`=:zip , `stud_addr`=:addr ,`stud_phone`=:pho , `stud_birthdate`=:bd , `stud_gender`=:gd , `stud_travel`=:tv , `stud_intro`=:intro , `stud_district`=:dst WHERE `stud_id`=:id");
        $stmt_stud->bindParam(':zip',  $_POST["zip"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':addr',  $_POST["address"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':pho', $_POST["phone"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':bd',  $_POST["birthd"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':gd',  $_POST["gender"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':tv', $_POST["travel"] , PDO::PARAM_STR);
        $stmt_stud->bindParam(':intro', $_POST["intro"] , PDO::PARAM_STR);
        $stmt_stud->bindParam(':dst', $_POST["dist"] , PDO::PARAM_STR);
        $stmt_stud->bindParam(':id',  $_SESSION["identity"], PDO::PARAM_STR);
        
        $stmt_stud->execute();
        }
        }
    
        catch(PDOException $e){
        {
        echo "Error: " . $e->getMessage();
        }
      }
    } else{
  echo 'CSRF Token Failed!';
}
}

 if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
 {  

    try {
        $zip ="";
     if ($_SESSION["actype"] ==="tutor"){
        $stmt_tutor = $conn->prepare("SELECT * FROM tutor WHERE tutor_id=:id");
        $stmt_tutor->bindParam(':id', $_SESSION["identity"], PDO::PARAM_STR);
        $stmt_tutor->execute();
        $results1 = $stmt_tutor->fetch(PDO::FETCH_ASSOC);
        $res = $results1['t_zip'];
        $res2 = $results1['t_addr'];
        $res3 = $results1['t_profilepic'];
        $res4 = $results1['t_qualifications'];
        $res5 = $results1['t_district'];
        $resName = $results1['t_fname'].' '.$results1['t_lname'];
        $resTravel = $results1['t_travel'];
        $resGend = $results1['t_gender'];
        $resIntro = $results1['t_intro'];
        $resBirthd = $results1['t_birthdate'];
        $resgisterD = $results1['t_registerdate'];
        $resJob = $results1['t_job'];
        $approval = $results1['t_officialcheck'];
        $find =$target_path.$results1['t_profilepic'];
        $resP = $results1['t_phone'];
        if ($res3 =="" || !file_exists( $find )){
          $res3 = "default.png";
        }
      //DEBUG  echo "true<br>";
     }
     if ($_SESSION["actype"] ==="student"){
        $stmt_stud = $conn->prepare("SELECT * FROM student WHERE stud_id=:id");
        $stmt_stud->bindParam(':id', $_SESSION["identity"], PDO::PARAM_STR);
        $stmt_stud->execute();
        $results1 = $stmt_stud->fetch(PDO::FETCH_ASSOC);
        $res = $results1['stud_zip'];
        $res2 = $results1['stud_addr'];
        $res3 = $results1['stud_profilepic'];
        $res5 = $results1['stud_district'];
        $resName = $results1['stud_fname'].' '.$results1['stud_lname'];
        $resTravel = $results1['stud_travel'];
        $resGend = $results1['stud_gender'];
        $resIntro = $results1['stud_intro'];
        $resgisterD = $results1['stud_registerdate'];
        $resBirthd = $results1['stud_birthdate'];
        $resP = $results1['stud_phone'];
        $find =$target_path.$results1['stud_profilepic'];
        if ($res3 =="" || !file_exists( $find )){
          $res3 = "default.png";
        }
      //DEBUG  echo "true1";
    }
    }
    catch(PDOException $e){
        {
        echo "Error: " . $e->getMessage();
        }
    }

 }
 else  
 {  
      session_destroy();
      header("location:loging.php");  
 }

 $new_sessionid = session_regenerate_id(true);
 ?>  


 <html>
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> </head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/userdash.css">
<link rel="stylesheet" href="css/slidebar.css">
<link rel="stylesheet" href="css/topbar.css">
<link rel="stylesheet" href="css/w3_2.css">
<script>
function sliderChange(val) {
	// Use Ajax post to send the adjusted value to PHP or MySQL storage
	document.getElementById('sliderStatus').innerHTML = val;
}
</script>
<!-- Navbar -->
<br><br><br>
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

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<body>
<div class="container">
<div class="row">
    <div class="col-sm-3">
    
        <ul class="nav nav-pills nav-stacked nav-email shadow mb-20">
            <li class="active">
                <a href="login_success.php">
                    <i class="fa fa-inbox"></i> <?php echo $resName;?> <!--span class="label pull-right">7</span-->
                </a>
            </li>
            <li>
                <a href="searching.php"><i class="fa fa-search"></i> Searching</a>
            </li>
                <?php
                $value ="<span class='badge pull-right'>$countotal</span>";
                if ($_SESSION['actype'] ==='tutor'){
                    echo "<li><a href='setcourse.php'><i class='fa fa-sliders'></i>Set course</a></li>";
                    echo "<li><a href='match.php' title='Show all current match'><i class='fas fa-chalkboard-teacher'></i>Match$value</a></li>";
                }else{
                    echo "<li><a href='match.php'><i class='fas fa-chalkboard-teacher'></i>Match$value</a></li>";
                }
                ?>
            <li>
                <a href="calendar.php"> <i class="fa fa-calendar-o"></i> Schedule</a></li>
             <li>
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
        			<a href="chat.php" title="show my chats">
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
        							Interest
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
        <div class="card" style="width: 940px;">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">My Info</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">My Intro</a></li>
                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
            </ul>
    
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <!--<h2 class="page-header">Search Results</h2>-->
                    <section class="comment-list">
                      <!-- First Comment -->
                      <article class="row">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                          
                            <img class="w3-hover-opacity" src="uploads/<?php echo $res3?>" width="128" height="128"/>
                            <figcaption class="text-center"><?php
                                   echo '<i class="fa fa-user"></i>'.$_SESSION["actype"].'';
                                ?></figcaption>
                          
                        </div>
                        <div class="col-md-10 col-sm-10">
                          <div class="panel panel-default arrow left">
                            <div class="panel-body">
                              <header class="text-left">
                              </div>
                                <div class="comment-user">
                                <?php 
                                if ($_SESSION['actype']=="tutor" && $approval =="0"){
                                    echo "<center><label >Your account still need approval <br>Email us your resume and we will schedule time <br>for your interview on our <a href='servicecentre.php'>service centre.</a> </label></center><br>";
                                }
                                ?>
                                <label class='col-sm-4 control-label'>Create date </label><br>
                                <time  class="comment-date" datetime=""><i class="fa fa-clock-o"></i> <?php echo $resgisterD;?></time>
                              </header>
                              <br><br>
                              <div class="comment-post">
                              <?php 
                                    if ($resP !="0"){$a = "0";}else{$a = "";$resP = "";} 
                                    if ($res =="0"){$res = "";}
                                    echo"<form action ='login_success.php' id='userForm' method='POST'>";
                                    echo " <div class='form-group'><label class='col-sm-4 control-label'>Zip Code</label><br>
                                    <input type='text' id='zip' pattern='\d*' placeholder='Zip Number' class='form-control' name='zip' value='$res' maxlength='5'>
                                    <span class='errorFeedback errorSpan' id='zipError'>Format: ①②③④⑤</span></div>";
                                    echo " <div class='form-group'><label class='col-sm-4 control-label'>District</label><br>
                                    <input type='text'  class='form-control' name='dist' value='$res5' maxlength='50'>
                                    </div>";
                                    echo "<div class='form-group'><label class='col-sm-4 control-label'>Address</label><br>
                                    <textarea name='address'  rows='3' cols='50' class='form-control' >$res2</textarea></div>";
                                    echo "<div class='form-group'><label class='col-sm-4 control-label'>Phone Numbers</label><br>
                                    <input type='tel' id='phone'pattern='\d*' placeholder='Mobile Phone Number' class='form-control' name='phone' maxlength='10' value='$a$resP' maxlength='10'>
                                    <span class='errorFeedback errorSpan'  id='phoneError'>Format: ⓪①② ③④⑤ ⑥⑦⑧⑨</span></div>";
                                    echo "<div class='form-group'><label class='col-sm-4 control-label'>Birth Date</label><br> <input class='form-control' type='date' min='1960-12-31' max='2010-12-31' id='meeting' name='birthd' value='$resBirthd' /></div>";
                                    switch($resGend)
                                    {
                                      case "F": $redir = "emale"; break;
                                      case "M": $redir = "ale"; break;
                                      case "O": $redir = "ther"; break;
                                      case "": $redir = "None"; break;
                                      default:; exit(); break;
                                    }
                                    echo "<label class='col-sm-4 control-label'>Gender</label><br>
                                        <select class='form-control' name='gender'>
                                             <option >$resGend$redir </option>
                                             <option value='M'>Male</option>
                                             <option value='F'>Female</option>
                                             <option value='O'>Others</option>
                                        </select>   <br><br>";
                                    echo "<label class='col-sm-4 control-label'>Travel Distance </label><span id='sliderStatus'>$resTravel</span> km
                                    <br><input class='form-control' type='range' min='0' max='50' value='$resTravel' step='1' name='travel' onChange='sliderChange(this.value)' />
                                            <br /><br />";
                                    if ($_SESSION["actype"] ==="tutor"){
                                        echo " <label class='col-sm-4 control-label'>Occupation</label><br>
                                        <input type='text' name='job' value='$resJob' maxlength='70' class='form-control'>
                                        <br>";
                                        echo "<label class='col-sm-4 control-label'>Education & Experience</label><br>
                                            <textarea name='qualify'  rows='3' cols='50' class='form-control'>$res4</textarea><br>";
                                    }
                                    echo "<input type='hidden' name='csrf' value='$csrf'>" ;
                                    echo  "<hr>";
                                    if ( isset($_GET['fail']) && $_GET['fail'] == 1 ){
                                        echo '<script language="javascript">';
                                        echo 'alert("Only Accept PNG or JPG format with 2,000,000KB")';
                                        echo '</script>';
                                    }
                              ?>
                              </div>
                              <p class="text-right"><button type="submit" id="submit" name="submit" class="btn btn-default" aria-label="Left Align" title="Save Changes">
                                <span class="far fa-save fa-lg fa-3x" aria-hidden="true"></span>
                                    </button> </p>
                            </div>
                          </div>
                        </div>
                      </article>      
                    </section>
                </div><?php $stud =""; if ($_SESSION['actype']==="student"){$stud="&stud=1";}?>
                <div role="tabpanel" class="tab-pane" id="profile"><iframe src="profile.php?profile=<?php echo $_SESSION["identity"].$stud;?>" style="height:600px;width:600px"></iframe>                              <p class="text-right"><a href="profile.php?profile=<?php echo $_SESSION["identity"].$stud;?>" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> view full page</a></p></div>
                <div role="tabpanel" class="tab-pane" id="messages"><textarea name='intro' width='804px' rows='20' cols='100' class='form-control'><?php echo $resIntro  ?> </textarea><br></div> </form>
                <div role="tabpanel" class="tab-pane" id="settings"><form method="POST" action="upload_image.php" enctype="multipart/form-data">
                <label>Profile Image:</label><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                <div>
                <i class="fa fa-camera-retro fa-5x"></i><input class='form-control' type="file" name="uploaded">
                </div>
                <div>
                    <input type="submit" class='form-control' name="Upload" value="Upload">
                </div>
            </form>
            </div>
            </div>
            <center><h3>Any emergency or reports please kindly <a title="24hrstutor@gmail.com" href="mailto:24hrstutor@gmail.com">email</a> to us or contact our service hotline <br>H/P: 012-41165685 or else come to our <a href="servicecentre.php">service centre</a>.</h3></center>
        </div>
        <!-- tabs -->
        
    </div>
</div>
<style>
.errorFeedback {
	visibility: hidden;
}
</style>
<script>
$(document).ready(function() {
	$("#userForm").submit(function(e) {
		var errors = validateForm();
		removeFeedback();
		if (errors == "") {
			return true;
			} else {
			provideFeedback(errors);
			e.preventDefault();
			return false;
		}
	});
	
	function validateForm() {
		var errorFields = new Array();
		//Check required fields have something in them
		
		if ($('#phone').val() != "" ) {
			var phoneNum = $('#phone').val();
			phoneNum.replace(/[^0-9]/g, "");
			if (phoneNum.length != 10 ) {
				errorFields.push("phone");
			}

		}
        if ($('#zip').val() != "") {
			var zipNum = $('#zip').val();
			zipNum.replace(/[^0-9]/g, "");
			if (zipNum.length != 5 ) {
				errorFields.push("zip");
			}

		}
		
		return errorFields;
	} //end function validateForm
	
	function provideFeedback(incomingErrors) {
		for (var i = 0; i < incomingErrors.length; i++)
		{
			$("#" + incomingErrors[i]).addClass("errorClass");
			$("#" + incomingErrors[i] + "Error").removeClass("errorFeedback");
		}
		$("#errorDiv").html("Errors encountered");
	}
	function removeFeedback() {
		$("#errorDiv").html("");
		$('input').each(function() {
			$(this).removeClass("errorClass");
		});
		$('.errorSpan').each(function() {
			$(this).addClass("errorFeedback");
		});
	}
	
});
</script>
</body>
</html>


<!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, .
when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
 but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of 
 Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. -->