<?php
session_start();	
require_once 'db.php';
require_once("csrf.php");
$old_sessionid = session_id();
session_regenerate_id();
$new_sessionid = session_regenerate_id(true);


if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
{  

   try {
       
    if ($_SESSION["actype"] ==="tutor"){
       $stmt_tutor = $conn->prepare("SELECT  a.payment_id,a.stud_id,c.stud_fname,c.stud_lname, a.sub_name,a.bookingdate,a.appoint_hrs,a.status FROM payment_info a,student c WHERE `tutor_id` =:id AND a.stud_id = c.stud_id");
       $stmt_tutor->bindParam(':id', $_SESSION["identity"], PDO::PARAM_STR);
	   $stmt_tutor->execute();
        //print_r($stmt_tutor);
        //echo "hi";
        $count = $stmt_tutor->rowCount();
        $result = $stmt_tutor->fetchAll();


        $stmt_tutor2 = $conn->prepare("SELECT * FROM `nonavailable` WHERE `tutor_id`=:id AND `booked`=0");
        $stmt_tutor2->bindParam(':id', $_SESSION["identity"], PDO::PARAM_STR);
        $stmt_tutor2->execute();
        //fetch from non available table
         $result2 = $stmt_tutor2->fetchAll();
 
     //DEBUG  echo "true<br>";
    }
    if ($_SESSION["actype"] ==="student"){
        header("location:calendar.php"); 
		
     //DEBUG  echo "true1";	print_r($result);
   }
   }
   catch(PDOException $e){
       {
       echo "Error: " . $e->getMessage();
       }
   }

}
else  
{  
     session_destroy();
     header("location:loging.php");  
}

?>

<!DOCTYPE html>
<html lang="en">

<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>24HoursTutor</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />

<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<style>
	th,
td {
  padding: 0.25em 0.5em 0.25em 1em;
  vertical-align: text-top;
  text-indent: 0.3em;
}

th {
  vertical-align: bottom;
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  font-weight: bold;
}

td::before {
  display: none;
}

tr:nth-child(even) {
  background-color: rgba(255, 255, 255, 0.25);
}

tr:nth-child(odd) {
  background-color: rgba(255, 255, 255, 0.5);
}


body {font-family: "Lato", sans-serif;
  background-image: url("https://i.imgur.com/Pn8lRqi.jpg");
  background-repeat: no-repeat;
	width:100%; height:100%;
	}

.mySlides {display: none}
.topnav .login-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width:120px;
}

.topnav .login-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background-color: #555;
  color: white;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .login-container button:hover {
  background-color: green;
}

