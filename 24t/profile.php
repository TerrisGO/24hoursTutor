<?php
 require_once('db.php'); 
 session_start();
 $target_path   = 'uploads/';
 $val ="";
if ( isset($_GET['profile']) )
{ 
  try {
  if ( !isset($_GET['stud']) ) {
    $stmt = $conn->prepare("SELECT * FROM `favourite` WHERE `stud_id` =:student AND `tutor_id` =:tutor");
    $stmt->bindParam(":tutor",$_GET['profile'], PDO::PARAM_STR);
    $stmt->bindParam(":student",$_SESSION["identity"], PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();      if($count ==0){ $val="Add Favourite";}  else  { $val="Eject Favourite";}  


       $stmt_tutor = $conn->prepare("SELECT * FROM tutor WHERE tutor_id=:id");
       $stmt_tutor->bindParam(':id', $_GET['profile'], PDO::PARAM_STR);
       $stmt_tutor->execute();
       $results1 = $stmt_tutor->fetch(PDO::FETCH_ASSOC);
       $res = $results1['t_zip'];
       $res2 = $results1['t_district'];
       $res3 = $results1['t_profilepic'];
       $res4 = $results1['t_qualifications'];
       $resName = $results1['t_fname'].' '.$results1['t_lname'];
       $resTravel = $results1['t_travel'];
       $resGend = $results1['t_gender'];
       $resIntro = $results1['t_intro'];
       $resBirthd = $results1['t_birthdate'];
       $resCreate = $results1['t_registerdate'];
       $resLastin = $results1['t_lastin'];
       $resJob = $results1['t_job'];
       $resApprove = $results1['t_officialcheck'];
       $find =$target_path.$results1['t_profilepic'];
       if ($res3 =="" || !file_exists( $find )){
         $res3 = "default.png";                                   //for showing basic profile of tutor
       }
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($resBirthd), date_create($today));
                    $age = $diff->format('%y');                         //caluculating age from birthdate

        $query2 = $conn->prepare('SELECT c.subject_name , d.subject_id , d.offer_id , d.price_perhrs FROM subject c , subject_offer d ,tutor f WHERE d.tutor_id =:id  AND f.t_officialcheck = 1 AND  c.subject_id = d.subject_id AND d.tutor_id = f.tutor_id');
        $query2->bindParam(':id', $_GET['profile'], PDO::PARAM_INT);
        $query2->execute();    
        
        $query3 = $conn->prepare('SELECT * FROM `rating` WHERE `tutor_id` =:id  AND r_stars !=0');   // show the rating messages
        $query3->bindParam(':id', $_GET['profile'], PDO::PARAM_INT);
        $query3->execute(); 
        $countrating = $query3->rowCount();
        $resultrating = $query3->fetchAll();

        if ($_SESSION['actype']==="student"){
        $stmt_stud2 = $conn->prepare("SELECT * FROM `rating` WHERE `stud_id` = :id  and`r_message` = '' AND r_stars = 0 AND `tutor_id` =:tid ORDER BY rating_id DESC LIMIT 1"); 
        $stmt_stud2->bindParam(':id', $_SESSION["identity"], PDO::PARAM_STR);
        $stmt_stud2->bindParam(':tid', $_GET['profile'], PDO::PARAM_INT);        //CHECK whether user able to rate after success book
        $stmt_stud2->execute();
        $countrating2 = $stmt_stud2->rowCount();
        $resultrating2 = $stmt_stud2->fetch(PDO::FETCH_ASSOC);
        $ratingid = $resultrating2['rating_id'];
      }

   }
   
   if (isset($_GET['stud']) && $_GET['stud'] == 1){ 
    
      $stmt_stud = $conn->prepare("SELECT * FROM student WHERE stud_id=:id"); //show student profile
      $stmt_stud->bindParam(':id', $_GET['profile'], PDO::PARAM_STR);
      $stmt_stud->execute();
      $results1 = $stmt_stud->fetch(PDO::FETCH_ASSOC);
      $res = $results1['stud_zip'];
      $res2 = $results1['stud_district'];
      $res3 = $results1['stud_profilepic'];
      $res4 = "";
      $resName = $results1['stud_fname'].' '.$results1['stud_lname'];
      $resTravel = $results1['stud_travel'];
      $resGend = $results1['stud_gender'];
      $resIntro = $results1['stud_intro'];
      $resBirthd = $results1['stud_birthdate'];
      $resCreate = $results1['stud_registerdate'];
      $resLastin = $results1['stud_lastin'];
      $resJob = "";

      $find =$target_path.$results1['stud_profilepic'];
      if ($res3 =="" || !file_exists( $find )){
        $res3 = "default.png";                                    
      }
                   $today = date("Y-m-d");
                   $diff = date_diff(date_create($resBirthd), date_create($today));
                   $age = $diff->format('%y');                         //caluculating age from birthdate
              }
            }
            catch(PDOException $e){
              {
                echo "Error: " . $e->getMessage();
              }
            }
           
  
   if ($results1 ==0){
     print_r( $results1 );
    header("location:noresults.php");  
   }
 }  
