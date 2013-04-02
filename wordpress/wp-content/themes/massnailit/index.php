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
                <div class="short-form large-4 column">
                    <form class="custom custom-csl">
                        <fieldset>
                            <h3>Get Certified Today!</h3>
                      
                            <input type="text" name="firstName" placeholder="Name" />                       
                   
                            <input name="email" placeholder="Email Address" type="text" />
                        
                    
                            <select name="course" class="custom dropdown large">
                                <option value="online">Online CSL Course</option>
                                <option value="offline">Real-World CSL Course</option>
                            </select>
                        
                  
                        
                            <select name="course" class="custom dropdown large">
                                <option value="12">12 Hour CSL Certification</option>
                                <option value="10">10 Hour CSL Certification</option>
                                <option value="6">6 Hour CSL Certification</option>
                            </select>
                        
                    
                            <a href="#" class="button expand button-orange">Get Certified Now!</a>
                               
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="row fp-top-section">
                <div class="large-3 column">
                    <h5>Online CLS Courses</h5>
                    <p>
                        Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit. Morbi
                        in commodo ipsum. Lorem ipsum
                        dolor sit amet, consectetur
                        adipiscing elit. Morbi in commodo
                        ipsum dolor elit morbi.
                    </p>
                    <a href="#" class="button red">Read More</a>
                </div>
                <div class="large-3 column">
                    <h5>Classroom CLS Courses</h5>
                    <p>
                        Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit. Morbi
                        in commodo ipsum. Lorem ipsum
                        dolor sit amet, consectetur
                        adipiscing elit. Morbi in commodo
                        ipsum dolor elit morbi.
                    </p>
                    <a href="#" class="button red">Read More</a>
                </div>
                <div class="large-3 column">
                    <h5>Group CLS Courses</h5>
                    <p>
                        Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit. Morbi
                        in commodo ipsum. Lorem ipsum
                        dolor sit amet, consectetur
                        adipiscing elit. Morbi in commodo
                        ipsum dolor elit morbi.
                    </p>
                    <a href="#" class="button red">Read More</a>
                </div>
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
                        <h2>Mass Nail It - Massachusetts Contractor Training When <em>YOU</em> Need IT</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="large-4 column" class="real-customers">
                    <h4>Real Customers</h4>

                        <div class="testimonial"><img src="<?php bloginfo('stylesheet_directory'); ?>/css/img/customer.jpg" />
                            <p>“Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Morbi
                            in commodo ipsum. Lorem
                            dolor sit amet, consectetur”
                            <em>Bob from Lexington</em>
                            </p>
                        </div>

                        <div class="testimonial"><img src="<?php bloginfo('stylesheet_directory'); ?>/css/img/customer.jpg" />
                            <p>“Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Morbi
                            in commodo ipsum. Lorem
                            dolor sit amet, consectetur”
                            <em>Bob from Lexington</em>
                            </p>
                        </div>
                        <div class="testimonial"><img src="<?php bloginfo('stylesheet_directory'); ?>/css/img/customer.jpg" />
                            <p>“Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Morbi
                            in commodo ipsum. Lorem
                            dolor sit amet, consectetur”
                            <em>Bob from Lexington</em>
                            </p>
                        </div>
                </div>
            </div>
<?php get_footer();?>