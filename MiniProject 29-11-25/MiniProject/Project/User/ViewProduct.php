<?php
include("../Assets/Connection/Connection.php");
session_start();

// Get the maximum price from the database to set the slider's range
$maxPriceQry = "SELECT MAX(productqty_price) as max_price FROM tbl_productqty";
$maxPriceRes = $Con->query($maxPriceQry);
$maxPriceData = $maxPriceRes->fetch_assoc();
$maxPrice = $maxPriceData['max_price'] ?: 100000; // Default if no products
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search - Berry Delight</title>
    
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
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Universal Settings & Body */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        * {
            box-sizing: border-box;
        }

        /* Main Page Layout */
        .search-page-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 130px; /* Account for fixed header */
        }

        /* ===== Filter Panel (Left Side) ===== */
        .product-filters {
            flex: 1;
            min-width: 250px;
            max-width: 300px;
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            align-self: flex-start;
            border: 1px solid #e7e7e7;
        }

        .filter-header {
            font-size: 1.5em;
            margin-top: 0;
            margin-bottom: 25px;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            color: #1a5e9a;
        }
        .filter-header .fa-filter {
            margin-right: 10px;
        }

        .filter-group {
            margin-bottom: 25px;
        }

        .filter-title {
            font-size: 1.1em;
            margin-bottom: 12px;
            color: #555;
        }

        .filter-search-input, .filter-sort-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .filter-search-input:focus, .filter-sort-select:focus {
            outline: none;
            border-color: #1a5e9a;
            box-shadow: 0 0 0 3px rgba(26, 94, 154, 0.15);
        }

        .filter-options-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #e0e0e0;
            padding: 10px;
            border-radius: 8px;
        }

        .filter-checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .filter-checkbox-item label {
            cursor: pointer;
            flex-grow: 1;
            margin-left: 8px;
        }

        .filter-placeholder {
            color: #888;
            font-style: italic;
            font-size: 0.9em;
        }

        .filter-price-slider {
            width: 100%;
            cursor: pointer;
        }

        .price-slider-label {
            text-align: center;
            margin-top: 8px;
            font-weight: 500;
        }
        #price_range_value {
            font-weight: bold;
            color: #1a5e9a;
        }

        /* ===== Product Grid (Right Side) ===== */
        .product-grid-container {
            flex: 3;
            min-width: 300px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 25px;
        }

        /* Product Card Template */
        .product-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.07);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #e7e7e7;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .product-card-link {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-card-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }
        .product-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .product-card:hover .product-card-image img {
            transform: scale(1.05);
        }

        .product-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-card-title {
            font-size: 1.1em;
            font-weight: 600;
            margin: 0 0 10px 0;
            line-height: 1.3;
        }

        .product-card-rating {
            color: #f90;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .product-card-rating .review-count {
            color: #666;
            margin-left: 5px;
        }

        .product-card-price {
            font-size: 1.25em;
            font-weight: bold;
            color: #1a5e9a;
            margin-top: auto; /* Pushes price down */
            padding-top: 10px;
        }

        .product-card-footer {
            padding: 0 15px 15px 15px;
        }

        .product-card-button, .product-card-button-disabled {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 12px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500;
            text-align: center;
            width: 100%;
            transition: background-color 0.2s ease;
        }
        .product-card-button:hover {
            background-color: #218838;
        }
        .product-card-button-disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
        .product-card-button .fa-shopping-cart, .product-card-button-disabled .fa-ban {
            margin-right: 8px;
        }

        /* Utility Classes */
        .loading-spinner {
            grid-column: 1 / -1;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #1a5e9a;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 50px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .error-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px;
            font-size: 1.2em;
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
                        <a href="MyCart.php" class="nav-item nav-link">My Cart</a>
                        <a href="LogOut.php" class="nav-item nav-link">Logout</a>
                    
                    </div>
                    <!-- <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <a href="#" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                        </a>
                        <a href="#" class="my-auto">
                            <i class="fas fa-user fa-2x"></i> -->
                        <!-- </a> -->
                    </div>
                </div>
            </nav>
        </div>
    </div>
      <div class="top-link pe-2">
          <div class="top-link pe-2">
              <div class="top-link pe-2">
                 <div class="row">
    <div class="container py-5">
    <!-- Navbar End -->

    <div class="search-page-container" onload="ajaxSearch()">
        
        <!-- ======================= FILTER PANEL (LEFT) ======================= -->
        <aside class="product-filters">
            <h2 class="filter-header"><i class="fas fa-filter"></i> Filters</h2>
            <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $_GET['sid']?>">
            <div class="filter-group">
                <input type="text" name="txt_search" id="txt_search" class="filter-search-input" 
                       placeholder="Search by Product Name..." onkeyup="ajaxSearch()">
            </div>

            <div class="filter-group">
                <h3 class="filter-title">Category</h3>
                <div class="filter-options-list" id="category-filter-list">
                    <?php
                    $catQry = "SELECT * FROM tbl_category ORDER BY category_name";
                    $catRes = $Con->query($catQry);
                    while ($catData = $catRes->fetch_assoc()) {
                        echo "<div class='filter-checkbox-item'>";
                        echo "<input type='checkbox' class='filter-checkbox' onchange='getSubcategories(); ajaxSearch();' name='category[]' id='cat_" . $catData['category_id'] . "' value='" . $catData['category_id'] . "'>";
                        echo "<label for='cat_" . $catData['category_id'] . "'>" . htmlspecialchars($catData['category_name']) . "</label>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>

            <div class="filter-group">
                <h3 class="filter-title">Subcategory</h3>
                <div class="filter-options-list" id="subcategory-filter-list">
                    <p class="filter-placeholder">Select a category first</p>
                </div>
            </div>

            <div class="filter-group">
                <h3 class="filter-title">Price Range</h3>
                <input type="range" name="price_range" id="price_range" class="filter-price-slider" 
                       min="0" max="<?php echo $maxPrice; ?>" step="50" value="<?php echo $maxPrice; ?>"
                       oninput="updatePriceValue(this.value)" onchange="ajaxSearch()">
                <div class="price-slider-label">
                    Up to: <span id="price_range_value"><?php echo number_format($maxPrice); ?></span> ₹
                </div>
            </div>

            <div class="filter-group">
                <h3 class="filter-title">Sort By</h3>
                <select name="sel_sort" id="sel_sort" class="filter-sort-select" onchange="ajaxSearch()">
                    <option value="price_desc">Price (High to Low)</option>
                    <option value="most_sold">Most Popular</option>
                    <option value="az">Name (A-Z)</option>
                    <option value="za">Name (Z-A)</option>
                    <option value="price_asc">Price (Low to High)</option>
                </select>
            </div>
        </aside>

        <!-- ======================= PRODUCT GRID (RIGHT) ======================= -->
        <main class="product-grid-container">
            <div id="product-list" class="product-grid">
                <!-- Product cards are loaded here by AJAX -->
            </div>
        </main>
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

    <script>
        function addToCart(pid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxAddCart.php?pid=" + pid,
                success: function(response) {
                    alert(response); // Or use a more modern notification
                }
            });
        }

        function updatePriceValue(value) {
            document.getElementById('price_range_value').innerText = Number(value).toLocaleString();
        }

        function getSubcategories() {
            var selectedCategories = [];
            $('.filter-checkbox:checked').each(function() {
                selectedCategories.push($(this).val());
            });

            $.ajax({
                url: "../Assets/AjaxPages/AjaxSubcategoryN.php",
                method: "GET",
                data: { category_ids: selectedCategories },
                success: function(html) {
                    $("#subcategory-filter-list").html(html || '<p class="filter-placeholder">No subcategories found.</p>');
                }
            });
        }

        function ajaxSearch() {
            var search = $("#txt_search").val();
            var price = $("#price_range").val();
            var sort = $("#sel_sort").val();
            var sid = $("#txt_id").val();

            var categories = [];
            $('#category-filter-list .filter-checkbox:checked').each(function() {
                categories.push($(this).val());
            });

            var subcategories = [];
            $('#subcategory-filter-list .filter-checkbox:checked').each(function() {
                subcategories.push($(this).val());
            });

            // Show a loading spinner while fetching data
            $("#product-list").html('<div class="loading-spinner"></div>');

            $.ajax({
                url: "../Assets/AjaxPages/AjaxSearchProductN.php",
                method: "GET",
                data: {
                    search: search,
                    categories: categories,
                    subcategories: subcategories,
                    price: price,
                    sort: sort,
                    sid:sid
                },
                success: function(response) {
                    $("#product-list").html(response);
                }
            });
        }
        
        // Initial load of products
        $(document).ready(function() {
            ajaxSearch();
        });
    </script>

</body>
</html>