<style>

@media all and (min-width: 992px) {

.dropdown-menu li{
    position: relative;
}
.dropdown-menu .submenu{ 
    display: none;
    position: absolute;
    left:100%; top:-7px;
}
.dropdown-menu .submenu-left{ 
    right:100%; left:auto;
}

.dropdown-menu > li:hover{ background-color: #f1f1f1 }
.dropdown-menu > li:hover > .submenu{
    display: block;
}
}	
/* ============ desktop view .end// ============ */

/* ============ small devices ============ */
@media (max-width: 991px) {

.dropdown-menu .dropdown-menu{
    margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
}

}	


</style>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3 sticky-top">
    <div class="container"style="">
        <a class="navbar-brand madimi " href="./index.php">OssyBab</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form class="d-flex align-items-center w-100 form-search">
                <div class="input-group">


                    <button class="btn btn-light dropdown-toggle bg-white shadow-0" href="#" data-bs-toggle="dropdown" style="padding-bottom: 0.4rem;">  All  </button>
                        <ul class="dropdown-menu">
                        <?php

                            $sql = "SELECT * FROM categories";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $token = uniqid(); // Generate a unique token
                                $_SESSION['token'] = $token;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<li><a class='dropdown-item' href='./produit.php'>".$row['CategoryName']."</a></li> ";
                                }
                            };


                            echo"    <li><a class='dropdown-item' href='#'> Dropdown item 2 &raquo; </a>  ";
                            echo"        <ul class='submenu dropdown-menu'> ";
                            echo"            <li><a class='dropdown-item' href='#'>Submenu item 1</a></li> ";
                            echo"            <li><a class='dropdown-item' href='#'>Submenu item 2</a></li> ";
                            echo"            <li><a class='dropdown-item' href='#'>Submenu item 3</a></li> ";
                            echo"        </ul> ";
                            echo"    </li> ";
                        ?>
                        </ul>



                                    <button class="btn btn-light dropdown-toggle bg-white shadow-0" id="navbarDropdownMenuLink" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="padding-bottom: 0.4rem;">
                                        All
                                    </button>
                                    <ul class="dropdown-menu" size="2" aria-labelledby="navbarDropdownMenuLink">
                                        <?php
                                            $sql = "SELECT * FROM categories";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                $token = uniqid(); // Generate a unique token
                                                $_SESSION['token'] = $token;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<li><a class='dropdown-item' href='./produit.php'>".$row['CategoryName']."</a></li> ";
                                                }
                                            }
                                        ?>
                                    </ul>
                    <input type="search" class="form-control" placeholder="Search products, brands and categories" aria-label="Search products, brands and catégorie" aria-describedby="button-addon2" />
                </div>
                <a class="text-white p-0" href="#" id="button-addon2"><i class="fas fa-search ps-3"></i></a>
            </form>

            <ul class="navbar-nav ms-3 align-items-center">
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
                <li class="nav-item" style="width: 100px;;">
                    <div class="container">
                        <div id="user-info" class="d-flex align-items-center btn btn-primary  gap-1 p-0">
                            <img id="user-image" src="">
                            <span id="user-name"></span>
                        </div>
                        <form action="login/">
                        <button id="sign-in-btn"class="btn btn-primary sign-in-btn">Sign In</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
  </div>
</nav>

<script type="text/javascript">

ocument.addEventListener("DOMContentLoaded", function(){
        

    	/////// Prevent closing from click inside dropdown
		document.querySelectorAll('.dropdown-menu').forEach(function(element){
			element.addEventListener('click', function (e) {
			  e.stopPropagation();
			});
		})



		// make it as accordion for smaller screens
		if (window.innerWidth < 992) {

			// close all inner dropdowns when parent is closed
			document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
				everydropdown.addEventListener('hidden.bs.dropdown', function () {
					// after dropdown is hidden, then find all submenus
					  this.querySelectorAll('.submenu').forEach(function(everysubmenu){
					  	// hide every submenu as well
					  	everysubmenu.style.display = 'none';
					  });
				})
			});
			
			document.querySelectorAll('.dropdown-menu a').forEach(function(element){
				element.addEventListener('click', function (e) {
		
				  	let nextEl = this.nextElementSibling;
				  	if(nextEl && nextEl.classList.contains('submenu')) {	
				  		// prevent opening link if link needs to open dropdown
				  		e.preventDefault();
				  		console.log(nextEl);
				  		if(nextEl.style.display == 'block'){
				  			nextEl.style.display = 'none';
				  		} else {
				  			nextEl.style.display = 'block';
				  		}

				  	}
				});
			})
		}


    
</script>