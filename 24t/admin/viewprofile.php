<?php  
 //login_success.php 
 require_once('db.php');
 try{
    if (isset($_GET['tutor']) && isset($_POST['submit'])){
        $stmt_tutor = $conn->prepare("UPDATE `tutor` SET `t_zip`=:zip,`t_addr`=:addr , `t_birthdate`=:bd , `t_gender`=:gd , `t_travel`=:tv , `t_intro`=:intro , `t_job`=:job , `t_qualifications`=:ql , `t_district`=:dst WHERE `tutor_id` =:id");
        $stmt_tutor->bindParam(':zip', $_POST["zip"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':addr', $_POST["address"], PDO::PARAM_STR);
        $stmt_tutor->bindParam(':bd', $_POST["birthd"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':gd', $_POST["gender"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':tv', $_POST["travel"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':intro', $_POST["intro"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':job', $_POST["job"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':ql', $_POST["qualify"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':dst', $_POST["dist"] , PDO::PARAM_STR);
        $stmt_tutor->bindParam(':id', $_GET['tutor'] , PDO::PARAM_STR);
        
        $stmt_tutor->execute();
     }
     if (isset($_GET['student']) && isset($_POST['submit'])){
        $stmt_stud = $conn->prepare("UPDATE `student` SET `stud_zip`=:zip , `stud_addr`=:addr , `stud_birthdate`=:bd , `stud_gender`=:gd , `stud_travel`=:tv , `stud_intro`=:intro , `stud_district`=:dst WHERE `stud_id`=:id");
        $stmt_stud->bindParam(':zip',  $_POST["zip"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':addr',  $_POST["address"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':bd',  $_POST["birthd"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':gd',  $_POST["gender"], PDO::PARAM_STR);
        $stmt_stud->bindParam(':tv', $_POST["travel"] , PDO::PARAM_STR);
        $stmt_stud->bindParam(':intro', $_POST["intro"] , PDO::PARAM_STR);
        $stmt_stud->bindParam(':dst', $_POST["dist"] , PDO::PARAM_STR);
        $stmt_stud->bindParam(':id',  $_GET['student'], PDO::PARAM_STR);
        
        $stmt_stud->execute();
        }
        }
    
        catch(PDOException $e){
        {
        echo "Error: " . $e->getMessage();
        }
      }


 if(isset($_GET['student']) && ctype_digit($_GET['student']) || isset($_GET['tutor']) && ctype_digit($_GET['tutor']) ) 
 {  
    
    try {
        $zip ="";
     if ( isset($_GET['tutor']) && $_GET['tutor'] != ""){
        $stmt_tutor = $conn->prepare("SELECT * FROM tutor WHERE tutor_id=:id");
        $stmt_tutor->bindParam(':id',$_GET['tutor'], PDO::PARAM_STR);
        $stmt_tutor->execute();
        $results1 = $stmt_tutor->fetch(PDO::FETCH_ASSOC);
        $resusrn = $results1['t_usrn'];
        $resemail = $results1['t_email'];
        $res = $results1['t_zip'];
        $res2 = $results1['t_addr'];
        $checked = $results1['t_checked_date'];
        
        $res4 = $results1['t_qualifications'];
        $res5 = $results1['t_district'];
        $resName = $results1['t_fname'].' '.$results1['t_lname'];
        $resTravel = $results1['t_travel'];
        $resGend = $results1['t_gender'];
        $resIntro = $results1['t_intro'];
        $resBirthd = $results1['t_birthdate'];
        $resgisterD = $results1['t_registerdate'];
        $resJob = $results1['t_job'];
        $resP = $results1['t_phone'];
        $find ="../uploads/".$results1['t_profilepic']; 
        $forpost = "tutor=".$_GET['tutor'];
      //DEBUG  echo "true<br>";
     }
     if (isset($_GET['student']) && $_GET['student'] != ""){
        $stmt_stud = $conn->prepare("SELECT * FROM student WHERE stud_id=:id");
        $stmt_stud->bindParam(':id', $_GET['student'], PDO::PARAM_STR);
        $stmt_stud->execute();
        $results1 = $stmt_stud->fetch(PDO::FETCH_ASSOC);
        $resusrn = $results1['stud_usrn'];
        $resemail = $results1['stud_email'];
        $res = $results1['stud_zip'];
        $res2 = $results1['stud_addr'];
        
        $res5 = $results1['stud_district'];
        $resName = $results1['stud_fname'].' '.$results1['stud_lname'];
        $resTravel = $results1['stud_travel'];
        $resGend = $results1['stud_gender'];
        $resIntro = $results1['stud_intro'];
        $resgisterD = $results1['stud_registerdate'];
        $resBirthd = $results1['stud_birthdate'];
        $resP = $results1['stud_phone'];
 
        $find = "../uploads/".$results1['stud_profilepic']; 
        $forpost = "student=".$_GET['student'];
    }
    }
    catch(PDOException $e){
        {
        echo "Error: " . $e->getMessage();
        }
    }

 }

 ?>  


 <html>
     <style>
body {
     overflow-y: scroll; 
     background:#123a5d;
}
#wrapper {
    width: 100%;
    background:#123a5d;
}

#page-wrapper {
    padding: 15px 15px;
    min-height: 600px;
    background:#E5EBF2;
   
}
#page-inner {
    width:100%;
    margin:10px 20px 10px 0px;
    background-color:transparent;
    padding:10px;
    min-height:1200px;
}

.text-center {
    text-align:center;
}
.no-boder {
    border:1px solid #f3f3f3;
}

h1, .h1, h2, .h2, h3, .h3 {
margin-top: 7px;
margin-bottom: -5px;
}
h2 {
    color: #000;
}
h4 {
    padding-top:10px;
}
.square-btn-adjust {
border: 0px solid transparent; 
-webkit-border-radius: 0px;
-moz-border-radius: 0px;
border-radius: 0px;

}
p {
    font-size:16px;
    line-height:25px;
    padding-top:20px;
}
/*----------------------------------------------
   DASHBOARD STYLES    
------------------------------------------------*/
.page-header {
padding-bottom: 9px;
margin: 10px 0 45px;
border-bottom: 1px solid #C7D1DD;
}
.panel-back {
    background-color:#fff;

}
.panel-default > .panel-heading {
color: #000;
background-color: #FFFFFF;
border-color: #ddd;
font-weight:bold;
}
.jumbotron, .well{
background:#fff;
}
   .noti-box {
min-height: 100px;
padding: 20px;
}

    .noti-box .icon-box {
display: block;
float: left;
margin: 0 15px 10px 0;
width: 70px;
height: 70px;
line-height: 75px;
vertical-align: middle;
text-align: center;
font-size: 40px;
}
.text-box p{
    margin: 0 0 3px;
}
.main-text {
    font-size: 25px;
    font-weight:600;
}
.set-icon {
-webkit-border-radius: 50px;
-moz-border-radius: 50px;
border-radius: 50px;

}
    .bg-color-green {
background-color: #fff;
color: #5cb85c;
}
 .bg-color-blue {
background-color: #fff;
color: #4CB1CF
}
  .bg-color-red {
background-color: #fff;
color:#F0433D;
}
  .bg-color-brown {
background-color: #fff;
color:#f0ad4e;
}
.back-footer-green {
background-color: #5cb85c;
color:#fff;
border-top: 0px solid #fff;
}
 .back-footer-red {
background-color: #F0433D;
color:#fff;
border-top: 0px solid #fff;
}
 .back-footer-blue {
background-color: #4CB1CF;
color:#fff;
border-top: 0px solid #fff;
}
 .back-footer-brown {
background-color: #f0ad4e;
color:#fff;
border-top: 0px solid #fff;
}
 .icon-box-right {
display: block;
float: right;
margin: 0 15px 10px 0;
width: 70px;
height: 70px;
line-height: 75px;
vertical-align: middle;
text-align: center;
font-size: 40px;
}

 .main-temp-back {
background: #8702A8;
color: #FFFFFF;
font-size: 16px;
font-weight: 300;
text-align: center;
}
 .main-temp-back .text-temp {
font-size: 40px;
}
.back-dash {
    padding:20px;
    font-size:20px;
    font-weight:500;
  -webkit-border-radius: 0px;
-moz-border-radius: 0px;
border-radius: 0px;
background-color:#2EA7EB;
color:#fff;
}
    .back-dash p {
        padding-top:16px;
        font-size:13px;
        color:#fff;
        line-height:25px;
        text-align:justify;
    }

     .color-bottom-txt {
   color: #000;
font-size: 16px;
line-height: 30px;
}
         </style>
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16"> </head>
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
<div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">24hrs Tutor</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                 
                <!-- /.dropdown -->
            </ul>
        </nav>
<br><br><br>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<body>
<div class="container">
<div class="row">
    <div class="col-sm-3">
    
       
        <!-- tabs -->
        <div class="card" style="width: 1080px;">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                <?php if (isset($_GET['student'])){
                    echo "Student Profile";
                }else {echo "Tutor Profile";}
                ?></a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Description</a></li>
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
                          
                            <img class="w3-hover-opacity" src="<?php echo $find?>" width="128" height="128"/>
                            <figcaption class="text-center"></figcaption>
                          
                        </div>
                        <div class="col-md-10 col-sm-10">
                          <div class="panel panel-default arrow left">
                            <div class="panel-body">
                              <header class="text-left">
                                <div class="comment-user"><i class="fa fa-user">
                                  <?php
                                   echo '</i></div>';
                                ?>
                                Register date:<time class="comment-date" datetime=""><i class="fa fa-clock-o"></i> <?php echo $resgisterD;?></time>
                              </header>
                              <div class="comment-post">
                              <?php 
                                    if ($resP !="0"){$a = "0";}else{$a = "";$resP = "";} 
                                    if ($res =="0"){$res = "";}
                                    if (isset($_GET['tutor'])){
                                    if (isset($_GET['tutor']) && $results1['t_officialcheck'] ==="1"){
                                        echo " <label>Official Verify Date: $checked</label><br>";
                                    }else{
                                        echo "<label><i class='fas fa-exclamation-triangle'></i>  Account not verify yet</label><br>";
                                    }
                                    }
                                    echo "<label>Fullname : $resName</label><br>";
                                    echo "<label>Username : $resusrn</label><br>";
                                    echo "<label>Email : $resemail</label><br>";
                                    echo"<form action ='viewprofile.php?$forpost' method='POST'>";
                                    echo " <div class='form-group'><label class='col-sm-4 control-label'>Zip Code</label><br>
                                    <input type='text' id='zip' pattern='\d*' placeholder='Zip Number' class='form-control' name='zip' value='$res' maxlength='5'>
                                    </div>";
                                    echo " <div class='form-group'><label class='col-sm-4 control-label'>District</label><br>
                                    <input type='text'  class='form-control' name='dist' value='$res5' maxlength='50'>
                                    </div>";
                                    echo "<div class='form-group'><label class='col-sm-4 control-label'>Address</label><br>
                                    <textarea name='address'  rows='3' cols='50' class='form-control' >$res2</textarea></div>";
                                    echo "<div class='form-group'><label class='col-sm-4 control-label'>Phone Numbers</label><br>
                                    <input type='tel' id='phone'pattern='\d*' placeholder='Mobile Phone Number' class='form-control' name='phone' maxlength='10' value='$a$resP' maxlength='10'>
                                    </div>";
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
                                    if (isset($_GET['tutor'])){
                                        echo " <label class='col-sm-4 control-label'>Occupation</label><br>
                                        <input type='text' name='job' value='$resJob' maxlength='70' class='form-control'>
                                        <br>";
                                        echo "<label class='col-sm-4 control-label'>Education & Experience</label><br>
                                            <textarea name='qualify'  rows='3' cols='50' class='form-control'>$res4</textarea><br>";
                                    }
                                    //echo "<input type='hidden' name='csrf' value='$csrf'>" ;
                                    echo  "<hr>";
                                    if ( isset($_GET['fail']) && $_GET['fail'] == 1 ){
                                        echo '<script language="javascript">';
                                        echo 'alert("Only Accept PNG or JPG format with 2,000,000KB")';
                                        echo '</script>';
                                    }
                              ?>
                              </div>
                              <p class="text-right"><button type="submit" name="submit" class="btn btn-default" aria-label="Left Align" title="Save Changes">
                                <span class="far fa-save fa-lg fa-3x" aria-hidden="true"></span>
                                    </button> </p>
                            </div>
                          </div>
                        </div>
                      </article>      
                    </section>
                </div><?php $stud =""; if (isset($_GET['student']) && $_GET['student'] !=""){$stud="&stud=1";}?>
                
                <div role="tabpanel" class="tab-pane" id="messages"><textarea name='intro' width='804px' rows='20' cols='100' ><?php echo $resIntro  ?> </textarea><br></div> </form>
                <div role="tabpanel" class="tab-pane" id="settings"><form method="POST" action="upload_image.php" enctype="multipart/form-data">
                <label>Profile Image:</label><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                <div>
                <i class="fa fa-camera-retro fa-5x"></i><input type="file" name="uploaded">
                </div>
                <div>
                    <input type="submit" name="Upload" value="Upload">
                </div>
            </form>
            </div>
            </div>
        </div>
        <!-- tabs -->
    </div>
</div>

</body>
</html>


<!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, .
when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
 but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of 
 Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. -->