<?php
include("../Assets/Connection/Connection.php"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dry Fruit Delight - View Shops</title>
    
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
        body {
            background-image: url('https://images.unsplash.com/photo-1601001814391-2e5028b81127?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            padding-top: 130px; /* Account for fixed header */
        }
        .gif-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0.7;
        }
        .content-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 10px;
            margin-bottom: 30px;
            margin-left: 0;
            width: 1200px !important;   /* wider fixed size */
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }
        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-card p {
            padding: 15px;
            text-align: center;
            margin: 0;
            font-weight: 500;
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }
        h2 {
            color: #28a745;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .btn-view {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .btn-view:hover {
            background-color: #218838;
            color: white;
            text-decoration: none;
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
    <div class="container-fluid fixed-top style="top: -55px>
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
                        <a href="MyProfile.php" class="nav-item nav-link active">My Profile</a>
                          <!-- <a href="../Guest/Login.php" class="dropdown-item">Logout</a> -->
                        <a href="LogOut.php" class="nav-item nav-link">Logout</a>

                         <!-- <a href="ViewBooking.php" class="nav-item nav-link">View Booking</a> -->
                    </div>
                    <div class="d-flex m-3 me-0">
                        <!-- <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <a href="#" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                        </a> -->
                        <!-- <a href="#" class="my-auto">
                            <i class="fas fa-user fa-2x"></i> -->
                        <!-- </a> -->
                    </div> 
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
      <div class="container">
 <div class="container">
    <div class="container">
        <div class="content-container">
            <h2>Find Your Local Dry Fruit Seller</h2>
            <form id="form1" name="form1" method="post" action="">
                <div class="row">
                    <div class="col-md-6">
                        <label for="Sel_district">District</label>
                        <select name="Sel_district" id="Sel_district" onchange="AjaxPlace(this.value),AjaxSeller()">
                            <option value="">..select..</option>
                            <?php 
                            $seldistrict="select * from tbl_district";
                            $resd=$Con->query($seldistrict);
                            while($data=$resd->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $data["district_id"]?>">
                                <?php echo $data["district_name"]?>
                            </option>
                            <?php
                            }
                            ?> 
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="sel_place">Place</label>
                        <select name="sel_place" id="sel_place" onchange="AjaxSeller()">
                            <option value="">..select..</option>
                            <?php
                            $selplace="select * from tbl_place";
                            $resp=$Con->query($selplace);
                            while($data=$resp->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $data["place_id"];?>">
                                <?php echo $data["place_name"]; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <h3>Our Sellers</h3>
                    <div class="table-container">
                        <table id="seller">
                            <thead>
                                <tr>
                                    <th>SNo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>District</th>
                                    <th>Place</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
                                $selqry="select * from tbl_seller s 
                                inner join tbl_place p on s.place_id=p.place_id 
                                inner join tbl_district d on p.district_id=d.district_id where seller_status=1";
                                $result=$Con->query($selqry);
                                while($data=$result->fetch_assoc())
                                {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data["seller_name"];?></td>
                                    <td><?php echo $data["seller_email"];?></td>
                                    <td><?php echo $data["seller_contact"];?></td>
                                    <td><?php echo $data["seller_address"];?></td>
                                    <td><?php echo $data["district_name"];?></td>
                                    <td><?php echo $data["place_name"];?></td>
                                    <td>
                                        <img src="../Assets/Files/SellerDocs/<?php echo $data["seller_photo"];?>" alt="Seller Photo" width="100" height="80">
                                    </td>
                                    <td>
                                        <a href="ViewProduct.php?sid=<?php echo $data["seller_id"]; ?>" class="btn-view">View Product</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <div class="content-container">
            <h2>Explore Our Dry Fruits</h2>
            <div class="product-grid">
                <div class="product-card">
                    <img src="../Assets/Templates/Main/img/freshalmond.jpg" alt="Premium Almonds">
                    <p>Premium Almonds</p>
                </div>
                <div class="product-card">
                    <img src="../Assets/Templates/Main/img/cashew.webp" alt="Crunchy Cashews">
                    <p>Crunchy Cashews</p>
                </div>
                <div class="product-card">
                    <img src="../Assets/Templates/Main/img/mix-dry-fruits.avif" alt="Dried Fruits Mix">
                    <p>Dried Fruits Mix</p>
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

    <script src="../Assets/JQ/jQuery.js"></script> 
    <script>
        function AjaxPlace(did) 
        {
            $.ajax({
                url:"../Assets/AjaxPages/AjaxPlace.php?did="+did,
                success: function(html){
                    $("#sel_place").html(html);
                }
            });
        }
        function AjaxSeller() 
        {
            var did=document.getElementById("Sel_district").value;
            var pid=document.getElementById("sel_place").value;
            $.ajax({
                url:"../Assets/AjaxPages/AjaxSeller.php?did="+did+"&pid="+pid,
                success: function(html){
                    $("#seller").html(html)
                }
            });
        }
    </script>
</body>
</html>