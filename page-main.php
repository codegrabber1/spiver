<?php
/**
 * Template Name: Main page
 * Template post type: post, page
 * Description: A page Template to display content on the main page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Spiver
 * @file    page-main.php
 * @author  makecodework <[makecodework@gmail.com]>
 */
get_header();
?>
<div class="slider ">
    <div class="s_img ">
        <div class="intro">
            <?php if( mcw_get_option( 'mcw_mainpage_title' ) ):?>
            <h1><?php echo mcw_get_option( 'mcw_mainpage_title' )?></h1>
            <?php endif;?>
            <?php if( mcw_get_option( 'mcw_mainpage_description' ) ):?>
            <p><?php echo mcw_get_option( 'mcw_mainpage_description' );?> </p>
            <?php endif;?>
            <?php $cat_id = get_category_by_slug( "about-us" );?>
            <a href="<?php echo get_site_url();?>/%d0%bf%d1%80%d0%be-%d0%bd%d0%b0%d1%81/" class="center_btn">Про
                компанію</a>
        </div>
        <?php
			$mainslider = new WP_Query( array ( 'post_type' => 'mainslider' ) );
			if( $mainslider->have_posts() ):
		?>
        <div id="main-slider" class="main-slider owl-carousel">
            <?php
				while ($mainslider->have_posts()) : $mainslider->the_post();
					the_post_thumbnail('full');
				endwhile;
			?>
        </div>
        <?php endif; wp_reset_query();?>
    </div>

</div>

<?php
get_footer();
?>