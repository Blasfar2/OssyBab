<?php
require_once '../includes/session_test.php';
include ("../includes/connection.php");
$adminId = $_SESSION['id'];

if (isset($_GET['token']) && isset($_GET['PT_id']) && isset($_GET['CT_id'])) {
    $CT_id = $_GET['CT_id'];
    $PT_id = $_GET['PT_id'];
} elseif (isset($_GET['token']) && isset($_GET['CT_id'])) {
    $CT_id = $_GET['CT_id'];
} else {

}
// else {
//     header("Location: ./");
// }

if (isset($_POST['add_to_wishlist'])) {
    $wishlistUserID = $_POST['wishlist_user_id'];
    $wishlistProductID = $_POST['wishlist_product_id'];

    $check_sql = "SELECT WishlistItemID FROM wishlistitems WHERE UserID = '$wishlistUserID' AND ProductID = '$wishlistProductID'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM wishlistitems WHERE UserID = '$wishlistUserID' AND ProductID = '$wishlistProductID'";
        if ($conn->query($delete_sql) === TRUE) {
            $_SESSION['info'] = "Item removed from wishlist successfully";
            header("Location: produit.php");
        } else {
            $_SESSION['error'] = "Error deleting record: " . $conn->error;
        }
    } else {
        $insert_sql = "INSERT INTO wishlistitems (UserID, ProductID) VALUES ('$wishlistUserID', '$wishlistProductID')";
        if ($conn->query($insert_sql) === TRUE) {
            $_SESSION['info'] = "Item added to wishlist successfully";
            header("Location: produit.php");
        } else {
            $_SESSION['error'] = "Error inserting record: " . $conn->error;
        }
    }

}
if (isset($_POST['add_to_buy'])) {
    $buyUserID = $_POST['buy_user_id'];
    $buyProductID = $_POST['buy_product_id'];
    $check_sql = "SELECT CartItemID, Quantity FROM cartitems WHERE UserID = '$buyUserID' AND ProductID = '$buyProductID'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity = $row['Quantity'] + 1; 
        $update_sql = "UPDATE cartitems SET Quantity = $quantity WHERE UserID = '$buyUserID' AND ProductID = '$buyProductID'";
        if ($conn->query($update_sql) === TRUE) {
            $_SESSION['info'] = "Item quantity updated successfully";
            header("Location: produit.php");
        } else {
            $_SESSION['error'] = "Error updating record: " . $conn->error;
        }
    } else {
        $insert_sql = "INSERT INTO cartitems (UserID, ProductID, Quantity) VALUES ('$buyUserID', '$buyProductID', 1)";
        if ($conn->query($insert_sql) === TRUE) {
            $_SESSION['info'] = "Item added to buy successfully";
            header("Location: produit.php");
        } else {
            $_SESSION['error'] = "Error inserting record: " . $conn->error;
        }
    }
}

