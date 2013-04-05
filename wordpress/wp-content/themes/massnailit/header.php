<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> 
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width" />
    <title>MassNailIt - Massachusetts CSL Training. Be a smart super!</title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/normalize.css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/foundation.css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/app.css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" />
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/vendor/custom.modernizr.js"></script>

</head>


<body>
    <div id="container">
        <header>
            <div class="row">
                <div class="large-5 columns">
                    <a class="brand" href="<?php bloginfo('wpurl'); ?>">
                        <i class="icon-logo"></i>
                        <i class="icon-brand"></i>
                    </a>
                    <div class="sub-heading">Massachusetts Contractor Certification</div>
                </div>
                <div class="large-5 columns headline-heading">
                    <div class="">Be a smart super - call (508) 488-9874 today!</div>
                </div>
                <div class="large-2 columns">
                    <a href="javascript:alert('Our headquarters is located in Milford, MA by a Milford Native');" class="icon-boston"></a>
                </div>
            </div>
                <nav class="nav-background">
                    <div class="large-12 column row top-bar-section">
                        <?php
                        wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' =>'left' ) ); ?>
                    </div>
                </nav>

        </header>
