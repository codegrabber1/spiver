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
<?php $cat = get_the_category(); ?>
<div class="breadcrumb-bg">
  <div class="container-fluid">
    <div class="ui breadcrumb">
      <a href="<?php echo home_url();?>" class="section"><?php _e( 'Home', 'spiver' );?> </a>
      <i class="right angle icon divider"></i>
      <div class=" section"><?php single_term_title(); ?></div>
    </div>
  </div>
</div>
<div class="main-content">
  <div id="main">
    <div class="page-home">
      <div class="container-fluid">
        <div class="content-block">
          <div class="row">
            <div class="order-2 col-xs-12 col-sm-12  col-md-4 col-lg-3 order-md-1">
              <div class="sidebar_menu">
                <?php get_sidebar( 'sidebar-1' );?>
              </div>
            </div>
            <div class="order-1 col-xs-12 col-sm-12 col-md-8 col-lg-9 order-md-2 product-container">
              <div class="tab-content product-items">
                <?php if ( have_posts() ) : ?>


                <div class="blog" id="product-detail">
                  <div id="pg" class="product_excerpt ">
                    <?php
                      /* Start the Loop */
                      while ( have_posts() ) :
                        the_post();

                        /*
                        * Include the Post-Type-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                        */
                        get_template_part( 'template-parts/content', 'taxonomy' );
                        

                      endwhile;

                      the_posts_navigation();

                    else :

                      get_template_part( 'template-parts/content', 'none' );

                    endif;
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer();?>