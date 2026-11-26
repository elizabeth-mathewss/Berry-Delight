<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - User Booking Report</title>
<style>
body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  background: #faf9f6;
  margin: 0;
  padding: 0;
}

.user-report-container {
  max-width: 1100px;
  margin: 30px auto;
  padding: 20px;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

.user-report-title {
  font-size: 28px;
  font-weight: bold;
  color: #4a2e00;
  margin-bottom: 20px;
  text-align: center;
  border-bottom: 2px solid #c19a6b;
  padding-bottom: 10px;
}

.user-report-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  font-size: 15px;
}

.user-report-table th, 
.user-report-table td {
  padding: 12px 15px;
  text-align: center;
}

.user-report-table th {
  background: #c19a6b;
  color: #fff;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.user-report-table tr:nth-child(even) {
  background-color: #fdf6f0;
}

.user-report-table tr:hover {
  background-color: #f5e1c8;
  transition: 0.3s ease;
}

.user-report-table td {
  color: #333;
}

.user-report-chart {
  width: 80%;
  height: 400px;
  margin: 30px auto;
  padding: 20px;
  background: #fdf6f0;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

@media (max-width: 768px) {
  .user-report-table thead {
    display: none;
  }
  .user-report-table, 
  .user-report-table tbody, 
  .user-report-table tr, 
  .user-report-table td {
    display: block;
    width: 100%;
  }
  .user-report-table tr {
    margin-bottom: 15px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.05);
  }
  .user-report-table td {
    text-align: left;
    padding: 10px;
    position: relative;
    padding-left: 50%;
  }
  .user-report-table td:before {
    content: attr(data-label);
    position: absolute;
    left: 15px;
    font-weight: bold;
    color: #4a2e00;
  }
  
  .user-report-chart {
    width: 95%;
    height: 300px;
  }
}
</style>
</head>
<body>
<div class="user-report-container">
    <h2 class="user-report-title">User Booking Report</h2>
    <table class="user-report-table">
        <tr>
            <th>User Name</th>
            <th>Booking Count</th>
            <th>Total Amount (₹)</th>
            <th>Booking Dates</th>
        </tr>
        <?php
        $selQry = "SELECT u.user_name, 
                          COUNT(b.booking_id) as booking_count, 
                          COALESCE(SUM(b.booking_amount), 0) as total_amount, 
                          GROUP_CONCAT(DISTINCT b.booking_date ORDER BY b.booking_date DESC SEPARATOR ', ') as booking_dates
                   FROM tbl_user u
                   LEFT JOIN tbl_booking b ON u.user_id = b.user_id AND b.booking_status IN (1,2)
                   GROUP BY u.user_id, u.user_name
                   ORDER BY total_amount DESC";
        $result = $Con->query($selQry);
        $userBookings = [];
        while ($data = $result->fetch_assoc()) {
            $booking_dates = $data['booking_dates'] ? $data['booking_dates'] : 'No Bookings';
            echo "<tr>
                    <td data-label='User Name'>{$data['user_name']}</td>
                    <td data-label='Booking Count'>{$data['booking_count']}</td>
                    <td data-label='Total Amount (₹)'>₹" . number_format($data['total_amount'], 2) . "</td>
                    <td data-label='Booking Dates'>{$booking_dates}</td>
                  </tr>";
            $userBookings[$data['user_name']] = $data['total_amount'];
        }
        ?>
    </table>
    <div class="user-report-chart">
        <canvas id="bookingChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('bookingChart').getContext('2d');
    
    // Generate distinct colors for each user
    const colorPalette = [
        '#FF6384', '#062235ff', '#FFCE56', '#4BC0C0', '#640b5dff', 
        '#FF9F40', '#FF6384', '#C9CBCF', '#7CFC00', '#20B2AA',
        '#FFD700', '#FF6347', '#9370DB', '#00FA9A', '#FF4500',
        '#DA70D6', '#6495ED', '#FF69B4', '#00BFFF', '#32CD32'
    ];
    
    const userColors = [];
    const users = <?php echo json_encode(array_keys($userBookings)); ?>;
    
    for (let i = 0; i < users.length; i++) {
        userColors.push(colorPalette[i % colorPalette.length]);
    }
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($userBookings)); ?>,
            datasets: [{
                label: 'Total Booking Amount (₹)',
                data: <?php echo json_encode(array_values($userBookings)); ?>,
                backgroundColor: userColors,
                borderColor: '#4a2e00',
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
                        text: 'Total Amount (₹)',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
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
                        text: 'Users',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Amount: ₹' + context.raw.toLocaleString();
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