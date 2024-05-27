<?php
include ("../../../includes/connection.php");

if (isset($_POST['productTypeID'])) {
    $productTypeID = $_POST['productTypeID'];

    // Fetch attributes for the selected product type along with their values
    $sql = "SELECT pa.AttributeID, pa.AttributeName, pa.DataType, pav.ValueString, pav.ValueInteger, pav.ValueDecimal, pav.ValueBoolean, pav.ValueDate
            FROM productattributes pa
            LEFT JOIN productattributevalues pav ON pa.AttributeID = pav.AttributeID
            WHERE pa.ProductTypeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productTypeID);
    $stmt->execute();
    $result = $stmt->get_result();

    $attributes = array();
    while ($row = $result->fetch_assoc()) {
        $attributeID = $row['AttributeID'];
        if (!isset($attributes[$attributeID])) {
            $attributes[$attributeID] = array(
                'AttributeID' => $row['AttributeID'],
                'AttributeName' => $row['AttributeName'],
                'DataType' => $row['DataType'],
                'Values' => array()
            );
        }
        $value = array(
            'ValueString' => $row['ValueString'],
            'ValueInteger' => $row['ValueInteger'],
            'ValueDecimal' => $row['ValueDecimal'],
            'ValueBoolean' => $row['ValueBoolean'],
            'ValueDate' => $row['ValueDate']
        );
        $attributes[$attributeID]['Values'][] = $value;
    }

    // Return attributes as JSON
    echo json_encode(array_values($attributes));
} else {
    // Handle invalid request
    http_response_code(400);
    echo "Invalid request";
}
?>
