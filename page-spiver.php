<?php
/**
 * Template Name: About Spiver
 * Template post type: post, page
 * Description: A Page Template to display about spiver.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Spiver
 * @file    page-spiver.php
 * @author  makecodework <[makecodework@gmail.com]>
 */

get_header();
?>
<div id="about">
    <?php if( mcw_get_option('mcw_bgimg_about_url') ) :?>
    <div class="p_bg"
        style="background-image: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.2)),url(<?php echo mcw_get_option('mcw_bgimg_about_url')?>)">
        <h1><?php _e( 'About Us', 'spiver' );?></h1>
    </div>
    <?php endif;?>
    <?php
  get_template_part( 'template-parts/breadcrumbs', '' );
?>
    <main id="primary" class="site-main">
        <div class="container-fluid">
            <div class="content-block">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                        <div class="order-item">
                            <?php
                            while ( have_posts() ) :
                                the_post();
                                get_template_part( 'template-parts/content', 'spiver' );
                            endwhile; 
                       ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="sidebar_menu">
                            <?php get_sidebar( 'sidebar-1' );?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="about_widget ">
                            <div class="widget wow zoomInUp">
                                <?php if ( ! dynamic_sidebar( 'spiver-about' ) ):?>
                                <h3>Here is the widget about the last work!</h3>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- #main -->

    <?php get_footer();?>