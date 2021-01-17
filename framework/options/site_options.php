<?php
/**
 * The Theme Options page
 *
 * This page is implemented using the Settings API
 * http://codex.wordpress.org/Settings_API
 *
 * @package  codegramcwer
 * @file     site_options.php
 * @author   codegramcwer [Oleg Poruchenko]
 * @link    [spiver@gmail.com]
 */
/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 */
add_action( 'admin_init', 'mcw_register_admin_scripts' );

function mcw_register_admin_scripts() {
	wp_enqueue_style( 'mcw_colorpicker_css', get_template_directory_uri() . '/framework/options/css/color-picker.css' );
	wp_enqueue_style( 'mcw_theme_options_css', get_template_directory_uri() . '/framework/options/css/mcw_options.css' );
	wp_enqueue_style('thickbox');
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script('mcw_colorpicker', get_template_directory_uri() . '/framework/options/js/colorpicker.js', array( 'jquery' ));
	wp_enqueue_script('mcw_select_js', get_template_directory_uri() . '/framework/options/js/jquery.customSelect.min.js', array( 'jquery' ));
	wp_enqueue_script( 'mcw_theme_optionsjs', get_template_directory_uri() . '/framework/options/js/options.js', array( 'jquery', 'mcw_select_js' ) );
}

/*
 * ==================
 * Set default options.
 * ==================
*/
function mcw_init_options(){
	$options = get_option( 'mcw_options' );
	if ( false === $options ) {
		$options = mcw_default_options();
	}
	update_option( 'mcw_options', $options );
}
add_action( 'after_setup_theme', 'mcw_init_options', 9 );
/*
 * ==================
 * Register the options page.
 * ==================
*/
function mcw_theme_add_page() {
	$mcw_options_page = add_theme_page( __( 'Theme options', 'spiver' ), __( 'Theme options', 'spiver' ), 'edit_theme_options', 'mcw_options', 'mcw_theme_options_page' );
	add_action( 'admin_print_styles-' . $mcw_options_page, 'mcw_theme_options_scripts' );
}
add_action( 'admin_menu', 'mcw_theme_add_page' );

/*
 * ==================
 * Include scripts to the options page only.
 * ==================
*/
function mcw_theme_options_scripts(){
	if ( ! did_action( 'mcw_enqueue_media' ) ){
		wp_enqueue_media();
	}
	wp_enqueue_script('mcw_upload', get_template_directory_uri() .'/framework/options/js/upload.js', array('jquery'));
}
/*
* ==================
* Register the theme options setting.
* ==================
*/

function mcw_register_settings() {
	register_setting( 'mcw_options', 'mcw_options', 'mcw_validate_options' );
}
add_action( 'admin_init', 'mcw_register_settings' );

