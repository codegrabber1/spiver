<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package spiver
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
                <div class="col col-sm-12 col-md-7 col-lg-8">
                    <div class="blog-item">
                        <?php
						while (have_posts()) :
							the_post();
							get_template_part('template-parts/content', get_post_type());
						endwhile; // End of the loop.
					?>
                    </div>

                </div>
                <div class="col col-sm-12 col-md-5 col-lg-4">
                    <?php get_sidebar();?>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php

get_footer();