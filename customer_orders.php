<?php session_start();
ini_set('display_errors', 1);
  if (!isset($_SESSION['user'])) {
  header("location:vendor.php");
}
 ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Orders</h2>
      	</div>
        <?php 
        include_once("./classes/Database.php");
        $uname= $_SESSION['user'];
        $db = new Database();
        $con = $db->connect();
        if($uname != 'naoufelbenmensour@gmail.com'){
        $query = $con->query("SELECT product_qty, product_price FROM orders WHERE vendor_name='$uname' AND  delivery_status !='Returned'");
        $total= 0;
        if (@$query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
          $total= $total + $row['product_qty']*$row['product_price'];
        }
      }
    }
    else{
      $query = $con->query("SELECT product_qty, product_price, shipping_method FROM orders WHERE delivery_status !='Returned'");
        $total= 0;
        if (@$query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
          if($row['shipping_method'] == 'Normal'){$var= 50;}
          elseif ($row['shipping_method'] == 'Express') {$var= 100;}
          $total= $total + $row['product_qty']*$row['product_price'] + $var;
        }
      }
    }
        ?>
       <div class="col-1">
          <!-- <h2>Total <?php //echo $total; ?></h2> -->
        </div>
      </div>

<?php
// require 'phpmailer/PHPMailerAutoload.php';

// function send_email($del, $uname, $name, $phone){
// $mail = new PHPMailer;

// $htmlversion= "You have received an delivery request <br> Vendor Name: <b>".$name."</b><br> Vendor Email: <b>".$uname."</b> <br> Vendor Phone No: <b>".$phone."</b>";
// $textversion= 'Delivery Request Arrived';

// //$mail->SMTPDebug = 3;                               // Enable verbose debug output

// $mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'naoufelbenmensour@gmail.com';                 // SMTP username
// $mail->Password = '14785269';                           // SMTP password
// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
// $mail->Port = 587;                                    // TCP port to connect to

// $mail->setFrom('naoufelbenmensour@gmail.com', 'Grocery Store');
// $mail->addAddress($del);               // Name is optional

// $mail->isHTML(true);

// $mail->Subject = 'Delivery Request';
// $mail->Body    = $htmlversion;
// $mail->AltBody = $textversion;

// if(!$mail->send()) {
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     /*echo 'Message has been sent';*/
// }
// }
?>      
      <?php
      $conn = mysqli_connect("localhost", "root", "", "grocery");
      $sql = "SELECT * FROM orders";
      $result = mysqli_query($conn, $sql);
      ?>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Image</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Order Id</th>
              <th>Payment Status</th>
              <th>Order Date</th>
              <th>Vendor Email</th>
              <th>Buyer Name</th>
              <th>Shipping Method</th>
              <th>Delivery Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <?php while($row = mysqli_fetch_object($result)){ ?>
          <tbody id="customer_order_list">
            <td>#</td>
            <td><img width="30" height="30" src="<?php echo $row->product_image ?>"></td>
            <td><?php echo $row->product_title; ?></td>
            <td><?php echo $row->product_qty; ?></td>
            <td><?php echo $row->product_price; ?></td>
            <td><?php echo $row->payment_id; ?></td>
            <td><?php echo $row->payment_status; ?></td>
            <td><?php echo $row->order_date; ?></td>
            <td><?php echo $row->vendor_name; ?></td>
            <td><?php echo $row->buyer_name; ?></td>
            <td><?php echo $row->shipping_method; ?></td>
            <td><?php echo $row->delivery_status; ?></td>
            <td><a href="edit.php?id=<?php echo $row->order_id; ?>">Edit</a></td>
          </tbody>
          <?php } ?>
        </table>
        <?php
          $conn = mysqli_connect("localhost", "root", "", "grocery");
          if(isset($_POST['update_sta'])){
            $statu = $_POST['up_status'];
            $id = $_GET['pay_id'];
            $sql = "UPDATE orders SET delivery_status:statu WHERE payment_id:id";
            $run = mysqli_query($conn, $sql);
                    if($run){
                        echo '<script type="text/javascript">alert("Status Updated");</script>';
                        
                    }else{
                        echo '<script type="text/javascript">alert("ERROR");</script>';
                    }
          }
        ?>
      
      </div>
    </main>
  </div>