if (isset($_POST['deletCart'])) {
    $deletCart_UserID = $_POST['deletCart_user_id'];
    $deletCart_ProductID = $_POST['deletcart_product_id'];

    $delete_sql = "DELETE FROM cartitems WHERE UserID = '$deletCart_UserID' AND ProductID = '$deletCart_ProductID'";

    if ($conn->query($delete_sql)  === TRUE) {
        $_SESSION['info'] = "Item removed from cart successfully";
        header("Location: produit.php");
        exit;
    } else {
        $_SESSION['error'] = "Error deleting record: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- <link rel="stylesheet" href="../assets/css/styles.css"> -->

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/range.css">
    <link rel="stylesheet" href="style.css">

      <!-- STYLE OFFCANVAS -->
  <link rel="stylesheet" href="./offcanvas/styles.css">

</head>

<body style="background-color:#f5f5f5">

    <?php include ('navbar.php'); ?>


    <?php include ('./offcanvas/index.php');?>


    <div class="row">

        <div class="row col-xl-3 col-md-9 mt-3 ">


            <div class=" col  z-3 sticky-top">


                <div class="btn-group container align-items-center" style="">
                    <a class="btn btn-primary " style="" href="#" role="button">Rest</a>
                    <a class="btn btn-primary " href="#" role="button">Sumbit</a>
                </div>

                <div class="categorie mx-3 mt-3 p-2 rounded col"
                    style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background-color:white;">
                    <h3 class="text-primary">Prix</h3>
                    <div class="double-slider-box">
                        <div class="range-slider">
                            <span class="slider-track"></span>
                            <input type="range" name="min-val" class="min-val" min="1000" max="12000" value="2000"
                                oninput="slideMin()">
                            <input type="range" name="max-val" class="max-val" min="1000" max="12000" value="8000"
                                oninput="slideMax()">
                            <div class="tooltip min-tooltip"></div>
                            <div class="tooltip max-tooltip"></div>
                        </div>
                        <div class="input-box">
                            <div class="min-box">
                                <div class="input-wrap">
                                    <span class="input-addon">Dh</span>
                                    <input type="text" name="min-input" class="input-field min-input"
                                        onchange="setMinInput()">
                                </div>
                            </div>
                            <div class="max-box">
                                <div class="input-wrap">
                                    <span class="input-addon">Dh</span>
                                    <input type="text" name="max-input" class="input-field max-input"
                                        onchange="setMaxInput()">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                <?php

                if (isset($PT_id)) {

                    $sql1 = "SELECT * 
                            FROM producttypecategories 
                            LEFT JOIN productattributes 
                            ON producttypecategories.`ProductTypeID` = productattributes.`ProductTypeID`
                            WHERE producttypecategories.`CategoryID` = $CT_id 
                            AND producttypecategories.`ProductTypeID` = $PT_id";

                    $result1 = mysqli_query($conn, $sql1);


                    if ($result1 && mysqli_num_rows($result1) > 0) {

                        while ($row1 = mysqli_fetch_assoc($result1)) {

                            $Attribute_ID = $row1['AttributeID'];
                            $dataType = 'Value' . ucwords($row1['DataType']);

                            $sql2 = "SELECT * FROM productattributevalues WHERE `AttributeID` = $Attribute_ID";
                            $result2 = mysqli_query($conn, $sql2);

                            echo "<div class='col m-4 p-3 rounded' style='box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background-color:white; '>";
                            echo "<h3 class='text-primary'>" . $row1["AttributeName"] . "</h3>";


                            if ($result2 && mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    if (isset($row2[$dataType])) {

                                        echo "<div class='form-check'>";
                                        echo "<input class='form-check-input' type='checkbox' value='" . $Attribute_ID . "' name='" . $Attribute_ID . "'>";
                                        echo "<label class='form-check-label' >";  //<--for='flexCheckDefault'
                                        echo $row2[$dataType];
                                        echo "</label>";
                                        echo "</div>";

                                    }
                                }
                            } else {
                                echo "<p>No Data , coming soon</p>";
                            }
                            echo "</div>";
                        }
                    }



                } elseif (isset($CT_id)) {
                    $sql1 = "SELECT * 
                            FROM producttypecategories 
                            LEFT JOIN productattributes 
                            ON producttypecategories.`ProductTypeID` = productattributes.`ProductTypeID`
                            WHERE producttypecategories.`CategoryID` = $CT_id ";
                    $result1 = mysqli_query($conn, $sql1);

                    if ($result1 && mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $Attribute_ID = $row1['AttributeID'];
                            $dataType = 'Value' . ucwords($row1['DataType']);
                            $sql2 = "SELECT * FROM productattributevalues WHERE `AttributeID` = $Attribute_ID";
                            $result2 = mysqli_query($conn, $sql2);
                            echo "<div class='col m-4 p-3 rounded' style='box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background-color:white;'>";
                            echo "<h3 class='text-primary'>" . $row1["AttributeName"] . "</h3>";
                            if ($result2 && mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    if (isset($row2[$dataType])) {
                                        echo "<div class='form-check'>";
                                        echo "<input class='form-check-input' type='checkbox' value='" . $Attribute_ID . "' name='" . $Attribute_ID . "'>";
                                        echo "<label class='form-check-label' >";  //<--for='flexCheckDefault'
                                        echo $row2[$dataType];
                                        echo "</label>";
                                        echo "</div>";
                                    }
                                }
                            } else {
                                echo "<p>No Data , coming soon</p>";
                            }
                            echo "</div>";
                        }
                    }

                } else {
                    $sql1 = "SELECT * FROM productattributes";

                    $result1 = mysqli_query($conn, $sql1);


                    if ($result1 && mysqli_num_rows($result1) > 0) {

                        while ($row1 = mysqli_fetch_assoc($result1)) {

                            $Attribute_ID = $row1['AttributeID'];
                            $dataType = 'Value' . ucwords($row1['DataType']);

                            $sql2 = "SELECT * FROM productattributevalues WHERE `AttributeID` = $Attribute_ID";
                            $result2 = mysqli_query($conn, $sql2);

                            echo "<div class='col m-4 p-3 rounded' style='box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background-color:white; '>";
                            echo "<h3 class='text-primary'>" . $row1["AttributeName"] . "</h3>";


                            if ($result2 && mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    if (isset($row2[$dataType])) {

                                        echo "<div class='form-check'>";
                                        echo "<input class='form-check-input' type='checkbox' value='" . $Attribute_ID . "' name='" . $Attribute_ID . "'>";
                                        echo "<label class='form-check-label' >";  //<--for='flexCheckDefault'
                                        echo $row2[$dataType];
                                        echo "</label>";
                                        echo "</div>";

                                    }
                                }
                            } else {
                                echo "<p>No Data , coming soon</p>";
                            }
                            echo "</div>";
                        }
                    }

                }
                ?>




            </div>
        </div>





        <div class="newCard row col gap-2 col-md-9"
            style="display: flex;flex-wrap: wrap;justify-content: flex-start;align-content: flex-start;">
     
            <!-- ---------------------------- -->

            <?php

            if (isset($PT_id)) {
                $sql = "SELECT products.Name,products.ProductID,products.Price,products.ProductImage,producttypecategories.CategoryID,products.ProductTypeID
                    FROM products
                    LEFT JOIN producttypecategories
                    ON products.ProductTypeID = producttypecategories.ProductTypeID WHERE producttypecategories.`CategoryID` =$CT_id AND products.`ProductTypeID`=$PT_id ";

                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='p-2 my-3 mx-2 rounded 'style='width: 15rem; height:15rem ;line-height:2px; background-color:white;position:relative ;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;' >";




                        $sql1 = "SELECT `ProductID` , `AttributeName` , `ValueInteger`   FROM productattributevalues left JOIN productattributes on productattributevalues.`AttributeID` = productattributes.`AttributeID` WHERE `ProductID`=" . $row['ProductID'] . " AND `AttributeName` = 'sold'";
                        $result1 = mysqli_query($conn, $sql1);
                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            echo "<p style='position:absolute ; right:9px; top:9px'class='bg-primary px-3 py-2 text-light rounded'>" . $row1['ValueInteger'] . "%</p>";
                            echo "<img src='../uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><span class='text-primary fw-bold'>" . $row['Price'] - ($row['Price'] * $row1['ValueInteger'] / 100) . "Dhs </span> <s>" . $row['Price'] . "Dhs</s></p>";
                        } else {
                            echo "<img src='../uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";
                        }


                        echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                        echo "       <form method='post'>";
                        echo "          <input type='hidden' name='buy_product_id' value='" . $row['ProductID'] . "'>";
                        echo "          <input type='hidden' name='buy_user_id' value='" . $adminId . "'>";
                        echo "        <button class='btn btn-outline-primary' name='add_to_buy'><i class='fa-solid fa-cart-shopping'></i></button>";
                        echo "        </form>";                        
                        echo "       <form method='post'>";
                        echo "          <input type='hidden' name='wishlist_product_id' value='" . $row['ProductID'] . "'>";
                        echo "          <input type='hidden' name='wishlist_user_id' value='" . $adminId . "'>";
                        echo "          <button class='btn btn-outline-danger' name='add_to_wishlist' id='favorite'><i class='fa-regular fa-heart'></i></button>";
                        echo "        </form>";
                        echo "    </div>";
                        echo "</div>  ";


                    }
                }




            } elseif (isset($CT_id)) {
                $sql = "SELECT `Name` ,`ProductID`, `Price` , `ProductImage` , `CategoryID`
                    FROM products 
                    LEFT JOIN producttypecategories 
                    ON products.`ProductTypeID`=producttypecategories.`ProductTypeID` 
                    WHERE `CategoryID`=$CT_id";

                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='p-2 my-3 mx-2 rounded 'style='width: 15rem; height:15rem ;line-height:2px; background-color:white;position:relative ;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;' >";




                        $sql1 = "SELECT `ProductID` , `AttributeName` , `ValueInteger`   FROM productattributevalues left JOIN productattributes on productattributevalues.`AttributeID` = productattributes.`AttributeID` WHERE `ProductID`=" . $row['ProductID'] . " AND `AttributeName` = 'sold'";
                        $result1 = mysqli_query($conn, $sql1);
                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            echo "<p style='position:absolute ; right:9px; top:9px'class='bg-primary px-3 py-2 text-light rounded'>" . $row1['ValueInteger'] . "%</p>";
                            echo "<img src='../uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><span class='text-primary fw-bold'>" . $row['Price'] - ($row['Price'] * $row1['ValueInteger'] / 100) . "Dhs </span> <s>" . $row['Price'] . "Dhs</s></p>";
                        } else {
                            echo "<img src='../uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";
                        }


                        echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                        echo "       <form method='post'>";
                        echo "          <input type='hidden' name='buy_product_id' value='" . $row['ProductID'] . "'>";
                        echo "          <input type='hidden' name='buy_user_id' value='" . $adminId . "'>";
                        echo "        <button class='btn btn-outline-primary' name='add_to_buy'><i class='fa-solid fa-cart-shopping'></i></button>";
                        echo "        </form>";                        
                        echo "       <form method='post'>";
                        echo "          <input type='hidden' name='wishlist_product_id' value='" . $row['ProductID'] . "'>";
                        echo "          <input type='hidden' name='wishlist_user_id' value='" . $adminId . "'>";
                        echo "          <button class='btn btn-outline-danger' name='add_to_wishlist' id='favorite'><i class='fa-regular fa-heart'></i></button>";
                        echo "        </form>";
                        echo "    </div>";
                        echo "</div>  ";


                    }
                }
            } else {
                $sql = "SELECT * FROM products";

                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='p-2 my-3 mx-2 rounded 'style='width: 15rem; height:15rem ;line-height:2px; background-color:white;position:relative ;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;' >";




                        $sql1 = "SELECT `ProductID` , `AttributeName` , `ValueInteger`   FROM productattributevalues left JOIN productattributes on productattributevalues.`AttributeID` = productattributes.`AttributeID` WHERE `ProductID`=" . $row['ProductID'] . " AND `AttributeName` = 'sold'";
                        $result1 = mysqli_query($conn, $sql1);
                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            echo "<p style='position:absolute ; right:9px; top:9px'class='bg-primary px-3 py-2 text-light rounded'>" . $row1['ValueInteger'] . "%</p>";
                            echo "<img src='../uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><span class='text-primary fw-bold'>" . $row['Price'] - ($row['Price'] * $row1['ValueInteger'] / 100) . "Dhs </span> <s>" . $row['Price'] . "Dhs</s></p>";
                        } else {
                            echo "<img src='../uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";
                        }


                        echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                        echo "       <form method='post'>";
                        echo "          <input type='hidden' name='buy_product_id' value='" . $row['ProductID'] . "'>";
                        echo "          <input type='hidden' name='buy_user_id' value='" . $adminId . "'>";
                        echo "        <button class='btn btn-outline-primary' name='add_to_buy'><i class='fa-solid fa-cart-shopping'></i></button>";
                        echo "        </form>";
                        echo "       <form method='post'>";
                        echo "          <input type='hidden' name='wishlist_product_id' value='" . $row['ProductID'] . "'>";
                        echo "          <input type='hidden' name='wishlist_user_id' value='" . $adminId . "'>";
                        echo "          <button class='btn btn-outline-danger' name='add_to_wishlist' id='favorite'><i class='fa-regular fa-heart'></i></button>";
                        echo "        </form>";
                        echo "    </div>";
                        echo "</div>  ";


                    }
                }

            }


            ?>

            <!-- ---------------------------- -->

        </div>
    </div>
    </div>



    <!-- <div class="offcanvas offcanvas-end" data-bs-scroll="false" tabindex="-1" id="Id2"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body ">

            <hr>
            <div class="row align-items-center">
                <div class="col-4 p-1 ">
                    <img src="./img/Fashion.jpg" class="rounded-2 "
                        style="width: 100px; height: 100px; object-fit: cover;">
                </div>

                <div class="col-auto">
                    <div class="text-center">
                        <div><strong> Xiamio n-12</strong></div>
                        <div><strong>Prix : </strong>15£</div>
                        <div><strong>Categorie : </strong>Phone & Tablets</div>
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
                    <img src="./img/Fashion.jpg" class="rounded-2 "
                        style="width: 100px; height: 100px; object-fit: cover;">
                </div>

                <div class="col-auto">
                    <div class="text-center">
                        <div><strong> Xiamio n-12</strong></div>
                        <div><strong>Prix : </strong>15£</div>
                        <div><strong>Categorie : </strong>Phone & Tablets</div>
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




    </div> -->

          <!-- script offcanvas -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="offcanvas/scripts.js"></script>


    <script type="text/javascript" src="../assets/JS/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="../assets/JS/script.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="../assets/JS/range.js"></script>
    <script type="text/javascript" src="../assets/JS/produit.js"></script>
    <script>
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
            toastTrigger.addEventListener('click', () => {
                const toast = new bootstrap.Toast(toastLiveExample)

                toast.show()
            })
        }
    </script>
</body>

</html>