/*
 * ==================
 * Output the options page.
 * ==================
*/
function mcw_theme_options_page(){
	global $post;
	?>
<div id="mcw_admin">
  <header class="header">
    <div class="main">
      <div class="left">
        <h2><?php bloginfo( 'name' );?></h2>
      </div>
      <div class="theme_info"><?php echo __('Theme settings', 'spiver'); ?></div>
    </div>
  </header> <!-- /header -->
  <div class="options-wrap">
    <div class="tabs">
      <ul>
        <li class="general first"><a href="#general"><i class="icon-cogs"></i><?php echo _e('General', 'spiver'); ?></a>
        </li>
        <li class="seo"><a href="#seo"><?php echo _e( 'SEO', 'spiver' );?></a></li>
        <li class="reset"><a href="#reset"><i class="icon-refresh"></i><?php echo _e( 'Reset', 'spiver' );?></a>
        </li>
      </ul>
    </div>
    <div class="options_form">
      <?php if( isset( $_GET['settings-updated'] ) ):?>
      <div class="updated fade">
        <p>
          <?php _e( 'Theme setup has been updated successfully', '' );?>
        </p>
      </div>
      <?php endif;?>
      <form action="options.php" method="post">
        <?php settings_fields( 'mcw_options' )?>
        <?php $options = get_option( 'mcw_options' )?>
        <div class="tab_content">
          <div id="general" class="tab_block">
            <h2><?php _e( 'Main Settings', 'spiver' );?></php>
            </h2>
            <div class="fields_wrap">
              <div class="field infobox">
                <p><strong>
                    <?php _e( 'How to upload an image?', 'spiver' );?>
                  </strong></p>
                <?php _e( 'You can manually specify the URL for the logo and other images or download the image from your computer.', 'spiver' );?>
              </div>
              <h3><?php _e( 'Header settings', 'spiver' );?></h3>
              <div class="field field-upload">
                <label for="mcw_logo_url"><?php _e( 'Download the logo', 'spiver' );?></label>
                <input type="text" id="mcw_options[mcw_logo_url]" class="upload_image" name="mcw_options[mcw_logo_url]"
                  value="<?php echo esc_attr($options['mcw_logo_url']); ?>">

                <input class="upload_image_button" id="mcw_logo_upload_button" type="button" value="Upload" />
                <span
                  class="description long updesc"><?php _e('Upload a logo image or specify a path. Max width: 300px.', 'codegramcwer'); ?></span>
              </div>
              <div class="field">
                <label for="mcw_favicon"><?php _e('Upload Favicon', 'spiver'); ?></label>
                <input id="mcw_options[mcw_favicon]" class="upload_image" type="text" name="mcw_options[mcw_favicon]"
                  value="<?php echo esc_attr($options['mcw_favicon']); ?>" />
                <input class="upload_image_button" id="mcw_favicon_button" type="button" value="Upload" />
                <span class="description updesc"><?php _e('Upload your 16x16 px favicon.', 'spiver'); ?></span>
              </div>
              <div class="field">
                <label for="mcw_apple_touch"><?php _e('Apple Touch Icon', 'spiver'); ?></label>
                <input id="mcw_options[mcw_apple_touch]" class="upload_image" type="text"
                  name="mcw_options[mcw_apple_touch]" value="<?php echo esc_attr($options['mcw_apple_touch']); ?>" />
                <input class="upload_image_button" id="mcw_apple_touch_button" type="button" value="Upload" />
                <span class="description updesc"><?php _e('Upload your 114px by 114px icon.', 'spiver'); ?></span>
              </div>
              <h3><?php _e( 'Set social links', 'spiver' );?></h3>
              <div class="field">
                <label for="mcw_options[mcw_fb_url]"><?php _e( 'Facebook URL', 'spiver' );?></label>
                <input type="text" id="mcw_options[mcw_fb_url]" name="mcw_options[mcw_fb_url]"
                  value="<?php echo esc_attr( $options['mcw_fb_url'] );?>" />
                <span
                  class="description long"><?php _e( "Enter full facebook-URL starting with <strong> https:// </strong>, or leave blank.", 'spiver' );?></span>
              </div>
              <div class="field">
                <label for="mcw_options[mcw_phone]"><?php _e( 'Phone', 'spiver' );?></label>
                <input id="mcw_options[mcw_phone]" name="mcw_options[mcw_phone]" type="text"
                  value="<?php echo esc_attr ( $options['mcw_phone']);?>">
                <span
                  class="description long"><?php _e( "Enter your phone number, or leave blank.", 'spiver' ); ?></span>
              </div>
              <h3><?php _e( 'Contact Card', 'spiver' );?></h3>
              <div class="field">
                <label for="mcw_options[contact_email]"><?php _e( 'Contact Email', 'spiver' );?></label>
                <input type="text" name="mcw_options[contact_email]" id="mcw_options[contact_email]"
                  value="<?php echo esc_attr( $options['contact_email'] );?>">
                <span class="desc long"><?php _e( "Enter your contact email for customers.", 'spiver' ); ?></span>
              </div>
              <h3><?php _e( 'Set slogan on the main page', 'spiver' );?></h3>
              <div class="field">
                <label
                  for="mcw_options[mcw_mainpage_title]"><?php _e('The title on the main page', 'spiver'); ?></label>
                <input id="mcw_options[mcw_mainpage_title]" name="mcw_options[mcw_mainpage_title]" type="text"
                  value="<?php echo esc_attr($options['mcw_mainpage_title']); ?>" />
                <span class="description"><?php _e( 'Enter the title for the main page.', 'spiver' ); ?></span>
              </div>
              <div class="field">
                <label
                  for="mcw_options[mcw_mainpage_description]"><?php _e('The main page Description', 'spiver'); ?></label>
                <textarea id="mcw_options[mcw_mainpage_description]" class="textarea"
                  name="mcw_options[mcw_mainpage_description]"><?php echo esc_attr($options['mcw_mainpage_description']); ?></textarea>
                <span class="description"><?php _e( 'Add a description.', 'spiver' ); ?></span>
              </div>
              <div class="field">
                <label for="mcw_options[mcw_show_addtocart_btn]"><?php _e( 'Show "Add To Cart"', 'spiver'); ?></label>
                <input id="mcw_options[mcw_show_addtocart_btn]" name="mcw_options[mcw_show_addtocart_btn]"
                  type="checkbox" value="1"
                  <?php if ( isset($options['mcw_show_addtocart_btn'] ) ? checked( '1', $options['mcw_show_addtocart_btn'] ) : checked('0', '1') ); ?> />
                <span
                  class="description chkdesc"><?php _e( 'Choose if you want to display "ADD TO CART" button.', 'spiver' ); ?></span>
              </div> <!-- #related_posts -->


              <div class="field">
                <label for="mcw_options[mcw_show_related_posts]"><?php _e( 'Show related posts', 'spiver'); ?></label>
                <input id="mcw_options[mcw_show_related_posts]" name="mcw_options[mcw_show_related_posts]"
                  type="checkbox" value="1"
                  <?php if ( isset($options['mcw_show_related_posts'] ) ? checked( '1', $options['mcw_show_related_posts'] ) : checked('0', '1') ); ?> />
                <span
                  class="description chkdesc"><?php _e( 'Choose if you want to display related post under the post.', 'spiver' ); ?></span>
              </div> <!-- #related_posts -->
            </div>
          </div> <!-- #general -->
          <div id="seo" class="tab_block">
            <div class="field infobox">
              <p><strong><?php _e('Analytics for the site', 'spiver'); ?></strong></p>
              <?php _e('For increasing a searching rating is used Google.', 'spiver'); ?>
            </div>
            <h3><?php _e('Meta info', 'spiver'); ?></h3>
            <div class="field">
              <label for="mcw_options[mcw_homepage_title]"><?php _e('SEO name of the site', 'spiver'); ?></label>
              <input id="mcw_options[mcw_homepage_title]" name="mcw_options[mcw_homepage_title]" type="text"
                value="<?php echo esc_attr($options['mcw_homepage_title']); ?>" />
              <span class="description"><?php _e( 'Enter the name of the home page.', 'spiver' ); ?></span>
            </div>
            <div class="field">
              <label for="mcw_options[mcw_meta_description]"><?php _e('SEO Description', 'spiver'); ?></label>
              <textarea id="mcw_options[mcw_meta_description]" class="textarea"
                name="mcw_options[mcw_meta_description]"><?php echo esc_attr($options['mcw_meta_description']); ?></textarea>
              <span class="description"><?php _e( 'Add a description.', 'spiver' ); ?></span>
            </div>

            <div class="field">
              <label for="mcw_options[mcw_meta_keywords]"><?php _e('Keywords', 'spiver'); ?></label>
              <textarea id="mcw_options[mcw_meta_keywords]" class="textarea"
                name="mcw_options[mcw_meta_keywords]"><?php echo esc_attr($options['mcw_meta_keywords']); ?></textarea>
              <span
                class="description"><?php _e( 'Add keywords. You can add more keywords separated by commas.', 'spiver' ); ?></span>
            </div>
          </div>
          <div id="reset" class="tab_block">
            <h2><?php _e( 'Reset', 'spiver' ); ?></h2>
            <div class="fields_wrap">
              <div class="field warningbox">
                <p><strong><?php _e( 'Atention!', 'spiver' );?></strong></p>
                <?php _e( 'You will lose all your theme settings and your own side panels. The theme will reset the original settings.', 'spiver' );?>
              </div>
              <div class="field">
                <p class="reset-info">
                  <?php _e( 'If you want to restore the initial settings, click on the button.', 'spiver' );?>
                </p>
                <input type="submit" name="mcw_option[reset]" class="button-primary"
                  value="<?php _e( 'Reset the initial settings', 'spiver' );?>">
              </div>
            </div>
          </div> <!-- #reset -->
        </div>

    </div> <!-- .options_form-->
  </div> <!-- .options-wrap-->
  <div class="options-footer">
    <input type="submit" name="mcw_options[submit]" class="button-primary"
      value="<?php _e( 'Save Settings', 'spiver' ); ?>" />
  </div>
  </form>
</div> <!-- #mcw_admin-->
<?php
}

