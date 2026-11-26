<?php
include("../Assets/Connection/Connection.php");
session_start();
$SelQry="select * from tbl_user u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where user_id='".$_SESSION["uid"]."'";
$res=$Con->query($SelQry);
$data=$res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Berry Delight</title>
    <style>
        .brown-text {
            color: #964e1aff;
        }
        .btn-brown {
            background-color: #8B4513;
            border-color: #8B4513;
            color: white;
        }
        .btn-brown:hover {
            background-color: #A0522D;
            border-color: #A0522D;
            color: white;
        }
        .btn-outline-brown {
            border-color: #8B4513;
            color: #8B4513;
        }
        .btn-outline-brown:hover {
            background-color: #8B4513;
            color: white;
        }
        .card-header-brown {
            background-color: #F5DEB3;
            border-color: #D2B48C;
        }
    </style>
</head>
<body>
    
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Berry Delight-Online dry fruits store</title>
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
                            <a href="ViewShop.php" class="nav-item nav-link">View Shop</a>
                             <a href="MyBooking.php" class="nav-item nav-link">My Booking</a>
                                  <a href="LogOut.php" class="nav-item nav-link">Logout</a>
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
        <!-- Navbar End -->
         <div style="padding:100px">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header card-header-brown">
                         <h4 class="mb-0 brown-text">My Profile</h4> 
            
                    </div>
                    <div class="card-body">
                        <!-- <div class="row"> -->
                             <!-- Profile Photo Column --> 
                            <!-- <div class="col-md-4 text-center">
                                 <img src="../Assets/Files/UserDocs/440px-Ngc6397_hst_blue_straggler.jpg" 
                                     class="img-thumbnail mb-3" 
                                     style="width: 200px; height: 200px; object-fit: cover; border-color: #D2B48C;" 
                                     alt="Profile Photo"> -->
                            <!-- </div> -->
                             
                            <!-- Profile Details Column -->
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                         <tr>
      <img width="300" height="200" src="../Assets/Files/UserDocs/<?php echo $data["user_photo"];?>" /></td>
    </tr
                                            <tr>
                                                <th width="30%" class="brown-text">Name</th>
                                                <td><?php echo $data["user_name"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="brown-text">Email</th>
                                                <td><?php echo $data["user_email"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="brown-text">Contact</th>
                                                <td><?php echo $data["user_contact"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="brown-text">Address</th>
                                                <td><?php echo $data["user_address"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="brown-text">District</th>
                                                <td><?php echo $data["district_name"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="brown-text">Place</th>
                                                <td><?php echo $data["place_name"]; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Action Buttons - Now with consistent brown colors -->
                                <div class="d-flex justify-content-center gap-3 mt-4">
                                    <a href="EditProfile.php" class="btn btn-brown">Edit Profile</a>
                                    <a href="ChangePassword.php" class="btn btn-outline-brown">Change Password</a>
                                    <a href="Complaint.php" class="btn btn-outline-brown">My Complaints</a>
                                </div>
                                
                                <!-- Dry Fruits GIF -->
                                <div class="text-center mt-4">
                                    <!-- <img src="https://media.giphy.com/media/3o7TKMt1VNMZqQa5MA/giphy.gif" 
                                         class="img-fluid" 
                                         style="max-height: 80px;" 
                                         alt="Dry Fruits">
                                    <p class="text-muted mt-2">Thank you for being a Berry Delight customer!</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
</div>
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

</html></body>
</html>