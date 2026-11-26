<?php

include("../Assets/Connection/Connection.php");
session_start();
 include("Header.php");

if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$description=$_POST["txt_description"];
	$price=$_POST["txt_price"];
	$photo=$_FILES["file_photo"]["name"];
	$path=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($path,'../Assets/Files/SellerDocs/'.$photo);
	$cid=$_POST["sel_category"];
	$subid=$_POST["Sel_subcategory"];
	
$insqry="insert into tbl_product(product_name,product_description,product_price,subcategory_id,product_photo,product_date,seller_id) values('".
$name."', '".$description."', '".$price."', '".$subid."', '".$photo."', curdate(), '".$_SESSION['sid']."')";
if($Con->query($insqry))
{
	?>
    <script>
	alert("Product Inserted");
	window.location="Product.php";
	</script>
    <?php
}
else
{
	echo "failed to insert";
}
}
if(isset($_GET['delId']))
{
	$DelQry="delete from tbl_product where product_id='".$_GET['delId']."'";
	if($Con->query($DelQry))
	{
		?>
        <script>
		alert("Data Deleted");
		window.location="Product.php";
		</script>
        <?php
	}
}	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product | Berry Delight Seller Portal</title>
<style>
    :root {
        --primary: #8B4513;
        --secondary: #D2691E;
        --accent: #F4A460;
        --light: #FFF8DC;
        --dark: #654321;
    }
    
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 30px;
        position: relative;
    }
    
    .page-header h1 {
        color: var(--primary);
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }
    
    .page-header p {
        color: var(--secondary);
        font-size: 1.1rem;
    }
    
    .header-decoration {
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        opacity: 0.7;
    }
    
    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        padding: 15px;
        margin-bottom: 12px;
        border-top: 5px solid var(--primary);
    }
    
    .card-title {
        color: var(--primary);
        font-size: 1.5rem;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px dashed var(--accent);
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }   
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        color: var(--dark);
        font-weight: 600;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(210, 105, 30, 0.2);
    }
    
    .btn-submit {
        background: linear-gradient(to right, var(--primary), var(--secondary));
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.3);
    }
    
    .btn-action {
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-block;
        margin: 2px;
    }
    
    .btn-add {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-delete {
        background-color: #dc3545;
        color: white;
    }
    
    .products-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .products-table th {
        background-color: var(--primary);
        color: white;
        padding: 12px;
        text-align: left;
    }
    
    .products-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }
    
    .products-table tr:nth-child(even) {
        background-color: var(--light);
    }
    
    .products-table tr:hover {
        background-color: rgba(210, 105, 30, 0.1);
    }
    
    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid var(--accent);
    }
    
    .empty-state {
        text-align: center;
        padding: 40px;
        color: var(--secondary);
    }
    
    .empty-state img {
        max-width: 200px;
        margin-bottom: 20px;
        opacity: 0.7;
    }
    
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>

<body>

<div class="page-container">
    <!-- <div class="page-header"> -->
        <!-- <img src="https://i.imgur.com/Bz0lY3R.gif" class="header-decoration" alt="Dry Fruits"> -->
        <!-- <h1>Product Management</h1> -->
        <!-- <p>Add and manage your dry fruit products</p> -->
       
    </div>
    
    <div class="card">
        
        <h2 class="card-title">Add New Product</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="txt_name">Product Name</label>
                    <input type="text" name="txt_name" id="txt_name" class="form-control" 
                           title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
                           pattern="^[A-Z]+[a-zA-Z ]*$" required="required" 
                           placeholder="e.g., Premium Almonds"/>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="txt_price">Price (₹) in 100g</label>
                    <input type="number" name="txt_price" id="txt_price" required="required" 
                           class="form-control" placeholder="e.g., 599" min="1" step="0.01"/>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="Select">Category</label>
                    <select name="sel_category" id="Select" onChange="AjaxSubCategory(this.value)" 
                            required="required" class="form-control">
                      <option value="">Select Category</option>
                      <?php
                      $sel="select * from tbl_category";
                      $res=$Con->query($sel);
                      while($data=$res->fetch_assoc()) 
                      {
                      ?>
                      <option value="<?php echo $data["category_id"]?>">
                      <?php echo $data["category_name"]?>
                      </option>
                      <?php 
                      }
                      ?> 
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="Sel_subcategory">Subcategory</label>
                    <select name="Sel_subcategory" id="Sel_subcategory" required="required" class="form-control">
                      <option value="">Select Subcategory</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="file_photo">Product Image</label>
                    <input type="file" name="file_photo" id="file_photo" required="required" class="form-control" />
                    <small>Upload a clear image of your product (max 2MB)</small>
                </div>
                
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label" for="txt_description">Description</label>
                    <textarea name="txt_description" id="txt_description" class="form-control" 
                              required="required" rows="3" placeholder="Describe your product..."></textarea>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <input type="submit" name="btn_submit" id="btn_submit" value="Add Product" class="btn-submit" />
            </div>
        </form>
    </div>
    
    <div class="card">
        <h2 class="card-title">Your Products</h2>
        
        <table class="products-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selqry="select * from tbl_product u
                inner join tbl_subcategory p on u.subcategory_id=p.subcategory_id
                inner join tbl_category d on p.category_id=d.category_id 
                WHERE u.seller_id='".$_SESSION['sid']."'";
                $Result=$Con->query($selqry);
                $i=0;
                if($Result->num_rows > 0) {
                    while($data=$Result->fetch_assoc())
                    {
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <strong><?php echo $data["product_name"]; ?></strong>
                        <div style="font-size: 0.85rem; color: #666; margin-top: 5px;">
                            <?php echo substr($data["product_description"], 0, 50); ?>...
                        </div>
                    </td>
                    <td>
                        <img src="../Assets/Files/SellerDocs/<?php echo $data['product_photo']?>" 
                             class="product-image" alt="<?php echo $data["product_name"]; ?>"/>
                    </td>
                    <td>₹<?php echo $data["product_price"]; ?></td>
                    <td><?php echo $data["category_name"]; ?></td>
                    <td><?php echo $data["subcategory_name"];?></td>
                    <td>
                        <a href="Stock.php?pid=<?php echo $data["product_id"]?>" class="btn-action btn-add">Add Stock</a>
                        <a href="Product.php?delId=<?php echo $data["product_id"]?>" class="btn-action btn-delete" 
                           onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                          <!-- <a href="ProductQuantity.php?pid=<?php echo $data["product_id"]?>" class="btn-action btn-add">Add Quantity</a>   -->
                    </td>       
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                    <td colspan="7" class="empty-state">
                        <!-- <img src="https://i.imgur.com/6CHcmcD.gif" alt="No products"> -->
                        <h3>No Products Added Yet</h3>
                        <p>Add your first product using the form above</p>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("Footer.php") ?>

<script src="../Assets/JQ/jQuery.js"></script> 
<script>
    function AjaxSubCategory(subid) 
    {
        $.ajax({
        url:"../Assets/AjaxPages/AjaxSubCategory.php?did="+subid,
        success: function(html){
            $("#Sel_subcategory").html(html);
        }
        });
    }
</script>
</body>
</html>