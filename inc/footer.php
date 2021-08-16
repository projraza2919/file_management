<div class="modal fade" id="get_file_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="acc_info_id"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div class="row">
          <div class="col-lg-12">
            <embed id="embed" src="#" width="100%" height="400" />
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="delete_file_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="acc_info_id"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Delete File</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="inc/delete_file.php" method="post">
                <input type="text" id="delete_id" name="id" value="" hidden required>
                <button type="submit" class="btn btn-primary">Confirm Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="update_file_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="acc_info_id"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update File</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" action="inc/update_file.php" method="post">
                <input type="text" id="mainid" name="id" value="" hidden required>
                <div class="card-body">
                  <div class="form-group">
                    <label for="Name">Title</label>
                    <input type="text" class="form-control" id="Name_n" placeholder="Title" name="name">
                  </div>
                  <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="Description_d" placeholder="Enter updated Description" name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="input_file">Update file</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="input_file" name="image">
                        <label class="custom-file-label" for="input_file">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<footer class="main-footer">
    <strong>Developed by <a href="#" target="blank_">RAZA</a> .</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript">
  

      function file_details(mainid){
      var id= mainid;
      var gid="file_show.php?id="+id;
      $("#embed").attr("src",gid);
      $('#get_file_modal').modal('show');
    }
    function file_delete(mainid){
      var id= mainid;
      var gid="file_show.php?id="+id;
      $("#delete_id").val(id);
      $('#delete_file_modal').modal('show');
    }

    /*
    function file_details(mainid){
      var id= mainid;
      $.ajax({
    type: 'POST',
    url: 'inc/get_file_info.php',
    data: { 
        'id':id
    },
    success: function(data){
      const arr = JSON.parse(data);
      if (arr.status==true) {
        
        $('#get_file_modal').modal('show');
      }else{

      }
    }
});
    }
    */


    function file_update(mainid){

      var id= mainid;
            $.ajax({
    type: 'POST',
    url: 'inc/get_file_info.php',
    data: { 
        'id':id
    },
    success: function(data){
      const arr = JSON.parse(data);
      if (arr.status==true) {
        
       $("#mainid").val(id);
       $("#Name_n").val(arr.name);
       $("#Description_d").val(arr.description);

      $('#update_file_modal').modal('show');
      }else{
        alert(arr.msg);
      }
    }
});

     
      
    }

            


</script>
