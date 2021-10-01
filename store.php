<?php
session_start();
    include("connection.php");
    include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/9326843456.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="jquery.tabledit.js"></script>
    <script src="editable.js"></script>
    <title>Store</title>
</head>
<body>
    <h4><a href="index.php">Back to menu page</a></h4>
    <style type="text/css">
    
    #text{
        width: 100%;
        height: 25px;
        border-radius: 5px;
        border: solid thin #aaa;
        padding: 4px;
    }
    #button{
        padding: 10px;
        width: 100px;
        color: white;
        background-color: lightblue;
        border: none;
        cursor:pointer;
    }
    #box{

        background-color: grey;
        margin-bottom: 25px;
        width: 600px;
        padding: 20px;
    }
    </style>
     <div id="box">
        <form method="post" action="store.php">
            <h2 style="color: white;">Mantap Jiwa Product Management System</h2>
            <h4 style="color: white;">*...* = Required</h4>
            <div style="font-size: 20px;margin: 10px; color: white;">Add Product</div>
            <input type="text" id="product_name" name="product_name" placeholder="*product_name*"><br><br>
            <input type="text" id="product_price" name="product_price" placeholder="*product_price*"><br><br>
            <input type="text" id="product_discount" name="product_discount" placeholder="product_discount"><br><br>
            <input id="button" type="submit" name="bt_store" value="Store"><br><br>


            <div style="font-size: 10px;margin: 10px; color: white;">Or</div>
            <div style="font-size: 20px;margin: 10px; color: white;">Remove Product</div>
            <input type="text" id="product_id" name="product_id" placeholder="*product_id*"><br><br>
            <input id="button" type="submit" name="bt_remove" value="Remove"><br><br>
            
        </form>
    </div>
<?php
    $user_data = check_login($con);

    $product_data = mysqli_query($con,"SELECT * FROM products");
    $num_row = mysqli_num_rows($product_data);
    

    echo "<h2>Product List</h2>
    <table id='product_list' class='table table-striped'>
    <thead>
        <tr>
            <th>id</th>
            <th>product_id</th>
            <th>product_name</th>
            <th>product_price</th>
            <th>product_discount</th>
            <th>date</th>
        </tr>
    </thead>
    <tbody>\r\n";
    if($num_row > 0){
        while($row = mysqli_fetch_array($product_data))
        {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['product_id'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['product_price'] . "</td>";
        echo "<td>" . $row['product_discount'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "</tr>\r\n";
        }
        echo " </tbody>\r\n";
        echo "</table>";
    }
    if(isset($_REQUEST['bt_store']) && !isset($_REQUEST['bt_remove'])){
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_discount = $_POST['product_discount'];
        if(empty($product_discount)){
            $product_discount = 0.0;
        }
        
        if(!empty($product_name) && !empty($product_price)){
            if(is_numeric($product_price)){
                $product_id = random_num(8);
                $query = "INSERT INTO products(product_id,product_name,product_price,product_discount) VALUES ($product_id,'$product_name',$product_price,$product_discount)";
                mysqli_query($con, $query);
                unset($product_name);
                unset($product_price);
                unset($product_discount);
                header("Refresh: 0");
                exit();
                    
            }
            else echo "Please enter the correct format for product_price (number)";
        }
        else echo "Please fill in required information";
    }

    else if(!isset($_REQUEST['bt_store']) && isset($_REQUEST['bt_remove'])){
        $product_id = $_POST['product_id'];
        if(!empty($product_id) && is_numeric($product_id)){
            $query = "SELECT * FROM products where product_id = $product_id";
            $result = mysqli_query($con, $query);
            if($result){
                if($result && mysqli_num_rows($result) > 0){
                    $delete = "DELETE FROM products where product_id = $product_id";
                    mysqli_query($con, $delete);
                    unset($product_id);
                    header("Refresh: 0");
                    exit();
                }
                else echo "Product not found!";
            }
        }
        else echo "Please enter correct value!";
    }
?>
   
</body>
</html>
