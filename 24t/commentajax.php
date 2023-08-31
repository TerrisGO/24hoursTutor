<?php
require_once('db.php'); 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();

if (isset($_POST['user_msgid'])){
    echo "yes <br>";
}
if (isset($_POST['user_comm'])){
    echo "comment here";
}

if(isset($_POST['user_msgid']) && isset($_POST['user_comm']) && isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"]))
{
    echo $_SESSION["firstname"];
    echo $_SESSION["lastname"];
  $myname = $_SESSION["firstname"]." ".$_SESSION["lastname"];
  $comment=$_POST['user_comm'];

  if ($_SESSION['actype'] === "tutor"){
    $stmt = $conn->prepare("SELECT * FROM `chat` WHERE `tutor_id` = :id AND `chat_id` = :msg_id");
  }else if ($_SESSION['actype'] === "student"){
    $stmt = $conn->prepare("SELECT * FROM `chat` WHERE `stud_id` = :id AND `chat_id` = :msg_id");
  }
  $stmt->bindParam(':id', $_SESSION["identity"], PDO::PARAM_STR);
  $stmt->bindParam(':msg_id',$_POST['user_msgid'], PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if( $row > 0){
        $insert = $conn->prepare("INSERT INTO `chatmessage`( `sender_name`, `message`, `m_timestamp`, `chat_id`) VALUES (:name,:msg ,CURRENT_TIMESTAMP,:chat_id)");
        $insert->bindParam(':name', $myname , PDO::PARAM_STR);
        $insert->bindParam(':msg',$comment, PDO::PARAM_STR);
        $insert->bindParam(':chat_id',$row['chat_id'], PDO::PARAM_STR);
        $insert->execute();
      }

}
else  
 {  
      session_destroy();
      header("location:loging.php");  
 }

 $new_sessionid = session_regenerate_id(true);

?>