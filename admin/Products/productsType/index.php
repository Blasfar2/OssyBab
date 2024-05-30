<?php
require_once '../../includes/session_test.php';
include "../../../includes/connection.php";
$adminId = $_SESSION['id'];


$productTypeData = [];

$sql = "SELECT * FROM producttypes";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $productTypeId = $row['ProductTypeID'];
        $productTypeData[$productTypeId] = [
            'TypeName' => $row['TypeName'],
            'inputs' => []
        ];

        $sqlAttributes = "SELECT * FROM productattributes WHERE ProductTypeID = $productTypeId";
        $resultAttributes = $conn->query($sqlAttributes);
        if ($resultAttributes) {
            while ($rowAttribute = $resultAttributes->fetch_assoc()) {
                $productTypeData[$productTypeId]['inputs'][] = $rowAttribute;
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link rel="stylesheet" href="../../assets/css/nav_sidebar.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <style>
        #content main .box-info .li-item {
            box-shadow: 4px 4px 16px 5px rgb(0 0 0 / 25%);
        }

        #content main .type_attr li {
            list-style: circle;

        }

        .productTypeStyle {
            height: auto;
            width: 115%;
            padding: 10px;
            border-radius: 10px;
            /* font-size: 36px; */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #64b5f61c;
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <?php include '../../includes/sidebar.php'; ?>
    <!-- /SIDEBAR -->




    <section class="content" id="content">
        <!-- NAVBAR -->
        <?php include '../../includes/navbar.php'; ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Products Type</h1>
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
                            <a href="#">Products Type</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="#" class="btn-download">
            <i class="bx bxs-cloud-download"></i>
            <span class="text">Download PDF</span>
          </a> -->
            </div>
            <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                <a href="../" class="btn btn-primary bt-sm" style="display: flex; align-items: center;">Go Back</a>
            </div>
            <div class="table-data">
                <div class="order">
                    <div class="container-fluid admin">
                        <div class="col-md-12 alert alert-primary" style="text-align: center;">Products Type</div>
                        <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                            <a href="./add_product_type.php" class="btn btn-primary bt-sm"
                                style="display: flex; align-items: center;"><i class='bx bx-plus'></i>Add New</a>
                        </div>
                        <br>

                        <?php if (!empty($productTypeData)): ?>

                            <ul class="box-info"
                                style="display: flex; grid-gap: 24px; margin-top: 36px; flex-wrap: wrap;justify-content: space-evenly;">
                                <?php foreach ($productTypeData as $productTypeId => $productType): ?>
                                    <li class="li-item">
                                        <div class="left-elements"
                                            style="display: flex; grid-gap: 24px; width: 283px;height: 100%; flex-direction: column; align-items: center;justify-content: space-between;">
                                            <!-- <i class="bx bxs-dollar-circle"></i> -->
                                            <h3 class="productTypeStyle"><?php echo $productType['TypeName']; ?></h3>
                                            <span class="text">
                                                <?php if (!empty($productType['inputs'])): ?>
                                                    <ul class="type_attr">
                                                        <?php foreach ($productType['inputs'] as $index => $input): ?>
                                                            <li style=""><?php echo $input['AttributeName'] ?> </li>
                                                        <?php endforeach; ?>
                                                    </ul>


                                                <?php endif; ?>
                                            </span>
                                            <span style="display: flex;flex-direction: row;justify-content: center;">
                                                <a href="./update_product_type.php?id=<?php echo $productTypeId; ?>"
                                                    class="btn btn-success bt-sm">Update</a>
                                            </span>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
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