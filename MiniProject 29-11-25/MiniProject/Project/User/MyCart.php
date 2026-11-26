<?php
session_start();
include("../Assets/Connection/Connection.php");

// Process checkout if form submitted
if (isset($_POST["btn_checkout"])) {
    $amt = $_POST["carttotalamt"];
    
    $selC = "select * from tbl_booking where user_id='" .$_SESSION["uid"]. "'and booking_status='0'";
    $rs = $Con->query($selC);
    $row=$rs->fetch_assoc();
    $_SESSION["bid"] = $row["booking_id"];
    
    $upQry1 = "update tbl_booking set booking_date=curdate(),booking_amount='".$amt."',booking_status='1' where user_id='" .$_SESSION["uid"]. "' and booking_id=".$row["booking_id"];
    $Con->query($upQry1);
    
    $upQry1 = "update tbl_cart set cart_status='1' where booking_id='" .$row["booking_id"]. "'";
    if($Con->query($upQry1)) {
        if($_POST["txt_address"] == "0" ) {
            $selqry667="select * from tbl_user where user_id='".$_SESSION["uid"]."'";
            $res667=$Con->query($selqry667);
            $row667=$res667->fetch_assoc();
            $data667=$row667["user_address"];

            $upQry1 = "update tbl_booking set booking_address='".$data667."' where user_id='" .$_SESSION["uid"]. "' and booking_id=".$row["booking_id"];
            $Con->query($upQry1);
    
            // If Current Address selected → go to Payment page
            echo "<script>window.location='Payment.php';</script>";
        } else {
            // If New Address selected → go to Address page
            echo "<script>window.location='Address.php';</script>";                  
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Berry Delight - Shopping Cart</title>
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
        <link href="../Assets/Templates/Main/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
        
        <!-- Shopping Cart Styles -->
        <style>
            .cart-container {
                background-color: #f9f6f1;
                padding: 30px;
                border-radius: 10px;
                margin: 20px 0;
            }
            
            .page-title {
                text-align: center;
                margin: 25px 0;
                color: #5c3d2e;
                font-size: 32px;
                position: relative;
            }
            
            .page-title:after {
                content: "";
                display: block;
                width: 100px;
                height: 3px;
                background: linear-gradient(to right, #8a5a2d, #c39d6d);
                margin: 10px auto;
            }
            
            .product-image {
                float: left;
                width: 15%;
            }

            .product-details {
                float: left;
                width: 20%;
            }

            .product-price {
                float: left;
                width: 12%;
            }

            .product-quantity {
                float: left;
                width: 16%;
            }

            .product-removal {
                float: left;
                width: 9%;
            }

            .product-line-price {
                float: left;
                width: 12%;
                text-align: right;
            }

            /* This is used as the traditional .clearfix class */
            .group:before,
            .shopping-cart:before,
            .column-labels:before,
            .product:before,
            .totals-item:before,
            .group:after,
            .shopping-cart:after,
            .column-labels:after,
            .product:after,
            .totals-item:after {
                content: "";
                display: table;
            }

            .group:after,
            .shopping-cart:after,
            .column-labels:after,
            .product:after,
            .totals-item:after {
                clear: both;
            }

            .group,
            .shopping-cart,
            .column-labels,
            .product,
            .totals-item {
                zoom: 1;
            }

            /* Apply clearfix in a few places */
            /* Apply dollar signs */
            .product .product-price:before,
            .product .product-line-price:before,
            .totals-value:before {
                content: "₹";
            }

            /* Body/Header stuff */
            .cart-body {
                padding: 0px 30px 30px 20px;
                font-family: "HelveticaNeue-Light", "Helvetica Neue Light",
                    "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-weight: 100;
            }

            h1 {
                font-weight: 100;
            }

            label {
                color: #aaa;
            }

            .shopping-cart {
                margin-top: -45px;
            }

            /* Column headers */
            .column-labels label {
                padding-bottom: 15px;
                margin-bottom: 15px;
                border-bottom: 1px solid #eee;
            }
            .column-labels .product-image,
            .column-labels .product-details,
            .column-labels .product-removal {
                text-indent: -9999px;
            }

            /* Product entries */
            .product {
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }
            .product .product-image {
                text-align: center;
            }
            .product .product-image img {
                width: 100px;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .product .product-details .product-title {
                margin-right: 20px;
                font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
                color: #5c3d2e;
                font-weight: bold;
            }
            .product .product-details .product-description {
                margin: 5px 20px 5px 0;
                line-height: 1.4em;
                color: #8a5a2d;
            }
            .product .product-quantity select {
                width: 90px;
                padding: 5px;
                border: 1px solid #e0c9a6;
                border-radius: 5px;
            }
            .product .remove-product {
                border: 0;
                padding: 8px 12px;
                background-color: #e74c3c;
                color: #fff;
                font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
                font-size: 12px;
                border-radius: 5px;
                transition: all 0.3s;
            }
            .product .remove-product:hover {
                background-color: #c0392b;
                transform: translateY(-2px);
            }

            /* Totals section */
            .totals .totals-item {
                float: right;
                clear: both;
                width: 100%;
                margin-bottom: 10px;
            }
            .totals .totals-item label {
                float: left;
                clear: both;
                width: 79%;
                text-align: right;
                color: #5c3d2e;
                font-weight: bold;
            }
            .totals .totals-item .totals-value {
                float: right;
                width: 21%;
                text-align: right;
                color: #8a5a2d;
                font-weight: bold;
                font-size: 18px;
            }
            .totals .totals-item-total {
                font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
            }

            .checkout {
                float: right;
                border: 0;
                margin-top: 20px;
                padding: 12px 30px;
                background: linear-gradient(to right, #8a5a2d, #c39d6d);
                color: #fff;
                font-size: 18px;
                border-radius: 5px;
                transition: all 0.3s;
            }

            .checkout:hover {
                background: linear-gradient(to right, #6b4624, #a7835a);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .address-options {
                margin: 20px 0;
                padding: 15px;
                background: linear-gradient(to right, #f9f6f1, #f1e9dc);
                border-radius: 10px;
                border: 1px dashed #c39d6d;
            }

            .address-options label {
                color: #5c3d2e;
                font-weight: bold;
                margin-right: 20px;
            }

            /* Make adjustments for tablet */
            @media screen and (max-width: 650px) {
                .shopping-cart {
                    margin: 0;
                    padding-top: 20px;
                    border-top: 0px solid #eee;
                }

                .column-labels {
                    display: none;
                }

                .product-image {
                    float: right;
                    width: auto;
                }
                .product-image img {
                    margin: 0 0 10px 10px;
                }

                .product-details {
                    float: none;
                    margin-bottom: 10px;
                    width: auto;
                }

                .product-price {
                    clear: both;
                    width: 70px;
                }

                .product-quantity {
                    width: 100px;
                }
                .product-quantity input {
                    margin-left: 20px;
                }

                .product-quantity:before {
                    content: "x";
                }

                .product-removal {
                    width: auto;
                }

                .product-line-price {
                    float: left;
                    width: 70px;
                }
            }
            /* Make more adjustments for phone */
            @media screen and (max-width: 350px) {
                .product-removal {
                    float: right;
                }

                .product-line-price {
                    float: right;
                    clear: left;
                    width: auto;
                    margin-top: 10px;
                }

                .product .product-line-price:before {
                    content: "Item Total: ₹";
                }

                .totals .totals-item label {
                    width: 60%;
                }
                .totals .totals-item .totals-value {
                    width: 40%;
                }
            }

            label{
                margin: 0px 15px;
            }

            /* Empty cart message */
            .empty-cart {
                text-align: center;
                padding: 40px;
                color: #8a5a2d;
                font-size: 18px;
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
                            <a href="ViewShop.php" class="nav-item nav-link">View Shop</a>
                            <a href="LogOut.php" class="nav-item nav-link">Logout</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->
        
        <div style="padding:100px">
            <div class="container cart-container">
                <h1 class="page-title">Shopping Cart</h1>
                
                <div class="cart-body">
                    <div class="column-labels">
                        <label class="product-price" style="width: 13%; text-align:center">Image</label>
                        <label class="product-price" style="width: 16%; text-align:center">Details</label>	
                        <label class="product-price" style="width: 10%; text-align:center">Price</label>
                        <label class="product-price" style="width: 13%; text-align:center">Qty</label>
                        <label class="product-price" style="width: 10%; text-align:center">Remove</label>
                        <label class="product-price" style="width: 16%; text-align:center">Total</label>
                    </div>
                    
                    <form method="post">
                        <div class="shopping-cart" style="margin-top: 50px">            
                            <?php                
                            $sel = "select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id where b.user_id='" .$_SESSION["uid"]. "' and booking_status='0' and cart_status=0";
                            $res = $Con->query($sel);
                            $hasItems = false;
                            
                            if ($res->num_rows > 0) {
                                $hasItems = true;
                                while ($row=$res->fetch_assoc()) {
                                    $selPr = "select * from tbl_product where product_id='" .$row["product_id"]. "'";
                                    $respr = $Con->query($selPr);
                                    if ($rowpr=$respr->fetch_assoc()) {
                                        $selstock = "select sum(stock_qty) as stock from tbl_stock where product_id='".$rowpr["product_id"]."'";
                                        $selstock1="select sum(cart_qty) as quantity from tbl_cart where product_id='".$rowpr["product_id"]."' and cart_status >'0'";
                                        $chk=$Con->query($selstock1)->fetch_assoc();
                                        $resst = $Con->query($selstock);
                                        if ($rowst=$resst->fetch_assoc()) {
                            ?>
                            

                            <div class="product">
                                <div class="product-image">
                                    <img src="../Assets/Files/SellerDocs/<?php echo $rowpr["product_photo"] ?>" alt="<?php echo $rowpr["product_name"] ?>" />
                                </div>
                                <div class="product-details">
                                    <div class="product-title"><?php echo $rowpr["product_name"] ?></div>
                                    <p class="product-description">
                                    <?php echo $rowpr["product_description"] ?>
                                    </p>
                                </div>
                                <div class="product-price"><?php echo $rowpr["product_price"] ?></div>
                                

                            <div class="product-quantity">
                                <select id="<?php echo $row["cart_id"]?>" style="width:90px">
                                    <?php
                                    // Each quantity = 100 grams
                                    for ($k=1;$k<=($rowst["stock"]-$chk["quantity"]);$k++) {
                                        $grams = $k * 100; // convert to grams
                                        ?>
                                        <option <?php if($row["cart_qty"]==$k){ echo "selected";} ?> value="<?php echo $k ?>">
                                            <?php echo $grams ?> g
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                                <div class="product-removal">
                                    <button class="remove-product" value="<?php echo $row["cart_id"] ?>">Remove</button>
                                </div>
                                <div class="product-line-price">
                                    <?php
                                        $pr = $rowpr["product_price"];
                                        $qty = $row["cart_qty"];
                                        $tot = (int)$pr * (int)$qty;
                                        echo $tot;
                                    ?>
                                </div>
                            </div>
                            <?php
                                        }
                                    }
                                }
                            } else {
                                echo '<div class="empty-cart">Your cart is empty. Start adding some delicious dry fruits!</div>';
                            }
                            ?>

                            <?php if ($hasItems) { ?>
                            <div class="totals">
                                <div class="totals-item totals-item-total">
                                    <label>Grand Total</label>
                                    <div class="totals-value" id="cart-total">0</div>
                                    <input type="hidden" id="cart-totalamt" name="carttotalamt" value=""/>
                                </div>
                            </div>
                            
                            <div class="address-options">
                                <input type="radio" name="txt_address" value="0" id="current-address" />
                                <label for="current-address">Current Address</label>
                               
                                <input type="radio" name="txt_address" value="1" id="new-address" />
                                <label for="new-address">New Address</label>
                            </div>
                            
                            <button type="submit" class="checkout" name="btn_checkout">Proceed to Checkout</button>
                            <?php } ?>
                        </div>
                    </form>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../Assets/Templates/Main/lib/easing/easing.min.js"></script>
        <script src="../Assets/Templates/Main/lib/waypoints/waypoints.min.js"></script>
        <script src="../Assets/Templates/Main/lib/lightbox/js/lightbox.min.js"></script>
        <script src="../Assets/Templates/Main/lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="../Assets/Templates/Main/js/main.js"></script>
        
        <!-- Shopping Cart Script -->
        <script>
        /* Set rates + misc */
        var fadeTime = 300;

        /* Assign actions */
        $(".product-quantity select").change(function() {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxCart.php?action=Update&id=" + this.id + "&qty=" + this.value
            });
            updateQuantity(this);
        });

        $(".product-removal button").click(function() {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxCart.php?action=Delete&id=" + this.value
            });
            removeItem(this);
        });

        /* Recalculate cart */
        function recalculateCart() {
            var subtotal = 0;

            /* Sum up row totals */
            $(".product").each(function() {
                subtotal += parseFloat(
                    $(this).children(".product-line-price").text()
                );
            });

            /* Calculate totals */
            var total = subtotal;

            /* Update totals display */
            $(".totals-value").fadeOut(fadeTime, function() {
                $("#cart-total").html(total.toFixed(2));
                document.getElementById("cart-totalamt").value = total.toFixed(2);
                if (total == 0) {
                    $(".checkout").fadeOut(fadeTime);
                } else {
                    $(".checkout").fadeIn(fadeTime);
                }
                $(".totals-value").fadeIn(fadeTime);
            });
        }

        /* Update quantity */
        function updateQuantity(quantityInput) {
            /* Calculate line price */
            var productRow = $(quantityInput).parent().parent();
            var price = parseFloat(productRow.children(".product-price").text());
            var quantity = $(quantityInput).val();
            var linePrice = price * quantity;
            
            /* Update line price display and recalc cart totals */
            productRow.children(".product-line-price").each(function() {
                $(this).fadeOut(fadeTime, function() {
                    $(this).text(linePrice.toFixed(2));
                    recalculateCart();
                    $(this).fadeIn(fadeTime);
                });
            });
        }

        /* Remove item from cart */
        function removeItem(removeButton) {
            /* Remove row from DOM and recalc cart total */
            var productRow = $(removeButton).parent().parent();
            productRow.slideUp(fadeTime, function() {
                productRow.remove();
                recalculateCart();
                
                // Check if cart is empty
                if ($(".product").length === 0) {
                    $(".shopping-cart").append('<div class="empty-cart">Your cart is empty. Start adding some delicious dry fruits!</div>');
                    $(".totals, .address-options, .checkout").hide();
                }
            });
        }

        // Initialize cart on page load
        $(document).ready(function() {
            recalculateCart();
        });
        </script>
    </body>
</html>