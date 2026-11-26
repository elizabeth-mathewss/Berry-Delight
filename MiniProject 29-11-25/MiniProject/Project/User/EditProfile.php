<?php
session_start();
include("../Assets/Connection/Connection.php");

// PHPMailer namespace & requires must be at the top
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
  require '../Assets/phpMail/src/PHPMailer.php';
  require '../Assets/phpMail/src/SMTP.php';

// Fetch user details
$SelQry="select * from tbl_user where user_id='".$_SESSION["uid"]."'";
$res=$Con->query($SelQry);
$data=$res->fetch_assoc();

if(isset($_POST["btn_submit"]))
{
  $name=$_POST["txt_name"];
  $email=$_POST["txt_email"];
  $contact=$_POST["txt_contact"];
  $address=$_POST["txt_address"];

  $UpQry="update tbl_user set user_name='".$name."', user_email='".$email."', user_contact='".$contact."', user_address='".$address."' where user_id='".$_SESSION["uid"]."'";
  
  if($Con->query($UpQry))
  {
    // Send mail after update
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'berrydelight08@gmail.com'; //  Replace with your email
        $mail->Password   = 'wseuwtkfnuqgiwfk';   //  Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('yourgmail@gmail.com', 'Berry Delight');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "Profile Updated Successfully - Berry Delight";
        $mail->Body    = "
          <div style='font-family: Poppins, sans-serif; color: #333;'>
              <h2 style='color:#a35212;'>Hello $name,</h2>
              <p>Your profile has been updated successfully.</p>
              <table style='border-collapse: collapse; width: 100%;'>
                  <tr><td><b>Email:</b></td><td>$email</td></tr>
                  <tr><td><b>Contact:</b></td><td>$contact</td></tr>
                  <tr><td><b>Address:</b></td><td>$address</td></tr>
              </table>
              <p>Thank you for staying with <b>Berry Delight</b>!</p>
          </div>
        ";
        $mail->AltBody = "Hello $name, your profile has been updated successfully.";

        $mail->send();
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
    }

    ?>
    <script>
    alert("Data Updated and Email Sent Successfully!");
    window.location="EditProfile.php";
    </script>
    <?php   
  }
}
?>

<?php include("Header.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Berry Delight</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1615485290382-441e41d08625?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .form-container {
            background: rgba(255,255,255,0.94);
            backdrop-filter: blur(7px);
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.10);
            margin: 2rem auto;
            width: 100%;
            max-width: 540px;
            padding: 2rem 2rem 1.5rem 2rem;
        }
        .form-container h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #a35212;
            margin-bottom: 0.5rem;
        }
        .form-container p {
            color: #888;
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.3rem;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #a35212;
            margin-bottom: 0.35rem;
            font-size: 1rem;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border-radius: 7px;
            border: 1px solid #deb887;
            box-sizing: border-box;
            font-size: 1rem;
            background: #fffdfa;
            transition: border 0.3s;
            margin-top: 0.15rem;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #ffb249;
            outline: none;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.2rem;
        }
        .action-buttons button {
            padding: 0.6rem 2.2rem;
            border-radius: 7px;
            border: none;
            font-size: 1rem;
            font-weight: 500;
            background: #e49b36;
            color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            cursor: pointer;
            transition: background 0.2s;
        }
        .action-buttons button[type="reset"] {
            background: #fffdfa;
            color: #ad671a;
            border: 1px solid #e49b36;
        }
        .action-buttons button:hover {
            background: #ad671a;
            color: #fff;
        }
        @media (max-width: 640px) {
            .form-container {
                padding: 1rem 0.5rem;
                margin: 1rem 0.1rem;
                max-width: 98vw;
            }
            .action-buttons {
                flex-direction: column;
                gap: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="form-container">
            <center><h2>Edit Your Profile</h2>
            <p>Update your details to continue!</p></center>
            <form id="form1" name="form1" method="post" action="">
                <div class="form-group">
                    <label for="txt_name">Name</label>
                    <input type="text" name="txt_name" id="txt_name" minlength="3" 
                           title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" 
                           pattern="^[A-Z]+[a-zA-Z ]*$" required="required" 
                           value="<?php echo $data['user_name']; ?>" />
                </div>
                <div class="form-group">
                    <label for="txt_email">Email</label>
                    <input type="email" name="txt_email" id="txt_email" required="required" 
                           value="<?php echo $data['user_email']; ?>" />
                </div>
                <div class="form-group">
                    <label for="txt_contact">Contact</label>
                    <input type="text" name="txt_contact" id="txt_contact" 
                           pattern="[6-9]{1}[0-9]{9}" 
                           title="Phone number must start with 6-9 and contain 10 digits" required="required"
                           value="<?php echo $data['user_contact']; ?>" />
                </div>
                <div class="form-group">
                    <label for="txt_address">Address</label>
                    <textarea name="txt_address" id="txt_address" cols="45" rows="5" required="required"><?php echo $data['user_address']; ?></textarea>
                </div>
                <div class="action-buttons">
                    <button type="submit" name="btn_submit" id="btn_submit">Submit</button>
                    <button type="reset" name="btn_cancel" id="btn_cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <?php include("Footer.php"); ?>
</body>
</html>
