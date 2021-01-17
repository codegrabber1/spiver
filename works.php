<?php
/**
 * Template Name: Works
 * Template post type: post, page
 * Description: A Page Template to display about spiver.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Spiver
 * @file    works.php
 * @author  makecodework <[makecodework@gmail.com]>
 */
get_header();
get_template_part( 'template-parts/breadcrumbs', '' );
?>
<div id="main">
    <div class="page-home">
        <div class="container-fluid">
            <div class="content-block">
                <div id="wg" class="gallery ">
                    <?php
                        $args = array(
                            'post_type' => 'our_work',
                            'numberposts' => -1,
                            'suppress_filters' => true,
                            'post_status' => 'publish' 

                        );
                        $posts = get_posts( $args );
                        foreach( $posts as $post ): setup_postdata( $post )
                    ?>
                    <div class="gallery-item">
                        <a class="item wow fadeIn animated" data-wow-delay=".5s"
                            href="<?php echo get_the_post_thumbnail_url()?>">
                            <?php the_post_thumbnail() ?>
                        </a>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    get_footer();
?>