<?php
/*
Template Name: Checkout Templates
*/
?>
<?php get_header();?>
    <div class="row main">
        <div class="row">
            <div class="large-12 column">

                <!--                1 - offline course
                <!--                5 - books
                <!--                3 - online -->

                <iframe src="<?php echo IS_getProductFromURL(); ?>" height="1300px" width="100%" style="overflow: hidden;border: 0;" border="0" scrolling="no"></iframe>

            </div>
        </div>
    </div>
<?php get_footer();?>