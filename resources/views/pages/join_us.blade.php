@extends('layouts.frontend')
@section('content')

<style>
    .row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}



.btn:hover {
  background-color: #45a049;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>

<div class="container">
    <script>  
      (function(d, s, id){
        var js, mpesa = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://cdn.jsdelivr.net/gh/muaad/mpesa_button@master/src/button.min.js";
        mpesa.parentNode.insertBefore(js, mpesa);
      }(document, 'script', 'mpesa_btn_js'));
    </script>
    <div class="row">
    <div class="col-75">
        <div class="container">
        <form action="" method="POST">

            <div class="row">
            <div class="col-50">
                <h3>Billing Address</h3>
                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" placeholder="john@example.com">
                <label for="adr"><i class="fa fa-address-card-o"></i> Phone Number</label>
                <input type="text" id="number" name="number" placeholder="0712345678">
                
            </div>

            <div class="col-50">
                <h3>Payment</h3>
                <label for="fname">Accepted Cards</label>
                <div id='mpesaButton' data-phone='254722XXXXXX' data-amount=3000 data-url='https://domain.com/mpesa/payments/request'>
                  
                </div>
        
            </div>

            </div>
            <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
            </label>
            <input type="submit" value="Continue to checkout" class="btn" style="background-color: #04AA6D;">
        </form>
        </div>
    </div>
    

    
</div>

@endsection