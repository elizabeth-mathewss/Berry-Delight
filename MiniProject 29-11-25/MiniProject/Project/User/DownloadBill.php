<?php
include("../Assets/Connection/Connection.php");
session_start();

// Redirect if not logged in or if booking_id is not provided
$uid = $_SESSION['uid'] ?? null;
$booking_id = $_GET['bid'] ?? null;

if (!$uid || !$booking_id) {
    header("Location: MyBooking.php");
    exit;
}

// Use prepared statements to prevent SQL injection
$userQry = $Con->prepare("SELECT * FROM tbl_user WHERE user_id = ?");
$userQry->bind_param("i", $uid);
$userQry->execute();
$userRes = $userQry->get_result();
$user = $userRes->fetch_assoc();

if (!$user) {
    header("Location: MyBooking.php");
    exit;
}

// Fetch booking details using prepared statement
$bookingQry = $Con->prepare("SELECT b.*, u.user_name, u.user_email, u.user_contact 
                             FROM tbl_booking b 
                             INNER JOIN tbl_user u ON b.user_id = u.user_id  
                             WHERE b.booking_id = ? AND b.user_id = ?");
$bookingQry->bind_param("ii", $booking_id, $uid);
$bookingQry->execute();
$bookingRes = $bookingQry->get_result();
$bookingData = $bookingRes->fetch_assoc();

// If booking is not found, redirect
if (!$bookingData) {
    header("Location: MyBooking.php");
    exit;
}

// Fetch cart items for this booking
$cartQry = $Con->prepare("SELECT c.*, p.product_name, p.product_price 
                          FROM tbl_cart c 
                          INNER JOIN tbl_product p ON c.product_id = p.product_id 
                          WHERE c.booking_id = ?");
$cartQry->bind_param("i", $booking_id);
$cartQry->execute();
$cartRes = $cartQry->get_result();

// Calculate total
$subtotal = 0;
$cartItems = [];
while ($cartData = $cartRes->fetch_assoc()) {
    $lineTotal = $cartData['cart_qty'] * $cartData['product_price'];
    $subtotal += $lineTotal;
    $cartItems[] = $cartData;
}

// Get booking status text
$statusText = '';
switch ($bookingData['booking_status']) {
    case '0': $statusText = 'Pending'; break;
    case '1': $statusText = 'Confirmed'; break;
    case '2': $statusText = 'Paid'; break;
    case '3': $statusText = 'Shipped'; break;
    case '4': $statusText = 'Delivered'; break;
    case '5': $statusText = 'Completed'; break;
    default: $statusText = 'Pending';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invoice #<?php echo $booking_id; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }
        
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 15px rgba(0, 0, 0, .1);
            font-size: 16px;
            line-height: 24px;
            color: #555;
            background: #fff;
            border-radius: 8px;
        }
        
        .invoice-header {
            border-bottom: 2px solid #6c757d;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-name {
            color: #8d5e31ff;
            font-weight: bold;
            font-size: 28px;
        }
        
        .logo {
            max-width: 180px;
            margin-bottom: 15px;
        }
        
        .invoice-details {
            text-align: right;
        }
        
        .customer-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .table-items {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table-items th {
            background-color: #835e34ff;
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        .table-items td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        
        .table-items tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .total-row {
            font-weight: bold;
            font-size: 18px;
            color: #3d5a80;
        }
        
        .thank-you {
            margin-top: 30px;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 8px;
            text-align: center;
            font-style: italic;
        }
        
        .btn-print {
            background-color: #7e5b3bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .btn-print:hover {
            background-color: #925b36ff;
        }
        
        .btn-back {
            background-color: #ad844fff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .btn-back:hover {
            background-color: #5a6268;
            color: white;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Styles for printing */
        @media print {
            body * {
                visibility: hidden;
            }
            .invoice-box, .invoice-box * {
                visibility: visible;
            }
            .invoice-box {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none;
                border: none;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container my-4 no-print">
        <a href="MyBooking.php" class="btn-back">← Back to Bookings</a>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 invoice-box">
                    <div class="invoice-header">
                        <table width="100%">
                            <tr>
                                <td>
                                    <!-- Logo placeholder - replace with your actual logo -->
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 60px; height: 60px; background-color: #a8672aff; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                            <span style="color: white; font-weight: bold; font-size: 24px;">BD</span>
                                        </div>
                                        <div>
                                            <h1 class="company-name">Berry Delight</h1>
                                            <p style="margin: 0; color: #6c757d;">Dry Fruits Store</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="invoice-details">
                                    <h2>INVOICE</h2>
                                    <p>
                                        <strong>Invoice #:</strong> <?php echo $bookingData['booking_id']; ?><br>
                                        <strong>Date:</strong> <?php echo date('F d, Y', strtotime($bookingData['booking_date'])); ?><br>
                                        <strong>Status:</strong> 
                                        <span class="status-badge status-<?php echo $bookingData['booking_status'] == 2 ? 'paid' : 'pending'; ?>">
                                            <?php echo $statusText; ?>
                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="customer-details">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>From:</h4>
                                <p>
                                    <strong>Berry Delight Inc.</strong><br>
                                    Trivandrum, Kerala<br>
                                    India<br>
                                    Phone: +91 6282069770<br>
                                    Email: berrydelight08@gmail.com
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h4>Bill To:</h4>
                                <p>
                                    <strong><?php echo htmlspecialchars($user['user_name']); ?></strong><br>
                                    <?php echo htmlspecialchars($user['user_email']); ?><br>
                                    <?php echo htmlspecialchars($user['user_contact']); ?><br>
                                    <?php echo htmlspecialchars($user['user_address']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <table class="table-items">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($cartItems as $cartData) {
                                $lineTotal = $cartData['cart_qty'] * $cartData['product_price'];
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($cartData['product_name']); ?></td>
                                    <td><?php echo $cartData['cart_qty']; ?></td>
                                    <td>₹<?php echo number_format($cartData['product_price'], 2); ?></td>
                                    <td>₹<?php echo number_format($lineTotal, 2); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <!-- <tr class="total-row">
                                <td colspan="3" align="right">Subtotal:</td>
                                <td>₹<?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right">Tax (0%):</td>
                                <td>₹0.00</td>
                            </tr> -->
                            <tr class="total-row">
                                <td colspan="3" align="right">Total Amount:</td>
                                <td>₹<?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="thank-you">
                        <p>Thank you for your business! We appreciate your trust in Berry Delight.</p>
                        <p>For any questions regarding this invoice, please contact our customer service.</p>
                    </div>
                    
                    <div class="text-center mt-4 no-print">
                        <button onclick="window.print()" class="btn-print">Print Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section no-print mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="text-white">Copyright &copy; 2025 Berry Delight. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>