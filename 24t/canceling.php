<?php
require_once('db.php'); 
session_start();
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"]) && isset($_POST["bookid"]) && ctype_digit($_POST['bookid']))  
{ 
    //print_r($_POST);
    if (hash_equals($csrf, $_POST['csrf'])) {
        clearstatcache();
        $newstr = filter_var($_POST["comments"], FILTER_SANITIZE_STRING);

        if ($_SESSION["actype"] ==="tutor"){
            $search = $conn->prepare('SELECT * FROM `payment_info` WHERE `payment_id` =:bkid AND `tutor_id`=:id AND `status` ="pending"');
            $search->bindParam(':bkid', $_POST["bookid"], PDO::PARAM_INT);
            $search->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
            $search->execute();
            $result = $search->fetchAll();
        
            foreach($result as $event){ 
            $tid = $event["tutor_id"];
            $timestamp = $event["bookingdate"];
            $splitTimeStamp = explode(" ",$timestamp);
            $date = $splitTimeStamp[0];
            $time = $splitTimeStamp[1]; //use for delete nonvailable

            $start = $event['bookingdate'];
            $min = 20;
            $conceive = "+".$min." minutes";
            // converted time
            $end = date('Y-m-d H:i:s',strtotime($conceive,strtotime($start)));      //echo "start ".$start."<br>";//echo "end ".$end;
            }
            //delete a record from table nonavailable by tutor_id
            delNonavailable($date,$time,$tid,$conn);

            $newtime = date("Y-m-d H:i:s");
            if ($newtime >= $end){
                $Q = $conn->prepare('UPDATE `payment_info` SET `status`="cancel" , `cancel_reason`=:cmm WHERE `payment_id` =:bkid AND `tutor_id`=:id AND `status` ="pending" ');
                $Q->bindParam(':bkid', $_POST["bookid"], PDO::PARAM_INT);
                $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
                $newstr = "By tutor: " .$newstr;
                $Q->bindParam(':cmm', $newstr, PDO::PARAM_STR);
                $Q->execute();
                header("location:match.php?successcancel=1");
            }else{
                header("location:match.php?failcancel=1");  
                //header("location:refreshtest.php?"); 
                //echo "no";
            } 
         }
         
         if ($_SESSION["actype"] ==="student"){
            $search = $conn->prepare('SELECT * FROM `payment_info` WHERE `payment_id` =:bkid AND `stud_id`=:id AND `status` ="pending"');
            $search->bindParam(':bkid', $_POST["bookid"], PDO::PARAM_INT);
            $search->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
            $search->execute();
            $result = $search->fetchAll();
        
            foreach($result as $event){ 
            $tid = $event["tutor_id"];
            $timestamp = $event["bookingdate"];
            $splitTimeStamp = explode(" ",$timestamp);
            $date = $splitTimeStamp[0];
            $time = $splitTimeStamp[1];//use for delete nonvailable

            $start = $event['bookingdate'];
            $hrs = 3;
            $conceive = "-".$hrs." hour";
            // converted time
            $end = date('Y-m-d H:i:s',strtotime($conceive,strtotime($start)));
            }
            //delete a record from table nonavailable by tutor_id
            delNonavailable($date,$time,$tid,$conn);

            $newtime = date("Y-m-d H:i:s");
            if ($newtime <= $end){
                echo $newtime;
                //update payment_info status
                $Q = $conn->prepare('UPDATE `payment_info` SET `status`="cancel" , `cancel_reason`=:cmm WHERE `payment_id` =:bkid AND `stud_id`=:id AND `status` ="pending"');
                $Q->bindParam(':bkid', $_POST["bookid"], PDO::PARAM_INT);
                $Q->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
                $newstr = "By student: " .$newstr;
                $Q->bindParam(':cmm', $newstr, PDO::PARAM_STR);
                $Q->execute(); //*/
                echo "<br>statement";
                header("location:match.php?successcancel=1");
            }else{
                header("location:match.php?failcancel=1"); 
                //echo $newtime; 
                //echo "no";
            }
            
        }
    }

} else  
{  
    session_destroy();
    header("location:match.php");  
}

$new_sessionid = session_regenerate_id(true);

function delNonavailable($date,$time,$tid,$conn){
    $del = $conn->prepare('DELETE FROM `nonavailable` WHERE `nonavailable_date` =:date AND `start_time`=:time AND `tutor_id`=:tid AND `booked`=1');
    $del->bindParam(':date', $date, PDO::PARAM_STR);
    $del->bindParam(':time', $time, PDO::PARAM_STR);
    $del->bindParam(':tid', $tid, PDO::PARAM_INT);
    $del->execute();
}

?>