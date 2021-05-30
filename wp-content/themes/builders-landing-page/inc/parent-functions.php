<?php
/*
All the Pluggable functions are overriden from here
*/
function construction_landing_page_site_header(){
    $phonelabel   = get_theme_mod( 'builders_landing_page_header_phone_label',__( 'Phone Number','builders-landing-page' ) );
    $emaillabel   = get_theme_mod( 'builders_landing_page_header_email_label',__( 'Email','builders-landing-page' ) );
    $phonenumber  = get_theme_mod( 'construction_landing_page_phone' ); 
    $emailaddress = get_theme_mod( 'builders_landing_page_header_email',__( 'constructio@xyz.com','builders-landing-page' ) ); 
    $ed_social    = get_theme_mod( 'builders_landing_page_ed_header_social_links',true );
    ?>
       <header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
		<div class="top-bar">
			<div class="container">
				<div class="phone-holder">
					<?php esc_html_e( 'Call Us Today','builders-landing-page' ); ?>
	                <?php if( ! empty( $phonenumber ) ){ ?>
	                    <a href="<?php echo esc_url( 'tel:'.preg_replace( '/[^\d+]/', '', $phonenumber ) ); ?>"><?php echo esc_html( $phonenumber ); ?></a>
	                <?php } ?>
				</div>
			   	<?php if( $ed_social ) do_action( 'builders_landing_page_social_link' );  ?>
			</div>
		</div>
		<div class="header-t">
			<div class="container">
				<div class="top">
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
		                    
					<div class="right-panel">
						<?php if( ! empty( $phonenumber ) ){ ?>
                        <div class="col">
			                <span class="header-phone">
			                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
									 <path data-name="Path 7" d="M8.9,6.333a20.521,20.521,0,0,0,.75,4.317l-2,2A24.709,24.709,0,0,1,6.383,6.333H8.9M25.333,26.367a21.255,21.255,0,0,0,4.333.75V29.6a25.711,25.711,0,0,1-6.333-1.25l2-1.983M10.5,3H4.667A1.672,1.672,0,0,0,3,4.667,28.331,28.331,0,0,0,31.333,33,1.672,1.672,0,0,0,33,31.333V25.517a1.672,1.672,0,0,0-1.667-1.667,19.012,19.012,0,0,1-5.95-.95,1.4,1.4,0,0,0-.517-.083,1.707,1.707,0,0,0-1.183.483l-3.667,3.667A25.248,25.248,0,0,1,9.033,15.983L12.7,12.317a1.673,1.673,0,0,0,.417-1.7,18.934,18.934,0,0,1-.95-5.95A1.672,1.672,0,0,0,10.5,3Z" transform="translate(-3 -3)"/>
									</svg>
			                    <?php if( $phonelabel ) echo esc_html( $phonelabel ); ?>

			                    <?php if( ! empty( $phonenumber ) ){ ?>
			                        <a href="<?php echo esc_url( 'tel:'.preg_replace( '/[^\d+]/', '', $phonenumber ) ); ?>"><?php echo esc_html( $phonenumber ); ?></a>
			                    <?php } ?>
			                </span>
						</div>
						<?php } ?>

                        						                        
						<?php if ( ! empty( $emailaddress ) ) { ?>                                    
							<div class="col">
				                <span class="header-email">
				                    <svg xmlns="http://www.w3.org/2000/svg" width="33.333" height="26.667" viewBox="0 0 33.333 26.667">
										 <path data-name="Path 15" d="M32,4H5.333A3.329,3.329,0,0,0,2.017,7.333L2,27.333a3.343,3.343,0,0,0,3.333,3.333H32a3.343,3.343,0,0,0,3.333-3.333v-20A3.343,3.343,0,0,0,32,4Zm0,23.333H5.333V10.667L18.667,19,32,10.667ZM18.667,15.667,5.333,7.333H32Z" transform="translate(-2 -4)"/>
										</svg>
				                    <?php echo esc_html( $emaillabel ); ?>
				                    <a href="<?php echo esc_url( 'mailto:'.sanitize_email( $emailaddress ) ); ?>"><?php echo esc_html( $emailaddress ); ?></a>
				                </span>
							</div>
		                <?php } ?>
					</div>
				</div>
				<div class="bottom">
					  <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
	                		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            		   </nav><!-- #site-navigation -->
				</div>
			</div>
		</div>
	</header>
    <?php
}

