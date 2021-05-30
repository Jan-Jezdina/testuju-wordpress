<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Construction_Landing_Page
 */

$sidebar_layout = construction_landing_page_sidebar_layout();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    <?php
        if( has_post_thumbnail() ){
            echo '<div class="post-thumbnail">';
            ( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) ? the_post_thumbnail( 'construction-landing-page-with-sidebar', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'construction-landing-page-without-sidebar', array( 'itemprop' => 'image' ) );    
            echo '</div>';
        }
    ?>

	<div class="entry-content" itemprop="text">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'construction-landing-page' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php construction_landing_page_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
