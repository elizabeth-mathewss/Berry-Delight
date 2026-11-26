<?php
// Session must start at the very beginning
session_start();
include("../Assets/Connection/Connection.php"); 
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Berry Delight - Product Ratings & Reviews</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
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
        
        <!-- Additional Styles for Rating System -->
        <style>
            .rating-container {
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
            
            .progress-label-left {
                float: left;
                margin-right: 0.5em;
                line-height: 1em;
            }
            
            .progress-label-right {
                float: right;
                margin-left: 0.3em;
                line-height: 1em;
            }
            
            .star-light {
                color: #e9ecef;
            }
            
            .review-card {
                border: 1px solid #e0c9a6;
                border-radius: 10px;
                margin-bottom: 20px;
                background-color: white;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }
            
            .user-avatar {
                width: 50px;
                height: 50px;
                background: linear-gradient(to right, #8a5a2d, #c39d6d);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
                font-size: 20px;
            }
            
            .rating-summary {
                background: linear-gradient(to right, #f9f6f1, #f1e9dc, #f9f6f1);
                padding: 25px;
                border-radius: 10px;
                margin: 30px 0;
                text-align: center;
                border: 1px dashed #c39d6d;
            }
            
            .rating-title {
                font-size: 22px;
                color: #8a5a2d;
                margin-bottom: 15px;
            }
            
            .btn-primary {
                background: linear-gradient(to right, #8a5a2d, #c39d6d);
                border: none;
                transition: all 0.3s;
            }
            
            .btn-primary:hover {
                background: linear-gradient(to right, #6b4624, #a7835a);
                transform: translateY(-2px);
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            }
            
            .text-warning {
                color: #ffc107 !important;
            }
            
            .modal-content {
                border-radius: 15px;
                border: none;
            }
            
            .modal-header {
                background: linear-gradient(to right, #8a5a2d, #c39d6d);
                color: white;
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
            }
            
            .close {
                color: white;
                opacity: 1;
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
                            <a href="MyProfile.php" class="nav-item nav-link">My Profile</a>
                            <a href="Complaint.php" class="nav-item nav-link">Complaint</a>
                             <a href="MyBooking.php" class="nav-item nav-link">My Booking</a>
                              <a href="LogOut.php" class="nav-item nav-link">Logout</a>
                             <!-- <a href="ViewReview.php" class="nav-item nav-link active">View Rating</a> -->
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
            <div class="container rating-container">
                <h1 class="page-title">Product Ratings & Reviews</h1>
                
                <!-- <div class="rating-summary">
                    <h2 class="rating-title">Share Your Experience</h2>
                    <p>Your feedback helps us improve our products and helps other customers make informed decisions. Please share your honest review of this product.</p>
                </div>  -->
                
                <div class="card">
                    <div class="card-header bg-primary text-white">Rating Box</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <h1 class="text-warning mt-4 mb-4">
                                    <b><span id="average_rating">0.0</span> / 5</b>
                                </h1>
                                <div class="mb-3">
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                </div>
                                <h3><span id="total_review">0</span> Review(s)</h3>
                            </div>
                            <div class="col-sm-4">
                                <p>
                                    <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                                    <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                    </div>
                                </p>
                                <p>
                                    <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                                    <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                    </div>               
                                </p>
                                <p>
                                    <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                                    <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                    </div>               
                                </p>
                                <p>
                                    <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                                    <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                    </div>               
                                </p>
                                <p>
                                    <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                                    <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                    </div>               
                                </p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <h3 class="mt-4 mb-3">Write Review Here</h3>
                                <button type="button" name="add_review" id="add_review" class="btn btn-primary">Add Review</button>
                                
                                <!-- <a href="ViewReview.php" class="btn btn-primary">View Review</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5" id="review_content"></div>
            </div>
        </div>

        <!-- Review Modal -->
        <div id="review_modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Submit Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <div class="form-group">
                            <input type="hidden" name="txt_pid" id="txt_pid" value="<?php echo isset($_GET["pid"]) ? $_GET["pid"] : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control" placeholder="Type your review here..." rows="5"></textarea>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-primary" id="save_review">Submit Review</button>
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
        
        <!-- Rating System Script -->
        <script>
        $(document).ready(function(){
            var rating_data = 0;

            $('#add_review').click(function(){
                $('#review_modal').modal('show');
            });

            $(document).on('mouseenter', '.submit_star', function(){
                var rating = $(this).data('rating');
                reset_background();
                for(var count = 1; count <= rating; count++) {
                    $('#submit_star_'+count).addClass('text-warning');
                }
            });

            function reset_background() {
                for(var count = 1; count <= 5; count++) {
                    $('#submit_star_'+count).addClass('star-light');
                    $('#submit_star_'+count).removeClass('text-warning');
                }
            }

            $(document).on('mouseleave', '.submit_star', function(){
                reset_background();
                for(var count = 1; count <= rating_data; count++) {
                    $('#submit_star_'+count).removeClass('star-light');
                    $('#submit_star_'+count).addClass('text-warning');
                }
            });

            $(document).on('click', '.submit_star', function(){
                rating_data = $(this).data('rating');
            });

            $('#save_review').click(function(){
                var user_review = $('#user_review').val();
                var product_id = $('#txt_pid').val();

                if(user_review == '') {
                    alert("Please write your review before submitting");
                    return false;
                } else if (rating_data == 0) {
                    alert("Please select a rating before submitting");
                    return false;
                } else {
                    $.ajax({
                        url:"../Assets/Ajaxpages/AjaxReview.php",
                        method:"POST",
                        data:{rating_data:rating_data, user_review:user_review, product_id:product_id},
                        success:function(data) {
                            $('#review_modal').modal('hide');
                            load_rating_data();
                            alert("Thank you for your review!");
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            alert("An error occurred while submitting your review. Please try again.");
                        }
                    })
                }
            }); 

            load_rating_data();

            function load_rating_data() {
                var product_id = $('#txt_pid').val();
                
                if(!product_id) {
                    console.error("Product ID is missing");
                    return;
                }
                
                $.ajax({
                    url:"../Assets/Ajaxpages/AjaxReview.php",
                    method:"POST",
                    data:{action:'load_data',pid:product_id},
                    dataType:"JSON",
                    success:function(data) {
                        $('#average_rating').text(data.average_rating);
                        $('#total_review').text(data.total_review);

                        var count_star = 0;
                        $('.main_star').each(function(){
                            count_star++;
                            if(Math.ceil(data.average_rating) >= count_star) {
                                $(this).addClass('text-warning');
                                $(this).removeClass('star-light');
                            } else {
                                $(this).removeClass('text-warning');
                                $(this).addClass('star-light');
                            }
                        });

                        $('#total_five_star_review').text(data.five_star_review);
                        $('#total_four_star_review').text(data.four_star_review);
                        $('#total_three_star_review').text(data.three_star_review);
                        $('#total_two_star_review').text(data.two_star_review);
                        $('#total_one_star_review').text(data.one_star_review);

                        // Calculate progress percentages safely
                        var total = data.total_review > 0 ? data.total_review : 1;
                        $('#five_star_progress').css('width', (data.five_star_review/total) * 100 + '%');
                        $('#four_star_progress').css('width', (data.four_star_review/total) * 100 + '%');
                        $('#three_star_progress').css('width', (data.three_star_review/total) * 100 + '%');
                        $('#two_star_progress').css('width', (data.two_star_review/total) * 100 + '%');
                        $('#one_star_progress').css('width', (data.one_star_review/total) * 100 + '%');

                        if(data.review_data && data.review_data.length > 0) {
                            var html = '';
                            for(var count = 0; count < data.review_data.length; count++) {
                                html += '<div class="review-card">';
                                html += '<div class="card-body">';
                                html += '<div class="row">';
                                html += '<div class="col-md-1">';
                                html += '<div class="user-avatar">'+data.review_data[count].user_name.charAt(0)+'</div>';
                                html += '</div>';
                                html += '<div class="col-md-11">';
                                html += '<h5>'+data.review_data[count].user_name+'</h5>';
                                
                                for(var star = 1; star <= 5; star++) {
                                    var class_name = '';
                                    if(data.review_data[count].rating >= star) {
                                        class_name = 'text-warning';
                                    } else {
                                        class_name = 'star-light';
                                    }
                                    html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                                }
                                
                                html += '<p class="mt-2">'+data.review_data[count].user_review+'</p>';
                                html += '<small class="text-muted">On '+data.review_data[count].datetime+'</small>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                            }
                            $('#review_content').html(html);
                        } else {
                            $('#review_content').html('<div class="text-center py-4"><p>No reviews yet. Be the first to review this product!</p></div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        $('#review_content').html('<div class="text-center py-4"><p>Error loading reviews. Please try again later.</p></div>');
                    }
                });
            }
        });
        </script>
    </body>
</html>