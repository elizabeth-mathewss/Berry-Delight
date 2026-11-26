<?php
$pid="";
$did="";
$pname="";
include("../Assets/Connection/Connection.php");
include("Header.php");
if(isset($_POST["btn_submit"]))
{
	$pname=$_POST["txt_place"];
	$district_id=$_POST["Sel_district"];
	$did=$_POST["txt_id"];
	
	if($did=="")
	{
		$selqry="select * from tbl_place where place_name='".$pname."'";
		$res=$Con->query($selqry);
		if($data=$res->fetch_assoc())
		{
			?>
            <script>
			alert("Place Exist");
			</script>
            <?php
		}
		else
		{
	$InsQry="insert into tbl_place(place_name,district_id) values('$pname','$district_id')";
	if($Con->query($InsQry))
	{
		?>
        <script>
		alert("Data Inserted");
		window.location="Place.php";
		</script>
        <?php
	}
    }
	}
	else
	{
		$UpQry="update tbl_place set place_name='".$pname."' where place_id='".$did."'";
		if($Con->query($UpQry))
		{
			?>
            <script>
			alert("Data Updated");
			window.location="Place.php";
			</script>
            <?php
		}
	}
}


if(isset($_GET['delId']))
{
	$DelQry="delete from tbl_place where place_id='".$_GET['delId']."'";
	if($Con->query($DelQry))
	{
		?>
        <script>
		alert("Data deleted");
		window.location="Place.php";
		</script>
        <?php 
	}
}
if(isset($_GET['editId']))
{
	$SelQry="select * from tbl_place where place_id='".$_GET['editId']."'";
	$res=$Con->query($SelQry);
	$editdata=$res->fetch_assoc();
	$pname=$editdata['place_name'];
	$pid=$editdata['place_id'];
	$did=$editdata['district_id'];
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Admin | Manage Places</title>
<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #ffffff;
    margin: 0;
    padding: 0;
    color: #333;
  }
  .place-admin-wrapper {
    max-width: 950px;
    margin: 40px auto;
    background: #fdfdfd;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  }
  .place-admin-header {
    text-align: center;
    margin-bottom: 30px;
  }
  .place-admin-header h1 {
    font-size: 26px;
    color: #5a3825;
    margin-bottom: 8px;
  }
  .place-admin-header p {
    font-size: 14px;
    color: #000000ff;
    margin: 0;
  }
  .place-form-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
  }
  .place-form-table td {
    padding: 12px;
    vertical-align: middle;
  }
  .place-form-table td:first-child {
    text-align: right;
    font-weight: 600;
    color: #444;
    width: 150px;
  }
  .place-form-table select,
  .place-form-table input[type="text"] {
    width: 95%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    font-size: 14px;
    background: #fff;
  }
  .place-form-table input[type="submit"],
  .place-form-table input[type="reset"] {
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
  .place-form-table input[type="submit"]:hover,
  .place-form-table input[type="reset"]:hover {
    background: #7a5237;
  }
  .place-list-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
  }
  .place-list-table th, 
  .place-list-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
    font-size: 14px;
  }
  .place-list-table th {
    background: #f2e5d9;
    color: #5a3825;
    font-weight: 600;
  }
  .place-list-table td a {
    text-decoration: none;
    padding: 5px 12px;
    border-radius: 4px;
    font-size: 13px;
    margin: 2px;
    display: inline-block;
  }
  .place-list-table td a[href*="editId"] {
    background: #4caf50;
    color: #fff;
  }
  .place-list-table td a[href*="delId"] {
    background: #d9534f;
    color: #fff;
  }
</style>
</head>

<body>
<div class="place-admin-wrapper">
  <div class="place-admin-header">
    <h1>Place Management</h1>
    <p>Enter Place Here:</p>
  </div>

  <form id="form1" name="form1" method="post" action="">
    <table class="place-form-table">
      <tr>
        <td>District</td>
        <td>
          <select name="Sel_district" id="Select" required="required">
            <option value="">Select</option>
            <?php
            $Sel="select * from tbl_district";
            $res=$Con->query($Sel);
            while($data=$res->fetch_assoc())
            {
            ?>
              <option value="<?php echo $data['district_id']?>" <?php if($did==$data['district_id']){echo "selected";}?>>
                <?php echo $data['district_name']?>
              </option>
            <?php 
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Place</td>
        <td>
          <input type="text" name="txt_place" id="txt_place" value="<?php echo $pname ?>" required="required"/>
          <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $pid ?>"/>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          <input type="reset" name="btn_reset" id="btn_reset" value="Reset" />
        </td>
      </tr>
    </table>

    <table class="place-list-table">
      <tr>
        <th>S.No</th>
        <th>District</th>
        <th>Place</th>
        <th colspan="2">Action</th>
      </tr>
      <?php
        $SelQry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
        $result=$Con->query($SelQry);
        $i=0;
        while($data=$result->fetch_assoc())
        {
          $i++;
      ?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $data['district_name'];?></td>
        <td><?php echo $data['place_name']; ?></td>
        <td><a href="Place.php?delId=<?php echo $data['place_id']?>">Delete</a></td>
        <td><a href="Place.php?editId=<?php echo $data['place_id']?>">Edit</a></td>
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
