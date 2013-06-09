<?php
/*
Template Name: Home Template
*/
?>
<?php get_header();?>
<div class="row main">
    <div class="row">
        <div class="large-8 column">
            <ul data-orbit>
                <li><a href="/live-classroom-csl-education"><img src="<?php bloginfo('stylesheet_directory'); ?>/slides/affordableeducation-warm.jpg" alt=""/></a></li>
                <li><a href="/online-contractor-csl-education"><img src="<?php bloginfo('stylesheet_directory'); ?>/slides/license-expire-hothothot.jpg" alt=""/></a></li>
                <li><a href="/books"><img src="<?php bloginfo('stylesheet_directory'); ?>/slides/codebooks-dontdropme.jpg" alt=""/></a></li>
                <li><a href="/massachusetts-regulations"><img src="<?php bloginfo('stylesheet_directory'); ?>/slides/bbrs-regulations-tunnel.jpg" alt=""/></a></li>
                <?php while (have_posts()) : the_post(); $featured = rwmb_meta( 'rw_featured_image_checkbox'); if ($featured == "1") { ?>
                    <li>
                        <?php if (has_post_thumbnail()) { the_post_thumbnail(('post-thumbnail' ), array('class' => 'fp-image')); } ?>
                        <div class="orbit-caption"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
                    </li>
                <?php } endwhile; ?>
            </ul>
        </div>
        <?php get_sidebar(); ?>
    <div class="row fp-top-section">
        <?php display_home_promos(); ?>
    </div>
    <div class="row fp-bottom-section">
        <div class="large-8 column">
            <div class="fp-bottom-inner">
                <?php while (have_posts()) : the_post(); ?>
                    <h2><?php the_title();?></h2>
                    <div class="content">
                        <?php the_content();?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="large-4 column">
            <h4>Real Customers</h4>
            <?php display_testimonials();?>
        </div>
    </div>
<?php get_footer();?>