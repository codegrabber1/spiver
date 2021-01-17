<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package spiver
 */

?>

<footer id="footer" class="midnight-blue">
  <div class="footer_info">
    <div class=" container-fluid ">
      <?php bloginfo('name')?>
      <?php echo '&copy; '.date("Y") ?>
    </div>
  </div>
  <div class="bottom_menu">
    <div class="container-fluid f_block_menu">
      <nav id="site-navigation" class="main-navigation">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'container'      => 'ul',
                'menu_class'     => 'f_ul ',
            )
        );
        ?>
      </nav><!-- #site-navigation -->
    </div>
  </div>

</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
<script>
//Initiat WOW JS
new WOW().init();
</script>
</body>

</html>