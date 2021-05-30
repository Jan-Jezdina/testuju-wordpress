<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Construction_Landing_Page
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
	<?php 
		
        the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
		
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php construction_landing_page_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
        
	</header><!-- .entry-header -->

    <?php if( has_post_thumbnail() ){ ?>
        <div class="post-thumbnail">
            <?php ( is_active_sidebar( 'right-sidebar' ) ) ? the_post_thumbnail( 'construction-landing-page-with-sidebar', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'construction-landing-page-without-sidebar', array( 'itemprop' => 'image' ) ) ; ?>
        </div> 
    <?php }?>
    
	<div class="entry-content" itemprop="text">
		<?php
		    the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'construction-landing-page' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
            
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
