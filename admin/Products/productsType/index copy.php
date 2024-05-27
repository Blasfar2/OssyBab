<?php
require_once '../../includes/session_test.php';
include "../../../includes/connection.php"; // Adjust the path to your connection file
$adminId = $_SESSION['id'];

$productTypeData = [];

$sql = "SELECT pt.*, pa.* FROM producttypes pt LEFT JOIN productattributes pa ON pt.ProductTypeID  = pa.ProductTypeID ";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $productTypeId = $row['producttype_id'];
        if (!isset($productTypeData[$productTypeId])) {
            $productTypeData[$productTypeId] = [
                'TypeName' => $row['TypeName'],
                'inputs' => []
            ];
        }
        $productTypeData[$productTypeId]['inputs'][] = $row;
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
        #content main .box-info li {
            box-shadow: 4px 4px 16px 5px rgb(0 0 0 / 25%);
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
            <?php if (!empty($productTypeData)): ?>
                <?php foreach ($productTypeData as $productTypeId => $productType): ?>
                    <div class="table-data">
                        <div class="order">
                            <div class="container-fluid admin">
                                <div class="col-md-12 alert alert-primary" style="text-align: center;"><?php echo $productType['TypeName']; ?></div>
                                <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                                    <a href="./add_product_type.php?id=<?php echo $productTypeId; ?>" class="btn btn-primary bt-sm" style="display: flex; align-items: center;"><i class='bx bx-plus'></i>Add New</a>
                                </div>
                                <br>
                                <?php if (!empty($productType['inputs'])): ?>
                                    <?php foreach ($productType['inputs'] as $index => $input): ?>
                                        <ul class="box-info" style="display: flex; grid-gap: 24px; margin-top: 36px; flex-wrap: wrap;justify-content: space-evenly;">
                                            <li>
                                                <div class="left-elements" style="display: flex; grid-gap: 24px; width: 283px; cursor: pointer; flex-direction: column; align-items: center;">
                                                    <i class="bx bxs-dollar-circle"></i>
                                                    <span class="text"><?php echo $input['AttributeName']; ?></span>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </main>
    </section>

    <script src="../../assets/js/script.js"></script>
</body>

</html>
