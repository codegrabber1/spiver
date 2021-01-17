<?php
if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

if (! function_exists('spiver_setup')) :
    function register_my_session()
        {
        if( !session_id() )
        {
            session_start();
        }
        }

        add_action('init', 'register_my_session');
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function spiver_setup()
    {
        /**
	     * Load up our required theme files.
	     */
        require( get_template_directory() . "/framework/options/site_options.php" );
        require( get_template_directory() . "/framework/options/option_functions.php" );
        require( get_template_directory() . "/framework/widgets/widget_tags.php" );
        require( get_template_directory() . "/framework/widgets/widget_slider.php" );
        require( get_template_directory() . "/framework/widgets/widget_facebook.php" );
        require( get_template_directory() . "/framework/widgets/widget_square_recent_posts.php" );
        require( get_template_directory() . "/framework/widgets/widget_small_recent_posts.php" );
        
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on spiver, use a find and replace
         * to change 'spiver' to the name of your theme in all the template files.
         */
        load_theme_textdomain('spiver', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'spiver'),
                'menu-2' => esc_html__('Sidebar', 'spiver'),
                
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'spiver_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'spiver_setup');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spiver_content_width()
{
    $GLOBALS['content_width'] = apply_filters('spiver_content_width', 640);
}
add_action('after_setup_theme', 'spiver_content_width', 0);

/**
 * Google fonts
 * https://fonts.google.com
 */
function spiver_google_fonts() {

    wp_enqueue_style( 'spiver-googleRobotoFonts', 'https://fonts.googleapis.com/css?family=Roboto:300,500&amp;subset=cyrillic,cyrillic-ext', false );
    wp_enqueue_style( 'spiver-googleExoFonts', 'https://fonts.googleapis.com/css2?family=Exo+2&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'spiver_google_fonts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function spiver_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'spiver'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'spiver'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar for the page About Us', 'spiver'),
            'id'            => 'about-spiver',
            'description'   => esc_html__('Add widgets here.', 'spiver'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar for the page About Spiver', 'spiver'),
            'id'            => 'spiver-about',
            'description'   => esc_html__('Add widgets here.', 'spiver'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

}
add_action('widgets_init', 'spiver_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function spiver_scripts()
{ 
    wp_enqueue_style('spiver-bootstrapcss', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap-grid.min.css');
    wp_enqueue_style('spiver-owlcss', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style( 'spiver-mmenucss', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.3/jquery.mmenu.css' );
    wp_enqueue_style( 'spiver-superfishcss', 'https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.9/css/superfish.min.css' );
    wp_enqueue_style('spiver-lgcss', 'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/css/lightgallery.min.css');
    wp_enqueue_style('spiver-semantic-css', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css');
    wp_enqueue_style('spiver-animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');
    wp_enqueue_style('spiver-fontawesomecss', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('spiver-style', 'rtl', 'replace');

    wp_enqueue_script('spiver-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '3.5.1', true);
    wp_enqueue_script('spiver-bootstrapjs', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js', array(), '4.4.1', true);
    wp_enqueue_script('spiver-lgjs', 'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/js/lightgallery.min.js', array(), '1.10.0', true);
    wp_enqueue_script('spiver-lgTHjs', 'https://cdnjs.cloudflare.com/ajax/libs/lg-thumbnail/1.2.1/lg-thumbnail.min.js', array(), '1.2.1', true);
    wp_enqueue_script('spiver-lgSHjs', 'https://cdnjs.cloudflare.com/ajax/libs/lg-share/1.2.1/lg-share.min.js', array(), '1.2.1', true);
    
    wp_enqueue_script('spiver-owljs', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), '2.3.4', true);
    wp_enqueue_script('spiver-mixjs', 'https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js', array(), '3.3.1', true);
    wp_enqueue_script('spiver-semanticjs', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js', array(), '2.4.1', true);
    wp_enqueue_script('spiver-wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array(), '1.1.2', true);
    wp_enqueue_script( 'spiver-superfishjs', 'https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.9/js/superfish.min.js', array( 'jquery' ), '1.7.9', true );

		wp_enqueue_script( 'spiver-mmenujs', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.3/jquery.mmenu.all.js', array( 'jquery' ), '7.0.3', true );

    wp_enqueue_script('spiver-customjs', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', true);
    

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    //passing variables to the javascript file
    wp_localize_script('spiver-customjs', 'frontEndAjax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'nonce' => wp_create_nonce('ajax_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'spiver_scripts');

/**
 * Main big slider on the home page.
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @return void the registered post type object, or an error object
 */
function main_slider()
{
    $labels = array(
        'name'               => __('All slides', 'spiver'),
        'singular_name'      => __('Singular Name', 'spiver'),
        'add_new'            => __('Add New Singular Name', 'spiver'),
        'add_new_item'       => __('Add New Singular Name', 'spiver'),
        'edit_item'          => __('Edit Singular Name', 'spiver'),
        'new_item'           => __('New Singular Name', 'spiver'),
        'view_item'          => __('View Singular Name', 'spiver'),
        'parent_item_colon'  => __('Parent Singular Name:', 'spiver'),
        'menu_name'          => __('Main slider', 'spiver'),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'menu_icon'           => 'dashicons-format-gallery',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
        ),
    );
    register_post_type('mainslider', $args);
}
add_action('init', 'main_slider');

/**
 * A custom page for effects which can be reached.
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @return void the registered post type object, or an error object
 */
function effects(){
    $labels = array(
        'name'               => __('All pictures', 'spiver'),
        'singular_name'      => __('Picture', 'spiver'),
        'add_new'            => __('Add New Picture', 'spiver'),
        'add_new_item'       => __('Add New Picture', 'spiver'),
        'edit_item'          => __('Edit Effect', 'spiver'),
        'new_item'           => __('New Effect', 'spiver'),
        'view_item'          => __('View Effect', 'spiver'),
        'parent_item_colon'  => __('Parent Effect:', 'spiver'),
        'menu_name'          => __('All Effects', 'spiver'),
    );
    $args = array(
        'labels'              => $labels,
        'hierarchical'        => true,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 9,
        'menu_icon'           => 'dashicons-tickets-alt',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            
        ),
    ); 

    register_post_type( 'effects', $args );
}

add_action( 'init', 'effects' );
/**
 * A custom page for paint photo.
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @return void the registered post type object, or an error object
 */
function arthe_decore(){
    $labels = array(
        'name'               => __('Arthe Decore', 'spiver'),
        'singular_name'      => __('Paint', 'spiver'),
        'add_new'            => __('Add New photo for Arthe', 'spiver'),
        'add_new_item'       => __('Add New photo for Arthe', 'spiver'),
        'edit_item'          => __('Edit paint photo', 'spiver'),
        'new_item'           => __('New paint photo', 'spiver'),
        'view_item'          => __('View paint photo', 'spiver'),
        'parent_item_colon'  => __('Parent paint:', 'spiver'),
        'menu_name'          => __('Arthes', 'spiver'),
        'filter_items_list'  => true,
        'items_list_navigation'    => true
    );
    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array( 'categories' ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-admin-multisite',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'post-formats',
            'author',
            
        ),
    );
    $taxonomy_args = array(
        'labels' => [
			'name'              => __( 'Arthe Categories', 'spiver' ),
			'singular_name'     => __( 'Category', 'spiver' ),
			'search_items'      => __( 'Search Category', 'spiver' ),
			'all_items'         => __( 'All Category', 'spiver' ),
			'view_item '        => __( 'View Category', 'spiver' ),
			'parent_item'       => __( 'Parent Category', 'spiver' ),
			'edit_item'         => __( 'Edit Category', 'spiver' ),
			'update_item'       => __( 'Update Category', 'spiver' ),
			'add_new_item'      => __( 'Add New Category', 'spiver' ),
			'new_item_name'     => __( 'New Category Name', 'spiver' ),
			'menu_name'         => __( 'Categories', 'spiver' ),
        ],
        'description'           => '',
        'public'                => true,
        'hierarchical'          => true,
        'show_in_quick_edit'    => true,
        

    );
    register_taxonomy( 'categories', 'arthe_decore', $taxonomy_args );
    register_post_type( 'arthe_decore', $args );
    
}
add_action( 'init', 'arthe_decore' );

/**
 * A custom page for portfolio (Our work).
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @return void the registered post type object, or an error object
 */
function our_work(){
    
    $labels = array(
        'name'               => __('All works', 'spiver'),
        'singular_name'      => __('Work', 'spiver'),
        'add_new'            => __('Add New work', 'spiver'),
        'add_new_item'       => __('Add New work', 'spiver'),
        'edit_item'          => __('Edit work', 'spiver'),
        'new_item'           => __('New work', 'spiver'),
        'view_item'          => __('View work', 'spiver'),
        'parent_item_colon'  => __('Parent work:', 'spiver'),
        'menu_name'          => __('Our Works', 'spiver'),
    );
    $args = array(
        'labels'              => $labels,
        'hierarchical'        => true,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-format-image',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'post-formats'
            
        ), 
    );
register_post_type( 'our_work', $args );
}
add_action( 'init', 'our_work' );

/**
 * A custom page for portfolio (Our work).
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @return void the registered post type object, or an error object
 */
function special_product(){
    
    $labels = array(
        'name'               => __('All products', 'spiver'),
        'singular_name'      => __('Product', 'spiver'),
        'add_new'            => __('Add New product', 'spiver'),
        'add_new_item'       => __('Add New product', 'spiver'),
        'edit_item'          => __('Edit product', 'spiver'),
        'new_item'           => __('New product', 'spiver'),
        'view_item'          => __('View product', 'spiver'),
        'parent_item_colon'  => __('Parent product:', 'spiver'),
        'menu_name'          => __('All products', 'spiver'),
    );
    $args = array(
        'labels'              => $labels,
        'hierarchical'        => true,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-hammer',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'post-formats'
            
        ), 
    );
register_post_type( 'special_product', $args );
}
add_action( 'init', 'special_product' );
/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
 * @return Prints the HTML for the pagination if a template is $paged
 */
if (! function_exists('mcw_pagination')) :
function mcw_pagination()
{
    global $wp_query;

    $big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type'  => 'list',
        'prev_next'    => true,
        'prev_text'    => __('Previous'),
        'next_text'    => __('Next'),
        'mid_size' => 5
    ));

    // Display the pagination if more than one page is found
    if ($paginate_links) {
        echo $paginate_links;
    }
}
endif; // ends check for wt_pagination()
if (!function_exists('count_pages')):
    function count_pages()
    {
        global $wp_query;
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $ppp = get_query_var('posts_per_page');
        $total = $wp_query->found_posts;
        $end = $ppp * $page;
        $start = $end - $ppp + 1;

        if ($ppp > $total) {
            $results_summary_html = __('Showing ', 'spiver') . $total . __(' of ', 'spiver') . $total;
        } elseif ($end > $total) {
            $results_summary_html = __('Showing ', 'spiver') . $start . '-' . $total . __(' of ', 'spiver') . $total;
        } else {
            $results_summary_html = __('Showing ', 'spiver') . $start . '-' . $total . __(' of ', 'spiver') . $total . __(' item(s)', 'spiver');
        }

        return $results_summary_html;
    }
endif;

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own makecodework_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
if (!function_exists('spiver_comment')) :
function spiver_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    global $post;

    switch ($comment->comment_type) :
        case '':
            if ($comment->user_id == $post->post_author) {
                $author_text = '<div class="comment_author">Spiver</div>';
            } else {
                $author_text = '';
            } ?>
<li class="b_comments clearfix" id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>">
    <div class="comRight clearfix">
      <div class="comLeft clearfix">
        <a href="<?php comment_author_url()?>"><?php echo get_avatar($comment, 80); ?></a>
      </div>
      <?php echo $author_text; ?>
      <span class="comment-time">
        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
          <?php
                        /* translators: 1: date, 2: time */
                        printf(__('%1$s at %2$s', 'makecodework'), get_comment_date(), get_comment_time()); ?></a>
      </span>
      <div class="comment-text ">
        <?php comment_text(); ?>
      </div>
      <p class="m_button"><a
          href="#"><?php comment_reply_link(array_merge($args, array( 'reply_text' => __('Reply', 'makecodework'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ))); ?>
        </a></p>
    </div>
  </article>
</li>
<?php
            break;
    case 'pingback':
        case 'trackback':
            ?>
<li class="post pingback">
  <p><?php _e( 'Pingback:' , 'makecodework'); ?>
    <?php comment_author_link(); ?><?php edit_comment_link(__('[ Edit ]', 'makecodework'), '<span class="edit-link">', '</span>'); ?>
  </p>
</li>
<?php
    break;
    endswitch;
}
endif;//ends check for makecodework_comment()

function add_to_cart(){
    //session_destroy();
    check_ajax_referer('ajax_nonce', 'nonce');
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $reasData = [];
    $data = json_encode( $_POST['data_to_pass']  );

    if( !$data) return false;
    
    if(isset($_SESSION['cart']) && array_search($data, $_SESSION['cart']) === false) {
        $_SESSION['cart'][] = $data;
        $reasData['cntItems'] = count($_SESSION['cart']);
        $reasData['success'] = 1;
        
    } else {
        $reasData['success'] = 0;
    }
    echo count($_SESSION['cart']);
    echo json_decode( $reasData );
    
    wp_die();
} 
add_action( 'wp_ajax_add_to_cart',        'add_to_cart' ); // For logged in users
add_action( 'wp_ajax_nopriv_add_to_cart', 'add_to_cart' ); // For anonymous users

function del_from_cart(){
    //session_destroy();
    check_ajax_referer('ajax_nonce', 'nonce');
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $data = json_encode( $_POST['data_to_pass']  );
    $order = $_SESSION['cart'];
    
    $m = json_decode($data, true);
    foreach($order as $key => $arrays) {
        $json_array = json_decode($arrays, true);
    
       if((int)$json_array['id'] === (int)$m['id'] ) {
            unset($order[$key]);
        }
        
    }
    $_SESSION['cart'] = $order;
    echo count($_SESSION['cart']);
    wp_die();
    
} 
add_action( 'wp_ajax_del_from_cart',        'del_from_cart' ); // For logged in users
add_action( 'wp_ajax_nopriv_del_from_cart', 'del_from_cart' ); // For anonymous users

function send_from_cart(){
    check_ajax_referer('ajax_nonce', 'nonce');
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $data = json_encode( $_POST['data_to_pass']  );
    $m = json_decode($data, true);
    // print_r($m);
    $dataSession = json_encode($_SESSION['cart']);
    $s = json_decode($dataSession, true);
    //print_r($s);
    foreach($m as $key => $val) {
        $art_name = $val['name'];
        $art_email = $val['email'];
        $art_mess = $val['mess'];
    }
    // Указываем адресата
    $email_to = '';

    // Если адресат не указан, то берем данные из настроек сайта
    if ( ! $email_to ) {
        $email_to = get_option( 'admin_email' );
    }

    $body .= "<p style='font-weight: nrmal; margon-bottom:1rem;'>Имя: ". $art_name . "\nEmail: " . $art_email . "\rСообщение: " .$art_mess."</p>";
    
    $headers = 'From: ' . $art_name . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $body .= '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <thead style="color: #313131">
                <tr>
                    <th>Product name </th>
                    <th>Description</th>
                </tr>
            </thead>';  
    foreach( $s as $key => $v){ 
        $i = json_decode($v, true);
        $body .= '<tr>';
        $body .= '<td>
                    <p style="margin: 0 0 2rem 0;">'.$i["title"].'</p>
                </td>
                <td>
                    <p style="margin: 0 0 2rem 0;">'.$i["Description"].'</p>
                </td> ';
        $body .= '<tr>';
    } $body .= '</table>' ;
    unset($_SESSION['cart']);
    session_destroy();
    // Отправляем письмо
    wp_mail( $email_to, $art_subject, $body, $headers );

    // Отправляем сообщение об успешной отправке
    $message_success = 'Собщение отправлено. В ближайшее время я свяжусь с вами.';
    wp_send_json_success( $message_success );
    
    wp_die();
    
}
add_action( 'wp_ajax_send_from_cart', 'send_from_cart' ); // For logged in users
add_action( 'wp_ajax_nopriv_send_from_cart', 'send_from_cart' ); // For anonymous users
/**
* Getting the first category for widgets.
*/
function cg_get_first_cat(){
$category = get_the_category();

if ($category){

$output = "";
if (isset($category[0]->term_id)){

$cat1_id = $category[0]->term_id;
$wt_category_meta = get_option( "wt_category_meta_color_$cat1_id" );
$output .= '<span class="entry-cat-bg main-color-bg cat'.$cat1_id.'-bg">';
    $output .= '<i class="fa fa-folder"></i>&nbsp;';
    $output .= '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a>';
    $output .= '</span>';
}
echo $output;

}
}
/*=============================================
= BREADCRUMBS =
=============================================*/

function get_breadcrumb() {

// Check if is front/home page, return
if ( is_front_page() ) {
return;
}

// Define
global $post;
$custom_taxonomy = ''; // If you have custom taxonomy place it here

$defaults = array(
'seperator' => '&#187;',
'classes' => 'section',
'home_title' => esc_html__( 'Головна', 'spiver' )
);

$sep = '<i class="right chevron icon divider"></i>';

// Start the breadcrumb with a link to your homepage
echo '<ol>';

    // Creating home link
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'"><a href="'. get_home_url() .'">'. esc_html(
            $defaults['home_title'] ) .'</a></li>' . $sep;

    if ( is_single() ) {

    // Get posts type
    $post_type = get_post_type();

    // If post type is not post
    if( $post_type != 'post' ) {

    $post_type_object = get_post_type_object( $post_type );
    $post_type_link = get_post_type_archive_link( $post_type );

    echo '<li class="'. esc_attr( $defaults['classes'] ) .'"><a href="'. $post_type_link .'">'.
            $post_type_object->labels->name .'</a></li>'. $sep;

    }

    // Get categories
    $category = get_the_category( $post->ID );

    // If category not empty
    if( !empty( $category ) ) {

    // Arrange category parent to child
    $category_values = array_values( $category );
    $get_last_category = end( $category_values );
    // $get_last_category = $category[count($category) - 1];
    $get_parent_category = rtrim( get_category_parents( $get_last_category->term_id, true, ',' ), ',' );
    $cat_parent = explode( ',', $get_parent_category );

    // Store category in $display_category
    $display_category = '';
    foreach( $cat_parent as $p ) {
    $display_category .= '<li class="'. esc_attr( $defaults['classes'] ) .'">'. $p .'</li>' . $sep;
    }

    }

    // If it's a custom post type within a custom taxonomy
    $taxonomy_exists = taxonomy_exists( $custom_taxonomy );

    if( empty( $get_last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {

    $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
    $cat_id = $taxonomy_terms[0]->term_id;
    $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
    $cat_name = $taxonomy_terms[0]->name;

    }

    // Check if the post is in a category
    if( !empty( $get_last_category ) ) {

    echo $display_category;
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. get_the_title() .'</li>';

    } else if( !empty( $cat_id ) ) {

    echo '<li class="'. esc_attr( $defaults['classes'] ) .'"><a href="'. $cat_link .'">'. $cat_name .'</a></li>' . $sep;
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. get_the_title() .'</li>';

    } else {

    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. get_the_title() .'</li>';

    }

    } else if( is_archive() ) {

    if( is_tax() ) {
    // Get posts type
    $post_type = get_post_type();

    // If post type is not post
    if( $post_type != 'post' ) {

    $post_type_object = get_post_type_object( $post_type );
    $post_type_link = get_post_type_archive_link( $post_type );

    echo '<li class="'. esc_attr( $defaults['classes'] ) .'"><a href="' . $post_type_link . '">' .
            $post_type_object->labels->name . '</a></li>' . $sep;

    }

    $custom_tax_name = get_queried_object()->name;
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. $custom_tax_name .'</li>';

    } else if ( is_category() ) {

    $parent = get_queried_object()->category_parent;

    if ( $parent !== 0 ) {

    $parent_category = get_category( $parent );
    $category_link = get_category_link( $parent );

    echo '<li class="'. esc_attr( $defaults['classes'] ) .'"><a href="'. esc_url( $category_link ) .'">'.
            $parent_category->name .'</a></li>' . $sep;

    }

    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. single_cat_title( '', false ) .'</li>';

    } else if ( is_tag() ) {

    // Get tag information
    $term_id = get_query_var('tag_id');
    $taxonomy = 'post_tag';
    $args = 'include=' . $term_id;
    $terms = get_terms( $taxonomy, $args );
    $get_term_name = $terms[0]->name;

    // Display the tag name
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. $get_term_name .'</li>';

    } else if( is_day() ) {

    // Day archive

    // Year link
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'"><a href="'. get_year_link( get_the_time('Y') ) .'">'.
            get_the_time('Y') . ' Archives</a></li>' . $sep;

    // Month link
    echo '<li class="item-month section"><a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'.
            get_the_time('M') .' Archives</a></li>' . $sep;

    // Day display
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. get_the_time('jS') .' '. get_the_time('M'). ' Archives
    </li>';

    } else if( is_month() ) {

    // Month archive

    // Year link
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'"><a href="'. get_year_link( get_the_time('Y') ) .'">'.
            get_the_time('Y') . ' Archives</a></li>' . $sep;

    // Month Display
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. get_the_time('M') .' Archives</li>';

    } else if ( is_year() ) {

    // Year Display
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. get_the_time('Y') .' Archives</li>';

    } else if ( is_author() ) {

    // Auhor archive

    // Get the author information
    global $author;
    $userdata = get_userdata( $author );

    // Display author name
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. 'Author: '. $userdata->display_name . '</li>';

    } else {

    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. post_type_archive_title() .'</li>';

    }

    } else if ( is_page() ) {

    // Standard page
    if( $post->post_parent ) {

    // If child page, get parents
    $anc = get_post_ancestors( $post->ID );

    // Get parents in the right order
    $anc = array_reverse( $anc );

    // Parent page loop
    if ( !isset( $parents ) ) $parents = null;
    foreach ( $anc as $ancestor ) {

    $parents .= '<li class="'. esc_attr( $defaults['classes'] ) .'"><a href="'. get_permalink( $ancestor ) .'">'.
            get_the_title( $ancestor ) .'</a></li>' . $sep;

    }

    // Display parent pages
    echo $parents;

    // Current page
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. get_the_title() .'</li>';

    } else {

    // Just display current page if not parents
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">'. get_the_title() .'</li>';

    }

    } else if ( is_search() ) {

    // Search results page
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'"> ' . __(" Search results for: " ) . get_search_query() .'
    </li>';

    } else if ( is_404() ) {

    // 404 page
    echo '<li class="'. esc_attr( $defaults['classes'] ) .'">' . 'Error 404' . '</li>';

    }
    // End breadcrumb
    echo '</ol>';

}
?>