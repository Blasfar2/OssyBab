<?php
    include ("./includes/connection.php");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OssyBab</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/footer.css">

</head>
<body>


                                                                    <!-- NavBar -->
    
    <?php include ('./navbar.php'); ?>
    


<!-- it offCavans is HIDEEN !!!! -->
<div
    class="offcanvas offcanvas-end"
    data-bs-scroll="false"
    tabindex="-1"
    id="Id2"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="staticBackdropLabel">
        Cart
    </h5>
    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="offcanvas"
        aria-label="Close"
    ></button>
    </div>
    <div class="offcanvas-body">
    <hr>
        <div class="row align-items-center">
            <div class="col-4 p-1 "> 
                <img src="./img/Fashion.jpg" class="rounded-2 "style="width: 100px; height: 100px; object-fit: cover;" >
            </div>
            
            <div class="col-auto">
                <div class="text-center">
                    <div ><strong> Xiamio n-12</strong></div>
                    <div ><strong>Prix : </strong>15Dh</div>
                    <div ><strong>Categorie : </strong>Phone & Tablets</div>
                    <div class="row gap-1 "> 
                            <button class="btn btn-primary col-3"><i class="fa-solid fa-plus"></i></button>
                            <p class="col-2">1</p>
                            <button class="btn btn-primary col-3"><i class="fa-solid fa-minus"></i></button>
                            <div class="btn btn-danger col-3">del</div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row align-items-center">
            <div class="col-4 p-1 "> 
                <img src="./img/Fashion.jpg" class="rounded-2 "style="width: 100px; height: 100px; object-fit: cover;" >
            </div>
            
            <div class="col-auto">
                <div class="text-center">
                    <div ><strong> Xiamio n-12</strong></div>
                    <div ><strong>Prix : </strong>15£</div>
                    <div ><strong>Categorie : </strong>Phone & Tablets</div>
                    <div class="row gap-1 "> 
                            <button class="btn btn-primary col-3"><i class="fa-solid fa-plus"></i></button>
                            <p class="col-2">1</p>
                            <button class="btn btn-primary col-3"><i class="fa-solid fa-minus"></i></button>
                            <div class="btn btn-danger col-3">del</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                                                                    <!-- Ads Image -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="./img/sale2.jpg" class="d-block w-100" style="height: 500px;object-fit: cover;"alt="...">
        </div>
        <div class="carousel-item">
        <img src="./img/sale1.jpg" class="d-block w-100" style="height: 500px;object-fit: cover;"alt="...">
        </div>
        <div class="carousel-item">
        <img src="./img/sale.jpg" class="d-block w-100 " style="height: 500px;object-fit: cover;" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


                                                                    <!-- Cards -->
<div class="container text-center">
    <div class=" row justify-content-around loc row-cols-4">

        <?php
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $token = uniqid(); // Generate a unique token
                $_SESSION['token'] = $token;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col mt-3 card-zoom'>";
                    echo "<div class='card text-center border-primary' style='width: 18rem;'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title text-primary'>".$row['CategoryName']."</h5>";
                    echo "</div>";
                    echo "<img src='./uploads/".$row['CategoryImage']."' class='card-img-bottom'>";
                    echo "</div>";
                    echo "</div>";
                }
            }


        ?>
    </div>
</div>

<br>

<!-- <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button> -->




<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>


                                                                    <!-- Footer -->
