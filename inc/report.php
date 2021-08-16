<?php 
session_start();
$_SESSION['basefile']=basename(__FILE__, '.php');
include 'inc/auth.php'; 
include 'inc/db.php';
$u=$_SESSION['username'];
$sel="SELECT status FROM users WHERE username='$u' LIMIT 1";
$t=mysqli_query($conn,$sel);
if (mysqli_num_rows($t)>0) {
  while ($fet=mysqli_fetch_assoc($t)) {
    $stat=$fet['status'];
  }
}
if ($stat!='admin'){ 
  header("Location:get_verified.php");
  exit();
}
$asset_code=$_SESSION['asset_code'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>home | Admin</title>
  <?php include('inc/header.php'); 
  include('inc/side.php');
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 

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
              <li class="breadcrumb-item active"><?php echo $_SESSION['basefile']; ?></li>
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
        	<div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student report</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Student</th>
                      <th>Class</th>
                      <th>marks</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<tr>
                      <td>23</td>
                      <td>Akash mishra</td>
                      <td>XI-D</td>
                      <td>
                        Maths: 63<br>
                        Physics: 56<br>
                        Chemistry: 60<br>
                        Coputer science: 39<br>
                        English: 85
                      </td>
                      <td>Nice student with good character</td>
                    </tr>
                  	
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require('inc/footer.php'); ?>
</body>
</html>
