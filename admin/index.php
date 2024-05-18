<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    
<h1>Hello <?php echo $_SESSION['username']; ?></h1>

<h2> you ID is : <?php echo $_SESSION['id']; ?></h2>

</body>
</html>