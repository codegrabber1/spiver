<?php
session_start();
/**
 * Template Name: Order
 * Template post type: post, page
 * Description: A Page Template to display an order.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Spiver
 * @file    page-order.php
 * @author  makecodework <[makecodework@gmail.com]>
 */
get_header();
?>

<?php
  get_template_part( 'template-parts/breadcrumbs', '' );
?>
<main id="primary" class="site-main">
    <div class="container-fluid">
        <div class="content-block">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7">
                    <div class="order-item">
                        <?php
                            while ( have_posts() ) :
                                the_post();
                                get_template_part( 'template-parts/content', 'order' );
                            endwhile; 
                       ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <?php echo do_shortcode( '[wpforms id="320" title="false" description="false"]' )?>
                    <form id="order_form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post"
                        class="ui form order_form contact_form">
                        <div class="two fields">
                            <div class="field">
                                <label><?php _e( 'First Name', 'spiver' )?><i class="required">*</i></label>
                                <input type="text" name="name" value="" class="validation" placeholder="Your name">
                            </div>
                            <div class="field">
                                <label><?php _e( 'Last Name', 'spiver' )?><i class="required">*</i></label>
                                <input type="text" name="last_name" value="" class="validation" placeholder="Your name">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label><?php _e( 'Your Email', 'spiver' );?><i class="required">*</i></label>
                                <input type="email" name="email" value="" class="validation"
                                    placeholder="<?php _e( 'Your Email', 'spiver' );?>">
                            </div>
                            <div class="field">
                                <label><?php _e( 'Your phone', 'spiver' )?><i class="required">*</i></label>
                                <input type="tel" name="phone" value="" class="validation" placeholder="Your name">
                            </div>
                        </div>
                        <div class="field">
                            <label><?php _e( 'Your message', 'spiver' );?></label>
                            <textarea name="mess"></textarea>

                        </div>
                        <div class="field">
                            <input id="orderSend" class="contactBtn" onclick="validateAndSend();" type="submit" name=""
                                value="<?php _e( 'Send', 'spiver' );?>">
                        </div>
                    </form>
                    <p>Required fields are marked <i class="required">*</i></p>
                </div>
            </div>
        </div>
    </div>

</main><!-- #main -->

<?php get_footer();?>