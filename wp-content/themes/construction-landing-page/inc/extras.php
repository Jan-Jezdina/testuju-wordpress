<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Construction_Landing_Page
 */

if( ! function_exists( 'construction_landing_page_mobile_header' ) ) :
/**
 * Mobile Header
 */
function construction_landing_page_mobile_header(){
    $phone = get_theme_mod( 'construction_landing_page_phone' );
    ?>
    <div class="mobile-header">
        <div class="container">
            <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
                <?php if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                       echo '<div class="custom-logo">';
                       the_custom_logo();
                       echo '</div>';
                   } ?>
                <div class="text-logo">
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php 
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description" itemprop="description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                    <?php
                    endif; ?>
                </div>
            </div>

            <button class="menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-mobile-menu">
                   <span></span>
                   <span></span>
                   <span></span>
            </button>

           <div class="mobile-menu">
                <!-- This is primary-menu -->
                <nav id="mobile-navigation" class="primary-navigation">        
                    <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                        <button class="close-mobile-menu" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                        <div class="mobile-menu-title" aria-label="<?php esc_attr_e( 'Mobile', 'construction-landing-page' ); ?>">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_id'        => 'mobile-primary-menu',
                                    'menu_class'     => 'nav-menu main-menu-modal',
                                ) );
                            ?>
                        </div>
                    </div>
                </nav><!-- #mobile-site-navigation -->
           </div>
        </div>
    </div>
        
    <?php
}
endif;


if( ! function_exists( 'construction_landing_page_site_header' ) ) :
/**
 * Site Header
 */
function construction_landing_page_site_header(){
    ?>
       <header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
        <div class="container">
            <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
                <?php 
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                        the_custom_logo();
                    } 
                ?>
                <div class="text-logo">
                    <?php if ( is_front_page() ) : ?>
                        <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif;
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description" itemprop="description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                    <?php
                    endif; ?>
                </div>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
            
        </div>
    </header><!-- #masthead -->
    <?php
}
endif;


if( ! function_exists( 'construction_landing_page_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function construction_landing_page_body_classes( $classes ) {
	
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
    
    // Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
	if( !( is_active_sidebar( 'right-sidebar' ) ) ) {
        $classes[] = 'full-width'; 
    }

    if( construction_landing_page_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }
    
	if( is_page() ){
		$sidebar_layout = construction_landing_page_sidebar_layout();
        if( $sidebar_layout == 'no-sidebar' )
		$classes[] = 'full-width';
	}
    
    if( is_page_template( 'template-home.php' ) ){
        $ed_banner = get_theme_mod( 'construction_landing_page_ed_banner_section' );
        $home_page = get_option( 'page_on_front' );
        if( $ed_banner && has_post_thumbnail( $home_page ) ){
            $classes[] = 'has-banner';    
        }else{
            $classes[] = 'no-banner';
        }
    }else{
        $classes[] = 'no-banner';
    }

	return $classes;
}
endif;
add_filter( 'body_class', 'construction_landing_page_body_classes' );

/**
* Filter wp_nav_menu() to add profile link
* 
* @link http://www.wpbeginner.com/wp-themes/how-to-add-custom-items-to-specific-wordpress-menus/
*/
if( ! function_exists( 'construction_landing_page_phone_link' ) ) :

function construction_landing_page_phone_link( $menu, $args ){
    
    $phone = get_theme_mod( 'construction_landing_page_phone' );
            
    if( $phone && $args->theme_location == 'primary' ){
        
        $menu .= '<li><a href="' . esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ) . '" class="tel-link"><span class="fa fa-phone"></span>' . esc_html( $phone ) . '</a></li>';        
               
    }
       
    return $menu; 
}
endif;
add_filter( 'wp_nav_menu_items', 'construction_landing_page_phone_link', 10, 2 );

