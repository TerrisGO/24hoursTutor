<?php  

      //export.php  
 if(isset($_POST["export"]))  
 {  //

    $array_tb = array('chat_id', 'stud_id', 'tutor_id');
    $orderby = "chat_id";
    $tbn = "chat";
    exportCSV($tbn,$orderby,$array_tb);
 }  

 if(isset($_POST["export2"]))  
 {  //chatmessage

    $array_tb = array('message_id','sender_name','message','m_timestamp','chat_id');
    $orderby = "message_id";
    $tbn = "chatmessage";
    exportCSV($tbn,$orderby,$array_tb);
 } 

 if(isset($_POST["export3"]))  
 {  //

    $array_tb = array('fav_id','stud_id','tutor_id');
    $orderby = "fav_id";
    $tbn = "favourite";
    exportCSV($tbn,$orderby,$array_tb);
 } 

 if(isset($_POST["export4"]))  
 {  //nonavailable

    $array_tb = array('nonavailable_id','nonavailable_date','booked','tutor_id','start_time','duration');
    $orderby = "nonavailable_id";
    $tbn = "nonavailable";
    exportCSV($tbn,$orderby,$array_tb);
 } 

 if(isset($_POST["export5"]))  
 {  //payment_info

    $array_tb = array('payment_id','paytime','payamount','stud_id','tutor_id','sub_name','bookingdate','appoint_hrs','status','cancel_reason');
    $orderby = "payment_id";
    $tbn = "payment_info";
    exportCSV($tbn,$orderby,$array_tb);
 } 

 if(isset($_POST["export6"]))  
 {  //raing

    $array_tb = array('rating_id','stud_id','r_stud_firstname','r_message','r_stars','r_datetime','tutor_id');
    $orderby = "rating_id";
    $tbn = "rating";
    exportCSV($tbn,$orderby,$array_tb);
 } 

 if(isset($_POST["export7"]))  
 {  //

    $array_tb = array('stud_id','stud_fname','stud_lname','stud_email','stud_usrn','stud_pass','stud_hash','stud_active','stud_travel','stud_zip','stud_district','stud_addr','stud_phone','stud_profilepic','stud_gender','stud_intro','stud_birthdate','stud_registerdate','stud_lastin');
    $orderby = "stud_id";
    $tbn = "student";
    exportCSV($tbn,$orderby,$array_tb);
 } 

 if(isset($_POST["export8"]))  
 {  //

    $array_tb = array('subject_id','subject_name','categories');
    $orderby = "subject_id";
    $tbn = "subject";
    exportCSV($tbn,$orderby,$array_tb);
 } 

 if(isset($_POST["export9"]))  
 {  //

    $array_tb = array('offer_id','subject_id','tutor_id','price_perhrs');
    $orderby = "offer_id";
    $tbn = "subject_offer";
    exportCSV($tbn,$orderby,$array_tb);
 } 

 if(isset($_POST["export10"]))  
 {  //

    $array_tb = array('tutor_id','t_fname','t_lname','t_email','t_usrn','t_pass','t_hash','t_active','t_travel','t_zip','t_district','t_addr','t_phone','t_profilepic','t_gender','t_intro','t_job');
    $orderby = "tutor_id";
    $tbn = "tutor";
    exportCSV($tbn,$orderby,$array_tb);
 } 


 function exportCSV($tbn,$orderby,$array_tb){
    $a = date("Y-m-d_H:i");
    $connect = mysqli_connect("localhost", "root", "", "24t");  
    header('Content-Type: text/csv; charset=utf-8');  
    $str = 'Content-Disposition: attachment; filename='.$tbn.$a.'.csv';
    header($str);  
    $output = fopen("php://output", "w");  
    fputcsv($output, $array_tb);  
    $query = "SELECT * from $tbn ORDER BY $orderby DESC";  
    $result = mysqli_query($connect, $query);  
    while($row = mysqli_fetch_assoc($result))  
    {  
         fputcsv($output, $row);  
    }  
    fclose($output); 
    unset($array_tb); // $foo is gone
 }



 ?>  