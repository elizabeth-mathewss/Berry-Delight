<?php
$quantity="";
$qname="";
$qid="";
include("../Assets/Connection/Connection.php");
include("Header.php");
if(isset($_POST["btn_submit"]))
{
	$quantity=$_POST["txt_quantity"];
	$qid=$_POST["txt_id"];
	
	if($qid=="")
	{
		$selqry="select * from tbl_quantity where quantity_name='".$quantity."'";
		$res=$Con->query($selqry);
		if($data=$res->fetch_assoc())
		{
			?>
            <script>
			alert("Quantity Exist");
			</script>
            <?php
		}
		else
		{
	$Insqry="insert into tbl_quantity(quantity_name) values('".$quantity."')";
	if($Con->query($Insqry))
	{
		?>
        <script>
		alert("Quantity Inserted");
		window.location="Quantity.php";
		</script>
        <?php
	}
	}
	}
	else
	{
	$upqry="update tbl_quantity set quantity_name='".$quantity."' where quantity_id='".$qid."'";
	if($Con->query($upqry))
	{
		?>
        <script>
		alert("Quantity Updated");
		window.location="Quantity.php";
		</script>	
        <?php
	}
	}
}

	
if(isset($_GET['delId']))
{
	$delqry="delete from tbl_quantity where quantity_id='".$_GET['delId']."'";
	if($Con->query($delqry))
	{
		?>
        <script>
		alert("Quantity deleted");
		window.location="Quantity.php";
		</script>
        <?php
	}
}
if(isset($_GET['editId']))
{
	$selqry="select * from tbl_quantity where quantity_id='".$_GET['editId']."'";
	$res=$Con->query($selqry);
	$editdata=$res->fetch_assoc();
	$qname=$editdata['quantity_name'];
	$qid=$editdata['quantity_id'];
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Admin - Manage Quantity</title>
<style>
  body {
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    background: #fffdf7;
    margin: 0;
    padding: 0;
  }

  .quantity-admin-container {
    max-width: 1000px;
    margin: 40px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
  }

  .quantity-admin-header {
    text-align: center;
    margin-bottom: 30px;
  }
  .quantity-admin-header h1 {
    font-size: 2rem;
    color: #5a3825; /* dry fruit brown */
    margin-bottom: 5px;
  }
  .quantity-admin-header p {
    color: #8c6d4d;
    font-size: 1rem;
  }

  .quantity-form-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    background: #faf7f2;
    border-radius: 10px;
    overflow: hidden;
  }
  .quantity-form-table td {
    padding: 15px;
    border-bottom: 1px solid #e0d7ce;
    font-size: 1rem;
    color: #4a3728;
  }
  .quantity-form-table input[type="number"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #c7b8a6;
    border-radius: 8px;
    font-size: 1rem;
  }
  .quantity-form-table input[type="submit"] {
    background: #c38e4b;
    color: white;
    font-weight: bold;
    padding: 10px 25px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: 0.3s;
  }
  .quantity-form-table input[type="submit"]:hover {
    background: #9f6e35;
  }

  .quantity-list-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
  }
  .quantity-list-table th {
    background: #5a3825;
    color: #fff;
    padding: 12px;
    text-align: left;
    font-size: 1rem;
  }
  .quantity-list-table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    font-size: 0.95rem;
    color: #4a3728;
  }
  .quantity-list-table tr:hover {
    background: #f9f4ee;
  }

  .quantity-action-links a {
    text-decoration: none;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 6px;
    margin-right: 5px;
  }
  .quantity-action-links a:first-child {
    background: #d9534f;
    color: white;
  }
  .quantity-action-links a:first-child:hover {
    background: #b52b27;
  }
  .quantity-action-links a:last-child {
    background: #5bc0de;
    color: white;
  }
  .quantity-action-links a:last-child:hover {
    background: #269abc;
  }
</style>
</head>

<body>
<div class="quantity-admin-container">
  <div class="quantity-admin-header">
    <h1>Product Quantity Management</h1>
    <p>Enter Quantity Here:</p>
  </div>

  <form id="form1" name="form1" method="post" action="">
    <table class="quantity-form-table">
      <tr>
        <td width="30%">Quantity</td>
        <td>
          <input type="number" placeholder="in grams" name="txt_quantity" id="txt_quantity" value="<?php echo $qname?>" required="required"/>
          <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $qid?>"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </td>
      </tr>
    </table>

    <table class="quantity-list-table">
      <tr>
        <th width="10%">S.No</th>
        <th width="60%">Quantity</th>
        <th width="30%">Action</th>
      </tr>
      <?php
      $sel="select * from tbl_quantity";
      $res=$Con->query($sel);
      $i=0;
      while($data=$res->fetch_assoc())
      {
        $i++
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data["quantity_name"]; ?></td>
        <td class="quantity-action-links">
          <a href="Quantity.php?delId=<?php echo $data["quantity_id"]?>">Delete</a>
          <a href="Quantity.php?editId=<?php echo $data["quantity_id"]?>">Edit</a>
        </td>
      </tr>
      <?php
      }
      ?>
    </table>
  </form>
</div>
</body>
</html>

<?php
include("Footer.php");
?>
