<?php 
session_start();
if (!isset($_SESSION['user'])) {
  header("location:vendor.php");
}

include "./templates/top.php"; 

?>
 
<?php include "./templates/navbar.php"; ?>

<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; 

    $admin= $_SESSION['user'];

    if($admin == "naoufelbenmensour@gmail.com"){
    ?>

      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

       <h2>All Vendors</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>
          <tbody id="admin_list">
          <!--   <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td>dolor</td>
              <td>sit</td>
            </tr> -->
          </tbody>
        </table>
      </div> 

      <?php 
    }
      else{}
        ?>

    </main>
  </div>
</div>

<?php include "templates/footer.php"; ?>

<script>
  $(document).ready(function(){

getAdmins();

function getAdmins(){
  $.ajax({
    url : 'classes/Admin.php',
    method : 'POST',
    data : {GET_ADMIN:1},
    success : function(response){
      console.log(response);
      var resp = $.parseJSON(response);

      if (resp.status == 202) {
        var adminHTML = '';

        $.each(resp.message, function(index, value){
          adminHTML += '<tr>'+
                  '<td>#</td>'+
                  '<td>'+ value.username +'</td>'+
                  '<td>'+ value.email +'</td>'+
                  '<td>'+ value.phone +'</td>'+
                  '<td>'+value.street+'<br>'+value.city+'<br>'+value.pincode+'</td>'+
                  
                '</tr>';
        });

        $("#admin_list").html(adminHTML);

      }else if(resp.status == 303){
        $("#admin_list").html(resp.message);
      }

      

      

    }
  })
  
}

$(".add-brand").on("click", function(){

  alert();

});

});
</script>