<?php
/**
 * Promotional Section
 *
 * @package Construction_Landing_Page
 */

$section_title   = get_theme_mod( 'construction_landing_page_contact_section_page' );
$contact_form    = get_theme_mod( 'construction_landing_page_contact_form' );

if( $section_title || ( construction_landing_page_is_cf7_activated() && $contact_form ) ){

    $contact_query = new WP_Query( array(           
        'p' => $section_title,
        'post_type' => 'page'
    ) ); 

    if( $section_title && $contact_query->have_posts() ){ 
        while( $contact_query->have_posts() ){ $contact_query->the_post();
            if( has_post_thumbnail() ){
                $contact_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'construction-landing-page-banner' );
                $style = ' style="background-image: url(' . esc_url( $contact_image[0] ) . '); background-size: cover; background-position: center;"';    
            }else{
                $style = '';
            } ?>
            <section id="promotional-block2" class="promotional-block2" <?php echo $style; ?>>
        <?php }
        wp_reset_postdata();
    }else{?>
        <section id="promotional-block2" class="promotional-block2">
    <?php }
?>

    <div class="container">
        <?php 
        
            construction_landing_page_get_section_header( $section_title );
                
		    if ( construction_landing_page_is_cf7_activated() && $contact_form ) {
	        	echo do_shortcode( wp_kses_post( $contact_form ) );
	        } 
        ?>     
	</div>
</section>
<?php
}