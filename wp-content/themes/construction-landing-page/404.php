<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Construction_Landing_Page
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="error-holder">
				<h1>404</h1>
				<p><?php esc_html_e( 'The Page you are looking for is no longer exists. Please use search or navigate from Homepage.', 'construction-landing-page' ); ?> </p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-back"><?php esc_html_e('Back to homepage','construction-landing-page'); ?></a>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
