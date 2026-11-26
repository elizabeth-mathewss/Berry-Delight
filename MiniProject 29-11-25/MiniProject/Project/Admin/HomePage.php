<?php
include('../Assets/Connection/Connection.php');
session_start();

// Fetch statistics from database
// Total Users
$userQuery = "SELECT COUNT(*) as total FROM tbl_user";
$userResult = $Con->query($userQuery);
$totalUsers = $userResult->fetch_assoc()['total'];

// Total Sellers
$sellerQuery = "SELECT COUNT(*) as total FROM tbl_seller WHERE seller_status = 1";
$sellerResult = $Con->query($sellerQuery);
$totalSellers = $sellerResult->fetch_assoc()['total'];

// Total Products
$productQuery = "SELECT COUNT(*) as total FROM tbl_product";
$productResult = $Con->query($productQuery);
$totalProducts = $productResult->fetch_assoc()['total'];

// Total Orders
$orderQuery = "SELECT COUNT(*) as total FROM tbl_booking";
$orderResult = $Con->query($orderQuery);
$totalOrders = $orderResult->fetch_assoc()['total'];

// Pending Orders
$pendingQuery = "SELECT COUNT(*) as total FROM tbl_booking WHERE booking_status = 0";
$pendingResult = $Con->query($pendingQuery);
$pendingOrders = $pendingResult->fetch_assoc()['total'];

// Completed Orders
$completedQuery = "SELECT COUNT(*) as total FROM tbl_booking WHERE booking_status = 2";
$completedResult = $Con->query($completedQuery);
$completedOrders = $completedResult->fetch_assoc()['total'];

// Total Revenue
$revenueQuery = "SELECT SUM(booking_amount) as total FROM tbl_booking WHERE booking_status = 2";
$revenueResult = $Con->query($revenueQuery);
$totalRevenue = $revenueResult->fetch_assoc()['total'] ?? 0;

// This Month's Revenue
$monthRevenueQuery = "SELECT SUM(booking_amount) as total FROM tbl_booking 
                      WHERE booking_status = 2 AND MONTH(booking_date) = MONTH(CURRENT_DATE()) 
                      AND YEAR(booking_date) = YEAR(CURRENT_DATE())";
$monthRevenueResult = $Con->query($monthRevenueQuery);
$monthRevenue = $monthRevenueResult->fetch_assoc()['total'] ?? 0;

// Pending Complaints
$complaintQuery = "SELECT COUNT(*) as total FROM tbl_complaint WHERE complaint_status = 0";
$complaintResult = $Con->query($complaintQuery);
$pendingComplaints = $complaintResult->fetch_assoc()['total'];

// Recent Orders for table
$recentOrdersQuery = "SELECT b.*, u.user_name 
                      FROM tbl_booking b 
                      INNER JOIN tbl_user u ON b.user_id = u.user_id 
                      ORDER BY b.booking_date DESC 
                      LIMIT 5";
$recentOrdersResult = $Con->query($recentOrdersQuery);

// Top Selling Products
$topProductsQuery = "SELECT p.product_name, SUM(c.cart_qty) as total_sold 
                     FROM tbl_cart c 
                     INNER JOIN tbl_product p ON c.product_id = p.product_id 
                     WHERE c.cart_status = 1 
                     GROUP BY c.product_id 
                     ORDER BY total_sold DESC 
                     LIMIT 5";
$topProductsResult = $Con->query($topProductsQuery);

