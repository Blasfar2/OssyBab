<?php
// fetch_product_details.php

// Include your database connection or any necessary files
include ("../../includes/connection.php");
// Check if productId is set in the request
if (isset($_GET['productId'])) {
    // Get the productId from the request
    $productId = $_GET['productId'];

    // Execute the SQL query to fetch product details based on the productId
    $productSql = "SELECT p.*, pt.TypeName FROM products p
                    LEFT JOIN producttypes pt ON p.ProductTypeID = pt.ProductTypeID
                    WHERE p.ProductID = $productId";
    $productResult = mysqli_query($conn, $productSql);

    // Check if query executed successfully
    if ($productResult && mysqli_num_rows($productResult) > 0) {
        // Fetch product details
        $productDetails = mysqli_fetch_assoc($productResult);

        // Construct the response array with product details
        $response = array(
            'productId' => $productId,
            'productName' => $productDetails['Name'],
            'productImage' => $productDetails['ProductImage'],
            'productPrice' => $productDetails['Price'],
            'productStock' => $productDetails['Stock'],
            'productDescription' => $productDetails['Description'],
            'productTypeName' => $productDetails['TypeName']
        );

        // Execute another SQL query to fetch product attributes
        $attributesSql = "SELECT pa.AttributeName, pav.ValueString, pav.ValueInteger, pav.ValueDecimal, pav.ValueBoolean, pav.ValueDate 
                            FROM productattributes pa 
                            LEFT JOIN productattributevalues pav ON pa.AttributeID = pav.AttributeID 
                            WHERE pav.ProductID = $productId";
        $attributesResult = mysqli_query($conn, $attributesSql);

        // Check if query executed successfully
        if ($attributesResult && mysqli_num_rows($attributesResult) > 0) {
            // Initialize an array to hold product attributes
            $attributes = array();

            // Fetch and store product attributes
            while ($row = mysqli_fetch_assoc($attributesResult)) {
                // Add attribute to the attributes array
                $attributes[] = array(
                    'attributeName' => $row['AttributeName'],
                    'attributeValue' => $row['ValueString'] ?? $row['ValueInteger'] ?? $row['ValueDecimal'] ?? $row['ValueBoolean'] ?? $row['ValueDate']
                );
            }

            // Add attributes to the response array
            $response['attributes'] = $attributes;
        }

        // Return product details as JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Return error response if product details not found
        http_response_code(404);
        echo json_encode(array('error' => 'Product details not found'));
    }
} else {
    // Return error response if productId is not provided
    http_response_code(400);
    echo json_encode(array('error' => 'Product ID not provided'));
}
?>
