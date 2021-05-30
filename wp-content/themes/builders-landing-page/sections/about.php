<?php
/**
 * About Section
 *
 * @package builders_Landing_Page
 */ 
$section_title   = get_theme_mod( 'construction_landing_page_about_section_page' );
$post_one        = get_theme_mod( 'construction_landing_page_about_post_one' );
$post_two        = get_theme_mod( 'construction_landing_page_about_post_two' );
$post_three      = get_theme_mod( 'construction_landing_page_about_post_three' );
$posts_arr = array( $post_one, $post_two, $post_three );
$posts_arr = array_diff( array_unique( $posts_arr ), array('') );
       
if( $section_title || $posts_arr ){
?>
<section class="about" id="about_section">
    <div class="container">
      <?php construction_landing_page_get_section_header( $section_title );
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
                         $qry->the_post(); ?> 
				        <div class="col">
                            <div class="img-holder">
        					    <a href="<?php the_permalink(); ?>">
        				        <?php 
                                if( has_post_thumbnail()){ 
                                    the_post_thumbnail( 'construction-landing-page-about-portfolio', array( 'itemprop' => 'image' ) ); 
                                }else{
                                    construction_landing_page_get_fallback_svg( 'construction-landing-page-about-portfolio' );
                                } ?>
                                </a>
    	                    </div>
                            <div class="text-holder">
                                <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php the_excerpt(); ?>
                            </div>
				        </div>
			         <?php 
                     }
                     wp_reset_postdata(); 
                     
                ?>
                </div>
                <?php builders_landing_page_get_section_header( $section_title,'about' ); ?>
            <?php 
            } 
        ?>
    </div>
</section>
<?php
}
