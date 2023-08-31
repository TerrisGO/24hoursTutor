<?php 
 require_once('db.php'); 
 session_start();
 require_once("csrf.php");
 $old_sessionid = session_id();
 session_regenerate_id();

        $sbj_p = $_POST['subject_p'];
        $sbj_n = $_POST['subject_name'];
        $tutor = $_POST['tutor_n'];
        $hour = $_POST['hour'];
        $book_d = $_POST['appoint_date'];
        $tutor_id = $_POST['tutor_id'];

        $stmt = $conn->prepare("SELECT `tutor_id` FROM `tutor` WHERE `tutor_id` =:id AND`t_officialcheck`=1");
        $stmt->bindParam(':id', $tutor_id , PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() < 0) {
            header("location:loging.php"); 
          }//check whether tutor account is having approval

 if(!isset($_SESSION["username1"]) && !isset($_SESSION["identity"]) && !isset($_SESSION["actype"])  )
 {  
    session_destroy();
    header("location:loging.php");  
 }
 if ($_SESSION["actype"] ==="tutor"){
    header("location:login_success.php"); 
 }

 if (isset($_POST["submit"]) && !$sbj_p=="" && !$sbj_n==""  && !$tutor=="" && !$hour=="" && !$book_d=="" && !$tutor_id=="" ){
    if (hash_equals($csrf, $_POST['csrf'])) {
        if (ctype_digit($sbj_p) && ctype_digit($hour) && $hour >=1 || $hour <=5){
            $total = $sbj_p * $hour;
        }else {
            header("Location: ".$_SERVER['HTTP_REFERER']); 
        }

      } else{
    header("location:noresults.php"); 
  }
  }else{
    header("location:noresults.php"); 
  }
 
 $new_sessionid = session_regenerate_id(true);
?>



<!DOCTYPE html>
<html lang="en" >

<head><link rel="icon" href="uploads/24t.jpeg" type="image/gif" sizes="16x16"> 

  <meta charset="UTF-8">
  <title>24HoursTutor</title>
  
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <style>
      body { margin:50px auto; width:600px;}

/* CSS for Credit Card Payment form */
.credit-card-box .panel-title {
    display: inline;
    font-weight: bold;
    margin: 0 auto;
}
.credit-card-box .form-control.error {
    border-color: red;
    outline: 0;
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
}
.credit-card-box label.error {
  font-weight: bold;
  color: red;
  padding: 2px 8px;
  margin-top: 2px;
}
.credit-card-box .payment-errors {
  font-weight: bold;
  color: red;
  padding: 2px 8px;
  margin-top: 2px;
}
.credit-card-box label {
    display: block;
}
/* The old "center div vertically" hack */
.credit-card-box .display-table {
    display: table;
}
.credit-card-box .display-tr {
    display: table-row;
}
.credit-card-box .display-td {
    display: table-cell;
    vertical-align: middle;
    width: 50%;
}
/* Just looks nicer */
.credit-card-box .panel-heading img {
    min-width: 180px;
}
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
}
    </style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


</head>

<body translate="no" >

  <div class="container">
<div class="row">
<!-- You can make it whatever width you want. I'm making it full width
on <= small devices and 4/12 page width on >= medium devices -->
<div class="col-xs-12 col-md-4">
<?php
        if ( isset($_GET['fail']) && $_GET['fail'] == 1){
            echo '        <br />
            <div class="alert">
              <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
              <strong>Canceling Fail !</strong>   For Student can only cancel before 3 hours start <br>
              For Tutor can cancel after 20 minutes start 
            </div>';
        }
    ?>

<!-- CREDIT CARD FORM STARTS HERE -->
<div class="panel panel-default credit-card-box">
<div class="panel-heading display-table" >
<div class="row display-tr" >
<h3 class="panel-title display-td" >Payment Details</h3>
<div class="display-td" >                            
<img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
</div>
</div>                    
</div>
<div class="panel-body">
<form role="form" id="payment-form" action ='analysis.php' method='POST'>
<div class="row">
<div class="col-xs-12">
<div class="form-group">
<label for="cardNumber">CARD NUMBER</label>
<div class="input-group">
<input 
type="tel"
class="form-control"
name="cardNumber"
maxlength='16'
placeholder="Valid Card Number"
autocomplete="cc-number"
required autofocus 
/>
<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
</div>
</div>                            
</div>
</div>
<div class="row">
<div class="col-xs-7 col-md-7">
<div class="form-group">
<label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
<input 
type="tel" 
class="form-control" 
name="cardExpiry"
placeholder="MM / YY"
autocomplete="cc-exp"
maxlength='4'
required 
/>
</div>
</div>
<div class="col-xs-5 col-md-5 pull-right">
<div class="form-group">
<label for="cardCVC">CV CODE</label>
<input 
type="tel" 
class="form-control"
name="cardCVC"
placeholder="CVC"
maxlength='3'
autocomplete="cc-csc"
required
/>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12">
<div class="form-group">
<label for="couponCode">Tutor's Name:   &nbsp&nbsp  <?php echo $tutor;?></label>
<label for="couponCode">Total Amount:  &nbsp&nbsp   <?php echo $total;?></label>
<label for="couponCode">Subject Name:  &nbsp&nbsp   <?php echo $sbj_n;?></label>
<label for="couponCode">Hours:    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $hour;?></label>
<label for="couponCode">Booking Date:  &nbsp&nbsp   <?php echo $book_d;?></label>
</div>
</div>                        
</div>
<?php echo "<input type='text' id='emp' value='$total' hidden='true' name='subject_p'/>";
echo "<input type='text'  value='$sbj_n' hidden='true' name='subject_name'/>";
echo "<input type='text'  value='$tutor' hidden='true' name='tutor_n'/>";
echo "<input type='text'  value='$hour' hidden='true'' name='hour'/>";
echo "<input type='text'  value='$book_d' hidden='true'  name='appoint_date'/>";
echo "<input type='text'  value='$tutor_id' hidden='true' name='tutor_id'/>";?>
<input type="hidden" name="csrf" value="<?php echo $csrf; ?>">
<div class="row">
<div class="col-xs-12">
<button class="btn btn-success btn-lg btn-block" type="submit" name="submit">Confirm transaction</button>
</div>
</div> \
<div class="row" style="display:none;">
<div class="col-xs-12">
<p class="payment-errors"></p>
</div>
</div>
</form>
</div>
</div>            
<!-- CREDIT CARD FORM ENDS HERE -->


