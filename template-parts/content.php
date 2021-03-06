<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spiver
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="entry-header">
    <?php
		if ( 'post' === get_post_type() ) :
			?>
    <div class="inner-entry-meta">
      <?php
				spiver_posted_on();
				spiver_posted_by();
				?>
    </div><!-- .entry-meta -->
    <?php endif; ?>
  </div><!-- .entry-header -->
  <?php spiver_post_thumbnail(); ?>
  <div class="entry-content ">
    <?php
		if (is_singular()) :
            the_title('<h1 class="entry-title clearfix">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'spiver' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'spiver' ),
				'after'  => '</div>',
			)
		);
		
		?>

    <?php 
				if( mcw_get_option( 'mcw_show_related_posts' ) == 1 ) {
							get_template_part( 'template-parts/related-posts' );
				}
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
    comments_template();
    endif;

    ?>

  </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->