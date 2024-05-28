<?php
    include ("./includes/connection.php");
?>

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
    <link rel="stylesheet" href="./assets/css/range.css">

</head>
<body style="background-color:#f5f5f5">

    <?php include ('./navbar.php'); ?>

    <div class="row">
    <div class="d-flex col-3 flex-column z-3 sticky-top" style="height:80vh ; top:10vh"> 
            <div class="btn-group container align-items-center"style="height:5rem">
                
            <a class="btn btn-primary  " style="" href="#" role="button">Rest</a>
            <a class="btn btn-primary  " href="#" role="button">Rest</a>

            </div>        

            <div class="categorie mx-3 p-2 rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background-color:white;">
                <h3 class="text-primary">Categorie</h3>
                <div class="form-check">
                  <div class=" px-4">
                    <input type="checkbox" class="form-check-input" name="Supermaker" id="Supermaker" value="checkedValue" checked>
                    Supermaker <br>
                    <input type="checkbox" class="form-check-input" name="Health" id="Health" value="checkedValue" >
                    Health & Beauty <br>
                    <input type="checkbox" class="form-check-input" name="Home" id="Home" value="checkedValue">
                    Home & Office <br>
                    <input type="checkbox" class="form-check-input" name="Appliance" id="Appliance" value="checkedValue" >
                    Appliance <br>
                    <input type="checkbox" class="form-check-input" name="Phone" id="Phone" value="checkedValue" checked>
                    Phone & Tablets <br>
                    <input type="checkbox" class="form-check-input" name="Computing" id="Computing" value="checkedValue" >
                    Computing <br>
                    <input type="checkbox" class="form-check-input" name="Electronics" id="Electronics" value="checkedValue" checked>
                    Home & Office <br>
                    <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                    Home & Office <br>
                    <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue>
                    Home & Office <br>
                    <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                    Home & Office <br>
                    <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                    Home & Office <br>
                    
                  </div>
                </div>
            </div>
            <div class="categorie mx-3 mt-3 p-2 rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background-color:white;">
                <h3 class="text-primary">Prix</h3>
                <div class="double-slider-box">
                    <div class="range-slider">
                        <span class="slider-track"></span>
                        <input type="range" name="min-val" class="min-val" min="1000" max="12000" value="2000" oninput="slideMin()">
                        <input type="range" name="max-val" class="max-val" min="1000" max="12000" value="8000" oninput="slideMax()">
                        <div class="tooltip min-tooltip"></div>
                        <div class="tooltip max-tooltip"></div>
                    </div>
                    <div class="input-box">
                        <div class="min-box">
                            <div class="input-wrap">
                                <span class="input-addon">Dh</span>
                                <input type="text" name="min-input" class="input-field min-input" onchange="setMinInput()">
                            </div>
                        </div>
                        <div class="max-box">
                            <div class="input-wrap">
                                <span class="input-addon">Dh</span>
                                <input type="text" name="max-input" class="input-field max-input" onchange="setMaxInput()">
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        
        
        
        
    
    
    
    
    
    
    
    </div>
    <div class="newCard col-8 gap-2 h-100   " style="
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;">

        <!-- ---------------------------- -->
        <div class="p-2 m-3 rounded "style="width: 15rem; height:15rem ;line-height:2px; background-color:white ;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;" >
    
                    <img src="./assets/img/samsang.jpg" style="width:100% ; height:59%;object-fit: contain;" class=" rounded">
                        <p style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis;" class="py-2">Samsang Galaxay note a 2 Gm35 dedede</p>
                        <p><span class="text-primary fw-bold">15Dhs</span> <s>20Dhs</s></p>
                        <div style="display: flex;justify-content: flex-end;gap: 5px;">
                        <button class="btn btn-outline-primary"><i class="fa-solid fa-cart-shopping"></i></button>
                        <button class="btn btn-outline-danger "><i class="fa-regular fa-heart"></i></button>
                        </div>
        
        </div>
        <!-- ---------------------------- -->
    
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
    <script src="./assets/JS/range.js"></script>
    <script src="./assets/JS/produit.js"></script>
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