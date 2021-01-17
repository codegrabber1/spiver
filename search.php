<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package spiver
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container-fluid">
        <div class="content-block">
            <div class="row">
                <div class="col-xs-12 col-sm-12  col-md-8">
                    <div class="ui green segment page-header">
                        <h2 class="page-title">
                            <?php
							/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'spiver' ), '<span>' . get_search_query() . '</span>' );
							?>
                        </h2>
                    </div><!-- .page-header -->
                    <?php if ( have_posts() ) : 
							/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_navigation();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <?php get_sidebar( 'product' );?>
                </div>
            </div>

        </div>
    </div>
    </div>

</main><!-- #main -->

<?php

get_footer();