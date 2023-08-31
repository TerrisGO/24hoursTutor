<?php
require_once('db.php'); 
session_start();
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();

if(!isset($_SESSION["username1"]) && !isset($_SESSION["identity"]) && !isset($_SESSION["actype"])  )
 {  
    session_destroy();
    header("location:loging.php");  
 }
 if ($_SESSION["actype"] ==="tutor" ||!isset($_POST["submit"])){
    header("location:login_success.php"); 
 }


//var_dump($_POST);


if (isset($_POST["submit"]) && isset($_POST["subject_p"]) && isset($_POST["subject_name"])  && isset($_POST["tutor_n"]) && isset($_POST["hour"]) && isset($_POST["appoint_date"]) && isset($_POST["tutor_id"]) && $_POST["appoint_date"] ){
    $tutor_id = $_POST['tutor_id'];
    $stmt = $conn->prepare("SELECT `tutor_id` FROM `tutor` WHERE `tutor_id` =:id AND`t_officialcheck`=1");
    $stmt->bindParam(':id', $tutor_id , PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() < 0) {
        header("location:loging.php"); 
      }//check whether tutor account is having approval

   if (hash_equals($csrf, $_POST['csrf'])) {
       echo "pass csrf";
       if (ctype_digit($_POST["cardNumber"])  && ctype_digit($_POST["cardExpiry"] ) && ctype_digit($_POST["cardCVC"] ) ){
           $val1 = $_POST["cardNumber"];
           $val2 = $_POST["cardExpiry"];
           $val3 = $_POST["cardCVC"];

               $stmt_stud = $conn->prepare("SELECT * FROM `testing_card` WHERE `card_num`= :cnum and `exp_d`=:cexp AND `cvc`=:cvc");
               $stmt_stud->bindParam(':cnum', $val1, PDO::PARAM_STR);
               $stmt_stud->bindParam(':cexp', $val2, PDO::PARAM_STR);
               $stmt_stud->bindParam(':cvc', $val3, PDO::PARAM_STR);
               $stmt_stud->execute();
               $results = $stmt_stud->fetch(PDO::FETCH_ASSOC);
                print_r($results);
       } //{closing for }if (ctype_digit($_POST["cardNumber"])
       else{ echo "card invalid";}

           if ($_POST["subject_p"] > $results["amount"]){
               echo "insuficcient balance";
               echo $_POST["subject_p"];
               echo "amount_bank".$results["amount"];
           }else if ($_POST["subject_p"] < $results["amount"]){
               $transfer =$conn->prepare ("UPDATE testing_card SET amount = amount - :minus WHERE card_num = :cnum");
               $transfer->bindParam(':cnum', $_POST["cardNumber"], PDO::PARAM_STR);
               $transfer->bindParam(':minus', $_POST["subject_p"], PDO::PARAM_STR);
               $transfer->bindParam(':cnum', $_POST["cardNumber"], PDO::PARAM_STR);
               echo "transfer amount";

               if($transfer->execute()){
                   $val6 = "pending";
                       $p_record =$conn->prepare ("INSERT INTO `payment_info` ( `paytime`, `payamount`, `stud_id`, `tutor_id`, `sub_name`, `bookingdate`, `appoint_hrs`, `status`, `cancel_reason`) VALUES ( CURRENT_TIMESTAMP, :pyam, :stid, :tid, :sub, :bkd, :app_hr, :state, NULL)");
                       $p_record ->bindParam(':pyam', $_POST["subject_p"], PDO::PARAM_STR);
                       $p_record ->bindParam(':stid',$_SESSION["identity"], PDO::PARAM_STR);
                       $p_record ->bindParam(':tid', $_POST["tutor_id"], PDO::PARAM_STR);
                       $p_record ->bindParam(':sub', $_POST["subject_name"], PDO::PARAM_STR);
                       $p_record ->bindParam(':bkd', $_POST["appoint_date"], PDO::PARAM_STR);
                       $p_record ->bindParam(':app_hr', $_POST["hour"], PDO::PARAM_STR);
                       $p_record ->bindParam(':state', $val6, PDO::PARAM_STR);
                       echo "making record";
                       if( $p_record->execute()){
                         $last_id = $conn->lastInsertId();
                           $exist_chat = $conn->prepare ("SELECT * FROM `chat` WHERE `stud_id`=:stid AND `tutor_id` =:tid");
                           $exist_chat->bindParam(':stid',$_SESSION["identity"], PDO::PARAM_STR);
                           $exist_chat ->bindParam(':tid', $_POST["tutor_id"], PDO::PARAM_STR);
                           $exist_chat->execute();
                           $row = $exist_chat->fetch(PDO::FETCH_ASSOC);
                           
                           if( ! $row){
                           $create_chat = $conn->prepare ("INSERT INTO `chat` (`stud_id`, `tutor_id`) VALUES (:stid, :tid)");
                           $create_chat->bindParam(':stid',$_SESSION["identity"], PDO::PARAM_STR);
                           $create_chat ->bindParam(':tid', $_POST["tutor_id"], PDO::PARAM_STR);
                           $create_chat->execute();
                           echo "creating chat";
                           }

                           $timestamp = $_POST["appoint_date"];
                           $splitTimeStamp = explode(" ",$timestamp);
                           $date = $splitTimeStamp[0];
                           $time = $splitTimeStamp[1]; //splitting time and date

                           $non_available = $conn->prepare ("INSERT INTO `nonavailable`(`nonavailable_date`, `booked`, `tutor_id`, `start_time`, `duration`) VALUES (:date,'1' ,:tuid ,:time ,:hour )");
                           $non_available->bindParam(':date',$date, PDO::PARAM_STR);                            
                           $non_available->bindParam(':tuid',$_POST["tutor_id"], PDO::PARAM_STR);
                           $non_available ->bindParam(':time', $time, PDO::PARAM_STR);
                           $non_available->bindParam(':hour',$_POST["hour"], PDO::PARAM_STR);

                           if ($non_available->execute() == false){
                               echo "error occur on nonavailable date";
                           }else{
                             header("location:receipt.php?pyid=$last_id");
                           }
                       //print_r($record->errorInfo());  if any error is there it will be posted
                       }
                   }
               }else {echo "transfer and record made fail";} 
           }else{echo "csrf invalid";}//closing else for if (hash_equals($csrf, $_POST['csrf']))
       }else{("location:noresults.php");}//closing for first IF

       $new_sessionid = session_regenerate_id(true);

           //haven't add on value checking espectially on the hours for appointment
?>