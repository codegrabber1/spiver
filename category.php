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

<?php
  get_template_part( 'template-parts/breadcrumbs', '' );
?>
<div class="main-content">
  <div id="">
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
                      <?php
                        global $ancestor; 
                        $id = get_queried_object()->term_id; 
                        $childcats = get_categories('child_of='.$id.'&hide_empty=0&orderby=id');
                        foreach ($childcats as $childcat) :
                            if (cat_is_ancestor_of($ancestor, $childcat->cat_ID) == false) :
                            echo "<div class='ui green segment product_head'>";
                            echo '<div><h3>';
                            echo $childcat->cat_name . '</h3></div>';     
                            echo '<div><h3><a href='.get_category_link($childcat->cat_ID).'>';
                            echo __( 'View all', 'spiver' ). '</a></h3></div>'; 
                            echo "</div>"; 
                            
                            $mycat=get_the_category(); $mycat=$mycat[0];
                            $args = array(
                                'category' => $childcat->cat_ID,
                                'ignore_sticky_posts'=> 1,
                                'posts_per_page'=> -1, 
                                'numberposts'=> -1,
                                'post__not_in' => get_option('sticky_posts'),
                            );
                            $postslist = get_posts( $args );
                       ?>
                      <div id="product_slider">
                        <div class="product_content product_slider owl-carousel">
                          <?php foreach ($postslist as $post) : setup_postdata($post); ?>
                          <div class="ui shape wow fadeIn animated clearfix" data-wow-delay=".5s">
                            <div class="shape_block">
                              <div class="product_title ">
                                <div class="sides">
                                  <div class="active side">
                                    <div class="slider_pic">
                                      <?php the_post_thumbnail()?>
                                    </div>
                                    <!-- <h2 class="head_title">
                                      <?php //the_title();?>
                                    </h2> -->
                                  </div>
                                  <div class="side">
                                    <p>
                                      <?php
                                        $excerpt = get_the_excerpt();
                                        $trimmed_excerpt = wp_trim_words( $excerpt, 40, ' ...' );
                                        echo $trimmed_excerpt;
                                      ?>
                                    </p>
                                  </div>
                                </div>
                              </div>
                              <?php $excerpt = get_the_content();if($excerpt): ?>
                              <div class="shapeBtn p_bt_right">
                                <svg class="question_svg" viewBox="0 0 24 24" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path
                                    d="M15.6856 0.75H2.25V23.25H22.125V7.18936L15.6856 0.75ZM20.625 7.81064V7.875H15V2.25H15.0644L20.625 7.81064ZM3.75 21.75V2.25H13.5V9.375H20.625V21.75H3.75Z"
                                    fill="black" />
                                  <path d="M6.375 13.875H16.875V15.375H6.375V13.875Z" fill="black" />
                                  <path d="M6.375 17.625H16.875V19.125H6.375V17.625Z" fill="black" />
                                </svg>
                              </div>
                              <?php endif;?>
                            </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                      </div>
                      <?php $ancestor = $childcat->cat_ID; endif; endforeach; ?>
                      <?php if( !$postslist): ?>
                      <?php $id = get_queried_object()->term_id;
                            $args = array(
                                'cat' => $id,
                                'posts_per_page' => 1,
                                'post__in' => get_option('sticky_posts')
                            );
                            $stpost = new WP_Query( $args );
                            if( $stpost ) :
                                while( $stpost->have_posts() ): $stpost->the_post();
                        ?>
                      <article class="sticky">
                        <div class="sticky_text">
                          <h1><?php the_title( $before = '', $after = '', $echo = true )?>
                          </h1>
                          <?php the_content();?>
                        </div>
                      </article>
                      <?php endwhile; endif; wp_reset_postdata(); ?>
                      <div id="cat_lg" class="product_excerpt">
                        <?php 
                            global $post;
                            $id = get_queried_object()->term_id;
                            $args = array(
                            'category' => $id,    
                            'ignore_sticky_posts'=> 1,
                            'posts_per_page'=> -1, 
                            'numberposts'=> -1,
                            'post__not_in' => get_option('sticky_posts'),
                            );
                            $posts = get_posts( $args );
                            if ( $posts  ): 
                                foreach( $posts as $post ): setup_postdata($post);
                        ?>
                        <div class="product_content">
                          <div class="">
                            <div class="picture_title">
                              <div class="slider_pic">
                                <a class="item wow fadeIn animated" data-wow-delay=".5s"
                                  href="<?php echo get_the_post_thumbnail_url()?>">
                                  <?php the_post_thumbnail() ?>
                                </a>
                              </div>

                              <div class="title_block">

                                <h2 class="head_title"><?php the_title();?>
                                </h2>
                                <?php
                                    $excerpt = get_the_content();
                                    if($excerpt):
                                ?>
                                <!-- Modal block -->
                                <?php  get_template_part( 'template-parts/content', 'modal' );?>
                                <!-- #Modal block -->
                                <?php endif;?>
                              </div>
                              <!-- Add to cart button -->
                              <?php  
                                if( mcw_get_option( 'mcw_show_addtocart_btn' ) == 1 ) {
                                    get_template_part( 'template-parts/content', 'add-to-cart' );
                                }?>
                              <!-- #Add to cart button -->
                            </div>

                          </div>

                        </div>
                        <?php endforeach; endif; wp_reset_postdata();?>
                      </div>
                      <!-- pagination -->
                      <div class="pagination">
                        <?php if( paginate_links() ):?>
                        <div class="js-product-list-top ">
                          <div class="row">
                            <div class="showing col-xs-12">
                              <span><?php echo count_pages()?></span>
                            </div>
                            <div class="page-list col-xs-12">
                              <?php mcw_pagination();?>
                            </div>
                          </div>
                        </div>
                        <?php endif;?>
                      </div> <!-- #pagination -->
                      <?php endif;?>
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
</div>
<?php get_footer(); ?>