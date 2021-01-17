<?php
/**
 * Plugin Name: makecodework: Small Recent Posts.
 * Plugin URI:
 * Description: This widget displays the most recent posts with big and small thumbnails in the sidebar.
 * Version: 1.0
 * Author: makecodework <[makecodework@gmail.com]>.
 * Author URI:
 * @package Spiver.
 */

 /* ===================
  * Add public function to widgets_init that'll load our widget.
 =================== */
 add_action( 'widgets_init', 'makecodework_small_recent_posts_widgets' );
 function makecodework_small_recent_posts_widgets() {
  register_widget( 'makecodework_small_recent_posts_widget' );
}

/* ===================
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
=================== */
class makecodework_small_recent_posts_widget extends WP_Widget {
   /* ===================
 	 * Widget setup.
   =================== */
   public function __construct(){
     /* ===================
 	     * Widget settings.
     =================== */
     $widget_ops = array( 'classname' => 'f_widget', 'description' => __( 'This widget displays the most recent posts with big and small thumbnails in the sidebar.', 'spiver' ) );
     parent::__construct( 'makecodework_small_recent_posts_widgets', __( 'Spiver: Recent Posts', 'spiver' ), $widget_ops );
   }

   /* ===================
     * Display the widget on the screen.
   =================== */
   public function widget( $args, $instance ){
     extract( $args );
     $title = apply_filters( 'widget_title', $instance['title'] );
     $display_category = $instance['display_category'];
     $entries_display = $instance['entries_display'];

     if( empty($entries_display )){
      $entries_display = '5';
    }

    echo $before_widget;
    if( $title ) : ?>
<div class="widget_title">
    <h3><?php echo $title; ?></h3>
</div>
<?php endif;?>
<?php
  $args = array(
    'cat'                 => $display_category,
    'post_type'           => 'post',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => $entries_display

    );
  $query = new WP_Query( $args );
  if( $query->have_posts() ):
    $last_post = $query->post_count -1;
  while( $query->have_posts() ) : $query->the_post();
  if( $query->current_post == 0 ):
    ?>
<div class="main-post">
    <div class="entry-meta">
        <?php cg_get_first_cat();?>
        <span class="date"><?php echo get_the_date(); ?></span>
        <?php
        global $post;
        $comment_count = get_comments_number( $post->ID );
        if( $comment_count > 0 ) : ?>
        <span class="comments">
            <i class="fa fa-comment"></i>
            <?php comments_popup_link( __( ' ', 'spiver'), __( '1', 'spiver'), __('%', 'spiver')); ?>
        </span>
        <?php endif; ?>
    </div>
    <?php if( has_post_thumbnail() ) : ?>
    <div class="thumb overlay">
        <a href="<?php the_permalink();?>"><?php the_post_thumbnail()?></a>
    </div>
    <?php endif;?>
    <div class="widget_content">
        <h4><a href="<?php the_permalink()?>"><?php the_title();?></a></h4>
        <p>
            <?php
              $excerpt = get_the_excerpt();
              $trimmed_excerpt = wp_trim_words( $excerpt, 12 );
              echo $trimmed_excerpt;
            ?>
        </p>
    </div>
    <div class="excerpt-footer clearfix">
        <div class="more-link">
            <a href="<?php the_permalink() ?>"><?php _e( 'Read more', 'spiver' ); ?></a>
        </div>

    </div>
</div><!-- !main-post -->

<?php
endif;
if( $query->current_post == 1 ):
  ?>
<div class="posts-list">
    <?php
  endif;
  if( $query->current_post >= 1 ):?>
    <div class="item-post clearfix">
        <?php if( has_post_thumbnail() ):?>
        <div class="recent-thumb">
            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(  ); ?></a>
        </div>
        <?php endif;?>
        <div class="post-right">
            <h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
        </div>
    </div>
    <?php
endif;
if (( $query->post_count  > 1) AND ($query->current_post == $last_post )):
 ?>
</div><!-- !post-list -->
<?php
endif;
endwhile;
endif;
wp_reset_query();
/* After widget (defined by themes). */
echo $after_widget;
}
    /* ===================
  	 * @param array $new_instance
  	 * @param array $old_instance
  	 * update widget settings.
  	 * @return array
    =================== */
    public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;

      $instance['title']            = $new_instance['title'];
      $instance['display_category'] = $new_instance['display_category'];
      $instance['entries_display']  = $new_instance['entries_display'];
      return $instance;

    }
   /* ===================
     * Displays the widget settings controls on the widget panel.
     * Make use of the get_field_id() and get_field_name() public function
     * when creating your form elements. This handles the confusing stuff.
   =================== */
   public function form( $instance ) {
     $defaults = array( 'title' => 'Recent Posts', 'entries_display' => 5, 'display_category' => '' );
     $instance = wp_parse_args( (array) $instance, $defaults );
     ?>
<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'makecodework'); ?></label>
    <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"
        style="width:100%;" /></p>

<p><label
        for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><?php _e( 'How many entries to display?', 'spiver' ); ?></label>
    <input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>"
        name="<?php echo $this->get_field_name('entries_display'); ?>"
        value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>

<p><label
        for="<?php echo $this->get_field_id( 'display_category' ); ?>"><?php _e( 'Filter by Category:', 'spiver' ); ?></label>
    <select name="<?php echo $this->get_field_name( 'display_category' )?>"
        id="<?php echo $this->get_field_id( 'display_category' )?>" class="widefat categories" style="width:100%;">
        <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' )?>
        <?php foreach( $categories as $cat ):?>
        <option value="<?php echo $cat->term_id; ?>"
            <?php if( $cat->term_id == $instance['display_category'] ) echo 'selected="selected"'?>>
            <?php echo $cat->cat_name; ?>
        </option>
        <?php endforeach?>
    </select>
    <?php
      }
    }