
<?php include 'libs/connection.php'; ?>
<?php include 'libs/header.php'; 
session_start(); 
if (!isset($_SESSION['admin'])) {
  header('location: login.php');
}

?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'libs/topnav.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'libs/sidenav.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Equipment Task</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Equipment Task</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div style="margin:10px">
          <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#addEqt"><i class="fas fa-plus"> </i> Add equiptment task</a>
        </div>
        <?php 
        $sql = "SELECT checking_tbl.id, building_tbl.building_name,room_tbl.room_name,category_tbl.cate_name,equipment_tbl.name,equipment_tbl.description AS ED, checking_tbl.date_time ,equipment_tbl.ImageUrl AS IM,task_tbl.name AS t_name ,checking_tbl.status,checking_tbl.name_f FROM `checking_tbl`INNER JOIN building_tbl ON building_tbl.id = checking_tbl.building_id INNER JOIN room_tbl ON room_tbl.id =checking_tbl.room_id INNER JOIN equipment_tbl ON equipment_tbl.id = checking_tbl.equipment_id LEFT JOIN category_tbl ON category_tbl.id = equipment_tbl.category_id INNER JOIN task_tbl ON task_tbl.id = category_tbl.Task  WHERE category_tbl.Task = '".$_GET['t']."' AND building_tbl.id = '".$_GET['b']."' AND room_tbl.id ='".$_GET['r']."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
                    $t =0;
          while($row = $result->fetch_assoc()) {

        ?>

<!-- ($id, $building_name,$room_name,$cate_name,$name, $ED,$date_time,$ImageUrl,$status,$name_f); -->
        <!-- s -->
        <div class="card card-default collapsed-card">
          <div class="card-header">
            <h3 class="card-title"><?php echo $row['name']; ?></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-sm-3">
                <img class="img-fluid" src="<?php echo $row['IM']; ?>" alt="Photo">
              </div>
                        <!-- /.col -->
              <div class="col-sm-9">
               
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                 
                    Category: <b><?php echo $row['cate_name']; ?></b>
                    <br>
                    <br>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Inspect by: <b><?php echo $row['name_f']; ?></b>
                    <br>
                    <br>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Date of inspect: <b><?php echo $row['date_time']; ?></b>
                  <br>
                  <br>
                  
                </div>
                <!-- /.col -->
              </div>

               <div class="row">
                <div class="col-12">
                  <h4>
                     <strong>Inspection Equipment</strong>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <br>
              <div class="row">
                <div class="col-6">
                <div class="form-group">
                  <div class="custom-control custom-switch"> 
                    <input type="checkbox" class="custom-control-input chk<?php echo $t; ?>" <?php echo ($row['status'] == 1)? 'checked':''; ?> id="c<?php echo $t; ?>" data-name="customSwitch1[]" data-id="<?php echo $row['id']; ?>">
                    <label class="custom-control-label" for="c<?php echo $t; ?>">Good Condition</label>
                  </div>
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" <?php echo ($row['status'] == 2)? 'checked':''; ?> id="cu<?php echo $t; ?>" data-id="<?php echo $row['id']; ?>" data-name="customSwitch2[]">
                    <label class="custom-control-label" for="cu<?php echo $t; ?>">Not Good Condition</label>
                  </div>
                </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" <?php echo ($row['status'] == 3)? 'checked':''; ?> id="cus<?php echo $t; ?>" data-id="<?php echo $row['id']; ?>"
                    data-name="customSwitch3[]">
                    <label class="custom-control-label" for="cus<?php echo $t; ?>">Missing Equipment</label>
                  </div>
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" <?php echo ($row['status'] == 4)? 'checked':''; ?> id="cust<?php echo $t; ?>" data-id="<?php echo $row['id']; ?>" data-name="customSwitch4[]">
                    <label class="custom-control-label" for="cust<?php echo $t; ?>">Others</label>
                  </div>
                </div>
                </div>
              </div>
                          <!-- /.row -->
              </div>
                        <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- end -->
        <?php
                 $t++;         
         }
       }else{
         ?>
         <div class="card card-default collapsed-card">
          <div class="card-header">
            <h3 class="card-title">No data</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <div class="card-body">
            <h5>Please add equipment</h5>
          </div>
        </div>
         <?php
       }
