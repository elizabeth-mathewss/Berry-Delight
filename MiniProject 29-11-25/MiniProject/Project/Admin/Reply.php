<?php
include("../Assets/Connection/Connection.php");
$cid="";
$reply="";
if(isset($_POST["btn_submit"]))
{
	$reply=$_POST["txt_content"];
	$cid=$_GET["cid"];
	$upqry="update tbl_complaint set complaint_reply='".$reply."',complaint_status='1' where complaint_id='".$cid."'";
	if($Con->query($upqry))
	{
		?>
        <script>
		alert("Status Updated");
		window.location="ViewComplaint.php";
		</script>
        <?php
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reply to Complaint</title>
</head>

<body>

<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Content</td>
      <td><label for="txt_content"></label>
      <textarea name="txt_content" id="txt_content" cols="45" rows="5" required="required"><?php echo "will check and rectify." ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
</form>