/*
 * ==================
 * Return default array of options.
 * ==================
*/
function mcw_default_options(){
    $options = array(
         'mcw_logo_url'         => get_template_directory_uri().'/css/images/logo.png',
         'mcw_favicon'          => '',
         'mcw_apple_touch'      => '',
         'mcw_fb_url'           => '',
         'mcw_phone'            => '',
         'about_us'         => 0,
         'about_spiver'        => 0,
         'contact_email'        => '',
         'mcw_homepage_title'   => get_bloginfo( 'name' ),
         'mcw_meta_description' => '',
         'mcw_meta_keywords'    => '',
         'mcw_mainpage_title'   => '',
         'mcw_mainpage_description' => '',
         'mcw_show_addtocart_btn' => 1,
         'mcw_show_related_posts' => 0,



    );

    return $options;
}
/*
 * ==================
 * Sanitize and validate options.
 * ==================
*/
function mcw_validate_options( $input ){
    $submit = ( ! empty( $input['submit'] ) ? true : false );
    $reset = ( ! empty( $input['reset'] ) ? true : false );
    if( $submit ) :
        $input['mcw_logo_url']          = esc_url_raw( $input['mcw_logo_url'] );
        $input['mcw_favicon']           = esc_url_raw($input['mcw_favicon']);
	    $input['mcw_apple_touch']       = esc_url_raw($input['mcw_apple_touch']);
        $input['mcw_fb_url']            = esc_url_raw( $input['mcw_fb_url'] );
        $input['mcw_phone']             = wp_filter_nohtml_kses( $input['mcw_phone'] );
        $input['contact_email']         = wp_filter_nohtml_kses( $input['contact_email' ] );
	    $input['mcw_homepage_title']    = wp_filter_post_kses( $input['mcw_homepage_title'] );
	    $input['mcw_meta_keywords']     = wp_filter_post_kses( $input['mcw_meta_keywords'] );
        $input['mcw_meta_description']  = wp_filter_post_kses( $input['mcw_meta_description'] );
        $input['mcw_mainpage_title']    = wp_filter_post_kses( $input['mcw_mainpage_title'] );
	    $input['mcw_mainpage_description']     = wp_filter_post_kses( $input['mcw_mainpage_description'] );


       
        if ( ! isset( $input['mcw_show_related_posts'] ) )
            $input['mcw_show_related_posts'] = null;
            $input['mcw_show_related_posts'] = ( $input['mcw_show_related_posts'] == 1 ? 1 : 0 );


        if ( ! isset( $input['mcw_show_addtocart_btn'] ) )
            $input['mcw_show_addtocart_btn'] = null;
            $input['mcw_show_addtocart_btn'] = ( $input['mcw_show_addtocart_btn'] == 1 ? 1 : 0 );    

        /**
         *  FAQ category.
         */
        $categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 0 ) );
        $cat_ids = array();
        foreach( $categories as $category )
            $cat_ids[] = $category->term_id;
        if( !in_array( $input['about_us'], $cat_ids ) && ( $input['about_us'] ) !=0 )
            $input['about_us'] = $options['about_us'];

        /**
	     *  Discount category.
	     */
        $categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 0 ) );
        $cat_ids = array();
        foreach( $categories as $category )
            $cat_ids[] = $category->term_id;
        if( !in_array( $input['discount_category'], $cat_ids ) && ( $input['discount_category'] ) !=0 )
	        $input['discount_category'] = $options['discount_category'];

	   
        return $input;
    elseif( $reset ) :
        $input = mcw_default_options();
        return $input;
    endif;
}

if ( ! function_exists( 'mcw_get_option' ) ) :
	/*
	 * ==================
	 * Used to output theme options is an elegant way.
	 * @uses get_option() To retrieve the options array.
	 * ==================
	*/
	function mcw_get_option( $option ) {
		$options = get_option( 'mcw_options', mcw_default_options() );
		return isset( $options[ $option ]) ?  $options[ $option ] : '';
	}
endif;