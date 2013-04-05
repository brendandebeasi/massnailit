        <footer>
            <nav class="row text-center">
                <?php wp_nav_menu( array( 'theme_location' => 'menu', 'menu_class' =>'bottom' ) ); ?>
            </nav>
            <div class="row">
                <div class="footer-bottom">
                   <div class="large-2 columns">
                       <a target="_blank" id="nw_logo" href="http://neueway.com" title="Website By Neueway Creations, LLC"></a>
                   </div>
                    <div class="large-4 push-2 columns">
                        <p>&copy; 2013 Mass Nail It</p>
                        <p>BBRS Coordinator ID: CD-0023</p>
                    </div>
                    <div class="large-4 columns right">
                        <a href="#"><i class="truste"></i></a>
                        <a href="#"><i class="verisign"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        </div>
    </div>

    <script>
        document.write('<script src=' +
                ('__proto__' in {} ? '<?php bloginfo('stylesheet_directory'); ?>/js/vendor/zepto' : 'http://127.0.0.1:8080/wordpress/wp-content/themes/massnailit/js/vendor/jquery') +
                '.js><\/script>')
    </script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>