<?php session_start();
ini_set('display_errors', 1);
  if (!isset($_SESSION['user'])) {
  header("location:vendor.php");
}
 ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<style>
    #inp{
        width :49%;
        margin : 20px;
        padding : 6px 12px;
        border : 1px solid black;
        border-radius : 6px;
    }
    #inp1{
        margin-left : 2%;
    }
    #back{
        margin : 20px;
    }
    #alert{
        margin : 20px;
        width : 50%;
    }
</style>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

    <div class="row">
      	<div class="col-10">
      		<h2>Update Delivery Status</h2>
                <form method="POST">
                    <input type="text" id="inp" value="" name="delivery_sta" value="">
                    <input type="submit" value="Update" id="inp1" name="done" class="btn btn-info">
                </form>
            <br>
            <a href="customer_orders.php" id="back">Back to Orders</a>
            </div>
      	</div>
<?php

$conn = mysqli_connect("localhost", "root", "", "grocery");

$id = $_GET['id'];

// $sql = "SELECT * FROM orders WHERE order_id='$id'";

// $data = mysqli_query($sql, $conn);

// $check = mysqli_fetch_array($data);

if(isset($_POST['done'])){
    $st_delivery = $_POST['delivery_sta'];
    $edit = "UPDATE orders SET delivery_status='$st_delivery' WHERE order_id='$id'";
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


        </div>
    </div>
</div>



<?php include_once("./templates/footer.php"); ?>