<?php 
 require_once('db.php');

$stmt1 = $conn->prepare("SELECT `t_gender`, count(*) as number  FROM `tutor` GROUP BY t_gender");
$stmt1->execute();
$result = $stmt1->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <title>24HoursTutor</title>
</head>
<body>
  <div class="container">
    <canvas id="myChart"></canvas>
  </div>

  <script>
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
      type:'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:[<?php  
        $lastElement = end($result);
                           foreach ($result as $row) { 
                            $num = ",";
                            if($row == $lastElement) {
                                $num = ""; 
                           }
                               echo "'".$row["t_gender"]."'".$num."";
                          }  
                          ?>],
        datasets:[{
          label:'Population',
          data:[<?php  
                    $lastElement = end($result);
                    foreach ($result as $row) { 
                     $num = ",";
                     if($row == $lastElement) {
                         $num = ""; 
                    }
                        echo "'".$row["number"]."'".$num."";
                   }  
                   ?>],
          //backgroundColor:'green',
          backgroundColor:[ 
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'Gender For all Tutor',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
  </script>
</body>
</html>
