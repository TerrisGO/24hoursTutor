<?php
 require_once('db.php'); 
 session_start();
 require_once("csrf.php");
 $old_sessionid = session_id();
 session_regenerate_id();
 date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"] ==="tutor" && isset($_GET['yes']) && ctype_digit($_GET['yes']))  
{ 
     $yes = $_GET['yes'];
    $search = $conn->prepare('SELECT  d.stud_id, d.stud_fname , d.stud_lname, r.payment_id , r.tutor_id ,r.bookingdate FROM payment_info r , student d WHERE r.tutor_id =:id AND r.payment_id = :yes AND r.status = "pending"AND r.stud_id = d.stud_id');
    $search->bindParam(':yes', $yes, PDO::PARAM_INT);
    $search->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
    $search->execute();                      
    $result = $search->fetchAll();

    foreach($result as $event){ 

    $studname = $event['stud_fname'];
    $studid = $event['stud_id'];
    $tid = $event['tutor_id'];
    $start = $event['bookingdate'];
    $min = 30;
    $conceive = "+".$min." minutes";
    // converted time
    $end = date('Y-m-d H:i:s',strtotime($conceive,strtotime($start)));

    //echo "start ".$start."<br>";
    //echo "end ".$end;
    }
    echo  $studname;
    $newtime = date("Y-m-d H:i:s");
    if ($newtime >= $end){
        $delQ = $conn->prepare('UPDATE `payment_info` SET `status`="success"  WHERE `payment_id` =:yes AND `tutor_id`=:id AND `status` ="pending" ');
        $delQ->bindParam(':yes', $yes, PDO::PARAM_INT);
        $delQ->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
        if ($delQ->execute()){

            $insertRateID = $conn->prepare('INSERT INTO `rating`( `stud_id`, `r_stud_firstname`, `tutor_id`) VALUES (:v1,:v2,:v3)');
            $insertRateID->bindParam(':v1', $studid, PDO::PARAM_INT);
            $insertRateID->bindParam(':v2', $studname, PDO::PARAM_STR);
            $insertRateID->bindParam(':v3', $tid, PDO::PARAM_INT);
            $insertRateID->execute();
        }

        header("location:match.php?successconfirm=1");  

    }else{
        header("location:match.php?failconfirm=1");  
        //echo "no";
        //header("location:refreshtest.php?"); 
    }
    
 } else  
 {  
      session_destroy();
      header("location:loging.php");  
 }




 $new_sessionid = session_regenerate_id(true);

?>