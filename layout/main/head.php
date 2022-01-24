<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

        <title><?= $title; ?></title>

        <meta name="description" content="<?= $JTech->setting('description'); ?>">
        <meta name="keywords" content="<?= $JTech->setting('keyword'); ?>">

        <!-- Open Graph data -->
        <meta property="og:title" content="<?= $title; ?>">
        <meta property="og:type" content="Website">
        <meta property="og:url" content="<?= $JTech->full_url(); ?>"/>
        <meta property="og:image" content="<?= $JTech->setting('og_image'); ?>">
        <meta property="og:description" content="<?= $JTech->setting('description'); ?>">
        <meta property="og:site_name" content="<?= $title; ?>">
        <meta property="article:section" content="<?= $JTech->setting('description'); ?>">
        <meta property="article:tag" content="<?= $JTech->setting('description'); ?>">

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="<?= $JTech->setting('og_image'); ?>">
        <meta name="twitter:site" content="">
        <meta name="twitter:title" content="<?= $title; ?>">
        <meta name="twitter:description" content="<?= $JTech->setting('description'); ?>">
        <meta name="twitter:creator" content="@ducthanh.dev">
        <meta name="twitter:image:src" content="<?= $JTech->setting('og_image'); ?>">
        <link rel="alternate" hreflang="vi-vn" href="<?= $JTech->full_url(); ?>">
        <link rel="canonical" href="<?= $JTech->full_url(); ?>">

        <link rel="shortcut icon" href="<?= $JTech->setting('favicon'); ?>">
<!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="https://shopnapthe.vn/Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://shopnapthe.vn/Assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://shopnapthe.vn/Assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://shopnapthe.vn/Assets/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" />
    <link href="https://shopnapthe.vn/Assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

</head>

        <?php if($_SERVER['REQUEST_URI'] == '/') { ?>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "WebSite",
                "name": "<?= $JTech->setting('website_name'); ?>",
                "url": "https://<?= $_SERVER['SERVER_NAME']; ?>"
            }
        </script>
        <?php } ?>

        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "<?= $JTech->setting('website_name'); ?>",
                "legalName": "",
                "url": "<?= $JTech->full_url(); ?>",
                "logo": "<?= $JTech->setting('logo'); ?>",
                "foundingDate": "2010",
                "founders": [
                    {
                        "@type": "Person",
                        "name": ""
                    }
                ],
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "",
                    "addressLocality": "",
                    "addressRegion": "HN",
                    "postalCode": "100000",
                    "addressCountry": "VN"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "contactType": "customer support",
                    "telephone": "<?= $JTech->setting('phone_admin'); ?>",
                    "email": "<?= $JTech->setting('email_admin'); ?>"
                },
                "sameAs": ["<?= $JTech->setting('social_admin'); ?>", "", "", ""]
            }
        </script>


        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/jquery/jquery-3.6.0.min.js"></script>
        
        <?php if(!empty($JTech->setting('google_site_key')) && !empty($JTech->setting('google_secret_key')) ) { ?>
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
        <?php } ?>
        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
        
        <?php if(isset($select2)) { ?>
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/select2/css/select2.min.css">
        <?php } ?>

        <link rel="stylesheet" id="css-main" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/css/dashmix.min.css" />
        
        <?= theme_mode(); ?>

        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/plugins/sweetalert2@11.js"></script>
        
        <?php if(isset($code_bg)) { ?>
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/plugins/highlight/styles/monokai-sublime.min.css">
        <?php } ?>
    </head>

    <style>
        @media screen and (min-width: 800px) {
            #DataTables_Table_0_filter {
                float: right!important;
            }
        }
    </style>
    