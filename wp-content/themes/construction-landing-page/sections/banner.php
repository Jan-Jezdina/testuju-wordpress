<?php
/**
 * Banner Section
 *
 * @package Construction_Landing_Page
 */
while ( have_posts() ) : the_post();
if( has_post_thumbnail() ){
    $banner_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'construction-landing-page-banner' );
    $style = ' style="background: url(' . esc_url( $banner_image[0] ) . '); background-size: cover; background-position: center;"';    
}else{
    $style = '';
}

$banner_form = get_theme_mod( 'construction_landing_page_banner_form' );
if( has_post_thumbnail() ){
?>   
<section id="banner_section" class="banner"<?php echo $style; ?>>  
    <div class="container">
        <div class="row">      
            <div class="col">
                <div class="text">
                    <strong class="title"><?php the_title(); ?></strong>
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
             if( construction_landing_page_is_cf7_activated() && $banner_form ) {	
                    echo '<div class="col">';
                    echo do_shortcode( wp_kses_post( $banner_form ) );
                    echo '</div>';
                }
            ?>
      </div>
    </div>  
</section>
<?php
}
endwhile;	