<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Booking Report</title>
<style>
.booking-report-container { padding:20px; font-family:Arial; }
.booking-report-title { font-size:24px; margin-bottom:15px; color:#444; }
.booking-report-table { width:100%; border-collapse:collapse; margin-bottom:20px; }
.booking-report-table th, .booking-report-table td { border:1px solid #ccc; padding:8px; text-align:center; }
.booking-report-table th { background:#f5f5f5; }
.booking-report-chart { width:50%; margin:auto; }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <style>
body {
  font-family: "Segoe UI", Tahoma, sans-serif;
  background: #faf9f6;
  margin: 0;
  padding: 0;
}

.booking-report-container {
  max-width: 1100px;
  margin: 30px auto;
  padding: 25px;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

.booking-report-title {
  font-size: 28px;
  font-weight: 700;
  color: #4a2e00;
  text-align: center;
  margin-bottom: 25px;
  border-bottom: 2px solid #c19a6b;
  padding-bottom: 10px;
}

.booking-report-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
  margin-bottom: 20px;
}

.booking-report-table th,
.booking-report-table td {
  padding: 14px 16px;
  text-align: center;
}

.booking-report-table th {
  background: #c19a6b;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-size: 14px;
}

.booking-report-table tr:nth-child(even) {
  background-color: #fdf6f0;
}

.booking-report-table tr:hover {
  background-color: #f5e1c8;
  transition: 0.3s ease;
}

.booking-report-table td {
  color: #333;
}

/* Status label styling */
.booking-report-table td:last-child {
  font-weight: 600;
  padding: 10px;
  border-radius: 8px;
}
.booking-report-table td:last-child:contains("Pending") {
  color: #d35400;
}
.booking-report-table td:last-child:contains("Confirmed") {
  color: #2980b9;
}
.booking-report-table td:last-child:contains("Completed") {
  color: #27ae60;
}

/* Responsive */
@media (max-width: 768px) {
  .booking-report-table thead {
    display: none;
  }
  .booking-report-table, 
  .booking-report-table tbody, 
  .booking-report-table tr, 
  .booking-report-table td {
    display: block;
    width: 100%;
  }
  .booking-report-table tr {
    margin-bottom: 15px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 12px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.05);
  }
  .booking-report-table td {
    text-align: left;
    padding: 10px;
    position: relative;
    padding-left: 50%;
  }
  .booking-report-table td:before {
    content: attr(data-label);
    position: absolute;
    left: 15px;
    font-weight: bold;
    color: #4a2e00;
  }
}
</style>

<div class="booking-report-container">
    <h2 class="booking-report-title">Booking Status Report</h2>
    <table class="booking-report-table">
        <tr>
            <th>Booking ID</th>
            <th>User</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
        <?php
        $selQry = "SELECT b.booking_id, u.user_name, b.booking_date, b.booking_amount, b.booking_status 
                   FROM tbl_booking b 
                   INNER JOIN tbl_user u ON b.user_id = u.user_id";
        $result = $Con->query($selQry);

        $statusData = ['Pending' => 0, 'Confirmed' => 0, 'Completed' => 0];

        while ($data = $result->fetch_assoc()) {
            // Map status codes
            if ($data['booking_status'] == 0) {
                $status = "Pending";
            } elseif ($data['booking_status'] == 1) {
                $status = "Confirmed";
            } else {
                $status = "Completed";
            }

            echo "<tr>
                    <td>{$data['booking_id']}</td>
                    <td>{$data['user_name']}</td>
                    <td>{$data['booking_date']}</td>
                    <td>{$data['booking_amount']}</td>
                    <td>{$status}</td>
                  </tr>";

            $statusData[$status]++;
        }
        ?>
    </table>

    <div class="booking-report-chart">
        <canvas id="bookingChart"></canvas>
    </div>
    <script>
    const ctx = document.getElementById('bookingChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(array_keys($statusData)); ?>,
            datasets: [{
                data: <?php echo json_encode(array_values($statusData)); ?>,
                backgroundColor: ['#f39c12', '#3498db', '#2ecc71']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
    </script>
</div>
</body>
</html>

<?php include("Footer.php"); ?>
