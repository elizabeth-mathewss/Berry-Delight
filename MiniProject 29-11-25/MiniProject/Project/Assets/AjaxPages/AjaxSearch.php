<table width="1445" border="1">
  <tr>
    <td width="52">Sno</td>
    <td width="269">Name</td>
    <td width="250">Details</td>
    <td width="123">Photo</td>
    <td width="130">Price</td>
    <td width="249">Rating</td>
     <td width="326">Action</td>
   
  </tr>
   <?php
   
include("../Connection/Connection.php");

   if($_GET['subid']!="")
   {
	 $sel="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on s.category_id=c.category_id where s.subcategory_id='".$_GET['subid']."'";
   }
   else if($_GET['cid']!="")
   {
	 $sel="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on s.category_id=c.category_id where s.category_id='".$_GET['cid']."'";  
   }
   $res=$Con->query($sel);
	$i=0;
	while($row=$res->fetch_assoc())
	{
		$i++;
		?>
  <tr>
    <td><?php echo $i?>;</td>
    <td><?php echo $row['product_name'] ?></td>
    <td><?php echo $row['product_description'] ?></td>
    <td><img src="../Assets/Files/SellerDocs/<?php echo $row['product_photo']; ?>" width="100" height="100"/></td>
    <td><?php echo $row['product_price'] ?></td>
    <td>
    </td>
    <td><a href="ViewMore.php?vid=<?php echo $row['product_id']?>">View More</a><a href="#" onclick="AddtoCart(<?php echo $row['product_id']?>)">Add to Cart</a></td>
  </tr>
  <?php
	}
	?>
  </tr>
</table>