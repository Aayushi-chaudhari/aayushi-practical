<?php
/**
 * aayushi-practical functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aayushi-practical
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aayushi_practical_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on aayushi-practical, use a find and replace
		* to change 'aayushi-practical' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'aayushi-practical', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'aayushi-practical' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'aayushi_practical_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'aayushi_practical_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aayushi_practical_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aayushi_practical_content_width', 640 );
}
add_action( 'after_setup_theme', 'aayushi_practical_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aayushi_practical_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'aayushi-practical' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'aayushi-practical' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'aayushi_practical_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aayushi_practical_scripts() {
	wp_enqueue_style( 'aayushi-practical-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'aayushi-practical-style', 'rtl', 'replace' );

	wp_enqueue_script( 'aayushi-practical-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aayushi_practical_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function display_featured_products_before_shop_loop() {
    // Get featured products
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 3,
        'meta_query'     => array(
            array(
                'key'   => '_featured',
                'value' => 'yes',
            ),
        ),
    );
    $featured_products = new WP_Query( $args );

    // Display featured products
    if ( $featured_products->have_posts() ) {
        echo '<div class="featured-products">';
        while ( $featured_products->have_posts() ) {
            $featured_products->the_post();
            wc_get_template_part( 'content', 'product' );
        }
        echo '</div>';
    }

    // Reset post data
    wp_reset_postdata();
}
add_action( 'woocommerce_before_shop_loop', 'display_featured_products_before_shop_loop', 5 );


function aayushi_styles() {
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() .'/assets/css/style.css', array(), '1.0', 'all' );


}
add_action( 'wp_enqueue_scripts', 'aayushi_styles' );

// In your theme's functions.php

function enqueue_custom_scripts() {
    wp_enqueue_script( 'custom-ajax', get_template_directory_uri() . '/assets/js/custom-ajax.js', array('jquery'), null, true );
    wp_localize_script( 'custom-ajax', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );


function filter_products() {
    $filter = $_POST['filter'];
    
    if ($filter == 'popular') {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        );
    } elseif ($filter == 'featured') {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                ),
            ),
        );
    } elseif ($filter == 'categories') {
        $product_categories = get_terms( 'product_cat', array(
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => true,
        ) );

        if ( !empty( $product_categories ) && !is_wp_error( $product_categories ) ) :
            echo '<div class="product-categories">';
            echo '<h2>Product Categories</h2>';
            echo '<ul>';
            foreach ( $product_categories as $category ) {
                echo '<li>' . esc_html( $category->name ) . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        else :
            echo '<p>No categories found</p>';
        endif;
        wp_die();
    } else {
        // Default: all products sorted by popularity and price high to low
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'meta_key' => 'total_sales',
            'orderby' => array(
                'meta_value_num' => 'DESC',
                '_price' => 'DESC',
            ),
            'meta_query' => array(
                'relation' => 'AND',
                'total_sales_clause' => array(
                    'key' => 'total_sales',
                    'compare' => 'EXISTS',
                ),
                'price_clause' => array(
                    'key' => '_price',
                    'compare' => 'EXISTS',
                ),
            ),
        );
    }

    $products = new WP_Query( $args );

    if ( $products->have_posts() ) :
        echo '<div class="all-products">';
        echo '<h2>Products</h2>';
        while ( $products->have_posts() ) : $products->the_post();
            wc_get_template_part( 'content', 'product' );
        endwhile;
        echo '</div>';
    else :
        echo '<p>No products found</p>';
    endif;

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');


function redirect_to_checkout() {
    if (is_product()) {
        wp_enqueue_script('redirect-to-checkout', get_template_directory_uri() . '/js/redirect-to-checkout.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'redirect_to_checkout');

function custom_add_to_cart_redirect() {
    return wc_get_checkout_url();
}
add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect');
