<?php
session_start();
$user_id = $_SESSION['user_id'];

echo <<<_END
	<link rel="stylesheet" type="text/css" href="css/checkout.css">
	
	<title>checkout</title>
_END;

echo <<<_END

<body>
    <div class="mainscreen">
      <div class="card">
        <div class="leftside">
          <img
            src="images/checkout3.png"
            class="product"
            alt="Shoes"
          />
        </div>
        <div class="rightside">
          
            <h1>CheckOut</h1>
            <h2>Payment Information</h2>
            <p>Cardholder Name</p>
            <input type="text" class="inputbox" name="name"  required />
            <p>Card Number</p>
            <input type="text" class="inputbox" name="card_number" id="card_number"  required />

            <p>Card Type</p>
            <select class="inputbox" name="card_type" id="card_type" required>
              <option value="">--Select a Card Type--</option>
              <option value="Visa">Visa</option>
              <option value="RuPay">RuPay</option>
              <option value="MasterCard">MasterCard</option>
            </select>
<div class="expcvv">

            <p class="expcvv_text">Expiry</p>
            <input type="date" class="inputbox" name="exp_date" id="exp_date" required />

            <p class="expcvv_text2">CVV</p>
            <input type="password" class="inputbox" name="cvv" id="cvv"  required />
        </div>
            <p></p>
            <button type="submit" class="button" onclick="alert('Thank you for purchasing, you can now see your courses in your info section!'); window.location.href='HomePage.php'">CheckOut</button>
        
        </div>
      </div>
    </div>
  
  </body>
_END;

?>