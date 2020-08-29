<?php session_start();
  if (!isset($_SESSION['user'])) {
  header("location:vendor.php");
}
 ?>
<?php include_once("templates/top.php"); ?>
<?php include_once("templates/navbar.php"); ?>

<style>
    .form-control{
        width : 50%;
    }
</style>

<div class="container-fluid">
  <div class="row">
    
    <?php 
    include "templates/sidebar.php";
    $conn = mysqli_connect("localhost", "root", "", "grocery");

    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE product_id='$id'";
    $check = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($check);

    if(isset($_POST['done1'])){
        $name = $_POST['product_name'];
        $brand = $_POST['product_brand'];
        $desc = $_POST['product_desc'];
        $qty = $_POST['product_qty'];
        $price = $_POST['product_price'];
        $image = $_POST['product_image'];
        $edit = "UPDATE products SET product_title='$name', product_brand='$brand', product_desc='$desc', product_qty='$qty', product_price='$price', product_image='$image'   WHERE product_id='$id'";
        $run = mysqli_query($conn, $edit);
        if(!$run){
            // echo "data not updated";
            echo '<div class="alert alert-danger" id="success">
                    <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
                </div>
                ';
        }else{
            // header('location:customer_orders.php');
            echo '
            <div class="row">
            <div class="col-10">
            <div class="container">
                <div id="alert" class="alert alert-success">
                <strong>Success!</strong> Data updated Successfuly.
            </div>
            </div>
            </div>
            ';
        }
    }
    ?>

      <div class="row">
      	<div class="col-12">
      		<h2>Update Product</h2>
      	</div>
      	<div class="col-2">
      	</div>
      </div>

    <form method="POST">
      <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" name="product_name" value="<?php echo $row->product_title; ?>" class="form-control">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Product Brand</label>
                <input type="text" name="product_brand" value="<?php echo $row->product_brand; ?>" class="form-control">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Product Description</label>
                <input type="text" class="form-control" name="product_desc" value="<?php echo $row->product_desc; ?>">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Product Quantity</label>
                <input type="text" class="form-control" name="product_qty" value="<?php echo $row->product_qty; ?>">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Product Price</label>
                <input type="text" class="form-control" name="product_price" value="<?php echo $row->product_price; ?>">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Product Image</label>
                <input type="file" class="form-control" name="product_image">
            </div>
        </div>
        <div class="col-12">
            <button type="submit" name="done1" class="btn btn-primary add-product">Update Product</button>
            <a href="products.php" class="btn btn-info">Return to Products</a>
        </div>
      </div>
    </form>

    <?php


    ?>

<?php include_once("templates/footer.php"); ?>