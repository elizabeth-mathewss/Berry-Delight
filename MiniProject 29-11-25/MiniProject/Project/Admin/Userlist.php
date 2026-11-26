<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Userlist</title>
<style>
/* Unique styles for admin userlist */
.userlist-container {
    width: 95%;
    margin: 40px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #2e2e2e;
}

.userlist-title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 25px;
    color: #4a2e00; /* Dry fruit dark tone */
    border-bottom: 2px solid #c19a6b;
    padding-bottom: 10px;
}

.userlist-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}

.userlist-table th {
    background: #c19a6b; /* Walnut brown */
    color: #fff;
    padding: 12px;
    font-size: 15px;
    text-align: center;
}

.userlist-table td {
    padding: 12px;
    text-align: center;
    font-size: 14px;
    border-bottom: 1px solid #ddd;
    vertical-align: middle;
}

.userlist-table tr:nth-child(even) {
    background-color: #fdf6f0; /* Almond beige */
}

.userlist-table tr:hover {
    background-color: #f5e1c8; /* Cashew light shade */
}

.userlist-photo {
    border-radius: 8px;
    object-fit: cover;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
</style>
</head>

<body>
<div class="userlist-container">
  <h2 class="userlist-title">Registered Users</h2>
  <table class="userlist-table">
    <tr>
      <th>SNo</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Address</th>
      <th>District</th>
      <th>Place</th>
      <th>Photo</th>
    </tr>
    <?php
    $selqry="select * from tbl_user u
      inner join tbl_place p on u.place_id=p.place_id
      inner join tbl_district d on p.district_id=d.district_id";
    $res=$Con->query($selqry);
    $i=0;
    while($data=$res->fetch_assoc())
    {
      $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data['user_name']; ?></td>
      <td><?php echo $data['user_email'];?></td>
      <td><?php echo $data['user_contact'];?></td>
      <td><?php echo $data['user_address'];?></td>
      <td><?php echo $data['district_name'];?></td>
      <td><?php echo $data['place_name']; ?></td>
      <td>
        <img src="../Assets/Files/UserDocs/<?php echo $data['user_photo']?>" 
             width="120" height="120" 
             class="userlist-photo"/>
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
