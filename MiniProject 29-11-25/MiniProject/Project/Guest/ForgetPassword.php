<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password - Berry Delight</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: url('../Assets/Images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        .forget-password-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .forget-password-container h2 {
            color: #a77b28ff;
            margin-bottom: 20px;
            font-family: 'Raleway', sans-serif;
            font-weight: 800;
        }
        .forget-password-container table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        .forget-password-container td {
            padding: 10px;
        }
        .forget-password-container input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .forget-password-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #b47b24ff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .forget-password-container input[type="submit"]:hover {
            background-color: #a3742dff;
        }
        .back-link {
            margin-top: 20px;
            display: block;
            color: #aa822aff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="forget-password-container">
        <h2>Forget Password</h2>
        <form action="" method="post">
            <table border='1'>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="txt_email" id=""></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Reset" name="btn_submit"></td>
                </tr>
            </table>
        </form>
        <a href="login.php" class="back-link">Back to Login</a>
    </div>

    <?php
    session_start();
    include("../Assets/Connection/Connection.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../Assets/phpMail/src/Exception.php';
    require '../Assets/phpMail/src/PHPMailer.php';
    require '../Assets/phpMail/src/SMTP.php';

    function generateOTP($length = 6) {
        $digits = '0123456789';
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $digits[rand(0, strlen($digits) - 1)];
        }
        return $otp;
    }

    function otpEmail($email,$otp){
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'berrydelight08@gmail.com'; // Your gmail
        $mail->Password = 'wseu wtkf nuqg iwfk'; // Your gmail app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
      
        $mail->setFrom('berrydelight08@gmail.com'); // Your gmail
      
        $mail->addAddress($email);
      
        $mail->isHTML(true);
        $message = 
        '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            border-radius: 5px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Your OTP Code
        </div>
        <p>Hello,</p>
        <p>Here is your One-Time Password (OTP) for verification:</p>
        <h2 style="font-size: 36px; color: #333;">' . $otp . '</h2>
        <p>This OTP is valid for the next 5 minutes. Please use it to complete your verification process.</p>
        <p>If you did not request this OTP, please ignore this email or contact support if you have concerns.</p>
        <p>Best regards,<br>Berry Delight</p>
        <div class="footer">
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
';
        $mail->Subject = "Reset your password";  //Your Subject goes here
        $mail->Body = $message; //Mail Body goes here
      if($mail->send())
      {
        ?>
<script>
    alert("Email Send")
    window.location="OTP_validator.php";
</script>
        <?php
      }
      else
      {
        ?>
<script>
    alert("Email Failed")
</script>
        <?php
      }
    }

    if(isset($_POST['btn_submit'])){
        $email=$_POST['txt_email'];
        $selUser="select * from tbl_user where user_email='".$email."'";	
        $selSeller="select * from tbl_seller where seller_email='".$email."'";
        $resUser=$Con->query($selUser);
        $resSeller=$Con->query($selSeller);
        $otp = generateOTP();
        $_SESSION['otp'] = $otp;
        if($userData=$resUser->fetch_assoc())
        {
            $_SESSION['ruid'] = $userData['user_id'];
            otpEmail($email,$otp);
        }
        else if($sellerData=$resSeller->fetch_assoc())
        {
            $_SESSION['rsid'] = $sellerData['seller_id'];
            otpEmail($email,$otp);
        }
        else{
        ?>
            <script>
            alert("Account Doesn't Exists")
            </script>
        <?php	
        }
    }
    ?>
</body>
</html>