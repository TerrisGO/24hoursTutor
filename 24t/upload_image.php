<?php
 require_once('db.php');
 require_once("csrf.php");
 session_start();
 if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
 {  
    if (isset($_POST['Upload'])) {
        /**/$uploaded_name = $_FILES[ 'uploaded' ][ 'name' ];
            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
        /**/$uploaded_size = $_FILES[ 'uploaded' ][ 'size' ];
        /**/$uploaded_type = $_FILES[ 'uploaded' ][ 'type' ];
        /**/$uploaded_tmp  = $_FILES[ 'uploaded' ][ 'tmp_name' ];
        
            // Where are we going to be writing to?
            $target_path   = 'uploads/';
        //    $target_file   = basename( $uploaded_name, '.' . $uploaded_ext ) . '-';
            $target_file   =  md5( uniqid() . $uploaded_name ) . '.' . $uploaded_ext;
            $temp_file     = $target_path; 
        /**/$temp_file    .= DIRECTORY_SEPARATOR . md5( uniqid() . $uploaded_name ) . '.' . $uploaded_ext;
        
        
        if( ( strtolower( $uploaded_ext ) == 'jpg' 
            || strtolower( $uploaded_ext ) == 'jpeg'
            || strtolower( $uploaded_ext ) == 'png' ) 
            && ( $uploaded_size < 2000000 ) 
            && ( $uploaded_type == 'image/jpeg'
            || $uploaded_type == 'image/png' ) 
            && getimagesize( $uploaded_tmp ) ) {
            // Strip any metadata, by re-encoding image (Note, using php-Imagick is recommended over php-GD)
            if( $uploaded_type == 'image/jpeg' ) {
                $img = imagecreatefromjpeg( $uploaded_tmp );
                imagejpeg( $img, $temp_file, 100);
            }
            else {
                $img = imagecreatefrompng( $uploaded_tmp );
                imagepng( $img, $temp_file, 9);
            }
            imagedestroy( $img );
        
            // Can we move the file to the web root from the temp folder?
            if( rename( $temp_file, ( getcwd() . DIRECTORY_SEPARATOR . $target_path . $target_file ) ) ) {
                // Yes!
                try{
                    if ($_SESSION["actype"] ==="tutor"){
                        $stmt_FIND = $conn->prepare("SELECT `t_profilepic` FROM `tutor`  WHERE `tutor_id` =:id");
                        $stmt_tutor = $conn->prepare("UPDATE `tutor` SET `t_profilepic`=:pic WHERE `tutor_id` =:id");
                        $stmt_tutor->bindParam(':pic', $target_file , PDO::PARAM_STR);
                        $stmt_tutor->bindParam(':id', $_SESSION["identity"] , PDO::PARAM_STR);
                        $stmt_FIND ->bindParam(':id', $_SESSION["identity"] , PDO::PARAM_STR);
                        $stmt_FIND->execute();
                        $stmt_tutor->execute();
                        $res = $stmt_FIND->fetch(PDO::FETCH_ASSOC);
                        $del = $target_path;                        //delete path set
                        $del .=$res['t_profilepic'];
                     }
                     if ($_SESSION["actype"] ==="student"){
                        $stmt_FIND = $conn->prepare("SELECT `stud_profilepic` FROM `student`  WHERE `stud_id` =:id");
                        $stmt_stud = $conn->prepare("UPDATE `student` SET `stud_profilepic`=:pic  WHERE `stud_id`=:id");
                        $stmt_stud->bindParam(':pic', $target_file, PDO::PARAM_STR);
                        $stmt_stud->bindParam(':id',  $_SESSION["identity"], PDO::PARAM_STR);
                        $stmt_FIND ->bindParam(':id', $_SESSION["identity"] , PDO::PARAM_STR);
                        $stmt_FIND->execute();
                        $stmt_stud->execute();
                        $res = $stmt_FIND->fetch(PDO::FETCH_ASSOC);
                        $del = $target_path;                        //delete path set
                        $del .=$res['stud_profilepic'];
                        }
                    }
                        catch(PDOException $e){
                        {
                        echo "Error: " . $e->getMessage();
                        }
                      }
                if( file_exists( $del ) && $del != "uploads/default.png"){
                  unlink( $del );  
                }
                
              // execute query
              header('location: login_success.php');
                    }
            else {
                // No
                header('location: login_success.php?fail=1');
            }
            echo $uploaded_tmp;
            // Delete any temp files
            if( file_exists( $temp_file ))
                unlink( $temp_file );
        }
            else {
            // Invalid file
        /**/  header('location: login_success.php?fail=1');
        }
        }
 }  
 else  
 {  
      session_destroy();
      header("location:loging.php");  
 }  

 
$new_sessionid = session_regenerate_id(true);


?>