<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo ($title) ? $title : 'Universitas Gadjah Mada :: Universitas Berkelas Dunia'; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="csrf-token" content="<?php echo $this->security->get_csrf_hash(); ?>"/>
        <meta name="csrf-name" content="<?php echo $this->security->get_csrf_token_name(); ?>"/>
        <meta name="csrf-cookie" content="<?php echo $this->config->item('csrf_cookie_name'); ?>"/>
        <?php echo $metadata; ?>
        <!-- Open Sans font from Google CDN -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css" />

        <!-- main css -->
        <link href="<?php echo base_url(); ?>ugmfw-assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ugmfw-assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ugmfw-assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ugmfw-assets/stylesheets/widgets.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ugmfw-assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ugmfw-assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>ugmfw-assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ugmfw-assets/stylesheets/themes/yellow/pace-theme-minimal.css" media="all" rel="stylesheet" type="text/css" />	
        <link href="<?php echo base_url(); ?>ugmfw-assets/stylesheets/ugm-custom.css" media="all" rel="stylesheet" type="text/css" />	

        <!-- custom css -->
        <?php echo $css; ?>
        <noscript>
        <style> #subcontent-element { display: none } </style>
        </noscript>

        <!-- initJS -->
        <!--[if lt IE 9]>
                <script src="ugmfw-assets/javascripts/ie.min.js"></script>
        <![endif]-->
        <!--[if !IE]> -->
        <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/jquery-2.0.3.min.js"></script><!-- <![endif]-->
        <!--[if lte IE 9]>
            <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/jquery-1.8.3.min.js"></script>
        <![endif]-->
    </head>
    <body class="theme-clean main-menu-animated main-navbar-fixed main-menu-fixed page-profile <?php echo $body_class; ?>">
        <script type="text/javascript">
            var init = [];
            var checked = [];
            var env = "<?php echo $_SERVER['CI_ENV']; ?>";
            var base = "<?php echo base_url(); ?>";
            localStorage['ugmfwCache'] = '';
        </script>

        <div id="main-wrapper">
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
            <div id="subcontent-element">
                <?php echo $content; ?>
            </div>
        </div>

        <!-- main js -->
        <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/pixel-admin.min.js"></script>
        <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/ajax.js"></script>
        <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/main.js"></script>
        <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/pace.min.js"></script>
        <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/jsTree/jquery.jstree.min.js"></script>
        <!--[if lt IE 9]>
            <script src="<?php echo base_url(); ?>ugmfw-assets/javascripts/ie.min.js"></script>
        <![endif]-->

        <!-- custom js -->
        <?php echo $js; ?> 
        <script type="text/javascript">
                    init.push(function () {});
                    function menu_selected() {

                    }
                    window.PixelAdmin.start(init);
        </script>
    </body>
</html>F