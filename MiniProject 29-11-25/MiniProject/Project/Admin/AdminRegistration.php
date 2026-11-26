<?php
$admin="";
$aname="";
$aid="";
$email="";
$password="";
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_admin"];
	$email=$_POST["txt_email"];
	$password=$_POST["txt_password"];
	$admin=$_POST["txt_admin"];
    $aid=$_POST["txt_id"];
	if($aid == "")
	{
	$InsQry="Insert into tbl_admin(admin_name,admin_email,admin_password) values('$name','$email','$password')";
	if($Con->query($InsQry))
	{
		//echo "inserted";
		
		?>
        <script>
		alert("Data Inserted");
		window.location="AdminRegistration.php";
		</script>
        <?php
	}
	else
	{
		echo "Failed to insert";
	}
}
else
{
	$UpQry="update tbl_admin set admin_name='".$admin."',admin_email='".$email."',admin_password='".$password."' where admin_id='".$aid."'";
	if($Con->query($UpQry))
	{
		?>
        <script>
		alert("Data Updated");
		window.location="AdminRegistration.php";
		</script>
        <?php
	}
}
}	
if(isset($_GET['delId']))
{
	$DelQry="delete from tbl_admin where admin_id='".$_GET['delId']."'";
	if($Con->query($DelQry))
	{
		?>
        <script>
		alert("Data Deleted");
	    window.location="AdminRegistration.php";
		</script>
        <?php
	}
}

if(isset($_GET['editId']))
{
	$SelQry="select * from tbl_admin where admin_id='".$_GET['editId']."'";
	$res=$Con->query($SelQry);
	$editdata=$res->fetch_assoc();
	$aname=$editdata['admin_name'];
	$aid=$editdata['admin_id'];	
	$email=$editdata['admin_email'];
	$password=$editdata['admin_password'];
}
 
?>
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Registration</title>
</head>

<body>
<form id="form3" name="form3" method="post" action="">
  <table width="275" border="1">
    <tr>
      <td width="160">Name</td>
      <td width="99"><label for="txt_admin"></label>
      <input type="text" name="txt_admin" id="txt_admin" value="<?php echo $aname?>"/></td>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $aid?>" />
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" value="<?php echo $email?>" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" value="<?php echo $password?>" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input name="btn_cancel" type="reset" id="btn_cancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
  <table width="303" border="1">
    <tr>
      <td>SNO</td>
      <td>Name</td>
      <td>Email</td>
      <td>Password</td>
      <td>Action</td>
    </tr>
    <?php 
	$selQry="select * from tbl_admin";
	$result=$Con->query($selQry);
	$i=0;
	while($data=$result->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data['admin_name']; ?></td>
      <td><?php echo $data['admin_email']; ?></td>
      <td><?php echo $data['admin_password']; ?></td>
      <td><a href="AdminRegistration.php?delId=<?php echo $data['admin_id']?>">Delete</a></td>
      <td><a href="AdminRegistration.php?editId=<?php echo $data['admin_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>