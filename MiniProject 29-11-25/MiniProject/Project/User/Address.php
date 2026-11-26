<?php
session_start();
include("../Assets/Connection/Connection.php");

if (isset($_POST["btn_submit"])) 
{
    $address = $_POST["txt_address"];
        $updateQry = "UPDATE tbl_booking 
                      SET booking_address = '" . $address . "' where booking_id=".$_SESSION["bid"];
					  $res=$Con->query($updateQry);
					  ?>
                      <script>
					  alert("Address updated");
					  window.location="Payment.php";
					  </script>
                      <?php
}

?>
<?php include("Header.php"); ?>
<div class="address-container">
                      

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Address | Berry Delight - Premium Dry Fruits</title>
<style>
    /* Custom Styles for Address Page */
    .address-container {
        padding: 40px 0;
        background-color: #f9f6f1;
        min-height: calc(100vh - 300px);
    }
    
    .address-form-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .page-title {
        color: #7a5c39;
        font-size: 28px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e3d2c0;
        text-align: center;
        font-weight: 600;
    }
    
    .form-section {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
    }
    
    .form-left {
        flex: 1;
        min-width: 300px;
    }
    
    .form-right {
        flex: 1;
        min-width: 300px;
        text-align: center;
    }
    
    .address-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .address-table td {
        padding: 15px 10px;
        vertical-align: top;
    }
    
    .address-table td:first-child {
        font-weight: 600;
        color: #7a5c39;
        width: 30%;
    }
    
    .address-textarea {
        width: 100%;
        padding: 15px;
        border: 2px solid #c19a6b;
        border-radius: 8px;
        font-size: 16px;
        resize: vertical;
        min-height: 150px;
        transition: all 0.3s;
        font-family: inherit;
    }
    
    .address-textarea:focus {
        outline: none;
        border-color: #8b5a2b;
        box-shadow: 0 0 0 3px rgba(139, 90, 43, 0.2);
    }
    
    .submit-btn {
        background: linear-gradient(to right, #7a5c39, #a67c52);
        color: white;
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }
    
    .submit-btn:hover {
        background: linear-gradient(to right, #5a3825, #7a5c39);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .dryfruit-gif {
        max-width: 100%;
        border-radius: 10px;
        margin-bottom: 20px;
        border: 3px solid #c19a6b;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .video-container {
        margin-top: 25px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .info-box {
        background-color: #f5eee3;
        padding: 20px;
        border-radius: 8px;
        margin-top: 25px;
        border-left: 4px solid #c19a6b;
    }
    
    .info-box h3 {
        color: #7a5c39;
        margin-bottom: 15px;
        font-size: 20px;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }
    
    .info-icon {
        font-size: 20px;
        margin-right: 12px;
        width: 30px;
        text-align: center;
    }
    
    .nut-divider {
        text-align: center;
        margin: 20px 0;
        color: #7a5c39;
        font-size: 22px;
        letter-spacing: 8px;
    }
    
    @media (max-width: 768px) {
        .form-section {
            flex-direction: column;
        }
        
        .address-table td:first-child {
            width: 100%;
            display: block;
            padding-bottom: 5px;
        }
        
        .address-table td {
            display: block;
            width: 100%;
        }
    }
</style>
</head>

<body>
    <!-- Main Content -->
    <div class="address-container">
        <div class="container">
            <div class="address-form-container">
                <h2 class="page-title">Update Your Delivery Address</h2>
                
                <div class="form-section">
                    <div class="form-left">
                        <form id="form1" name="form1" method="post" action="">
                            <table class="address-table">
                                <tr>
                                    <td>Delivery Address</td>
                                    <td>
                                        <textarea name="txt_address" id="txt_address" class="address-textarea" required="required" placeholder="Enter your complete delivery address including street, city, state, and zip code..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div align="center">
                                            <input type="submit" name="btn_submit" id="btn_submit" value="Save Address & Continue to Payment" class="submit-btn" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        
                        <!-- <div class="info-box">
                            <h3>Why Update Your Address?</h3>
                            <div class="info-item">
                                <div class="info-icon">🛡️</div>
                                <div><strong>Secure Checkout:</strong> Your information is protected with encryption</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">🚚</div>
                                <div><strong>Free Delivery:</strong> On orders above ₹1000 to most locations</div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">⏱️</div>
                                <div><strong>Fast Shipping:</strong> Orders placed before 3 PM ship same day</div> -->
                            <!-- </div>
                        </div>
                    </div> --> 
                    
                    <div class="form-right">
                        <!-- <img src="https://media.giphy.com/media/l0MYt5jPR6QX5pnx6/giphy.gif" alt="Dry Fruits Package" class="dryfruit-gif" />
                         -->
                        <div class="nut-divider">✦ ✦ ✦</div>
                        
                        <h3>Freshness Guaranteed</h3>
                        <p>We carefully package our premium dry fruits to ensure they arrive fresh and delicious at your doorstep.</p>
                        
                        <!-- <div class="video-container"> -->
                            <!-- <video width="100%" height="auto" controls muted>
                                <source src="https://assets.mixkit.co/videos/preview/mixkit-woman-holding-dry-fruits-12304-large.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("Footer.php"); ?>
</body>
</html>