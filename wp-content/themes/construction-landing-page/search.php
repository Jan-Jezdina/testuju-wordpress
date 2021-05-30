<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Construction_Landing_Page
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		    <div class="top-section">
				<p><?php echo esc_html__( 'If you didn&rsquo;t find what you were looking for, try a new search!', 'construction-landing-page' ); ?></p>
			    <?php get_search_form(); ?>
			</div>

		<?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_pagination( array(
    	        'prev_text'          => '<span class="fa fa-angle-double-left"></span>',
    	        'next_text'          => '<span class="fa fa-angle-double-right"></span>',
    	        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-landing-page' ) . ' </span>',
             ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
