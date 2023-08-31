<?php  
 //login_success.php 
 require_once('db.php');



  //DEBUG   echo "running";
    try{
    if ($_SESSION["actype"] ==="tutor"){
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
     if ($_SESSION["actype"] ==="student"){
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
print_r($_GET);

 if(isset($_GET['student']) && ctype_digit($_GET['student']) || isset($_GET['tutor']) && ctype_digit($_GET['tutor']) ) 
 {  
    ECHo "running";
    try {
        $zip ="";
     if ( isset($_GET['tutor']) && $_GET['tutor'] != ""){
        $stmt_tutor = $conn->prepare("SELECT * FROM tutor WHERE tutor_id=:id");
        $stmt_tutor->bindParam(':id',$_GET['tutor'], PDO::PARAM_STR);
        $stmt_tutor->execute();
        $results1 = $stmt_tutor->fetch(PDO::FETCH_ASSOC);
        $res = $results1['t_zip'];
        $res2 = $results1['t_addr'];
        
        $res4 = $results1['t_qualifications'];
        $res5 = $results1['t_district'];
        $resName = $results1['t_fname'].' '.$results1['t_lname'];
        $resTravel = $results1['t_travel'];
        $resGend = $results1['t_gender'];
        $resIntro = $results1['t_intro'];
        $resBirthd = $results1['t_birthdate'];
        $resgisterD = $results1['t_registerdate'];
        $resJob = $results1['t_job'];
        $find ="../uploads/".$results1['t_profilepic']; 
        var_dump($results1);
      //DEBUG  echo "true<br>";
     }
     if (isset($_GET['student']) && $_GET['student'] != ""){
        $stmt_stud = $conn->prepare("SELECT * FROM student WHERE stud_id=:id");
        $stmt_stud->bindParam(':id', $_GET['student'], PDO::PARAM_STR);
        $stmt_stud->execute();
        $results1 = $stmt_stud->fetch(PDO::FETCH_ASSOC);
        $res = $results1['stud_zip'];
        $res2 = $results1['stud_addr'];
        
        $res5 = $results1['stud_district'];
        $resName = $results1['stud_fname'].' '.$results1['stud_lname'];
        $resTravel = $results1['stud_travel'];
        $resGend = $results1['stud_gender'];
        $resIntro = $results1['stud_intro'];
        $resgisterD = $results1['stud_registerdate'];
        $resBirthd = $results1['stud_birthdate'];
 
        $find = "../uploads/".$results1['stud_profilepic']; 
      //DEBUG  echo "true1";
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


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<body>
<div class="container">
<div class="row">
    <div class="col-sm-3">
    
       
        <!-- tabs -->
        <div class="card" style="width: 1080px;">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Tutor Info</a></li>
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
                          
                            <img class="w3-hover-opacity" src="<?php echo $find ?>" width="128" height="128"/>
                            <figcaption class="text-center"></figcaption>
                          
                        </div>
                        <div class="col-md-10 col-sm-10">
                          <div class="panel panel-default arrow left">
                            <div class="panel-body">
                              <header class="text-left">
                                <div class="comment-user"><i class="fa fa-user">
                                <time class="comment-date" datetime=""><i class="fa fa-clock-o"></i> <?php echo $resgisterD;?></time>
                              </header>
                              <div class="comment-post">
                              <?php 
                                    echo"<form action ='viewprofile.php' method='POST'>";
                                    echo " <label>Zip Code:</label><br>
                                    <input type='text' name='zip' value='$res' maxlength='5'>
                                    <br>";
                                    echo " <label>District:</label><br>
                                    <input type='text' name='dist' value='$res5' maxlength='50'>
                                    <br>";
                                    echo "<label>Address:</label><br>
                                    <textarea name='address'  rows='3' cols='50' >$res2</textarea><br>";
                                    echo "<label>Birth Date :</label><br> <input type='date' min='1960-12-31' max='2010-12-31' id='meeting' name='birthd' value='$resBirthd' /><br>";
                                    switch($resGend)
                                    {
                                      case "F": $redir = "emale"; break;
                                      case "M": $redir = "ale"; break;
                                      case "O": $redir = "ther"; break;
                                      case "": $redir = "None"; break;
                                      default:; exit(); break;
                                    }
                                    echo "<label>Gender :</label><br>
                                        <select name='gender'>
                                             <option >$resGend$redir </option>
                                             <option value='M'>Male</option>
                                             <option value='F'>Female</option>
                                             <option value='O'>Others</option>
                                        </select>   <br><br>";
                                    echo "Travel Distance <span id='sliderStatus'>$resTravel</span> km
                                    <br><input type='range' min='0' max='50' value='$resTravel' step='1' name='travel' onChange='sliderChange(this.value)' />
                                            <br /><br />";
                                    if (isset($_GET['tutor'])){
                                        echo " <label>Occupation:</label><br>
                                        <input type='text' name='job' value='$resJob' maxlength='70'>
                                        <br>";
                                        echo "<label>Education & Experience :</label><br>
                                            <textarea name='qualify'  rows='3' cols='50' >$res4</textarea><br>";
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
                              <p class="text-right"><button type="submit" name="submit" class="btn btn-default" aria-label="Left Align" title="Save Changes">
                                <span class="far fa-save fa-lg fa-3x" aria-hidden="true"></span>
                                    </button> </p>
                            </div>
                          </div>
                        </div>
                      </article>      
                    </section>
                </div><?php $stud =""; if ($_GET['student']==="student"){$stud="&stud=1";}?>
                
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