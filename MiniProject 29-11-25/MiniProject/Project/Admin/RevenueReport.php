<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin - Revenue Report</title>
<style>
body {
  font-family: "Segoe UI", Tahoma, sans-serif;
  background: #faf9f6;
  margin: 0;
  padding: 0;
}

.revenue-report-container {
  max-width: 1100px;
  margin: 30px auto;
  padding: 25px;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

.revenue-report-title {
  font-size: 28px;
  font-weight: bold;
  color: #4a2e00;
  text-align: center;
  margin-bottom: 25px;
  border-bottom: 2px solid #c19a6b;
  padding-bottom: 10px;
}

.revenue-report-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
  margin-bottom: 20px;
}

.revenue-report-table th,
.revenue-report-table td {
  padding: 12px 15px;
  text-align: center;
}

.revenue-report-table th {
  background: #af7f44ff;
  color: #fffffffb;
  text-transform: uppercase;
  font-size: 14px;
  letter-spacing: 0.5px;
}

.revenue-report-table tr:nth-child(even) {
  background-color: #fdf6f0;
}

.revenue-report-table tr:hover {
  background-color: #f5e1c8;
  transition: 0.3s ease;
}

.revenue-report-table td {
  color: #333;
}

.revenue-report-chart {
  width: 60%;
  margin: auto;
}

.total-revenue {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  margin-top: 20px;
  color: #4a2e00;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="revenue-report-container">
    <h2 class="revenue-report-title">Revenue Report</h2>
    <?php
    // Correct revenue calculation: sum of cart_qty * product_price for confirmed/completed bookings
    $selQry = "SELECT c.category_name, 
                      SUM(cart.cart_qty * p.product_price) AS revenue
               FROM tbl_category c
               INNER JOIN tbl_subcategory sc ON c.category_id = sc.category_id
               INNER JOIN tbl_product p ON sc.subcategory_id = p.subcategory_id
               INNER JOIN tbl_cart cart ON p.product_id = cart.product_id
               INNER JOIN tbl_booking b ON cart.booking_id = b.booking_id
               WHERE b.booking_status IN (1,2) -- 1=Confirmed, 2=Completed
               GROUP BY c.category_id
               ORDER BY revenue DESC";
    $result = $Con->query($selQry);
    
    $totalRevenue = 0;
    $revenueData = [];
    while ($data = $result->fetch_assoc()) {
        $revenueData[$data['category_name']] = $data['revenue'];
        $totalRevenue += $data['revenue'];
    }
    ?>
    
    <table class="revenue-report-table">
        <tr>
            <th>Category</th>
            <th>Total Revenue</th>
            <th>Percentage</th>
        </tr>
        <?php
        foreach ($revenueData as $category => $revenue) {
            $percentage = ($totalRevenue > 0) ? round(($revenue / $totalRevenue) * 100, 2) : 0;
            echo "<tr>
                    <td>{$category}</td>
                    <td>₹" . number_format($revenue, 2) . "</td>
                    <td>{$percentage}%</td>
                  </tr>";
        }
        ?>
    </table>
    
    <div class="total-revenue">
        Total Revenue: ₹<?php echo number_format($totalRevenue, 2); ?>
    </div>

    <div class="revenue-report-chart">
        <canvas id="revenueChart"></canvas>
    </div>
    <script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    // Generate distinct colors for each category
    const colorPalette = [
        '#0a3a04ff', '#662c0aff', '#d61c5aff', '#4BC0C0', '#ff2542ff', 
        '#FF9F40', '#92878aff', '#103e9bff', '#7CFC00', '#b22092ff',
        '#d38818ff', '#FF6347', '#9370DB', '#00FA9A', '#FF4500',
        '#DA70D6', '#6495ED', '#660707ff', '#02455cff', '#32CD32'
    ];
    
    const categoryColors = [];
    const categories = <?php echo json_encode(array_keys($revenueData)); ?>;
    
    for (let i = 0; i < categories.length; i++) {
        categoryColors.push(colorPalette[i % colorPalette.length]);
    }
    
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(array_keys($revenueData)); ?>,
            datasets: [{
                data: <?php echo json_encode(array_values($revenueData)); ?>,
                backgroundColor: categoryColors,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(2);
                            return `₹${value.toLocaleString()} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
    </script>
</div>
</body>
</html>

<?php include("Footer.php"); ?>