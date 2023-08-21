<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?= $title ?? 'Unit Kerja'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="<?= $this->security->get_csrf_hash(); ?>"/>
    <meta name="csrf-name" content="<?= $this->security->get_csrf_token_name(); ?>"/>
    <meta name="csrf-cookie" content="<?= $this->config->item('csrf_cookie_name'); ?>"/>
    <?= $metadata; ?>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- main css -->
    <link rel="shortcut icon" href="<?= base_url(); ?>ugmfw-assets/images/favicon.ico" />
    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>ugmfw-assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/widgets.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/themes/yellow/pace-theme-minimal.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/ugm-custom.css" media="all" rel="stylesheet" type="text/css" /> 

    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>ugmfw-assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="<?= base_url(); ?>ugmfw-assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>ugmfw-assets/plugins/datatables.net-bs/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?= base_url(); ?>ugmfw-assets/plugins/select2/css/select2.css" rel="stylesheet">

    <link href="<?= base_url(); ?>ugmfw-assets/stylesheets/style_cetak.css" type="text/css" rel="stylesheet">
    <script type="text/javascript">
      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
    </script>

    <!-- custom css -->
    <?= $css; ?>
    <noscript>
    <style> 
      #subcontent-element { display: none } 
      #table-condensed { margin:auto; text-align: center; margin-left: auto; margin-right: auto; justify-content: center; align-items: center;} 
    </style>
    </noscript>

    <!-- initJS -->
    <!--[if lt IE 9]>
            <script src="ugmfw-assets/javascripts/ie.min.js"></script>
    <![endif]-->
    <!--[if !IE]> -->
    <script src="<?= base_url(); ?>ugmfw-assets/javascripts/jquery-2.0.3.min.js"></script><!-- <![endif]-->
    <!--[if lte IE 9]>
        <script src="<?= base_url(); ?>ugmfw-assets/javascripts/jquery-1.8.3.min.js"></script>
    <![endif]-->
  </head>
  <body class="theme-clean main-menu-animated main-navbar-fixed main-menu-fixed page-profile hold-transition fixed <?= $body_class; ?>">
    <script type="text/javascript">
      var init = [];
      var checked = [];
      var env = "<?= $_SERVER['CI_ENV']; ?>";
      var base = "<?= base_url(); ?>";
      localStorage['ugmfwCache'] = ''; 
    </script>
    <script src="<?= base_url(); ?>ugmfw-assets/javascripts/demo.js"></script>

    <div id="main-wrapper">
      <div id="cover-spin"></div>

      <div id="main-navbar" class="navbar navbar-inverse" role="navigation">
        <?= $this->header(); ?>
      </div>
      <div id="main-menu" role="navigation"> <?= $this->menu(); ?> </div>
      <div id="main-menu-bg"></div>
      <div id="content-wrapper">
        <div class="busy-indicator modal-backdrop fade in" style='display:none;'>
          <div class="row">
            <div class='col-sm-12' style='text-align:center;margin-top:15%;'>
              <img src="<?= base_url(); ?>ugmfw-assets/images/ugm-gold.png"/>
            </div>
          </div>
        </div>
        <noscript>
        <div class="page-header">
          <div class="row">
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm">
              <i class="fa fa-unlink" page-header-icon></i>&nbsp;Error Occurred
            </h1>
          </div>
        </div>
        <div class="note note-danger"><b>Sorry</b>, You don't have javascript enabled in your browser.</div>
        </noscript>
        <div id="subcontent-element"> <?= $content; ?> </div>
      </div>
      <footer class="main-footer px-footer p-t-0 px-footer-fixed">
        <span class="text-muted"><?= $this->config->item('footer'); ?></span>
      </footer>
    </div>

    <!-- main js -->
    <script src="<?= base_url(); ?>ugmfw-assets/javascripts/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/javascripts/pixel-admin.min.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/javascripts/ajax.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/javascripts/main.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/javascripts/pace.min.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/javascripts/jsTree/jquery.jstree.min.js"></script>
    <!--[if lt IE 9]>
        <script src="<?= base_url(); ?>ugmfw-assets/javascripts/ie.min.js"></script>
    <![endif]-->

    <script src="<?= base_url(); ?>ugmfw-assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>

    <script src="<?= base_url(); ?>ugmfw-assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url(); ?>ugmfw-assets/plugins/select2/js/select2.full.min.js"></script>

    <!-- custom js -->
    <?= $js; ?> 

    <script type="text/javascript">

      // On Load Page
      $(window).on('load', function() { $("#cover-spin").fadeOut(200); });
      function loadpage() { $(window).load(); }
      //setTimeout(loadpage, 1000);

      init.push(function () {
          menu_selected();
      });
      window.PixelAdmin.start(init);

      $(function () {

        $('[data-toggle="tooltip"]').tooltip();
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' }) //Datemask dd/mm/yyyy        
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' }) //Datemask2 mm/dd/yyyy
        $('[data-mask]').inputmask()

        $('.datepicker').datepicker({ autoclose: true }) //Date picker //$("#datepicker").datepicker("setDate", new Date());

        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function() {
          var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready( function() {
            $(':file').on('fileselect', function(event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
        });
        
      });

      $.fn.datepicker.dates['en'] = {
        days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"],
        daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        //daysMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        daysMin: ["Mi", "Sn", "Sl", "Ra", "Ka", "Ju", "Sa"],
        months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        today: "Today",
        clear: "Clear",
        format: "dd/mm/yyyy",
        titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
        weekStart: 1
      };

      $('#calendar').datepicker("setDate", "NOW");

      $(".yearpicker").datepicker({
        format: "yyyy",
        weekStart: 1,
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
      });
      
      init.push(function () {
        var options = {
          minuteStep: 1,
          showSeconds: true,
          showMeridian: false,
          showInputs: false,
          orientation: $('body').hasClass('right-to-left') ? { x: 'right', y: 'auto'} : { x: 'auto', y: 'auto'}
        }
        $('.timepicker').timepicker(options);
      });

    </script>

  </body>
</html>