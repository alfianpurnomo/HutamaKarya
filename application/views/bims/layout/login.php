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
    <link rel="stylesheet" type="text/css" href="<?php echo $CSS_URL; ?>style-default.css">



    <script type="text/javascript">
        <!--

        function updateClock() {
            var currentTime = new Date();

            var currentHours = currentTime.getHours();
            var currentMinutes = currentTime.getMinutes();
            var currentSeconds = currentTime.getSeconds();

            // Pad the minutes and seconds with leading zeros, if required
            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

            // Choose either "AM" or "PM" as appropriate
            var timeOfDay = (currentHours < 12) ? "AM" : "PM";

            // Convert the hours component to 12-hour format if needed
            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;

            // Convert an hours component of "0" to "12"
            currentHours = (currentHours == 0) ? 12 : currentHours;

            // Compose the string for display
            var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

            // Update the time display
            document.getElementById("clock").firstChild.nodeValue = currentTimeString;
        }

        // -->
    </script>

    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/plugins.js"></script>

    <!-- Toastr Alert -->
    <link href="<?php echo $CSS_URL ?>toastr/toastr.min.css" rel="stylesheet">
    <script src="<?php echo $JS_URL ?>toastr/toastr.min.js"></script>
</head>

<body onload="updateClock(); setInterval('updateClock()', 1000 )">

    <div class="wrapper has-footer" style="background-color:#fff;">



        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <title><?php echo (isset($page_title)) ? $site_setting['app_title'].' : '.$page_title : $site_setting['app_title']; ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <meta name="author" content="djakartarayasemesta">
            <meta name="description" content="">

            <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/modernizr.js"></script>
            <link rel="icon" href="<?php echo $IMG_URL; ?>favicon.png" type="image/gif">

            <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>bootstrap/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="<?php echo $PLUGINS_URL; ?>animate-it/animate.min.css">
            <link rel="stylesheet" type="text/css" href="<?php echo $CSS_URL; ?>lib/cmp-bs-checkbox.css">

            <link rel="stylesheet" type="text/css" href="<?php echo $CSS_URL; ?>lib/page-login.css">
            <link rel="stylesheet" type="text/css" href="<?php echo $CSS_URL; ?>style-default.css">
            <style>
                    body {
                    color: #363A5C;
            </style>
        </head>

        <body>

            <div class="container">
                <?php if (isset($flash_message)) {
                    echo $flash_message;
                } ?>
                <?php if (isset($persistent_message)) {
                    echo $persistent_message;
                } ?>
                <?php echo $content; ?>
            </div>
            <!-- Container End -->


            <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/jquery-2.2.4.min.js"></script>
            <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>lib/jquery-ui.min.js"></script>
            <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>bootstrap/bootstrap.min.js"></script>
            <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>animate-it/animate-it.js"></script>
            <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>animate-it/arrow-line.js"></script>
        </body>

        </html>
    </div>
    <!-- END: wrapper -->

    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>flot/excanvas.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>flot/jquery.flot.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>flot/jquery.flot.tooltip.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>flot/jquery.flot.resize.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>flot/jquery.flot.crosshair.min.js"></script>
    <script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>flot/jquery.flot.pie.min.js"></script>

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
    <script>
        jQuery(document).ready(function() {
            DataTableBasic.init();
        });
    </script>
</body>

</html>