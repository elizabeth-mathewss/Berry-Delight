<?php
include("../Connection/Connection.php");
?>
<table width="200" border="1">
    <tr>
      <td>SNO</td>
      <td>Name</td>
      <td>Email</td>
      <td>Contact</td>
      <td>Address</td>
      <td>District</td>
      <td>Place</td>
      <td>Photo</td>
      <td>Action</td>
    </tr>
    <?php
	if($_GET['did']!="" && $_GET['pid']=="")
	{
	 $selqry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where p.district_id='".$_GET['did']."' and seller_status=1";
	$res=$Con->query($selqry);
	}
	elseif($_GET['did'] !="" && $_GET['pid']!="")
	{
		 $selqry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where p.place_id='".$_GET['pid']."' and seller_status=1";
		$res=$Con->query($selqry);
	}
	$i=0;
	while($data=$res->fetch_assoc())
	{
		$i++;
	?>
    <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data["seller_name"];?></td>
                                    <td><?php echo $data["seller_email"];?></td>
                                    <td><?php echo $data["seller_contact"];?></td>
                                    <td><?php echo $data["seller_address"];?></td>
                                    <td><?php echo $data["district_name"];?></td>
                                    <td><?php echo $data["place_name"];?></td>
                                    <td>
                                        <img src="../Assets/Files/SellerDocs/<?php echo $data["seller_photo"];?>" alt="Seller Photo" width="100" height="80">
                                    </td>
                                    <td>
                                        <a href="ViewProduct.php?sid=<?php echo $data["seller_id"]; ?>" class="btn-view">View Product</a>
                                    </td>
                                </tr>
    <?php
	}
	?>
  </table>