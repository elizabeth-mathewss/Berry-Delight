<?php
session_start();
include("../Assets/Connection/Connection.php");

// Make sure seller is logged in
if(!isset($_SESSION["sid"])) {
    header("Location: ../Seller/Login.php");
    exit();
}
include("Header.php");
$sellerId = $_SESSION["sid"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>Seller Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f7f7f7; }
        h2 { text-align: center; margin-top: 40px; }
        .chart-container { width: 80%; margin: 30px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        canvas { width: 100% !important; height: 400px !important; }
    </style>
</head>
<body>
<br>
<br>

<h1 style="text-align:center;">📊 My Reports</h1>

<?php
// -------------------- 1. Total Sales Revenue --------------------
$q1 = "SELECT SUM(b.booking_amount) AS total_revenue
       FROM tbl_booking b
       JOIN tbl_cart c ON b.booking_id = c.booking_id
       JOIN tbl_product p ON c.product_id = p.product_id
       WHERE b.booking_status = 2 AND p.seller_id = $sellerId";
$res1 = $Con->query($q1);
$row1 = $res1->fetch_assoc();
$totalRevenue = $row1["total_revenue"] ?? 0;

// -------------------- 2. Orders Count by Date --------------------
$q2 = "SELECT b.booking_date, COUNT(DISTINCT b.booking_id) AS total_orders
       FROM tbl_booking b
       JOIN tbl_cart c ON b.booking_id = c.booking_id
       JOIN tbl_product p ON c.product_id = p.product_id
       WHERE b.booking_status = 2 AND p.seller_id = $sellerId
       GROUP BY b.booking_date
       ORDER BY b.booking_date";
$res2 = $Con->query($q2);
$orderDates = $orderCounts = [];
while($row = $res2->fetch_assoc()) {
    $orderDates[] = $row['booking_date'];
    $orderCounts[] = $row['total_orders'];
}

// -------------------- 3. Top 5 Products --------------------
$q3 = "SELECT p.product_name, SUM(c.cart_qty) AS total_sold
       FROM tbl_cart c
       JOIN tbl_product p ON c.product_id = p.product_id
       JOIN tbl_booking b ON c.booking_id = b.booking_id
       WHERE p.seller_id = $sellerId AND b.booking_status = 2
       GROUP BY p.product_id
       ORDER BY total_sold DESC
       LIMIT 5";
$res3 = $Con->query($q3);
$productNames = $productSales = [];
while($row = $res3->fetch_assoc()) {
    $productNames[] = $row['product_name'];
    $productSales[] = $row['total_sold'];
}

// -------------------- 4. Monthly Sales Trend --------------------
$q4 = "SELECT DATE_FORMAT(b.booking_date, '%Y-%m') AS month, 
               SUM(b.booking_amount) AS monthly_sales
       FROM tbl_booking b
       JOIN tbl_cart c ON b.booking_id = c.booking_id
       JOIN tbl_product p ON c.product_id = p.product_id
       WHERE p.seller_id = $sellerId AND b.booking_status = 2
       GROUP BY month ORDER BY month";
$res4 = $Con->query($q4);
$months = $monthlySales = [];
while($row = $res4->fetch_assoc()) {
    $months[] = $row['month'];
    $monthlySales[] = $row['monthly_sales'];
}

// -------------------- 5. Average Rating --------------------
$q5 = "SELECT AVG(r.review_rating) AS avg_rating
       FROM tbl_review r
       JOIN tbl_product p ON r.product_id = p.product_id
       WHERE p.seller_id = $sellerId";
$res5 = $Con->query($q5);
$row5 = $res5->fetch_assoc();
$avgRating = round($row5["avg_rating"] ?? 0, 1);
?>

<div class="chart-container">
    <h2>1. Total Sales Revenue</h2>
    <canvas id="chart1"></canvas>
</div>

<div class="chart-container">
    <h2>2. Orders by Date</h2>
    <canvas id="chart2"></canvas>
</div>

<div class="chart-container">
    <h2>3. Top 5 Products Sold</h2>
    <canvas id="chart3"></canvas>
</div>

<div class="chart-container">
    <h2>4. Monthly Sales Trend</h2>
    <canvas id="chart4"></canvas>
</div>

<div class="chart-container">
    <h2>5. Average Rating of Product</h2>
    <canvas id="chart5"></canvas>
</div>

<script>
// 1. Total Sales Revenue
new Chart(document.getElementById('chart1'), {
    type: 'bar',
    data: {
        labels: ["Revenue"],
        datasets: [{
            label: '₹ Total Revenue',
            data: [<?php echo $totalRevenue; ?>],
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
        }]
    }
});

// 2. Orders by Date
new Chart(document.getElementById('chart2'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($orderDates); ?>,
        datasets: [{
            label: 'Orders',
            data: <?php echo json_encode($orderCounts); ?>,
            borderColor: 'rgba(255, 99, 132, 1)',
            fill: false
        }]
    }
});

// 3. Top Products
new Chart(document.getElementById('chart3'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($productNames); ?>,
        datasets: [{
            label: 'Units Sold',
            data: <?php echo json_encode($productSales); ?>,
            backgroundColor: 'rgba(255, 206, 86, 0.6)'
        }]
    }
});

// 4. Monthly Sales Trend
new Chart(document.getElementById('chart4'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
            label: 'Monthly Sales',
            data: <?php echo json_encode($monthlySales); ?>,
            borderColor: 'rgba(75, 192, 192, 1)',
            fill: false
        }]
    }
});

// 5. Average Rating
new Chart(document.getElementById('chart5'), {
    type: 'bar',
    data: {
        labels: ["Average Rating"],
        datasets: [{
            label: 'Rating',
            data: [<?php echo $avgRating; ?>],
            backgroundColor: 'rgba(153, 102, 255, 0.6)'
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true, max: 5 }
        }
    }
});
</script>

</body>
</html>
