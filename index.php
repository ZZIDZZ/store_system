<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Sistem Perbelanjaan</title>
</head>
<body>
    <h3><a href="logout.php">Logout</a></h3>
    <h1>Welcome to Mantap Jiwa Shopping System,  <?php echo $user_data['user_name']; ?>! </h1>
    <br><br>
    
    <h2><a href="buy.php">1. Beli Produk</a><br></h2>
    <h2><a href="store.php">2. Setor Produk</a><br><br></h2>    
</body>
</html>
