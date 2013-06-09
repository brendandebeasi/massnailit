<!DOCTYPE html><!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]--><!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width" />
    <meta name="google-site-verification" content="S3beRQ1HlywTzsjnfnCbTjUMCc_2xvCQXvZUO_P2710" />
    <title><?php wp_title()?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/normalize.css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/foundation.css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/SideSwipe.css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" />
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/vendor/custom.modernizr.js"></script>
    <?php wp_head(); ?>
</head>
<body>
<div class="price-table-original online hidden">
<!--    <a class="column" href="https://rd130.infusionsoft.com/app/manageCart/addProduct?productId=9" target="_blank">-->
<!--        <div class="title">-->
<!--            6hr Course-->
<!--        </div>-->
<!---->
<!--        <div class="description">-->
<!--            Training for the Construction Supervisor Specialty License-->
<!--        </div>-->
<!---->
<!--        <div class="purchase-button">-->
<!--            <div class="title left">-->
<!--                Start Now-->
<!--            </div>-->
<!---->
<!--            <div class="price right">-->
<!--                $69-->
<!--            </div>-->
<!---->
<!--            <div class="clear"></div>-->
<!--        </div>-->
<!---->
<!--    </a>-->
<!--    <a class="column featured" href="https://rd130.infusionsoft.com/app/manageCart/addProduct?productId=3" target="_blank">-->
<!--        <div class="title">-->
<!--            12hr Course-->
<!--            <span class="small">(Best Value)</span>-->
<!--        </div>-->
<!---->
<!--        <div class="description">-->
<!--            Training for the Construction Supervisor License-->
<!--        </div>-->
<!---->
<!--        <div class="purchase-button">-->
<!--            <div class="title left">-->
<!--                Start Now-->
<!--            </div>-->
<!---->
<!--            <div class="price right">-->
<!--                $99-->
<!--            </div>-->
<!---->
<!--            <div class="clear"></div>-->
<!--        </div>-->
<!--    </a>-->
<!--    <a class="column" href="https://rd130.infusionsoft.com/app/manageCart/addProduct?productId=5" target="_blank">-->
<!--        <div class="title">-->
<!--            10hr Course-->
<!--        </div>-->
<!---->
<!--        <div class="description">-->
<!--            Training for the Construction Supervisor, 1 and 2 family License-->
<!--        </div>-->
<!---->
<!--        <div class="purchase-button">-->
<!--            <div class="title left">-->
<!--                Start Now-->
<!--            </div>-->
<!---->
<!--            <div class="price right">-->
<!--                $79-->
<!--            </div>-->
<!---->
<!--            <div class="clear"></div>-->
<!--        </div>-->
<!--    </a>-->
<!--    <div class="clear"></div>-->
</div>

    <div id="container" class="SideSwipe"><div class="SideSwipe-panel SideSwipe-main">
        <header>
            <div class="row">
                <div class="large-5 columns">
                    <div class="mobileMenuToggle toggle left">MENU</div>
                    <a class="brand" href="<?php bloginfo('wpurl'); ?>">
                        <a href="<?php bloginfo('wpurl'); ?>">
                            <div class="icon-logo"></div>
                            <div class="icon-brand"><img src="<?php bloginfo('stylesheet_directory'); ?>/css/img/mass-nail-it.png" alt="Mass Nail It"/></div>
                        </a>
                    </a>
                    <div class="sub-heading"><?php display_subhead_text(); ?></div>
                </div>
                <div class="large-4 columns">
                    <div class="headline-heading"><?php display_tagline();?></div>
                </div>
                <div class="large-3 columns">
                    <div class="icon-local"><a href="/contact"><img src="<?php bloginfo('stylesheet_directory'); ?>/css/img/we-local-sm.png" alt="We're local!"/></a></div>
                </div>
            </div>
                <nav class="nav-background">
                    <div class="large-12 column row top-bar-section">
                        <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' =>'left' ) ); ?>
                    </div>
                </nav>

        </header>
        <div class="hidden SideSwipe-panel SideSwipe-left"><?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' =>'mobileMenu' ) ); ?></div>
