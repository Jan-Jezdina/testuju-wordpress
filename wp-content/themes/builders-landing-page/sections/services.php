<?php
/**
 * Services Section
 *
 * @package builders_Landing_Page
 */  
$section_title   = get_theme_mod( 'construction_landing_page_service_section_page' );
$post_one        = get_theme_mod( 'construction_landing_page_services_post_one' );
$post_two        = get_theme_mod( 'construction_landing_page_services_post_two' );
$post_three      = get_theme_mod( 'construction_landing_page_services_post_three' );
$post_four       = get_theme_mod( 'construction_landing_page_services_post_four' );
$post_five       = get_theme_mod( 'construction_landing_page_services_post_five' );
$post_six        = get_theme_mod( 'construction_landing_page_services_post_six' );

$posts_arr = array( $post_one, $post_two, $post_three, $post_four, $post_five, $post_six );
$posts_arr = array_diff( array_unique( $posts_arr ), array('') );
if( $section_title || $posts_arr ){
?>
<section id="services_section" class="our-services">
    <?php
     $service_query = new WP_Query( array(           
        'p' => $section_title,
        'post_type' => 'page'
    ) ); 
    if( $section_title && $service_query->have_posts() ){ 
        while( $service_query->have_posts() ){ $service_query->the_post();
            if( has_post_thumbnail() ){
                $service_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'construction-landing-page-banner' );
                $style = ' style="background-image: url(' . esc_url( $service_image[0] ) . '); background-size: cover; background-position: center;"';    
            }else{
                $style = '';
            } ?>
            <div class="top" <?php echo $style; ?>>
        <?php }
        wp_reset_postdata();
    }else{ ?>
        <div class="top">
    <?php } ?>
        <div class="container">
            <?php construction_landing_page_get_section_header( $section_title ); ?>
        </div>
    </div>
    <div class="services-content">
        <div class="container">
            <?php 
            $qry = new WP_Query( array( 
                    'post_type'           => array( 'post', 'page' ),
                    'posts_per_page'      => -1,
                    'post__in'            => $posts_arr,
                    'orderby'             => 'post__in',
                    'ignore_sticky_posts' => true
                ) );
                if( $posts_arr && $qry->have_posts() ){ ?>
                    <div class="row">
                    <?php 
                        while( $qry->have_posts() ){
                            $qry->the_post();?>
                            <div class="col">
                                <div class="holder">
                                    <div class="icon-holder">
                                        <?php 
                                        if( has_post_thumbnail() ){ 
                                            the_post_thumbnail( 'thumbnail', array( 'itemprop' => 'image' ) ); 
                                        }else{
                                            construction_landing_page_get_fallback_svg( 'thumbnail' );
                                        } ?>
                                    </div>
                                    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                      <?php the_excerpt(); ?>
                                  </div>
                            </div>
                        <?php 
                        }
                        wp_reset_postdata();
                    ?>      
                    </div>
                    <?php builders_landing_page_get_section_header( $section_title ,'services' ); ?>
                <?php 
                } 
            ?>
        </div>
    </div>
    
</section>
<?php
}
