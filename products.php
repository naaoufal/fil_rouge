<?php session_start();
  if (!isset($_SESSION['user'])) {
  header("location:vendor.php");
}
 ?>
<?php include_once("templates/top.php"); ?>
<?php include_once("templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php 
    include "templates/sidebar.php";
    ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Product List</h2>
      	</div>
      	<div class="col-2">
          <a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Add Product</a>
      		<!-- <a href="#" class="btn btn-primary btn-sm">Add Product</a> -->
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th>Price ($)</th>
              <th>Quantity</th>
              <th>Brand</th>
              <th>Action</th>
            </tr>
          </thead>
          <?php
            include 'connection.php';
            $sql = "SELECT * FROM products WHERE vendor_name = '".$_SESSION['user']."'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_object($result)){
          ?>
          <tbody id="product_list">
            <tr>
              <td><?php echo $row->product_id ?></td>
              <td><?php echo $row->product_title ?></td>
              <td><img style="width:30px; height:30px;" id="image_block" src="<?php echo $row->product_image ?>"></td>
              <td><?php echo $row->product_price ?></td>
              <td><?php echo $row->product_qty ?></td>
              <td><?php echo $row->product_brand ?></td>
              <td><a href="edit1.php?id=<?php echo $row->product_id; ?>" class="btn btn-sm btn-info">Update</a> <a class="btn btn-sm btn-danger">Delete</a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php

$conn = mysqli_connect("localhost", "root", "", "grocery");

if(isset($_POST['sub'])){
  $name_pro = $_POST['product_name'];
  $brand = $_POST['brand_ti'];
  $email_vendor = $_POST['vendor_email'];
  $qty_product = $_POST['product_qty'];
  $image_product = $_POST['product_image'];
  $desc_product = $_POST['product_desc'];
  $price = $_POST['product_price'];
  $sql = "INSERT INTO products (product_title, product_brand, product_qty, product_image, product_desc, product_price, vendor_name) VALUES ('$name_pro', '$brand', '$qty_product', '$image_product', '$desc_product', '$price', '$email_vendor')";
  $run = mysqli_query($conn, $sql);

  if($run){
    echo "data added successfuly";
    // header('location:products.php');
  }else{
    echo "Error";
  }
}

?>

<?php

include 'connection.php';
$sql = "SELECT * FROM brands";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_object($result)){

?>
<!-- Add Product Modal start -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Product Name</label>
		        		<input type="text" name="product_name" class="form-control" placeholder="Enter Product Name">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Brand Name</label>
		        		<input type="text" name="brand_ti" class="form-control" placerholder="Enter Brand Name">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Product Description</label>
		        		<textarea class="form-control" name="product_desc" placeholder="Enter product desc"></textarea>
		        	</div>
        		</div>
            <div class="col-12">
              <div class="form-group">
                <label>Product Qty</label>
                <input type="number" name="product_qty" class="form-control" placeholder="Enter Product Quantity">
              </div>
            </div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Product Price ($)</label>
		        		<input type="number" name="product_price" class="form-control" placeholder="Enter Product Price">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Product Image <small>(format: jpg, jpeg, png)</small></label>
		        		<input type="file" name="product_image" class="form-control">
		        	</div>
        		</div>
            <div class="col-12">
        			<div class="form-group">
		        		<label>Vendor Email</label>
		        		<input type="text" name="vendor_email" class="form-control" value="<?php echo $row->vendor_name; ?>" readonly="readonly">
		        	</div>
        		</div>
        		<input type="hidden" name="add_product" value="1">
        		<div class="col-12">
        			<button type="submit" name="sub" class="btn btn-primary add-product">Add Product</button>
              <!-- <input type="submit" name="sub" class="btn btn-primary" value="ADD"> -->
        		</div>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php } ?>

<!-- Add Product Modal end -->

<!-- Edit Product Modal start -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <!-- <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="e_product_name" class="form-control" placeholder="Enter Product Name">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Brand Name</label>
                <select class="form-control brand_list" name="e_brand_id">
                  <option value="">Select Brand</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Category Name</label>
                <select class="form-control category_list" name="e_category_id">
                  <option value="">Select Category</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" name="e_product_desc" placeholder="Enter product desc"></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Product Qty</label>
                <input type="number" name="e_product_qty" class="form-control" placeholder="Enter Product Quantity">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Product Price ($)</label>
                <input type="number" name="e_product_price" class="form-control" placeholder="Enter Product Price">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Product Image <small>(format: jpg, jpeg, png)</small></label>
                <input type="file" name="e_product_image" class="form-control">
                <img src="" class="img-fluid" width="50">
              </div>
            </div>
            <input type="hidden" name="pid">
            <input type="hidden" name="edit_product" value="1">
            <div class="col-12">
              <input type="submit" value="add" name="sub">
            </div>
          </div> -->
          
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Product Modal end -->

<?php include_once("templates/footer.php"); ?>



