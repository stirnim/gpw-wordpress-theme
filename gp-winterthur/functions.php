<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// END ENQUEUE PARENT ACTION

/* MOBILE HEADER MENU */
function register_header_mobile_menu() {
    register_nav_menu('header-mobile-menu', __('Header Mobile Menu'));
}
add_action('init', 'register_header_mobile_menu');

add_action( 'after_setup_theme', 'remove_generate_add_header_mobile_menu', 20 );
function remove_generate_add_header_mobile_menu() {
    if ( has_action( 'generate_credits', 'generate_add_header_mobile_menu' ) ) {
        remove_action( 'generate_credits', 'generate_add_header_mobile_menu' );
    }
}

function display_header_mobile_menu() {
    if (has_nav_menu('header-mobile-menu')) {
        $locations = get_nav_menu_locations();
        $menu_id = $locations['header-mobile-menu'] ?? null;

        if ($menu_id) {
            $menu_items = wp_get_nav_menu_items($menu_id);

            if (is_array($menu_items) && count($menu_items) > 0) {
                wp_nav_menu(array(
                    'theme_location'  => 'header-mobile-menu',
                    'container'       => 'nav',
                    'container_class' => 'header-mobile-menu',
                    'menu_class'      => 'header-mobile-menu-list',
                    'depth'           => 1,
                    'walker'          => new Header_Mobile_Menu_Walker(),
                    // Pass additional arguments for the walker
                    'menu_items_count'=> count($menu_items),
                    'separator'       => '&nbsp;&nbsp;|&nbsp;&nbsp;',
                ));
            } else {
                echo '<p>No menu items found in the Header Mobile Menu.</p>';
            }
        } else {
            echo '<p>No menu assigned to Header Mobile Menu location.</p>';
        }
    } else {
        echo '<p>Header Mobile Menu location is not registered or has no menu assigned.</p>';
    }
}


class Header_Mobile_Menu_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        static $item_count = 0; // Counter for menu items
        $item_count++;

        // Check if menu_items_count is provided in $args
        $menu_items_count = $args->menu_items_count ?? 0;

        // Check if the current item is the last item
        $is_last_item = ($item_count === $menu_items_count);

        // Build the menu item
        $output .= sprintf(
            '<a href="%s">%s</a>',
            esc_url($item->url),
            esc_html($item->title)
        );

        // Add separator unless it's the last item
        if (!$is_last_item && !empty($args->separator)) {
            $output .= $args->separator;
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = null) {
        // Prevent levels since the depth is set to 1
    }
}



/* FOOTER MENU */
function register_footer_menu() {
    register_nav_menu('footer-menu', __( 'Footer Menu' ));
}
add_action( 'init', 'register_footer_menu' );

/* CUSTOM FOOTER  */
add_action( 'after_setup_theme', 'remove_generate_add_footer_info', 20 );
function remove_generate_add_footer_info() {
    if ( has_action( 'generate_credits', 'generate_add_footer_info' ) ) {
        remove_action( 'generate_credits', 'generate_add_footer_info' );
    }
}

function display_footer_menu() {
    if (has_nav_menu('footer-menu')) {
        $menu_items = wp_get_nav_menu_items('footer-menu'); // Get all menu items
        $menu_items_count = count($menu_items);

        wp_nav_menu(array(
            'theme_location'  => 'footer-menu',
            'container'       => 'nav',
            'container_class' => 'footer-menu footer-bottom-right',
            'menu_class'      => 'footer-menu-list',
            'depth'           => 1,
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<p>%3$s</p>',
            'separator'       => '&nbsp;&nbsp;|&nbsp;&nbsp;',
            'walker'          => new Footer_Menu_Walker(),
            'menu_items_count'=> $menu_items_count // Pass menu items count
        ));
    }
}
add_action('generate_credits', 'display_footer_menu', 15);


class Footer_Menu_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        static $item_count = 0; // Counter for menu items
        $item_count++;

        // Check if the current item is the last item
        $is_last_item = ($item_count === $args->menu_items_count);

        // Build the menu item
        $output .= sprintf(
            '<a href="%s">%s</a>',
            esc_url($item->url),
            esc_html($item->title)
        );

        // Add separator unless it's the last item
        if (!$is_last_item && !empty($args->separator)) {
            $output .= $args->separator;
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = null) {
        // We do not need levels in this implementation as depth is set to 1
    }
}


