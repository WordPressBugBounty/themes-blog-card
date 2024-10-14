<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package blog card
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class();?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'blog-card' ); ?></a>
    <div class="wrapper" id="custom-background-css">
      <!--header--> 
    <header class="bs-headfour">
      <div class="clearfix"></div>
      <!-- Main Menu Area-->
      <div class="bs-menu-full">
        <nav class="navbar navbar-expand-lg navbar-wp">
          <div class="container">
            <!-- Right nav -->
            <div class="navbar-header d-none d-lg-block">
                  <?php the_custom_logo(); 
                  if (display_header_text()) { ?>
                    <div class="site-branding-text">
                    <?php } else { ?>
                    <div class="site-branding-text d-none">
                    <?php } if (is_front_page() || is_home()) { ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></h1>
                    <?php } else { ?>
                    <p class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></p>
                    <?php } ?>
                    <p class="site-description"><?php echo esc_html(get_bloginfo( 'description' )); ?></p>
                    </div>
            </div>
            <!-- Mobile Header -->
            <div class="m-header align-items-center">
              <!-- navbar-toggle -->
              <button class="navbar-toggler x collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbar-wp" aria-controls="navbar-wp" aria-expanded="false"
                aria-label="Toggle navigation"> 
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                  <div class="navbar-header">
                   <?php the_custom_logo(); 
                  if (display_header_text()) { ?>
                    <div class="site-branding-text">
                    <?php } else { ?>
                    <div class="site-branding-text d-none">
                    <?php } if (is_front_page() || is_home()) { ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></h1>
                    <?php } else { ?>
                    <p class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></p>
                    <?php } ?>
                    <p class="site-description"><?php echo esc_html(get_bloginfo( 'description' )); ?></p>
                    </div>
                  </div>
                  <div class="right-nav"> 
                  <!-- /navbar-toggle -->
                  <?php $blogarise_menu_search  = get_theme_mod('blogarise_menu_search','true'); 
                  if($blogarise_menu_search == true) {
                  ?>
                    <a class="msearch ml-auto bs_model" data-bs-target="#exampleModal" href="#" data-bs-toggle="modal"> <i class="fa fa-search"></i> </a>
               
                  <?php } ?>
                   </div>
                </div>
            <!-- /Mobile Header -->
            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="navbar-wp">
                  <?php 
                  $blogarise_menu_align_setting = get_theme_mod('blogarise_menu_align_setting','mx-auto');
                  if(is_rtl()) { wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'  => 'nav-collapse collapse',
                        'menu_class' => 'nav navbar-nav sm-rtl',
                        'fallback_cb' => 'blogarise_fallback_page_menu',
                        'walker' => new blogarise_nav_walker()
                      ) ); 
                      } else
                      {
                         wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'  => 'nav-collapse collapse',
                        'menu_class' => $blogarise_menu_align_setting . ' nav navbar-nav',
                        'fallback_cb' => 'blogarise_fallback_page_menu',
                        'walker' => new blogarise_nav_walker()
                      ) );

                      }
                    ?>
              </div>
            <!-- Right nav -->
            <div class="desk-header right-nav pl-3 ml-auto my-2 my-lg-0 position-relative align-items-center">
              <?php $blogarise_menu_search  = get_theme_mod('blogarise_menu_search','true'); 
                    $blogarise_subsc_link = get_theme_mod('blogarise_subsc_link', '#'); 
                    $blogarise_menu_subscriber  = get_theme_mod('blogarise_menu_subscriber','true');
                    $subsc_icon = get_theme_mod('subsc_icon_layout','bell');
                    $blogarise_subsc_open_in_new  = get_theme_mod('blogarise_subsc_open_in_new', true);
                  if($blogarise_menu_search == true) {
                  ?>
                <a class="msearch ml-auto bs_model" data-bs-target="#exampleModal" href="#" data-bs-toggle="modal">
                    <i class="fa fa-search"></i>
                  </a> 
               <?php } if($blogarise_menu_subscriber == true) { ?>
              <a class="subscribe-btn" href="<?php echo esc_url($blogarise_subsc_link); ?>" <?php if($blogarise_subsc_open_in_new) { ?> target="_blank" <?php } ?> ><i class="fas fa-<?php echo $subsc_icon ; ?>"></i></a>
              <?php } $blogarise_lite_dark_switcher = get_theme_mod('blogarise_lite_dark_switcher','true');
                if($blogarise_lite_dark_switcher == true){ ?>
               <label class="switch" for="switch">
                <input type="checkbox" name="theme" id="switch">
                <span class="slider"></span>
              </label>
              <?php } ?>         
            </div>
          </div>
        </nav>
      </div>
      <!--/main Menu Area-->
    </header>
    <!-- Add News ticker -->
<!--mainfeatured end-->
<?php
do_action('blogarise_action_featured_ads_section');
?>   