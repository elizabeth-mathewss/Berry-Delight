<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin - Complaints Report</title>
<style>
body {
  font-family: "Segoe UI", Tahoma, sans-serif;
  background: #faf9f6;
  margin: 0;
  padding: 0;
}

.complaint-report-container {
  max-width: 1200px;
  margin: 30px auto;
  padding: 25px;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

.complaint-report-title {
  font-size: 28px;
  font-weight: bold;
  color: #4a2e00;
  text-align: center;
  margin-bottom: 25px;
  border-bottom: 2px solid #c19a6b;
  padding-bottom: 10px;
}

.complaint-report-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
  margin-bottom: 30px;
}

.complaint-report-table th,
.complaint-report-table td {
  padding: 12px 15px;
  text-align: center;
}

.complaint-report-table th {
  background: #c19a6b;
  color: #fff;
  text-transform: uppercase;
  font-size: 14px;
  letter-spacing: 0.5px;
}

.complaint-report-table tr:nth-child(even) {
  background-color: #fdf6f0;
}

.complaint-report-table tr:hover {
  background-color: #f5e1c8;
  transition: 0.3s ease;
}

.complaint-report-table td {
  color: #333;
}

/* Status color coding */
.status-pending {
  color: #d35400;
  font-weight: bold;
}
.status-resolved {
  color: #27ae60;
  font-weight: bold;
}

.complaint-report-chart {
  width: 70%;
  margin: 40px auto;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="complaint-report-container">
    <h2 class="complaint-report-title">Complaints Report</h2>
    <table class="complaint-report-table">
        <tr>
            <th>Complaint ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>User</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <?php
        $selQry = "SELECT c.complaint_id, c.complaint_title, c.complaint_content, 
                          u.user_name, c.complaint_status, c.complaint_date 
                   FROM tbl_complaint c 
                   INNER JOIN tbl_user u ON c.user_id = u.user_id 
                   ORDER BY c.complaint_date DESC";
        $result = $Con->query($selQry);

        $statusData = ["Pending" => 0, "Resolved" => 0];

        while ($data = $result->fetch_assoc()) {
            $status = $data['complaint_status'] == 1 
                        ? "<span class='status-resolved'>Resolved</span>" 
                        : "<span class='status-pending'>Pending</span>";

            echo "<tr>
                    <td>{$data['complaint_id']}</td>
                    <td>{$data['complaint_title']}</td>
                    <td>{$data['complaint_content']}</td>
                    <td>{$data['user_name']}</td>
                    <td>{$status}</td>
                    <td>{$data['complaint_date']}</td>
                  </tr>";

            if ($data['complaint_status'] == 1) {
                $statusData["Resolved"]++;
            } else {
                $statusData["Pending"]++;
            }
        }
        ?>
    </table>

    <!-- Bar Graph -->
    <div class="complaint-report-chart">
        <canvas id="complaintChart"></canvas>
    </div>
    <script>
    const ctx = document.getElementById('complaintChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($statusData)); ?>,
            datasets: [{
                label: 'Number of Complaints',
                data: <?php echo json_encode(array_values($statusData)); ?>,
                backgroundColor: ['#d35400', '#27ae60']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Complaints by Status',
                    color: '#4a2e00',
                    font: { size: 18, weight: 'bold' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision:0 }
                }
            }
        }
    });
    </script>
</div>
</body>
</html>

<?php include("Footer.php"); ?>
