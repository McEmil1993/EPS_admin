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
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div style="margin:10px">
          <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#addUser"><i class="fas fa-plus"> </i> Add Users</a>
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
                  <th>Fullname</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>User type</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = "SELECT `id`, `fullname`, `contact`, `address`, `username`, `password`, `user_type` FROM `users_tbl`";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    
                      while($row = $result->fetch_assoc()) {
                        ?>
                <tr>
                  <td><?php echo $row['fullname'] ?></td>
                  <td><?php echo $row['contact'] ?></td>
                  <td><?php echo $row['address'] ?></td>
                  <td><?php echo ($row['user_type'] == 1)? 'Admin' : 'Staff'; ?></td>
                  <td width="18%">
                     <a class="btn btn-info btn-sm edit" href="#" data-toggle="modal" data-target="#editUser" data-id="<?php echo $row['id'] ?>" ><i class="fas fa-pencil-alt"></i> Edit</a>
                     <a class="btn btn-danger btn-sm delete" href="#" data-toggle="modal" data-target="#deleteUse" data-id="<?php echo $row['id'] ?>"><i class="fas fa-trash"></i> Delete</a>
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
                  <th>Fullname</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>User type</th>
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

      <div class="modal fade" id="addUser">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/addUser.php">

              <div class="modal-body">
              <div class="input-group mb-3">
                <input type="text" name="fullname" class="form-control" placeholder="Fullname">
              </div>

              <div class="input-group mb-3">
                <input type="number" name="contact" class="form-control" placeholder="Contact">
              </div>
              <div class="input-group mb-3">
                <input type="text" name="address" class="form-control" placeholder="Address">
              </div>
              <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username">
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="input-group mb-3">
                <select name="user_type" class="form-control" >
                  <option value="2">User</option>
                  <option value="1">Admin</option>
                </select>
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

      <div class="modal fade" id="editUser">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/updateUser.php">

              <div class="modal-body">
              <div class="input-group mb-3">
                <input type="hidden" name="id" id="e_id">
                <input type="text" name="fullname" id="e_fullname" class="form-control" placeholder="Fullname">
              </div>

              <div class="input-group mb-3">
                <input type="number" name="contact" id="e_contact" class="form-control" placeholder="Contact">
              </div>
              <div class="input-group mb-3">
                <input type="text" name="address" id="e_address" class="form-control" placeholder="Address">
              </div>
              <div class="input-group mb-3">
                <input type="text" name="username" id="e_username" class="form-control" placeholder="Username">
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" id="e_password" class="form-control" placeholder="Password">
              </div>
              <div class="input-group mb-3">
                <select name="user_type" class="form-control" >
                  <option id="op2" value="2">User</option>
                  <option id="op1" value="1">Admin</option>
                </select>
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

      <div class="modal fade" id="deleteUse">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete building</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="action/deleteUser.php">
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
  $('#users').addClass('menu-open');
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
        title: 'Success ".$_SESSION['success']." user!'
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
        url: 'action/user_row.php',
        data:{id:id},
        dataType: 'json',
        success: function(data) {
          $('#e_id').val(data.id);
          $('#e_fullname').val(data.fullname);
          $('#e_contact').val(data.contact);
          $('#e_address').val(data.address);
          $('#e_username').val(data.username);
          $('#e_password').val(data.password);
          if (data.user_type == 1) {
            $('#op1').attr('selected','select');
          }else{
             $('#op2').attr('selected','select');
          }
          
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
        url: 'action/user_row.php',
        data:{id:id},
        dataType: 'json',
        success: function(data) {
          $('#delete_id').val(data.id);
          $('#delete_name').html(data.fullname);
        }
      });
    });
  });
</script>
</body>
</html>
