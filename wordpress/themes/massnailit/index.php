<?php get_header();?>
        <div class="row main">
            <div class="row">
                <div class="large-8 column">
                    <ul data-orbit>
                    <?php while (have_posts()) : the_post(); $featured = rwmb_meta( 'rw_featured_image_checkbox'); if ($featured == "1") { ?>
                        <li>
                        <?php if (has_post_thumbnail()) { the_post_thumbnail(('post-thumbnail' ), array('class' => 'fp-image')); } ?> 
                        <div class="orbit-caption"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
                        </li>
                    <?php } endwhile; ?>
                    </ul>
                </div>
              <?php get_sidebar();?>  
        </div>
            <div class="row fp-top-section">
                <?php display_home_promos(); ?>

                <div class="large-3 column">
                    <h5>Upcoming Classes</h5>
                    <ul class="calendar">
                        <li><a href="#">February 1st @ Grafton</a></li>
                        <li><a href="#">February 1st @ Grafton</a></li>
                        <li><a href="#">February 1st @ Grafton</a></li>
                        <li><a href="#">February 1st @ Grafton</a></li>
                        <li><a href="#">February 1st @ Grafton</a></li>
                        <li><a href="#">February 1st @ Grafton</a></li>
                        <li><a href="#">February 1st @ Grafton</a></li>
                        <li><a href="#">February 1st @ Grafton</a></li>
                    </ul>
                </div>
            </div>
            <div class="row fp-bottom-section">
                <div class="large-8 column">
                    <div class="fp-bottom-inner">
                        <?php while (have_posts()) : the_post(); ?>
                        <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                        <div class="author"><p>Posted <?php the_date();?> <?php if (has_tag()) { ?>// <?php the_tags();?><?php } ?></p></div>
                        <?php the_excerpt();?>
                    <?php endwhile; ?>
                    </div>
                </div>
                <div class="large-4 column">
                    <h4>Real Customers</h4>
                        <?php display_testimonials();?>
                    </div>
            </div>
<?php get_footer();?>