@media screen and (max-width: 600px) {
  .topnav .login-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .login-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
    body {
        padding-top: 70px;

        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
	#calendar {
		max-width: 800px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
	#color_code {
		margin: auto;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

   <!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-blue w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="map4.php" class="w3-bar-item w3-button w3-padding-large"><img src="24hrs2.png" style="width:180px; height:40px" title="24hrs Tutor" alt="24hrs Tutor"></a>
    <div class="topnav">
    <div class="login-container w3-hide-small">
    <form action="">
       <?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Main Menu</a>";
        }else{
          echo "<a href='registering.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Register</a>";
          echo "<a href='loging.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>Login</a>";
          echo "<a href='reset.php' class='w3-bar-item w3-button w3-padding-large w3-hide-small'>?</a>";
        }
       ?>
    </form>
  </div></div>
    </div>
  </div>
	<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
<?php
       if(isset($_SESSION["username1"]) && isset($_SESSION["identity"]) && $_SESSION["actype"])  
        {
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a>";
        }
       ?>
</div>

</div><br><br><br><br><br>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>My Schedule</h1>
                <p class="lead">Show all status</p>
								<div id="color_code">
								<h3 style="background-color:#008000;color:white;">Pending</h3>
								<h3 style="background-color:#4285F4;color:white;">Success</h3>
								<h3 style="background-color:black; color:white;">Cancel</h3>
                                <?php if($_SESSION['actype']==="tutor"){echo "<h3 style='background-color:#FF4500; color:white;'>Non Available</h3>";}?>
								</div>
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Nonavailable Time</h4>
			  </div>
			  <div class="modal-body">
				 
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
					</div>
					<div class="form-group">
					<label for="start" class="col-sm-2 control-label">Time</label>
					<div class="col-sm-10">
					  <select name="time" class="form-control" id="color">
					<option value="09:00">09:00</option>
					<option value="10:00">10:00</option>
				<option value="11:00">11:00</option>
				<option value="12:00">12:00</option>
				<option value="13:00">13:00</option>
				<option value="14:00">14:00</option>
				<option value="15:00">15:00</option>
				<option value="16:00">16:00</option>
				<option value="17:00">17:00</option>
				<option value="18:00">18:00</option>
				<option value="19:00">19:00</option>
				<option value="20:00">20:00</option>
					</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Duration hrs</label>
					<div class="col-sm-10">
					  <select name="duration" class="form-control" id="color">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						  
						</select>
					</div>
				  </div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Appointment</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Student & Subject</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title" readonly>
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Start Time</label>
					<div class="col-sm-10">
					<input type="text" name="color" id="color" class="form-control" id="title" placeholder="Title" readonly>
					</div>
					</div>
					<div class="form-group">
					<label for="color" class="col-sm-2 control-label">End Time</label>
					<div class="col-sm-10">
					<input type="text" name="end" id="end" class="form-control" id="title" placeholder="Title" readonly>
					</div>
				  </div>
				    <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10"  title="only use to delete non available time">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete" title="only use to delete non available time"> Delete event</label>
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	
	<script>


    $(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: new Date(),
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.start);
					$('#ModalEdit #end').val(event.end);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($result2 as $event): 
			
				$start = $event['nonavailable_date']." ".$event['start_time'];
		
                                        $hrs = $event['duration'];
										$conceive = "+".$hrs." hour";
										//display the converted time
										$end = date('Y-m-d H:i',strtotime($conceive,strtotime($start)));

			?>
				{
					id: '<?php echo $event['nonavailable_id']; ?>',
					title: '<?php echo "nonavilable" ; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo "#FF4500"; ?>',
				},
			<?php endforeach; ?>
            <?php foreach($result as $event): 
			
            $start = explode(" ", $event['bookingdate']);
            //$end = explode(" ", $event['end']);

                $start = $start[0];

                if($start[1] == '00:00:00'){
                $start = $start[0];
            }else{
                $start = $event['bookingdate'];
            }

            /*if($end[1] == '00:00:00'){
                $end = $end[0];
            }else{
                $end = $event['end'];
            }*/
            switch ($event['status']) {
                case "success":
                    $color ="#4285F4";
                    break;
                case "cancel":
                    $color ="#000";
                    break;
                case "pending":
                    $color ="#008000";
                    break;
                }
                                    $resName = $event['stud_fname'].' '.$event['stud_lname'].'  :  '.$event['sub_name']; 
                                    $hrs = $event['appoint_hrs'];
                                    $conceive = "+".$hrs." hour";
                                    //display the converted time
                                    $end = date('Y-m-d H:i',strtotime($conceive,strtotime($start)));
        ?>
            {
                id: '<?php echo "none"; ?>',
                title: '<?php echo $resName ; ?>',
                start: '<?php echo $start; ?>',
                end: '<?php echo $end; ?>',
                color: '<?php echo $color; ?>',
            },
        <?php endforeach; ?>
			]
		});






		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
		
	});
				// Used to toggle the menu on small screens when clicking on the menu button
			function myFunction() {
					var x = document.getElementById("navDemo");
					if (x.className.indexOf("w3-show") == -1) {
							x.className += " w3-show";
					} else { 
							x.className = x.className.replace(" w3-show", "");
					}
			}

			// When the user clicks anywhere outside of the modal, close it
			var modal = document.getElementById('ticketModal');
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}

</script>

</body>

</html>
