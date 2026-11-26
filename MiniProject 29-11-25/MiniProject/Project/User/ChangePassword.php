
<?php
include("../Assets/Connection/Connection.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
  require '../Assets/phpMail/src/PHPMailer.php';
  require '../Assets/phpMail/src/SMTP.php';

$SelQry="select * from tbl_user where user_id='".$_SESSION["uid"]."'";
$row=$Con->query($SelQry);
$data=$row->fetch_assoc();
$dbpassword=$data["user_password"];
if(isset($_POST["btn_submit"]))
{
	$old=$_POST["txt_oldpassword"];
	$new=$_POST["txt_newpassword"];
	$confirm=$_POST["txt_confirmpassword"];
	if($dbpassword==$old)
	{
		if($new==$confirm)
		{
			$UpQry="update tbl_user set user_password='".$confirm."' where user_id='".$_SESSION["uid"]."'";
			if($Con->query($UpQry))
			{
                $mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';      // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'berrydelight08@gmail.com'; // Your email
    $mail->Password   = 'wseuwtkfnuqgiwfk';   // App password (not normal Gmail password)
    $mail->SMTPSecure = 'tls';                 // encryption
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('yourgmail@gmail.com', 'Berry Delight');
    $mail->addAddress($data["user_email"], $data["user_name"]); // user email from DB

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Password Changed Successfully';
    $mail->Body    = "
        <h3>Hello ".$data["user_name"].",</h3>
        <p>Your password has been changed successfully on <b>Berry Delight</b>.</p>
        <p>If this wasn’t you, please reset your password immediately.</p>
        <br>
        <p>Regards,<br>Berry Delight Team</p>
    ";

    $mail->send();
    // Optional: log success
} catch (Exception $e) {
    error_log("Mailer Error: {$mail->ErrorInfo}");
}
?>
			?>
            <script>
			alert("Password Updated");
			window.location="MyProfile.php";
			</script>
            <?php
			}
		else
		{
			?>
			<script>
			alert("Password Mismatch");
			</script>
            <?php
            }
	  }
	else
	{
		?>
        <script>
		alert("Password Incorrect");
		</script>
        <?php
	}
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Berry Delight - Change Password</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
    }
    
    body {
        background: linear-gradient(to right, #f9f6f1, #f3e9d9);
        color: #5a3825;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    .main-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
    }
    
    .page-title {
        text-align: center;
        margin: 10px 0 30px;
        color: #5a3825;
        font-size: 32px;
        position: relative;
        padding-bottom: 15px;
        font-weight: 600;
    }
    
    .page-title:after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #d8a868, #8d5b34);
        margin: 10px auto;
        border-radius: 2px;
    }
    
    .content-card {
        background: white;
        width: 100%;
        max-width: 500px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(90, 56, 37, 0.15);
    }
    
    .card-header {
        background: linear-gradient(135deg, rgba(185, 167, 167, 1) 0%, #918985ff 100%);
        padding: 25px;
        text-align: center;
        color: white;
    }
    
    .card-header h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    
    .card-header p {
        opacity: 0.9;
    }
    
    .card-body {
        padding: 30px;
    }
    
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #5a3825;
        font-size: 16px;
        padding-left: 5px;
    }
    
    .input-with-icon {
        position: relative;
    }
    
    .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #8d5b34;
        font-size: 18px;
    }
    
    .form-group input {
        width: 100%;
        padding: 15px 15px 15px 50px;
        border: 2px solid #e9dcc9;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s;
        color: #5a3825;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: #d8a868;
        box-shadow: 0 0 0 3px rgba(216, 168, 104, 0.3);
    }
    
    .btn-group {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }
    
    .btn {
        padding: 15px 25px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn i {
        margin-right: 8px;
    }
    
    .btn-submit {
        background: linear-gradient(to right, #8d5b34, #5a3825);
        color: white;
        box-shadow: 0 4px 15px rgba(141, 91, 52, 0.3);
    }
    
    .btn-submit:hover {
        background: linear-gradient(to right, #5a3825, #8d5b34);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(141, 91, 52, 0.4);
    }
    
    .btn-cancel {
        background: #f3e9d9;
        color: #5a3825;
        border: 2px solid #d8a868;
    }
    
    .btn-cancel:hover {
        background: #e9dcc9;
        transform: translateY(-2px);
    }
    
    .security-icon {
        text-align: center;
        margin: 20px 0;
    }
    
    .security-icon i {
        font-size: 70px;
        color: #8d5b34;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .security-tips {
        text-align: center;
        margin-top: 20px;
        padding: 15px;
        background: #faf6f0;
        border-radius: 12px;
        border-left: 4px solid #d8a868;
    }
    
    .security-tips h3 {
        color: #5a3825;
        margin-bottom: 10px;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .security-tips h3 i {
        margin-right: 10px;
        color: #8d5b34;
    }
    
    .security-tips p {
        color: #8d5b34;
        font-size: 14px;
        line-height: 1.6;
    }
    
    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
        }
    }
</style>
</head>

<body>
<?php include("Header.php");?>

<div class="main-container">
<div class="main-container">
    <h1 class="page-title">Change Your Password</h1>
    
    <div class="content-card">
        <div class="card-header">
            <h2>Secure Your Account</h2>
            <p>Update your password to keep your account protected</p>
        </div>
        
        <div class="card-body">
            <div class="security-icon">
                <i class="fas fa-lock"></i>
            </div>
            
            <form id="form1" name="form1" method="post" action="">
                <div class="form-group">
                    <label for="txt_oldpassword">Old Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="txt_oldpassword" id="txt_oldpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required" placeholder="Enter your old password"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txt_newpassword">New Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-key"></i>
                        <input type="password" name="txt_newpassword" id="txt_newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required" placeholder="Create a new password"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txt_confirmpassword">Confirm New Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-check-circle"></i>
                        <input type="password" name="txt_confirmpassword" id="txt_confirmpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required" placeholder="Confirm your new password"/>
                    </div>
                </div>
                
                <div class="btn-group">
                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> Update Password
                    </button>
                    <button type="button" name="btn_submit2" id="btn_submit2" class="btn btn-cancel" onclick="window.location.href='MyProfile.php'">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
            
            <div class="security-tips">
                <h3><i class="fas fa-shield-alt"></i> Security Tips</h3>
                <p>Use a unique password that you don't use for other websites. Change your password regularly to keep your account secure.</p>
            </div>
        </div>
    </div>
</div>

<?php include("Footer.php");?>
</body>
</html>