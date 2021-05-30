<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Construction_Landing_Page
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="https://schema.org/WebSite">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'construction-landing-page' ); ?></a>
	<?php 
        construction_landing_page_mobile_header();
        construction_landing_page_site_header(); 
        /**
         * Page Header
         * 
         * @hooked construction_landing_page_get_header
        */
        do_action( 'construction_landing_page_page_header' );

        echo '<div id="acc-content">    <!-- done for accessibility reasons -->';

        $ed_section = construction_landing_page_home_section();
        
    	if( is_home() || ! $ed_section || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){
    		echo '<div id="content" class="site-content">';
    	    echo '<div class="container">';
    		echo '<div class="row">';
    	}
