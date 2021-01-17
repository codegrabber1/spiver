<?php
/**
 * Template Name: Paints
 */
get_header();
?>

<?php 
    get_template_part( 'template-parts/breadcrumbs', '' );
?>
<div class="main-content">
  <div id="content-wrapper" class="full-width">
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
                  <div class="blog" id="product-detail">
                    <div id="pg" class="product_excerpt ">
                      <?php
                          global $post;
                          $arg_cat = array(
                          'orderby'      => 'name',
                          'order'        => 'ASC',
                          'hide_empty'   => 1,
                          'include'      => '',
                          'taxonomy'     => 'categories',
                          'post_status' => 'publish',     
                          );
                          $categories = get_terms( $arg_cat  );
                          if( $categories ):
                          foreach( $categories as $cat ):
                            if (function_exists('ttw_thumbnail_url')) 
                      ?>
                      <div class="product_content">
                        <div class="picture_title">

                          <div class="thumb_product">
                            <a class="item " data-wow-delay=".3s"
                              href="<?php echo ttw_thumbnail_url( $cat->term_id , 'full' );  ?>">
                              <img src="<?php echo ttw_thumbnail_url( $cat->term_id , 'full' );  ?>" alt="">
                            </a>
                          </div>
                          <div class="title_block">
                            <h2 class="head_title">
                              <a href="<?php echo get_term_link( $cat->term_id, 'categories')?>">
                                <?php echo $cat->name;?>
                              </a>
                            </h2>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; endif;?>
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

</div>
<?php get_footer();?>