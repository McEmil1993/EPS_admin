<?php  

session_start();

if (isset($_SESSION['admin'])) {
  header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>EPS</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login form</p>

     <form action="userLogin.php" method="POST">
       
  
        <div class="input-group mb-3">
          <input type="text" id="username" name="username" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
    </form>
    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!--  -->
<script type="text/javascript">
$('form').on('submit',function(e){
    e.preventDefault();
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000
    });

    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success  : function(data) {
          if (data == 1) {
            Toast.fire({
              type: 'success',
              title: ' Success Login User'
            }); 
            setTimeout(function() {
             location.reload();
            }, 2000);
            $("#username").val("");
            $("#password").val("");
             $("#username").removeClass('is-invalid');
              $("#password").removeClass('is-invalid');
          }else if(data == 2){
            Toast.fire({
              type: 'warning',
              title: ' Wrong password'
            });
            $("#password").val("");
            $("#password").addClass('is-invalid');
          }else if(data == 0){
            Toast.fire({
              type: 'error',
              title: ' Username is not exist'
            });
            
            $("#password").val("");

            $("#username").addClass('is-invalid');
            $("#password").removeClass('is-invalid');
          }
          else if(data == 3){
            Toast.fire({
              type: 'error',
              title: ' Please enter username!'
            });
            $("#password").removeClass('is-invalid');
            $("#username").addClass('is-invalid');
          }
          else if(data == 4){
            Toast.fire({
              type: 'error',
              title: ' Please enter password!'
            });
            $("#username").removeClass('is-invalid');
            $("#password").addClass('is-invalid');
          }
        }
    });

});
  // $(document).ready(function(){
  //   const Toast = Swal.mixin({
  //     toast: true,
  //     position: 'top-end',
  //     showConfirmButton: false,
  //     timer: 3000
  //   });
  //   $('.login').click(function(){
  //     var username = $('#username').val();
  //     var password = $('#password').val();
  //     $.ajax({
  //       type:'POST',
  //       url: 'userLogin.php',
  //       data:{username:username,password:password},
  //       success: function(data) {
         
  //         if (data == 1) {
  //           Toast.fire({
  //             type: 'success',
  //             title: ' Success Login User'
  //           }); 
  //           setTimeout(function() {
  //            location.reload();
  //           }, 5000);
  //         }else if(data == 2){
  //           Toast.fire({
  //             type: 'warning',
  //             title: ' Wrong password'
  //           });
           
  //         }else{
  //           Toast.fire({
  //             type: 'error',
  //             title: ' Username is not exist'
  //           });
             
  //         }
         
  //       }
  //     });
  //   });
  // });
</script>

</body>
</html>