else  
{   
  //header("location:noresults.php");     
  echo "<h1>no such results</h1>";  
}

?>
<!DOCTYPE html>
<html lang="en">
    <head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/w3_2.css">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>24HoursTutor</title>
        
        <!-- Icon css link -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.8.94/css/materialdesignicons.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" rel="stylesheet">

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


@import url("https://fonts.googleapis.com/css?family=Bree+Serif|Raleway:100,200,300,400,500,600,700,800,900|Yellowtail");
.col-md-offset-right-1 {
  margin-right: 8.33333333%;
}
#myDIV {
    width: 100%;
    padding: 50px 0;
    text-align: center;
    margin-top: 10px;
}
/*---------------------------------------------------- */
/*----------------------------------------------------*/
ul {
  list-style: none;
  margin: 0px;
  padding: 0px;
}

a {
  text-decoration: none;
}

a:hover, a:focus {
  text-decoration: none;
}

.row.m0 {
  padding: 0px;
  margin: 0px;
}

body {
  line-height: 24px;
  font-size: 13px;
  color: #333333;
  font-family: "Raleway", sans-serif;
}

body.light_bg {
  background: url(../img/Pattern_Light.png) repeat scroll center center;
  background-size: contain;
}

body.dark_bg {
  background: url(../img/Pattern_Drak.png) repeat scroll center center;
  background-size: contain;
}

body .content_inner_bg {
  background: #efefef;
}

body, p, h1, h2, h3, h4, h5, h6 {
  margin: 0px;
  padding: 0px;
}

.pad {
  padding: 0px 68px;
}

#success {
  display: none;
  padding-left: 15px;
  padding-top: 10px;
}

#error {
  display: none;
  padding-left: 15px;
  padding-top: 10px;
}



/* End Header Menu Area css
============================================================================================ */
/*---------------------------------------------------- */
/*----------------------------------------------------*/
/* About Person area css
============================================================================================ */
.about_person_area {
  background: #fff;
  margin-top: 60px;
  padding-top: 40px;
  padding-bottom: 40px;
}

.about_person_area .person_img {
  max-width: 322px;
}

.about_person_area .person_img img {
  max-width: 100%;
}

.about_person_area .person_img .download_btn {
  margin-top: 40px;
}

.about_person_area .person_details {
  margin-left: -30px;
}

.about_person_area .person_details h3 {
  font-size: 36px;
  color: #333333;
  text-transform: uppercase;
  font-family: "Raleway", sans-serif;
  font-weight: bold;
  padding-bottom: 10px;
}

.about_person_area .person_details h3 span {
  color: #fec608;
}

.about_person_area .person_details h4 {
  font-size: 18px;
  font-family: "Raleway", sans-serif;
  font-weight: bold;
  color: #666666;
  padding-bottom: 15px;
}

.about_person_area .person_details p {
  font-size: 13px;
  line-height: 24px;
  color: #333333;
  font-family: "Raleway", sans-serif;
  font-weight: 400;
}

.about_person_area .person_details .person_information {
  padding: 15px 0px 25px 0px;
}

.about_person_area .person_details .person_information ul {
  display: inline-block;
}

