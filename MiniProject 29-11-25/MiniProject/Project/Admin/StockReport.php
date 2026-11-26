<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin - Stock Report</title>
<style>
/* Adapted styles */
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="stock-report-container">
    <h2 class="stock-report-title">Stock Levels Report</h2>
    <table class="stock-report-table">
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Current Stock</th>
            <th>Last Update</th>
        </tr>
        <?php
        $selQry = "SELECT p.product_id, p.product_name, SUM(s.stock_qty) as total_stock, MAX(s.stock_date) as last_update 
                   FROM tbl_product p LEFT JOIN tbl_stock s ON p.product_id = s.product_id 
                   GROUP BY p.product_id HAVING total_stock < 100"; // Low stock example
        $result = $Con->query($selQry);
        $stockData = [];
        while ($data = $result->fetch_assoc()) {
            echo "<tr><td>{$data['product_id']}</td><td>{$data['product_name']}</td><td>{$data['total_stock'] ?? 0}</td><td>{$data['last_update']}</td></tr>";
            $stockData[$data['product_name']] = $data['total_stock'] ?? 0;
        }
        ?>
    </table>
    <div class="stock-report-chart">
        <canvas id="stockChart"></canvas>
    </div>
    <script>
    const ctx = document.getElementById('stockChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($stockData)); ?>,
            datasets: [{
                label: 'Stock Quantity',
                data: <?php echo json_encode(array_values($stockData)); ?>,
                backgroundColor: '#c19a6b'
            }]
        }
    });
    </script>
</div>
</body>
</html>

<?php include("Footer.php"); ?>