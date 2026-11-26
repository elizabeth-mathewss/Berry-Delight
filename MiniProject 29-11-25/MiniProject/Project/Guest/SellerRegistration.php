<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$contact=$_POST["txt_contact"];
	$address=$_POST["txt_address"];
	
	
	$proof=$_FILES["file_proof"]["name"];
	$path=$_FILES["file_proof"]["tmp_name"];
	move_uploaded_file($path,'../Assets/Files/SellerDocs/'.$proof);
	
	$place_id=$_POST["sel_place"];
	
	$district=$_POST["sel_district"];
	$place=$_POST["sel_place"];
	
	
	$photo=$_FILES["file_photo"]["name"];
	$path=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($path,'../Assets/Files/SellerDocs/'.$photo);
	
	$password=$_POST["txt_password"];
	
$InsQry="insert into tbl_seller 
	   (seller_name,seller_email,seller_contact,seller_address,seller_photo,seller_proof,seller_password,place_id)
	values('$name','$email','$contact','$address','$photo','$proof','$password','$place_id')";
  if($Con->query($InsQry))
  {
	?>
	<script>
	alert("Data Inserted");
    window.location("SellerRegistration.php"); 
	</script>
    <?php
  }
else
  {
	echo "failed to insert";
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Berry Delight - Seller Registration</title>
<style>
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f5e9;
    margin: 0;
    padding: 0;
    background-image: url('https://img.freepik.com/free-photo/wooden-table-top-with-blurred-background_1253-21.jpg');
    background-size: cover;
    background-attachment: fixed;
  }
  
  .container {
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }
  
  .header {
    text-align: center;
    margin-bottom: 30px;
    position: relative;
  }
  
  .header h1 {
    color: #8b4513;
    font-size: 36px;
    margin-bottom: 10px;
  }
  
  .header p {
    color: #666;
    font-size: 16px;
  }
  
  .nut-icon {
    width: 50px;
    height: 50px;
    margin-bottom: 15px;
  }
  
  .form-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  .form-left {
    flex: 1;
    min-width: 300px;
    padding-right: 20px;
  }
  
  .form-right {
    flex: 1;
    min-width: 300px;
    padding-left: 20px;
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
  }
  
  .btn:hover {
    background-color: #a0522d;
    transform: translateY(-2px);
  }
  
  .btn-cancel {
    background-color: #999;
    margin-left: 10px;
  }
  
  .btn-cancel:hover {
    background-color: #777;
  }
  
  .nut-animation {
    text-align: center;
    margin: 20px 0;
  }
  
  .footer {
    text-align: center;
    margin-top: 30px;
    color: #666;
    font-size: 14px;
  }
  
  .video-container {
    margin: 30px 0;
    text-align: center;
  }
  
  .video-placeholder {
    width: 100%;
    max-width: 500px;
    height: 300px;
    background-color: #f0e6d2;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    overflow: hidden;
  }
</style>
</head>

<body>
<div class="container">
  <div class="header">
    <!-- <img src="../Assets/Templates/Main/img/logo.jpg" alt="Nut Icon" class="nut-icon" style="width: 20%; height: 20%;"> -->
    <!-- <img src="https://cdn-icons-png.flaticon.com/512/3081/3081840.png" alt="Nut Icon" class="nut-icon">  -->

    <h1>Join Berry Delight Seller Family</h1>
    <p>Sell your premium dry fruits to thousands of happy customers</p>
  </div>
  
  <div class="nut-animation">
    <!-- <img src="https://media.giphy.com/media/3o7TKMt1VV26qJrm8M/giphy.gif" alt="Dry Fruits Animation" style="max-width: 300px; border-radius: 10px;"> -->
  </div>
  
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <div class="form-container">
      <div class="form-left">
        <div class="form-group">
          <label for="txt_name">Full Name</label>
          <input type="text" name="txt_name" id="txt_name" minlength="3" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required="required" placeholder="Full Name"/>
        </div>
        
        <div class="form-group">
          <label for="txt_email">Email</label>
          <input type="email" name="txt_email" id="txt_email" required="required" placeholder="Email"/>
        </div>
        
        <div class="form-group">
          <label for="txt_contact">Contact</label>
          <input type="text" name="txt_contact" id="txt_contact" pattern="[6-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" required="required" placeholder="Contact"/>
        </div>
        
        <div class="form-group">
          <label for="txt_address">Address</label>
          <textarea name="txt_address" id="txt_address" cols="45" rows="5" required="required" placeholder="Your business address"></textarea>
        </div>
      </div>
      
      <div class="form-right">
        <div class="form-group">
          <label for="sel_district">District</label>
          <select name="sel_district" id="sel_district" onChange="AjaxPlace(this.value)" required="required">
            <option value="">Select District</option>
            <?php 
            $sel="select * from tbl_district";
            $result=$Con->query($sel);
            while($data=$result->fetch_assoc())
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
          <label for="file_photo">Profile Photo</label>
          <input type="file" name="file_photo" id="file_photo" required="required"/>
        </div>
        
        <div class="form-group">
          <label for="file_proof">ID Proof</label>
          <input type="file" name="file_proof" id="file_proof" required="required"/>
        </div>
        
        <div class="form-group">
          <label for="txt_password">Password</label>
          <input type="password" name="txt_password" id="txt_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required" placeholder="Create a strong password"/>
        </div>
      </div>
    </div>
    
    <div class="video-container">
      <!-- <div class="video-placeholder"> -->
        <!-- <img src="https://media.giphy.com/media/3o7TKsQ8UQ4D5AQdI4/giphy.gif" alt="Dry Fruits Preparation" style="max-width: 100%; height: auto;"> -->
      </div>
    </div>
    
    <div style="text-align: center; margin-top: 30px;">
      <input type="submit" name="btn_submit" id="btn_submit" value="Join Berry Delight" class="btn" />
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
    function AjaxPlace(disId) 
    {
        $.ajax({
        url:"../Assets/AjaxPages/AjaxPlace.php?did="+disId,
        success: function(html){
            $("#sel_place").html(html);
        }
        });
    }
</script>
</body>
</html>