<?php 
session_start();

$_SESSION['basefile']=basename(__FILE__, '.php'); 
//include 'inc/db.php';
include 'inc/auth.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>home | File List</title>
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
            <h1 class="m-0 text-dark">List of files uploaded</h1>
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
    
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php  
          $userid=$_SESSION['id'];
          $sql="SELECT * FROM files WHERE userid='$userid' AND status='inserted'";
          if (mysqli_query($conn,$sql)) {
            $run=mysqli_query($conn,$sql);
            if (mysqli_num_rows($run)>0) {
              while ($fetch=mysqli_fetch_assoc($run)) {
                if ($fetch['typeof']=='pdf') {
                  $bg='bg-gradient-info';
                }elseif($fetch['typeof']=='xls'){
                  $bg='bg-gradient-warning';
                }else{
                  $bg='bg-gradient-primary';
                }
                echo '<div class="col-md-3 col-sm-6 col-12">
            <div class="info-box '.$bg.'" onclick="file_details(this.id)" id="'.$fetch['id'].'">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">'.$fetch['name'].'</span>
                <span class="info-box-number">'.$fetch['typeof'].'</span>
                <span class="progress-description">
                  '.date("d-m-Y H:i:s",$fetch['added_on']).'
                </span><br><span>Description: '.$fetch['description'].'</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>';
              }
            }
          }
          ?>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require('inc/footer.php'); ?>

 
</body>
</html>