</div>            



</div>
</div>

	<!-- If you're using Stripe for payments -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	
</body>
    <script src="//static.codepen.io/assets/common/stopExecutionOnTimeout-41c52890748cd7143004e05d3c5f786c66b19939c4500ce446314d1748483e13.js"></script>

  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js'></script>

  

    <script >
      var $form = $('#payment-form');
$form.on('submit', payWithStripe);

/* If you're using Stripe for payments */
function payWithStripe(e) {
    e.preventDefault();

    /* Visual feedback */
    $form.find('[type=submit]').html('Validating <i class="fa fa-spinner fa-pulse"></i>');

    var PublishableKey = 'pk_test_b1qXXwATmiaA1VDJ1mOVVO1p'; // Replace with your API publishable key
    Stripe.setPublishableKey(PublishableKey);
    
    /* Create token */
    var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
    var ccData = {
        number: $form.find('[name=cardNumber]').val().replace(/\s/g,''),
        cvc: $form.find('[name=cardCVC]').val(),
        exp_month: expiry.month, 
        exp_year: expiry.year
    };
    
    Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
        if (response.error) {
            /* Visual feedback */
            $form.find('[type=submit]').html('Try again');
            /* Show Stripe errors on the form */
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.payment-errors').closest('.row').show();
        } else {
            /* Visual feedback */
            $form.find('[type=submit]').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
            /* Hide Stripe errors on the form */
            $form.find('.payment-errors').closest('.row').hide();
            $form.find('.payment-errors').text("");
            // response contains id and card, which contains additional card details            
            console.log(response.id);
            console.log(response.card);
            var token = response.id;
            // AJAX - you would send 'token' to your server here.
            $.post('/account/stripe_card_token', {
                    token: token
                })
                // Assign handlers immediately after making the request,
                .done(function(data, textStatus, jqXHR) {
                    $form.find('[type=submit]').html('Payment successful <i class="fa fa-check"></i>').prop('disabled', true);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    $form.find('[type=submit]').html('There was a problem').removeClass('success').addClass('error');
                    /* Show Stripe errors on the form */
                    $form.find('.payment-errors').text('Try refreshing the page and trying again.');
                    $form.find('.payment-errors').closest('.row').show();
                });
        }
    });
}
/* Fancy restrictive input formatting via jQuery.payment library*/
$('input[name=cardNumber]').payment('formatCardNumber');
$('input[name=cardCVC]').payment('formatCardCVC');
$('input[name=cardExpiry').payment('formatCardExpiry');

/* Form validation using Stripe client-side validation helpers */
jQuery.validator.addMethod("cardNumber", function(value, element) {
    return this.optional(element) || Stripe.card.validateCardNumber(value);
}, "Please specify a valid credit card number.");

jQuery.validator.addMethod("cardExpiry", function(value, element) {    
    /* Parsing month/year uses jQuery.payment library */
    value = $.payment.cardExpiryVal(value);
    return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
}, "Invalid expiration date.");

jQuery.validator.addMethod("cardCVC", function(value, element) {
    return this.optional(element) || Stripe.card.validateCVC(value);
}, "Invalid CVC.");

validator = $form.validate({
    rules: {
        cardNumber: {
            required: true,
            cardNumber: true            
        },
        cardExpiry: {
            required: true,
            cardExpiry: true
        },
        cardCVC: {
            required: true,
            cardCVC: true
        }
    },
    highlight: function(element) {
        $(element).closest('.form-control').removeClass('success').addClass('error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-control').removeClass('error').addClass('success');
    },
    errorPlacement: function(error, element) {
        $(element).closest('.form-group').append(error);
    }
});

paymentFormReady = function() {
    if ($form.find('[name=cardNumber]').hasClass("success") &&
        $form.find('[name=cardExpiry]').hasClass("success") &&
        $form.find('[name=cardCVC]').val().length > 1) {
        return true;
    } else {
        return false;
    }
}

$form.find('[type=submit]').prop('disabled', true);
var readyInterval = setInterval(function() {
    if (paymentFormReady()) {
        $form.find('[type=submit]').prop('disabled', false);
        clearInterval(readyInterval);
    }
}, 250);


/*
https://goo.gl/PLbrBK
*/
      //# sourceURL=pen.js
    </script>



  
  

  <script src="https://static.codepen.io/assets/editor/live/css_reload-2a5c7ad0fe826f66e054c6020c99c1e1c63210256b6ba07eb41d7a4cb0d0adab.js"></script>
</body>

</html>
 