?>

        <!-- Small boxes (Stat box) -->
     
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="addEqt">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Select Equipment  <span id="img"></span> Photo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form enctype="multipart/form-data" action="action/addTask.php" method="POST"> 
                <div class="form-group">
                  <input type="hidden" name="b_id" value="<?php echo $_GET['b'] ?>">
                   <input type="hidden" name="r_id" value="<?php echo $_GET['r'] ?>">
                   <input type="hidden" name="t_id" value="<?php echo $_GET['t'] ?>">

                  <select class="custom-select" name="e_id">
                  <?php include 'libs/connection.php'; ?>
                  <?php 
                  $sqlqw = "SELECT equipment_tbl.id, category_tbl.cate_name , equipment_tbl.name, equipment_tbl.description, equipment_tbl.ImageUrl, equipment_tbl.quantity, equipment_tbl.status FROM equipment_tbl INNER JOIN category_tbl on category_tbl.id = equipment_tbl.category_id WHERE category_tbl.Task = '".$_GET['t']."'";
                  $result1 = $conn->query($sqlqw);

                  if ($result1->num_rows > 0) {
                      while($row2 = $result1->fetch_assoc()) {
                        ?>
                        <option id="op<?php echo $row2['id']; ?>" value="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?></option>
                        <?php
                      }
                  }
                  ?>
                    </select>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <!-- /.content-wrapper -->
 <?php include 'libs/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<?php include 'libs/script.php'; ?>
<?php 

if (isset($_SESSION['success'])) {
  echo "<script>
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
      Toast.fire({
        type: 'success',
        title: 'Success ".$_SESSION['success']." equipment task!'
      })
  });
      </script>";
 unset($_SESSION['success']);
} 
if (isset($_SESSION['error'])) {
  echo "<script>
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
      Toast.fire({
        type: 'error',
        title: ' ".$_SESSION['error']." '
      })
  });
      </script>";
 unset($_SESSION['error']);
} 

 ?>
<script type="text/javascript">
  $('#building').addClass('menu-open');
  $(document).ready(function(){

    var inps = $('input[data-name="customSwitch1[]"]');

      for (var i = 0; i <inps.length; i++) {

         $('#c'+i).on('change', function() {

          var id = $(this).attr("data-id");

          if ($(this).is(':checked')) {

            $(this).attr('value', '1');
          } else {
            $(this).attr('value', '0');
          } 
          var ch = $(this).val();

       $.ajax({
        type:'POST',
        url: 'action/checkEquip.php',
        data:{id:id,status:ch},
        success: function(data) {
            if (data == "update") {
              $(function() {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                 Toast.fire({
                   type: 'success',
                   title: 'Success update equipment task!'
                 })
                 setTimeout(function() {
                   location.reload();
                 },1000);
              });
            }else{
              $(function() {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                 Toast.fire({
                   type: 'error',
                   title: 'error'
                 })
              });
            }
        }
      });
      
      });
      }
    
    var inps1 = $('input[data-name="customSwitch2[]"]');

    for (var i = 0; i <inps1.length; i++) {

       $('#cu'+i).on('change', function() {
            var id = $(this).attr("data-id");

          if ($(this).is(':checked')) {

            $(this).attr('value', '2');
          } else {
            $(this).attr('value', '0');
          } 
          var ch = $(this).val();

       $.ajax({
        type:'POST',
        url: 'action/checkEquip.php',
        data:{id:id,status:ch},
        success: function(data) {
            if (data == "update") {
              $(function() {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                 Toast.fire({
                   type: 'success',
                   title: 'Success update equipment task!'
                 })
                 setTimeout(function() {
                   location.reload();
                 },1000);
              });
            }else{
              $(function() {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                 Toast.fire({
                   type: 'error',
                   title: 'error'
                 })
              });
            }
        }
      });
          });
    }

    var inps2 = $('input[data-name="customSwitch3[]"]');

    for (var i = 0; i <inps2.length; i++) {

       $('#cus'+i).on('change', function() {
            var id = $(this).attr("data-id");

          if ($(this).is(':checked')) {

            $(this).attr('value', '3');
          } else {
            $(this).attr('value', '0');
          } 
          var ch = $(this).val();

       $.ajax({
        type:'POST',
        url: 'action/checkEquip.php',
        data:{id:id,status:ch},
        success: function(data) {
            if (data == "update") {
              $(function() {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                 Toast.fire({
                   type: 'success',
                   title: 'Success update equipment task!'
                 })
                 setTimeout(function() {
                   location.reload();
                 },1000);
              });
            }else{
              $(function() {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                 Toast.fire({
                   type: 'error',
                   title: 'error'
                 })
              });
            }
        }
      });
          });
    }

    var inps3 = $('input[data-name="customSwitch4[]"]');

    for (var i = 0; i <inps3.length; i++) {

       $('#cust'+i).on('change', function() {
            var id = $(this).attr("data-id");

          if ($(this).is(':checked')) {

            $(this).attr('value', '4');
          } else {
            $(this).attr('value', '0');
          } 
          var ch = $(this).val();

       $.ajax({
        type:'POST',
        url: 'action/checkEquip.php',
        data:{id:id,status:ch},
        success: function(data) {
            if (data == "update") {
              $(function() {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                 Toast.fire({
                   type: 'success',
                   title: 'Success update equipment task!'
                 })
                 setTimeout(function() {
                   location.reload();
                 },1000);
              });
            }else{
              $(function() {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1000
                });
                 Toast.fire({
                   type: 'error',
                   title: 'error'
                 })
              });
            }
        }
      });
          });
    }

  });
</script>
</body>
</html>