/* GUTENBERG CSS */
function gp_winterthur_customize_register($wp_customize) {
    // Add a new panel for "GP Winterthur Styling"
    $wp_customize->add_panel('gp_winterthur_styling', array(
        'title'       => __('GP Winterthur Styling', 'gp-winterthur'),
        'priority'    => 160,  // Adjust as needed
    ));
	
	// Header Section
    $wp_customize->add_section('header_section', array(
        'title'      => __('Header', 'gp-winterthur'),
        'panel'      => 'gp_winterthur_styling',
        'priority'   => 10,
    ));

    // Footer Section
    $wp_customize->add_section('footer_section', array(
        'title'      => __('Footer', 'gp-winterthur'),
        'panel'      => 'gp_winterthur_styling',
        'priority'   => 20,
    ));
	
// Menu Links Background Color
$wp_customize->add_setting('menu_link_bg_color', array(
    'default'           => '#004B50',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_bg_color', array(
    'label'    => __('Menu Link Background Color', 'gp-winterthur'),
    'section'  => 'header_section', // Add to header_section
)));

// Menu Links Text Color
$wp_customize->add_setting('menu_link_text_color', array(
    'default'           => '#D3FFB4',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_text_color', array(
    'label'    => __('Menu Link Text Color', 'gp-winterthur'),
    'section'  => 'header_section', // Add to header_section
)));

	// Menu Links Hover Background Color
$wp_customize->add_setting('menu_link_hover_bg_color', array(
    'default'           => '#A6B1F1',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_hover_bg_color', array(
    'label'    => __('Menu Link Hover Background Color', 'gp-winterthur'),
    'section'  => 'header_section', // Add to header_section
)));

// Menu Links Hover Text Color
$wp_customize->add_setting('menu_link_hover_text_color', array(
    'default'           => '#004B50',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_hover_text_color', array(
    'label'    => __('Menu Link Hover Text Color', 'gp-winterthur'),
    'section'  => 'header_section', // Add to header_section
)));
	
// Add header gradient color settings (for 6 stops in total)
$wp_customize->add_setting('header_color_1', array(
    'default'     => 'rgba(211, 255, 180, 0.15)',
    'transport'   => 'refresh',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_color_1', array(
    'label'   => __('Header Gradient Color 1', 'gp-winterthur'),
    'section' => 'header_section',
)));

$wp_customize->add_setting('header_color_2', array(
    'default'     => 'rgba(211, 255, 180, 0.3)',
    'transport'   => 'refresh',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_color_2', array(
    'label'   => __('Header Gradient Color 2', 'gp-winterthur'),
    'section' => 'header_section',
)));

$wp_customize->add_setting('header_color_3', array(
    'default'     => 'rgba(211, 255, 180, 0.5)',
    'transport'   => 'refresh',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_color_3', array(
    'label'   => __('Header Gradient Color 3', 'gp-winterthur'),
    'section' => 'header_section',
)));

$wp_customize->add_setting('header_color_4', array(
    'default'     => 'rgba(211, 255, 180, 0.7)',
    'transport'   => 'refresh',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_color_4', array(
    'label'   => __('Header Gradient Color 4', 'gp-winterthur'),
    'section' => 'header_section',
)));

$wp_customize->add_setting('header_color_5', array(
    'default'     => '#D3FFB4',
    'transport'   => 'refresh',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_color_5', array(
    'label'   => __('Header Gradient Color 5', 'gp-winterthur'),
    'section' => 'header_section',
)));

