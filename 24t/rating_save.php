
<?php
require_once('db.php');
session_start();
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();

if (isset($_POST)){
    $miao = $_POST["rating"];
    //echo "Stars: ".$miao ."<br>" ;
   // ECHO "comments :"." ".$_POST["comments"];
}

if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && isset($_SESSION["actype"])  )
 {  
    if (hash_equals($csrf, $_POST['csrf'])) {
    if ( isset($_POST['rate']) && !$_POST['rate'] == "" && ctype_digit($_POST['rate']))
    {
      //var_dump($_POST);
        if ($_SESSION["actype"] ==="student"){
            $stmt = $conn->prepare ("SELECT * FROM `rating` WHERE `stud_id` = :id AND `rating_id` = :rate and`r_message` = '' AND r_stars = 0 ");
            $stmt->bindParam(':id', $_SESSION["identity"], PDO::PARAM_INT);
            $stmt->bindParam(':rate', $_POST['rate'], PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $take = $stmt->fetch();
            
          //var_dump($stmt);
          if ($count == 0){
            header("location:login_success.php");
          }else{
            $stmt2 = $conn->prepare ("UPDATE `rating` SET `r_message`=:comm,`r_stars`=:star,`r_datetime`=CURRENT_TIMESTAMP WHERE `stud_id` =:stid AND `rating_id` =:rid ");
            if ($miao <= 0){
              $nums = 1;
            }elseif($miao > 5){
              $nums = 5;
            }else{
              $nums = $miao;
            }
            echo $nums;
            $stmt2->bindParam(':comm', $_POST['comments'], PDO::PARAM_STR);
            $stmt2->bindParam(':stid', $_SESSION["identity"], PDO::PARAM_INT);
            $stmt2->bindParam(':star', $nums, PDO::PARAM_INT);
            $stmt2->bindParam(':rid', $_POST["rate"], PDO::PARAM_STR);

            $stmt2->execute();
            $val = $take['tutor_id']; 
            header("location:profile.php?profile=$val");
            
          }

        }else{
          header("location:login_success.php");
        }

    }

    }else{
        header("location:login_success.php");
      } // for csrf testing
    
 }

  $new_sessionid = session_regenerate_id(true);

 ?>