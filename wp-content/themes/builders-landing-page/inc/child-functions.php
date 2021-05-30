<?php

/**
 * Customize resgister settings and controls 
 */
function builders_landing_page_customize_register( $wp_customize ){

    $wp_customize->remove_setting( 'construction_landing_page_services_post_seven' );
    $wp_customize->remove_control( 'construction_landing_page_services_post_seven' );
    $wp_customize->remove_setting( 'construction_landing_page_services_post_eight' );
    $wp_customize->remove_control( 'construction_landing_page_services_post_eight' );

    // Load our custom control.
    require_once get_stylesheet_directory() . '/inc/custom-controls/repeater/class-repeater-setting.php';
    require_once get_stylesheet_directory() . '/inc/custom-controls/repeater/class-control-repeater.php';

    // Modify default parent theme controls
    $wp_customize->get_control( 'construction_landing_page_phone' )->priority   = -1;

    /** Header Phone Label */
    $wp_customize->add_setting(
        'builders_landing_page_header_phone_label',
        array(
            'default'           => __( 'Phone Number','builders-landing-page' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    // Selective referesh for header email
    $wp_customize->selective_refresh->add_partial( 'builders_landing_page_header_phone_label', array(
        'selector'        => '.site-header .header-t .right-panel .col span.header-phone',
        'render_callback' => 'builders_landing_page_header_phone_label',
    ) );

    $wp_customize->add_control(
        'builders_landing_page_header_phone_label',
        array(
            'type'            => 'text',
            'section'         => 'construction_landing_page_phone_number',
            'label'           => __( 'Phone # Label', 'builders-landing-page' ),
        )
    );

    /** Header Email Address */
    $wp_customize->add_setting(
        'builders_landing_page_header_email',
        array(
            'default'           => __( 'constructio@xyz.com','builders-landing-page' ),
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'builders_landing_page_header_email',
        array(
            'type'            => 'email',
            'section'         => 'construction_landing_page_phone_number',
            'label'           => __( 'Email Address', 'builders-landing-page' ),
        )
    );

     /** Header Phone Label */
    $wp_customize->add_setting(
        'builders_landing_page_header_email_label',
        array(
            'default'           => __( 'Email','builders-landing-page' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    // Selective referesh for header email
    $wp_customize->selective_refresh->add_partial( 'builders_landing_page_header_email_label', array(
        'selector'        => '.site-header .header-t .right-panel .col span.header-email',
        'render_callback' => 'builders_landing_page_header_email_label',
    ) );

    $wp_customize->add_control(
        'builders_landing_page_header_email_label',
        array(
            'type'            => 'text',
            'section'         => 'construction_landing_page_phone_number',
            'label'           => __( 'Email # Label', 'builders-landing-page' ),
        )
    );

    /** Header Phone Label */
    $wp_customize->add_setting(
        'builders_landing_page_header_get_a_quote_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'builders_landing_page_header_get_a_quote_url',
        array(
            'type'            => 'text',
            'section'         => 'construction_landing_page_phone_number',
            'label'           => __( 'Button link for Get A Quote', 'builders-landing-page' ),
            'description'     => __( 'You can find this in the end of navigation menu..', 'builders-landing-page' ),
        )
    );

    /** Enable Social Links */
    $wp_customize->add_setting(
        'builders_landing_page_ed_header_social_links',
        array(
            'default' => true,
            'sanitize_callback' => 'construction_landing_page_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'builders_landing_page_ed_header_social_links',
        array(
            'label'       => __( 'Enable Social Links', 'builders-landing-page' ),
            'description' => __( 'Enable to show social links at header.', 'builders-landing-page' ),
            'section'     => 'construction_landing_page_phone_number',
            'type'        => 'checkbox',
        )
    );
    
    /** Add social link repeater control */
    $wp_customize->add_setting( 
        new Builders_Landing_Page_Repeater_Setting( 
            $wp_customize, 
            'builders_landing_page_header_social_links', 
            array(
                'default' => array(),
                'sanitize_callback' => array( 'Builders_Landing_Page_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Builders_Landing_Page_Control_Repeater(
            $wp_customize,
            'builders_landing_page_header_social_links',
            array(
                'section' => 'construction_landing_page_phone_number',               
                'label'   => __( 'Social Links', 'builders-landing-page' ),
                'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'builders-landing-page' ),
                        'description' => __( 'Example: fa-bell', 'builders-landing-page' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'builders-landing-page' ),
                        'description' => __( 'Example: http://facebook.com', 'builders-landing-page' ),
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'links', 'builders-landing-page' ),
                    'field' => 'link'
                ),
                'choices'   => array(
                    'limit' => 10
                ),             
                'active_callback' => 'builders_landing_page_customizer_active_callback',                 
            )
        )
    );


   

    //Testimonials added

     $wp_customize->add_setting(
        'construction_landing_page_testimonials_post_five',
        array(
            'default' => '',
            'sanitize_callback' => 'construction_landing_page_sanitize_select',
        )
    );

     $wp_customize->add_control(
        'construction_landing_page_testimonials_post_five',
        array(
            'label'   => __( 'Select Post/Page Five', 'builders-landing-page' ),
            'section' => 'construction_landing_page_testimonials_settings',
            'type'    => 'select',
            'choices' => builders_landing_page_get_posts( array( 'post','page' ) ),
        )
    );

    $wp_customize->add_setting(
        'construction_landing_page_testimonials_post_six',
        array(
            'default' => '',
            'sanitize_callback' => 'construction_landing_page_sanitize_select',
        )
    );

     $wp_customize->add_control(
        'construction_landing_page_testimonials_post_six',
        array(
            'label'   => __( 'Select Post/Page Six', 'builders-landing-page' ),
            'section' => 'construction_landing_page_testimonials_settings',
            'type'    => 'select',
            'choices' => builders_landing_page_get_posts( array( 'post','page' ) ),
        )
    );

}
add_action( 'customize_register', 'builders_landing_page_customize_register', 100 );

/**
 * Customizer active callback function
 */
function builders_landing_page_customizer_active_callback( $control ){
    $ed_social_link = $control->manager->get_setting( 'builders_landing_page_ed_header_social_links' )->value();
    $control_id     = $control->id;
    // Phone number, Address, Email and Custom Link controls
    if ( $control_id == 'builders_landing_page_header_social_links' && $ed_social_link ) return true;
    return false;
}

function builders_landing_page_header_email_label(){
    $header_email    = get_theme_mod( 'builders_landing_page_header_email_label',__( 'Email','builders-landing-page' ) );
    if( ! empty( $header_email ) ){
        return esc_html( $header_email );
    }                                     
    return false; 
}

function builders_landing_page_header_phone_label(){
    $phone_label  = get_theme_mod( 'builders_landing_page_header_phone_label',__( 'Phone Number','builders-landing-page' ) );
    if( ! empty( $phone_label ) ){
        return esc_html( $phone_label );
    }
    return false; 
}


/**
* Callback for Social Links
*/
function builders_landing_page_social_links_cb(){
    $social_icons = get_theme_mod( 'builders_landing_page_header_social_links', array() );

    if( $social_icons ){
    ?>
    <ul class="social-networks">
		<?php
        foreach( $social_icons as $socials ){
            if( $socials['link'] ){ ?>
                <li><a href="<?php echo esc_url( $socials['link'] );?>" <?php if( $socials['font'] != 'skype' ) echo 'target="_blank"'; ?> title="<?php echo esc_attr( $socials['font'] ); ?>"><i class="<?php echo esc_attr( $socials['font'] );?>"></i></a></li>
        <?php
            }
        }?>
	</ul>
    <?php
    }
}
add_action( 'builders_landing_page_social_link', 'builders_landing_page_social_links_cb' );

function builders_landing_page_get_section_header( $section_title , $section_name ){

        $header_query = new WP_Query( array( 
                'p'         => $section_title,
                'post_type' => array( 'post', 'page' ),
            )
        );
        if( $section_name == 'about' ){
            $readmore = __( 'More About Us','builders-landing-page' );
        }
        if( $section_name == 'projects' ){
            $readmore = __( 'View More Projects','builders-landing-page' );
        }
        if( $section_name == 'services' ){
            $readmore = __( 'View More Projects','builders-landing-page' );
        }
        
        if( $section_title && $header_query->have_posts() ){ 
            while( $header_query->have_posts() ){ $header_query->the_post();
        ?>
                <div class="btn-holder">
                    <a href="<?php the_permalink(); ?>"><?php echo esc_html( $readmore ); ?></a>
                </div>
        <?php   
        }
        wp_reset_postdata();
    }
}

/**
 * Register custom fonts.
 */
function builders_landing_page_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Muli, translate this to 'off'. Do not translate into your own language.
    */
    $muli = _x( 'on', 'Muli font: on or off', 'builders-landing-page' );
    
    /*
    * translators: If there are characters in your language that are not supported
    * by Poppins, translate this to 'off'. Do not translate into your own language.
    */
    $poppins = _x( 'on', 'Poppins font: on or off', 'builders-landing-page' );

    if ( 'off' !== $muli || 'off' !== $poppins ) {
        $font_families = array();

        if( 'off' !== $muli ){
            $font_families[] = 'Muli:400,400i,700,700i';
        }

        if( 'off' !== $poppins ){
            $font_families[] = 'Poppins:400,400i,500,500i,600,600i,700,700i';
        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}


if ( ! function_exists( 'builders_landing_page_get_fontawesome_ajax' ) ) :
/**
 * Return an array of all icons.
 */
function builders_landing_page_get_fontawesome_ajax() {
    // Bail if the nonce doesn't check out
    if ( ! isset( $_POST['builders_landing_page_customize_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['builders_landing_page_customize_nonce'] ), 'builders_landing_page_customize_nonce' ) ) {
        wp_die();
    }

    // Do another nonce check
    check_ajax_referer( 'builders_landing_page_customize_nonce', 'builders_landing_page_customize_nonce' );

    // Bail if user can't edit theme options
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_die();
    }

    // Get all of our fonts
    $fonts = builders_landing_page_get_fontawesome_list();
    
    ob_start();
    if( $fonts ){ ?>
        <ul class="font-group">
            <?php 
                foreach( $fonts as $font ){
                    echo '<li data-font="' . esc_attr( $font ) . '"><i class="' . esc_attr( $font ) . '"></i></li>';                        
                }
            ?>
        </ul>
        <?php
    }
    echo ob_get_clean();

    // Exit
    wp_die();
}
endif;
add_action( 'wp_ajax_builders_landing_page_get_fontawesome_ajax', 'builders_landing_page_get_fontawesome_ajax' );

function builders_landing_page_customize_script(){
    wp_localize_script( 'builders-landing-page-repeater', 'builders_landing_page_customize',
        array(
            'nonce' => wp_create_nonce( 'builders_landing_page_customize_nonce' )
        )
    );
}
add_action( 'customize_controls_enqueue_scripts', 'builders_landing_page_customize_script' );