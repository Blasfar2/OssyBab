<?php
$folderPath = 'temp_img/';
$image_parts = explode(";base64,", $_POST['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);

// Rename uploaded image to temporary_image.png
$file = $folderPath . 'temporary_image.png';


// Delete existing images in the folder
$files = glob($folderPath . '*'); // Get all file names
foreach($files as $file){ // Iterate files
  if(is_file($file))
    unlink($file); // Delete file
}
file_put_contents($file, $image_base64);
echo json_encode(["image_path" => $file]);

// echo json_encode(["image uploaded successfully."]);
?>
