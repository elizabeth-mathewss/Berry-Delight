<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Admin - Seller Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .seller-report-container {
            width: 95%;
            margin: 30px auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2c2c2c;
        }
        .seller-report-title {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            margin: 40px 0 20px 0;
            color: #4a2e00;
            border-bottom: 2px solid #c19a6b;
            padding-bottom: 8px;
        }
        .seller-report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        }
        .seller-report-table th {
            background-color: #c19a6b;
            color: #fff;
            padding: 12px;
            text-align: center;
            font-size: 15px;
            letter-spacing: 0.5px;
        }
        .seller-report-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }
        .seller-report-table tr:nth-child(even) {
            background-color: #fdf6f0;
        }
        .seller-report-table tr:hover {
            background-color: #f5e1c8;
        }
        .seller-report-chart {
            width: 80%;
            margin: 40px auto;
            height: 400px;
        }
    </style>
</head>
<body>

<div class="seller-report-container">
    <h2 class="seller-report-title">Seller Performance Report</h2>

    <table class="seller-report-table">
        <tr>
            <th>Seller ID</th>
            <th>Name</th>
            <th>Total Products</th>
            <th>Total Sales (₹)</th>
            <th>Status</th>
        </tr>
        <?php
        // Corrected query to get accurate sales data
        $selQry = "SELECT 
                        s.seller_id, 
                        s.seller_name, 
                        COUNT(DISTINCT p.product_id) AS products,
                        COALESCE(SUM(c.cart_qty * pq.productqty_price), 0) AS sales,
                        s.seller_status 
                    FROM tbl_seller s 
                    LEFT JOIN tbl_product p ON s.seller_id = p.seller_id 
                    LEFT JOIN tbl_cart c ON p.product_id = c.product_id 
                    LEFT JOIN tbl_booking b ON c.booking_id = b.booking_id AND b.booking_status = 2
                    LEFT JOIN tbl_productqty pq ON p.product_id = pq.product_id AND pq.quantity_id IN (
                        SELECT quantity_id FROM tbl_quantity
                    )
                    GROUP BY s.seller_id, s.seller_name, s.seller_status
                    ORDER BY sales DESC";

        $result = $Con->query($selQry);
        $sellerData = [];
        $sellerNames = [];
        $sellerSales = [];

        if ($result && $result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $statusText = $data['seller_status'] == 1 ? "Active" : "Inactive";
                echo "<tr>
                        <td>{$data['seller_id']}</td>
                        <td>{$data['seller_name']}</td>
                        <td>{$data['products']}</td>
                        <td>" . number_format($data['sales'], 2) . "</td>
                        <td>{$statusText}</td>
                      </tr>";

                // Prepare data for chart
                $sellerNames[] = $data['seller_name'];
                $sellerSales[] = (float)$data['sales'];
            }
        } else {
            echo "<tr><td colspan='5'>No seller records found.</td></tr>";
        }
        ?>
    </table>

    <!-- <div class="seller-report-chart">
        <canvas id="sellerChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('sellerChart').getContext('2d');
        const sellerChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($sellerNames); ?>,
                datasets: [{
                    label: 'Total Sales (₹)',
                    data: <?php echo json_encode($sellerSales); ?>,
                    backgroundColor: [
                        'rgba(193, 154, 107, 0.8)',
                        'rgba(101, 67, 33, 0.8)',
                        'rgba(139, 69, 19, 0.8)',
                        'rgba(160, 82, 45, 0.8)',
                        'rgba(205, 133, 63, 0.8)',
                        'rgba(210, 105, 30, 0.8)'
                    ],
                    borderColor: '#8B4513',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Sales Amount (₹)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '₹' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Sellers'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Seller Performance by Sales Revenue',
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>

</div> -->

</body>
</html>

<?php include("Footer.php"); ?>