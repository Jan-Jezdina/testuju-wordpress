<?php
/**
 * Promotional Section
 *
 * @package Construction_Landing_Page
 */

$section_title   = get_theme_mod( 'construction_landing_page_promotional_section_page' );
$button_label    = get_theme_mod( 'construction_landing_page_promotional_button_label' );
$button_link     = get_theme_mod( 'construction_landing_page_promotional_button_link' );
$new_tab         = get_theme_mod( 'construction_landing_page_ed_open_in_new_tab_section',true );
if( $section_title || $button_label || $button_link ){ 
    $promotional_query = new WP_Query( array(           
        'p'         => $section_title,
        'post_type' => 'page'
    ) ); 
    if( $section_title && $promotional_query->have_posts() ){ 
        while( $promotional_query->have_posts() ){ $promotional_query->the_post();
            if( has_post_thumbnail() ){
                $promotional_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'construction-landing-page-banner' );
                $style = ' style="background-image: url(' . esc_url( $promotional_image[0] ) . '); background-size: cover; background-position: center;"';    
            }else{
                $style = '';
            } ?>
            <section id="promotional-block" class="promotional-block" <?php echo $style; ?>>
        <?php }
        wp_reset_postdata();
    }else{ ?>
        <section id="promotional-block" class="promotional-block">
    <?php }
?>
    <div class="container">
        <div class="holder">
			<?php construction_landing_page_get_section_header( $section_title );
                if( $new_tab ){
                     if( $button_label && $button_link ) echo '<a href="' . esc_url( $button_link ) . '" class="btn" target="_blank">' . esc_html( $button_label ) . '</a>';   
                 }else{
                    if( $button_label && $button_link ) echo '<a href="' . esc_url( $button_link ) . '" class="btn">' . esc_html( $button_label ) . '</a>';    
                }       
            ?>
        </div>
    </div>
</section>
<?php
}