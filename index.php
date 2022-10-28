
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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
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
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php include 'libs/connection.php'; ?>
                  <?php 
                  $sqlqw = "SELECT count(id) AS C FROM `users_tbl`";
                  $result1 = $conn->query($sqlqw);
                  $row2 = $result1->fetch_assoc();
                     
                  ?>
                <h3><?php echo $row2['C'];?></h3>

                <p>Total of users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php include 'libs/connection.php'; ?>
                  <?php 
                  $sqlqw = "SELECT count(id) AS C FROM `building_tbl`";
                  $result1 = $conn->query($sqlqw);
                  $row2 = $result1->fetch_assoc();
                     
                  ?>
                <h3><?php echo $row2['C'];?></h3>

                <p>Total of Building</p>
              </div>
              <div class="icon">
                <i class="fas fa-building"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php include 'libs/connection.php'; ?>
                  <?php 
                  $sqlqw = "SELECT count(id) AS C FROM `checking_tbl` WHERE status > 0";
                  $result1 = $conn->query($sqlqw);
                  $row2 = $result1->fetch_assoc();
                     
                  ?>
                <h3><?php echo $row2['C'];?></h3>

                <p>Total of equipment checked</p>
              </div>
              <div class="icon">
                <i class="fa fa-check"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php include 'libs/connection.php'; ?>
                  <?php 
                  $sqlqw = "SELECT count(id) AS C FROM `checking_tbl` WHERE status = 0";
                  $result1 = $conn->query($sqlqw);
                  $row2 = $result1->fetch_assoc();
                     
                  ?>
                <h3><?php echo $row2['C'];?></h3>

                <p>Total of equipment not checked</p>
              </div>
              <div class="icon">
                <i class="fa fa-times"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
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
  $('#dashboard').addClass('menu-open');
</script>
</body>
</html>
