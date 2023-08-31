<?php

require_once('db.php'); 
 session_start();
 require_once("csrf.php");
 $old_sessionid = session_id();
 session_regenerate_id();

 if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"]) && isset($_GET["cancel"]) && ctype_digit($_GET['cancel']))  
 { 
     $pending = "pending";
     if ($_SESSION["actype"] ==="tutor"){
        $Q = $conn->prepare('SELECT * FROM `payment_info` WHERE `tutor_id`=:id AND `payment_id` =:pyid AND `status`=:pd');
        $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Q->bindParam(':pyid', $_GET["cancel"], PDO::PARAM_INT);
        $Q->bindParam(':pd', $pending, PDO::PARAM_STR);
        $Q->execute();
        $count = $Q->rowCount();
        $result = $Q->fetch(PDO::FETCH_ASSOC);
     }
     if ($_SESSION["actype"] ==="student"){
        $Q = $conn->prepare('SELECT * FROM `payment_info` WHERE `stud_id`=:id AND `payment_id` =:pyid AND `status`=:pd');
        $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        $Q->bindParam(':pyid', $_GET["cancel"], PDO::PARAM_INT);
        $Q->bindParam(':pd', $pending, PDO::PARAM_STR);
        $Q->execute();
        $count = $Q->rowCount();
        $result = $Q->fetch(PDO::FETCH_ASSOC);
    }
    $res1 = $result['sub_name'];
    $res2 = $result['bookingdate'];
    $res3 = $result['paytime'];

} else  
{  
     session_destroy();
     header("location:loging.php");  
}
if ($count >0){

    require_once("cancelform.php");
}else{
    header("location:match.php"); 
}


$new_sessionid = session_regenerate_id(true);

?>