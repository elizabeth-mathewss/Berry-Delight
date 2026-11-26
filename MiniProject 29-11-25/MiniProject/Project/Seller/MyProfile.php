<?php
include("../Assets/Connection/Connection.php");

session_start();
$SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id = p.place_id inner join tbl_district d on d.district_id=p.district_id where seller_id='".$_SESSION["sid"]."'";
$result=$Con->query($SelQry);
$data=$result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>My Profile - Berry Delight</title>
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
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Open Sans', sans-serif;
            }
            
            .profile-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }
            
            .profile-header {
                text-align: center;
                padding: 30px 0;
                background: linear-gradient(to right, #ffffffff, #f7f7f7ff);
                color: white;
                border-radius: 10px;
                margin-bottom: 30px;
                /* box-shadow: 0 5px 15px rgba(0,0,0,0.1); */
            }
            
            .profile-header h1 {
                font-size: 2.5rem;
                margin-bottom: 10px;
            }
            
            .profile-content {
                display: flex;
                flex-wrap: wrap;
                gap: 30px;
                margin-bottom: 40px;
            }
            
            .profile-info {
                flex: 1;
                min-width: 300px;
                background: white;
                padding: 25px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }
            
            .profile-image {
                text-align: center;
                margin-bottom: 20px;
            }
            
            .profile-image img {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
                border: 5px solid #e2af18;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            
            .info-item {
                display: flex;
                margin-bottom: 15px;
                border-bottom: 1px dashed #e2d0b6;
                padding-bottom: 10px;
            }
            
            .info-label {
                font-weight: 600;
                min-width: 120px;
                color: #8a5a2d;
            }
            
            .info-value {
                color: #5a3921;
            }
            
            .action-buttons {
                display: flex;
                justify-content: center;
                gap: 15px;
                margin-top: 20px;
            }
            
            .btn {
                padding: 12px 25px;
                border-radius: 30px;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }
            
            .btn-primary {
                background: #e2af18;
                color: white;
            }
            
            .btn-primary:hover {
                background: #c5970e;
                transform: translateY(-2px);
            }
            
            .btn-secondary {
                background: #8a5d10;
                color: white;
            }
            
            .btn-secondary:hover {
                background: #6d4a0d;
                transform: translateY(-2px);
            }
            
            .media-section {
                flex: 1;
                min-width: 300px;
            }
            
            .media-card {
                background: white;
                padding: 25px;
                border-radius: 10px;
                margin-bottom: 30px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }
            
            .media-card h2 {
                color: #8a5a2d;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 2px solid #e2d0b6;
            }
            
            .gif-container {
                text-align: center;
                margin: 20px 0;
            }
            
            .product-showcase {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
                gap: 15px;
                margin: 20px 0;
            }
            
            .product-item {
                text-align: center;
                width: 120px;
            }
            
            .product-item img {
                width: 80px;
                height: 80px;
                object-fit: cover;
                border-radius: 50%;
                border: 2px solid #e2af18;
            }
            
            .product-item p {
                margin-top: 8px;
                font-size: 0.9rem;
                font-weight: 500;
            }
            
            .video-container {
                margin: 20px 0;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            
            .video-container video {
                width: 100%;
                display: block;
            }
            
            .stats-container {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
                gap: 15px;
                margin: 30px 0;
            }
            
            .stat-item {
                text-align: center;
                padding: 15px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                flex: 1;
                min-width: 150px;
            }
            
            .stat-value {
                font-size: 2rem;
                font-weight: 700;
                color: #e2af18;
                margin-bottom: 5px;
            }
            
            .stat-label {
                color: #8a5a2d;
                font-weight: 500;
            }
            
            @media (max-width: 768px) {
                .profile-content {
                    flex-direction: column;
                }
                
                .action-buttons {
                    flex-direction: column;
                    align-items: center;
                }
                
                .btn {
                    width: 100%;
                    justify-content: center;
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


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Best Quality Dry Fruits</small></a>
                        <!-- <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white"></a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white"></small> -->
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
                            <a href="MyProfile.php" class="nav-item nav-link active">My Profile</a>
                            <a href="Product.php" class="nav-item nav-link">Product</a>
                             <a href="ViewBooking.php" class="nav-item nav-link">View Booking</a>
                             <a href="../Guest/Login.php" class="nav-item nav-link">Logout</a>
                            <!-- <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a> -->
                            <div class="nav-item dropdown">
                                <!-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sign up</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="Guest/SellerRegistration.php" class="dropdown-item">Seller Registration</a>
                                    <a href="Guest/UserRegistration.php" class="dropdown-item">User Registration</a> -->
                                    <!-- <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                    <a href="404.html" class="dropdown-item">404 Page</a> -->
                                </div>
                            </div>
                            <!-- <a href="contact.html" class="nav-item nav-link">Contact</a> -->
                        </div>
                        <!-- <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="#" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                            </a>
                            <a href="#" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a> -->
                        </div>
                    </div>
                </nav>
            </div>
        </div>
         <div class="profile-container">
           <div class="profile-container">
        <!-- Navbar End -->
        
        <div style="padding:100px">
        
        <div class="profile-container">
            <?php
            include("../Assets/Connection/Connection.php");
            // session_start();
            $SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id = p.place_id inner join tbl_district d on d.district_id=p.district_id where seller_id='".$_SESSION["sid"]."'";
            $result=$Con->query($SelQry);
            $data=$result->fetch_assoc();
            ?>
            
            <!-- <div class="profile-header"> -->
                <!-- <h1><center>Seller Profile</center></h1> -->
                <!-- <p><center>Premium Dry Fruits Supplier</center></p> --
           </div> -->
            
            <div class="profile-content">
                <div class="profile-info">
                     <h1><center>Seller Profile</center></h1>
                    <div class="profile-image">
                        <img src="../Assets/Files/SellerDocs/<?php echo $data["seller_photo"];?>" alt="Profile Photo" />
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Name:</span>
                        <span class="info-value"><?php echo $data["seller_name"]; ?></span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value"><?php echo $data["seller_email"]; ?></span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Contact:</span>
                        <span class="info-value"><?php echo $data["seller_contact"]; ?></span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Address:</span>
                        <span class="info-value"><?php echo $data["seller_address"]; ?></span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">District:</span>
                        <span class="info-value"><?php echo $data["district_name"]; ?></span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Place:</span>
                        <span class="info-value"><?php echo $data["place_name"]; ?></span>
                    </div>
                    
                    <!-- <div class="stats-container"> -->
                        <!-- <div class="stat-item"> -->
                            <!-- <div class="stat-value">4.8</div>
                            <div class="stat-label">Seller Rating</div> -->
                        </div>
                        <!-- <div class="stat-item"> -->
                            <!-- <div class="stat-value">128</div>
                            <div class="stat-label">Products</div> -->
                        </div>
                        <!-- <div class="stat-item"> -->
                            <!-- <div class="stat-value">562</div>
                            <div class="stat-label">Customers</div> -->
                        </div>
                    <!-- </div> -->
                    
                    <div class="action-buttons">
                        <a href="EditProfile.php" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                        <a href="ChangePassword.php" class="btn btn-secondary">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                    </div>
                </div>
                
                <div class="media-section">
                    <!-- <div class="media-card"> -->
                        <!-- <h2><i class="fas fa-gift"></i> Our Premium Dry Fruits</h2> -->
                        <div class="product-showcase">
                            <!-- <div class="product-item">
                                <img src="https://cdn.pixabay.com/photo/2016/03/23/12/53/almonds-1274780_960_720.jpg" alt="Almonds">
                                <p>Almonds</p>
                            </div>
                            <div class="product-item">
                                <img src="https://cdn.pixabay.com/photo/2018/04/13/17/14/walnut-3316849_960_720.jpg" alt="Walnuts">
                                <p>Walnuts</p>
                            </div>
                            <div class="product-item">
                                <img src="https://cdn.pixabay.com/photo/2021/01/07/06/43/pistachio-5896308_960_720.jpg" alt="Pistachios">
                                <p>Pistachios</p>
                            </div>
                            <div class="product-item">
                                <img src="https://cdn.pixabay.com/photo/2016/03/05/22/18/dried-1239350_960_720.jpg" alt="Dates">
                                <p>Dates</p>
                            </div> -->
                        </div>
                        
                        <!-- <div class="gif-container">
                            <img src="https://media.tenor.com/8V9lFdWnqwoAAAAj/dry-fruits-almods.gif" alt="Dry Fruits GIF" height="100">
                        </div>
                    </div> -->
                    
                    <!-- <div class="media-card">
                        <h2><i class="fas fa-play-circle"></i> Benefits of Dry Fruits</h2>
                        <div class="video-container">
                            <video width="100%" controls poster="https://images.unsplash.com/photo-1602526430788-2a14c3ba08d9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80">
                                <source src="https://player.vimeo.com/external/370331193.sd.mp4?s=87e184678a2d39f3930dc30ebd4154e3d097e1a7&profile_id=139&oauth2_token_id=57447761" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <p>Discover the health benefits of incorporating dry fruits into your daily diet.</p>
                    </div> -->
                    
                    <div class="media-card">
                        <h2><i class="fas fa-award"></i> Why Choose Us?</h2>
                        <ul style="list-style-type: none;">
                            <li style="margin-bottom: 10px;"><i class="fas fa-check-circle" style="color: #e2af18;"></i> 100% Natural & Organic Products</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-check-circle" style="color: #e2af18;"></i> Direct from Farms to Your Home</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-check-circle" style="color: #e2af18;"></i> Premium Quality Assurance</li>
                            <li style="margin-bottom: 10px;"><i class="fas fa-check-circle" style="color: #e2af18;"></i> Fast Delivery & Fresh Packaging</li>
                        </ul>
                        
                        <div class="gif-container">
                            <!-- <img src="https://media.tenor.com/2CttlLulUQUAAAAj/natural-food.gif" alt="Natural Food GIF" height="80"> -->
                        </div>
                    </div>
                </div>
            </div>
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
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
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

</html>