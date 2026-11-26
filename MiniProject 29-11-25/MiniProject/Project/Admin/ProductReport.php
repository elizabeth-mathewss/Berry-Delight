<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Product Report</title>
<style>
.product-report-container { padding:20px; font-family:Arial; }
.product-report-title { font-size:24px; margin-bottom:15px; color:#444; }
.product-report-table { width:100%; border-collapse:collapse; margin-bottom:20px; }
.product-report-table th, .product-report-table td { border:1px solid #ccc; padding:8px; text-align:center; }
.product-report-table th { background:#f5f5f5; }
.product-report-chart { width:70%; margin:auto; }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <style>
body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  background: #faf9f6;
  margin: 0;
  padding: 0;
}

.product-report-container {
  max-width: 1200px;
  margin: 30px auto;
  padding: 25px;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

.product-report-title {
  font-size: 28px;
  font-weight: bold;
  color: #4a2e00;
  text-align: center;
  margin-bottom: 25px;
  border-bottom: 2px solid #c19a6b;
  padding-bottom: 10px;
}

.product-report-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
  margin-bottom: 20px;
}

.product-report-table th,
.product-report-table td {
  padding: 14px 16px;
  text-align: center;
}

.product-report-table th {
  background: #c19a6b;
  color: #fff;
  text-transform: uppercase;
  font-size: 14px;
  letter-spacing: 0.5px;
}

.product-report-table tr:nth-child(even) {
  background-color: #fdf6f0;
}

.product-report-table tr:hover {
  background-color: #f5e1c8;
  transition: 0.3s ease;
}

.product-report-table td {
  color: #333;
  font-size: 14px;
}

/* Highlight best sellers */
.product-report-table tr:first-of-type td {
  font-weight: 600;
  background-color: #fff6e6;
  color: #27ae60;
}

/* Responsive (mobile view) */
@media (max-width: 768px) {
  .product-report-table thead {
    display: none;
  }
  .product-report-table, 
  .product-report-table tbody, 
  .product-report-table tr, 
  .product-report-table td {
    display: block;
    width: 100%;
  }
  .product-report-table tr {
    margin-bottom: 15px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 12px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.05);
  }
  .product-report-table td {
    text-align: left;
    padding: 10px;
    position: relative;
    padding-left: 50%;
  }
  .product-report-table td:before {
    content: attr(data-label);
    position: absolute;
    left: 15px;
    font-weight: bold;
    color: #4a2e00;
  }
}
</style>

 <div class="product-report-container">
    <h2 class="product-report-title">Product Popularity Report</h2>
    <table class="product-report-table">
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Sales Qty</th>
        </tr>
        <?php
        $selQry = "SELECT p.product_id, p.product_name, c.category_name, p.product_price, 
                          IFNULL(SUM(cart.cart_qty),0) AS sales_qty
                   FROM tbl_product p
                   INNER JOIN tbl_subcategory sc ON p.subcategory_id = sc.subcategory_id
                   INNER JOIN tbl_category c ON sc.category_id = c.category_id
                   LEFT JOIN tbl_cart cart ON p.product_id = cart.product_id
                   GROUP BY p.product_id, p.product_name, c.category_name, p.product_price
                   ORDER BY sales_qty DESC";
        $result = $Con->query($selQry);
        $productData = [];
        while ($data = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$data['product_id']}</td>
                    <td>{$data['product_name']}</td>
                    <td>{$data['category_name']}</td>
                    <td>{$data['product_price']}</td>
                    <td>{$data['sales_qty']}</td>
                  </tr>";
            $productData[$data['product_name']] = $data['sales_qty'];
        }
        ?> 
    </table> 
    <div class="product-report-chart">
        <canvas id="productChart"></canvas>
    </div>
    <script>
    const ctx = document.getElementById('productChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_keys($productData)); ?>,
            datasets: [{
                label: 'Sales Quantity',
                data: <?php echo json_encode(array_values($productData)); ?>,
                backgroundColor: '#c19a6b'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
    </script>
</div>
</body>
</html>

<?php include("Footer.php"); ?>
