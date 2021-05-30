<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Construction Landing Page
*/

$construction_landing_page_sections = array( 'banner', 'about', 'promotional', 'portfolio', 'services', 'clients', 'testimonials', 'contactform' );
$ed_section = construction_landing_page_home_section();
    
if( 'posts' == get_option( 'show_on_front' ) ){
    include( get_home_template() );
}elseif( $ed_section ){ 
    get_header();     
    foreach( $construction_landing_page_sections as $section ){ 
        if( get_theme_mod( 'construction_landing_page_ed_' . $section . '_section' ) == 1 ){
            get_template_part( 'sections/' . esc_attr( $section ) );
        } 
    }
    get_footer();
}else{ 
    include( get_page_template() ); 
}