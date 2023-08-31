<?php
require_once('db.php');
session_start();
require_once("csrf.php");


$_SESSION['email'] = $_POST["username1"];
$_SESSION['first_name'] = $_POST["firstname1"];
$_SESSION['last_name'] =  $_POST["lastname1"];
            
// Value that use to process
$firstname = $_POST["firstname1"];
$lastname = $_POST["lastname1"];
$email = $_POST["email1"];
$usrn = $_POST["username1"];
$pass =  $_POST["password1"];
$str = $_POST["radio"];
//Hash the password as we do NOT want to store our passwords in plain text.
$passwordHash = password_hash($pass, PASSWORD_BCRYPT);
$hash = md5( rand(0,1000) ) ;
$msg ="";
if (isset($_POST['signup1'])) {
if (hash_equals($csrf, $_POST['csrf'])) {
try {

    $stmt_semail = $conn->prepare("SELECT * FROM student WHERE stud_email=:email");
    $stmt_temail = $conn->prepare("SELECT * FROM tutor WHERE t_email=:email");
    $stmt_susrn = $conn->prepare("SELECT * FROM student WHERE stud_usrn=:usrn");
    $stmt_tusrn = $conn->prepare("SELECT * FROM tutor WHERE t_usrn=:usrn"); 

  
     $stmt_semail->bindParam(':email', $email, PDO::PARAM_STR);
     $stmt_temail->bindParam(':email', $email, PDO::PARAM_STR);
     $stmt_susrn->bindParam(':usrn', $usrn, PDO::PARAM_STR);
     $stmt_tusrn->bindParam(':usrn', $usrn, PDO::PARAM_STR);
     $stmt_semail->execute();
     $stmt_temail->execute();
     $stmt_susrn->execute();
     $stmt_tusrn->execute();
     $results1 = $stmt_semail-> fetch();
     $results2 = $stmt_temail-> fetch();
     $results3 = $stmt_susrn-> fetch();
     $results4 = $stmt_tusrn-> fetch();
}
catch(PDOException $e){
    {
    echo "Error: " . $e->getMessage();
    }
}

    

if ($results1 >0 || $results2>0 || $results3 >0 || $results4 >0){

    header('location: registering.php?fail=3');
    if ($results1 >0 ||$results2 >0){
        header('location: registering.php?fail=1');
    }
    if ($results3 >0 || $results4 >0){
        header('location: registering.php?fail=2');
    }
    if($results1 >0 && $results3 >0 || $results2 >0 &&$results4 >0){
        header('location: registering.php?fail=3');
    }
   /* echo$firstname.'<br>';
    echo$lastname.'<br>';
    echo$email.'<br>';
    echo$usrn.'<br>';
    echo$pass.'<br>';
    echo$str.'<br>';                   Just for debugging*/
    
}else {
    if($str=="student"){
        try {  

            // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO student (stud_fname, stud_lname, stud_email, stud_usrn, stud_pass, stud_hash , stud_registerdate) 
        VALUES (:firstname, :lastname, :stud_email, :stud_usrn, :stud_pass, :stud_hash , NOW())");
        $stmt->bindParam(':firstname', $firstname,PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname,PDO::PARAM_STR);
        $stmt->bindParam(':stud_email', $email,PDO::PARAM_STR);
        $stmt->bindParam(':stud_usrn', $usrn,PDO::PARAM_STR);
        $stmt->bindParam(':stud_pass', $passwordHash,PDO::PARAM_STR);
        $stmt->bindParam(':stud_hash', $hash,PDO::PARAM_STR);
        // insert a row
        $stmt->execute();
        sendActiveMail($email,$firstname,$hash,$str);
        header('location: registering.php?success=1');
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    if($str=="tutors"){
        try {  
            // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO tutor (t_fname, t_lname, t_email, t_usrn, t_pass, t_hash , t_registerdate) 
        VALUES (:firstname, :lastname, :t_email, :t_usrn, :t_pass, :t_hash , NOW())");
        $stmt->bindParam(':firstname', $firstname,PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname,PDO::PARAM_STR);
        $stmt->bindParam(':t_email', $email,PDO::PARAM_STR);
        $stmt->bindParam(':t_usrn', $usrn,PDO::PARAM_STR);
        $stmt->bindParam(':t_pass', $passwordHash,PDO::PARAM_STR);
        $stmt->bindParam(':t_hash', $hash,PDO::PARAM_STR);

        $stmt->execute();
        sendActiveMail($email,$firstname,$hash,$str);
        header('location: registering.php?success=1');
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}
}else{
	session_destroy();
	header('location: registering.php?fail=1');  
}
}
function sendActiveMail($email,$firstname,$hash,$str){
    $_SESSION['active'] = 0; //0 until user activates their account with verify.php
    $_SESSION['logged_in'] = true; // So we know the user has logged in
    $_SESSION['message'] =
                
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";


        // Send registration confirmation link (verify.php)
        require_once("mail.php");
        $mail->setFrom('spammerking12345@gmail.com');
        $mail->isHTML(true);
        $mail->addAddress($email);
        $mail->Subject = 'Account Verification ( 24hrs Tutor.com )';
        $Msg = '
        Hello '.$firstname.',

        Thank you for signing up!<br>

        Please click this link to activate your account:<br>

        http://localhost:8080/24t/verify.php?email='.$email.'&hash='.$hash.'&type='.$str; 
        //http://student.kdupg.edu.my/24hourstutor/24t/verify.php?email='.$email.'&hash='.$hash.'&type='.$str;
        $mail->Body = $Msg;
        $mail->send();

        //mail( $to, $subject, $message_body );

}
?>