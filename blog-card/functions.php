<?php
/**
 * Theme functions and definitions
 *
 * @package blog card
 */
if ( ! function_exists( 'blogcard_enqueue_styles' ) ) :
	/**
	 * @since 0.1
	 */
	function blogcard_enqueue_styles() {
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style( 'blogarise-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'blogcard-style', get_stylesheet_directory_uri() . '/style.css', array( 'blogarise-style-parent' ), '1.0' );
		wp_dequeue_style( 'blogarise-default',get_template_directory_uri() .'/css/colors/default.css');
		wp_enqueue_style( 'blogcard-default-css', get_stylesheet_directory_uri()."/css/colors/default.css" );
        wp_enqueue_style( 'blogcard-dark', get_stylesheet_directory_uri()."/css/colors/dark.css" );

		if(is_rtl()){
		    wp_enqueue_style( 'blogarise_style_rtl', trailingslashit( get_template_directory_uri() ) . 'style-rtl.css' );
	    }
		
	}

endif;
add_action( 'wp_enqueue_scripts', 'blogcard_enqueue_styles', 9999 );

function blogcard_theme_setup() {

    //Load text domain for translation-ready
    load_theme_textdomain('blog-card', get_stylesheet_directory() . '/languages');

    require( get_stylesheet_directory() . '/font.php');
    
    require( get_stylesheet_directory() . '/frontpage-options.php');

    add_theme_support( "title-tag" );

    add_theme_support( 'automatic-feed-links' );
}

add_action( 'after_setup_theme', 'blogcard_theme_setup' );


$args = array(
    'default-color' => '',
	'default-image' => get_stylesheet_directory_uri() . '/images/background-image.webp',
    'default-repeat'         => 'no-repeat',
	'default-position-x'     => 'center',
    'default-position-y'     => 'center',
    'default-size'           => 'cover',
	'default-attachment'     => 'fixed',
    'wp-head-callback' => '_custom_background_cb', // Callback function for rendering the custom background CSS in the head
    'admin-head-callback' => '',  // Callback function for rendering the custom background CSS in the admin panel head
    'admin-preview-callback' => '' // Callback function for renderin
);
add_theme_support( 'custom-background', $args );

// custom header Support
$args = array(
    'width'			=> '1600',
    'height'		=> '300',
    'flex-height'		=> false,
    'flex-width'		=> false,
    'header-text'		=> true,
    'default-text-color'	=> '000',
    'wp-head-callback'       => 'blogcard_header_color',
);
add_theme_support( 'custom-header', $args );

add_action( 'customize_register', 'blogcard_customizer_rid_values', 1000 );
function blogcard_customizer_rid_values($wp_customize) {

  $wp_customize->remove_control('blogarise_content_layout');
  $wp_customize->remove_control('blogarise_title_font_size');      

}

 if ( ! function_exists( 'blogcard_admin_scripts' ) ) :
function blogcard_admin_scripts() {

    wp_enqueue_style('blogcard-admin-style-css', get_stylesheet_directory_uri() . '/css/customizer-controls.css');
}
endif;
add_action( 'admin_enqueue_scripts', 'blogcard_admin_scripts' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blog_card_widgets_init() {

	$blog_card_footer_column_layout = esc_attr(get_theme_mod('blogarise_footer_column_layout',3));
	
	$blog_card_footer_column_layout = 12 / $blog_card_footer_column_layout;
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'blog-card' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'blog-card' ),
		'id'            => 'footer_widget_area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-'.$blog_card_footer_column_layout.' rotateInDownLeft animated bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );

}
add_action( 'widgets_init', 'blog_card_widgets_init' );

function blogcard_theme_option( $wp_customize ){

        /**
     * Customize Control for Radio Image.
     *
     * @since 1.0.0
     *
     * @see WP_Customize_Control
     */
    class blogcard_Radio_Image_Control extends WP_Customize_Control {

        /**
         * Control type.
         *
         * @access public
         * @var string
         */
        public $type = 'radio-image';

        /**
         * Render content.
         *
         * @since 1.0.0
         */
        public function render_content() {

            if ( empty( $this->choices ) ) {
                return;
            }

            $name = '_customize-radio-' . $this->id;

            ?>
            <label>
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif; ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>

                <?php foreach ( $this->choices as $value => $label ) : ?>
                    <label>
                        <input type="radio" value="<?php echo esc_attr( $value ); ?>" <?php $this->link();
                        checked( $this->value(), $value ); ?> class="np-radio-image" name="<?php echo esc_attr( $name ); ?>"/>
                        <span><img src="<?php echo esc_url( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" /></span>
                    </label>
                <?php endforeach; ?>
            </label>
            <?php
        }
    }

    /*--- Site title Font size **/
    $wp_customize->add_setting('blogcard_title_font_size',
        array(
            'default'           => 60,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 50,
        )
    );
    $wp_customize->add_control('blogcard_title_font_size',
        array(
            'label'    => esc_html__('Site Title Size', 'blog-card'),
            'section'  => 'title_tagline',
            'type'     => 'number',
        )
    );

    // Setting - show_main_news_section.
    $wp_customize->add_setting('show_main_news_section',
        array(
            'default' => 1,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'blogarise_sanitize_checkbox',
        )
    );
    $wp_customize->add_control('show_main_news_section',
        array(
            'label' => esc_html__('Enable Slider Banner Section', 'blog-card'),
            'section' => 'frontpage_main_banner_section_settings',
            'type' => 'checkbox',
            'priority' => 10,

        )
    ); 

    $wp_customize->add_setting(
        'blogcard_content_layout', array(
        'default'           => 'align-content-right',
        'sanitize_callback' => 'blogarise_sanitize_radio',
    ) );
    
    
    $wp_customize->add_control(
        new blogcard_Radio_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'blogcard_content_layout',
            // $args
            array(
                'settings'      => 'blogcard_content_layout',
                'section'       => 'blog_layout_section',
                'priority' => 50,
                'choices'       => array(
                    'align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',  
                    'full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                    'align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
                    'grid-left-sidebar' => get_template_directory_uri() . '/images/grid-left-sidebar.png',
                    'grid-fullwidth' => get_template_directory_uri() . '/images/grid-fullwidth.png',
                    'grid-right-sidebar' => get_template_directory_uri() . '/images/grid-right-sidebar.png',
                )
            )
        )
    );
}
add_action('customize_register','blogcard_theme_option');

if ( ! function_exists( 'blogcard_header_color' ) ) :
function blogcard_header_color() {
    $blogarise_logo_text_color = get_header_textcolor();
    $blogcard_title_font_size = get_theme_mod('blogcard_title_font_size','');

    ?>
    <style type="text/css">
    <?php
        if ( ! display_header_text() ) :
    ?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }
    <?php
        else :
    ?>
        .site-title a,
        .site-description {
            color: #<?php echo esc_attr( $blogarise_logo_text_color ); ?>;
        }

        .site-branding-text .site-title a {
                font-size: <?php echo esc_attr( $blogcard_title_font_size); ?>px;
            }

            @media only screen and (max-width: 640px) {
                .site-branding-text .site-title a {
                    font-size: 26px;

                }
            }

            @media only screen and (max-width: 375px) {
                .site-branding-text .site-title a {
                    font-size: 26px;

                }
            }

    <?php endif; 

    $color = get_theme_mod( 'background_color','' ); ?>
    :root {
        --wrap-color: #<?php echo esc_attr($color); ?>
    }
    </style>
    <?php
}
endif;


function blogcard_limit_content_chr( $content, $limit=100 ) {
    return mb_strimwidth( strip_tags($content), 0, $limit, '...' );
}