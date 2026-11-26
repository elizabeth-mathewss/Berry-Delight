
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password - Berry Delight</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-brown: #8B4513;
            --light-brown: #D2B48C;
            --dark-brown: #654321;
            --accent-brown: #A0522D;
            --background: #FFF8F0;
            --golden: #DAA520;
            --green: #228B22;
        }
        .btn {
            color:white;
        }
        
        body {
            background: linear-gradient(135deg, #FFF8F0 0%, #F5DEB3 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background-attachment: fixed;
        }
        
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }
        
        .floating-nuts {
            position: absolute;
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-nuts:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
        .floating-nuts:nth-child(2) { top: 20%; right: 10%; animation-delay: 2s; }
        .floating-nuts:nth-child(3) { bottom: 20%; left: 15%; animation-delay: 4s; }
        .floating-nuts:nth-child(4) { bottom: 30%; right: 20%; animation-delay: 1s; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }
        
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .hero-section {
            background: linear-gradient(rgba(139, 69, 19, 0.8), rgba(160, 82, 45, 0.8)), 
                       url('https://images.unsplash.com/photo-1599909437915-4de4b875c1cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            color: white;
            margin-bottom: 3rem;
            box-shadow: 0 15px 35px rgba(139, 69, 19, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0), transparent);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%); }
            100% { transform: translateX(100%) translateY(100%); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.2);
            border: 1px solid rgba(210, 180, 140, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-brown), var(--golden), var(--green), var(--accent-brown));
            animation: rainbow 3s linear infinite;
        }
        
        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
        
        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }
        
        .form-label {
            color: var(--dark-brown);
            font-weight: 600;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }
        
        .nut-icon {
            color: var(--primary-brown);
            margin-right: 10px;
            font-size: 1.2rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .form-control {
            border-radius: 15px;
            border: 2px solid var(--light-brown);
            padding: 1rem 1.2rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: rgba(255, 13, 13, 0.8);
        }
        
        .form-control:focus {
            border-color: var(--accent-brown);
            box-shadow: 0 0 0 0.25rem rgba(160, 82, 45, 0.15);
            transform: translateY(-2px);
            background: white;
        }
        
        .input-group {
            position: relative;
        }
        
        .password-toggle {
            background: var(--light-brown);
            border: 2px solid var(--light-brown);
            border-left: none;
            border-radius: 0 15px 15px 0;
            color: var(--dark-brown);
            transition: all 0.3s ease;
        }
        
        .password-toggle:hover {
            background: var(--accent-brown);
            color: white;
            transform: scale(1.05);
        }
        
        .btn-update {
            background: linear-gradient(45deg, var(--primary-brown), var(--accent-brown));
            /* color: white; */
            border: none;
            border-radius: 50px;
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-update::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-update:hover::before {
            left: 100%;
        }
        
        .btn-update:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(139, 69, 19, 0.3);
        }
        
        .btn-cancel {
            background: linear-gradient(45deg, #6c757d, #5a6268);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-cancel:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 1);
        }
        
        .security-note {
            background: linear-gradient(135deg, #f9f5eb, #fff8f0);
            border-left: 5px solid var(--primary-brown);
            padding: 1.5rem;
            border-radius: 10px;
            margin: 2rem 0;
            position: relative;
            animation: glow 2s infinite alternate;
        }
        
        @keyframes glow {
            from { box-shadow: 0 0 5px rgba(139, 69, 19, 0.2); }
            to { box-shadow: 0 0 15px rgba(139, 69, 19, 0.4); }
        }
        
        .dry-fruit-gallery {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }
        
        .fruit-item {
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .fruit-item:hover {
            transform: translateY(-10px) rotate(5deg);
        }
        
        .fruit-item img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        
        .fruit-item:hover img {
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            transform: scale(1.1);
        }
        
        /* .strength-indicator {
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            margin-top: 0.5rem;
            overflow: hidden;
        } */
        
        .strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            opacity: 0.05;
        }
        

        
        .form-text {
            color: var(--accent-brown);
            font-weight: 500;
            margin-top: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .form-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            
            .dry-fruit-gallery {
                gap: 1rem;
            }
            
            .fruit-item img {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="floating-nuts">🥜</div>
        <div class="floating-nuts">🌰</div>
        <div class="floating-nuts">🥥</div>
        <div class="floating-nuts">🍇</div>
    </div>
    


    <!-- Include Header -->
    <?php include("Header.php"); ?>
    
    <div class="container page-container py-5">
        <!-- Hero Section -->
        <!-- <div class="hero-section"> -->
            <div class="hero-content">
                <!-- <h1 class="hero-title">🔐 Secure Your Account</h1>
                <p class="hero-subtitle">Update your password to keep your Berry Delight seller account protected</p> -->
            </div>
        </div>

        <!-- Dry Fruit Gallery -->
       

        <!-- Main Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="text-center mb-4">
                        <i class="fas fa-shield-alt" style="font-size: 4rem; color: var(--primary-brown); margin-bottom: 1rem;"></i>
                        <h2 class="mt-3 mb-0" style="color: var(--dark-brown);">Change Password</h2>
                        <p class="text-muted">Keep your account secure with a strong password</p>
                    </div>

                    <form id="form1" name="form1" method="post" action="">
                        <!-- Old Password -->
                        <div class="form-group">
                            <label for="txt_oldpassword" class="form-label">
                                <i class="fas fa-lock nut-icon"></i>Old Password
                            </label>
                            <div class="input-group">
                                <input type="password" name="txt_oldpassword" id="txt_oldpassword"
                                       class="form-control"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                       required="required"
                                       placeholder="Enter your old password"/>
                                <button type="button" class="btn password-toggle" onclick="togglePw('txt_oldpassword', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label for="txt_newpassword" class="form-label">
                                <i class="fas fa-key nut-icon"></i>New Password
                            </label>
                            <div class="input-group">
                                <input type="password" name="txt_newpassword" id="txt_newpassword"
                                       class="form-control"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                       required="required"
                                       placeholder="Create a new password"
                                       onkeyup="checkPasswordStrength(this.value)"/>
                                <button type="button" class="btn password-toggle" onclick="togglePw('txt_newpassword', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="strength-indicator">
                                <div class="strength-bar" id="strengthBar"></div>
                            </div>
                            <div class="form-text">
                                <!-- <i class="fas fa-info-circle"></i> 
                                Use at least 8 characters with uppercase, lowercase, numbers and special characters. -->
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="txt_confirmpassword" class="form-label">
                                <i class="fas fa-shield-alt nut-icon"></i>Confirm Password
                            </label>
                            <div class="input-group">
                                <input type="password" name="txt_confirmpassword" id="txt_confirmpassword"
                                       class="form-control"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                       required="required"
                                       placeholder="Re-enter your new password"
                                       onkeyup="checkPasswordMatch()"/>
                                <button type="button" class="btn password-toggle" onclick="togglePw('txt_confirmpassword', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div id="passwordMatch" class="form-text"></div>
                        </div>

                        <!-- Security Note -->
                        <div class="security-note">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shield-alt" style="font-size: 3rem; color: var(--primary-brown); margin-right: 1rem;"></i>
                                <div>
                                    <h6 class="mb-1" style="color: var(--dark-brown);">
                                        <i class="fas fa-shield-alt nut-icon"></i>Your Security is Our Priority
                                    </h6>
                                    <small>Your password is encrypted with advanced security protocols and stored safely.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-center">
                            <button type="submit" name="btn_submit" id="btn_submit" style="color:white;" class="btn btn-update me-3">
                                <i class="fas fa-save me-2" ></i>Update Password
                            </button>
                            <a href="SellerHome.php" class="btn btn-cancel" style="color:white;">
                                <i class="fas fa-times me-2" class="btn btn-cancel" ></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Additional dry fruit decorative elements -->
        <!-- <div class="text-center mt-5">
            <!-- <div class="d-flex justify-content-center gap-3"> -->
                <!-- <i class="fas fa-seedling" style="font-size: 2rem; color: var(--green); opacity: 0.7;"></i>
                <i class="fas fa-leaf" style="font-size: 2rem; color: var(--accent-brown); opacity: 0.7;"></i>
                <i class="fas fa-heart" style="font-size: 2rem; color: var(--primary-brown); opacity: 0.7;"></i> -->
            </div>
        </div>
    </div> -->

    <!-- Include Footer -->
    <?php include("Footer.php"); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        function togglePw(id, btn){
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            const isPass = input.type === 'password';
            input.type = isPass ? 'text' : 'password';
            icon.className = isPass ? 'fas fa-eye-slash' : 'fas fa-eye';
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('strengthBar');
            let strength = 0;
            let color = '#ff4757';

            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 25;

            if (strength >= 75) {
                color = '#2ed573';
            } else if (strength >= 50) {
                color = '#ffa502';
            } else if (strength >= 25) {
                color = '#ff6348';
            }

            strengthBar.style.width = Math.min(strength, 100) + '%';
            strengthBar.style.background = color;
        }

        // Check if passwords match
        function checkPasswordMatch() {
            const password = document.getElementById('txt_newpassword').value;
            const confirmPassword = document.getElementById('txt_confirmpassword').value;
            const matchDiv = document.getElementById('passwordMatch');

            if (confirmPassword === '') {
                matchDiv.innerHTML = '';
                return;
            }

            if (password === confirmPassword) {
                matchDiv.innerHTML = '<i class="fas fa-check-circle text-success"></i> Passwords match!';
                matchDiv.style.color = '#2ed573';
            } else {
                matchDiv.innerHTML = '<i class="fas fa-times-circle text-danger"></i> Passwords do not match';
                matchDiv.style.color = '#ff4757';
            }
        }

        // Add floating animation to form elements
        document.addEventListener('DOMContentLoaded', function() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.animationDelay = `${index * 0.1}s`;
                group.style.animation = 'fadeInUp 0.6s ease forwards';
            });
        });

        // CSS for fade in animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>