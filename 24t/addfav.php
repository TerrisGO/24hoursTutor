<?php 
require_once('db.php');
session_start();
require_once("checkbook.php"); 
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();
//var_dump($_SESSION);
$target_path   = 'uploads/';


if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"] && ctype_digit($_GET['hi']) && $_SESSION["actype"] ==="student")  
{  

    if ( isset($_GET['hi']) && !$_GET['hi'] == "" )
    {
    
            if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
            {  
                $stmt = $conn->prepare("SELECT * FROM `favourite` WHERE `stud_id` =:student AND `tutor_id` =:tutor");
                $stmt->bindParam(":tutor",$_GET['hi']);
                $stmt->bindParam(":student",$_SESSION["identity"], PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();

               try {
                
                if ($_SESSION["actype"] ==="student"){
                if ($count ===0){
                $stmt1 = $conn->prepare("INSERT INTO `favourite`(`stud_id`, `tutor_id`) VALUES (:student,:tutor)");
                $stmt1->bindParam(":tutor",$_GET['hi']);
                $stmt1->bindParam(":student",$_SESSION["identity"], PDO::PARAM_STR);
                $stmt1->execute();
                }else if ($count >0){
                $stmt2 = $conn->prepare("DELETE FROM `favourite` WHERE `stud_id`=:student AND `tutor_id`=:tutor");
                $stmt2->bindParam(":tutor",$_GET['hi']);
                $stmt2->bindParam(":student",$_SESSION["identity"], PDO::PARAM_STR);
                $stmt2->execute();
                }
                $val = $_GET['hi'];
               header("location:profile.php?profile=$val");
               }
               }
               catch(PDOException $e){
                   {
                   echo "Error: " . $e->getMessage();
                   }
               }
    
        }
    
    }

}
else  
{  
     header("location:loging.php");  
}

$new_sessionid = session_regenerate_id(true);



?>