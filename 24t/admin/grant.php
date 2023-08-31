<?php 
 require_once('db.php');

 if (isset($_GET["approve"]) && ctype_digit($_GET['approve'])){
 $stmt1 = $conn->prepare("SELECT `tutor_id` FROM `tutor` WHERE `tutor_id`=:id AND `t_active`=1 AND `t_officialcheck`=0");
 $stmt1->bindParam(':id', $_GET["approve"], PDO::PARAM_INT);
 $stmt1->execute();
 //$result = $stmt1->fetchAll();
 $count = $stmt1->rowCount();

 if($count > 0)
 {
    $stmt2 = $conn->prepare("UPDATE `tutor` SET `t_officialcheck`=1 , `t_checked_date`=CURRENT_TIMESTAMP WHERE `tutor_id`=:id");
    $stmt2->bindParam(':id', $_GET["approve"], PDO::PARAM_INT);
    if ($stmt2->execute()){

        header( "location: approve_tutor.php" );
    }
 }

}

?>