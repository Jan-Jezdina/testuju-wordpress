<?php

/**
 * Testimonial Section
 *
 * @package Construction_Landing_Page
 */ 

$section_title     = get_theme_mod( 'construction_landing_page_testimonial_section_page' );
$post_one          = get_theme_mod( 'construction_landing_page_testimonials_post_one' );
$post_two          = get_theme_mod( 'construction_landing_page_testimonials_post_two' );
$post_three        = get_theme_mod( 'construction_landing_page_testimonials_post_three' );
$post_four         = get_theme_mod( 'construction_landing_page_testimonials_post_four' );
$testimonial_posts = array( $post_one, $post_two, $post_three, $post_four );
$testimonial_posts = array_diff( array_unique( $testimonial_posts ), array('') );
if( $section_title || $testimonial_posts ){
?>
<section class="testimonial" id="testimonial_section">
     <div class="container">
        <?php 
            construction_landing_page_get_section_header( $section_title );
             $qry = new WP_Query( array( 
                'post_type'           => array( 'post', 'page' ),
                'posts_per_page'      => -1,
                'post__in'            => $testimonial_posts,
                'orderby'             => 'post__in',
                'ignore_sticky_posts' => true
            ) );
            if( $testimonial_posts && $qry->have_posts() ){ ?>
                <div class="row">
    			<?php 
                    while( $qry->have_posts()){ 
                        $qry->the_post(); ?> 
                        <div class="col">
                            <blockquote>
                                <?php the_content(); ?>
                            </blockquote>
                            <cite>
                                <div class="img-holder">
                                    <?php 
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( 'construction-landing-page-testimonial', array( 'itemprop' => 'image' ) ); 
                                    }else{
                                        construction_landing_page_get_fallback_svg( 'construction-landing-page-testimonial' );
                                    } ?>
                                </div>
                                <div class="text-holder">
                                    <strong class="name"><?php the_title(); ?></strong>
                                    <?php if( has_excerpt() ){ ?>
                                        <span class="company"><?php the_excerpt(); ?></span>
                                    <?php }?>
                                </div>
                            </cite>
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