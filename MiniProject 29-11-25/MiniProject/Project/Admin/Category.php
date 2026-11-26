<?php
$category="";
$cname="";
$cid="";
include("../Assets/Connection/Connection.php");
include("Header.php");
if(isset($_POST["btn_submit"]))
{
	$category=$_POST["txt_category"];
	$cid=$_POST["txt_id"];
	if($cid == "") 
	{
		$selqry="select * from tbl_category where category_name='".$category."'";
		$res=$Con->query($selqry);
		if($data=$res->fetch_assoc())
		{
			?>
            <script>
			alert("Category Exist");
			</script>
            <?php
		}
		else
		{
	$InsQry="Insert into tbl_category(category_name) values('$category')";
	if($Con->query($InsQry))
	{
		?>
        <script>
		alert("Category Successfully Inserted")
		window.location="Category.php";
		</script>
        <?php
	}
		}
}
else
{
	$UpQry="update tbl_category set category_name='".$category."' where category_id='".$cid."'";
	if($Con->query($UpQry))
	{
		?>
        <script>
		alert("Data Updated");
		window.location="Category.php";
		</script>
        <?php
	}
}
}
		
if(isset($_GET['delId']))
{
	$DelQry="delete from tbl_category where category_id='".$_GET['delId']."'";
	if($Con->query($DelQry))
	{
		?>
        <script>
		alert("Data Deleted");
		window.location="Category.php";
        </script>
        <?php
	}
}

if(isset($_GET['editId']))
{
	$SelQry="select * from tbl_category where category_id='".$_GET['editId']."'";
	$res=$Con->query($SelQry);
	$editdata=$res->fetch_assoc();
	$cname=$editdata['category_name'];
	$cid=$editdata['category_id'];
}

	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin - Category Management</title>
<style>
/* ---------- Page Styling ---------- */
.admin-category-container {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #fdfcf9;
    color: #333;
    padding: 40px;
    max-width: 900px;
    margin: 30px auto;
}

.admin-category-title {
    text-align: center;
    font-size: 28px;
    margin-bottom: 25px;
    color: #3e2723;
    font-weight: bold;
    letter-spacing: 1px;
}

/* ---------- Form Styling ---------- */
.admin-category-form {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 40px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.admin-category-form table {
    width: 100%;
}

.admin-category-form td {
    padding: 10px;
    font-size: 15px;
}

.admin-category-form input[type="text"] {
    width: 95%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
}

.admin-category-buttons {
    text-align: center;
    margin-top: 15px;
}

.admin-category-buttons input[type="submit"],
.admin-category-buttons input[type="reset"] {
    background: #795548;
    color: #fff;
    border: none;
    padding: 10px 18px;
    margin: 5px;
    font-size: 14px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.admin-category-buttons input:hover {
    background: #5d4037;
}

/* ---------- Table Styling ---------- */
.admin-category-table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.admin-category-table th, 
.admin-category-table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 15px;
}

.admin-category-table th {
    background: #efebe9;
    color: #4e342e;
    font-weight: 600;
}

.admin-category-table tr:hover {
    background: #f9f6f2;
}

/* ---------- Action Links ---------- */
.admin-category-actions a {
    text-decoration: none;
    margin: 0 5px;
    padding: 6px 12px;
    font-size: 13px;
    border-radius: 6px;
    color: #fff;
    transition: 0.3s;
}

.admin-category-actions a.delete-link {
    background: #d32f2f;
}

.admin-category-actions a.edit-link {
    background: #388e3c;
}

.admin-category-actions a:hover {
    opacity: 0.8;
}
</style>
</head>

<body>
<div class="admin-category-container">
  <h2 class="admin-category-title">Category Management</h2>

  <!-- Category Form -->
  <div class="admin-category-form">
    <form id="form1" name="form1" method="post" action="">
      <table>
        <tr>
          <td width="160">Category</td>
          <td>
            <input type="text" name="txt_category" id="txt_category" required="required" value="<?php echo $cname?>" />
            <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $cid?>" />
          </td>
        </tr>
      </table>
      <div class="admin-category-buttons">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="reset" name="btn_reset" id="btn_reset" value="Reset" />
      </div>
    </form>
  </div>

  <!-- Category List Table -->
  <table class="admin-category-table">
    <tr>
      <th>S.No</th>
      <th>Category</th>
      <th>Action</th>
    </tr>
    <?php
	$selQry="select * from tbl_category";
	$result=$Con->query($selQry);
	$i=0;
	while($data=$result->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data['category_name']; ?></td>
      <td class="admin-category-actions">
        <a href="Category.php?editId=<?php echo $data['category_id']?>" class="edit-link">Edit</a>
        <a href="Category.php?delId=<?php echo $data['category_id']?>" class="delete-link">Delete</a>
      </td>
    </tr>
    <?php
	}
	?>
  </table>
</div>
</body>
</html>
<?php
include("Footer.php");
?>
