<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package spiver
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php if($_SESSION['cart']):?>

    <div id="cartLabel" class="">

        <div class="cart_data">
            <a id="cart_data" href="<?php echo site_url('/order');?>">
                <?php echo count($_SESSION['cart']);?>

            </a>
            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14.6667 17.3333H1.33333C1.11232 17.3333 0.900358 17.2455 0.744078 17.0893C0.587797 16.933 0.5 16.721 0.5 16.5V1.50001C0.5 1.27899 0.587797 1.06703 0.744078 0.910749C0.900358 0.754469 1.11232 0.666672 1.33333 0.666672H14.6667C14.8877 0.666672 15.0996 0.754469 15.2559 0.910749C15.4122 1.06703 15.5 1.27899 15.5 1.50001V16.5C15.5 16.721 15.4122 16.933 15.2559 17.0893C15.0996 17.2455 14.8877 17.3333 14.6667 17.3333ZM13.8333 15.6667V2.33334H2.16667V15.6667H13.8333ZM4.66667 4.83334H11.3333V6.50001H4.66667V4.83334ZM4.66667 8.16667H11.3333V9.83334H4.66667V8.16667ZM4.66667 11.5H11.3333V13.1667H4.66667V11.5Z"
                    fill="white" />
            </svg>
        </div>

    </div>

    <?php endif;?>
    <?php wp_body_open(); ?>
    <div class="wrapper-site">
        <header id="header" class="<?php if( is_front_page() ): ?> main_header <?php endif;?> clearfix">
            <div class="container-fluid">
                <div class="topnavbar topnavbar-fixed-top">
                    <div class="blockinfo">
                        <div class="mobile-mnu hidden-md hidden-lg clearfix">
                            <a class="toggle-mnu hidden-lg" href="#">
                                <span></span>
                            </a>
                        </div>
                        <div class="toplogo">
                            <?php if( mcw_get_option( 'mcw_logo_url' ) ):?>
                            <a href="<?php echo home_url();?>">
                                <img src="<?php echo mcw_get_option( 'mcw_logo_url' )?>" alt="<?php bloginfo('name')?>">
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="topsearch">
                            <?php get_search_form()?>
                        </div>
                    </div>
                    <div class="topbtn">
                        <ul>
                            <li>
                                <div class="h_btn">
                                    <a href="" class="open_s_form">
                                        <svg class="search_svg" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10.3311 6.16556C10.3311 8.46613 8.46613 10.3311 6.16556 10.3311C3.86498 10.3311 2 8.46613 2 6.16556C2 3.86498 3.86498 2 6.16556 2C8.46613 2 10.3311 3.86498 10.3311 6.16556ZM10.1216 10.8948C9.05092 11.7914 7.67127 12.3311 6.16556 12.3311C2.76041 12.3311 0 9.5707 0 6.16556C0 2.76041 2.76041 0 6.16556 0C9.5707 0 12.3311 2.76041 12.3311 6.16556C12.3311 7.34146 12.0019 8.44047 11.4307 9.37548L18 15.9448L16.5858 17.359L10.1216 10.8948Z"
                                                fill="white" />
                                        </svg>
                                </div>
                            </li>
                            <?php if( mcw_get_option( 'mcw_fb_url' ) ):?>
                            <li><a rel="noopener" target="_blank" href="<?php echo mcw_get_option( 'mcw_fb_url' )?>">
                                    <svg class="fb_svg" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.8255 6.2433V7.4826H6.9183V8.9973H7.8255V13.5H9.6903V8.9973H10.9413C10.9413 8.9973 11.0592 8.271 11.1159 7.4763H9.6975V6.4413C9.6975 6.2856 9.9009 6.0777 10.1025 6.0777H11.1177V4.5H9.7362C7.7796 4.5 7.8255 6.0165 7.8255 6.2433Z"
                                            fill="white" />
                                        <path
                                            d="M9 16.2C10.9096 16.2 12.7409 15.4414 14.0912 14.0912C15.4414 12.7409 16.2 10.9096 16.2 9C16.2 7.09044 15.4414 5.25909 14.0912 3.90883C12.7409 2.55857 10.9096 1.8 9 1.8C7.09044 1.8 5.25909 2.55857 3.90883 3.90883C2.55857 5.25909 1.8 7.09044 1.8 9C1.8 10.9096 2.55857 12.7409 3.90883 14.0912C5.25909 15.4414 7.09044 16.2 9 16.2ZM9 18C4.0293 18 0 13.9707 0 9C0 4.0293 4.0293 0 9 0C13.9707 0 18 4.0293 18 9C18 13.9707 13.9707 18 9 18Z"
                                            fill="white" />
                                    </svg>
                                </a>
                            </li>
                            <?php endif;?>
                            <?php if( mcw_get_option('contact_email') ): ?>
                            <li class="envelop"><a href="mailto:<?php echo mcw_get_option( 'contact_email' )?>">
                                    <svg class="env_svg" viewBox="0 0 24 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4794 12.5831L15.3881 15.5L12.4713 18.4169L13.625 19.5625L17.6875 15.5L13.625 11.4375L12.4794 12.5831Z"
                                            fill="white" />
                                        <path
                                            d="M18.1669 12.5831L21.0756 15.5L18.1588 18.4169L19.3125 19.5625L23.375 15.5L19.3125 11.4375L18.1669 12.5831Z"
                                            fill="white" />
                                        <path
                                            d="M10.375 14.6875H2.25V2.42687L11.5369 8.85375C11.6729 8.9481 11.8345 8.99866 12 8.99866C12.1655 8.99866 12.3271 8.9481 12.4631 8.85375L21.75 2.42687V9.8125H23.375V1.6875C23.375 1.25652 23.2038 0.843198 22.899 0.538451C22.5943 0.233705 22.181 0.0625 21.75 0.0625H2.25C1.81902 0.0625 1.4057 0.233705 1.10095 0.538451C0.796205 0.843198 0.625 1.25652 0.625 1.6875V14.6875C0.625 15.1185 0.796205 15.5318 1.10095 15.8365C1.4057 16.1413 1.81902 16.3125 2.25 16.3125H10.375V14.6875ZM19.9625 1.6875L12 7.19625L4.0375 1.6875H19.9625Z"
                                            fill="white" />
                                    </svg>

                                </a>
                            </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
                <!--/.container-->
            </div>
            <!--/nav-->

        </header>

        <div class="second_topsearch ui modal">
            <i class="close icon"></i>
            <div class="header">
                <?php _e( 'Find whatever you want', 'spiver' );?>
            </div>
            <div class=" content">
                <?php get_search_form()?> </div>
        </div>
        <!--/header-->