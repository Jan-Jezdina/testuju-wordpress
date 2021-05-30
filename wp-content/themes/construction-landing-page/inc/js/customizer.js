( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
jQuery(document).ready(function($){
    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-construction_landing_page_home_page_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });
        
});

function scrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-construction_landing_page_about_settings':
        preview_section_id = "about_section";
        break;
        
        case 'accordion-section-construction_landing_page_promotional_block_settings':
        preview_section_id = "promotional-block";
        break;
        
        case 'accordion-section-construction_landing_page_portfolio_settings':
        preview_section_id = "portfolio_section";
        break;
        
        case 'accordion-section-construction_landing_page_services_settings':
        preview_section_id = "services_section";
        break;
        
        case 'accordion-section-construction_landing_page_clients_settings':
        preview_section_id = "clients_section";
        break;

        case 'accordion-section-construction_landing_page_testimonials_settings':
        preview_section_id = "testimonial_section";
        break;

        case 'accordion-section-construction_landing_page_contact_form_settings':
        preview_section_id = "promotional-block2";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}