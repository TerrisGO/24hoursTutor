<?php
/* Displays all successful messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
  <title>24HoursTutor</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <h1><?= 'Success'; ?></h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];    
    else:
        header( "location: loging.php" );
    endif;
    ?>
    </p>
    <a href="map4.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
