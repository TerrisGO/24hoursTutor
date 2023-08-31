<?php
/* Password reset process, updates database with new user password */
require 'db.php';
session_start();
$acctype =$_POST['actype'];
$email =$_POST['email'];
$hash = "";
// Make sure the form is being submitted with method="post"
if (!isset($_POST['newpassword']) || !isset($_POST['confirmpassword']) ||!isset($_POST['email']) ||!isset($_POST['actype'])){
    header("location: error.php");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
$results1 ="0";
$results2 ="0";
    if ($_POST['hash']==""){
        header("location: error.php"); 
    }
    // Make sure the two passwords match
    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 
        $v1 =$_POST['newpassword'];
        $v2 =$_POST['confirmpassword'];
        $new_password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        try {
        if ($acctype == 'student'){
            $stmt_s = $conn->prepare("UPDATE student SET stud_pass=:new_password, stud_hash=:hash WHERE stud_email=:email");
             $stmt_s->bindParam(':email', $email, PDO::PARAM_STR);
             $stmt_s->bindParam(':new_password', $new_password, PDO::PARAM_STR);
             $stmt_s->bindParam(':hash', $hash, PDO::PARAM_STR);
             $stmt_s->execute();
             $results1 = $stmt_s->rowCount();
             echo"student checked"; //debug
             
        }
        if ($acctype == 'tutor'){
                $stmt_t = $conn->prepare("UPDATE tutor SET t_pass=:new_password, t_hash=:hash  WHERE t_email=:email");
                $stmt_t->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt_t->bindParam(':new_password', $new_password, PDO::PARAM_STR);
                $stmt_t->bindParam(':hash', $hash, PDO::PARAM_STR);
                $stmt_t->execute();
                $results2 = $stmt_t->rowCount();
                echo"tutor checked";    //debug
        }
    
        if ( $results1 >0 ) {
            // reset the hash for sucurity purpose    
            $_SESSION['message'] = "Your password has been reset successfully!";
            header("location: success.php");
            echo "pass 1"; //debug
        }
        if ( $results2 >0 ) {
            // reset the hash for sucurity purpose 
            $_SESSION['message'] = "Your password has been reset successfully!";
            header("location: success.php");  
            echo "pass 2"; //debug  
            }
        }
    catch(PDOException $e){
        {
        echo "Error: " . $e->getMessage();
        }
    }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: error.php");    
    }
    header("location: error.php");
}
?>