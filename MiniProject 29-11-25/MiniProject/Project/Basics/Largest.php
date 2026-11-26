<?php
$result="";
$n1="";
$n2="";
$n3="";
if(isset($_POST["btn_large"]))
{
	$n1=$_POST["txt_num1"];
	$n2=$_POST["txt_num2"];
	$n3=$_POST["txt_num3"];
}
if(($n1>$n2)&&($n1>$n3))
 $result=$n1;
elseif(($n2>$n1)&&($n2>$n3))
 $result=$n2;
else
 $result=$n3;
?>


<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td width="94">Number1</td>
      <td width="90"><label for="txt_num2"></label>
      <input type="text" name="txt_num1" id="txt_num2" /></td>
    </tr>
    <tr>
      <td>Number2</td>
      <td><label for="txt_num3"></label>
      <input type="text" name="txt_num2" id="txt_num3" /></td>
    </tr>
    <tr>
      <td>Number3</td>
      <td><label for="txt_num4"></label>
      <input type="text" name="txt_num3" id="txt_num4" /></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="btn_large" id="btn_large" value="Submit" /></td>
    </tr>
    <tr>
      <td>Result</td>
      <td><?php echo $result; ?></td>
    </tr>
  </table>
</form>
