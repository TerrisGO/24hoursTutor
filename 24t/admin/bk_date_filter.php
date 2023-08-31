<?php

require_once('db.php');
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
    $stmt1 = $conn->prepare("SELECT * FROM `payment_info` WHERE `paytime` BETWEEN :frd AND :tod Order By `paytime` DESC");
    $stmt1->bindParam(':frd',$_POST["from_date"], PDO::PARAM_STR);
    $stmt1->bindParam(':tod', $_POST["to_date"], PDO::PARAM_STR);
    $stmt1->execute();
    $result = $stmt1->fetchAll();
    $count = $stmt1->rowCount();
    $number_of_results  = $stmt1->rowCount();

    $output .= '  
                                 <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Payment_ID</th>
                                                <th>Paytime</th>
                                                <th>Amount</th>
                                                <th>Stud_ID</th>
                                                <th>Tutor_id</th>
                                                <th>Subjects</th>
                                                <th>Booking Date</th>
                                                <th>Duration(hrs)</th>
                                                <th>status</th>
                                                <th>cancel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div class="alert alert-success">
                                            <strong>Total Results:  ';  
                                            $output .= $count;
                                            $output .= '</strong>';

    if($count > 0)  
      {  
            foreach ($result as $row)  
           {  
                $output .= "  
            <tr>      
                <td><b>".$row['payment_id']."</b></td>
                <td><b>".$row['paytime']."</b></td>  
                <td><b>RM ".$row['payamount']."</b></td>
                <td><b>".$row['stud_id']."</b></td>   
                <td><b>".$row['tutor_id']."</b></td>  
                <td><b>".$row['sub_name']."</b></td>
                <td><b>".$row['bookingdate']."</b></td>  
                <td><b>".$row['appoint_hrs']."</b></td>  
                <td><b>".$row['status']."</b></td>  
                <td><b>".$row['cancel_reason']."</b></td>   
           </tr>"; 
           }
            }else{
            echo '
            <tr>
                <td colspan="8" align="center">No Records Yet</td>
            </tr>
            ';

            }
      $output .= '</div>                                        </tbody>
      </table>';  
      echo $output;  


 }
 



?>