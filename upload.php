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
  <title>home | USER</title>
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
            <h1 class="m-0 text-dark">Welcome to file Management system</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">/</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    

<section class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-lg-12">
          	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Upload File</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" action="inc/upload_file.php" method="post">
              	
                <div class="card-body">
                <div class="form-group">
                    <label for="file">Select file (PDF,xls only)</label>
                    <input type="file" name="image" class="form-control" id="file" placeholder="Enter Title" required>
                  </div>
                  <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Title" required>
                  </div>
                  <div class="form-group">
                    <label for="description">Description(optional)</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                    
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
              </form>
            </div>
          </div>
       </div>
    </div>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require('inc/footer.php'); ?>
</body>
</html>
