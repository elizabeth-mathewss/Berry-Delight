<?php
include("../Assets/Connection/Connection.php");
session_start();

if (!isset($_SESSION['sid'])) {
    header("Location: ../Login.php");
    exit();
}

$sellerId = $_SESSION['sid'];

if (isset($_GET["cid"]) && isset($_GET["sts"])) {
    $cid = $_GET["cid"];
    $sts = $_GET["sts"];
    $updateQry = "UPDATE tbl_cart SET cart_status = '$sts' WHERE cart_id = '$cid'";
    $Con->query($updateQry);
    header("Location: ViewBooking.php");
    exit();
}

$selqry = "SELECT * FROM tbl_cart c 
           INNER JOIN tbl_product p ON c.product_id = p.product_id 
           INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
           INNER JOIN tbl_user u ON b.user_id = u.user_id
           WHERE p.seller_id = '".$_SESSION['sid']."' AND b.booking_status != 0 AND c.cart_status != 0"; 
         
$res = $Con->query($selqry);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DryFruit Haven - Order Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f6f1;
            color: #5c3d2e;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            color: #7a4c2a;
            text-align: center;
            margin: 30px 0;
            font-size: 2.2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e8d6c0;
        }

        th {
            background-color: #7a4c2a;
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        tr:nth-child(even) {
            background-color: #fcf8f3;
        }

        tr:hover {
            background-color: #f9f0e3;
        }

        .btn {
            padding: 8px 16px;
            background-color: #9e7b5f;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            transition: background 0.3s ease;
            display: inline-block;
            margin-top: 8px;
        }

        .btn:hover {
            background-color: #7a4c2a;
        }

        .status-text {
            font-weight: 500;
            color: #7a4c2a;
            display: block;
            margin-bottom: 5px;
        }

        .user-info {
            text-align: left;
            line-height: 1.4;
        }

        .user-info br {
            margin-bottom: 5px;
            display: block;
            content: "";
        }

        .header-spacer {
            height: 40px;
        }

        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
            }
            
            th, td {
                padding: 10px 5px;
                font-size: 0.85rem;
            }
            
            .btn {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>

<?php include("Header.php"); ?>
<div class="header-spacer"></div>

<div class="container">
    <h1 class="page-title">Order Details</h1>

    <table>
        <tr>
            <th>S.No</th>
            <th>User Details</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Status / Action</th>
        </tr>

        <?php
        $i = 0;
        while ($data = $res->fetch_assoc()) {
            $i++;
            $quantity = $data["cart_qty"];
            $price = $data["product_price"];
            $total = $quantity * $price;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td class="user-info">
                <strong><?php echo($data['user_name']); ?></strong><br>
                <?php echo($data['user_email']);?><br>
                <?php 
                if($data['booking_address']) {
                    echo $data['booking_address'];
                } else {
                    echo($data['user_address']);
                }
                ?><br>
                <?php echo($data['user_contact']);?>
            </td>
            <td><?php echo ($data['product_name']); ?></td>
            <td>₹<?php echo $price; ?></td>
            <td><?php echo $quantity; ?></td>
            <td>₹<?php echo $total; ?></td>
            <td>
                <?php 
                if ($data["booking_status"] == 1 && $data["cart_status"] == 1) {
                    echo "<span class='status-text'>Payment Pending...</span>";
                } 
                else if ($data["booking_status"] == 2 && $data["cart_status"] == 1) {
                    echo "<span class='status-text'>Payment Completed</span><br>";
                    echo "<a class='btn' href='ViewBooking.php?cid={$data['cart_id']}&sts=2'>Pack Product</a>";
                } 
                else if ($data["booking_status"] == 2 && $data["cart_status"] == 2) {
                    echo "<span class='status-text'>Product Packed</span><br>";
                    echo "<a class='btn' href='ViewBooking.php?cid={$data['cart_id']}&sts=3'>Ship Product</a>";
                } 
                else if ($data["booking_status"] == 2 && $data["cart_status"] == 3) {
                    echo "<span class='status-text'>Product Shipped</span><br>";
                    echo "<a class='btn' href='ViewBooking.php?cid={$data['cart_id']}&sts=4'>Mark as Delivered</a>";
                } 
                else if ($data["booking_status"] == 2 && $data["cart_status"] == 4) {
                    echo "<span class='status-text'>Order Completed</span>";
                }
                ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include("Footer.php"); ?>
</body>
</html>