<?php
$result="";
$n1="";
$n2="";
$n3="";
if(isset($_POST["btn_small"]))
{
	$n1=$_POST["txt_num1"];
	$n2=$_POST["txt_num2"];
	$n3=$_POST["txt_num3"];
}
if(($n1<$n2)&&($n1<$n3))
 $result=$n1;
elseif(($n2<$n3)&&($n2<$n1))
 $result=$n2;
else
 $result=$n3;
?>
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Number1</td>
      <td><label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" /></td>
    </tr>
    <tr>
      <td>Number2</td>
      <td><label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" /></td>
    </tr>
    <tr>
      <td>Number3</td>
      <td><label for="txt_num3"></label>
      <input type="text" name="txt_num3" id="txt_num3" /> </td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="btn_small" id="btn_small" value="Submit" /></td>
    </tr>
    <tr>
      <td>Result</td>
      <td><?php echo $result; ?></td>
    </tr>
  </table>
</form>
</body>
</html>