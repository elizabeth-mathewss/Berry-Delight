<?php
include("../Assets/Connection/Connection.php"); 
session_start();
if(isset($_POST["btn_submit"]))
{
	$content=$_POST["txt_content"];
	
	$insqry="insert into tbl_feedback(feedback_content,feedback_datetime,user_id) values('".$content."',now(),'".$_SESSION['uid']."')";
	if($Con->query($insqry))
	{
		?>
		<script>
		alert("Feedback Inserted");
		window.location="Feedback.php";
		</script>
        <?php
		
	}
}
if(isset($_GET['delId']))
{
	$DelQry="delete from tbl_feedback where feedback_id='".$_GET['delId']."'";
	if($Con->query($DelQry))
	{
		?>
        <script>
		alert("Data Deleted");
		window.location="Feedback.php";
		</script>
        <?php
	}
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Berry Delight - Feedback Portal</title>
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
            /* Custom Styles for Feedback Page */
            .feedback-container {
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
            
            /* Form Styles */
            .feedback-form {
                background-color: #fff;
                border-radius: 10px;
                padding: 25px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                margin-bottom: 30px;
                border: 1px solid #e0c9a6;
            }
            
            .form-title {
                font-size: 22px;
                margin-bottom: 20px;
                color: #8a5a2d;
                text-align: center;
            }
            
            .form-table {
                width: 100%;
                border-collapse: collapse;
            }
            
            .form-table td {
                padding: 12px;
            }
            
            .form-table input[type="text"],
            .form-table textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #e0c9a6;
                border-radius: 5px;
                font-size: 16px;
                transition: border-color 0.3s;
            }
            
            .form-table input[type="text"]:focus,
            .form-table textarea:focus {
                border-color: #c39d6d;
                outline: none;
                box-shadow: 0 0 5px rgba(195, 157, 109, 0.5);
            }
            
            .submit-btn {
                background: linear-gradient(to right, #8a5a2d, #c39d6d);
                color: white;
                border: none;
                padding: 12px 25px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                font-weight: bold;
                transition: all 0.3s;
            }
            
            .submit-btn:hover {
                background: linear-gradient(to right, #6b4624, #a7835a);
                transform: translateY(-2px);
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            }
            
            /* Feedback List Styles */
            .feedback-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #fff;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .feedback-table th, 
            .feedback-table td {
                padding: 15px;
                text-align: left;
                border-bottom: 1px solid #e0c9a6;
            }
            
            .feedback-table th {
                background: linear-gradient(to right, #8a5a2d, #c39d6d);
                color: white;
                font-weight: bold;
            }
            
            .feedback-table tr:nth-child(even) {
                background-color: #f9f6f1;
            }
            
            .feedback-table tr:hover {
                background-color: #f1e9dc;
            }
            
            .delete-link {
                color: #e74c3c;
                text-decoration: none;
                font-weight: bold;
                transition: color 0.3s;
            }
            
            .delete-link:hover {
                color: #c0392b;
                text-decoration: underline;
            }
            
            /* Visual Elements */
            .section-divider {
                display: flex;
                align-items: center;
                margin: 30px 0;
            }
            
            .divider-line {
                flex: 1;
                height: 2px;
                background: linear-gradient(to right, transparent, #c39d6d, transparent);
            }
            
            .divider-icon {
                margin: 0 15px;
                color: #8a5a2d;
                font-size: 24px;
            }
            
            .appreciation-section {
                background: linear-gradient(to right, #f9f6f1, #f1e9dc, #f9f6f1);
                padding: 25px;
                border-radius: 10px;
                margin: 30px 0;
                text-align: center;
                border: 1px dashed #c39d6d;
            }
            
            .appreciation-title {
                font-size: 22px;
                color: #8a5a2d;
                margin-bottom: 15px;
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
                             <!-- <a href="ViewBooking.php" class="nav-item nav-link">View Booking</a> -->
                             <a href="LogOut.php" class="nav-item nav-link">Logout</a>

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
            <div class="container feedback-container">
                <h1 class="page-title">Feedback Portal</h1>
                
                <div class="appreciation-section">
                    <h2 class="appreciation-title">We Value Your Feedback</h2>
                    <p>At Berry Delight, we're constantly striving to improve our products and services. Your feedback helps us understand what we're doing well and where we can improve. Please share your thoughts with us.</p>
                </div>
                
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <div class="divider-icon">🌟</div>
                    <div class="divider-line"></div>
                </div>
                
                <div class="feedback-form">
                    <h2 class="form-title">Share Your Feedback</h2>
                    <form id="form1" name="form1" method="post" action="">
                        <table class="form-table">
                            <tr>
                                <td width="20%">Feedback</td>
                                <td width="80%">
                                    <textarea name="txt_content" id="txt_content" cols="45" rows="5" required="required" placeholder="Please share your thoughts about our products and services"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div align="center">
                                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit Feedback" class="submit-btn" />
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                
                <h2 style="text-align: center; color: #8a5a2e; margin: 30px 0 20px;">Your Previous Feedback</h2>
                
                <table class="feedback-table">
                    <tr>
                        <th>SNo</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sel="select * from tbl_feedback where user_id='".$_SESSION["uid"]."'";
                    $res=$Con->query($sel);
                    $i=0;
                    if($res && $res->num_rows > 0) {
                        while($data=$res->fetch_assoc())
                        {
                            $i++;
                            ?>	
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data["feedback_content"]; ?></td>
                                <td><a href="Feedback.php?delId=<?php echo $data["feedback_id"]; ?>" class="delete-link">Delete</a></td>
                            </tr>
                            <?php 
                        }
                    } else {
                        echo '<tr><td colspan="3" style="text-align: center; padding: 20px;">No feedback submitted yet.</td></tr>';
                    }
                    ?>
                </table>
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
</html>