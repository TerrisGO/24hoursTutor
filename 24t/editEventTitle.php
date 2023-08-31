<?php

session_start();	
require_once 'db.php';
$old_sessionid = session_id();
session_regenerate_id();
$new_sessionid = session_regenerate_id(true);


if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"] && isset($_POST['delete']) && isset($_POST['id'])  )
{  

   try {
       
    if ($_SESSION["actype"] ==="tutor"){
      
        $stmt_tutor = $conn->prepare("DELETE FROM `nonavailable` WHERE `nonavailable_id` = :non_id AND `booked` = :nb AND `tutor_id` = :id");
        $number2 = $_POST['id'];
        $number3 = 0;
        $stmt_tutor->bindParam(':non_id', $number2, PDO::PARAM_STR);
        $stmt_tutor->bindParam(':nb', $number3, PDO::PARAM_STR);
        $stmt_tutor->bindParam(':id',  $_SESSION["identity"], PDO::PARAM_STR);
	    $stmt_tutor->execute();

      header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    if ($_SESSION["actype"] ==="student"){
        header("location:calendar.php"); 
		
     //DEBUG  echo "true1";	print_r($result);
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
    if (!empty($_SERVER['HTTP_REFERER']))
    header("Location: ".$_SERVER['HTTP_REFERER']);
else
    header("location:loging.php");  
}













?>