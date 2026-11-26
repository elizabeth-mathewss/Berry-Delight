<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
// session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin - View Complaints</title>
<style>
/* Unique styles for complaint page */
.complaint-page-container {
    width: 90%;
    margin: 40px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #2c2c2c;
}

.complaint-page-title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 25px;
    color: #4a2e00; /* dark dry fruit theme */
    border-bottom: 2px solid #c19a6b;
    padding-bottom: 10px;
}

.complaint-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
}

.complaint-table th {
    background: #c19a6b; /* walnut brown shade */
    color: white;
    padding: 12px;
    text-align: center;
    font-size: 15px;
    letter-spacing: 0.5px;
}

.complaint-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

.complaint-table tr:nth-child(even) {
    background-color: #fdf6f0; /* light dry fruit tone */
}

.complaint-table tr:hover {
    background-color: #f5e1c8;
}

.complaint-action a {
    text-decoration: none;
    background: #4a2e00;
    color: #fff;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 13px;
    transition: 0.3s;
}

.complaint-action a:hover {
    background: #c19a6b;
    color: #fff;
}
</style>
</head>

<body>
<div class="complaint-page-container">
    <h2 class="complaint-page-title">Customer Complaints</h2>
    <table class="complaint-table">
      <tr>
        <th>S.No</th>
        <th>User Name</th>
        <th>Title</th>
        <th>Content</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
      <?php
      $Sel="select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id ";
      $res=$Con->query($Sel);
      $i=0;
      while($data=$res->fetch_assoc())
      {
          $i++;
          ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data["user_name"]; ?></td>
        <td><?php echo $data["complaint_title"]; ?></td>
        <td><?php echo $data["complaint_content"]; ?></td>
        <td><?php echo $data["complaint_date"]; ?></td>
        <td class="complaint-action"><a href="Reply.php?cid=<?php echo $data['complaint_id']?>">Reply</a></td>
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
