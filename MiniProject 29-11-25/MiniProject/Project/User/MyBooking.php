<?php  
include("../Assets/Connection/Connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Bookings - Berry Delight</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../Assets/Templates/Main/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="../Assets/Templates/Main/lib/owlcarousel/../Assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
    
    <style>
        .booking-container {
            background: linear-gradient(to bottom right, #fef9e7, #fdebd0);
            min-height: 100vh;
            padding: 20px 0;
        }
        .booking-header {
            background: url('https://images.unsplash.com/photo-1540420773420-3366772f4999?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80') no-repeat center center;
            background-size: cover;
            padding: 80px 0;
            text-align: center;
            color: white;
            position: relative;
            margin-bottom: 30px;
        }
        .booking-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(139, 69, 19, 0.7);
        }
        .booking-header-content {
            position: relative;
            z-index: 1;
        }
        .booking-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(206, 139, 15, 0.1);
            transition: transform 0.3s;
            margin-bottom: 25px;
            background: white;
        }
        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .booking-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }
        .status-pending {
            background-color: #ffeaa7;
            color: #d35400;
        }
        .status-completed {
            background-color: #abebc6;
            color: #1d8348;
        }
        .status-packed {
            background-color: #aed6f1;
            color: #2874a6;
        }
        .status-shipped {
            background-color: #d7bde2;
            color: #6c3483;
        }
        .dryfruit-bg {
            background-color: #fef5e7;
            border-left: 5px solid #d35400;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #f1c40f;
        }
        .nut-icon {
            width: 25px;
            height: 25px;
            margin-right: 10px;
        }
        .empty-booking {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .review-btn {
            background: linear-gradient(to right, #e67e22, #d35400);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            transition: all 0.3s;
        }
        .review-btn:hover {
            background: linear-gradient(to right, #d35400, #ba4a00);
            transform: scale(1.05);
        }
        .animation-container {
            text-align: center;
            margin: 30px 0;
        }
        .dryfruit-animation {
            max-width: 200px;
            margin: 0 auto;
        }

        /* Progress Bar Styles */
        .progress-container {
            margin: 20px 0 10px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }
        
        .progress-bar-wrapper {
            position: relative;
            margin: 20px 0;
        }
        
        .progress-track {
            height: 6px;
            background-color: #e9ecef;
            border-radius: 10px;
            position: relative;
            margin: 20px 0;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #28a745, #20c997, #17a2b8, #6f42c1);
            border-radius: 10px;
            transition: width 0.8s ease;
            position: relative;
        }
        
        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-top: -15px;
        }
        
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
            text-align: center;
        }
        
        .step-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #e9ecef;
            border: 3px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            color: #6c757d;
            transition: all 0.3s ease;
            z-index: 2;
            position: relative;
        }
        
        .step-circle.active {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.3);
        }
        
        .step-circle.completed {
            background-color: #20c997;
            border-color: #20c997;
            color: white;
        }
        
        .step-label {
            margin-top: 12px;
            font-size: 12px;
            font-weight: 600;
            color: #6c757d;
            max-width: 85px;
            line-height: 1.3;
        }
        
        .step-label.active {
            color: #28a745;
            font-weight: 700;
        }
        
        .step-label.completed {
            color: #20c997;
            font-weight: 700;
        }
        
        .step-icon {
            font-size: 16px;
        }
        
        /* Progress bar animation */
        @keyframes progressFill {
            from {
                width: 0%;
            }
            to {
                width: var(--progress-width);
            }
        }
        
        .progress-fill.animate {
            animation: progressFill 1.5s ease-out;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .step-label {
                font-size: 10px;
                max-width: 65px;
            }
            .step-circle {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }
            .progress-container {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .step-label {
                font-size: 9px;
                max-width: 50px;
            }
            .step-circle {
                width: 25px;
                height: 25px;
                font-size: 10px;
            }
            .step-icon {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Header Start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Best Quality Dry Fruits</small></a>
                </div>
                
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">BERRY DELIGHT</h1></a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="../index.php" class="nav-item nav-link active">Home</a>
                        <a href="MyProfile.php" class="nav-item nav-link">My Profile</a>
                        <a href="ViewShop.php" class="nav-item nav-link">View Shop</a>
                        <a href="Complaint.php" class="nav-item nav-link">Complaints</a>
                        <a href="LogOut.php" class="nav-item nav-link">Logout</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Header End -->
    
    <div style="padding:100px"></div> <!-- Spacer for fixed header -->

    <!-- Booking Header Section -->
         <!-- Booking Header Section -->
    <!-- <div class="booking-header">
         <!-- <div class="container booking-header-content">  -->
            <h1><center>Your Dry Fruit Orders</center></h1>
            <!-- <p class="lead mb-0">Track your delicious orders and their journey to your doorstep</p> -->
        </div>

    </div>

    <!-- Booking Container -->
    <div class="booking-container">
        <div class="container py-5">
            <!-- Animation Section -->
            <div class="animation-container">
                <!-- <img src="https://media.giphy.com/media/XcNMztI1o9Vf1ZlaLg/giphy.gif" alt="Dry Fruits Animation" class="dryfruit-animation"> -->
            </div>

            <?php
            $i = 0;
            $selqry = "SELECT * FROM tbl_booking b 
                     INNER JOIN tbl_user u ON b.user_id = u.user_id 
                     WHERE booking_status > 0 AND b.user_id = '" . $_SESSION['uid'] . "'";
            $row = $Con->query($selqry);
            
            if ($row->num_rows > 0) {
                while ($data = $row->fetch_assoc()) {
                    $i++;
                    
                    // Get cart status for progress bar (unchanged PHP logic)
                    $progress_cart = "SELECT cart_status FROM tbl_cart WHERE booking_id = " . $data["booking_id"] . " LIMIT 1";
                    $progress_result = $Con->query($progress_cart);
                    $progress_data = $progress_result->fetch_assoc();
                    $cart_status_for_progress = $progress_data['cart_status'];
                    
                    // Calculate progress percentage and current step
                    $progressPercentage = 0;
                    $currentStep = 0;
                    if ($data['booking_status'] == 2) {
                        if ($cart_status_for_progress == 1) {
                            $progressPercentage = 25;
                            $currentStep = 1;
                        } else if ($cart_status_for_progress == 2) {
                            $progressPercentage = 50;
                            $currentStep = 2;
                        } else if ($cart_status_for_progress == 3) {
                            $progressPercentage = 75;
                            $currentStep = 3;
                        } else if ($cart_status_for_progress == 4) {
                            $progressPercentage = 100;
                            $currentStep = 4;
                        }
                    }
            ?>
            <div class="booking-card">
                <div class="card-header dryfruit-bg py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">
                                <img src="https://cdn-icons-png.flaticon.com/512/992/992700.png" class="nut-icon" alt="Order Icon">
                                Order #<?php echo $data['booking_id']; ?>
                            </h5>
                            <p class="mb-0 text-muted">Placed on: <?php echo $data['booking_date']; ?></p>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0 text-success">₹<?php echo $data['booking_amount']; ?></h4>
                        </div>
                    </div>
                    
                    <!-- Progress Bar Section - Only show for booking_status = 2 -->
                    <?php if ($data['booking_status'] == 2) { ?>
                    <div class="progress-container">
                        <div class="progress-bar-wrapper">
                            <div class="progress-track">
                                <div class="progress-fill animate" style="--progress-width: <?php echo $progressPercentage; ?>%; width: <?php echo $progressPercentage; ?>%"></div>
                            </div>
                            <div class="progress-steps">
                                <!-- Step 1: Payment Completed -->
                                <div class="progress-step">
                                    <div class="step-circle <?php echo $currentStep >= 1 ? ($currentStep > 1 ? 'completed' : 'active') : ''; ?>">
                                        <i class="fas fa-credit-card step-icon"></i>
                                    </div>
                                    <div class="step-label <?php echo $currentStep >= 1 ? ($currentStep > 1 ? 'completed' : 'active') : ''; ?>">
                                        Payment Completed
                                    </div>
                                </div>
                                
                                <!-- Step 2: Product Packed -->
                                <div class="progress-step">
                                    <div class="step-circle <?php echo $currentStep >= 2 ? ($currentStep > 2 ? 'completed' : 'active') : ''; ?>">
                                        <i class="fas fa-box step-icon"></i>
                                    </div>
                                    <div class="step-label <?php echo $currentStep >= 2 ? ($currentStep > 2 ? 'completed' : 'active') : ''; ?>">
                                        Product Packed
                                    </div>
                                </div>
                                
                                <!-- Step 3: Product Shipped -->
                                <div class="progress-step">
                                    <div class="step-circle <?php echo $currentStep >= 3 ? ($currentStep > 3 ? 'completed' : 'active') : ''; ?>">
                                        <i class="fas fa-shipping-fast step-icon"></i>
                                    </div>
                                    <div class="step-label <?php echo $currentStep >= 3 ? ($currentStep > 3 ? 'completed' : 'active') : ''; ?>">
                                        Product Shipped
                                    </div>
                                </div>
                                
                                <!-- Step 4: Product Delivered -->
                                <div class="progress-step">
                                    <div class="step-circle <?php echo $currentStep >= 4 ? 'completed' : ''; ?>">
                                        <i class="fas fa-home step-icon"></i>
                                    </div>
                                    <div class="step-label <?php echo $currentStep >= 4 ? 'completed' : ''; ?>">
                                        Product Delivered
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = 0;
                                $cart = "SELECT * FROM tbl_cart c 
                                       INNER JOIN tbl_product p ON c.product_id = p.product_id 
                                       WHERE c.booking_id = " . $data["booking_id"];
                                $roW = $Con->query($cart);
                                
                                while ($data1 = $roW->fetch_assoc()) {
                                    $j++;
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../Assets/Files/SellerDocs/<?php echo $data1['product_photo']; ?>" class="product-img me-3" alt="<?php echo $data1['product_name']; ?>">
                                            <div><?php echo $data1['product_name']; ?></div>
                                        </div>
                                    </td>
                                    <td>₹<?php echo number_format($data1['product_price'], 2); ?></td>
                                    <td><?php echo $data1['cart_qty']; ?></td>
                                    <td>₹<?php echo number_format($data1['cart_qty'] * $data1['product_price'], 2); ?></td>
                                    <td>
                                        <?php 
                                        if ($data["booking_status"] == 1 && $data1["cart_status"] == 1) {
                                            echo "<span class='booking-status status-pending'>Payment Pending</span>";
                                            ?>
                                            <a href="Payment.php?bid=<?php echo $data['booking_id']?>" class='btn btn-outline-primary action-btn'>Make Payment</a>
                                            <?php
                                        } 
                                        else if ($data["booking_status"] == 2 && $data1["cart_status"] == 1) {
                                            echo "<span class='booking-status status-completed'>Payment Completed</span>";
                                            ?>
                                            <a href="DownloadBill.php?bid=<?php echo $data['booking_id']?>" class='btn btn-outline-primary action-btn'>View More</a>
                                            <?php
                                        } 
                                        else if ($data["booking_status"] == 2 && $data1["cart_status"] == 2) {
                                            echo "<span class='booking-status status-packed'>Product Packed</span>";
                                        } 
                                        else if ($data["booking_status"] == 2 && $data1["cart_status"] == 3) {
                                            echo "<span class='booking-status status-shipped'>Product Shipped</span>";
                                        } 
                                        else if ($data["booking_status"] == 2 && $data1["cart_status"] == 4) {
                                            echo "<span class='booking-status status-completed'>Order Completed</span>";
                                        } 
                                        else {
                                            echo "<span class='booking-status'>Unknown Status</span>";
                                        }
                                        ?>
                                    </td>
                                    <?php 
                                    // Show Rate & Review button only if order is completed
                                    if ($data["booking_status"] == 2 && $data1["cart_status"] == 4) {
                                    ?>
                                    <td>
                                        <a href='Review.php?pid=<?php echo $data1['product_id']; ?>' class='btn btn-outline-primary action-btn'>
                                            <i class="fas fa-star me-2"></i>Rate & Review Products
                                        </a>
                                    </td>
                                    <?php 
                                    } else {
                                    ?>
                                    <td></td>
                                    <?php 
                                    }
                                    ?>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
            ?>
            <div class="empty-booking">
                <img src="https://cdn-icons-png.flaticon.com/512/4555/4555971.png" alt="No Orders" class="mb-4" style="width: 120px;">
                <h3 class="mb-3">You haven't placed any orders yet</h3>
                <p class="text-muted mb-4">Explore our delicious collection of dry fruits and make your first order!</p>
                <a href="Product.php" class="btn btn-primary py-2 px-4">Browse Products</a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Berry Delight</h1>
                            <p class="text-secondary mb-0">Dry fruits</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">Berry Delight brings you varities of dry fruits from India and across the world.</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Quick Links</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Shopping</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account Info</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Privacy policy</a>
                        <a class="btn-link" href="">Return policy</a>
                        <a class="btn-link" href="">Terms & Conditions </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: SN Towers, Rajiv Gandhi Road,Trivandrum</p>
                        <p>Email: berrydelight@gmail.com</p>
                        <p>Phone: +91 9844568910</p>
                        <p>Payment Accepted</p>
                        <img src="../Assets/Templates/Main/img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Berry Delight</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/Templates/Main/lib/easing/easing.min.js"></script>
    <script src="../Assets/Templates/Main/lib/waypoints/waypoints.min.js"></script>
    <script src="../Assets/Templates/Main/lib/lightbox/js/lightbox.min.js"></script>
    <script src="../Assets/Templates/Main/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Assets/Templates/Main/js/main.js"></script>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Select all quantity cells in the 3rd column of tables
    document.querySelectorAll("table tbody tr td:nth-child(3)").forEach(function(td) {
        let qty = parseFloat(td.textContent.trim());
        if (!isNaN(qty)) {
            td.textContent = (qty * 100) + " g";
        }
    });
});
</script>

</html>