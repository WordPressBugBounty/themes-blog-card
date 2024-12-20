<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function blogcard_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Heebo:400,500,700,800,900|Nunito:400,500,700|Rubik:400,500,700|Outfit Sans:400,500,700&display=swap');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function blogcard_scripts_styles() {
    wp_enqueue_style( 'blogcard-fonts', blogcard_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'blogcard_scripts_styles' );