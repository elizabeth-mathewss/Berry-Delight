<?php
$name="";
$gender="";
$department="";
$totalmark="";
$percentage="";
$grade="";
if(isset($_POST["btn_submit"]))
{
	$fname=$_POST["txt_fname"];
	$lname=$_POST["txt_lname"];
	$gender=$_POST["radio"];
	$department=$_POST["Select"];
	$mark1=$_POST["txt_num1"];
	$mark2=$_POST["txt_num2"];
	$mark3=$_POST["txt_num3"];
	if($gender="Male")
	{
		$name='Mr'.$fname.$lname;
	}
	if($gender="Female")
	{
		$name='Ms'.$fname.$lname;
	}

$totalmark=$mark1+$mark2+$mark3;
$percentage=($totalmark/300)*100;
if($percentage>=90)
{
	$grade='A';
}
else if($percentage>=70)
{
	$grade='B';
}
else if($percentage>=50)
{
	$grade='C';
}
else 
{
	$grade='D';
}
}
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="336" border="1">
    <tr>
      <td width="167">First Name</td>
      <td width="153"><label for="txt_fname"></label>
      <input type="text" name="txt_fname" id="txt_fname" /></td>
    </tr>
    <tr>
      <td>Last Name</td>
      <td><label for="txt_lname"></label>
      <input type="text" name="txt_lname" id="txt_lname" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="radio" id="Male" value="Male" />
      <label for="Male">Male</label>        <label for="Male">
        <input type="radio" name="radio" id="Female" value="Female" />
      Female</label></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><label for="Select">Select</label>
        <select name="Select" id="Select">
          <option value="BCA">BCA</option>
          <option value="BBA">BBA</option>
          <option value="BSC">BSC</option>
          <option value="BA">BA</option>
      </select></td>
    </tr>
    <tr>
      <td>Mark1</td>
      <td><label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" /></td>
    </tr>
    <tr>
      <td>Mark2</td>
      <td><label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" /></td>
    </tr>
    <tr>
      <td>Mark3</td>
      <td><label for="txt_num3"></label>
      <input type="text" name="txt_num3" id="txt_num3" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><?php echo $name; ?></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><?php echo $gender; ?></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><?php echo $department; ?></td>
    </tr>
    <tr>
      <td>Total Mark</td>
      <td><?php echo $totalmark; ?></td>
    </tr>
    <tr>
      <td>Percentage</td>
      <td><?php echo $percentage; ?></td>
    </tr>
    <tr>
      <td>Grade</td>
      <td><?php echo $grade; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>