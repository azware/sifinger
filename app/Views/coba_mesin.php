<?php

use TADPHP\TAD;
use TADPHP\TADFactory;

$csrf_token = csrf_token();
$csrf_hash = csrf_hash();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi SDM | Dashboard</title>

  <link rel="shortcut icon" href="assets/images/ugm/favicon.ico" />

  <!-- ADMIN LTE 3 -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="adminlte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="adminlte/plugins/summernote/summernote-bs4.min.css">
  <!-- ADMIN LTE 3 -->

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="assets/images/ugm/ugm-blok.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="assets/images/ugm/ugm.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SI SDM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/images/ugm/user-icon.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Programmer</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>
                Mesin Finger
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mesin Finger</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mesin Finger</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Main col -->
          <section class="col-lg-12 connectedSortable">
            <!-- MAIN -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-fingerprint mr-1"></i>&nbsp; Daftar Mesin</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>IP Address</th>
                      <th>Device Name</th>
                      <th>SN</th>
                      <th>Status Mesin</th>
                      <th>Download Log</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($devices as $device) : ?>
                      <tr>
                        <td><?= $device['devid_auto'] ?></td>
                        <td><?= $device['ip_address'] ?></td>
                        <td><?= $device['device_name'] ?></td>
                        <td><?= $device['sn'] ?></td>
                        <td><?php 
                            $tad = (new TADFactory((['ip'=> $device['ip_address'], 'com_key'=>0])))->get_instance();

                            if (!EMPTY($tad)) {
                              echo "<a class='btn btn-xs btn-success' href='#'><i class='fa fa-circle-check'></i>&nbsp; Connected</a>";
                            } else {
                              echo "<a class='btn btn-xs btn-info disabled' href='#'><i class='fa fa-circle-xmark'></i>&nbsp; Disconnected</a>";
                            } ?>
                        </td>
                        <td><?php 
                            if (!EMPTY($tad)) {
                              $down_class = "bg-primary"; $href = "#";
                            } else {
                              $down_class = "bg-info disabled"; $href = "#";
                            }
                            $dev_ip = $device['ip_address'];
                            $dev_nm = $device['device_name'];

                            echo "<a class='btn btn-edit btn-xs $down_class' href='$href' data-target='#downloadModal' data-ip='$dev_ip' data-name='$dev_nm'><i class='fa fa-angles-down'></i>&nbsp; Download csv</a>";

                            ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </section>
          <!-- /.Main col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->

      <form method="POST" enctype="multipart/form-data" id="downloadform">
        <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />
        <div class="modal fade" id="downloadModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="messageModal">
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-fingerprint"></i>&nbsp; Download Log Mesin Presensi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <tbody>
                    <tr> 
                      <th>IP Address</th> 
                      <td><input type="text" class="form-control device_ip" name="device_ip" id="device_ip" placeholder="Device IP"></td> 
                    </tr>
                    <tr> 
                      <th>Device Name</th> 
                      <td><input type="text" class="form-control device_name" name="device_name" id="device_name" placeholder="Device Name"></td> 
                    </tr>
                    <tr>
                      <th>Range Tanggal</th> 
                      <td>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control float-right" id="datelog" name="datelog">
                          </div>
                          <!-- /.input group -->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button type="button" name='submit' id='submit' class="btn btn-sm btn-primary"><i class="fa fa-angles-down"></i>&nbsp; Download</button>
              </div>
              <span id="output"></span>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $(document).ready(function(){  
      $("#submit").click(function (event) {
            //stop submit the form, we will post it manually.
            event.preventDefault();
       
            var form = $('#downloadform')[0]; // Get form            
            var data = new FormData(form); // FormData object
     
            // If you want to add an extra field for the FormData
            data.append("CustomField", "This is some extra data, testing");
            
            // disabled the submit button
            $("#submit").prop("disabled", true);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?= base_url()?>finger/get_log",
                data : data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function (data) {
                    //$("#output").text("SUCCESS : " + data);
                    //console.log("SUCCESS : ", data);
                    $("#submit").prop("disabled", false);
                    $("#messageModal").html("<div id='message'></div>");
                    $("#message")
                      .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-fingerprint'></i>&nbsp; Download Log Progress</h4>")
                      .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><img src='<?= base_url()?>assets/images/ugm/load-baru.gif'> <br>Loading Proses Download....</h5></div></div>")
                      .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
                      .hide()
                      .fadeIn(4000, function () {
                        $("#msgsukses").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-check'></i> Download Sukses</h5> Silahkan cek di folder public, kemudian Refresh halaman untuk download log lagi!</div>");
                      });
                },
                error: function (e) {
                    //$("#output").text("ERROR : " + e.responseText);
                    console.log("ERROR : ", e);
                    $("#submit").prop("disabled", false);
                    $("#messageModal").html("<div id='message'></div>");
                    $("#message")
                      .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-fingerprint'></i>&nbsp; Download Log Progress</h4>")
                      .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-xmark'></i> Download Gagal</h5> Mohon Refresh Halaman ! <br> ERROR : "+e.responseText+" </div></div>")
                      .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
                }
            });
        });
  });
</script>
<!-- ADMIN LTE 3 -->
  <!-- jQuery -->
  <script src="adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $(document).ready(function(){
 
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const ip = $(this).data('ip');
            const name = $(this).data('name');
            // Set data to Form Edit
            $('.device_ip').val(ip);
            $('.device_name').val(name);
            // Call Modal Edit
            $('#downloadModal').modal('show');
        });
 
        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.productID').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

        //Date range picker
        $('#datelog').daterangepicker()
    });
  </script>
  <!-- Bootstrap 4 -->
  <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="adminlte/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="adminlte/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="adminlte/plugins/moment/moment.min.js"></script>
  <script src="adminlte/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="adminlte/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="adminlte/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="adminlte/dist/js/pages/dashboard.js"></script>
<!-- ADMIN LTE 3 -->

</body>
</html>