function construction_landing_page_mobile_header(){
 	  $phonelabel   = get_theme_mod( 'builders_landing_page_header_phone_label',__( 'Phone Number','builders-landing-page' ) );
    $emaillabel   = get_theme_mod( 'builders_landing_page_header_email_label',__( 'Email','builders-landing-page' ) );
    $phonenumber  = get_theme_mod( 'construction_landing_page_phone' ); 
    $emailaddress = get_theme_mod( 'builders_landing_page_header_email',__( 'constructio@xyz.com','builders-landing-page' ) ); 
    $ed_social    = get_theme_mod( 'builders_landing_page_ed_header_social_links',true );
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
                <div class="mobile-menu-title" aria-label="<?php esc_attr_e( 'Mobile', 'builders-landing-page' ); ?>">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'mobile-primary-menu',
                            'menu_class'     => 'nav-menu main-menu-modal',
                        ) );
                    ?>
                </div>

                <?php if( $ed_social ) do_action( 'builders_landing_page_social_link' );  ?>

                <div class="phone-holder">
                  <?php esc_html_e( 'Call Us Today','builders-landing-page' ); ?>
                      <?php if( ! empty( $phonenumber ) ){ ?>
                          <a href="<?php echo esc_url( 'tel:'.preg_replace( '/[^\d+]/', '', $phonenumber ) ); ?>"><?php echo esc_html( $phonenumber ); ?></a>
                      <?php } ?>
                </div>

                <div class="email-holder">
      			   	 <?php if ( ! empty( $emailaddress ) ) {
      			   		 echo esc_html( $emaillabel ); ?>
      				        <a href="<?php echo esc_url( 'mailto:'.sanitize_email( $emailaddress ) ); ?>"><?php echo esc_html( $emailaddress ); ?></a> 
      		        <?php } ?>
                </div>
              </div>
          </nav><!-- #mobile-site-navigation -->
        </div>
      </div>
    </div>
        
    <?php
}

function construction_landing_page_phone_link( $menu, $args ){
    $url = get_theme_mod( 'builders_landing_page_header_get_a_quote_url' );
    if( $url && $args->theme_location == 'primary' ){
        $menu .= '<li><a href="'. esc_url( $url ) .'" class="request-link">' . esc_html__( 'Get A Quote','builders-landing-page' ) . '</a></li>';        
    }
    return $menu; 
}

function construction_landing_page_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info' , array(
		'title'       => __( 'Demo and Documentation' , 'builders-landing-page' ),
		'priority'    => 6,
		));

	$wp_customize->add_setting('theme_info_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));
    
    $theme_info = '';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Documentation', 'builders-landing-page' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/builders-landing-page/' ) . '" target="_blank">' . __( 'here', 'builders-landing-page' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Demo', 'builders-landing-page' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/previews/?theme=builders-landing-page' ) . '" target="_blank">' . __( 'here', 'builders-landing-page' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Info', 'builders-landing-page' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/builders-landing-page/' ) . '" target="_blank">' . __( 'here', 'builders-landing-page' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support Ticket', 'builders-landing-page' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blank">' . __( 'here', 'builders-landing-page' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Rate this theme', 'builders-landing-page' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/support/theme/builders-landing-page/reviews/' ) . '" target="_blank">' . __( 'here', 'builders-landing-page' ) . '</a></span><br />';

	$wp_customize->add_control( new Construction_Landing_Page_Theme_Info( $wp_customize ,'theme_info_theme',array(
		'section'     => 'theme_info',
		'description' => $theme_info
	)));
}

function builders_landing_page_get_posts( $post_type = 'post', $slug = false ){    
    $args = array(
    	'posts_per_page'   => -1,
    	'post_type'        => $post_type,
    	'post_status'      => 'publish',
    	'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    
    // Initiate an empty array
    $post_options = array();
    $post_options[''] = __( 'Choose Post/Page', 'builders-landing-page' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            if( $slug ){
                $post_options[ $posts->post_title ] = $posts->post_title;
            }else{
                $post_options[ $posts->ID ] = $posts->post_title;    
            }
        }
    }
    return $post_options;
    wp_reset_postdata();
}

function construction_landing_page_get_section_header( $section_title ){    
    $header_query = new WP_Query( array(
        'p'         => $section_title,
        'post_type' => 'page'
    ));
        
    if( $section_title && $header_query->have_posts() ){ 
        while( $header_query->have_posts() ){ 
            $header_query->the_post(); ?>
            <header class="header">
                <?php 
                     the_title('<h2 class="main-title">','</h2>');
                     the_excerpt(); 
                ?>
            </header>
            <?php 
        }
        wp_reset_postdata();
    }
}