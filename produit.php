<?php
include ("./includes/connection.php");

if (isset($_GET['token']) && isset($_GET['PT_id']) && isset($_GET['CT_id'])) {
    $CT_id = $_GET['CT_id'];
    $PT_id = $_GET['PT_id'];
} elseif (isset($_GET['token']) && isset($_GET['CT_id'])) {
    $CT_id = $_GET['CT_id'];
} 
if (isset($_GET['searchInput'])){
    $query = $_GET['searchInput'];
}
//     header("Location: ./");
// }




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/range.css">

</head>

<body style="background-color:#f5f5f5">

    <?php include ('./navbar.php'); ?>


    <div class="" style="margin-left: 50px;">
      

    <form action="produit.php" method="get" style="display: flex;justify-content: center;margin: 24px 0;">
            <div class="row" style="width: 80%;">
                <div class="col-4">
                    <?php $tst = (isset($_GET['max'])) ? $_GET['max'] : 0; ?>
                    <input type="number" name="min" class="form-control" placeholder="Min Price" value="">
                </div>
                <div class="col-4">
                    <input type="number" name="max" class="form-control" placeholder="Max Price" value="">
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary px-3">Filter</button>
                </div>
            </div>
        </form>



        <div class="newCard row col gap-2 col-md-12"
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
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><span class='text-primary fw-bold'>" . $row['Price'] - ($row['Price'] * $row1['ValueInteger'] / 100) . "Dhs </span> <s>" . $row['Price'] . "Dhs</s></p>";
                        } else {
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";
                        }


                        echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                       echo "       <a  href='login/'><button class='btn btn-outline-primary' id='cartButton'><i class='fa-solid fa-cart-shopping'></i></button></a>";
                        echo "       <a  href='login/'> <button class='btn btn-outline-danger ' id='heartButton'><i class='fa-regular fa-heart'></i></button></a>";
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
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><span class='text-primary fw-bold'>" . $row['Price'] - ($row['Price'] * $row1['ValueInteger'] / 100) . "Dhs </span> <s>" . $row['Price'] . "Dhs</s></p>";
                        } else {
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";
                        }


                        echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                       echo "       <a  href='login/'><button class='btn btn-outline-primary' id='cartButton'><i class='fa-solid fa-cart-shopping'></i></button></a>";
                        echo "       <a  href='login/'> <button class='btn btn-outline-danger ' id='heartButton'><i class='fa-regular fa-heart'></i></button></a>";
                        echo "    </div>";
                        echo "</div>  ";


                    }
                }
            }
            elseif (isset($_GET['min']) || isset($_GET['max'])) {
                $min = mysqli_real_escape_string($conn, $_GET['min']);
                $max = mysqli_real_escape_string($conn, $_GET['max']);

                if ($min == "") {
                    $min = 0;
                }
                if ($max == "") {
                    $max = 1000000;
                }
                if ($min > $max) {
                    $temp = $min;
                    $min = $max;
                    $max = $temp;
                }

                $sql = "SELECT * FROM products WHERE Price >= $min AND Price <= $max ORDER BY  Price";

                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='p-2 my-3 mx-2 rounded 'style='width: 15rem; height:15rem ;line-height:2px; background-color:white;position:relative ;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;' >";




                        $sql1 = "SELECT `ProductID` , `AttributeName` , `ValueInteger`   FROM productattributevalues left JOIN productattributes on productattributevalues.`AttributeID` = productattributes.`AttributeID` WHERE `ProductID`=" . $row['ProductID'] . " AND `AttributeName` = 'sold'";
                        $result1 = mysqli_query($conn, $sql1);
                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            echo "<p style='position:absolute ; right:9px; top:9px'class='bg-primary px-3 py-2 text-light rounded'>" . $row1['ValueInteger'] . "%</p>";
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><span class='text-primary fw-bold'>" . $row['Price'] - ($row['Price'] * $row1['ValueInteger'] / 100) . "Dhs </span> <s>" . $row['Price'] . "Dhs</s></p>";
                        } else {
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";
                        }

                        echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                       echo "       <a  href='login/'><button class='btn btn-outline-primary' id='cartButton'><i class='fa-solid fa-cart-shopping'></i></button></a>";
                        echo "       <a  href='login/'> <button class='btn btn-outline-danger ' id='heartButton'><i class='fa-regular fa-heart'></i></button></a>";
                        echo "    </div>";
                        echo "</div>  ";


                    }
                }

            }  elseif (isset($query)) {
                $escaped_query = htmlspecialchars($query, ENT_QUOTES, 'UTF-8');
                $sql = "SELECT * FROM products where Name LIKE '%$escaped_query%' AND IsDeleted=0";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='p-2 my-3 mx-2 rounded 'style='width: 15rem; height:15rem ;line-height:2px; background-color:white;position:relative ;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;' >";




                        $sql1 = "SELECT `ProductID` , `AttributeName` , `ValueInteger`   FROM productattributevalues left JOIN productattributes on productattributevalues.`AttributeID` = productattributes.`AttributeID` WHERE `ProductID`=" . $row['ProductID'] . " AND `AttributeName` = 'sold'";
                        $result1 = mysqli_query($conn, $sql1);
                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            echo "<p style='position:absolute ; right:9px; top:9px'class='bg-primary px-3 py-2 text-light rounded'>" . $row1['ValueInteger'] . "%</p>";
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><span class='text-primary fw-bold'>" . $row['Price'] - ($row['Price'] * $row1['ValueInteger'] / 100) . "Dhs </span> <s>" . $row['Price'] . "Dhs</s></p>";
                        } else {
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";
                        }


                        echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                        echo "       <a  href='login/'><button class='btn btn-outline-primary' id='cartButton'><i class='fa-solid fa-cart-shopping'></i></button></a>";
                        echo "       <a  href='login/'> <button class='btn btn-outline-danger ' id='heartButton'><i class='fa-regular fa-heart'></i></button></a>";
                        echo "    </div>";
                        echo "</div>  ";


                    }
                }else {
                    echo "<h2 style='text-align: center;'>No products found.</h2>";
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
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><span class='text-primary fw-bold'>" . $row['Price'] - ($row['Price'] * $row1['ValueInteger'] / 100) . "Dhs </span> <s>" . $row['Price'] . "Dhs</s></p>";
                        } else {
                            echo "<img src='./uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";
                        }


                        echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                        echo "       <a  href='login/'><button class='btn btn-outline-primary' id='cartButton'><i class='fa-solid fa-cart-shopping'></i></button></a>";
                        echo "       <a  href='login/'> <button class='btn btn-outline-danger ' id='heartButton'><i class='fa-regular fa-heart'></i></button></a>";
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



  



    <script src="./assets/JS/bootstrap.bundle.js"></script>
    <script src="./assets/JS/produit.js"></script>
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
    <script>
    document.getElementById("cartButton").addEventListener("click", function() {
        window.location.href = "login/";
    });
    document.getElementById("heartButton").addEventListener("click", function() {
        window.location.href = "login/";
    });
</script>
</body>

</html>