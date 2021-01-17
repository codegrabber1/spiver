<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spiver
 */

get_header();
?>
<?php 
    get_template_part( 'template-parts/breadcrumbs', '' );
?>
<main id="primary" class="site-main">
    <div class="container-fluid">
        <div class="content-block">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="blog-item">
                        <?php
								while ( have_posts() ) :
									the_post();
									get_template_part( 'template-parts/content', 'page' );

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop.
								?>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <?php get_sidebar( 'sidebar-1' );?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="about_widget ">
                        <div class="widget wow zoomInUp">
                            <?php if ( ! dynamic_sidebar( 'about-spiver' ) ):?>
                            <h3>Here is the widget about the last work!</h3>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- #main -->

<?php

get_footer();