<?php
include("../Assets/Connection/Connection.php");
include("Header.php"); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

  require '../Assets/phpMail/src/Exception.php';
  require '../Assets/phpMail/src/PHPMailer.php';
  require '../Assets/phpMail/src/SMTP.php';

if(isset($_GET["aid"]))
{
  $selqry="select * from tbl_seller where seller_id='".$_GET["aid"]."'";
  $res=$Con->query($selqry);
  $data=$res->fetch_assoc();
  

		$email=$data["seller_email"];
	$name = $data["seller_name"];
		$message ="hello you are accepted";
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
  
    $mail->Subject = "Subject ";  //Your Subject goes here
    $mail->Body = "Message from". $name."<br>".$message; //Mail Body goes here
  if($mail->send())
  {
    ?>
<script>
    alert("Email Send")
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
	$upqry="update tbl_seller set seller_status='1' where seller_id='".$_GET["aid"]."'";
	if($Con->query($upqry))
	{
		?>
        <script>
		alert("Status updated");
		window.location="Sellerlist.php";
		</script>
        <?php
	}
}
	if(isset($_GET["rid"]))
	{
     $selqry="select * from tbl_seller where seller_id='".$_GET["rid"]."'";
  $res=$Con->query($selqry);
  $data=$res->fetch_assoc();
  

		$email=$data["seller_email"];
	$name = $data["seller_name"];
		$message ="hello you are rejected";
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
  
    $mail->Subject = "Subject ";  //Your Subject goes here
    $mail->Body = "Message from". $name."<br>".$message; //Mail Body goes here
  if($mail->send())
  {
    ?>
<script>
    alert("Email Send")
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
		$upqry="update tbl_seller set seller_status='2' where seller_id='".$_GET["rid"]."'";
		if($Con->query($upqry))
		{
			?>
            <script>
			alert("Rejected");
			window.location="Sellerlist.php";
            </script>
            <?php
		}
	}

	?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin - Seller List</title>
<style>
/* Unique styles for seller list page */
.sellerlist-page-container {
    width: 95%;
    margin: 30px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #2c2c2c;
}

.sellerlist-page-title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin: 40px 0 20px 0;
    color: #4a2e00; /* dark walnut shade */
    border-bottom: 2px solid #c19a6b;
    padding-bottom: 8px;
}

.sellerlist-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 50px;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
}

.sellerlist-table th {
    background-color: #c19a6b; /* dry fruit tone */
    color: #fff;
    padding: 12px;
    text-align: center;
    font-size: 15px;
    letter-spacing: 0.5px;
}

.sellerlist-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
    vertical-align: middle;
}

.sellerlist-table tr:nth-child(even) {
    background-color: #fdf6f0; /* almond beige */
}

.sellerlist-table tr:hover {
    background-color: #f5e1c8;
}

.sellerlist-action a {
    display: inline-block;
    margin: 4px 0;
    text-decoration: none;
    background: #4a2e00;
    color: #fff;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 13px;
    transition: 0.3s;
}

.sellerlist-action a:hover {
    background: #c19a6b;
    color: #fff;
}

.sellerlist-section {
    margin-top: 50px;
}
</style>
</head>

<body>
<div class="sellerlist-page-container">

  <h2 class="sellerlist-page-title">Unverified Sellers</h2>
  <table class="sellerlist-table">
    <tr>
      <th>SL.NO</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Address</th>
      <th>Photo</th>
      <th>Proof</th>
      <th>District</th>
      <th>Place</th>
      <th>Action</th>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where seller_status=0";
    $row=$Con->query($selQry);
    while($data=$row->fetch_assoc())
    {
      $i++;
      ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data ['seller_name'] ?></td>
        <td><?php echo $data ['seller_email'] ?></td>
        <td><?php echo $data ['seller_contact'] ?></td>
        <td><?php echo $data ['seller_address'] ?></td>
        <td><img src="../Assets/Files/SellerDocs/<?php echo $data ['seller_photo']?>" width="90" height="90" /></td>
        <td><img src="../Assets/Files/SellerDocs/<?php echo $data ['seller_proof']?>" width="90" height="90" /></td>
        <td><?php echo $data ['district_name'] ?></td>
        <td><?php echo $data ['place_name'] ?></td>
        <td class="sellerlist-action">
            <a href="SellerList.php?aid=<?php echo $data['seller_id'] ?>">Accept</a><br>
            <a href="SellerList.php?rid=<?php echo $data['seller_id'] ?>">Reject</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>


  <div class="sellerlist-section">
    <h2 class="sellerlist-page-title">Accepted Sellers</h2>
    <table class="sellerlist-table">
      <tr>
        <th>SL.NO</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>District</th>
        <th>Place</th>
        <th>Photo</th>
        <th>Proof</th>
        <th>View Product</th>
        <th>Action</th>
      </tr>
      <?php
      $sel="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where seller_status=1";
      $res=$Con->query($sel);
      $i=0;
      while($row=$res->fetch_assoc())
      {
        $i++;
      ?>
      <tr>
        <td><?php echo $i?></td>
        <td><?php echo $row['seller_name']?></td>
        <td><?php echo $row['seller_email']?></td>
        <td><?php echo $row['seller_contact']?></td>
        <td><?php echo $row['seller_address']?></td>
        <td><?php echo $row['district_name']?></td>
        <td><?php echo $row['place_name']?></td>
        <td><img width="90" height="90" src="../Assets/Files/SellerDocs/<?php echo $row['seller_photo']?>" /></td>
        <td><img width="90" height="90" src="../Assets/Files/SellerDocs/<?php echo $row['seller_proof']?>" /></td>
        <td><a href="../User/ViewProduct.php?sid=<?php echo $row['seller_id']?>">View Products</a></td>
        <td class="sellerlist-action"><a href="SellerList.php?Reject=<?php echo $row['seller_id'] ?>">Reject</a></td>
      </tr>
      <?php
      }
      ?>
    </table>
  </div>


  <div class="sellerlist-section">
    <h2 class="sellerlist-page-title">Rejected Sellers</h2>
    <table class="sellerlist-table">
      <tr>
        <th>SL.NO</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>District</th>
        <th>Place</th>
        <th>Photo</th>
        <th>Proof</th>
        <th>Action</th>
      </tr>
      <?php
      $sel2="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where seller_status=2";
      $result=$Con->query($sel2);
      $i=0;
      while($rows=$result->fetch_assoc())
      {
        $i++;
      ?>
      <tr>
        <td><?php echo $i?></td>
        <td><?php echo $rows['seller_name']?></td>
        <td><?php echo $rows['seller_email']?></td>
        <td><?php echo $rows['seller_contact']?></td>
        <td><?php echo $rows['seller_address']?></td>
        <td><?php echo $rows['district_name']?></td>
        <td><?php echo $rows['place_name']?></td>
        <td><img width="90" height="90" src="../Assets/Files/SellerDocs/<?php echo $rows['seller_photo']?>" /></td>
        <td><img width="90" height="90" src="../Assets/Files/SellerDocs/<?php echo $rows['seller_proof']?>" /></td>
        <td class="sellerlist-action"><a href="SellerList.php?aid=<?php echo $rows['seller_id']?>">Accept</a></td>
      </tr>
      <?php
      }
      ?>
    </table>
  </div>

</div>
</body>
</html>
<?php
include("Footer.php"); 
?>