if( ! function_exists( 'construction_landing_page_get_header' ) ) :
/**
 * Page Header
*/
function construction_landing_page_get_header(){ 
    if( ! is_front_page() && ! is_page_template( 'template-home.php' ) ){
        
        $ed_bc = get_theme_mod( 'construction_landing_page_ed_breadcrumb' ); //from customizer
    
        if( is_single() ){ 
            if( $ed_bc ){ ?>
            
            <div class="header-block">
        		<div class="container">
                    <?php construction_landing_page_breadcrumb(); ?>
                </div>
            </div>
            
        <?php   
            }
        }else{
            ?>
            <!-- Page Header for inner pages only -->
            <div class="header-block">
                <div class="container">
                
                    <div class="page-header">
                    
                        <h1 class="page-title">
                        <?php 
                            
                            if( is_home() ) single_post_title();
                            
                            if( is_page() ) the_title();
                            
                            if( is_search() ) printf( esc_html__( 'Search Results for: "%s"', 'construction-landing-page' ), '<span>' . get_search_query() . '</span>' );
                            
                                    /** For Woocommerce */
                            if( construction_landing_page_is_woocommerce_activated() && ( is_product_category() || is_product_tag() || is_shop() ) ){
                                if( is_shop() ){
                                    if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                                        return;
                                    }
                                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                                
                                    if ( ! $_name ) {
                                        $product_post_type = get_post_type_object( 'product' );
                                        $_name = $product_post_type->labels->singular_name;
                                    }
                                    echo esc_html( $_name );
                                }elseif( is_product_category() || is_product_tag() ){
                                    $current_term = $GLOBALS['wp_query']->get_queried_object();
                                    echo esc_html( $current_term->name );
                                }
                            }else{
                                if( is_archive() ) the_archive_title();    
                            }
                            
                            if( is_404() ) esc_html_e( '404 - Page not found', 'construction-landing-page' );
                            
                        ?>
                        </h1>
                    </div>
                
                    <?php construction_landing_page_breadcrumb(); ?>
                </div>
            </div>
            <?php
        }
    }
}
endif;
add_action( 'construction_landing_page_page_header', 'construction_landing_page_get_header' );

