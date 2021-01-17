<?php
/**
 * Template part for displaying page content in taxonomy.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spiver
 */

?>
<div class="product_content">
  <div class="picture_title">
    <a class="item wow fadeIn animated" data-wow-delay=".5s" href="<?php echo get_the_post_thumbnail_url()?>">
      <?php the_post_thumbnail() ?>
    </a>
    <div class="title_block">
      <h2 class="head_title"><?php the_title();?></h2>
      <!-- Modal block -->
      <?php  get_template_part( 'template-parts/content', 'modal' );?>
      <!-- #Modal block -->
    </div>
  </div>
  <!-- Add to cart button -->
  <?php  get_template_part( 'template-parts/content', 'add-to-cart' );?>
  <!-- #Add to cart button -->
</div>