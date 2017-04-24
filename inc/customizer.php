<?php
/**
 * Customizer functions.
 *
 * @package Bornholm
 */

/**
 * Creates the settings, controls and sections for the customizer
 *
 * @param $wp_customize
 */
function bornholm_customize_register( $wp_customize ) {

	$wp_customize->add_setting( 'number_of_galleries_from_same_category_on_single_gallery_page', array(
		'default'           => 3,
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'number_of_galleries_from_same_category_on_single_gallery_page', array(
		'type'     => 'number',
		'priority' => 10,
		'section'  => 'gallery',
		'label'    => __( 'Number of galleries from the same category to show in the single view of a gallery (0 if no galleries should be displayed)', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'hide_gallery_titles_for_galleries_from_same_category', array(
		'sanitize_callback' => 'bornholm_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'hide_gallery_titles_for_galleries_from_same_category', array(
		'type'     => 'checkbox',
		'priority' => 12,
		'section'  => 'gallery',
		'label'    => __( 'Check if the titles of the galleries should be hidden for the galleries from the same category.', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'hide_gallery_titles_on_recent_galleries_widget', array(
		'sanitize_callback' => 'bornholm_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'hide_gallery_titles_on_recent_galleries_widget', array(
		'type'     => 'checkbox',
		'priority' => 12,
		'section'  => 'content',
		'label'    => __( 'Check if the titles of the galleries should be hidden on the recent galleries widget.', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'hide_gallery_titles_on_featured_galleries_widget', array(
		'sanitize_callback' => 'bornholm_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'hide_gallery_titles_on_featured_galleries_widget', array(
		'type'     => 'checkbox',
		'priority' => 14,
		'section'  => 'content',
		'label'    => __( 'Check if the titles of the galleries should be hidden on the featured galleries widget.', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'number_of_small_images_from_gallery_in_blog_view', array(
		'default'           => 2,
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'number_of_small_images_from_gallery_in_blog_view', array(
		'type'     => 'number',
		'priority' => 10,
		'section'  => 'content',
		'label'    => __( 'Number of small images from the gallery to show in the blog view below the big image (0 if no small images should be displayed)', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'hierarchy_of_gallery_on_alternative_front_page', array(
		'sanitize_callback' => 'bornholm_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'hierarchy_of_gallery_on_alternative_front_page', array(
		'type'     => 'checkbox',
		'priority' => 10,
		'section'  => 'alternative_front_page',
		'label'    => __( 'Check if the galleries from child categories should be displayed below the galleries of the parent category.', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'hide_gallery_titles_on_alternative_front_page', array(
		'sanitize_callback' => 'bornholm_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'hide_gallery_titles_on_alternative_front_page', array(
		'type'     => 'checkbox',
		'priority' => 12,
		'section'  => 'alternative_front_page',
		'label'    => __( 'Check if the titles of the galleries should be hidden.', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'number_of_galleries_on_alternative_front_page', array(
		'default'           => 3,
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'number_of_galleries_on_alternative_front_page', array(
		'type'     => 'number',
		'priority' => 14,
		'section'  => 'alternative_front_page',
		'label'    => __( 'Number of galleries from every category to show', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'hide_gallery_titles_on_portfolio_page', array(
		'default'           => 0,
		'sanitize_callback' => 'bornholm_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'hide_gallery_titles_on_portfolio_page', array(
		'type'     => 'checkbox',
		'priority' => 12,
		'section'  => 'portfolio_page',
		'label'    => __( 'Check if the titles of the galleries should be hidden.', 'bornholm' ),
	) );

	$wp_customize->add_setting( 'galleries_on_portfolio_page', array(
		'default'           => 'standard',
		'sanitize_callback' => 'bornholm_sanitize_radio'
	) );
	$wp_customize->add_control( 'galleries_on_portfolio_page', array(
		'type'     => 'radio',
		'priority' => 10,
		'section'  => 'portfolio_page',
		'label'    => __( 'Change the appearance of the galleries on the portfolio page', 'bornholm' ),
		'choices'  => array(
			'standard'                                            => 'Standard',
			'portfolio_page_grouped_by_categories'                => __( 'Display the galleries grouped by categories.', 'bornholm' ),
			'portfolio_page_grouped_by_categories_with_hierarchy' => __( 'Display the galleries grouped by categories with hierarchy (child categories below parent categories).', 'bornholm' ),
		),
	) );

	$wp_customize->add_section( 'alternative_front_page', array(
		'title'    => _x( 'Alternative front page', 'Title of the alternative front page section in the Customizer', 'bornholm' ),
		'priority' => 140,
	) );

	$wp_customize->add_section( 'content', array(
		'title'    => _x( 'Content', 'Title of the content section in the Customizer', 'bornholm' ),
		'priority' => 160,
	) );

	$wp_customize->add_section( 'gallery', array(
		'title'    => _x( 'Gallery single view', 'Title of the Gallery single view section in the Customizer', 'bornholm' ),
		'priority' => 130,
	) );

	$wp_customize->add_section( 'portfolio_page', array(
		'title'    => _x( 'Portfolio Page', 'Title of the portfolio page section in the Customizer', 'bornholm' ),
		'priority' => 150,
	) );
}

add_action( 'customize_register', 'bornholm_customize_register' );

function bornholm_customize_css() {
	if ( get_theme_mod( 'header_textcolor' ) ) { ?>
		<style type="text/css">
			.site-title a {
				color: <?php echo '#' . get_theme_mod('header_textcolor'); ?>;
			}
		</style>
	<?php }
}

add_action( 'wp_head', 'bornholm_customize_css' );

function bornholm_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function bornholm_sanitize_radio( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;

	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
