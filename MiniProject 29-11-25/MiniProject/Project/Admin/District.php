<?php
$district="";
$dname="";
$did="";
include("../Assets/Connection/Connection.php");
include("Header.php");
if(isset($_POST["btn_submit"]))
{
	$district=$_POST["txt_district"];
	$did=$_POST['txt_id'];
	
	if($did == "")
	{
		$selqry="select * from tbl_district where district_name='".$district."'";
		$res=$Con->query($selqry);
		if($data=$res->fetch_assoc())
		{
			?>
            <script>
			alert("District Exist");
			</script>
            <?php
		}
		else
		{
	$InsQry="insert into tbl_district(district_name) values('$district')";
    if($Con->query($InsQry))
	{
		
		?>
        <script>
		alert("District Inserted");
		window.location="District.php";
		</script>
        <?php
	}
		
	}
	}
	else
	{
		$UpQry="update tbl_district set district_name='".$district."' where district_id='".$did."'";
		if($Con->query($UpQry))
		{
		?>
        <script>
		alert("Data Updated");
		window.location="District.php";
		</script>
        <?php
		}
		
	}
}
    

if(isset($_GET['delId']))
{
	$DelQry="delete from tbl_district where district_id='".$_GET['delId']."'";
	if($Con->query($DelQry))
	{
		?>
        <script>
		alert("Data Deleted")
		window.location="District.php";
		</script>
        <?php
	}
}

if(isset($_GET['editId']))
{
	$SelQry="select * from tbl_district where district_id='".$_GET['editId']."'";
	$res=$Con->query($SelQry);
	$editdata=$res->fetch_assoc();
	$dname=$editdata['district_name'];
	$did=$editdata['district_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Admin | Manage Districts</title>
<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #ffffff;
    margin: 0;
    padding: 0;
    color: #333;
  }
  .district-admin-wrapper {
    max-width: 900px;
    margin: 40px auto;
    background: #fdfdfd;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  }
  .district-admin-header {
    text-align: center;
    margin-bottom: 30px;
  }
  .district-admin-header h1 {
    font-size: 26px;
    color: #5a3825;
    margin-bottom: 8px;
  }
  .district-admin-header p {
    font-size: 14px;
    color: #000000ff;
    margin: 0;
  }
  .district-form-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
  }
  .district-form-table td {
    padding: 12px;
  }
  .district-form-table td:first-child {
    text-align: right;
    font-weight: 600;
    color: #444;
    width: 150px;
  }
  .district-form-table input[type="text"] {
    width: 95%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    font-size: 14px;
  }
  .district-form-table input[type="submit"] {
    background: #5a3825;
    color: #fff;
    padding: 8px 16px;
    margin: 5px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
    font-size: 14px;
  }
  .district-form-table input[type="submit"]:hover {
    background: #7a5237;
  }
  .district-list-table {
    width: 100%;
    border-collapse: collapse;
  }
  .district-list-table th, 
  .district-list-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
    font-size: 14px;
  }
  .district-list-table th {
    background: #f2e5d9;
    color: #5a3825;
    font-weight: 600;
  }
  .district-list-table td a {
    text-decoration: none;
    padding: 5px 12px;
    border-radius: 4px;
    font-size: 13px;
    margin: 2px;
    display: inline-block;
  }
  .district-list-table td a[href*="editId"] {
    background: #4caf50;
    color: #fff;
  }
  .district-list-table td a[href*="delId"] {
    background: #d9534f;
    color: #fff;
  }
</style>
</head>

<body>
<div class="district-admin-wrapper">
  <div class="district-admin-header">
    <h1>District Management</h1>
    <p>Enter District Here:<p>
  </div>

  <form id="form1" name="form1" method="post" action="">
    <table class="district-form-table">
      <tr>
        <td>District</td>
        <td>
          <input type="text" name="txt_district" id="txt_district" required value="<?php echo $dname?>" />
          <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $did?>" />
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
        </td>
      </tr>
    </table>

    <table class="district-list-table">
      <tr>
        <th>S.No</th>
        <th>District</th>
        <th>Action</th>
      </tr>
      <?php
      $selQry="select * from tbl_district";
      $result=$Con->query($selQry);
      $i=0;
      while($data=$result->fetch_assoc())
      {
        $i++;
      ?>
      <tr>
        <td><?php echo $i?></td>
        <td><?php echo $data['district_name']?></td>
        <td>
          <a href="District.php?delId=<?php echo $data['district_id']?>">Delete</a>
          <a href="District.php?editId=<?php echo $data['district_id']?>">Edit</a>
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
