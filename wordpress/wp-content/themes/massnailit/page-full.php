<?php
/*
Template Name: Full Width Template
*/
?>
<?php get_header();?>

<div class="row main">
    <div class="row">
        <div class="large-12 column">
            <div class="content-inner">
                <?php while (have_posts()) : the_post(); ?>
                    <h1><?php the_title();?></h1>
                    <?php the_content();?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>