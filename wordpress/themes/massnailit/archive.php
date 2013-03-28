<?php get_header();?>
        <div class="row main">
            <div class="row">
                <div class="large-8 column">
                    <div class="content-inner">
                        <h1>Archive</h1>
                        <div class="divider"></div>
                    <?php while (have_posts()) : the_post(); ?>
                        <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                        <div class="author">Posted <?php the_date();?> // <?php the_tags();?></div>

                        <?php the_excerpt();?>
                    <?php endwhile; ?>
                    <div class="divider"></div>
                     </div>
                </div>

                <?php get_sidebar();?>

            </div>
            
<?php get_footer();?>