.about_person_area .person_details .person_information ul li a {
  font-size: 13px;
  line-height: 26px;
  color: #333333;
  font-family: "Raleway", sans-serif;
}

.about_person_area .person_details .person_information ul + ul {
  padding-left: 55px;
}

.about_person_area .person_details .person_information ul + ul li a {
  font-size: 13px;
  line-height: 26px;
  color: #666666;
  font-family: "Raleway", sans-serif;
}

.social_icon li {
  display: inline-block;
  margin-right: 20px;
}

.social_icon li a {
  height: 40px;
  width: 40px;
  text-align: center;
  border: 1px solid #677fb5;
  display: block;
  line-height: 40px;
  font-size: 18px;
  border-radius: 5px;
  transition: all 400ms linear 0s;
  color: #677fb5;
}

.social_icon li:nth-child(2) a {
  color: #70c2e9;
  border-color: #70c2e9;
}

.social_icon li:nth-child(2):hover a {
  background: #70c2e9;
}

.social_icon li:nth-child(3) a {
  color: #895a4d;
  border-color: #895a4d;
}

.social_icon li:nth-child(3):hover a {
  background: #895a4d;
}

.social_icon li:nth-child(4) a {
  color: #d34836;
  border-color: #d34836;
}

.social_icon li:nth-child(4):hover a {
  background: #d34836;
}

.social_icon li:nth-child(5) a {
  color: #007ab9;
  border-color: #007ab9;
}

.social_icon li:nth-child(5):hover a {
  background: #007ab9;
}

.social_icon li:nth-child(6) a {
  color: #d8545d;
  border-color: #d8545d;
}

.social_icon li:nth-child(6):hover a {
  background: #d8545d;
}

.social_icon li:nth-child(7) a {
  color: #5ecbf3;
  border-color: #5ecbf3;
}

.social_icon li:nth-child(7):hover a {
  background: #5ecbf3;
}

.social_icon li:nth-child(8) a {
  color: #ff3ba4;
  border-color: #ff3ba4;
}

.social_icon li:nth-child(8):hover a {
  background: #ff3ba4;
}

.social_icon li:last-child {
  margin-right: 0px;
}

.social_icon li:last-child a {
  color: #faaa5e;
  border-color: #faaa5e;
}

.social_icon li:last-child:hover a {
  background: #faaa5e;
}

.social_icon li:hover a {
  background: #677fb5;
  color: #fff;
}

/* End About Person area css
============================================================================================ */
/*---------------------------------------------------- */
/*----------------------------------------------------*/
/* Download BTN area css
============================================================================================ */
.download_btn {
  display: block;
  background: #fec608;
  text-align: center;
  line-height: 40px;
  border-radius: 20px;
  color: #222222;
  font-size: 18px;
  font-family: "Yellowtail", cursive;
  position: relative;
  overflow: hidden;
}

.download_btn span {
  display: inline-block;
  width: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  height: 100%;
  transition: all 400ms linear 0s;
}

.download_btn:before {
  content: "\f019";
  position: absolute;
  height: 100%;
  width: 100%;
  text-align: center;
  line-height: 40px;
  font-size: 18px;
  color: #222222;
  top: -100%;
  left: 0px;
  font-family: FontAwesome;
  transition: all 200ms ease-in;
}

.download_btn:hover span {
  -webkit-transform: translateY(300%);
  -ms-transform: translateY(300%);
  transform: translateY(300%);
}

.download_btn:hover:before {
  top: 0px;
}

.contact_btn {
  max-width: 140px;
  display: block;
  line-height: 40px;
  color: #fff;
  font-family: "Raleway", sans-serif;
  box-shadow: none !important;
  outline: none !important;
  border: none;
  border-radius: 0px;
  background: #fec608;
  width: 100%;
  padding: 0px;
  position: relative;
  overflow: hidden;
}

.contact_btn span {
  display: inline-block;
  width: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  height: 100%;
  transition: all 400ms linear 0s;
}

.contact_btn:before {
  content: "\f1d8";
  position: absolute;
  height: 100%;
  width: 100%;
  text-align: center;
  line-height: 40px;
  font-size: 18px;
  color: #fff;
  top: -100%;
  left: 0px;
  font-family: FontAwesome;
  transition: all 200ms ease-in;
}