$wp_customize->add_setting('header_color_6', array(
    'default'     => 'transparent',
    'transport'   => 'refresh',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_color_6', array(
    'label'   => __('Header Gradient Color 6', 'gp-winterthur'),
    'section' => 'header_section',
)));
	
	
    // Add footer logo settings with default values
    $wp_customize->add_setting('footer_logo_migros', array(
        'default'     => get_stylesheet_directory_uri() . '/images/migros_lime.svg', // Default logo path
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo_migros', array(
        'label'   => __('Migros Logo', 'gp-winterthur'),
        'section' => 'footer_section',
        'settings' => 'footer_logo_migros',
    )));

    $wp_customize->add_setting('footer_logo_newbalance', array(
        'default'     => get_stylesheet_directory_uri() . '/images/nb_lime.svg', // Default logo path
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo_newbalance', array(
        'label'   => __('New Balance Logo', 'gp-winterthur'),
        'section' => 'footer_section',
        'settings' => 'footer_logo_newbalance',
    )));

    $wp_customize->add_setting('footer_logo_swica', array(
        'default'     => get_stylesheet_directory_uri() . '/images/swica_lime.svg', // Default logo path
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo_swica', array(
        'label'   => __('SWICA Logo', 'gp-winterthur'),
        'section' => 'footer_section',
        'settings' => 'footer_logo_swica',
    )));
	
	// Add setting for Facebook icon image
    $wp_customize->add_setting('footer_facebook_icon', array(
        'default'     => get_stylesheet_directory_uri() . '/images/facebook_darkforest.svg',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'footer_facebook_icon', array(
        'label'   => __('Facebook Icon', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    // Add setting for Instagram icon image
    $wp_customize->add_setting('footer_instagram_icon', array(
        'default'     => get_stylesheet_directory_uri() . '/images/instagram_darkforest.svg',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'footer_instagram_icon', array(
        'label'   => __('Instagram Icon', 'gp-winterthur'),
        'section' => 'footer_section',
    )));
	
	// Add setting for Facebook link
    $wp_customize->add_setting('footer_facebook_link', array(
        'default'     => 'https://www.facebook.com/wintimarathon',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control('footer_facebook_link', array(
        'label'   => __('Facebook Link', 'gp-winterthur'),
        'section' => 'footer_section',
        'type'    => 'url',
    ));

    // Add setting for Instagram link
    $wp_customize->add_setting('footer_instagram_link', array(
        'default'     => 'https://www.instagram.com/wintimarathon/',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control('footer_instagram_link', array(
        'label'   => __('Instagram Link', 'gp-winterthur'),
        'section' => 'footer_section',
        'type'    => 'url',
    ));
	
    // Add footer button text setting
    $wp_customize->add_setting('footer_button_text', array(
        'default'           => __('Newsletter Anmeldung', 'gp-winterthur'), // Default button text
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize the input
    ));

    $wp_customize->add_control('footer_button_text', array(
        'label'       => __('Footer Button Text', 'gp-winterthur'),
        'description' => __('Change the text of the newsletter button.', 'gp-winterthur'),
        'section'     => 'footer_section',
        'type'        => 'text',
    ));
	
// Add footer button link setting
$wp_customize->add_setting('footer_button_link', array(
    'default'           => '#', // Default button link
    'transport'         => 'refresh',
    'sanitize_callback' => 'esc_url_raw', // Sanitize the input as a URL
));

$wp_customize->add_control('footer_button_link', array(
    'label'       => __('Footer Button Link', 'gp-winterthur'),
    'description' => __('Set the URL for the newsletter button.', 'gp-winterthur'),
    'section'     => 'footer_section',
    'type'        => 'url',
));	

    // Add footer gradient color settings (for 6 stops in total)
    $wp_customize->add_setting('footer_color_1', array(
        'default'     => '#004B50',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_color_1', array(
        'label'   => __('Footer Gradient Color 1', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    $wp_customize->add_setting('footer_color_2', array(
        'default'     => '#185A68',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_color_2', array(
        'label'   => __('Footer Gradient Color 2', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    $wp_customize->add_setting('footer_color_3', array(
        'default'     => '#31697F',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_color_3', array(
        'label'   => __('Footer Gradient Color 3', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    $wp_customize->add_setting('footer_color_4', array(
        'default'     => '#698CB6',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_color_4', array(
        'label'   => __('Footer Gradient Color 4', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    // Add additional color stops for the footer gradient
    $wp_customize->add_setting('footer_color_5', array(
        'default'     => '#889FD4',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_color_5', array(
        'label'   => __('Footer Gradient Color 5', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    $wp_customize->add_setting('footer_color_6', array(
        'default'     => '#A6B1F1',
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_color_6', array(
        'label'   => __('Footer Gradient Color 6', 'gp-winterthur'),
        'section' => 'footer_section',
    )));
	
	
	  // Footer Heading Color
    $wp_customize->add_setting('footer_heading_color', array(
        'default'     => '#D3FFB4',  // Default heading color
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_heading_color', array(
        'label'   => __('Footer Heading Color', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    // Footer Link Color
    $wp_customize->add_setting('footer_link_color', array(
        'default'     => '#004B50',  // Default link color
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_link_color', array(
        'label'   => __('Footer Link Color', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    // Footer Link Hover Color
    $wp_customize->add_setting('footer_link_hover_color', array(
        'default'     => '#D3FFB4',  // Default link hover color
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_link_hover_color', array(
        'label'   => __('Footer Link Hover Color', 'gp-winterthur'),
        'section' => 'footer_section',
    )));

    // Footer Summary Text Color
    $wp_customize->add_setting('footer_summary_text_color', array(
        'default'     => '#004B50',  // Default color for summary text
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_summary_text_color', array(
        'label'   => __('Footer Summary Text Color', 'gp-winterthur'),
        'section' => 'footer_section',
    )));
	
	
}
add_action('customize_register', 'gp_winterthur_customize_register');


function gp_winterthur_customizer_css() {
    ?>
    <style type="text/css">
		
/* MAIN NAVIGATION */		
.main-navigation .main-nav ul li a {
    background-color: <?php echo get_theme_mod('menu_link_bg_color', '#004B50'); ?>;
    color: <?php echo get_theme_mod('menu_link_text_color', '#D3FFB4'); ?> !important;
}
		
.main-navigation .main-nav ul li a:hover, .main-navigation .main-nav ul ul li a:hover {
    background-color: <?php echo get_theme_mod('menu_link_hover_bg_color', '#A6B1F1'); ?> !important;
    color: <?php echo get_theme_mod('menu_link_hover_text_color', '#004B50'); ?> !important;
}

		
        /* Footer Gradient Styles */
         body .footer-color-transition {
            background: linear-gradient(180deg,
                <?php echo get_theme_mod('footer_color_1', '#004B50'); ?> 25%,
                <?php echo get_theme_mod('footer_color_2', '#185A68'); ?> 33%,
                <?php echo get_theme_mod('footer_color_3', '#31697F'); ?> 38%,
                <?php echo get_theme_mod('footer_color_4', '#698CB6'); ?> 47%,
                <?php echo get_theme_mod('footer_color_5', '#889FD4'); ?> 55%,
                <?php echo get_theme_mod('footer_color_6', '#A6B1F1'); ?> 69%,
                <?php echo get_theme_mod('footer_color_6', '#A6B1F1'); ?> 100%);
            padding: 80px 50px 0 50px;
        }
		
	/* Header Gradient Hover */
	header.submenu-open::after {
    background: linear-gradient(
        to top,
        <?php echo get_theme_mod('header_color_6', 'transparent'); ?> 0%,
        <?php echo get_theme_mod('header_color_1', 'rgba(211, 255, 180, 0.15)'); ?> 15%,
        <?php echo get_theme_mod('header_color_2', 'rgba(211, 255, 180, 0.3)'); ?> 30%,
        <?php echo get_theme_mod('header_color_3', 'rgba(211, 255, 180, 0.5)'); ?> 50%,
        <?php echo get_theme_mod('header_color_4', 'rgba(211, 255, 180, 0.7)'); ?> 70%,
        <?php echo get_theme_mod('header_color_5', '#D3FFB4'); ?> 100%
    );
}

        /* Footer Heading Color */
        body .footer-box h1 {
            color: <?php echo get_theme_mod('footer_heading_color', '#D3FFB4'); ?>;
        }

        /* Footer Link Color */
        body .footer-color-transition a {
            color: <?php echo get_theme_mod('footer_link_color', '#004B50'); ?>;
            text-decoration: none;
        }

        /* Footer Link Hover Color */
        body .footer-color-transition a:hover,
        body .footer-color-transition a:active {
            color: <?php echo get_theme_mod('footer_link_hover_color', '#D3FFB4'); ?>;
        }

        /* Footer Summary Text Color */
        body .footer-widgets summary {
            color: <?php echo get_theme_mod('footer_summary_text_color', '#004B50'); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'gp_winterthur_customizer_css');

/* REMOVE MENU SCRIPT*/
function dequeue_generatepress_menu_script() {
    wp_dequeue_script('generate-menu'); // Remove the script
    wp_deregister_script('generate-menu'); // Deregister the script
}
add_action('wp_enqueue_scripts', 'dequeue_generatepress_menu_script', 100);

/* NEW MENU SCRIPT */
function enqueue_child_theme_scripts_in_header() {
    wp_enqueue_script(
        'child-theme-custom-scripts', // Handle for the script
        get_stylesheet_directory_uri() . '/js/scroll-menu.js', // Path to the JS file
        array('jquery'), // Dependencies (if any)
        '1.0.0', // Version of the script
        false // Load in header (set to false to load in header instead of footer)
    );
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_scripts_in_header', 30); // Priority set to 30

/* POLYLANG STRINGS */
function gp_winterthur_register_strings() {
    if (function_exists('pll_register_string')) {
        // Register "Unsere Sponsoren" for translation
        pll_register_string('Footer Sponsors Heading', 'Unsere Sponsoren', 'Footer');
		
		 // Register "Newsletter Anmeldung" for translation
        pll_register_string(
            'Footer Button Text', // Unique identifier
            get_theme_mod('footer_button_text', __('Newsletter Anmeldung', 'gp-winterthur')), // Default value
            'Footer' // Group name
        );
		
    }
}
add_action('init', 'gp_winterthur_register_strings');

/* FOOTER WIDGETS */
function gp_winterthur_register_widget_areas() {
    register_sidebar(array(
        'name'          => __('Footer Left Column', 'gp-winterthur'),
        'id'            => 'footer-left-column',
        'description'   => __('Add widgets here for the footer left column.', 'gp-winterthur'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'gp_winterthur_register_widget_areas');

function gp_winterthur_register_footer_menus() {
    register_nav_menus(array(
        'footer-menu-left'  => __('Footer Center Left Menu', 'gp-winterthur'),
        'footer-menu-right' => __('Footer Center Right Menu', 'gp-winterthur'),
    ));
}
add_action('init', 'gp_winterthur_register_footer_menus');

// Register Custom Walker Class
class Footer_Menu_Walker2 extends Walker_Nav_Menu {
    // Start the unordered list
    public function start_lvl(&$output, $depth = 0, $args = null) {
        // No nested levels, so do nothing
    }

    // End the unordered list
    public function end_lvl(&$output, $depth = 0, $args = null) {
        // No nested levels, so do nothing
    }

    // Start the list item
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Check if this is the last item in the menu
        $is_last_item = (next($args->menu) === false);

        // Output the <a> tag with classes and attributes
        $output .= sprintf(
            '<a href="%s" class="bold-link">%s</a>',
            esc_url($item->url),
            esc_html($item->title)
        );

        // Add <br> after each item except the last one
        if (!$is_last_item) {
            $output .= '<br>';
        }
    }

    // End the list item
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing </li> needed
    }
}

function enqueue_editor_styles() {
    // Enqueue the CSS file for Gutenberg editor in the child theme
    wp_enqueue_style('custom-editor-style', get_stylesheet_directory_uri() . '/css/editor-style.css', array(), '1.0', 'all');
}
add_action('enqueue_block_editor_assets', 'enqueue_editor_styles');

/* PATTERNS IMPORT */
/* IMPORT CUSTOM GUTENBERG BLOCK PATTERNS */
function load_custom_patterns_from_json() {
    // Define the path to the patterns folder in the child theme
    $patterns_dir = get_stylesheet_directory() . '/patterns/';

    // Check if the directory exists
    if ( is_dir( $patterns_dir ) ) {
        // Get all JSON files in the patterns folder
        $pattern_files = glob( $patterns_dir . '*.json' );

        foreach ( $pattern_files as $file ) {
            // Get the pattern name from the file name (without extension)
            $pattern_name = basename( $file, '.json' );

            // Load and decode the JSON content
            $pattern_content = file_get_contents( $file );
            $pattern_data = json_decode( $pattern_content, true );

            // Check if JSON decoding was successful and the required 'content' key exists
            if ( is_array( $pattern_data ) && !empty( $pattern_data['content'] ) ) {
                // Register the pattern with Gutenberg
                register_block_pattern(
                    'childtheme/' . $pattern_name, // Unique pattern name
                    array(
                        'title'       => isset( $pattern_data['title'] ) ? $pattern_data['title'] : ucfirst( str_replace( '-', ' ', $pattern_name ) ),
                        'content'     => $pattern_data['content'],
                        'categories'  => isset( $pattern_data['categories'] ) ? $pattern_data['categories'] : array( 'custom' ),
                        'description' => isset( $pattern_data['description'] ) ? $pattern_data['description'] : '',
                        'keywords'    => isset( $pattern_data['keywords'] ) ? $pattern_data['keywords'] : array(),
                    )
                );
            } else {
                // Log an error or output a message if decoding fails or 'content' is missing
                error_log( "Failed to load pattern from $file. Check JSON structure." );
            }
        }
    } else {
        // Log a warning if the patterns directory is missing
        error_log( "Patterns directory ($patterns_dir) does not exist." );
    }
}
add_action( 'init', 'load_custom_patterns_from_json' );