// Monthly Revenue for Chart (Last 6 months)
$chartData = [];
for($i = 5; $i >= 0; $i--) {
    $month = date('Y-m', strtotime("-$i months"));
    $chartQuery = "SELECT SUM(booking_amount) as total 
                   FROM tbl_booking 
                   WHERE booking_status = 2 
                   AND DATE_FORMAT(booking_date, '%Y-%m') = '$month'";
    $chartResult = $Con->query($chartQuery);
    $monthTotal = $chartResult->fetch_assoc()['total'] ?? 0;
    $chartData[] = [
        'month' => date('M Y', strtotime("-$i months")),
        'revenue' => $monthTotal
    ];
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard - Berry Delight Admin</title>
    <meta name="description" content="" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/fonts/boxicons.css" />
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/demo.css" />
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/libs/apex-charts/apex-charts.css" />
    
    <!-- Helpers -->
    <script src="../Assets/Templates/Admin/assets/vendor/js/helpers.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.php" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- <img src="../Assets/Files/logo.png" alt="Berry Delight" width="40"> -->
                        </span>
                        <h4><span class="demo menu-text fw-bolder ms-2">BERRY DELIGHT</span></h4>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="index.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <!-- Location -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Layouts">Location</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="District.php" class="menu-link">
                                    <div data-i18n="Without menu">District</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="Place.php" class="menu-link">
                                    <div data-i18n="Without navbar">Place</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Product -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Layouts">Product</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="Category.php" class="menu-link">
                                    <div data-i18n="Without menu">Category</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="Subcategory.php" class="menu-link">
                                    <div data-i18n="Without navbar">Subcategory</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="Quantity.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-detail"></i>
                            <div data-i18n="Analytics">Quantity</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="Sellerlist.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-store"></i>
                            <div data-i18n="Analytics">Sellerlist</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="Userlist.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Userlist</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="ViewComplaint.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-message-square-error"></i>
                            <div data-i18n="Analytics">View Complaint</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="ViewFeedback.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-comment-detail"></i>
                            <div data-i18n="Analytics">View Feedback</div>
                        </a>
                    </li>

                    <!-- Reports Menu -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Reports">Reports</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="SalesReport.php" class="menu-link">
                                    <div>Sales Report</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="SellerReport.php" class="menu-link">
                                    <div>Seller Report</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="BookingReport.php" class="menu-link">
                                    <div>Booking Report</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="ProductReport.php" class="menu-link">
                                    <div>Product Report</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="UserReport.php" class="menu-link">
                                    <div>User Report</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="ComplaintReport.php" class="menu-link">
                                    <div>Complaint Report</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="RevenueReport.php" class="menu-link">
                                    <div>Revenue Report</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <div class="navbar-nav align-items-center">
                            <h4 class="mb-0">Admin Dashboard</h4>
                        </div>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../Assets/Files/SellerDocs/youngwoman.jpg" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="../Assets/Files/SellerDocs/youngwoman.jpg" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">Elizabeth Mathews</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li><div class="dropdown-divider"></div></li>
                                    <li>
                                        <a class="dropdown-item" href="../Guest/Login.php">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Statistics Cards Row 1 -->
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="../Assets/Templates/Admin/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Total Revenue</span>
                                        <h3 class="card-title mb-2">₹<?php echo number_format($totalRevenue, 2); ?></h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> All Time</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="../Assets/Templates/Admin/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                                            </div>
                                        </div>
                                        <span>This Month</span>
                                        <h3 class="card-title text-nowrap mb-1">₹<?php echo number_format($monthRevenue, 2); ?></h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php echo date('F Y'); ?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="../Assets/Templates/Admin/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="d-block mb-1">Total Orders</span>
                                        <h3 class="card-title text-nowrap mb-2"><?php echo $totalOrders; ?></h3>
                                        <small class="text-warning fw-semibold"><?php echo $pendingOrders; ?> Pending</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="../Assets/Templates/Admin/assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Completed Orders</span>
                                        <h3 class="card-title mb-2"><?php echo $completedOrders; ?></h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-check-circle"></i> Delivered</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics Cards Row 2 -->
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                            </div>
                                            <div>
                                                <span class="fw-semibold d-block">Total Users</span>
                                                <h3 class="card-title mb-0"><?php echo $totalUsers; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-store"></i></span>
                                            </div>
                                            <div>
                                                <span class="fw-semibold d-block">Active Sellers</span>
                                                <h3 class="card-title mb-0"><?php echo $totalSellers; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-box"></i></span>
                                            </div>
                                            <div>
                                                <span class="fw-semibold d-block">Total Products</span>
                                                <h3 class="card-title mb-0"><?php echo $totalProducts; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-message-square-error"></i></span>
                                            </div>
                                            <div>
                                                <span class="fw-semibold d-block">Pending Complaints</span>
                                                <h3 class="card-title mb-0"><?php echo $pendingComplaints; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Revenue Chart -->
                            <div class="col-lg-8 mb-4">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-5 me-2">Revenue Overview</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary" type="button">
                                                Last 6 Months
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="revenueChart"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Top Products -->
                            <div class="col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title m-0">Top Selling Products</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <?php while($product = $topProductsResult->fetch_assoc()): ?>
                                            <li class="d-flex mb-3 pb-1">
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0"><?php echo htmlspecialchars($product['product_name']); ?></h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <span class="badge bg-label-primary"><?php echo $product['total_sold']; ?> sold</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Orders Table -->
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title m-0">Recent Orders</h5>
                                    </div>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Customer</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php while($order = $recentOrdersResult->fetch_assoc()): ?>
                                                <tr>
                                                    <td><strong>#<?php echo $order['booking_id']; ?></strong></td>
                                                    <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                                                    <td><?php echo date('d M Y', strtotime($order['booking_date'])); ?></td>
                                                    <td>₹<?php echo number_format($order['booking_amount'], 2); ?></td>
                                                    <td>
                                                        <?php 
                                                        if($order['booking_status'] == 0) {
                                                            echo '<span class="badge bg-label-warning">Pending</span>';
                                                        } elseif($order['booking_status'] == 1) {
                                                            echo '<span class="badge bg-label-info">Processing</span>';
                                                        } else {
                                                            echo '<span class="badge bg-label-success">Completed</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © <?php echo date('Y'); ?> Berry Delight. All Rights Reserved.
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="../Assets/Templates/Admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../Assets/Templates/Admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../Assets/Templates/Admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../Assets/Templates/Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../Assets/Templates/Admin/assets/vendor/js/menu.js"></script>
    
    <!-- Vendors JS -->
    <script src="../Assets/Templates/Admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    
    <!-- Main JS -->
    <script src="../Assets/Templates/Admin/assets/js/main.js"></script>
    
    <!-- Page JS -->
    <script>
    // Revenue Chart
    var revenueOptions = {
        series: [{
            name: 'Revenue',
            data: [<?php echo implode(',', array_column($chartData, 'revenue')); ?>]
        }],
        chart: {
            height: 300,
            type: 'area',
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        xaxis: {
            categories: <?php echo json_encode(array_column($chartData, 'month')); ?>
        },
        colors: ['#696cff'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
                stops: [0, 90, 100]
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "₹" + val.toFixed(2)
                }
            }
        }
    };

    var revenueChart = new ApexCharts(document.querySelector("#revenueChart