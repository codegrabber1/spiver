<?php 
    global $post;
    $args = array(
        'post_type' => 'arthe_decore',
        'posts_per_page'=> -1, 
        'numberposts'=> -1,
        'suppress_filters' => true,
        'post_status' => 'publish' 
    );
        $posts = get_posts( $args );
        $i = 0;
    foreach( $posts as $post ): setup_postdata( $post ); ?>
<div class="product_content">
  <div class="picture_title">
    <a class="item wow fadeIn animated" data-wow-delay=".5s" href="<?php echo get_the_post_thumbnail_url()?>">
      <?php the_post_thumbnail() ?>
    </a>
    <div class="title_block">
      <h2 class="head_title"><?php the_title();?></h2>
      <div data-toggle="modal" class="modalBtn p_bt_right" data-tooltip="<?php _e( 'Description', 'spiver' )?>"
        data-position="top right" data-variation="large">
        <svg class="question_svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M15.6856 0.75H2.25V23.25H22.125V7.18936L15.6856 0.75ZM20.625 7.81064V7.875H15V2.25H15.0644L20.625 7.81064ZM3.75 21.75V2.25H13.5V9.375H20.625V21.75H3.75Z"
            fill="white" />
          <path d="M6.375 13.875H16.875V15.375H6.375V13.875Z" fill="white" />
          <path d="M6.375 17.625H16.875V19.125H6.375V17.625Z" fill="white" />
        </svg>
      </div>
      <div id="myModalBox" class="modal " data-backdrop="false" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">
                <?php the_title();?></h4>
            </div>
            <div class="modal-body">
              <?php 
                                        the_content();
                                    ?>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="modal_block ui mini modal">
                                <i class="close icon"></i>
                                <div class="block_content "><?php the_content(); ?></div>
                                <input type="hidden" value='<?php echo $post->ID?>'>
                            </div> -->
    </div>
  </div>
  <div class="product_btn">
    <div class="ui bottom attached p_bt_left" data-inverted="" data-tooltip="<?php _e( 'Add to List', 'spiver' );?>"
      data-position="left center">
      <input type="hidden" value="<?php echo $post->ID?>">
      <span class="cart" id='cart_<?php echo $post->ID?>'>
        <svg class="cart_svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M19 11H13V5H11V11H5V13H11V19H13V13H19V11Z" fill="white" />
        </svg>
      </span>
    </div>
  </div>
</div>
<?php endforeach; wp_reset_postdata(); ?>


<div class="product_content">
  <div class="picture_title">
    <a class="item wow fadeIn animated" data-wow-delay=".5s" href="<?php echo get_the_post_thumbnail_url()?>">
      <?php the_post_thumbnail() ?>
    </a>
    <div class="title_block">
      <h2 class="head_title">
        <a href="<?php echo get_term_link( $term->term_id, 'categories')?>">
          <?php echo $term->name;?>
        </a>

      </h2>
      <div data-toggle="modal" class="modalBtn p_bt_right" data-tooltip="<?php _e( 'Description', 'spiver' )?>"
        data-position="top right" data-variation="large">
        <svg class="question_svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M15.6856 0.75H2.25V23.25H22.125V7.18936L15.6856 0.75ZM20.625 7.81064V7.875H15V2.25H15.0644L20.625 7.81064ZM3.75 21.75V2.25H13.5V9.375H20.625V21.75H3.75Z"
            fill="white" />
          <path d="M6.375 13.875H16.875V15.375H6.375V13.875Z" fill="white" />
          <path d="M6.375 17.625H16.875V19.125H6.375V17.625Z" fill="white" />
        </svg>
      </div>
      <div id="myModalBox" class="modal " data-backdrop="false" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">
                <?php the_title();?></h4>
            </div>
            <div class="modal-body">
              <?php 
                                        the_content();
                                    ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
                          global $post;
                          $arg_cat = array(
                            'orderby'      => 'name',
                            'order'        => 'ASC',
                            'hide_empty'   => 1,
                            'include'      => '',
                            'taxonomy'     => 'categories',
                            'post_status' => 'publish'
                            );
                            $categories = get_terms( $arg_cat );
                            if( $categories ):
                             foreach( $categories as $cat ):
                        ?>
<h2><?php echo $cat->name; ?> </h2>
<?php endforeach; endif;?>
<?php 
                      
                      $arg_posts =  array(
                          'orderby'      => 'name',
                          'order'        => 'ASC',
                          'post_type' => 'arthe_decore',
                          //'posts_per_page' => 1,
                          'cat' => $cat->cat_ID,
                        );
                      $query = new WP_Query($arg_posts);
                      if ($query->have_posts() ) ?>

<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<?php the_post_thumbnail( );?>
<?php endwhile; wp_reset_postdata()?>