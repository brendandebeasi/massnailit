<!DOCTYPE html><!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]--><!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title()?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/normalize.css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/foundation.css" />
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

    <div id="container">
        <header>
            <div class="row">
                <div class="large-5 columns">
                    <a class="brand" href="<?php bloginfo('wpurl'); ?>">
                        <i class="icon-logo"></i>
                        <i class="icon-brand"></i>
                    </a>
                    <div class="sub-heading"><?php display_subhead_text(); ?></div>
                </div>
                <div class="large-4 columns">
                    <div class="headline-heading"><?php display_tagline();?></div>
                </div>
                <div class="large-3 columns">
                    <a href="/contact"><img src="<?php bloginfo('stylesheet_directory'); ?>/css/img/we-local.png" height="70%" width="70%"/></a>
                </div>
            </div>
                <nav class="nav-background">
                    <div class="large-12 column row top-bar-section">
                        <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' =>'left' ) ); ?>
                    </div>
                </nav>

        </header>
