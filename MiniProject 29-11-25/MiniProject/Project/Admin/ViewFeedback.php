<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin - View Feedback</title>
<style>
/* Unique styles for feedback page */
.feedback-page-container {
    width: 90%;
    margin: 40px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #2c2c2c;
}

.feedback-page-title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 25px;
    color: #4a2e00; /* dark dry fruit tone */
    border-bottom: 2px solid #c19a6b;
    padding-bottom: 10px;
}

.feedback-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}

.feedback-table th {
    background: #c19a6b; /* walnut brown */
    color: #fff;
    padding: 12px;
    font-size: 15px;
    text-align: center;
    letter-spacing: 0.5px;
}

.feedback-table td {
    padding: 12px;
    text-align: center;
    font-size: 14px;
    border-bottom: 1px solid #ddd;
}

.feedback-table tr:nth-child(even) {
    background-color: #fdf6f0; /* almond beige */
}

.feedback-table tr:hover {
    background-color: #f5e1c8; /* light dry fruit tone */
}
</style>
</head>

<body>
<div class="feedback-page-container">
  <h2 class="feedback-page-title">Customer Feedback</h2>
  <form id="form1" name="form1" method="post" action="">
    <table class="feedback-table">
      <tr>
        <th>S.No</th>
        <th>Feedback</th>
        <th>User Name</th>
        <th>Datetime</th>
      </tr>
      <?php
      $sel="select * from tbl_feedback f inner join tbl_user u on f.user_id=u.user_id";
      $res=$Con->query($sel);
      $i=0;
      while($data=$res->fetch_assoc())
      {
        $i++; 
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data["feedback_content"]; ?></td>
        <td><?php echo $data["user_name"]; ?></td>
        <td><?php echo $data["feedback_datetime"]; ?></td>
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
