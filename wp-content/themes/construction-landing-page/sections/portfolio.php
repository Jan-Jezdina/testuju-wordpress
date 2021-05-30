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
    <div class="container">
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
                        $qry->the_post();
                        if( has_post_thumbnail() ){
                            ?>
    				        <div class="col">
                                <div class="img-holder">
                                    <?php  the_post_thumbnail( 'construction-landing-page-about-portfolio', array( 'itemprop' => 'image' ) ); ?>
                                    <div class="text-holder">
                						<div class="table">
                							<div class="table-row">
                								<div class="table-cell">
                									<h3 class="title"><?php the_title(); ?></h3>
                									<?php the_excerpt(); ?>
                									<a href="<?php the_permalink(); ?>" class="btn-more"><?php esc_html_e( 'View Detail','construction-landing-page' ); ?></a>
                								</div>
                							</div>
                						</div>
                                    </div>
                                </div>
                            </div>
                        <?php }
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