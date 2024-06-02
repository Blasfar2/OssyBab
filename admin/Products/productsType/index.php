<?php
require_once '../../includes/session_test.php';
include "../../../includes/connection.php";
$adminId = $_SESSION['id'];


$productTypeData = [];

$sql = "SELECT * FROM producttypes where IsDeleted = 0";
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
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link rel="stylesheet" href="../../assets/css/nav_sidebar.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <style>
          ul {
            padding-left: 0rem;
        }

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


    <!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="process.php" method="post">
                <div class="modal-body">
                    <p>Are you sure you want to DELETE this product Type?</p>
                    <input type="hidden" name="product_type_id" id="productTypeIdInput">
                    <h2 style="text-align: center;" id="typeNameSpan"></h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="delete">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>


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
                    <?php
                        if (isset($_SESSION['info'])) {
                            ?>
                            <div id="infoAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['info']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php
                            unset($_SESSION['info']);
                        }

                        if (isset($_SESSION['error'])) {
                            ?>
                            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['error']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php
                            unset($_SESSION['error']);
                        }

                        ?>
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
                                            <span style="width: 100%;display: flex;justify-content: space-around;">
                                                <a href="./update_product_type.php?id=<?php echo $productTypeId; ?>"
                                                    class="btn btn-success bt-sm">Update</a>
                                                <a href="javascript:void(0);"
                                                    onclick="openConfirmationModal(<?php echo $productTypeId; ?>, '<?php echo $productType['TypeName']; ?>');"
                                                    class="btn btn-danger bt-sm">Delete</a>

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

        function openConfirmationModal(productTypeId, typeName) {
            // Show the modal
            $('#exampleModal').modal('show');
            // Set product type ID and type name
            $('#productTypeIdInput').val(productTypeId);
            $('#typeNameSpan').text(typeName);
        }

        setTimeout(function () {
            var infoAlert = document.getElementById('infoAlert');
            if (infoAlert) {
                var bsAlert = new bootstrap.Alert(infoAlert);
                bsAlert.close();
            }
        }, 1500);

        // Automatically dismiss the error alert after 3 seconds
        setTimeout(function () {
            var errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                var bsAlert = new bootstrap.Alert(errorAlert);
                bsAlert.close();
            }
        }, 1500);

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