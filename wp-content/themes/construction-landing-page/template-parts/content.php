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
	
	<a href="<?php the_permalink() ?>" class="post-thumbnail">
		<?php 
			if( has_post_thumbnail() ){ 
				the_post_thumbnail( 'construction-landing-page-blog', array( 'itemprop' => 'image' ) );
			}else{
				construction_landing_page_get_fallback_svg( 'construction-landing-page-blog' );
			} 
		?>
	</a>
    
    <div class="text-holder">
    	
        <header class="entry-header">
    	<?php             
            the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    		
    		if ( 'post' === get_post_type() ) : ?>
    		<div class="entry-meta">
    			<?php construction_landing_page_posted_on(); ?>
    		</div><!-- .entry-meta -->
    		<?php
    		endif; ?>
            
    	</header><!-- .entry-header -->

    	<div class="entry-content" itemprop="text">
    		<?php
    			
                if( false === get_post_format() ){
                    the_excerpt();
                }else{
                    the_content( sprintf(
        				/* translators: %s: Name of current post. */
        				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'construction-landing-page' ), array( 'span' => array( 'class' => array() ) ) ),
        				the_title( '<span class="screen-reader-text">"', '"</span>', false )
        			) );
                }            
    
                wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'construction-landing-page' ),
    				'after'  => '</div>',
    			) );
                
    		?>
    	</div><!-- .entry-content -->
     
    	<footer class="entry-footer">
    	    <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php esc_html_e( 'Continue Reading', 'construction-landing-page' ); ?></a>
            <?php construction_landing_page_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
	 
	</div>
</article><!-- #post-## -->
