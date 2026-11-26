<?php
include("../Assets/Connection/Connection.php");
include("../Assets/AjaxPages/AjaxMail.php");
session_start();


if(isset($_GET['bid'])) {
    $_SESSION["bid"] = $_GET['bid'];
}

$booking_id = isset($_SESSION['bid']) ? $_SESSION['bid'] : null;

if ($booking_id !== null) {
    $selC = "select * from tbl_booking where booking_id ='". $booking_id. "'";
    $res = $Con->query($selC);
    $data = $res->fetch_assoc();
} else {
    $data = ["booking_amount" => 0]; // fallback value
}


if(isset($_POST["btn_payment"]))
{
    $up = "update tbl_booking set booking_status = 2 where booking_id=".$_SESSION["bid"];
    if($Con->query($up))
    {
        $selectUserDetailsQuery = "SELECT * FROM tbl_booking b INNER JOIN tbl_user u ON b.user_id = u.user_id WHERE b.booking_id = '" . $_SESSION["bid"] . "'";
        $userResult = $Con->query($selectUserDetailsQuery);
        $userData = $userResult->fetch_assoc();

        $userEmail = $userData['user_email'];
        $userName = $userData['user_name'];
        $bookingAmount = $userData['booking_amount'];

        $productListHTML = "<table border='1' cellpadding='5' style='border-collapse: collapse;'>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>";

        $selectCartItemsQuery = "SELECT * FROM tbl_cart c INNER JOIN tbl_product p ON c.product_id = p.product_id INNER JOIN tbl_stock s ON s.product_id = p.product_id  WHERE c.booking_id = '" . $_SESSION["bid"] . "'";
        $cartItemsResult = $Con->query($selectCartItemsQuery);

        while ($item = $cartItemsResult->fetch_assoc()) {
            $productListHTML .= "<tr>
                                    <td>" . $item['product_name'] . "</td>
                                    <td>" . $item['cart_qty'] . "</td>
                                    <td>" . $item['product_price'] . "</td>
                                 </tr>";
        }
        $productListHTML .= "</table>";

        $emailSubject = "Order Confirmation - #" . $booking_id;
        $emailBody = "Hello " . $userName . ",<br><br>
                      Thank you for your order! Your payment has been successfully processed. 
                      Here are your order details:<br><br>" . $productListHTML .
                      "<br><strong>Total Amount: " . $bookingAmount . " ₹</strong><br><br>
                      We will notify you again once your order is shipped.<br><br>
                      Thank you,<br>
                      Berry Delight";

        sendMail($userEmail, $emailSubject, $emailBody);

        ?>
        <script>
        window.location="Loader.html";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" Content="IE=edge">
    <meta name="viewport" Content="width=device-width, initial-scale=1.0">
    <title>Secure Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #f5f7fa;
        display: flex;
        justify-Content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .payment-Container {
        width: 100%;
        max-width: 480px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .payment-header {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: white;
        padding: 24px;
        text-align: center;
        position: relative;
    }

    .payment-header h2 {
        font-weight: 600;
        font-size: 22px;
        margin-bottom: 8px;
    }

    .payment-header p {
        opacity: 0.9;
        font-size: 14px;
    }

    .payment-logo {
        font-size: 36px;
        margin-bottom: 12px;
    }

    .payment-body {
        padding: 24px;
    }

    .payment-method {
        margin-bottom: 24px;
    }

    .method-tabs {
        display: flex;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 20px;
    }

    .method-tab {
        padding: 12px 16px;
        font-size: 14px;
        font-weight: 500;
        color: #6b7280;
        cursor: pointer;
        position: relative;
        flex: 1;
        text-align: center;
    }

    .method-tab.active {
        color: #2563eb;
    }

    .method-tab.active:after {
        Content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background: #2563eb;
    }

    .method-Content {
        display: none;
    }

    .method-Content.active {
        display: block;
    }

    .card-form, .upi-form {
        margin-top: 16px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-Control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
    }

    .form-Control:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-Control::placeholder {
        color: #9ca3af;
    }

    .form-row {
        display: flex;
        gap: 16px;
    }

    .form-col {
        flex: 1;
    }

    .payment-amount {
        background: #f9fafb;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
        display: flex;
        justify-Content: space-between;
        align-items: center;
    }

    .amount-label {
        font-size: 14px;
        color: #6b7280;
    }

    .amount-value {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
    }

    .btn-pay {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-pay:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .payment-footer {
        padding: 16px 24px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-Content: center;
        gap: 24px;
    }

    .payment-iCon {
        font-size: 28px;
        color: #6b7280;
    }

    .fa-cc-visa {
        color: #1a1f71;
    }

    .fa-cc-mastercard {
        color: #eb001b;
    }

    .fa-cc-amex {
        color: #016fd0;
    }

    .security-note {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
        font-size: 12px;
        color: #6b7280;
    }

    .security-note i {
        color: #10b981;
    }

    .card-preview {
        height: 180px;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 12px;
        padding: 20px;
        color: white;
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        justify-Content: space-between;
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        transition: all 0.3s;
    }

    .card-chip {
        width: 40px;
        height: 30px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-Content: center;
    }

    .card-chip i {
        color: #ffd700;
    }

    .card-number {
        font-size: 18px;
        letter-spacing: 2px;
        margin: 15px 0;
        font-family: 'Courier New', monospace;
    }

    .card-details {
        display: flex;
        justify-Content: space-between;
        font-size: 14px;
        text-transform: uppercase;
    }

    .card-name, .card-expiry {
        opacity: 0.8;
    }

    .upi-apps {
        display: flex;
        justify-Content: space-between;
        margin: 20px 0;
    }

    .upi-app {
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        padding: 10px;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .upi-app:hover {
        background: #f3f4f6;
    }

    .upi-app-iCon {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-Content: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 8px;
    }

    .upi-app-iCon i {
        font-size: 24px;
    }

    .upi-app-name {
        font-size: 12px;
        color: #4b5563;
    }

    .upi-id-input {
        position: relative;
    }

    .upi-id-input i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
    }

    .upi-id-input input {
        padding-left: 40px !important;
    }

    @media (max-width: 480px) {
        .payment-Container {
            border-radius: 0;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .upi-apps {
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .upi-app {
            width: calc(33% - 10px);
        }
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" Content="IE=edge" />
  <meta name="viewport" Content="width=device-width, initial-scale=1.0" />
  <title>Secure Payment</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <style>
    /* Keep your full CSS here, no changes needed */
  </style>
</head>

<body>
  <form action="" method="post">
    <div class="payment-Container">
      <div class="payment-header">
        <div class="payment-logo">
          <i class="far fa-credit-card"></i>
        </div>
        <h2>Secure Payment</h2>
        <p>Complete your purchase with Confidence</p>
      </div>

      <div class="payment-body">
        <div class="payment-method">
          <div class="method-tabs">
            <div class="method-tab active" data-tab="credit-card">
              <i class="fas fa-credit-card"></i> Credit Card
            </div>
            <div class="method-tab" data-tab="upi">
              <i class="fas fa-mobile-alt"></i> UPI
            </div>
          </div>

          <!-- Credit Card Content -->
          <div class="method-Content active" id="credit-card-Content">
            <!-- Credit card preview and form -->
            <div class="card-preview">
              <div class="card-chip"><i class="fas fa-microchip"></i></div>
              <div class="card-number" id="card-preview-number">•••• •••• •••• ••••</div>
              <div class="card-details">
                <div class="card-name" id="card-preview-name">CARDHOLDER NAME</div>
                <div class="card-expiry" id="card-preview-expiry">••/••</div>
              </div>
            </div>

            <div class="card-form">
              <div class="form-group">
                <label class="form-label">Card Number</label>
                <input type="text" class="form-Control" id="credit-card" required name="txtacno"
                  placeholder="1234 5678 9012 3456" maxlength="19" autocomplete="off" />
              </div>

              <div class="form-group">
                <label class="form-label">Cardholder Name</label>
                <input type="text" class="form-Control" name="txtname" required placeholder="Name as on card"
                  pattern="[a-zA-Z ]{3,15}" autocomplete="off" />
              </div>

              <div class="form-row">
                <div class="form-col">
                  <div class="form-group">
                    <label class="form-label">Expiry Date</label>
                    <input type="text" class="form-Control" id="credit-card-exp" name="txtexpdate" required
                      placeholder="MM/YY" pattern="[0-9/]{5,5}" maxlength="5" autocomplete="off" />
                  </div>
                </div>
                <div class="form-col">
                  <div class="form-group">
                    <label class="form-label">CVV</label>
                    <input type="text" class="form-Control" id="credit-card-ccv" name="txtccv" required
                      placeholder="•••" pattern="[0-9]{3,3}" maxlength="3" autocomplete="off" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- UPI Content -->
          <div class="method-Content" id="upi-Content">
            <div class="upi-apps">
              <div class="upi-app" data-upi="googlepay">
                <div class="upi-app-iCon" style="background: #4285F4;"><i class="fab fa-google-pay"></i></div>
                <div class="upi-app-name">Google Pay</div>
              </div>
              <div class="upi-app" data-upi="phonepe">
                <div class="upi-app-iCon" style="background: #5F259F;"><i class="fas fa-rupee-sign"></i></div>
                <div class="upi-app-name">PhonePe</div>
              </div>
              <div class="upi-app" data-upi="paytm">
                <div class="upi-app-iCon" style="background: #00BAF2;"><i class="fas fa-wallet"></i></div>
                <div class="upi-app-name">Paytm</div>
              </div>
              <div class="upi-app" data-upi="amazonpay">
                <div class="upi-app-iCon" style="background: #FF9900;"><i class="fab fa-amazon-pay"></i></div>
                <div class="upi-app-name">Amazon Pay</div>
              </div>
              <div class="upi-app" data-upi="bhim">
                <div class="upi-app-iCon" style="background: #3F51B5;"><i class="fas fa-university"></i></div>
                <div class="upi-app-name">BHIM</div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Enter UPI ID</label>
              <div class="upi-id-input">
                <i class="fas fa-at"></i>
                <input type="text" class="form-Control" name="upi_id" placeholder="yourname@upi"
                  pattern="[a-zA-Z0-9._\\-]+@[a-zA-Z0-9]+" />
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Or enter mobile number</label>
              <div class="upi-id-input">
                <i class="fas fa-mobile-alt"></i>
                <input type="tel" class="form-Control" name="upi_mobile" placeholder="Mobile number linked to UPI"
                  pattern="[0-9]{10}" maxlength="10" />
              </div>
            </div>
          </div>
        </div>

        <div class="payment-amount">
          <div class="amount-label">Total Amount</div>
          <div class="amount-value">₹<?php echo $data["booking_amount"]; ?></div>
        </div>

        <button type="submit" class="btn-pay" name="btn_payment">
          <i class="fas fa-lock"></i> Pay ₹<?php echo $data["booking_amount"]; ?>
        </button>

        <div class="security-note">
          <i class="fas fa-shield-alt"></i>
          <span>Your payment is secured with 256-bit encryption</span>
        </div>
      </div>

      <div class="payment-footer">
        <i class="fab fa-cc-visa payment-iCon"></i>
        <i class="fab fa-cc-mastercard payment-iCon"></i>
        <i class="fab fa-cc-amex payment-iCon"></i>
        <i class="fab fa-cc-paypal payment-iCon"></i>
      </div>
    </div>
  </form>

 <script>
  document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll('.method-tab');

    tabs.forEach(tab => {
      tab.addEventListener('click', function () {
        document.querySelectorAll('.method-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.method-Content').forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        const tabId = this.getAttribute('data-tab');
        document.getElementById(tabId + '-Content').classList.add('active');
        toggleFormValidation(tabId);

        const payBtnIcon = document.querySelector('.btn-pay i');
        payBtnIcon.className = tabId === 'upi' ? 'fas fa-mobile-alt' : 'fas fa-lock';
      });
    });

    function toggleFormValidation(tabId) {
      const creditInputs = document.querySelectorAll('#credit-card-Content input');
      const upiInputs = document.querySelectorAll('#upi-Content input');
      creditInputs.forEach(input => input.disabled = (tabId !== 'credit-card'));
      upiInputs.forEach(input => input.disabled = (tabId !== 'upi'));
    }

    // UPI app autofill
    document.querySelectorAll('.upi-app').forEach(app => {
      app.addEventListener('click', function () {
        let upiInput = document.querySelector('[name="upi_id"]');
        if (upiInput) {
          upiInput.value = this.getAttribute('data-upi') + '@upi';
        }
      });
    });

    // Live preview and formatting
    const cardNumber = document.getElementById("credit-card");
    const cardName = document.querySelector('[name="txtname"]');
    const cardExpiry = document.getElementById("credit-card-exp");
    const cardCvv = document.getElementById("credit-card-ccv");

    const previewNumber = document.getElementById("card-preview-number");
    const previewName = document.getElementById("card-preview-name");
    const previewExpiry = document.getElementById("card-preview-expiry");

    cardNumber.addEventListener("input", () => {
      const clean = cardNumber.value.replace(/\D/g, '').slice(0, 16);
      cardNumber.value = clean.match(/.{1,4}/g)?.join(' ') || '';
      previewNumber.textContent = cardNumber.value || '•••• •••• •••• ••••';
    });

    cardName.addEventListener("input", () => {
      previewName.textContent = cardName.value.toUpperCase() || 'CARDHOLDER NAME';
    });

    cardExpiry.addEventListener("input", () => {
      const clean = cardExpiry.value.replace(/\D/g, '').slice(0, 4);
      cardExpiry.value = clean.length > 2 ? clean.slice(0, 2) + '/' + clean.slice(2) : clean;
      const parts = cardExpiry.value.split('/');
      previewExpiry.textContent = (parts[0] || '••').padEnd(2, '•') + '/' + (parts[1] || '••').padEnd(2, '•');
    });

    cardExpiry.addEventListener("change", () => {
      const [mm, yy] = cardExpiry.value.split('/');
      const date = new Date();
      if (!mm || !yy || mm < 1 || mm > 12 || +yy < date.getFullYear() % 100 || (+yy === date.getFullYear() % 100 && +mm < date.getMonth() + 1)) {
        alert('Invalid expiration date');
        cardExpiry.value = '';
      }
    });

    cardCvv.addEventListener("input", () => {
      cardCvv.value = cardCvv.value.replace(/\D/g, '').slice(0, 3);
    });

    document.querySelectorAll('.form-Control').forEach(input => {
      input.addEventListener('focus', function () {
        const label = this.parentNode.querySelector('.form-label');
        if (label) label.style.color = '#2563eb';
      });
      input.addEventListener('blur', function () {
        const label = this.parentNode.querySelector('.form-label');
        if (label) label.style.color = '#374151';
      });
    });

    toggleFormValidation('credit-card');
  });
</script>

</body>
</html>