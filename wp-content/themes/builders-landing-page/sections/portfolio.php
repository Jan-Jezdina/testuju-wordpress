<?php
/**
 * Portfolio Section
 *
 * @package Construction_Landing_Page
 */
$section_title   = get_theme_mod( 'construction_landing_page_portfolio_section_page' );
$post_one        = get_theme_mod( 'construction_landing_page_portfolio_post_one' );
$post_two        = get_theme_mod( 'construction_landing_page_portfolio_post_two' );
$post_three      = get_theme_mod( 'construction_landing_page_portfolio_post_three' );
$post_four       = get_theme_mod( 'construction_landing_page_portfolio_post_four' );
$post_five       = get_theme_mod( 'construction_landing_page_portfolio_post_five' );
$post_six        = get_theme_mod( 'construction_landing_page_portfolio_post_six' );
$portfolio_posts = array( $post_one, $post_two, $post_three, $post_four, $post_five, $post_six );
$portfolio_posts = array_diff( array_unique( $portfolio_posts ), array('') );
       
if( $section_title || $portfolio_posts ){
?>
<section class="our-projects" id="portfolio_section">
    <div class="inner-wrapper">
        <?php 
            construction_landing_page_get_section_header( $section_title );
            $qry = new WP_Query( array( 
                'post_type'           => array( 'post', 'page' ),
                'posts_per_page'      => -1,
                'post__in'            => $portfolio_posts,
                'orderby'             => 'post__in',
                'ignore_sticky_posts' => true
            ) );
			if( $portfolio_posts && $qry->have_posts() ){ ?>
                <div class="row">
                <?php 
                    while( $qry->have_posts() ){
                        $qry->the_post();?>
				        <div class="col">
                            <div class="img-holder">
                                <?php 
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( 'construction-landing-page-about-portfolio', array( 'itemprop' => 'image' ) );
                                }else{ 
                                    construction_landing_page_get_fallback_svg( 'construction-landing-page-about-portfolio' );
                                } ?>
                            </div>
                            <div class="blp-text-holder">
                                <div class="text-content">
                                    <h3 class="title"><?php the_title(); ?></h3>
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn-more"><?php esc_html_e( 'Read More','builders-landing-page' ); ?></a>
                            </div>
                        </div>
                   <?php 
                   }
                   
                   wp_reset_postdata(); 
                ?>

                </div>
                <?php builders_landing_page_get_section_header( $section_title,'projects' ); ?>
            <?php 
            } 
        ?>
    </div>
</section>
<?php
}
