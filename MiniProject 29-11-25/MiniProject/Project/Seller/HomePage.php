<?php 
session_start();
include("../Assets/Connection/Connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seller Home - Dry Fruit Store</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 font-sans">

  <!-- Header -->
  <header class="bg-amber-700 text-white shadow-lg p-6 flex items-center justify-between">
    <h1 class="text-2xl font-bold">Berry Delight Seller Dashboard</h1>
    <p class="text-lg">Welcome, <span class="font-semibold"><?php echo $_SESSION["sname"];?></span></p>
    <a href="LogOut.php" class="nav-item nav-link">Logout</a>
  </header>


  <!-- Hero Section with GIF/Video -->
  <!-- <section class="relative w-full h-72 overflow-hidden">
     <video autoplay muted loop class="w-full h-full object-cover">
      <source src="https://cdn.pixabay.com/video/2021/09/14/89638-598470693_large.mp4" type="video/mp4">
    </video>
    <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center text-white">
      <h2 class="text-3xl md:text-4xl font-bold">Fresh & Premium Dry Fruits</h2>
      <p class="mt-2 text-lg">Manage your products and grow your sales</p>
    </div> -->
  <!-- </section>  -->

  <!-- Main Dashboard Links -->
  <main class="max-w-5xl mx-auto mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-4">

    <!-- Card Template -->
    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:scale-105 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" class="w-16 mb-4" alt="Profile Icon">
      <h3 class="text-xl font-semibold mb-2">My Profile</h3>
      <a href="MyProfile.php" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Go</a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:scale-105 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" class="w-16 mb-4" alt="Edit Profile Icon">
      <h3 class="text-xl font-semibold mb-2">Edit Profile</h3>
      <a href="EditProfile.php" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Go</a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:scale-105 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" class="w-16 mb-4" alt="Password Icon">
      <h3 class="text-xl font-semibold mb-2">Change Password</h3>
      <a href="ChangePassword.php" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Go</a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:scale-105 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/3081/3081840.png" class="w-16 mb-4" alt="Product Icon">
      <h3 class="text-xl font-semibold mb-2">Add Product</h3>
      <a href="Product.php" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Go</a>
    </div>

    <!-- <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:scale-105 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/590/590685.png" class="w-16 mb-4" alt="Quantity Icon">
      <h3 class="text-xl font-semibold mb-2">Product Quantity</h3>
      <a href="ProductQuantity.php" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Go</a>
    </div> -->

    <!-- <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:scale-105 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" class="w-16 mb-4" alt="Stock Icon">
      <h3 class="text-xl font-semibold mb-2">Stock</h3>
      <a href="Stock.php" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Go</a>
    </div> -->

    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:scale-105 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" class="w-16 mb-4" alt="Booking Icon">
      <h3 class="text-xl font-semibold mb-2">View Booking</h3>
      <a href="ViewBooking.php" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Go</a>
    </div>
    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:scale-105 transition">
      <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" class="w-16 mb-4" alt="Edit Profile Icon">
      <h3 class="text-xl font-semibold mb-2">Reports</h3>
      <a href="SellerReports.php" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Go</a>
    </div>

  </main>

  <!-- Footer with GIF -->
  <footer class="bg-amber-700 text-white mt-12 py-6 text-center">
    <p class="text-lg">Thank you for being part of the Berry Delight Family</p>
    <!-- <img src="https://media.giphy.com/media/3o6Zt481isNVuQI1l6/giphy.gif" alt="Dry Fruits Gif" class="mx-auto mt-4 w-32 rounded-lg shadow-lg" /> -->
  </footer>

</body>
</html>
