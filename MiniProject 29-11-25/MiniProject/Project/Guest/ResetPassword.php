<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Berry Delight</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: url('../Assets/Images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        .reset-password-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .reset-password-container h2 {
            color: #bb7c33ff;
            margin-bottom: 20px;
            font-family: 'Raleway', sans-serif;
            font-weight: 800;
        }
        .reset-password-container table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        .reset-password-container td {
            padding: 10px;
        }
        .reset-password-container input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .reset-password-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #a76c28ff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .reset-password-container input[type="submit"]:hover {
            background-color: #af7f26ff;
        }
        .back-link {
            margin-top: 20px;
            display: block;
            color: #a77028ff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="reset-password-container">
        <h2>Reset Password</h2>
        <form action="" method="post">
            <table border='1'>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="txt_pass" id=""></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="txt_cpass" id=""></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="btn_submit" value="Change Password"></td>
                </tr>
            </table>
        </form>
        <a href="login.php" class="back-link">Back to Login</a>
    </div>

    <?php
    session_start();
    include("../Assets/Connection/Connection.php");

    if(isset($_POST['btn_submit'])){
        $pass=$_POST['txt_pass'];
        $cpass=$_POST['txt_cpass'];
        if($pass==$cpass){
            if(isset($_SESSION['ruid'])){ //User
                $updQry="update tbl_user set user_password='".$pass."' where user_id=".$_SESSION['ruid'];
                if($Con->query($updQry)){
                    session_destroy();
                    ?>
                    <script>
                        alert("Password Updated")
                        window.location="Login.php"
                    </script>
                    <?php
                }
            }
            else if(isset($_SESSION['rsid'])){ //Seller
                $updQry="update tbl_seller set seller_password='".$pass."' where seller_id=".$_SESSION['rsid'];
                if($Con->query($updQry)){
                    session_destroy();
                    ?>
                    <script>
                        alert("Password Updated")
                        window.location="Login.php"
                    </script>
                    <?php
                }
            }
            else{
                ?>
                <script>
                    alert('Something went wrong')
                    window.location="LogOut.php"
                </script>
                <?php
            }
        }
    }
    ?>
</body>
</html>