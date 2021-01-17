<?php
    get_header();
?>

<?php
  get_template_part( 'template-parts/breadcrumbs', '' );
?>
<!-- main content -->
<div class="main-content">
    <div id="">
        <div id="content-wrapper" class="full-width">
            <div id="main">
                <div class="page-home">
                    <!-- breadcrumb -->
                    <div class="container-fluid">
                        <div class="content-block">
                            <div class="row">
                                <div class="col-xs-12 product-container">
                                    <div class="tab-content product-items">
                                        <div class="blog" id="product-detail">
                                            <div class="blog_excerpt page-home ">
                                                <?php if (have_posts()): while (have_posts()): the_post();?>
                                                <div class="blog_content">
                                                    <div class="ui stacked segment wow fadeInUp animated clearfix "
                                                        data-wow-delay=".5s">
                                                        <div class="entry-meta">
                                                            <span><i class="fa fa-user"></i>
                                                                <a href="#"><?php echo get_the_author(); ?></a>
                                                            </span>
                                                            <span><i class="fa fa-comment"></i>
                                                                <a
                                                                    href="#"><?php echo get_comments_number(  )?><?php _e( ' Comments', 'spiver' )?></a>
                                                            </span>
                                                        </div>
                                                        <a
                                                            href="<?php the_permalink();?>"><?php the_post_thumbnail()?></a>
                                                        <div class="short-blog-article">
                                                            <h2>
                                                                <a
                                                                    href="<?php the_permalink();?>"><?php the_title();?></a>
                                                            </h2>
                                                            <p><?php the_excerpt();?></p>
                                                            <a class="readmore"
                                                                href="<?php the_permalink();?>"><?php _e( 'Read more', 'spiver' )?>
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endwhile; endif; wp_reset_query();?>
                                            </div>
                                        </div>
                                        <!-- pagination -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination">
                            <?php if( paginate_links() ):?>
                            <div class="js-product-list-top ">
                                <div class="row">
                                    <div class="showing col col-xs-12">
                                        <span><?php echo count_pages()?></span>
                                    </div>
                                    <div class="page-list col col-xs-12">
                                        <?php mcw_pagination();?>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
    get_footer();
?>