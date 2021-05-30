<?php
/**
 * Services Section
 *
 * @package Construction_Landing_Page
 */  
$section_title = get_theme_mod( 'construction_landing_page_service_section_page' );
$post_one      = get_theme_mod( 'construction_landing_page_services_post_one' );
$post_two      = get_theme_mod( 'construction_landing_page_services_post_two' );
$post_three    = get_theme_mod( 'construction_landing_page_services_post_three' );
$post_four     = get_theme_mod( 'construction_landing_page_services_post_four' );
$post_five     = get_theme_mod( 'construction_landing_page_services_post_five' );
$post_six      = get_theme_mod( 'construction_landing_page_services_post_six' );
$post_seven    = get_theme_mod( 'construction_landing_page_services_post_seven' );
$post_eight    = get_theme_mod( 'construction_landing_page_services_post_eight' );
$service_posts = array( $post_one, $post_two, $post_three, $post_four, $post_five, $post_six, $post_seven, $post_eight );
$service_posts = array_diff( array_unique( $service_posts ), array('') );
if( $section_title || $service_posts ){
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
            <section id="services_section" class="our-services" <?php echo $style; ?>>
        <?php }
        wp_reset_postdata();
    }else{?>
        <section id="services_section" class="our-services">
    <?php }
?>
    <div class="container">
        <?php 
        construction_landing_page_get_section_header( $section_title );

        $qry = new WP_Query( array( 
                'post_type'           => array( 'post', 'page' ),
                'posts_per_page'      => -1,
                'post__in'            => $service_posts,
                'orderby'             => 'post__in',
                'ignore_sticky_posts' => true
            ) );
			if( $service_posts && $qry->have_posts() ){ ?>
                <div class="row">
                <?php 
                    while( $qry->have_posts() ){
                        $qry->the_post();?>
                        <div class="col">
                            <div class="holder">
                                <?php if( has_post_thumbnail() ){ ?>
                                    <div class="icon-holder"><?php the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); ?></div>
                                <?php } ?>
                                 <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                  <?php the_excerpt(); ?>
                              </div>
                        </div>
                    <?php 
                    }
                    wp_reset_postdata();
                ?>		
                </div>
			<?php 
            } 
        ?>
    </div>
</section>
<?php
}