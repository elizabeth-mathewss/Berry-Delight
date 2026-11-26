<?php
$district_id="";
$place_name="";
include("../Assets/Connection/Connection.php"); 

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
  require '../Assets/phpMail/src/PHPMailer.php';
  require '../Assets/phpMail/src/SMTP.php';

if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$contact=$_POST["txt_contact"];
	$address=$_POST["txt_address"];
	$password=$_POST["txt_password"];
	
	$place_id=$_POST["sel_place"];
	$photo=$_FILES["file_photo"]["name"];
	$path=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($path,'../Assets/Files/UserDocs/'.$photo);
  $Email="select * from tbl_user where user_email='".$email."'";
		$row=$Con->query($Email);
		if($data=$row->fetch_assoc())
		  {
			?>
       		 <script>
			alert("This Email is Already Registered !")		
			</script>
     	   <?php	
		  }
		else
		{
$InsQry="insert into tbl_user(user_name,user_email,user_address,user_photo,user_password,place_id,user_contact) values('$name','$email','$address','$photo','$password','$place_id','$contact')";
if($Con->query($InsQry))
{
	// Send mail with PHPMailer
	$mail = new PHPMailer(true);
	try {
		$mail->isSMTP();
		$mail->Host       = 'smtp.gmail.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'berrydelight08@gmail.com'; // replace with your Gmail
		$mail->Password   = 'wseuwtkfnuqgiwfk';   // replace with your Gmail App Password
		$mail->SMTPSecure = 'tls';
		$mail->Port       = 587;

		$mail->setFrom('yourgmail@gmail.com', 'Berry Delight');
		$mail->addAddress($email, $name);

		$mail->isHTML(true);
		$mail->Subject = "Welcome to Berry Delight!";
		$mail->Body    = "
			<h2>Hello $name, Welcome to <b>Berry Delight</b>! Your account has been successfully created.You can now log in using your registered email and password.Happy Shopping</h2>
		";

		$mail->send();
		?>
		<script>
		alert("Data Inserted & Email Sent Successfully!");
		window.location="UserRegistration.php";
		</script>
		<?php
	} catch (Exception $e) {
		?>
		<script>
		alert("Data Inserted, but email could not be sent. Error: <?php echo $mail->ErrorInfo; ?>");
		window.location="UserRegistration.php";
		</script>
		<?php
	}
}
else
{
	echo "Failed to insert";
}
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Berry Delight - User Registration</title>
<style>
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f5e9;
    margin: 0;
    padding: 20px;
    background-image: url('https://img.freepik.com/free-photo/wooden-table-top-with-blurred-background_1253-21.jpg');
    background-size: cover;
    background-attachment: fixed;
  }
  
  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.92);
    border-radius: 15px;
    box-shadow: 0 0 25px rgba(139, 69, 19, 0.2);
  }
  
  .header {
    text-align: center;
    margin-bottom: 30px;
    
  }
  
  .header h1 {
    color: #8b4513;
    font-size: 32px;
    margin-bottom: 10px;
  }
  
  .header p {
    color: #666;
    font-size: 16px;
  }
  
  .nut-icon {
    width: 60px;
    height: 60px;
    margin-bottom: 15px;
  }
  
  .registration-form {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }
  
  .form-left {
    flex: 1;
    min-width: 300px;
  }
  
  .form-right {
    flex: 1;
    min-width: 300px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 8px;
    color: #8b4513;
    font-weight: bold;
  }
  
  input[type="text"],
  input[type="email"],
  input[type="password"],
  textarea,
  select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fffaf0;
    font-size: 16px;
  }
  
  input[type="file"] {
    width: 100%;
    padding: 10px;
    background-color: #fffaf0;
    border: 1px dashed #8b4513;
    border-radius: 5px;
  }
  
  .btn {
    background-color: #8b4513;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s;
    margin-top: 10px;
  }
  
  .btn:hover {
    background-color: #a0522d;
    transform: translateY(-2px);
  }
  
  .btn-cancel {
    background-color: #999;
    margin-left: 15px;
  }
  
  .btn-cancel:hover {
    background-color: #777;
  }
  
  .nut-animation {
    text-align: center;
    margin: 25px 0;
  }
  
  .benefits {
    background-color: #f0e6d2;
    padding: 20px;
    border-radius: 10px;
    margin-top: 30px;
  }
  
  .benefits h3 {
    color: #8b4513;
    margin-top: 0;
  }
  
  .benefits ul {
    padding-left: 20px;
  }
  
  .benefits li {
    margin-bottom: 8px;
  }
  
  .footer {
    text-align: center;
    margin-top: 30px;
    color: #666;
    font-size: 14px;
  }
</style>
</head>

<body>
<div class="container">
  <div class="header">
    <h1>Join Berry Delight</h1>
    <p>Register to explore our premium dry fruits</p>
  </div>
  
  <div class="nut-animation"></div>
  
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <div class="registration-form">
      <div class="form-left">
        <div class="form-group">
          <label for="txt_name">Full Name</label>
          <input type="text" name="txt_name" id="txt_name" minlength="3" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required="required" placeholder="Full Name"/>
          <input type="hidden" name="txt_id" id="txt_id" />
        </div>
        
        <div class="form-group">
          <label for="txt_email">Email</label>
          <input type="email" name="txt_email" id="txt_email" required="required" placeholder="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
         title="Please enter a valid email address with '@' and '.'"/>
        </div>
        
        <div class="form-group">
          <label for="txt_contact">Contact</label>
          <input type="text" name="txt_contact" id="txt_contact" pattern="[6-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" required="required" placeholder="Contact"/>
        </div>
        
        <div class="form-group">
          <label for="txt_address">Delivery Address</label>
          <textarea name="txt_address" id="txt_address" cols="45" rows="5" required="required" placeholder="Your complete address for delivery"></textarea>
        </div>
      </div>
      
      <div class="form-right">
        <div class="form-group">
          <label for="sel_district">District</label>
          <select name="sel_district" id="sel_district" onChange="AjaxPlace(this.value)" required="required">
            <option value="">Select District</option>
            <?php
            $sel="select * from tbl_district";
            $res=$Con->query($sel);
            while($data=$res->fetch_assoc())
            {
                ?>
                <option value="<?php echo $data['district_id']?>">
                <?php echo $data['district_name']?>
                </option>
                <?php
            }
            ?>
          </select>
        </div>
        
        <div class="form-group">
          <label for="sel_place">Place</label>
          <select name="sel_place" id="sel_place" required="required">
            <option value="">Select Place</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="file_photo">Profile Picture</label>
          <input type="file" name="file_photo" id="file_photo"/>
        </div>
        
        <div class="form-group">
          <label for="txt_password">Create Password</label>
          <input type="password" name="txt_password" id="txt_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required" placeholder="Create a strong password"/>
        </div>
      </div>
    </div>
    
    <div style="text-align: center; margin-top: 25px;">
      <input type="submit" name="btn_submit" id="btn_submit" value="Create Account" class="btn" />
      <input type="reset" name="btn_submit2" id="btn_submit2" value="Cancel" class="btn btn-cancel" />
    </div>
  </form>
  
  <div class="footer">
    <p>© 2025 Berry Delight - Premium Dry Fruits Store</p>
    <p>Quality you can taste and trust</p>
  </div>
</div>

<script src="../Assets/JQ/jQuery.js"></script> 
<script>
    function AjaxPlace(did) 
    {
        $.ajax({
        url:"../Assets/AjaxPages/AjaxPlace.php?did="+did,
        success: function(html){
            $("#sel_place").html(html);
        }
        });
    }
</script>
</body>
</html>
