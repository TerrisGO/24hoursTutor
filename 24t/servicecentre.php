<?php
session_start();?>




 <head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16">   
 <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>24HoursTutor</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
      table thead { 
         color: white;font-size: 20px;text-align: center; text-shadow: 1px 1px gold;  }
       td 
       {
       text-align: center;
       height: 50px; 
       width: 50px;
       }
       tr:nth-child(odd){background-color: grey;}
       tr:nth-child(even){background-color: #f2f2f2;}
       .table{
       -webkit-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75);
       -moz-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75);
        box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.75); 
       }
       body {
       background-image: url("http://yesofcorsa.com/wp-content/uploads/2017/09/Breeze-Best-Wallpaper.jpg");
       background-repeat: no-repeat;
       background-position: center bottom;
   }

   .thumbnail{
       margin-left: auto;
       margin-right: auto;
       width: 100%;
   }
   .thumbnail:hover {
       position:relative;
       top:-5px;
       left:-5px;
       width:200px;
       height:auto;
       display:block;
       z-index:999;
   }
   .alert {
     position:relative;
       padding: 20px;
       background-color: #f44336;
       color: white;
       z-index: 2000;
   }
   .alert2 {
     position:relative;
       padding: 20px;
       background-color: GREEN;
       color: white;
       z-index: 2000;
   }
   
   .closebtn {
       margin-left: 15px;
       color: white;
       font-weight: bold;
       float: right;
       font-size: 22px;
       line-height: 20px;
       cursor: pointer;
       transition: 0.3s;
   }
   
   .closebtn:hover {
       color: black;
   }
</style>
      </head>  
      <body>  
      <!DOCTYPE html>
<html>
<title>24HoursTutor</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3_2.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head><link rel="icon" href="../uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
<style>
body {font-family: "Lato", sans-serif}
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
</style>
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
          echo "<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a>";
        }else{
          echo "<a href='registering.php' class='w3-bar-item w3-button w3-padding-large'>Register</a>";
          echo "<a href='loging.php' class='w3-bar-item w3-button w3-padding-large'>Login</a>";
          echo "<a href='reset.php' class='w3-bar-item w3-button w3-padding-large'>?</a>";
        }
       
    ?>
           </form>
  </div></div>
    </div>
  </div>
  <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
<a href='login_success.php' class='w3-bar-item w3-button w3-padding-large'>Main Menu</a></div>

</div><br><br><br><br>

                   <div class="container">  
<div class="table-responsive">  
                     <table id="tb" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                               <td>Department</td>  
                                    <td>IMG</td>  
                                    <td>Address</td>  
                                    <td>Person In Charge</td>
                                    <td>Contact</td>
                               </tr>  
                          </thead>  
 
                               <tr>      
                                    <td><b>Kamunting</b></td>  
                                    <td><img src='uploads/outview.jpg' class='thumbnail' height='50' width='50' /></td>  
                                    <td><b>Kaunter 18-21,
Stesen Bas Kamunting,
Jalan Stesyen,
34600 Kamunting,Perak</b></td>  
                                    <td>Mdm Junaidah<br></td>
                                    <td><b>012-45313432</b></td>
                               </tr>
                               <tr>      
                                    <td><b>Simpang</b></td>  
                                    <td><img src='uploads/2.jpg' class='thumbnail' height='50' width='50' /></td>  
                                    <td><b>No. 9, Medan Simpang, 34600 Simpang, Perak.</b></td>  
                                    <td>Mr Ishak<br></td>
                                    <td><b>018-4345345</b></td>
                               </tr>
                                                              <tr>      
                                    <td><b>Kuala Kangsar</b></td>  
                                    <td><img src='uploads/3.jpg' class='thumbnail' height='50' width='50' /></td>  
                                    <td><b> Kuala Kangsar,
No. 1, Jalan Bendahara,
33000 Kuala Kangsar,Perak.</b></td>  
                                    <td>Ms Noor Bazura<br></td>
                                    <td><b>016-34512354</b></td>
                               </tr>
                                                              <tr>      
                                    <td><b>Butterworth</b></td>  
                                    <td><img src='uploads/4.jpg' class='thumbnail' height='50' width='50' /></td>  
                                    <td><b>11700 Sg Nibong, Bayan Lepas, Pulau PinangTerminal Pengangkutan Sementara Penang Sentral</b></td>  
                                    <td><br>Mrs Afifa</td>
                                    <td><b>016-34512354</b></td>
                               </tr>
                                                              <tr>      
                                    <td><b>Sungai Nibong</b></td>  
                                    <td><img src='uploads/5.jpg' class='thumbnail' height='50' width='50' /></td>  
                                    <td><b> Kuala Kangsar,
No. 1, Jalan Bendahara,
33000 Kuala Kangsar,Perak</b></td>  
                                    <td> Mr Azmi	<br></td>
                                    <td><b>018-4345345</b></td>
                               </tr>
                                                              <tr>      
                                    <td><b>Duta</b></td>  
                                    <td><img src='uploads/6.jpg' class='thumbnail' height='50' width='50' /></td>  
                                    <td><b> Kuala Kangsar,
No. 1, Jalan Bendahara,
33000 Kuala Kangsar,Perak.</b></td>  
                                    <td>Mr Ng Kok Kheong<br></td>
                                    <td><b>016-34512354</b></td>
                               </tr>
                                                              <tr>      
                                    <td><b>TBS</b></td>  
                                    <td><img src='uploads/7.jpg' class='thumbnail' height='50' width='50' /></td>  
                                    <td><b> Kuala Kangsar ,33000 Kuala Kangsar,Perak.</b></td>  
                                    <td>Mr Arujudin<br></td>
                                    <td><b>016-34512354</b></td>
                               </tr>
                                                   </table>  
                </div>  
           </div>  
           </body>
           </html>