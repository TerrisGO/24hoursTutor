<!DOCTYPE html>
<html lang="en" >

<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 
  <meta charset="UTF-8">
  <title>24HoursTutor</title>
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
  
  
      <link rel="stylesheet" href="css/cancel_style.css">

  
</head>

<body>

  

<form action="canceling.php" method="post">
    <!--  General -->
    <div class="form-group">
      <h2 class="heading">Booking Info</h2>
      <div class="controls">
        <input type="text" id="name" readonly value="Name: <?php echo $_GET["name"];?>">
      </div>
      <div class="controls">
        <input type="text" id="res1"  readonly value="Subject: <?php echo $res1;?>">
      </div>       
      <div class="controls">
        <input type="tel" id="res2" readonly value="Appoint Time: <?php echo $res2;?>">
      </div>
          <div class="controls">
        <input type="tel" id="res3" readonly value="Paid Date: <?php echo $res3;?>">
      </div>
  
    </div>
    <!--  Details -->
    <div class="form-group">
        
       </div>
        <div class="grid">
          <p class="info-text">Please describe your cancel resons</p>
          <br>
          
          <div class="controls">
            <textarea name="comments" class="floatLabel" id="comments"></textarea>
            <label for="comments">Comments</label>
            </div>
            <input type="hidden" name="csrf" value="<?php  echo $csrf; ?>">
            <input type="hidden" name="bookid" value="<?php echo $_GET["cancel"]; ?>">
              <button type="submit" value="Submit" class="col-1-4" name="submit">Submit</button>
        </div>  
    </div> <!-- /.form-group -->
  </form>
  <form action="match.php">
    <input type="submit" value="Not to cancel" />
</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://raw.githubusercontent.com/andiio/selectToAutocomplete/master/jquery-ui-autocomplete.js'></script>
<script src='http://raw.githubusercontent.com/andiio/selectToAutocomplete/master/jquery.select-to-autocomplete.js'></script>
<script src='http://raw.githubusercontent.com/andiio/selectToAutocomplete/master/jquery.select-to-autocomplete.min.js'></script>

  

    <script  src="js/cancel_index.js"></script>




</body>

</html>