.contact_btn:focus {
  background: #fec608;
}

.contact_btn:hover {
  background: #fec608;
}

.contact_btn:hover span {
  -webkit-transform: translateY(300%);
  -ms-transform: translateY(300%);
  transform: translateY(300%);
}

.contact_btn:hover:before {
  top: 0px;
}
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
  p {
    font-size: 16px; 
    font-size: 4vw;
}

@media (max-width:991px){
    .footer::after {
        content: '';
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 250px 50px 250px;
        border-color: transparent transparent #f4f4f4;
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
    }
}
@media (max-width:767px){
    .us-themes .single-section .hvr-float-shadow{
        margin-bottom: 35px;
    }
    .us-themes{
        padding: 100px 70px;
    }
    .header .title h1{
        font-size: 22px;
        line-height: 36px;
    }
    .footer h3.text-40{
        font-size: 18px;
        letter-spacing: 1px;
    }
    .computer_pic img {
        position: relative;
        bottom: 0px;
        width: 100%;
    }
    .responsive_details {
        margin-bottom: 150px;
        height: auto;
    }
    .responsive_content h3 {
        padding-top: 50px;
    }
}
@media (max-width:580px){
    .header{
        padding: 150px 15px 200px;
    }
    .us-themes{
        padding: 100px 0px;
    }
}
@media (max-width:460px){
    .footer h3.text-40 {
        font-size: 15px;
    }
    .header .btn-demo{
        width: 200px;
        margin: 0 auto;
        display: block;
    }
    .header .btn-demo + .btn-demo{
        margin-left: auto;
        margin-top: 15px;
    }
    .feature_item_area .col-xs-6{
        width: 100%;
    }
    .feature_item_area .tittle_area h3{
        font-size: 20px;
    }
    .footer h3.text-40 {
        font-size: 13px;
        line-height: 26px;
    }
}
</style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Navbar -->
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
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Main Menu</a>";
        }
       ?>
    </form>
  </div></div>
    </div>
  </div>
