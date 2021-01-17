<?php
/**
 * Template Name: Effects
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
              <div class="col col-xs-12 product-container">
                <div class="tab-content product-items">
                  <div class="blog" id="product-detail">
                    <div id="lg" class="product_effect">
                      <?php 
                        $args = array(
                            'post_type' => 'effects',
                            'suppress_filters' => true,
                            'posts_per_page'=> -1, 
                            'numberposts'=> -1, 
                        );
                            $posts = get_posts( $args );
                        foreach( $posts as $post ): setup_postdata( $post ); ?>
                      <div class="product_content">
                        <div class="wow fadeIn animated clearfix  picture_title" data-wow-delay=".5s">

                          <div class="product_title">
                            <a class="item wow fadeIn animated" data-wow-delay=".5s"
                              href="<?php echo get_the_post_thumbnail_url()?>">
                              <?php the_post_thumbnail() ?>
                            </a>

                          </div>
                        </div>
                      </div>
                      <?php endforeach; wp_reset_postdata(  ); ?>
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