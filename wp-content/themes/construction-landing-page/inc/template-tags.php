<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Construction_Landing_Page
 */

if ( ! function_exists( 'construction_landing_page_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function construction_landing_page_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date())
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'construction-landing-page' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'Posted by %s', 'post author', 'construction-landing-page' ),
		'<span class="authors vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>';
	
    if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'construction-landing-page' ) );
		if ( $categories_list && construction_landing_page_categorized_blog() ) {
			echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
        }
        
        /* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'construction-landing-page' ) );
		if ( $tags_list ) {
			echo '<span class="tag-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
		}
    }
        
	echo'<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
    
    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'construction-landing-page' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'construction_landing_page_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function construction_landing_page_entry_footer() {
	
    edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'construction-landing-page' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'construction_landing_page_categorized_blog' ) ) :
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function construction_landing_page_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'construction_landing_page_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'construction_landing_page_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so construction_landing_page_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so construction_landing_page_categorized_blog should return false.
		return false;
	}
}
endif;

if ( ! function_exists( 'construction_landing_page_category_transient_flusher' ) ) :
/**
 * Flush out the transients used in construction_landing_page_categorized_blog.
 */
function construction_landing_page_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'construction_landing_page_categories' );
}
endif;
add_action( 'edit_category', 'construction_landing_page_category_transient_flusher' );
add_action( 'save_post',     'construction_landing_page_category_transient_flusher' );
