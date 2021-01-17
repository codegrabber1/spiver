<?php
/**
 * The template for displaying categories pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spiver
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
    <div class="container-fluid">
        <div class="content_blocks">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 right ">
                    <div class="about_img">
                        <?php 
                            $firstId = mcw_get_option( 'about_us');
                            $args = array(
                                'cat'                   => $firstId,
                                'post_status'           => 'published',
                                'ignore_stycky_posts'   => 1,
                                'post__not_in'          => get_option('sticky_posts'),
                                'posts_per_page'        => 1,

                            );
                            $wp_query = new WP_Query( $args );
                            while( $wp_query->have_posts() ): $wp_query->the_post();
                            global $post;
                            $cats = wp_get_post_categories( $post->ID );
                            foreach( $cats as $cat ): $category = get_category($cat);
                        
                        ?>
                        <h2 class=""><?php the_title(); ?></h2>
                        <?php the_content(); ?>

                        <?php endforeach; endwhile;?>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 left">
                    <?php 
                        $spiverId = mcw_get_option( 'about_spiver');
                        $args = array(
                            'cat'                   => $spiverId,
                            'post_status'           => 'published',
                            'ignore_stycky_posts'   => 1,
                            'post__not_in'          => get_option('sticky_posts'),
                            'posts_per_page'        => 1,

                        );
                        $wp_query = new WP_Query( $args );
                        while( $wp_query->have_posts() ): $wp_query->the_post();
                        global $post;
                        $cats = wp_get_post_categories( $post->ID );
                        foreach( $cats as $cat ): $category = get_category($cat);
                        
                    ?>
                    <div class="about_img">
                        <h2 class="page-subheading"><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php endforeach; endwhile;?>

            </div>
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
<?php
    get_footer( );
?>