<?php
include("../Assets/Connection/Connection.php");
session_start();
$sel="select * from tbl_seller where seller_id='".$_SESSION["sid"]."'";
$res=$Con->query($sel);
$data=$res->fetch_assoc();
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$contact=$_POST["txt_contact"];
	$address=$_POST["txt_address"];
	
	$UpQry="update tbl_seller set seller_name='".$name."' , seller_email='".$email."', seller_contact='".$contact."', seller_address='".$address."' where seller_id='".$_SESSION["sid"]."'";
	if($Con->query($UpQry))
	{
		?>
        <script>
		alert("Data updated");
		window.location="EditProfile.php";
		</script>
        <?php
	}
}
?>

<!-- Include Header -->
 <?php include("Header.php"); ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
      <div class="card">
        <!-- Dry Fruit Banner -->
        <img src="../Assets/Templates/Main/img/top.jpg" class="banner" alt="Dry Fruits">

        <div class="card-body p-4">
          <h2 class="text-center mb-4 fw-bold" style="color: brown;">Edit Profile</h2>
          
          <!-- Carousel for Dry Fruits Images -->
          <div id="dryFruitsCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <!-- <img src="https://images.unsplash.com/photo-1601491316069-708d9e0ebbed" class="d-block w-100" alt="Assorted Dry Fruits" style="border-radius: 10px; max-height: 200px; object-fit: cover;"> -->
              </div>
              <div class="carousel-item">
                <!-- <img src="https://images.unsplash.com/photo-1579187556846-2f4665f6a1d0" class="d-block w-100" alt="Almonds and Walnuts" style="border-radius: 10px; max-height: 200px; object-fit: cover;">
              </div>
              <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1615485291234-7d7fd2455747" class="d-block w-100" alt="Dried Apricots" style="border-radius: 10px; max-height: 200px; object-fit: cover;"> -->
              </div>
            </div>
            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#dryFruitsCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#dryFruitsCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button> -->
          </div>

          <!-- Short Video -->
          <div class="mb-4 text-center">
            <!-- <video width="100%" height="auto" controls style="border-radius: 10px; max-height: 200px;">
              <source src="https://assets.mixkit.co/videos/preview/mixkit-dried-fruits-and-nuts-129.mp4" type="video/mp4">
              Your browser does not support the video tag.
            </video> -->
            <!-- <p class="text-muted small">Explore our premium dry fruits collection!</p> -->
          </div>

          <!-- GIF -->
          <div class="mb-4 text-center">
            <!-- <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExNWQ0YzVhZmQ3M2E4ZDM5ZDE5ZGU3NzE3ZTVmY2Q4ZWRkN2I5M2M2NCZlcD12MV9pbnRlcm5hbF9naWZzX2dpZklkJmN0PWc/3o7buirYcmV3Y0Z7y8/giphy.gif" alt="Dry Fruits GIF" style="border-radius: 10px; max-width: 100%; max-height: 200px;"> -->
            <!-- <p class="text-muted small">Fresh and delicious dry fruits at Berry Delight!</p> -->
          </div>

          <form id="form1" name="form1" method="post" action="">
            <div class="mb-3">
              <label for="txt_name" class="form-label">Name</label>
              <input type="text" name="txt_name" id="txt_name" minlength="3" 
                     title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" 
                     pattern="^[A-Z]+[a-zA-Z ]*$" 
                     class="form-control" required 
                     value="<?php echo $data['seller_name']; ?>" />
            </div>

            <div class="mb-3">
              <label for="txt_email" class="form-label">Email</label>
              <input type="email" name="txt_email" id="txt_email" class="form-control" 
                     required value="<?php echo $data['seller_email']; ?>" />
            </div>

            <div class="mb-3">
              <label for="txt_contact" class="form-label">Contact</label>
              <input type="text" name="txt_contact" id="txt_contact" class="form-control" 
                     pattern="[6-9]{1}[0-9]{9}" 
                     title="Phone number with 6-9 and remaining 9 digits with 0-9" 
                     required value="<?php echo $data['seller_contact']; ?>" />
            </div>

            <div class="mb-3">
              <label for="txt_address" class="form-label">Address</label>
              <textarea name="txt_address" id="txt_address" rows="4" class="form-control" required><?php echo $data['seller_address']; ?></textarea>
            </div>

            <div class="text-center">
              <input type="submit" name="btn_submit" id="btn_submit" value="Update Profile" class="btn btn-update me-2" />
              <a href="MyProfile.php" class="btn btn-secondary btn-custom">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include Footer -->
<?php include("Footer.php"); ?>