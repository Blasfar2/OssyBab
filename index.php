<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OssyBab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">


	<link rel="stylesheet" href="./assetes/css/styles.css">

</head>
<body>


                                                                    <!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand madimi " href="#">OssyBab</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form class="d-flex align-items-center w-100 form-search">
                <div class="input-group">
                                    <button class="btn btn-light dropdown-toggle bg-white shadow-0" id="navbarDropdownMenuLink" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="padding-bottom: 0.4rem;">
                                        All
                                    </button>
                                    <ul class="dropdown-menu" size="2" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">Departement</a></li>
                                        <li><a class="dropdown-item" href="#">Supermaker</a></li>
                                        <li><a class="dropdown-item" href="#">Health & Beauty</a></li>
                                        <li><a class="dropdown-item" href="#">Home & Office</a></li>
                                        <li><a class="dropdown-item" href="#">Appliance</a></li>
                                        <li><a class="dropdown-item" href="#">Phone & Tablets</a></li>
                                        <li><a class="dropdown-item" href="#">Computing</a></li>
                                        <li><a class="dropdown-item" href="#">Electronics</a></li>
                                        <li><a class="dropdown-item" href="#">Fashion</a></li>
                                        <li><a class="dropdown-item" href="#">Baby Products</a></li>
                                        <li><a class="dropdown-item" href="#">Gaming</a></li>
                                        <li><a class="dropdown-item" href="#">Sporting Goods</a></li>
                                        <li><a class="dropdown-item" href="#">Other Categories</a></li>
                                    </ul>
                <input type="search" class="form-control" placeholder="Search products, brands and categories" aria-label="Search products, brands and catégorie" aria-describedby="button-addon2" />
                </div>
                <a class="text-white p-0" href="#" id="button-addon2"><i class="fas fa-search ps-3"></i></a>
            </form>

            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                <button 
                    class="nav-link d-flex align-items-center me-3 position-relative"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#Id2"
                    aria-controls="Id2"
                    >
                    <i class="fa fa-cart-shopping pe-2 "></i>Cart
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger s-2">
                    2
                </button>
                </li>
                <li class="nav-item" style="width: 65px;">
                <a class="nav-link d-flex align-items-center" href="#!">Sign In</a>
                </li>
            </ul>
        </div>
  </div>
</nav>


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
    <div>I will not close if you click outside of me.</div>
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
        <div class="col mt-3 ">
            <div class="card text-center border-primary" style="">
            <div class="card-body">
                <h5 class="card-title text-primary">Supermaker</h5>
            </div>
            <img src="./img/superMaker.jpg" class="card-img-bottom">
            </div>
        </div>
        <div class="col mt-3">
            <div class="card text-center border-primary" style="width:18rem;">
            <div class="card-body">
                <h5 class="card-title text-primary">Health & Beauty</h5>
            </div>
            <img src="./img/Health & Beauty.jpg" class="card-img-bottom">
            </div>
        </div>
        <div class="col mt-3">
            <div class="card text-center border-primary" style="width:18rem;">
            <div class="card-body">
                <h5 class="card-title text-primary">Home & Office</h5>
            </div>
            <img src="./img/Home & Office.jpg" class="card-img-bottom">
            </div>
        </div>
        <div class="col mt-3">
            <div class="card text-center border-primary" style="width:18rem;">
            <div class="card-body">
                <h5 class="card-title text-primary">Appliance</h5>
            </div>
            <img src="./img/Appliance.jpg" class="card-img-bottom">
            </div>
        </div>
        <div class="col mt-3 ">
            <div class="card text-center border-primary" style="width:18rem;">
            <div class="card-body">
                <h5 class="card-title text-primary">Phone & Tablets</h5>
            </div>
            <img src="./img/Phone & Tablets.jpg" class="card-img-bottom">
            </div>
        </div>
        <div class="col mt-3">
            <div class="card text-center border-primary" style="width:18rem;">
            <div class="card-body">
                <h5 class="card-title text-primary">Computing</h5>
            </div>
            <img src="./img/Computing.jpg" class="card-img-bottom">
            </div>
        </div>
        <div class="col mt-3">
            <div class="card text-center border-primary" style="width:18rem;">
            <div class="card-body">
                <h5 class="card-title text-primary">Electronics</h5>
            </div>
            <img src="./img/Electronics.jpg" class="card-img-bottom">
            </div>
        </div>
        <div class="col mt-3">
            <div class="card text-center border-primary" style="width:18rem;">
            <div class="card-body">
                <h5 class="card-title text-primary">Fashion</h5>
            </div>
            <img src="./img/Fashion.jpg" class="card-img-bottom">
            </div>
        </div>
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
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