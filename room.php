<?php include 'libs/connection.php'; ?>
<?php include 'libs/header.php'; ?>

<?php 
session_start(); 
if (!isset($_SESSION['admin'])) {
  header('location: login.php');
}

?>
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
  <?php 

    $b_id = $_GET['b'];

    $sql = "SELECT *,room_tbl.id AS ri FROM building_tbl INNER JOIN room_tbl ON room_tbl.building_id = building_tbl.id WHERE building_tbl.id = '$b_id'";
    $result = $conn->query($sql);
    $qrow = $result->fetch_assoc();

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $qrow['building_name']; ?> / Rooms</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $qrow['building_name']; ?></li>
              <li class="breadcrumb-item active">Rooms</li>
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
          <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#add_building"><i class="fas fa-plus"> </i> Add Room in <?php echo $qrow['building_name']; ?></a>
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
                  <th>Room Name</th>
                   <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = "SELECT `id`, `building_id`, `room_name`, `description` FROM `room_tbl` WHERE building_id ='$b_id'";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    
                      while($row = $result->fetch_assoc()) {
                        ?>
                <tr>
                  <td><?php echo $row['room_name'] ?></td>
                  <td><?php echo $row['description'] ?></td>
                  <td width="18%">
                    <a class="btn btn-warning btn-sm ts" href="" data-toggle="modal" data-target="#task_list" data-name="<?php echo $row['room_name'] ?>" data-id="<?php echo $row['id'] ?>"><i class="fas fa-tasks"></i> Task</a>
                     <a class="btn btn-info btn-sm edit" href="#" data-toggle="modal" data-target="#edit_room" data-id="<?php echo $row['id'] ?>" ><i class="fas fa-pencil-alt"></i> Edit</a>
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
                  <th>Room Name</th>
                  <th>Description</th>
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
              <h4 class="modal-title">Add room in <?php echo $qrow['building_name']; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/addRoom.php">

              <div class="modal-body">
              <div class="input-group mb-3">
                <input type="hidden"  name="building_id" value="<?php echo $qrow['building_id']; ?>"> 
                <input type="text" name="room_name" class="form-control" placeholder="Room Name">
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

      <div class="modal fade" id="edit_room">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit room in <?php echo $qrow['building_name']; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/updateRoom.php">

              <div class="modal-body">
                <input type="hidden"  name="building_id" value="<?php echo $qrow['building_id']; ?>">
                <input type="hidden" name="edit_id" value="" id="edit_id">
              <div class="input-group mb-3">
                <input type="text" name="edit_room_name" id="edit_room_name" class="form-control" placeholder="Room Name">
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
              <h4 class="modal-title">Delete room <?php echo $qrow['building_name']; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/deleteRoom.php">
            <div class="modal-body">
              <input type="hidden"  name="building_id" value="<?php echo $qrow['building_id']; ?>">
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

      <div class="modal fade" id="task_list">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><?php echo $qrow['building_name']. " | ";?><span class="sp"></span> Task</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/deletebuilding.php">
            <div class="modal-body">
              <?php 
                  $conn = new mysqli('localhost', 'root', '', 'eps_db');
                  $sql = "SELECT `id`, `name`, `date_sched`, `sta` FROM `task_tbl`";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    
                      while($row = $result->fetch_assoc()) {
                        ?>
                         <a  data-id="<?php echo $row['id']?>" data-name="" type="button" class="btn btn-block btn-secondary clck" style="color: white;"><?php echo $row['name'] ?></a>
               
                  <?php
                      
                      }
                  } else {
                      echo "0 results";
                  }
                  $conn->close();
                  ?>

             
            </div>
            <div class="modal-footer justify-content-between">
             
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
        title: 'Success ".$_SESSION['success']." room!'
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
<!--  $(location).attr('href',url); -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.clck').click(function(){
      var id = $(this).attr("data-id");
      var r_id = $(this).attr("data-name");
      $(location).attr('href',"task.php?b=<?php echo $_GET['b']?>&r="+r_id+"&t="+id)
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.ts').click(function(){
      var id = $(this).attr("data-id");
      var name = $(this).attr("data-name");
      $('.sp').html(name);
      $('.clck').attr('data-name',id);
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.edit').click(function(){
      var id = $(this).attr("data-id");
      $.ajax({
        type:'POST',
        url: 'action/room_row.php',
        data:{id:id},
        dataType: 'json',
        success: function(data) {
          $('#edit_id').val(data.id);
          $('#edit_room_name').val(data.room_name);
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
        url: 'action/room_row.php',
        data:{id:id},
        dataType: 'json',
        success: function(data) {
          $('#delete_id').val(data.id);
          $('#delete_name').html(data.room_name);
        }
      });
    });
  });
</script>
</body>
</html>
