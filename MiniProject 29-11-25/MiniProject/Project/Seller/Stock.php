<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$quantity=$_POST["txt_quantity"];
	$product_id=$_GET["pid"];

	$InsQry="insert into tbl_stock(stock_qty,product_id,stock_date) values('".$quantity."', '".$product_id."', curdate())";
	if($Con->query($InsQry))
	{
		?>
        <script>
		alert("Stock Inserted");
		 window.location="Product.php";
		</script>
        <?php
	}
	else
	{
		echo "Failed to insert";
	}
}
if(isset($_GET['delId']))
{
	$DelQry="delete from tbl_stock where stock_id='".$_GET['delId']."'";
	if($Con->query($DelQry))
	{
		?>
        <script>
		alert("Data Deleted");
		 window.location="Stock.php?pid=<?php echo $_GET['pid'];?>";
		</script>
        <?php
	}
		
}	
?>
<?php include("Header.php"); ?>
<div class="container">
<div class="container">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock Management | Berry Delight</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #f9f6f1;
        color: #333;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .page-title {
        text-align: center;
        margin: 30px 0;
        color: #8B4513;
    }
    .page-title h1 {
        font-size: 36px;
        margin-bottom: 10px;
        font-weight: 700;
    }
    .page-title p {
        font-size: 18px;
        color: #A0522D;
    }
    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        padding: 25px;
        margin-bottom: 30px;
    }
    .card-title {
        color: #8B4513;
        font-size: 22px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1c40f;
        display: flex;
        align-items: center;
    }
    .card-title i {
        margin-right: 10px;
        color: #f1c40f;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #5D4037;
    }
    input[type="number"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0d6c9;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s;
    }
    input[type="number"]:focus {
        border-color: #f1c40f;
        outline: none;
        box-shadow: 0 0 0 3px rgba(241, 196, 15, 0.2);
    }
    .btn {
        background: #f1c40f;
        color: #5D4037;
        border: none;
        padding: 12px 25px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
        text-align: center;
    }
    .btn:hover {
        background: #e2b607;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-delete {
        background: #e74c3c;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
    }
    .btn-delete:hover {
        background: #c0392b;
        color: white;
        text-decoration: none;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0d6c9;
    }
    th {
        background-color: #f8f4ed;
        color: #5D4037;
        font-weight: 600;
    }
    tr:hover {
        background-color: #fefaf0;
    }
    .empty-state {
        text-align: center;
        padding: 40px 0;
        color: #a08a7a;
    }
    .empty-state i {
        font-size: 60px;
        margin-bottom: 15px;
        color: #e0d6c9;
    }
</style>
</head>

<body>
<div class="container">
    <div class="page-title">
        <h1><i class="fas fa-boxes"></i> Stock Management</h1>
        <p>Manage your dry fruit inventory with ease</p>
    </div>

    <div class="card">
        <h2 class="card-title"><i class="fas fa-plus-circle"></i> Add New Stock</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_quantity">Quantity (grams)</label>
                <input type="number" name="txt_quantity" id="txt_quantity" required="required" placeholder="Enter quantity in grams" min="1" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn" name="btn_submit" id="btn_submit" value="Add Stock" />
            </div>
        </form>
    </div>

    <div class="card">
        <h2 class="card-title"><i class="fas fa-list"></i> Current Stock</h2>
        <table>
            <thead>
                <tr>
                    <th>SNo</th>
                    <th>Quantity (grams)</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sel="select * from tbl_stock where product_id='".$_GET['pid']."'";
                $res=$Con->query($sel);
                $i=0;
                if($res->num_rows > 0) {
                    while($data=$res->fetch_assoc()) {
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data["stock_qty"]; ?></td>
                    <td><?php echo date('M j, Y', strtotime($data["stock_date"]));?></td>
                    <td>
                        <a href="Stock.php?delId=<?php echo $data["stock_id"]; ?>&pid=<?php echo $_GET['pid'];?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this stock entry?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                    <td colspan="4" class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No Stock Available</h3>
                        <p>Add your first stock entry using the form above</p>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    

    <!-- ✅ Available Stock Display
    <div class="card">
        <h2 class="card-title"><i class="fas fa-box"></i> Available Stock</h2>
        <div style="text-align:center; font-size:20px; font-weight:600; padding:15px;">
            <?php
            $stockQry = "SELECT SUM(stock_qty) as total FROM tbl_stock WHERE product_id='".$_GET['pid']."'";
            $stockRes = $Con->query($stockQry);
            $stockData = $stockRes->fetch_assoc();
            $availableStock = $stockData['total'] ? $stockData['total'] : 0;

            if ($availableStock > 0) {
                echo "<span style='color:#27ae60;'>".$availableStock." grams available</span>";
            } else {
                echo "<span style='color:#e74c3c;'>Out of Stock</span>";
            }
            ?>
        </div>
    </div> -->

</div>
<?php include("Footer.php"); ?>
</body>
</html>
