<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

// Read filter values (if any)
$fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$toDate = isset($_GET['to_date']) ? $_GET['to_date'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Admin - Sales Report</title>
    <style>
/* Professional styles for sales report page */
.sales-report-container {
    width: 95%;
    margin: 30px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #2c2c2c;
}
.sales-report-title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin: 40px 0 20px 0;
    color: #4a2e00; /* dark walnut shade */
    border-bottom: 2px solid #c19a6b;
    padding-bottom: 8px;
}
.sales-report-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 50px;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
}
.sales-report-table th {
    background-color: #c19a6b;
    color: #fff;
    padding: 12px;
    text-align: center;
    font-size: 15px;
    letter-spacing: 0.5px;
}
.sales-report-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
    vertical-align: middle;
}
.sales-report-table tr:nth-child(even) {
    background-color: #fdf6f0;
}
.sales-report-table tr:hover {
    background-color: #f5e1c8;
}
.sales-report-chart {
    width: 80%;
    margin: 40px auto;
    height: 400px;
}
.filter-form {
    text-align: center;
    margin-bottom: 30px;
}
.filter-form input[type="date"] {
    padding: 8px 12px;
    margin: 0 10px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
.filter-form button {
    padding: 8px 20px;
    background-color: #c19a6b;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}
.filter-form button:hover {
    background-color: #a67c52;
}
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="sales-report-container">
    <h2 class="sales-report-title">Sales Report</h2>

    <!-- Filter Form -->
    <form method="GET" class="filter-form">
        <label>From: <input type="date" name="from_date" value="<?php echo $fromDate; ?>" /></label>
        <label>To: <input type="date" name="to_date" value="<?php echo $toDate; ?>" /></label>
        <button type="submit">Filter</button>
    </form>

    <table class="sales-report-table">
        <tr>
            <th>Booking ID</th>
            <th>User Name</th>
            <th>Booking Date</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
        <?php
        // Base query
        $selQry = "SELECT b.booking_id, u.user_name, b.booking_date, b.booking_amount, b.booking_status 
                   FROM tbl_booking b 
                   INNER JOIN tbl_user u ON b.user_id = u.user_id 
                   WHERE 1";

        // Apply date filter if given
        if (!empty($fromDate)) {
            $selQry .= " AND b.booking_date >= '$fromDate'";
        }
        if (!empty($toDate)) {
            $selQry .= " AND b.booking_date <= '$toDate'";
        }

        $selQry .= " ORDER BY b.booking_date ASC";

        $result = $Con->query($selQry);
        $salesData = [];

        if ($result && $result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$data['booking_id']}</td>
                        <td>{$data['user_name']}</td>
                        <td>{$data['booking_date']}</td>
                        <td>₹{$data['booking_amount']}</td>
                        <td>" . ($data['booking_status'] == 1 ? 'Completed' : 'Pending') . "</td>
                      </tr>";
                // Group sales by date
                $salesData[$data['booking_date']] = ($salesData[$data['booking_date']] ?? 0) + $data['booking_amount'];
            }
        } else {
            echo "<tr><td colspan='5'>No records found.</td></tr>";
        }
        ?>
    </table>

    <!-- Bar Chart -->
    <div class="sales-report-chart">
        <canvas id="salesChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($salesData)); ?>,
                datasets: [{
                    label: 'Sales Amount',
                    data: <?php echo json_encode(array_values($salesData)); ?>,
                    backgroundColor: '#c19a6b'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Sales Amount by Date',
                        color: '#4a2e00',
                        font: { size: 18, weight: 'bold' }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₹' + value;
                            }
                        }
                    },
                    x: {
                        ticks: { maxRotation: 90, minRotation: 45 }
                    }
                }
            }
        });
    </script>
</div>
</body>
</html>

<?php include("Footer.php"); ?>
