<?php

session_start();	
require_once 'db.php';
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();
$new_sessionid = session_regenerate_id(true);

if (isset($_POST['login'])) {
	if (hash_equals($csrf, $_POST['csrf'])) {
	
	$username = ($_POST['username1']);
	$password = ($_POST['password1']);
	
$stmt1 = $conn->prepare("SELECT * FROM tutor WHERE t_usrn=:username AND t_active ='1'");
$stmt1->bindParam(":username",$username);
$stmt1->execute();

$result = $stmt1->fetch(PDO::FETCH_ASSOC);


$stmt2 = $conn->prepare("SELECT * FROM student WHERE stud_usrn=:username AND stud_active ='1'");
$stmt2->bindParam(":username",$username);
$stmt2->execute();

$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

if ($result >0 ||$result2 >0){
   //echo "horray";
		$exit ='1';
        if(password_verify($password,$result['t_pass'])){
            echo"1"; 
			$_SESSION["username1"] = $result['t_usrn'];
			$_SESSION["identity"] = $result['tutor_id'];
			$_SESSION["firstname"] = $result['t_fname'];
			$_SESSION["lastname"] = $result['t_lname'];
			$_SESSION["actype"] = "tutor";
			$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
			$stmt3 = $conn->prepare("UPDATE `tutor` SET `t_lastin`=CURRENT_TIMESTAMP WHERE `tutor_id` =:id");
			$stmt3->bindParam(":id",$_SESSION["identity"]);
			$stmt3->execute();
			header("location:login_success.php");
			$exit ='0';
        }

        if(password_verify($password,$result2['stud_pass'])){
            echo"1"; 
			$_SESSION["username1"] = $result2['stud_usrn'];
			$_SESSION["identity"] = $result2['stud_id'];
			$_SESSION["firstname"] = $result2['stud_fname'];
			$_SESSION["lastname"] = $result2['stud_lname'];
			$_SESSION["actype"] = "student";
			$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
			$stmt4 = $conn->prepare("UPDATE `student` SET `stud_lastin`=CURRENT_TIMESTAMP WHERE `stud_id` =:id");
			$stmt4->bindParam(":id",$_SESSION["identity"]);
			$stmt4->execute();

			header("location:login_success.php"); 
			$exit ='0';
		}
		if ($exit =='1'){
			session_destroy();
			header('location: loging.php?fail=1');
		}

}else if($result <0 || $result2 <0){
	session_destroy();
    header('location: loging.php?fail=1');             // Tells Unity it wasn't successful, so to try again.
}else{
	session_destroy();
	header('location: loging.php?fail=1');     
}
	}else{
	session_destroy();
	header('location: loging.php?fail=1');  
	}
}
?>