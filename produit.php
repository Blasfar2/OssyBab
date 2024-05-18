<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/styles.css">

</head>
<body>

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
                                        <button class="btn btn-light dropdown-toggle bg-white shadow-0" id="navbarDropdownMenuLink" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false" style="padding-bottom: 0.4rem;">
                                            All
                                        </button>
                                        <ul class="dropdown-menu" size="2" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a class="dropdown-item" href="./produit.php">Departement</a></li>
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
                            <button id="sign-in-btn" class="btn btn-primary ">Sign In</button>
                        </div>
                    </li>
                </ul>
            </div>
      </div>
    </nav>

    <div class="row">
    <div class="col-3">
        
        
        
        
        
        
    
    
    
    
    
    
    
    </div>
    <div class="row row-cols-4  col-8 justify-content-around align-items-center g-2 text-center">

        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>
        <div class="col text-center p-4">
            <div class="card">
                    <img src="./img/inst1.jpg" style="width: 16rem;" class="rounded w-100">
                    <p class="pt-1"><strong>Xiamio g</strong></p>
                    <p><strong>Categorie :</strong>15$</p>
                    <p><strong>Prix :</strong>15$</p>
                    <button class="btn btn-primary m-2">Add</button>
            </div>
        </div>

    
    </div>
</div>




    <div class="offcanvas offcanvas-end" data-bs-scroll="false" tabindex="-1" id="Id2" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Cart</h5>
        <button type="button" class="btn-close"data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body ">

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
    


    <script src="./assets/JS/bootstrap.bundle.js"></script>
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