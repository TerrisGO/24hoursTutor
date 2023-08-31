<?php 
error_reporting(0);
require_once('db.php'); 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();

 if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"]) OR isset($_GET['msg']) OR ctype_digit($_GET['msg'])){  
  $myname = $_SESSION["firstname"]." ".$_SESSION["lastname"];
  $image = $_GET['img'];
   try {
     if ($_SESSION["actype"] ==="tutor"){

        $stmt = $conn->prepare("SELECT DISTINCT sender_name , message , m_timestamp FROM chatmessage x , chat z WHERE x.chat_id = :msg_id AND  z.tutor_id = :id");
        $stmt->bindParam(':id', $_SESSION["identity"], PDO::PARAM_STR);
        $stmt->bindParam(':msg_id', $_GET["msg"], PDO::PARAM_STR);
        $stmt->execute();
       
      //DEBUG  echo "true<br>";
     }
     if ($_SESSION["actype"] ==="student"){

        $stmt = $conn->prepare("SELECT DISTINCT sender_name , message , m_timestamp FROM chatmessage x , chat z WHERE x.chat_id = :msg_id AND z.stud_id = :id");
        $stmt->bindParam(':id', $_SESSION["identity"], PDO::PARAM_STR);
        $stmt->bindParam(':msg_id', $_GET["msg"], PDO::PARAM_STR);
        if ($stmt->execute()){
           // echo "second";
        }
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
 /*foreach( $stmt as $row ) {
        echo "<div class='chats'><strong>".$row['sender_name'].":</strong>".$row['message']." <p style='float:right'>". date('j/m/Y g:i:sa', strtotime($row['m_timestamp']))."</p></div>";
    }*/

    foreach( $stmt as $row ) {

        $name=$row['sender_name'];
        $comment=$row['message'];
        $time=$row['m_timestamp'];
        /*if($name == $myname ){
          echo 'Strings match.';
        } else {
          echo 'Strings do not match.';
          }*/
        if ($myname ==$name){       
           echo "<div class='outgoing_msg'>
            <div class='sent_msg'>
              <p>".$comment."</p>
              <span class='time_date'>".$time."</span> </div></div>";
        }else{
            echo $name;

           echo "<div class='incoming_msg'>
            <div class='incoming_msg_img'> <img src='uploads/$image'; class='img-circle' width='80' height='80' alt='left'> </div>
            <div class='received_msg'>
              <div class='received_withd_msg'>
                <p><b> ".$comment."</b></p>
                <span class='time_date'>".$time."</span></div>
                </div>
          </div>";
        }
    }

?>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
<style>
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}


.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
</style>