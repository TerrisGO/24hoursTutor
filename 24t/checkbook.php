<?php
require_once('db.php'); 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"]))  
 { 
     if ($_SESSION["actype"] ==="tutor"){
        $Qz = $conn->prepare('SELECT `payment_id` FROM `payment_info` WHERE `tutor_id` =:id AND `status` = "pending" AND `bookingdate`>= CURDATE()');
        $Qz->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Qz->execute();
        $countotal = $Qz->rowCount(); //count pending book 

        $Qz2 = $conn->prepare('SELECT * FROM `chat` WHERE `tutor_id` =:id');
        $Qz2->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Qz2->execute();
        $countotal2 = $Qz2->rowCount(); //count total chat

        $Qz3 = $conn->prepare('SELECT * FROM `favourite` WHERE `tutor_id` =:id');
        $Qz3->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Qz3->execute();
        $countotal3 = $Qz3->rowCount(); //count total favourites

     }
     if ($_SESSION["actype"] ==="student"){
        $Qz = $conn->prepare('SELECT `payment_id` FROM `payment_info` WHERE `stud_id` =:id AND `status` = "pending" AND `bookingdate`>= CURDATE()');
        $Qz->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Qz->execute();
        $countotal = $Qz->rowCount(); //count pending book 

        $Qz2 = $conn->prepare('SELECT * FROM `chat` WHERE `stud_id` =:id');
        $Qz2->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Qz2->execute();
        $countotal2 = $Qz2->rowCount(); //count total chat

        $Qz3 = $conn->prepare('SELECT * FROM `favourite` WHERE `stud_id` =:id');
        $Qz3->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Qz3->execute();
        $countotal3 = $Qz3->rowCount(); //count total favourites

    }

} else  
{  
     session_destroy();
     header("location:loging.php");  
}
$new_sessionid = session_regenerate_id(true);
?>