if( ! function_exists( 'construction_landing_page_breadcrumb' ) ) :
/**
 * Breadcrumb 
*/
function construction_landing_page_breadcrumb() {    
    global $post;
    
    $post_page   = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front  = get_option( 'show_on_front' ); //What to show on the front page
    $showCurrent = get_theme_mod( 'construction_landing_page_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $delimiter   = get_theme_mod( 'construction_landing_page_breadcrumb_separator', __( '>', 'construction-landing-page' ) ); // delimiter between crumbs
    $home        = get_theme_mod( 'construction_landing_page_breadcrumb_home_text', __( 'Home', 'construction-landing-page' ) ); // text for the 'Home' link
    $before      = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
      
    $depth = 1; 
    if( get_theme_mod( 'construction_landing_page_ed_breadcrumb' ) ){   
        echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" class="home_crumb"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            if( is_home() && ! is_front_page() ){            
                $depth = 2;
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;          
            }elseif( is_category() ){            
                $depth = 2;
                $thisCat = get_category( get_query_var( 'cat' ), false );
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                    $depth ++;  
                }

                if ( $thisCat->parent != 0 ) {
                    $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                    $parent_categories = explode( ',', $parent_categories );

                    foreach ( $parent_categories as $parent_term ) {
                        $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                        if( is_object( $parent_obj ) ){
                            $term_url    = get_term_link( $parent_obj->term_id );
                            $term_name   = $parent_obj->name;
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }

                if( $showCurrent ) echo $before . '<span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;

            }elseif( is_tag() ){            
                $queried_object = get_queried_object();
                $depth = 2;

                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;    
            }elseif( is_author() ){            
                $depth = 2;
                global $author;
                $userdata = get_userdata( $author );
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $userdata->display_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
            }elseif( is_day() ){            
                $depth = 2;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'construction-landing-page' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'construction-landing-page' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'construction-landing-page' ) ), get_the_time( __( 'm', 'construction-landing-page' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'construction-landing-page' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'd', 'construction-landing-page' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                 
            }elseif( is_month() ){            
                $depth = 2;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'construction-landing-page' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'construction-landing-page' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth++;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'F', 'construction-landing-page' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
            }elseif( is_year() ){            
                $depth = 2;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'construction-landing-page' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
            }elseif( is_single() && !is_attachment() ) {
                //For Woocommerce single product            
                if( construction_landing_page_is_woocommerce_activated() && 'product' === get_post_type() ){ 
                    if ( wc_get_page_id( 'shop' ) ) { 
                        //Displaying Shop link in woocommerce archive page
                        $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                        if ( ! $_name ) {
                            $product_post_type = get_post_type_object( 'product' );
                            $_name = $product_post_type->labels->singular_name;
                        }
                        echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                    }
                
                    if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                        $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                        $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                        $ancestors = array_reverse( $ancestors );

                        foreach ( $ancestors as $ancestor ) {
                            $ancestor = get_term( $ancestor, 'product_cat' );    
                            if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                                $depth++;
                            }
                        }
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                    }
                
                    if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                                   
                }else{ 
                    //For Post                
                    $cat_object       = get_the_category();
                    $potential_parent = 0;
                    $depth            = 2;
                    
                    if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                        $p = get_post( $post_page );
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';  
                        $depth++;
                    }
                    
                    if( is_array( $cat_object ) ){ //Getting category hierarchy if any
            
                        //Now try to find the deepest term of those that we know of
                        $use_term = key( $cat_object );
                        foreach( $cat_object as $key => $object ){
                            //Can't use the next($cat_object) trick since order is unknown
                            if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                                $use_term = $key;
                                $potential_parent = $object->term_id;
                            }
                        }
                        
                        $cat = $cat_object[$use_term];
                  
                        $cats = get_category_parents( $cat, false, ',' );
                        $cats = explode( ',', $cats );

                        foreach ( $cats as $cat ) {
                            $cat_obj = get_term_by( 'name', $cat, 'category' );
                            if( is_object( $cat_obj ) ){
                                $term_url    = get_term_link( $cat_obj->term_id );
                                $term_name   = $cat_obj->name;
                                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                                $depth ++;
                            }
                        }
                    }
        
                    if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                                 
                }        
            }elseif( is_page() ){            
                $depth = 2;
                if( $post->post_parent ){            
                    global $post;
                    $depth = 2;
                    $parent_id  = $post->post_parent;
                    $breadcrumbs = array();
                    
                    while( $parent_id ){
                        $current_page  = get_post( $parent_id );
                        $breadcrumbs[] = $current_page->ID;
                        $parent_id     = $current_page->post_parent;
                    }
                    $breadcrumbs = array_reverse( $breadcrumbs );
                    for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                        if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                        $depth++;
                    }

                    if ( $showCurrent ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;      
                }else{
                    if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
                }
            }elseif( is_search() ){            
                $depth = 2;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html__( 'Search Results for "', 'construction-landing-page' ) . esc_html( get_search_query() ) . esc_html__( '"', 'construction-landing-page' ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
            }elseif( construction_landing_page_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ 
                //For Woocommerce archive page        
                $depth = 2;
                if ( wc_get_page_id( 'shop' ) ) { 
                    //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                }
                $current_term = $GLOBALS['wp_query']->get_queried_object();
                if( is_product_category() ){
                    $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }           
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $current_term->name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;           
            }elseif( construction_landing_page_is_woocommerce_activated() && is_shop() ){ //Shop Archive page
                $depth = 2;
                if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                    return;
                }
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
        
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;                    
            }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {            
                $depth = 2;
                $post_type = get_post_type_object(get_post_type());
                if( get_query_var('paged') ){
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                    echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'construction-landing-page'), get_query_var('paged') ) . $after;
                }elseif( is_archive() ){
                    echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                }else{
                    echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                }              
            }elseif( is_attachment() ){            
                $depth  = 2;
                $parent = get_post( $post->post_parent );
                $cat    = get_the_category( $parent->ID );
                if( $cat ){
                    $cat = $cat[0];
                    echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
                }
                if( $showCurrent ) echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;   
            }elseif ( is_404() ){
                if( $showCurrent ) echo $before . esc_html__( '404 Error - Page not Found', 'construction-landing-page' ) . $after;
            }
            if( get_query_var('paged') ) echo __( ' (Page', 'construction-landing-page' ) . ' ' . get_query_var('paged') . __( ')', 'construction-landing-page' );        
            echo '</div>';
    }
}
endif;

