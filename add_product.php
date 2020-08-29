

<?php

// $conn = mysqli_connect("localhost", "root", "", "grocery");

// if(isset($_POST['sub'])){
//   $name_pro = $_POST['product_name'];
//   $sql = "INSERT INTO products (product_title) VALUES ('$name_pro')";
//   $run = mysqli_query($conn, $sql);

//   if($run){
//     echo "data added successfuly";
//     header('location:products.php');
//   }else{
//     echo "Error";
//   }
// }

?>

<form method="POST">
    <input type="text" name="product_name" id="">
    <input type="submit" value="add" name="sub">
</form>