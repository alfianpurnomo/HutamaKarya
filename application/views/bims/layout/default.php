<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo (isset($page_title)) ? $site_setting['app_title'].' : '.$page_title : $site_setting['app_title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="djakartarayasemesta">
    <meta name="description" content="">

    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/modernizr.js"></script>
    <link rel="icon" href="<?php echo $IMG_URL; ?>logobolt.png" type="image/gif">

    <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>monthly/css/monthly.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>emojionearea/emojionearea.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $CSS_URL; ?>main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $CSS_URL; ?>style-default.css">
    <!-- <link href="<?php echo $CSS_URL; ?>custom.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.15/integration/font-awesome/dataTables.fontAwesome.css">
    <!-- Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>date-picker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>dateTime-picker/css/bootstrap-datetimepicker.min.css">

    <!-- select2 css -->
    <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>select2/css/select2.min.css"> <!-- 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->

    <!-- Jasny Bootstrap -->
        <link href="<?php echo $PLUGINS_URL; ?>jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet"/>
  
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>select2/css/select2_bootstrap.css"> -->

    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBAL_VENDOR_URL?>validation/css/validationEngine.jquery.css">

    <script type="text/javascript">
<!--
        var base_url = '<?php echo base_url(); ?>';
        var current_ctrl = '<?php echo current_controller(); ?>';
        var current_url = '<?php echo current_url(); ?>';
        var assets_url = '<?php echo $ASSETS_URL; ?>';
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var token_key = '<?php echo $this->security->get_csrf_hash(); ?>';
        var objToken = {};
        objToken[token_name] = token_key;
        var loadingBtn  = '<div class="sk-spinner sk-spinner-rotating-plane"></div> Loading...';

        function updateClock ( )
        {
          var currentTime = new Date ( );

          var currentHours = currentTime.getHours ( );
          var currentMinutes = currentTime.getMinutes ( );
          var currentSeconds = currentTime.getSeconds ( );

          // Pad the minutes and seconds with leading zeros, if required
          currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
          currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

          // Choose either "AM" or "PM" as appropriate
          var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

          // Convert the hours component to 12-hour format if needed
          currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

          // Convert an hours component of "0" to "12"
          currentHours = ( currentHours == 0 ) ? 12 : currentHours;

          // Compose the string for display
          var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

          // Update the time display
          document.getElementById("clock").firstChild.nodeValue = currentTimeString;
          //console.log(updateClock);
        }

        // -->
    </script>

    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/plugins.js"></script>

    <!-- select2 plugin -->
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>select2/js/select2.min.js"></script> <!-- 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
    <!-- Datepicker -->
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>date-picker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>dateTime-picker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo $GLOBAL_JS_URL; ?>custom.js"></script>
    <style type="text/css">
        .panel{
            border: 1px solid #CCCACA;
        }
        .table-striped tbody tr.selected {
            background-color: rgba(101, 12, 12, 0.1);
        }
        /* Absolute Center Spinner */
        .loading {
          position: fixed;
          z-index: 9999;
          height: 2em;
          width: 2em;
          overflow: show;
          margin: auto;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
          content: '';
          display: block;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0,0,0,0.3);
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
          /* hide "loading..." text */
          font: 0/0 a;
          color: transparent;
          text-shadow: none;
          background-color: transparent;
          border: 0;
        }

        .loading:not(:required):after {
          content: '';
          display: block;
          font-size: 10px;
          width: 1em;
          height: 1em;
          margin-top: -0.5em;
          -webkit-animation: spinner 1500ms infinite linear;
          -moz-animation: spinner 1500ms infinite linear;
          -ms-animation: spinner 1500ms infinite linear;
          -o-animation: spinner 1500ms infinite linear;
          animation: spinner 1500ms infinite linear;
          border-radius: 0.5em;
          -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
          box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
          0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
        @-moz-keyframes spinner {
          0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
        @-o-keyframes spinner {
          0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
        @keyframes spinner {
          0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
    </style>

</head>
<body onload="updateClock(); setInterval('updateClock()', 1000 )">

    <div class="wrapper has-footer"  style="background-color:#fff;">

        <header class="header-top navbar fixed-top">

            <div class="top-bar">   <!-- START: Responsive Search -->
                <div class="container">
                    <div class="main-search">
                        <div class="input-wrap">
                            <input class="form-control" type="text" placeholder="Search Here...">
                            <a href="#"><i class="sli-magnifier"></i></a>
                        </div>
                        <span class="close-search search-toggle"><i class="ti-close"></i></span>
                    </div>
                </div>
            </div>  <!-- END: Responsive Search -->

            <div class="navbar-header">
                <button type="button" class="navbar-toggle side-nav-toggle">
                    <i class="ti-align-left"></i>
                </button>

                <a class="navbar-brand" href="<?=site_url('dashboard')?>">
                    <!-- <img src="<?php echo $IMG_URL; ?>logobolt.png"> -->
                    <span><?php echo $site_setting['app_title']; ?></span>
                </a>

                <ul class="nav navbar-nav-xs">  <!-- START: Responsive Top Right tool bar -->

                    <li>
                        <a href="javascript:;" class="search-toggle">
                            <i class="sli-magnifier"></i>
                        </a>
                    </li>

                </ul>   <!-- END: Responsive Top Right tool bar -->

            </div>

            <div class="collapse navbar-collapse" id="headerNavbarCollapse">

                <ul class="nav navbar-nav">

                    <li class="hidden-xs">
                        <a href="javascript:;" class="sidenav-size-toggle">
                            <i class="ti-align-left"></i>
                        </a>
                    </li>



                    <!-- <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="sli-envelope"></i>
                            <span class="badge bg-danger"><?php echo $count_notif ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-lg list-group-dropdown">

                            <li class="no-link font-16">You have <?php echo $count_notif ?> new notifications</li>
                            <?php
                            if($count_notif){
                                echo $notif;
                            }
                            ?>

                        </ul>
                    </li> -->
<li><a href="#"><?php echo date('d-M-y') ?> <span id="clock">&nbsp;</span></a></li>

                </ul>

                <ul class="nav navbar-nav navbar-right">


                    <li class="user-profile dropdown">
                        <a href="javascript:;" class="clearfix dropdown-toggle" data-toggle="dropdown">
                            <!-- <img src="<?php echo $IMG_URL; ?>favicon.png" alt="" class="hidden-sm"> -->
                            <div class="user-name"><?=$auth_sess['admin_name']?> <small class="fa fa-angle-down"></small></div>
                        </a>
                        <ul class="dropdown-menu dropdown-animated pop-effect" role="menu">

                            <li><a href="<?php echo site_url('logout') ?>"><i class="sli-logout"></i> Logout</a></li>
                            <li><a href="<?php echo site_url('profile') ?>"><i class="sli-user"></i> Profile</a></li>
                        </ul>
                    </li>

                </ul>

            </div><!-- END: Navbar-collapse -->

        </header>   <!-- END: Header -->
        <aside class="side-navigation-wrap sidebar-fixed">  <!-- START: Side Navigation -->
            <div class="sidenav-inner">

                <ul class="side-nav magic-nav">

                    <li class="side-nav-header">Main Menu</li>
                    <?php echo $main_menu; ?>
                </ul>

            </div><!-- END: sidebar-inner -->

        </aside>    <!-- END: Side Navigation -->

        <div class="main-container">    <!-- START: Main Container -->

            <div class="page-header">
                <ol class="breadcrumb">
                    <?php
                    foreach ($breadcrumbs as $key => $breadcrumb) {
                        echo '<li><a href="'.$breadcrumb['url'].'">'.$breadcrumb['text'].'</a></li>';    # code...
                    }
                    ?>


                </ol>
            </div>

            <div class="content-wrap">  <!--START: Content Wrap-->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="flash-message">
                            <?php
                            if (isset($flash_message)) {
                                echo $flash_message;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php echo $content; ?>
                <div class="loading" style="display: none">Loading&#8230;</div>
            </div>  <!--END: Content Wrap-->

        </div>  <!-- END: Main Container -->


        <footer class="footer"> <!-- START: Footer -->
            <?php echo $site_setting['app_footer']; ?>
        </footer>   <!-- END: Footer -->
    </div>  <!-- END: wrapper -->


    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/sparklines.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/jquery.knob.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>monthly/js/monthly.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>emojionearea/emojionearea.min.js"></script>

    <script type="text/javascript" src="<?php echo $JS_URL; ?>app.base.js"></script>
    <script type="text/javascript" src="<?php echo $JS_URL; ?>cmp-todo.js"></script>
    <script type="text/javascript" src="<?php echo $JS_URL; ?>page-dashboard.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>datatable/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php echo $JS_URL; ?>page-table.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBAL_VENDOR_URL?>validation/js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBAL_VENDOR_URL?>validation/js/languages/jquery.validationEngine-id.js"></script>
    <script src="<?php echo $PLUGINS_URL; ?>jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            DataTableBasic.init();
        });

        var menuExpand = function(){
            var activeLI = $('.sub-menu li.active');
            var par = activeLI.parents('ul').parents('div');
            	par.addClass('in');
            
            $('.active.has-submenu > .sub-menu.secondary').addClass('in');	
            // activeLI.parents('ul').parents('div').parents('ul').parents('div').addClass('in');
            // var ac = $('.side-nav .active');
            // ac.find('.sub-menu').addClass('in');
        };
        menuExpand();

    </script>
</body>
</html>