<footer class="footer-09 bg-primary">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-3 mb-md-0 mb-4">
						<h2 class="footer-heading d-flex">
							<span class="icon d-flex align-items-center justify-content-center"><i class="fa-solid fa-address-card"></i></span>
							About
						</h2>
						<div class="block-23 mb-3">
              <ul>
                <li><span class="icon"><i class="fa-solid fa-location-dot"></i></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                <li><a href="#"><span class="icon"><i class="fa-solid fa-phone"></i></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon"><i class="fa-solid fa-envelope"></i></span><span class="text">info@yourdomain.com</span></a></li>
              </ul>
            </div>
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control rounded-left" placeholder="Enter email address">
                <button type="submit" class="form-control submit rounded-right text-primary"><span class="sr-only">Submit</span><i class="fa-solid fa-magnifying-glass"></i></button>
              </div>
            </form>
					</div>
					<div class="col-md-6 col-lg-3 mb-md-0 mb-4">
						<h2 class="footer-heading d-flex align-items-center"><span class="icon d-flex align-items-center justify-content-center"><i class="fa-solid fa-newspaper"></i></span>Latest News</h2>
						<div class="block-21 mb-4 d-flex">
              <a class="img mr-4 rounded" style="background-image: url(./img/sale1.jpg);background-size:cover ; background-repeat: no-repeat;"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> Oct. 16, 2019</a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-4 d-flex">
              <a class="img mr-4 rounded" style="background-image: url(./img/sale2.jpg);background-size:cover ; background-repeat: no-repeat;"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> Oct. 16, 2019</a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
					</div>
					<div class="col-md-6 col-lg-3 mb-md-0 mb-4">
						<h2 class="footer-heading d-flex align-items-center"><span class="icon d-flex align-items-center justify-content-center"><i class="fa-solid fa-circle-info"></i></i></span>Information</h2>
						<ul class="list-unstyled">
	            <li><a href="#" class="py-1 d-block">About</a></li>
	            <li><a href="#" class="py-1 d-block">Products</a></li>
	            <li><a href="#" class="py-1 d-block">Blog</a></li>
	            <li><a href="#" class="py-1 d-block">Contact</a></li>
	            <li><a href="#" class="py-1 d-block">Help &amp; Support</a></li>
	          </ul>
					</div>
					<div class="col-md-6 col-lg-3 mb-md-0 mb-4">
						<h2 class="footer-heading d-flex align-items-center"><span class="icon d-flex align-items-center justify-content-center"><i class="fa-brands fa-instagram"></i></i></span>Instagram</h2>
						<div class="block-24">
							<div class="row no-gutters">
								<div class="col-4 col-md-4 p-1">
									<a href="#" class="img rounded" style="background-image: url(./img/inst1.jpg); background-size:cover ; background-repeat: no-repeat;"></a>
								</div>
								<div class="col-4 col-md-4 p-1">
									<a href="#" class="img rounded" style="background-image: url(./img/inst2.jpg);background-size:cover ; background-repeat: no-repeat;"></a>
								</div>
								<div class="col-4 col-md-4 p-1">
									<a href="#" class="img rounded" style="background-image: url(./img/inst3.jpg);background-size:cover ; background-repeat: no-repeat;"></a>
								</div>
								<div class="col-4 col-md-4 p-1">
									<a href="#" class="img rounded" style="background-image: url(./img/inst4.jpg);background-size:cover ; background-repeat: no-repeat;"></a>
								</div>
								<div class="col-4 col-md-4 p-1">
									<a href="#" class="img rounded" style="background-image: url(./img/inst5.jpg);background-size:cover ; background-repeat: no-repeat;"></a>
								</div>
								<div class="col-4 col-md-4 p-1">
									<a href="#" class="img rounded" style="background-image: url(./img/inst6.jpg);background-size:cover ; background-repeat: no-repeat;"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-5 pt-4 border-top">
          <div class="col-md-6 col-lg-8">
            <p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved.</p>
          </div>
          <div class="col-md-6 col-lg-4 text-md-right">
          	<p class="copyright">This template is made with <i class="ion-ios-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">OssyBab.com</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
			</div>
</footer>




    <script src="./assets/JS/bootstrap.bundle.js"></script>
    <script src="./assets/JS/script.js"></script>
    <script>
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
            toastTrigger.addEventListener('click', () => {
            const toast = new bootstrap.Toast(toastLiveExample)

            toast.show()
        })}
    </script>



</body>
</html>