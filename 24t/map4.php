<?php
        session_start();
?>

<!DOCTYPE html>
<html>
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<title>24HoursTutor</title><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
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
    <a href="map4.php" class="w3-bar-item w3-button w3-padding-large"><img src="24hrs2.png" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"></a>
    <div class="topnav">
    <div class="login-container w3-hide-small">
    <form action="">
       <?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          $redirect = "login_success.php";
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Main Menu</a>";
        }else{
          $redirect = "servicecentre.php";
          echo "<a href='registering.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Register</a>";
          echo "<a href='loging.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Login</a>";
          echo "<a href='reset.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>?</a>";
        }
       ?>
    </form>
  </div></div>
    </div>
  </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="#band" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">About US</a>
  <a href="#tour" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">More Info</a>
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">CONTACT</a>
  <?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a>";
        }else{
          echo "<a href='registering.php' class='w3-bar-item w3-button w3-padding-large'>Register</a>";
          echo "<a href='loging.php' class='w3-bar-item w3-button w3-padding-large'>Login</a>";
          echo "<a href='reset.php' class='w3-bar-item w3-button w3-padding-large'>?</a>";
        }
       ?>
</div>

<!-- Page content -->
<div class="test-content" style="max-width:100%;margin-top:46px">

  <!-- Automatic Slideshow Images -->
  <div class="mySlides w3-display-container w3-center">
    <img src="http://www.apprenticeship.ie/en/PublishingImages/slider1.jpg" style="width:100%">
    <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h3>Become a professional private tutors</h3>
      <p><b>Finding Your Good Teachers</b></p>   
    </div>
  </div>
  <div class="mySlides w3-display-container w3-center">
    <img src="http://www.softlearning.com/images/rotateImg/img_banner1_en.jpg" style="width:100%">
    <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h3>Tuitions | Training | Consultant</h3>
      <p><b>Learn anythings that you wish</b></p>    
    </div>
  </div>
  <div class="mySlides w3-display-container w3-center">
    <img src="http://www.ideafit.com/files/shutterstock_117073888.jpg" style="width:100%">
    <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h3>Become a professional private trainers</h3>
      <p><b>Looking for personnel trainers for healthy life style</b></p>    
    </div>
  </div>

  <!-- The Intro Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1100px" id="band">
    <h2 class="w3-wide">24hrs Tutors</h2>
    <p class="w3-opacity"><i>Classes Made Easy</i></p>
    <p class="w3-justify w3-center">Here at 24hrs Tutors we strive to make it easier for students and parents to search for classes. Try it out now! Schedule your next class with us today!</p>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

  <!-- About Section -->
  <div class="w3-row w3-padding-64 w3-light-grey" id="about">
    <div class="w3-col m6 w3-padding-large">
     <img src="https://static.wixstatic.com/media/7fe4e3_65720cd5c5564537a836c9676f76c6ed.jpg/v1/fill/w_980,h_452,al_c,q_85,usm_0.66_1.00_0.01/7fe4e3_65720cd5c5564537a836c9676f76c6ed.webp" class="w3-round w3-image w3-opacity-min"  alt="Menu" style="width:100%">
    </div>

    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Finding Tutors</h1><br>
      <p class="w3-large">Weeks or months of struggling in a subject like math or reading can affect a student’s outlook in that area and in others. An accomplished tutor can identify the source of the problem and provide alternate learning models. Perhaps you understand material best when it’s presented visually, but your college class relies on lectures with few images. Your tutor can supplement your lectures with visuals and help to fill the gaps in your knowledge.
      <p class="w3-large w3-text-grey w3-hide-medium"> This, in turn, can help you prove to yourself that no academic challenge is impossible. Similarly, if a student complains that they hate school or a particular class, a tutor can work to transform their opinion.</p>
    </div>
  </div>
  
  <hr>
  
  <!-- Menu2 Section -->
  <div class="w3-row w3-padding-64" id="menu">
    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Become Professional Tutors</h1><br>
      <p class="w3-large">24hrsTutors.com is also a perfect resource for tutors who are looking for students. The website is a free tutoring tool that allows tutors to describe their services, upload a photograph, and converse with current and potential clients without paying a fee. Tutors always keep 100% of what they make.</p>
      <p class="w3-large w3-text-grey w3-hide-medium">24hrsTutors.com is a great way find people who are interested in hiring you for tutoring jobs and make some extra money! Tutoring is one of the most lucrative and rewarding part-time jobs out there, and we are really excited to provide a website where so many people can connect with each other. We really believe that this is the future of the tutoring industry (people connecting online) and we would love to have you join us!</p>
    </div>
    
    <div class="w3-col m6 w3-padding-large">
      <img src="http://www.archerchoice.com/wp-content/uploads/2016/04/ACA-Tutors-Banner.jpg" class="w3-round w3-image w3-opacity-min" alt="Menu" style="width:100%">
    </div>
  </div>

  <hr>
  
    <!-- About Section -->
  <div class="w3-row w3-padding-64 w3-light-grey" id="about">
    <div class="w3-col m6 w3-padding-large">
     <img src="https://abc.2008php.com/2014_Website_appreciate/2014-03-28/20140328144603.jpg" class="w3-round w3-image w3-opacity-min"  alt="Menu" style="width:100%">
    </div>

    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Educations without Limitation</h1><br>
      <p class="w3-large">Professional instructors and peer tutors work with students of all ages in all locations. Offering online college tutoring services in popular classes like college algebra, English, physics, and more, 24hrsTutors.com can help students improve and engage more fully in their coursework. Tutors also have experience in areas like differential equations and languages like Hebrew and Mandarin Chinese. If you’ve ever said to yourself, "I need a tutor," 24hrsTutors.com is a great place to find the right tutor to help you succeed. </p>
    </div>
  </div>
  
  <hr>
  </div>
  
  
  

  <!-- The Tour Section -->
  <div class="w3-indigo" id="tour">
    <div class="w3-container w3-content w3-padding-64" style="max-width:1000px">
      <h2 class="w3-wide w3-center">More Infomations</h2>
      <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">
          <img src="http://www.apprenticeship.ie/PublishingImages/BecomeAnApprentice.jpg" alt="New York" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Become Tutors/Trainers</b></p>
            <p>You became a trainer/tutor to help people and change lives. Leave the heavy lifting of marketing, tech, scheduling and billing to us.</p>
            <a href="<?=$redirect?>"><button class="w3-button w3-black w3-margin-bottom" >More Info</button></a>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <img src="http://blogs.ucl.ac.uk/ucl-careers/files/2017/06/feminist-teaching-.jpg" alt="Paris" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Finding Tutors</b></p>
            <p><pre>    </pre>⁪⁪⁪⁪Find an expert who suits your needs and learning style. <pre>  </pre>⁪⁪⁪⁪</p>
            <a href="<?=$redirect?>"><button class="w3-button w3-black w3-margin-bottom" >More Info</button></a>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <img src="http://1mhowto.com/wp-content/uploads/2015/01/gym.jpg" alt="San Francisco" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Finding Trainers</b></p>
            <p>Find the perfect personal trainer near you based on your goals, personality,lifestyle and your body.</p>
            <a href="<?=$redirect?>"><button class="w3-button w3-black w3-margin-bottom" >More Info</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- The Contact Section -->
  <div class="w3-container w3-content w3-padding-64" style="max-width:1000px" id="contact">
    <h2 class="w3-wide w3-center">CONTACT</h2>
    <p class="w3-opacity w3-center"><i>Questions? Mail Us or Give Us a call !</i></p>
    <div class="w3-row w3-padding-32">
      <div class="w3-col m12 w3-large w3-margin-bottom">


        <a href="servicecentre.php"><i class="fa fa-map-marker" style="width:30px"></i> Penang, Malaysia<br></a>
        <i class="fa fa-phone" style="width:30px"></i> Phone: +6012-4116568<br>
        <i class="fa fa-envelope" style="width:30px"> </i> Email: 24hrstutors@gmail.com<br>
      </div>
      <!--div class="w3-col m6">
        <form action="/action_page.php" target="_blank">
          <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
            </div>
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
            </div>
          </div>
          <input class="w3-input w3-border" type="text" placeholder="Message" required name="Message">
          <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
        </form>
      </div>
    </div>
  </div-->
  
<!-- End Page Content -->
</div>

<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <a href="mailto:24hrstutors@gmail.com"><i class="fa fa-envelope w3-hover-opacity" ></i></a>
  <a href="https://www.instagram.com/24hrstutor"><i class="fa fa-instagram w3-hover-opacity"></i></a>
  <a href="https://twitter.com/24hrsTutor"><i class="fa fa-twitter w3-hover-opacity"></i></a>
  <p class="w3-medium">Designed by 5am.kdupg</p>
</footer>

<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 6000);    
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


</body>
</html>