</div>  
        
        <!--================Total container Area =================-->
        <div class="container main_container">
            <div class="content_inner_bg row m0">
                <section class="about_person_area pad" id="about">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="person_img">
                                <img src="uploads/<?php echo $res3;?>" style="width:612px;height:400;" alt="">
                                <?php 
                                
                                           //check whether user favour or unfavour the tutor
                                if ( !isset($_GET['stud']) && $_SESSION["actype"] ==="student") {
                                  if ($countrating2 >0){
                                    $canrate = "<a class='download_btn' href='rating.php?rate=".$ratingid."'><span>Rating</span></a>";
                                  }else{
                                    $canrate = '';
                                  }
                                  
                                  echo "<a class='download_btn' href='addfav.php?hi=".$_GET['profile']."'><span>".$val."</span></a>
                                $canrate
                                <a id='myDiv' onclick='myFunction();' class='download_btn' href='#myDIV'><span>Book an Appointment</span></a>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row person_details">
                                <h3>Hi I'm <span><?php echo $resName;?></span></h3><br>
                                <h4><?php if ($resJob != "None"){echo $resJob;}?></h4>
                                <p><pre>                         </pre><?php echo $resIntro;?></p>
                                <div class="person_information">
                                    <ul>
                                        <li><a href="#">Age</a><?php echo "   ".$age;?></li>
                                       
                                         <li><a href="#">Create Date</a><?php echo "   ".$resCreate ;?></li>
                                         <li><a href="#">Last Login</a><?php echo "   ".$resLastin ;?></li>
                                        <?php 
                                        switch($resGend)
                                        {
                                          case "F": $redir = "emale"; break;
                                          case "M": $redir = "ale"; break;
                                          case "O": $redir = "ther"; break;
                                          case "": $redir = "None"; break;
                                          default:; exit(); break;
                                        }echo "<li><a href='#'>Gender :</a>$resGend$redir</li>";?>
                                        <li><a href="#">Travel Range :</a><?php echo "   ".$resTravel." Km";?></li>
                                        <li><a href="#">District :</a><?php echo "   ".$res2;?></li>
                                        <li><a href="#">Zip Code</a><?php echo "   ".$res;?></li>

                                    </ul>
                                </div>
                              </div>
                            </div>
                          </div> 
                </section>
                <section class="education_area pad" id="education">
                    <div class="main_title">
                        <?php
                        if (!isset($_GET['stud'])){
                        echo "<h2>Education / Experience</h2>";
                        }
                        ?>
                    </div>
                    <div class="education_inner_area">
                        <div class="education_item wow fadeInUp animated" data-line="H">
                            <!--<h6>2005-2007</h6>
                            <a href="#"><h4>Secondary School</h4></a>-->
                            <h4><?php echo $res4?></h4>
                        </div>
                       
                    </div>
                      </div>
                </section>
                <?php if (!isset($_GET['stud'])){
                  echo "
                <div id='myDIV' display= 'block'>
					      <table>
                    <tr>
                      <th>Offer Subjects</th>
                      <th>Price Per Hours( RM )</th>
                    </tr>";
                    if ($resApprove != "1"){
                      echo '<center><tr>
                            <td colspan="2">Account Waiting for Approve</td>
                            </tr></center>';
                    }
                    
                    foreach ($query2 as $row) {
                    if ($_SESSION['actype'] ==='student'){
                      $change = "booking.php?true=";
                      $change .=$row['offer_id'];
                    } else {
                      $change = "#";
                    }
                    
                    echo "<tr><td>".$row['subject_name']."</td> <td>".$row['price_perhrs']."</td><td> <a href='".$change."'><i class='fa fa-trash'></i>Book</a></td> </tr>";
                   } 
                   }   
                    
                    echo "</table>";
				        echo "</div>";
                //print_r($row);
                ?>
                <br>
              <hr>
            

                <?php
                if (!isset($_GET['stud'])){
                            echo ' <div class="column">
                            <div class="col-md-30">
                            <hr style="border: 0px;border-top: 1px solid #ddd; ">
                            <div itemprop="review" itemscope itemtype="http://schema.org/Review">
                              <div class="w3-bar w3-blue">
                                <a href="#" class="w3-bar-item w3-button">Feedback</a>
                              </div><br>';
                  
                               if($countrating > 0 )
                               { 
                               foreach ($resultrating as $row) {
                               $resName = $row['r_stud_firstname'];

                               $star = $row['r_stars'];

                                echo "<p><meta itemprop='author' content=''><strong> ".$resName."</strong><br />
                                      <meta itemprop='datePublished' content='".$row['r_datetime']."'><em style='color: #555;'>".$row['r_datetime']."</em><br />
                                      <meta itemprop='ratingValue' content='".$star."'></div><img style='position:relative; left:-1px;' src='uploads/star-".$star.".gif' alt='".$star."/5 Rating' /><br />
                                      <p><span itemprop='reviewBody'>".$row['r_message']."</span></p><hr>
                                      <meta itemprop='itemReviewed' content='Person'>	" ; 
                               }
                            }else{
                                echo '
                                    No Rating Yet
                                ';
                            }
              }
              ?>
                <meta itemprop="itemReviewed" content="Person">	
                <!--p><meta itemprop="author" content="Bukky (Miss)"><strong>Bukky (Miss)</strong><br />
                  <meta itemprop="datePublished" content="09/09/2018"><em style="color: #555;">09/09/2018</em><br />
                    <meta itemprop="ratingValue" content="5"></div><img style="position:relative; left:-1px;" src="uploads/star-5.gif" alt="5/5 Rating" /><br />
                    <p><span itemprop="reviewBody">Richard is an extremely good tutor that makes Chemistry so much easier to understand and apply. It is clear that he spends time to consider the best ways to get points across. I am very happy with his tuition and with his love of teaching (which clearly comes across).  </span></p><hr>
                    <meta itemprop="itemReviewed" content="Person"-->	
                    </div>
                    </div>
            </div>
              </div>

              
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script>
        function myFunction() {
        var x = document.getElementById("myDIV");
         if (x.style.display === "none") {
        x.style.display = "block";
         } else {
         x.style.display = "none";
        }
      }
</script>
    </body>
</html>