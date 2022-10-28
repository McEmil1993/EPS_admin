<?php include 'libs/connection.php'; ?>

<?php 
session_start(); 
if (!isset($_SESSION['admin'])) {
  header('location: login.php');
}

?>
<?php include 'libs/header.php'; ?>

<style type="text/css">
  .bootstrap-datetimepicker-widget .datepicker-days table tbody tr:hover {
    background-color: #eee;
}
</style>
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
            <h1 class="m-0 text-dark">Buildings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Buildings</li>
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
          <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#add_building"><i class="fas fa-plus"> </i> Add Buildings</a>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
             <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Building Name</th>
                   <th>Description</th>
                  <th>Room Count</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = "SELECT id, building_name, description,count_room FROM building_tbl";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    
                      while($row = $result->fetch_assoc()) {
                        ?>
                <tr>
                  <td><?php echo $row['building_name'] ?></td>
                  <td><?php echo $row['description'] ?></td>
                  <td><?php echo $row['count_room'] ?></td>
                  <td width="18%">
                    <a class="btn btn-success btn-sm" href="room.php?b=<?php echo $row['id'] ?>" ><i class="fas fa-door-open"></i> Rooms</a>
                     <a class="btn btn-info btn-sm edit" href="#" data-toggle="modal" data-target="#edit_building" data-id="<?php echo $row['id'] ?>" ><i class="fas fa-pencil-alt"></i> Edit</a>
                     <a class="btn btn-danger btn-sm delete" href="#" data-toggle="modal" data-target="#delete_building" data-id="<?php echo $row['id'] ?>"><i class="fas fa-trash"></i> Delete</a>
                  </td>
                </tr>
                        <?php
                          // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                      }
                  } else {
                      echo "0 results";
                  }
                  $conn->close();
                  ?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Building Name</th>
                  <th>Description</th>
                  <th>Room Count</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- add building -->

      <div class="modal fade" id="add_building">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Building</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/addBuilding.php">

              <div class="modal-body">
              <div class="input-group mb-3">
                <input type="text" name="building_name" class="form-control" placeholder="Building Name">
              </div>

              <div class="input-group mb-3">
                <input type="text" name="description" class="form-control" placeholder="Description">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>

            </form>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- edit building -->

      <div class="modal fade" id="edit_building">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit building</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/updatebuilding.php">

              <div class="modal-body">
                <input type="hidden" name="edit_id" value="" id="edit_id">
              <div class="input-group mb-3">
                <input type="text" name="edit_building_name" id="edit_building_name" class="form-control" placeholder="Building Name">
              </div>

              <div class="input-group mb-3">
                <input type="text" name="edit_description" id="edit_description" class="form-control" placeholder="Description">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>

            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="delete_building">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete building</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/deletebuilding.php">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
              <p>Are you sure want to delete <span id="delete_name"></span>?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-danger">Submit</button>
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

<script type="text/javascript">
  $('#building').addClass('menu-open');
</script>

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
        title: 'Success ".$_SESSION['success']." building!'
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

$(function() {
   var enableDays = ['2019-11-30'];
   var disabledDays = ['2019-11-28', '2019-11-29'];

   function formatDate(d) {
     var day = String(d.getDate())
     //add leading zero if day is is single digit

     if (day.length == 1)
       day = '0' + day
     var month = String((d.getMonth()+1))
     //add leading zero if month is is single digit
     if (month.length == 1)
       month = '0' + month
     return d.getFullYear() + '-' + month + "-" + day;
   }

   $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
         beforeShowDay: function(date){
          var dayNr = date.getDay();
            if (dayNr==0  ||  dayNr==6){
                if (enableDays.indexOf(formatDate(date)) >= 0) {
                    return true;
                }
                return false;
            }
            if (disabledDays.indexOf(formatDate(date)) >= 0) {
               return false;
            }
            return true;
        }
   });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.edit').click(function(){
      var id = $(this).attr("data-id");
      $.ajax({
        type:'POST',
        url: 'action/building_row.php',
        data:{id:id},
        dataType: 'json',
        success: function(data) {
          $('#edit_id').val(data.id);
          $('#edit_building_name').val(data.building_name);
          $('#edit_description').val(data.description);
        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.delete').click(function(){
      var id = $(this).attr("data-id");
      $.ajax({
        type:'POST',
        url: 'action/building_row.php',
        data:{id:id},
        dataType: 'json',
        success: function(data) {
          $('#delete_id').val(data.id);
          $('#delete_name').html(data.building_name);
        }
      });
    });
  });
</script>
</body>
</html>
