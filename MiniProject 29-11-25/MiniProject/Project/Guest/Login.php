<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	$email=$_POST["txt_email"];
	$password=$_POST["txt_password"];
	$SelAdmin="select * from tbl_admin where admin_email='".$email."' && admin_password='".$password."'";
	$rowAdmin=$Con->query($SelAdmin);
	
	$selUser="select * from tbl_user where user_email='".$email."' && user_password='".$password."'";
	$rowUser=$Con->query($selUser);
	$selSeller="select * from tbl_seller where seller_email='".$email."' && seller_password='".$password."' && seller_status='1'";
	$rowSeller=$Con->query($selSeller);
	
	
	if($admin=$rowAdmin->fetch_assoc())
	{
		$_SESSION["aid"]=$admin["admin_id"];
		$_SESSION["aname"]=$admin["admin_name"];
    	header("location:../Admin/HomePage.php");
	}
	else if($user=$rowUser->fetch_assoc())
	{
		$_SESSION["uid"]=$user["user_id"];
		$_SESSION["uname"]=$user["user_name"];
		header("location:../User/HomePage.php");
	}
	else if($seller=$rowSeller->fetch_assoc())
	{
		$_SESSION["sid"]=$seller["seller_id"];
		$_SESSION["sname"]=$seller["seller_name"];
		header("location:../Seller/HomePage.php");
	}
	
	else
	{
		?>
    	<script>
		alert("You are rejected. You are unable to login");
		</script>
		<?php 
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Berry Delight- Login</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
  
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  
  body {
    background-color: #f9f5e9;
    background-image: url('https://images.unsplash.com/photo-1603569283847-aa295f0d016a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  
  .login-container {
    display: flex;
    width: 500px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    overflow: hidden;
  }
  
  .login-left {
    flex: 1;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  
  .login-right {
    flex: 1;
    background: linear-gradient(135deg, #e6b980 0%, #eacda3 100%);
    position: relative;
    overflow: hidden;
  }
  
  .brand-logo {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .brand-logo img {
    width: 120px;
    height: auto;
  }
  
  h1 {
	width:100%;
    color: #5c3a21;
    text-align: center;
    margin-bottom: 10px;
    font-size: 28px;
  }
  
  .tagline {
	width:100%;
    color: #7a5c3c;
    text-align: center;
    margin-bottom: 30px;
    font-size: 14px;
  }
  
  .login-form {
    width: 100%;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 8px;
    color: #5c3a21;
    font-weight: 500;
  }
  
  .form-group input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f5e9;
    transition: all 0.3s;
  }
  
  .form-group input:focus {
    outline: none;
    border-color: #e6b980;
    box-shadow: 0 0 0 3px rgba(230, 185, 128, 0.2);
  }
  
  .btn-login {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #e6b980 0%, #eacda3 100%);
    border: none;
    border-radius: 8px;
    color: #5c3a21;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 10px;
  }
  
  .btn-login:hover {
    background: linear-gradient(135deg, #d8a76a 0%, #e0c095 100%);
    transform: translateY(-2px);
  }
  
  .forgot-signup {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    font-size: 13px;
  }
  
  .forgot-signup a {
    color: #7a5c3c;
    text-decoration: none;
    transition: color 0.3s;
  }
  
  .forgot-signup a:hover {
    color: #5c3a21;
    text-decoration: underline;
  }
  
  .nut-animation {
    position: absolute;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .nut-animation img {
    max-width: 80%;
    max-height: 80%;
    animation: float 6s ease-in-out infinite;
  }
  
  @keyframes float {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-20px);
    }
  }
  
  .nut-gif {
    position: absolute;
    width: 80px;
    height: 80px;
    opacity: 0.7;
  }
  
  .nut-gif:nth-child(1) {
    top: 10%;
    left: 10%;
    animation: move1 15s linear infinite;
  }
  
  .nut-gif:nth-child(2) {
    top: 20%;
    right: 15%;
    animation: move2 18s linear infinite;
  }
  
  .nut-gif:nth-child(3) {
    bottom: 15%;
    left: 20%;
    animation: move3 20s linear infinite;
  }
  
  @keyframes move1 {
    0% { transform: translate(0, 0) rotate(0deg); }
    100% { transform: translate(100px, 100px) rotate(360deg); }
  }
  
  @keyframes move2 {
    0% { transform: translate(0, 0) rotate(0deg); }
    100% { transform: translate(-120px, 80px) rotate(-360deg); }
  }
  
  @keyframes move3 {
    0% { transform: translate(0, 0) rotate(0deg); }
    100% { transform: translate(80px, -100px) rotate(360deg); }
  }
  
  .video-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.2;
  }
</style>
</head>
<body>
<div class="login-container">
  <div class="login-left">
    <div class="brand-logo">
      <!-- <img src="https://cdn-icons-png.flaticon.com/512/3081/3081985.png" alt="NutriNuts Logo"> -->
    </div>
    <h1>Welcome Back!</h1>
    <p class="tagline">Sign in to your Berry Delight account</p>
    
    <form id="form1" name="form1" method="post" action="" class="login-form">
      <div class="form-group">
        <label for="txt_email">Email</label>
        <input type="email" name="txt_email" id="txt_email" placeholder="Enter your email" required />
      </div>
      <div class="form-group">
        <label for="txt_password">Password</label>
        <input type="password" name="txt_password" id="txt_password" placeholder="Enter your password" required />
      </div>
      <button type="submit" name="btn_submit" id="btn_submit" class="btn-login">LOGIN</button>
      <div class="forgot-signup">
        <a href="ForgetPassword.php">Forget Password?</a>
        <!-- <a href="#">Forgot password?</a> -->
        <a href="UserRegistration.php">Register as user</a>
         <a href="SellerRegistration.php">Register as seller</a>
      </div>
    </form>
  </div>
  
 
</div>
</body>
</html>