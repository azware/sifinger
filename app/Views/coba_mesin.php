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
  <title>Sistem Fingerprint | Dashboard</title>

  <link rel="shortcut icon" href="assets/images/favicon.ico" />

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
    <img class="animation__shake" src="assets/images/fingerprint_logo.png" alt="AdminLTELogo" height="60" width="60">
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
      <img src="assets/images/fingerprint_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SI FINGER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/images/user-icon.png" class="img-circle elevation-2" alt="User Image">
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
                      <th>Download Fingerprint</th>
                      <th>Download Log</th>
                      <th>Upload User</th>
                      <th>Upload Fingerprint</th>
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
                            $dev_ip = $device['ip_address'];
                            $dev_nm = $device['device_name'];

                            echo "<a class='btn btn-downfin btn-xs bg-purple' href='#' data-target='#downfinModal' data-ip='$dev_ip' data-name='$dev_nm'><i class='fa fa-users'></i>&nbsp; Download Fingerprint</a>"; 
                            ?>
                        </td>
                        <td><?php 
                            if (!EMPTY($tad)) $down_class = "bg-primary"; else $down_class = "bg-primary disabled";

                            echo "<a class='btn btn-downlog btn-xs $down_class' href='#' data-target='#downloadModal' data-ip='$dev_ip' data-name='$dev_nm'><i class='fa fa-angles-down'></i>&nbsp; Download csv</a>"; 
                            ?>
                        </td>
                        <td><?php
                            echo "<a class='btn btn-upuser btn-xs bg-info' href='#' data-target='#upuserModal' data-ip='$dev_ip' data-name='$dev_nm'><i class='fa fa-user'></i>&nbsp; Upload User</a>"; 
                            ?>
                        </td>
                        <td><?php
                            echo "<a class='btn btn-upfin btn-xs bg-navy' href='#' data-target='#upfinModal' data-ip='$dev_ip' data-name='$dev_nm'><i class='fa fa-hand'></i>&nbsp; Upload Fingerprint</a>"; 
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

      <form method="POST" enctype="multipart/form-data" id="downfinform">
        <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />
        <div class="modal fade" id="downfinModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="messageModaldownfin">
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-users"></i>&nbsp; Download User Mesin Presensi</h4>
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
                      <th colspan="2">Apakah anda yakin akan Mendownload User dan Rekam Fingerprintnya dari mesin ini ?</th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button type="button" name='submitdownfin' id='submitdownfin' class="btn btn-sm btn-primary"><i class="fa fa-angles-down"></i>&nbsp; Ya, Download</button>
              </div>
              <span id="output"></span>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>

      <form method="POST" enctype="multipart/form-data" id="downloadform">
        <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />
        <div class="modal fade" id="downloadModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="messageModaldownlog">
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-angles-down"></i>&nbsp; Download Log Mesin Presensi</h4>
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
                <button type="button" name='submitdownlog' id='submitdownlog' class="btn btn-sm btn-primary"><i class="fa fa-angles-down"></i>&nbsp; Download</button>
              </div>
              <span id="output"></span>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>

      <form method="POST" enctype="multipart/form-data" id="upuserform">
        <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />
        <div class="modal fade" id="upuserModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="messageModalupuser">
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user"></i>&nbsp; Upload User</h4>
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
                      <th>Pilih File</th> 
                      <td>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file_upuser" name="file_upuser">
                          <label class="custom-file-label" for="file_upuser">Pilih File User</label>
                        </div>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button type="button" name='submitupuser' id='submitupuser' class="btn btn-sm btn-success"><i class="fa fa-angles-up"></i>&nbsp; Upload</button>
              </div>
              <span id="output"></span>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>

      <form method="POST" enctype="multipart/form-data" id="upfinform">
        <input type="hidden" name="<?= $csrf_token; ?>" value="<?= $csrf_hash; ?>" />
        <div class="modal fade" id="upfinModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="messageModalupfin">
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-fingerprint"></i>&nbsp; Upload Fingerprint</h4>
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
                      <th>Pilih File</th> 
                      <td>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file_upfin" name="file_upfin">
                          <label class="custom-file-label" for="file_upfin">Pilih File Fingerprint</label>
                        </div>
                      </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button type="button" name='submitupfin' id='submitupfin' class="btn btn-sm btn-success"><i class="fa fa-angles-up"></i>&nbsp; Upload</button>
              </div>
              <span id="output"></span>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>

      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-xmark"></i> Download Gagal | Mesin : <b>Presensi - LOBBY</b></h5> Mohon Refresh Halaman ! <br> ERROR : <br>
        <b>Fatal error</b>:  Uncaught CodeIgniter\Format\Exceptions\FormatException: Failed to parse JSON string. Error: Type is not supported in E:\Azzam\xampp\htdocs\sisdm\system\Format\JSONFormatter.php:41
        Stack trace:
        #0 E:\Azzam\xampp\htdocs\sisdm\system\Format\JSONFormatter.php(41): CodeIgniter\Format\Exceptions\FormatException::forInvalidJSON('Type is not sup...')
        #1 E:\Azzam\xampp\htdocs\sisdm\system\API\ResponseTrait.php(346): CodeIgniter\Format\JSONFormatter-&gt;format(Array)
        #2 E:\Azzam\xampp\htdocs\sisdm\system\API\ResponseTrait.php(99): CodeIgniter\Debug\Exceptions-&gt;format(Array)
        #3 E:\Azzam\xampp\htdocs\sisdm\system\Debug\Exceptions.php(145): CodeIgniter\Debug\Exceptions-&gt;respond(Array, 500)
        #4 [internal function]: CodeIgniter\Debug\Exceptions-&gt;exceptionHandler(Object(TypeError))
        #5 {main}
          thrown in <b>E:\Azzam\xampp\htdocs\sisdm\system\Format\JSONFormatter.php</b> on line <b>41</b><br>
        {
            "title": "ErrorException",
            "type": "ErrorException",
            "code": 500,
            "message": "Uncaught CodeIgniter\\Format\\Exceptions\\FormatException: Failed to parse JSON string. Error: Type is not supported in E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\Format\\JSONFormatter.php:41\nStack trace:\n#0 E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\Format\\JSONFormatter.php(41): CodeIgniter\\Format\\Exceptions\\FormatException::forInvalidJSON('Type is not sup...')\n#1 E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\API\\ResponseTrait.php(346): CodeIgniter\\Format\\JSONFormatter-&gt;format(Array)\n#2 E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\API\\ResponseTrait.php(99): CodeIgniter\\Debug\\Exceptions-&gt;format(Array)\n#3 E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\Debug\\Exceptions.php(145): CodeIgniter\\Debug\\Exceptions-&gt;respond(Array, 500)\n#4 [internal function]: CodeIgniter\\Debug\\Exceptions-&gt;exceptionHandler(Object(TypeError))\n#5 {main}\n  thrown\n【Previous Exception】\nTypeError\nfputcsv(): Argument #2 ($fields) must be of type array, string given\n#0 E:\\Azzam\\xampp\\htdocs\\sisdm\\app\\Controllers\\Finger.php(94): fputcsv(Resource id #176, '11703')\n#1 E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\CodeIgniter.php(934): App\\Controllers\\Finger-&gt;get_log()\n#2 E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\CodeIgniter.php(499): CodeIgniter\\CodeIgniter-&gt;runController(Object(App\\Controllers\\Finger))\n#3 E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\CodeIgniter.php(368): CodeIgniter\\CodeIgniter-&gt;handleRequest(NULL, Object(Config\\Cache), false)\n#4 E:\\Azzam\\xampp\\htdocs\\sisdm\\public\\index.php(67): CodeIgniter\\CodeIgniter-&gt;run()\n#5 {main}",
            "file": "E:\\Azzam\\xampp\\htdocs\\sisdm\\system\\Format\\JSONFormatter.php",
            "line": 41,
            "trace": [
                {
                    "function": "shutdownHandler",
                    "class": "CodeIgniter\\Debug\\Exceptions",
                    "type": "-&gt;",
                    "args": []
                }
            ]
        } 
      </div>

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
    $("#submitdownfin").click(function (event) {
        //stop submit the form, we will post it manually.
        event.preventDefault();
   
        var form = $('#downfinform')[0]; // Get form            
        var data = new FormData(form); // FormData object
 
        // If you want to add an extra field for the FormData
        data.append("CustomField", "This is some extra data, testing");
        
        // disabled the submit button
        $("#submitdownfin").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?= base_url()?>finger/get_finger",
            data : data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            success: function (data) {
                //$("#output").text("SUCCESS : " + data);
                //console.log("SUCCESS : ", data);
                $("#submitdownfin").prop("disabled", false);
                $("#messageModaldownfin").html("<div id='message'></div>");
                $("#message")
                  .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-users'></i>&nbsp; Download Progress</h4>")
                  .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><img src='<?= base_url()?>assets/images/load-baru.gif'> <br>Loading Proses Download....</h5></div></div>")
                  .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
                  .hide()
                  .fadeIn(4000, function () {
                    $("#msgsukses").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-check'></i> Download Sukses</h5> Silahkan cek di folder public, kemudian Refresh halaman untuk download User lagi!</div>");
                  });
            },
            error: function (e) {
                //$("#output").text("ERROR : " + e.responseText);
                console.log("ERROR : ", e);
                $("#submitdownfin").prop("disabled", false);
                $("#messageModaldownfin").html("<div id='message'></div>");
                $("#message")
                  .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-users'></i>&nbsp; Download Progress</h4>")
                  .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-xmark'></i> Download Gagal</h5> Mohon Refresh Halaman ! <br> ERROR : "+e.responseText+" </div></div>")
                  .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
            }
        });
      });
    $("#submitdownlog").click(function (event) {
        //stop submit the form, we will post it manually.
        event.preventDefault();
   
        var form = $('#downloadform')[0]; // Get form            
        var data = new FormData(form); // FormData object
 
        // If you want to add an extra field for the FormData
        data.append("CustomField", "This is some extra data, testing");
        
        // disabled the submit button
        $("#submitdownlog").prop("disabled", true);

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
                $("#submitdownlog").prop("disabled", false);
                $("#messageModaldownlog").html("<div id='message'></div>");
                $("#message")
                  .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-fingerprint'></i>&nbsp; Download Log Progress</h4>")
                  .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><img src='<?= base_url()?>assets/images/load-baru.gif'> <br>Loading Proses Download....</h5></div></div>")
                  .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
                  .hide()
                  .fadeIn(4000, function () {
                    $("#msgsukses").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-check'></i> Download Sukses</h5> Silahkan cek di folder public, kemudian Refresh halaman untuk download log lagi!</div>");
                  });
            },
            error: function (e) {
                //$("#output").text("ERROR : " + e.responseText);
                console.log("ERROR : ", e);
                $("#submitdownlog").prop("disabled", false);
                $("#messageModaldownlog").html("<div id='message'></div>");
                $("#message")
                  .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-fingerprint'></i>&nbsp; Download Log Progress</h4>")
                  .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-xmark'></i> Download Gagal</h5> Mohon Refresh Halaman ! <br> ERROR : "+e.responseText+" </div></div>")
                  .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
            }
        });
      });
    $("#submitupuser").click(function (event) {
        //stop submit the form, we will post it manually.
        event.preventDefault();
   
        var form = $('#upuserform')[0]; // Get form            
        var data = new FormData(form); // FormData object
        
        // disabled the submit button
        $("#submitupuser").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?= base_url()?>finger/set_user",
            data : data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            success: function (data) {
                //$("#output").text("SUCCESS : " + data);
                //console.log("SUCCESS : ", data);
                $("#submitupuser").prop("disabled", false);
                $("#messageModalupuser").html("<div id='message'></div>");
                $("#message")
                  .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-user'></i>&nbsp; Upload User Progress</h4>")
                  .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><img src='<?= base_url()?>assets/images/load-baru.gif'> <br>Loading Proses Upload....</h5></div></div>")
                  .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
                  .hide()
                  .fadeIn(4000, function () {
                    $("#msgsukses").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-check'></i> Upload Sukses</h5> Silahkan cek di mesin fingerprint, kemudian Refresh halaman untuk upload user lagi!</div>");
                  });
            },
            error: function (e) {
                //$("#output").text("ERROR : " + e.responseText);
                console.log("ERROR : ", e);
                $("#submitupuser").prop("disabled", false);
                $("#messageModalupuser").html("<div id='message'></div>");
                $("#message")
                  .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-user'></i>&nbsp; Upload User Progress</h4>")
                  .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-xmark'></i> Upload Gagal</h5> Mohon Refresh Halaman ! <br> ERROR : "+e.responseText+" </div></div>")
                  .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
            }
        });
      });
    $("#submitupfin").click(function (event) {
        //stop submit the form, we will post it manually.
        event.preventDefault();
   
        var form = $('#upfinform')[0]; // Get form            
        var data = new FormData(form); // FormData object
        
        // disabled the submit button
        $("#submitupfin").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?= base_url()?>finger/set_finger",
            data : data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            success: function (data) {
                //$("#output").text("SUCCESS : " + data);
                //console.log("SUCCESS : ", data);
                $("#submitupfin").prop("disabled", false);
                $("#messageModalupfin").html("<div id='message'></div>");
                $("#message")
                  .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-hand'></i>&nbsp; Upload Fingerprint Progress</h4>")
                  .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><img src='<?= base_url()?>assets/images/load-baru.gif'> <br>Loading Proses Upload....</h5></div></div>")
                  .append("<div class='modal-footer justify-content-between'><button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button></div>")
                  .hide()
                  .fadeIn(4000, function () {
                    $("#msgsukses").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-check'></i> Upload Sukses</h5> Silahkan cek di mesin fingerprint, kemudian Refresh halaman untuk upload fingerprint lagi!</div>");
                  });
            },
            error: function (e) {
                //$("#output").text("ERROR : " + e.responseText);
                console.log("ERROR : ", e);
                $("#submitupfin").prop("disabled", false);
                $("#messageModalupfin").html("<div id='message'></div>");
                $("#message")
                  .html("<div class='modal-header'><h4 class='modal-title'><i class='fa fa-hand'></i>&nbsp; Upload Fingerprint Progress</h4>")
                  .append("<div class='modal-body card-body' id='msgsukses'><div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h5><i class='icon fas fa-xmark'></i> Upload Gagal</h5> Mohon Refresh Halaman ! <br> ERROR : "+e.responseText+" </div></div>")
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
  <!-- Bootstrap 4 -->
  <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="adminlte/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>

  <script>
    $(document).ready(function(){
 
        // get Download Log
        $('.btn-downfin').on('click',function(){
            // get data from button
            const ip = $(this).data('ip');
            const name = $(this).data('name');
            // Set data to Form
            $('.device_ip').val(ip);
            $('.device_name').val(name);
            // Call Modal
            $('#downfinModal').modal('show');
        });

        // get Download Log
        $('.btn-downlog').on('click',function(){
            // get data from button
            const ip = $(this).data('ip');
            const name = $(this).data('name');
            // Set data to Form
            $('.device_ip').val(ip);
            $('.device_name').val(name);
            // Call Modal
            $('#downloadModal').modal('show');
        });
 
        // get Upload User
        $('.btn-upuser').on('click',function(){
            // get data from button
            const ip = $(this).data('ip');
            const name = $(this).data('name');
            // Set data to Form
            $('.device_ip').val(ip);
            $('.device_name').val(name);
            // Call Modal
            $('#upuserModal').modal('show');
        });

        // get Upload Fingerprint
        $('.btn-upfin').on('click',function(){
            // get data from button
            const ip = $(this).data('ip');
            const name = $(this).data('name');
            // Set data to Form
            $('.device_ip').val(ip);
            $('.device_name').val(name);
            // Call Modal
            $('#upfinModal').modal('show');
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
        $('#datelog').daterangepicker();
        //File Input Custom
        bsCustomFileInput.init();
    });

  </script>
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