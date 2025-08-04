<?php
/**
 * Typography Theme functions and definitions
 */

if (!defined('TYPOGRAPHY_THEME_VERSION')) {
    define('TYPOGRAPHY_THEME_VERSION', '1.0.0');
}

/**
 * Theme setup
 */
function typography_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'typography-theme'),
        'footer'  => esc_html__('Footer Menu', 'typography-theme'),
    ));

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Set up the WordPress core custom background feature
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for wide alignment
    add_theme_support('align-wide');

    // Add editor styles
    add_theme_support('editor-styles');
    add_editor_style('dist/css/editor-style.css');
}
add_action('after_setup_theme', 'typography_theme_setup');

/**
 * Set the content width
 */
function typography_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters('typography_theme_content_width', 896);
}
add_action('after_setup_theme', 'typography_theme_content_width', 0);

/**
 * Register widget area
 */
function typography_theme_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'typography-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'typography-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s prose prose-lg max-w-none mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-2xl font-serif mb-4">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'typography-theme'),
        'id'            => 'footer-widget-area',
        'description'   => esc_html__('Add widgets here for the footer.', 'typography-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s prose prose-lg max-w-none">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-xl font-semibold mb-4">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'typography_theme_widgets_init');

/**
 * Enqueue scripts and styles
 */
function typography_theme_scripts() {
    // Enqueue Tailwind CSS (compiled)
    wp_enqueue_style('typography-theme-tailwind', get_template_directory_uri() . '/dist/css/style.css', array(), TYPOGRAPHY_THEME_VERSION);
    
    // Enqueue theme stylesheet
    wp_enqueue_style('typography-theme-style', get_stylesheet_uri(), array('typography-theme-tailwind'), TYPOGRAPHY_THEME_VERSION);

    // Enqueue Google Fonts
    wp_enqueue_style('typography-theme-fonts', 'https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Enqueue navigation script
    wp_enqueue_script('typography-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), TYPOGRAPHY_THEME_VERSION, true);

    // Enqueue smooth scroll script
    wp_enqueue_script('typography-theme-smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array(), TYPOGRAPHY_THEME_VERSION, true);

    // Enqueue theme switcher script
    wp_enqueue_script('typography-theme-switcher', get_template_directory_uri() . '/js/theme-switcher.js', array(), TYPOGRAPHY_THEME_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'typography_theme_scripts');

/**
 * Custom excerpt length
 */
function typography_theme_excerpt_length($length) {
    return 40;
}
add_filter('excerpt_length', 'typography_theme_excerpt_length');

/**
 * Custom excerpt more
 */
function typography_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'typography_theme_excerpt_more');

/**
 * Add custom classes to navigation menu items
 */
function typography_theme_nav_menu_css_class($classes, $item, $args) {
    if ($args->theme_location == 'primary' || $args->theme_location == 'footer') {
        $classes[] = 'menu-item-typography';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'typography_theme_nav_menu_css_class', 10, 3);

/**
 * Customize the Tailwind prose class for the content
 */
function typography_theme_content_class($content) {
    if (is_singular() && !is_page()) {
        return '<div class="entry-content prose prose-xl lg:prose-2xl max-w-none prose-headings:font-serif prose-a:text-gray-900 prose-a:no-underline hover:prose-a:text-gray-600">' . $content . '</div>';
    }
    return $content;
}
add_filter('the_content', 'typography_theme_content_class');

/**
 * Add Google Fonts preconnect for performance
 */
function typography_theme_resource_hints($hints, $relation_type) {
    if ('preconnect' === $relation_type) {
        $hints[] = 'https://fonts.googleapis.com';
        $hints[] = 'https://fonts.gstatic.com';
    }
    return $hints;
}
add_filter('wp_resource_hints', 'typography_theme_resource_hints', 10, 2);