</div>

<?php
// $q3= "SELECT * FROM vendors WHERE email='$uname'";
// $data3= mysqli_query($con, $q3);
// while($res3= mysqli_fetch_assoc($data3)){
//   $sname= $res3['username'];
//   $sphone= $res3['phone'];
// }
// if(isset($_POST['deliver'])){
//   $q2= "SELECT * FROM delivery WHERE pincode= (SELECT pincode from vendors where email='$uname') ";
//   $data2= mysqli_query($con, $q2);
//   while($res2= mysqli_fetch_assoc($data2)){
//     $del= $res2['email'];
//     send_email($del, $uname, $sname, $sphone);
//   }
// }
// ?>

<?php 
// if(isset($_POST['deli']))
// {
//   $order_id= $_POST['order_id'];
//   $name= $_POST['del_guy'];
//   $q2= $con->query("UPDATE orders SET delivery_status='$name' WHERE payment_id='$order_id' AND vendor_name='$uname'");
//   echo "<script type='text/javascript'>alert('Delivery Updated');</script>";
// }

?>


<?php include_once("./templates/footer.php"); ?>



<script>
// $(document).ready(function(){

// getCustomers();
// getCustomerOrders();

// function getCustomers(){
//   $.ajax({
//     url : './classes/Customers.php',
//     method : 'POST',
//     data : {GET_CUSTOMERS:1},
//     success : function(response){
      
//       console.log(response);
//       var resp = $.parseJSON(response);
//       if (resp.status == 202) {

//         var customersHTML = "";

//         $.each(resp.message, function(index, value){

//           customersHTML += '<tr>'+
//                           '<td>#</td>'+
//                           '<td>'+value.username+'</td>'+
//                           '<td>'+value.email+'</td>'+
//                           '<td>'+value.phone+'</td>'+
//                           '<td>'+value.street+'<br>'+value.city+'<br>'+value.pincode+'</td>'+
//                        '</tr>'

//         });

//         $("#customer_list").html(customersHTML);

//       }else if(resp.status == 303){
//         $("#customer_list").html(resp.message);
//       }

//     }
//   })
  
// }

// function getCustomerOrders(){
//   $.ajax({
//     url : 'classes/Customers.php',
//     method : 'POST',
//     data : {GET_CUSTOMER_ORDERS:1},
//     success : function(response){
      
//       console.log(response);
//       var resp = $.parseJSON(response);
//       if (resp.status == 202) {

//         var customerOrderHTML = "";

//         $.each(resp.message, function(index, value){

//           customerOrderHTML +='<tr>'+
//                             '<td><input type="hidden" value="'+ value.payment_id +'" name="pay_id" /></th>'+
//                             '<td><img width="30" height="30" src="'+value.product_image+'"></td>'+
//                             '<td>'+ value.product_title +'</td>'+
//                             '<td>'+ value.product_qty +'</td>'+
//                             '<td>'+ value.product_price +'</td>'+
//                             '<td>'+ value.payment_id +'</td>'+
//                             '<td>'+ value.payment_status +'</td>'+
//                             '<td>'+ value.order_date +'</td>'+
//                             '<td>'+ value.vendor_name +'</td>'+  
//                             '<td>'+ value.buyer_name +'</td>'+
//                             '<td>'+ value.shipping_method +'</td>'+
//                             '<td><input type="text" value="'+ value.delivery_status +'" name="up_status" /></td>'+
//                             '<td><input type="submit" value="Update Status" name="update_sta" /></td>'+
//                           '</tr>';

//         });

//         $("#customer_order_list").html(customerOrderHTML);

//       }else if(resp.status == 303){
//         $("#customer_order_list").html(resp.message);
//       }

//     }
//   })
  
// }


// });
</script>