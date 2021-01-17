<?php
/**
 * Template Name: Special Products
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
        <div id="wg" class="gallery-product ">
          <?php
            $args = array(
                'post_type' => 'special_product',
                'posts_per_page'=> -1, 
                'numberposts'=> -1,
                'suppress_filters' => true,
                'post_status' => 'publish' 

            );
            $posts = get_posts( $args );
            foreach( $posts as $post ): setup_postdata( $post )
        ?>
          <div class="gallery-item">
            <div class="product_content">
              <div class="product_title">
                <a class="item wow fadeIn animated" data-wow-delay=".5s"
                  href="<?php echo get_the_post_thumbnail_url()?>">
                  <?php the_post_thumbnail() ?>
                </a>
                <div class="title_block">
                  <h2 class="head_title"><?php the_title();?></h2>
                </div>
              </div>

              <!-- Add to cart button -->
              <?php  
              if( mcw_get_option( 'mcw_show_addtocart_btn' ) == 1 ) {
                  get_template_part( 'template-parts/content', 'add-to-cart' );
              }?>
              <!-- #Add to cart button -->
            </div>
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