if( ! function_exists( 'construction_landing_page_sidebar_layout' ) ) :
/**
 * Return sidebar layouts for pages
*/
function construction_landing_page_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'construction_landing_page_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'construction_landing_page_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}
endif;

if( ! function_exists( 'construction_landing_page_post_author' ) ) :
/**
 * Author Bio
 * 
*/
function construction_landing_page_post_author(){
    if( get_the_author_meta( 'description' ) ){
    ?>
    <section class="author">
		<h2><?php esc_html_e( 'About Author', 'construction-landing-page' ); ?></h2>
		<div class="holder">
			<div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 161 ); ?></div>
			<div class="text-holder">
				<strong class="name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></strong>				
				<?php echo wpautop( esc_html( get_the_author_meta( 'description' ) ) ); ?>
			</div>
		</div>
	</section>
    <?php  
    }  
}
endif;

if( ! function_exists( 'construction_landing_page_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function construction_landing_page_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'construction-landing-page' ) : __( 'Name', 'construction-landing-page' ) );
    $email    = ( $req ? __( 'Email*', 'construction-landing-page' ) : __( 'Email', 'construction-landing-page' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'construction-landing-page' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'construction-landing-page' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'construction-landing-page' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'construction-landing-page' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'construction_landing_page_change_comment_form_default_fields' );

if( ! function_exists( 'construction_landing_page_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function construction_landing_page_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'construction-landing-page' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'construction-landing-page' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'construction_landing_page_change_comment_form_defaults' );

if ( ! function_exists( 'construction_landing_page_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function construction_landing_page_excerpt_more($more) {
	return is_admin() ? $more : ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'construction_landing_page_excerpt_more' );

if ( ! function_exists( 'construction_landing_page_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function construction_landing_page_excerpt_length( $length ) {
	return is_admin() ? $length : 20;
}
endif;
add_filter( 'excerpt_length', 'construction_landing_page_excerpt_length', 999 );

if( ! function_exists( 'construction_landing_page_get_section_header') ):
/**
 * Returns Section header
*/
function construction_landing_page_get_section_header( $section_title ){
    
        $header_query = new WP_Query( array( 
                
                'p' => $section_title,
                'post_type' => 'page'

                ));
        
        if( $section_title && $header_query->have_posts() ){ 
            while( $header_query->have_posts() ){ $header_query->the_post();
            ?>
                <header class="header">
                    <?php 
                         the_title('<h2 class="main-title">','</h2>');
                         the_content(); 
                    ?>
                </header>
            <?php 
         }
        wp_reset_postdata();
        }
    
}
endif;

if( ! function_exists( 'construction_landing_page_get_clients') ):
/**
 * Helper function for listing sponsor 
*/
function construction_landing_page_get_clients( $logo, $url ){
    
    echo '<div class="col">';
    if( $url ) echo '<a href="' . esc_url( $url ) . '" target="_blank">'; 
    if( $logo ) echo '<img src="' . esc_url( $logo ) . '">';
    if( $url ) echo '</a>';
    echo '</div>';
     
}
endif;

/**
 * Exclude post with Category from blog and archive page. 
*/
function construction_landing_page_exclude_cat( $query ){
    $cat = get_theme_mod( 'construction_landing_page_exclude_cat' );
    
    if( $cat && ! is_admin() && $query->is_main_query() ){
        $cat = array_diff( array_unique( $cat ), array('') );
        if( $query->is_home() || $query->is_archive() ) {
            $query->set( 'category__not_in', $cat );
        }
    }    
}
add_filter( 'pre_get_posts', 'construction_landing_page_exclude_cat' );

/** 
 * Exclude Categories from Category Widget 
*/ 
function construction_landing_page_custom_category_widget( $arg ) {
    $cat = get_theme_mod( 'construction_landing_page_exclude_cat' );
    
    if( $cat ){
        $cat = array_diff( array_unique( $cat ), array('') );
        $arg["exclude"] = $cat;
    }
    return $arg;
}
add_filter( "widget_categories_args", "construction_landing_page_custom_category_widget" );
add_filter( "widget_categories_dropdown_args", "construction_landing_page_custom_category_widget" );

/**
 * Exclude post from recent post widget of excluded catergory
 * 
 * @link http://blog.grokdd.com/exclude-recent-posts-by-category/
*/
function construction_landing_page_exclude_posts_from_recentPostWidget_by_cat( $arg ){
    
    $cat = get_theme_mod( 'construction_landing_page_exclude_cat' );
    
    if( $cat ){
        $cat = array_diff( array_unique( $cat ), array('') );
        $arg["category__not_in"] = $cat;
    }
    
    return $arg;   
}
add_filter( "widget_posts_args", "construction_landing_page_exclude_posts_from_recentPostWidget_by_cat" );

/**
 * Query Contact Form 7
 */
function construction_landing_page_is_cf7_activated() {
	return class_exists( 'WPCF7' ) ? true : false;
}

/**
 * Query WooCommerce activation
 */
function construction_landing_page_is_woocommerce_activated() {
    return class_exists( 'woocommerce' ) ? true : false;
}

if( ! function_exists( 'construction_landing_page_home_section') ):
/**
 * Check if home page section are enable or not.
*/
    function construction_landing_page_home_section(){

        $construction_landing_page_sections = array( 'banner', 'about', 'promotional', 'portfolio', 'services', 'clients', 'testimonials', 'contactform' );       
        $enable_section = false;
        foreach( $construction_landing_page_sections as $section ){ 
            if( get_theme_mod( 'construction_landing_page_ed_' . $section . '_section' ) == 1 ){
                $enable_section = true;
            }
        }
        return $enable_section;
    }
endif;

if( ! function_exists( 'construction_landing_page_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function construction_landing_page_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'construction-landing-page-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = construction_landing_page_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( construction_landing_page_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "https://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"      => esc_html( get_the_title( $post->ID ) ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => construction_landing_page_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">' , PHP_EOL;
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
        } else {
            echo wp_json_encode( $args ) , PHP_EOL;
        }
        echo '</script>' , PHP_EOL;
    }
}
endif;
add_action( 'wp_head', 'construction_landing_page_single_post_schema' );

if( ! function_exists( 'construction_landing_page_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function construction_landing_page_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'construction_landing_page_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function construction_landing_page_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'construction_landing_page_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function construction_landing_page_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = construction_landing_page_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#dedddd;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'construction_landing_page_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function construction_landing_page_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by PT Sans, translate this to 'off'. Do not translate into your own language.
    */
    $pt_sans = _x( 'on', 'PT Sans font: on or off', 'construction-landing-page' );
    
    $font_families = array();

    if( 'off' !== $pt_sans ){
        $font_families[] = 'PT Sans:400,400italic,700italic,700';
    }

    $query_args = array(
        'family'  => urlencode( implode( '|', $font_families ) ),
        'display' => urlencode( 'fallback' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    
    return esc_url( $fonts_url );
}
endif;