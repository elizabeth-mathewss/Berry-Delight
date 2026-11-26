<?php 
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$quantity_id=$_POST["sel_quantity"];
	$price=$_POST["txt_price"];
	$product_id=$_GET["pid"];
	$insqry="insert into tbl_productqty(product_id,quantity_id,productqty_price) values('".$product_id."', '".$quantity_id."', 
	'".$price."')";
	if($Con->query($insqry))
	{
		?>
        <script>
		alert("Quantity Inserted");
		window.location="Product.php";
		</script>
        <?php
	}
	else
	{
		echo "Failed to insert";
	}
}
if(isset($_GET["delId"]))
{
	$delqry="delete from tbl_productqty where quantity_id='".$_GET["delId"]."'";
	if($Con->query($delqry))
	{
		?>
        <script>
		alert("Quantity Deleted");
		window.location="ProductQuantity.php";
		</script>
        <?php
	}
}		
?>

<?php include("Header.php"); ?>
<div class="container">
    <div class="container">
        <div class="container">
            <div class="container">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Berry Delight - Product Quantity Management</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f9f6f1;
        color: #5c3d2e;
        line-height: 1.6;
        background-image: url('https://images.unsplash.com/photo-1615485925500-6fd42c657c29?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .header {
        text-align: center;
        margin-bottom: 30px;
        padding: 20px;
        background: rgba(255, 250, 240, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .header h1 {
        font-family: 'Playfair Display', serif;
        color: #7a4c2a;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    
    .header p {
        color: #9e7b5f;
        font-size: 1.1rem;
    }
    
    .content-wrapper {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }
    
    .form-section, .list-section {
        background: rgba(255, 250, 240, 0.95);
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        flex: 1;
        min-width: 300px;
    }
    
    .section-title {
        font-family: 'Playfair Display', serif;
        color: #7a4c2a;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e8d6c0;
        font-size: 1.8rem;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }
    
    table th, table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e8d6c0;
    }
    
    table th {
        background-color: #e8d6c0;
        color: #5c3d2e;
        font-weight: 500;
    }
    
    table tr:hover {
        background-color: rgba(232, 214, 192, 0.3);
    }
    
    input, select {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #d9bf9f;
        border-radius: 5px;
        background: #fff;
        font-family: 'Montserrat', sans-serif;
        font-size: 1rem;
    }
    
    input:focus, select:focus {
        outline: none;
        border-color: #9e7b5f;
        box-shadow: 0 0 0 2px rgba(158, 123, 95, 0.2);
    }
    
    .btn {
        background: #9e7b5f;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        font-size: 1rem;
        transition: background 0.3s ease;
    }
    
    .btn:hover {
        background: #7a4c2a;
    }
    
    .action-link {
        color: #9e7b5f;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .action-link:hover {
        color: #7a4c2a;
        text-decoration: underline;
    }
    
    .media-container {
        text-align: center;
        margin: 20px 0;
    }
    
    .dryfruit-gif {
        max-width: 200px;
        border-radius: 10px;
        margin: 0 auto;
        display: block;
    }
    
    .video-container {
        margin: 30px 0;
        text-align: center;
    }
    
    .video-placeholder {
        width: 100%;
        max-width: 500px;
        height: 280px;
        background: #e8d6c0;
        border-radius: 10px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7a4c2a;
        font-weight: 500;
    }
    
    .footer {
        text-align: center;
        margin-top: 40px;
        padding: 20px;
        color: #9e7b5f;
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .content-wrapper {
            flex-direction: column;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Product Quantity Management</h1>
        <p>Premium Quality Dry Fruits</p>
    </div>
    
    <div class="media-container">
        <!-- <img src="https://media.giphy.com/media/xT5LMGupUKCHpx9yq4/giphy.gif" alt="Dry Fruits Animation" class="dryfruit-gif" /> -->
    </div>
    
    <div class="content-wrapper">
        <div class="form-section">
            <h2 class="section-title">Add New Quantity</h2>
            <form id="form1" name="form1" method="post" action="">
                <label for="sel_quantity">Quantity Type:</label>
                <select name="sel_quantity" id="sel_quantity" required="required">
                    <option value="">Select Quantity Type (in grams)</option>
                    <?php
                    $i=0;
                    $selqty="select * from tbl_quantity"; 
                    $resqty=$Con->query($selqty);
                    while($data=$resqty->fetch_assoc())
                    {
                        $i++;
                    ?>
                    <option value="<?php echo $data["quantity_id"];?>">
                    <?php echo $data["quantity_name"]; ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
                
                <label for="txt_price">Price (₹):</label>
                <input type="number" name="txt_price" id="txt_price" placeholder="Enter price" required />
                
                <input type="submit" name="btn_submit" id="btn_submit" value="Add Quantity" class="btn" />
            </form>
        </div>
   <div class="list-section">
            <h2 class="section-title">Current Quantity</h2>
            <table>
                <tr>
                    <th>Sl No</th>
                    <th>Quantity (g)</th>
                    <th>Price (₹)</th>
                    <th>Action</th>
                </tr>
                <?php
                $i=0;
                $sel="select * from tbl_productqty p inner join tbl_quantity q on p.quantity_id=q.quantity_id"; 
                $res=$Con->query($sel);
                while($data=$res->fetch_assoc())
                {
                    $i++; 
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data["quantity_name"]; ?></td>
                    <td>₹<?php echo $data["productqty_price"]; ?></td>
                    <td><a href="ProductQuantity.php?delId=<?php echo $data["quantity_id"]; ?>" class="action-link">Delete</a></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
            </div>
    <?php include("Footer.php"); ?>
    
    <!-- <div class="video-container">
        <h2 class="section-title">Our Premium Dry Fruits</h2>
        <div class="video-placeholder">
            [Short video showcasing premium dry fruits]
        </div> -->
    <!-- </div> -->
    <!-- <div class="footer">
        <p>© 2025 Berry Delight - Dry Fruit Store | All Rights Reserved</p>
    </div> -->
</div>
</body>
</html>