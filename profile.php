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
            <h1 class="m-0 text-dark">My Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row ">
           <div class="col-md-1">
             
           </div>
           <div class="col-md-10">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user" >
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"><?php echo $_SESSION['user_name'] ?></h3>
                <h5 class="widget-user-desc"><?php echo ($_SESSION['role'] == 1)? 'Admin' : 'Staff'; ?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?php echo $_SESSION['img_url'] ?>" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right" style="margin-top:20px ;">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $_SESSION['contact'] ?></h5>
                      <span class="description-text">Contact</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6 " style="margin-top:20px ;">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $_SESSION['address'] ?></h5>
                      <span class="description-text">Address</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
           <div class="col-md-1">
             
           </div>
          <!-- ./col -->
        </div>
        <center>
          
     <!-- collapsed-card -->
          <div class="card card-default collapsed-card" style="width:83%">
          <div class="card-header">
            <h3 class="card-title">Update Profile</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
             <?php 
                $sql = "SELECT `fullname`, `contact`, `address`, `username`, `password`, `user_type` FROM `users_tbl` WHERE id = '".$_SESSION['admin']."'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
              ?>
              <div class="col-md-6">
               <form method="POST" action="action/updateUser.php">
                <div class="form-group">
                  <label class="float-left">Fullname</label>
                  <input type="hidden" name="id" value="<?php echo $_SESSION['admin'] ?>">
                  <input type="text" name="fullname" class="form-control" style="width: 100%;" value="<?php echo $row['fullname'] ?>">
                 
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="float-left">Contact</label>
                  <input type="text" name="contact" class="form-control" style="width: 100%;" value="<?php echo $row['contact'] ?>">
                </div>

                <div class="form-group">
                  <label class="float-left">Address</label>
                  <input type="text" name="address" class="form-control" style="width: 100%;" value="<?php echo $row['address'] ?>">
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label class="float-left">username</label>
                  <input type="text" name="username" class="form-control" style="width: 100%;" value="<?php echo $row['username'] ?>">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="float-left">Password</label> 
                  <input type="password" name="password" class="form-control" style="width: 100%;" value="<?php echo $row['password'] ?>">
                  <input type="hidden" name="user_type" value="">
                </div>

                 <div class="form-group">
                  <label class="float-left"> &ensp;&ensp;</label>
                  <input type="submit"  name="submit" class="form-control btn btn-primary" style="width: 100%;" >
                </div>
                <!-- /.form-group -->
              </div>
            </form>
              <!-- /.col -->
           
            </div>
            <!-- /.row -->

        </div>
        </div>
           </center>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
  $('#profile').addClass('menu-open');
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
        title: 'Success ".$_SESSION['success']." profile!'
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
</body>
</html>
