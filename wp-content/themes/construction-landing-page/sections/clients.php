<?php
/**
 * Clients Section
 *
 * @package Construction_Landing_Page
 */ 


$section_title = get_theme_mod( 'construction_landing_page_clients_section_title' );
$logo_one   = get_theme_mod( 'construction_landing_page_client_logo_one' );
$one_url    = get_theme_mod( 'construction_landing_page_client_logo_one_url' );
$logo_two   = get_theme_mod( 'construction_landing_page_client_logo_two' );
$two_url    = get_theme_mod( 'construction_landing_page_client_logo_two_url' );
$logo_three = get_theme_mod( 'construction_landing_page_client_logo_three' );
$three_url  = get_theme_mod( 'construction_landing_page_client_logo_three_url' );
$logo_four  = get_theme_mod( 'construction_landing_page_client_logo_four' );
$four_url   = get_theme_mod( 'construction_landing_page_client_logo_four_url' );
$logo_five  = get_theme_mod( 'construction_landing_page_client_logo_five' );
$five_url   = get_theme_mod( 'construction_landing_page_client_logo_five_url' );

$clients = array(
    'one'  => array(
        'logo'  => $logo_one,
        'url'   => $one_url
    ),
    'two'  => array(
        'logo'  => $logo_two,
        'url'   => $two_url
    ),
    'three'  => array(
        'logo'  => $logo_three,
        'url'   => $three_url
    ),
    'four'  => array(
        'logo'  => $logo_four,
        'url'   => $four_url
    ),
    'five'  => array(
        'logo'  => $logo_five,
        'url'   => $five_url
    )
);

if( $section_title || $logo_one || $one_url || $logo_two || $two_url || $logo_three || $three_url || $logo_four || $four_url || $logo_five || $five_url ){
?>
<section class="our-clients" id="clients_section">
    <div class="container">
        <?php if( $section_title ){ ?>
			<header class="header">
				<strong><?php echo esc_html( $section_title ); ?></strong>
			</header>
        <?php } 
        if( $logo_one || $one_url || $logo_two || $two_url || $logo_three || $three_url || $logo_four || $four_url || $logo_five || $five_url ){ ?>
        <div class="row">
            <?php 
            foreach( $clients as $client ){
                construction_landing_page_get_clients( $client['logo'], $client['url'] );    
            } ?>                  
        </div>
        <?php } ?>
    </div>    
</section>
<?php
}