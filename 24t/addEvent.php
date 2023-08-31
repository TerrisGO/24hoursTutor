<?php
session_start();	
require_once 'db.php';
$old_sessionid = session_id();
session_regenerate_id();
$new_sessionid = session_regenerate_id(true);


if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"] && isset($_POST['start']) && isset($_POST['duration']) && ctype_digit($_POST['duration']) && $_POST['duration'] <= 24 && $_POST['duration'] >0)  
{  

   try {
       
    if ($_SESSION["actype"] ==="tutor"){
      
        $stmt_tutor = $conn->prepare("INSERT INTO `nonavailable`( `nonavailable_date`, `booked`, `tutor_id`, `start_time`, `duration`) VALUES (:date,:bk,:id,:st,:dr)");
        $number2 = $_POST['start'];
        $number3 = 0;
        $number4 = $_POST['time'];
        $number5 = $_POST['duration'];
        $stmt_tutor->bindParam(':date', $number2, PDO::PARAM_STR);
        $stmt_tutor->bindParam(':bk', $number3, PDO::PARAM_STR);
        $stmt_tutor->bindParam(':id',  $_SESSION["identity"], PDO::PARAM_STR);
        $stmt_tutor->bindParam(':st', $number4, PDO::PARAM_STR);
        $stmt_tutor->bindParam(':dr', $number5, PDO::PARAM_STR);
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
     header("location:loging.php");  
}



?>