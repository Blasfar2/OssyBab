<?php
require_once '../../includes/session_test.php';
include "../../../includes/connection.php";
$adminId = $_SESSION['id'];
if (isset($_GET['prod_id'])) {
    $product_id = $_GET['prod_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link rel="stylesheet" href="../../assets/css/nav_sidebar.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <style>
        ul {
            padding-left: 0rem;
        }

        .img-showcase {
            display: flex;
            border-radius: 10px;
            /* width: 100%; */
            transition: all 0.5s ease;
            justify-content: center;
        }

        .img-showcase img {
            border-radius: 40px;
            width: 85%;
        }

        .product-content {
            padding: 2rem 1rem;
        }

        .product-title {
            font-size: 3rem;
            text-transform: capitalize;
            font-weight: 700;
            position: relative;
            color: #12263a;
            margin: 1rem 0;
        }

        .product-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 80px;
            background: #12263a;
        }

        .product-price {
            margin: 1rem 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .product-price span {
            font-weight: 400;
        }

        .new-price span {
            color: #256eff;
        }

        .product-detail h2,
        h3 {
            text-transform: capitalize;
            color: #12263a;
            padding-bottom: 0.6rem;
        }

        .product-detail p {
            font-size: 0.9rem;
            padding: 0.3rem;
            opacity: 0.8;
        }

        .product-detail ul {
            margin: 1rem 0;
            font-size: 0.9rem;
        }

        .product-detail ul li {
            margin: 0;
            list-style: none;
            background: url(checked.png) left center no-repeat;
            background-size: 18px;
            padding-left: 1.7rem;
            margin: 0.4rem 0;
            font-weight: 600;
            opacity: 0.9;
        }

        .product-detail ul li span {
            font-weight: 400;
        }

        /* @media screen and (min-width: 992px) { */
        .card {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5rem;
        }

        .card-wrapper {
            /* height: 100vh; */
            display: flex;
            justify-content: center;
            align-items: center;
            width: 67%;
        }

        .product-imgs {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-content {
            padding-top: 0;
        }

        /* } */
    </style>
</head>

<body>


    <!-- SIDEBAR -->
    <?php include ('../../includes/sidebar.php'); ?>
    <!-- /SIDEBAR -->

    <section class="content" id="content">
        <!-- NAVBAR -->
        <?php include ('../../includes/navbar.php'); ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Products List</h1>
                    <ul class="dreadleft">
                        <li>
                            <a class="active" href="../../dashboard/">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="../">Products</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="#">Products List</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="#" class="btn-download">
            <i class="bx bxs-cloud-download"></i>
            <span class="text">Download PDF</span>
          </a> -->
            </div>
            <div class="table-data">
                <div class="order">
                    <div class="container-fluid admin"
                        style="display: flex;flex-direction: column;align-items: center;">
                        <div style="width: 100%;display: flex;flex-direction: row;justify-content: flex-end;">
                            <a href="./" class="btn btn-primary bt-sm" style="display: flex; align-items: center;">Go
                                Back</a>
                        </div>
                        <br>

                        <?php
                        $sql = "SELECT p.*, pt.TypeName FROM products p
            LEFT JOIN producttypes pt ON p.ProductTypeID = pt.ProductTypeID
            WHERE p.ProductID = $product_id";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);

                            // Assign values to variables
                            $productName = $row['Name'];
                            $productImage = $row['ProductImage'];
                            $productId = $row['ProductID'];
                            $productPrice = $row['Price'];
                            $productStock = $row['Stock'];
                            $productDescription = $row['Description'];
                            $productTypeName = $row['TypeName'];
                            $ProductTypeID = $row['ProductTypeID'];
                        }
                        ?>

                        <div class="card-wrapper">
                            <div class="card">
                                <!-- card left -->
                                <div class="product-imgs">
                                    <div class="img-display">
                                        <div class="img-showcase">
                                            <img src="../../../uploads/<?php echo $productImage; ?>" alt="shoe image" />
                                        </div>
                                    </div>
                                </div>

                                <!-- card right -->
                                <div class="product-content">
                                    <h2 class="product-title"><?php echo $productName; ?></h2>

                                    <div class="product-price">
                                        <p>ID: <span><?php echo $productId; ?></span></p>
                                        <p>Price: <span><?php echo $productPrice; ?> DH</span></p>
                                        <p>Qty Stock: <span><?php echo $productStock; ?></span></p>
                                    </div>

                                    <div class="product-detail">

                                        <h2>about this item:</h2>
                                        <?php if (!empty($productDescription)): ?>
                                            <p><?php echo $productDescription; ?></p>
                                        <?php else: ?>
                                            <p>No description found.</p>
                                        <?php endif; ?>

                                        <br />
                                        <h3>Product Info:
                                            <?php
                                            // echo $productTypeName; 
                                            ?>
                                        </h3>

                                        <ul>
                                            <li>Product Type:
                                                <span>
                                                    <?php
                                                    echo $productTypeName;
                                                    ?>
                                                </span>
                                            </li>
                                            <?php
                                            // Fetch and display product attributes
                                            $sqlAttributes = "SELECT pa.AttributeName, pav.ValueString, pav.ValueInteger, pav.ValueDecimal, pav.ValueBoolean, pav.ValueDate 
                                                                FROM productattributes pa 
                                                                LEFT JOIN productattributevalues pav ON pa.AttributeID = pav.AttributeID 
                                                                LEFT JOIN products p ON pav.ProductID = p.ProductID 
                                                                WHERE p.ProductID = $productId AND p.ProductTypeID = $ProductTypeID AND pa.ProductTypeID =$ProductTypeID";
                                            $resultAttributes = mysqli_query($conn, $sqlAttributes);
                                            while ($rowAttribute = mysqli_fetch_assoc($resultAttributes)) {
                                                echo "<li>" . $rowAttribute['AttributeName'] . ": <span>";
                                                if ($rowAttribute['ValueString'] !== null) {
                                                    echo $rowAttribute['ValueString'];
                                                } elseif ($rowAttribute['ValueInteger'] !== null) {
                                                    echo $rowAttribute['ValueInteger'];
                                                } elseif ($rowAttribute['ValueDecimal'] !== null) {
                                                    echo $rowAttribute['ValueDecimal'];
                                                } elseif ($rowAttribute['ValueBoolean'] !== null) {
                                                    echo $rowAttribute['ValueBoolean'] ? 'True' : 'False';
                                                } elseif ($rowAttribute['ValueDate'] !== null) {
                                                    echo $rowAttribute['ValueDate'];
                                                }
                                                echo "</span></li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <script src="../../assets/js/script.js"></script>
    <script>

        //update the link of the sidebar and the nav links
        $(document).ready(function () {
            $('.nav-list a').each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', '../' + href);
            });
            $('.profile-image img').each(function () {
                var profile = $(this).attr('src');
                $(this).attr('src', '../' + profile);
            });

            $('.profile-link a').each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', '../' + href);
            });
        });

    </script>
</body>

</html>