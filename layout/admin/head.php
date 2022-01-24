<!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

        <title><?= $title; ?></title>

        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/jquery/jquery-3.6.0.min.js"></script>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
        
        <?php if(isset($select2)) { ?>
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/select2/css/select2.min.css">
        <?php } ?>

           
        <?php if(isset($chart)) { ?>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/highchart/highcharts.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/highchart/series-label.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/highchart/exporting.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/highchart/export-data.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/highchart/accessibility.js"></script>
        <?php } ?>

        <?php 
            if(isset($editor)) { 
        ?>
        <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/plugins/summernote/summernote.min.css" rel="stylesheet">
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/plugins/summernote/summernote.min.js" defer></script>
        <?php } ?>
                
        <?php if(isset($switch)) { ?>
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        <?php } ?>
                
        <link rel="stylesheet" id="css-main" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/css/dashmix.min.css" />
            
        <?= theme_mode(); ?>

        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/plugins/sweetalert2@11.js"></script>
        
        <?php if(isset($code_bg)) { ?>
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/plugins/highlight/styles/monokai-sublime.min.css">
        <?php } ?>

        <link rel="shortcut icon" href="<?= $JTech->setting('favicon'); ?>">

    </head>
    <!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->

    <style>
        @media screen and (min-width: 800px) {
            #DataTables_Table_0_filter {
                float: right!important;
            }
        }
    </style>