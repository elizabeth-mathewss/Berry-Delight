<?php
$subname="";
$subid="";
$subcategory="";
$cid="";
include("../Assets/Connection/Connection.php");
include("Header.php");
if(isset($_POST["btn_submit"]))
{
	$subcategory=$_POST["txt_subcategory"];
	$category_id=$_POST["Sel_category"];
	$subid=$_POST["txt_id"];
	if($subid=="")
	{
		$selqry="select * from tbl_subcategory where subcategory_name='".$subcategory."'";
		$res=$Con->query($selqry);
		if($data=$res->fetch_assoc())
		{
			?>
            <script>
			alert("SubCategory Exist");
			</script>
            <?php
		}
		else
		{
			
	$InsQry="insert into tbl_subcategory(subcategory_name,category_id) values('$subcategory','$category_id')";
	if($Con->query($InsQry))
	{ 
		?>
        <script>
		alert("Data Inserted");
		window.location="Subcategory.php";
		</script>
        <?php
	}
		}
	}
	else
	{
		$UpQry="update tbl_subcategory set subcategory_name='".$subcategory."' where subcategory_id='".$subid."'";
		if($Con->query($UpQry))
		{
			?>
            <script>
			alert("Data Updated");
			window.location="Subcategory.php";
			</script>
            <?php 
		}
	}
}
		
if(isset($_GET['delId']))
{
	$DelQry="delete from tbl_subcategory where subcategory_id='".$_GET['delId']."'";
	if($Con->query($DelQry))
	{
		?>
        <script>
		alert("Data Deleted");
		window.location="Subcategory.php";
		</script>
        <?php
	}
}
if(isset($_GET['editId']))
{
	$SelQry="select * from tbl_subcategory where subcategory_id='".$_GET['editId']."'";
	$res=$Con->query($SelQry);
	$editdata=$res->fetch_assoc();
	$subname=$editdata['subcategory_name'];
	$subid=$editdata['subcategory_id'];
	$cid=$editdata['category_id'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SubCategory</title>
<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #faf7f2;
    }

    .subcat-admin-container {
        max-width: 900px;
        margin: 40px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
    }

    .subcat-admin-title {
        font-size: 26px;
        font-weight: 600;
        color: #4e342e;
        margin-bottom: 25px;
        text-align: center;
        border-bottom: 2px solid #d7ccc8;
        padding-bottom: 10px;
    }

    .subcat-admin-form table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .subcat-admin-form td {
        padding: 10px;
        font-size: 15px;
        color: #3e2723;
    }

    .subcat-admin-form input[type="text"],
    .subcat-admin-form select {
        width: 95%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .subcat-admin-form input[type="submit"] {
        background-color: #6d4c41;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
        transition: 0.3s;
    }

    .subcat-admin-form input[type="submit"]:hover {
        background-color: #4e342e;
    }

    .subcat-admin-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .subcat-admin-table th, .subcat-admin-table td {
        border: 1px solid #d7ccc8;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }

    .subcat-admin-table th {
        background-color: #efebe9;
        color: #4e342e;
        font-weight: 600;
    }

    .subcat-admin-table a {
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 13px;
    }

    .subcat-admin-table a:hover {
        opacity: 0.8;
    }

    .subcat-admin-delete {
        background-color: #d32f2f;
        color: #fff;
    }

    .subcat-admin-edit {
        background-color: #388e3c;
        color: #fff;
    }

</style>
</head>

<body>
<div class="subcat-admin-container">
    <h2 class="subcat-admin-title">Subcategory Management</h2>

    <form id="form1" name="form1" method="post" action="" class="subcat-admin-form">
      <table>
        <tr>
          <td>Category</td>
          <td>
            <select name="Sel_category" id="Select" required="required">
                <option value="">Select</option>
                <?php
                $Sel="select * from tbl_category";
                $result=$Con->query($Sel);
                while($data=$result->fetch_assoc())
                {
                ?>
                    <option
                    <?php
                    if($cid==$data['category_id'])
                    {
                        echo "selected";
                    }
                    ?>
                    value="<?php echo $data['category_id']?>">
                    <?php echo $data['category_name']?>
                    </option>
                <?php
                }
                ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Subcategory</td>
          <td>
            <input type="text" name="txt_subcategory" id="txt_subcategory" value="<?php echo $subname ?>" required="required"/>
            <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $subid ?>"/>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          </td>
        </tr>
      </table>
    </form>

    <table class="subcat-admin-table">
      <tr>
        <th>SNO</th>
        <th>Category</th>
        <th>Subcategory</th>
        <th colspan="2">Action</th>
      </tr>
      <?php
      $SelQry="select * from tbl_subcategory s inner join tbl_category c on s.category_id=c.category_id";
      $result=$Con->query($SelQry);
      $i=0;
      while($data=$result->fetch_assoc())
      {
          $i++;
      ?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $data['category_name'];?></td>
        <td><?php echo $data['subcategory_name'];?></td>
        <td><a class="subcat-admin-delete" href="Subcategory.php?delId=<?php echo $data['subcategory_id']?>">Delete</a></td>
        <td><a class="subcat-admin-edit" href="Subcategory.php?editId=<?php echo $data['subcategory_id']?>">Edit</a></td>
      </tr>
      <?php
      }
      ?>
    </table>
</div>
</body>
</html>
