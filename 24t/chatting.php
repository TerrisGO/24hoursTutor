<?php
require_once('db.php'); 
session_start();
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();
//var_dump($_SESSION);
//echo $_GET['chat'];
if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"] && isset($_GET['chat']) && ctype_digit($_GET['chat']) && isset($_GET['name']))  
 {  

 }
 else  
 {  
      session_destroy();
      header("location:loging.php");  
 }

 $new_sessionid = session_regenerate_id(true);

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    background-image: url("https://i.imgur.com/fIxKy85.png");
    background-repeat: repeat;
    background-position: center bottom;
}
*{margin:0px; padding:0px;font-family: Helvetica, Arial, sans-serif;}
#logout{width:60px; height:20px; position:absolute; top:6px; right:20px; margin-bottom:40px; text-align:center; color:#fff}
#container{width:75%; height:auto; position:relative; top:8px; margin:auto;}

#session-name{width:100%; height:36px; margin-bottom:30px; font-size:20px}
.session-text{width:300px; height:30px;padding:6px 10px;margin: 8px 0;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box; font-size:24px}

#result-wrapper{width:100%; margin:auto; height:450px;}
#result{height:450px; overflow:scroll;overflow-x: hidden;}

#form-container{width:100%; margin:auto; height:80px;}
.form-text{float:left; width:85%; height:80px;}
#comment{width:100%; height:79px; resize:none; font-size: 20px;}

.form-btn{float:left; width:15%; height:80px;}
#btn{border:none; height:80px; width:100%; background:#123a5d; color:#fff; font-size:22px}

.chats{width:100%; margin-bottom:6px;}
.chats strong{color:#6d84b4}
.chats p{ font-size:14px; color:#aaa; margin-right:10px}
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<script>
$(document).ready(function() {
	    $("#comment").emojioneArea();
	  });
$(document).ready(function()
    {
        $(document).bind('keypress', function(e) {
            if(e.keyCode==13){
                 $('#my_form').submit();
				 $('#comment').val("");
             }
        });
	});
</script>
<script type="text/javascript">
function post()
{
  var comment = document.getElementById("comment").value;
  var msg_id = document.getElementById("msg_id").value;
  if(comment && msg_id)
  {
    $.ajax
    ({
      type: 'post',
      url: 'commentajax.php',
      data: 
      {
         user_comm:comment,
         user_msgid:msg_id
      },
      success: function (response) 
      {
	    document.getElementById("comment").value="";
      }
    });
  }
  
  return false;
}
</script>
<script>
 function autoRefresh_div()
 {
      $("#result").load("loadmessage.php?msg=<?php echo $_GET['chat']?>&img=<?php echo $_GET['img']?>").show();// a function which will load data from other file after x seconds
  }
  var interval = setInterval(function(){
    if (true) autoRefresh_div();
    else clearInterval(interval);
}, 2500);
  //setInterval('autoRefresh_div()', 1000);
</script>
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
</div>

<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
<?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a>";
        }
       ?>
</div>
<br><br><br>
<div id="container">

<B><div id="session-name">
    <?php
    if ($_SESSION["actype"] ==="tutor"){
        echo "My Student ";
    }else{
        echo "My Tutor ";
    }
    ?></B><input type="text" value="<?= $_GET['name'] ?>" class="session-text" disabled  debugging style="opacity: 0.9;">
    <a href="match.php"><button type="button" class="btn basic">View Matching</button></a>
</div>

<div id="result-wrapper">
	<div id="result">
		<?php
			include("loadmessage.php");
		?>
	</div>			
</div>

<form method='post' action="#" onsubmit="return post();" id="my_form" name="my_form">
<div id="form-container">
	<div class="form-text">
    	<textarea id="comment" name ="user_comm"></textarea>
        <input type="hidden" name="msg_id" id="msg_id" value="<?php echo $_GET['chat'] ?>">
    </div>
    <div class="form-btn">
    <button type="submit" id="btn" class="fa fa-paper-plane" aria-hidden="true" name="btn"/>
    </div>
    <center><label>At the time deciding meeting method whether online or face to face<br>Please make sure you are in safezone and if possible we suggest you to meet at place under supervise.</label></center>
</div>
</form>

</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.8/emojionearea.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.8/emojionearea.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.1.8/emojionearea.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function() {
	    $("#comment").emojioneArea();
	  });
	</script>
  <style>
  .emojionearea > .emojionearea-editor {
    min-height: 79px;
    max-height: 100px;
    width: 50%;
}
  </style>
</body>
</html>