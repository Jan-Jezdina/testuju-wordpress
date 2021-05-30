<?php
/**
 * Widget Social Links
 *
 * @package Construction_Landing_Page
 */

// register Construction_Landing_Page_Social_Links widget 
function construction_landing_page_register_social_links_widget() {
    register_widget( 'Construction_Landing_Page_Social_Links' );
}
add_action( 'widgets_init', 'construction_landing_page_register_social_links_widget' );
 
 /**
 * Adds Construction_Landing_Page_Social_Links widget.
 */
class Construction_Landing_Page_Social_Links extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'construction_landing_page_social_links', // Base ID
			__( 'RARA: Social Links', 'construction-landing-page' ), // Name
			array( 'description' => __( 'A Social Links Widget', 'construction-landing-page' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	   
        $title      = ! empty( $instance['title'] ) ? $instance['title'] : '';		
        $facebook   = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '' ;
        $twitter    = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '' ;
        $pinterest  = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '' ;
        $linkedin   = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '' ;
        $googleplus = ! empty( $instance['google_plus'] ) ? $instance['google_plus'] : '' ;
        $instagram  = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '' ;
        $youtube    = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '' ;
        $ok         = ! empty( $instance['ok'] ) ? $instance['ok'] : '' ;
        $vk         = ! empty( $instance['vk'] ) ? $instance['vk'] : '' ;
        $xing       = ! empty( $instance['xing'] ) ? $instance['xing'] : '' ;
       
        if( $facebook || $twitter || $pinterest || $linkedin || $googleplus || $instagram || $youtube || $ok || $vk || $xing ){ 
        echo $args['before_widget'];
        if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
        ?>
            <ul class="social-networks">
				<?php if( $facebook ){ ?>
                <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'construction-landing-page' ); ?>" ><i class="fa fa-facebook"></i></a></li>
				<?php } if( $twitter ){ ?>
                <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'construction-landing-page' ); ?>" ><i class="fa fa-twitter"></i></a></li>
				<?php } if( $pinterest ){ ?>
                <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" title="<?php esc_attr_e( 'Pinterest', 'construction-landing-page' ); ?>" ><i class="fa fa-pinterest-p"></i></a></li>
				<?php } if( $linkedin ){ ?>
                <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" title="<?php esc_attr_e( 'Linkedin', 'construction-landing-page' ); ?>" ><i class="fa fa-linkedin"></i></a></li>
				<?php } if( $googleplus ){ ?>
                <li><a href="<?php echo esc_url( $googleplus ); ?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'construction-landing-page' ); ?>" ><i class="fa fa-google-plus"></i></a></li>
				<?php } if( $instagram ){ ?>
                <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'construction-landing-page' ); ?>" ><i class="fa fa-instagram"></i></a></li>
				<?php } if( $youtube ){ ?>
                <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank" title="<?php esc_attr_e( 'YouTube', 'construction-landing-page' ); ?>" ><i class="fa fa-youtube"></i></a></li>
                <?php } if( $ok ){ ?>
                <li><a href="<?php echo esc_url( $ok ); ?>" target="_blank" title="<?php esc_attr_e( 'OK', 'construction-landing-page' ); ?>" ><i class="fa fa-odnoklassniki"></i></a></li>
                <?php } if( $vk ){ ?>
                <li><a href="<?php echo esc_url( $vk ); ?>" target="_blank" title="<?php esc_attr_e( 'VK', 'construction-landing-page' ); ?>" ><i class="fa fa-vk"></i></a></li>
                <?php } if( $xing ){ ?>
                <li><a href="<?php echo esc_url( $xing ); ?>" target="_blank" title="<?php esc_attr_e( 'Xing', 'construction-landing-page' ); ?>" ><i class="fa fa-xing"></i></a></li>
                <?php }?>
			</ul>
        <?php
        echo $args['after_widget'];
        }
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        $title      = ! empty( $instance['title'] ) ? $instance['title'] : '';		
        $facebook   = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '' ;
        $twitter    = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '' ;
        $pinterest  = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '' ;
        $linkedin   = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '' ;
        $googleplus = ! empty( $instance['google_plus'] ) ? $instance['google_plus'] : '' ;
        $instagram  = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '' ;
        $youtube    = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '' ;
        $ok         = ! empty( $instance['ok'] ) ? $instance['ok'] : '' ;
        $vk         = ! empty( $instance['vk'] ) ? $instance['vk'] : '' ;
        $xing       = ! empty( $instance['xing'] ) ? $instance['xing'] : '' ; ?>
		
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_url( $facebook ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_url( $twitter ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_url( $pinterest ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'LinkedIn', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_url( $linkedin ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>"><?php esc_html_e( 'Google Plus', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_plus' ) ); ?>" type="text" value="<?php echo esc_url( $googleplus ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_url( $instagram ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'YouTube', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_url( $youtube ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ok' ) ); ?>"><?php esc_html_e( 'OK', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ok' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ok' ) ); ?>" type="text" value="<?php echo esc_url( $ok ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>"><?php esc_html_e( 'VK', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" type="text" value="<?php echo esc_url( $vk ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>"><?php esc_html_e( 'Xing', 'construction-landing-page' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'xing' ) ); ?>" type="text" value="<?php echo esc_url( $xing ); ?>" />
        </p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
    public function update( $new_instance, $old_instance ) {
		
        $instance = array();
		
        $instance['title']       = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['facebook']    = ! empty( $new_instance['facebook'] ) ? esc_url_raw( $new_instance['facebook'] ) : '';
        $instance['twitter']     = ! empty( $new_instance['twitter'] ) ? esc_url_raw( $new_instance['twitter'] ) : '';
        $instance['pinterest']   = ! empty( $new_instance['pinterest'] ) ? esc_url_raw( $new_instance['pinterest'] ) : '';
        $instance['linkedin']    = ! empty( $new_instance['linkedin'] ) ? esc_url_raw( $new_instance['linkedin'] ) : '';
        $instance['google_plus'] = ! empty( $new_instance['google_plus'] ) ? esc_url_raw( $new_instance['google_plus'] ) : '';
        $instance['instagram']   = ! empty( $new_instance['instagram'] ) ? esc_url_raw( $new_instance['instagram'] ) : '';
        $instance['youtube']     = ! empty( $new_instance['youtube'] ) ? esc_url_raw( $new_instance['youtube'] ) : '';
        $instance['ok']          = ! empty( $new_instance['ok'] ) ? esc_url_raw( $new_instance['ok'] ) : '';
        $instance['vk']          = ! empty( $new_instance['vk'] ) ? esc_url_raw( $new_instance['vk'] ) : '';
        $instance['xing']        = ! empty( $new_instance['xing'] ) ? esc_url_raw( $new_instance['xing'] ) : '';
		
        return $instance;
                
	}

} // class Construction_Landing_Page_Social_Links 