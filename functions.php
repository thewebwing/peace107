<?php
/**
 * Peace 107 functions and definitions
 *
 * @package Peace 107
 * @since Peace 107 1.0
 */

/**
 * BuddyPress Functions
 */

$current_plugins = get_option('active_plugins');
if (in_array('developers-custom-fields/slt-custom-fields.php', $current_plugins) && is_admin()) {



    include('cpt-admin-functions.php');
}
 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Peace 107 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'peace107_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Peace 107 1.0
 */
function peace107_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Peace 107, use a find and replace
	 * to change 'peace107' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'peace107', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'peace107' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // peace107_setup
add_action( 'after_setup_theme', 'peace107_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Peace 107 1.0
 */
function peace107_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Primary' ),
        'id' => 'primary-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
    register_sidebar( array(
        'name' => __( 'Secondary' ),
        'id' => 'secondary-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'peace107_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function peace107_scripts() {
	global $post;
    
    wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/libs/foundation3/stylesheets/foundation.css', array(), '1.2.3' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	//wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
    //wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '201200917', true );
    //wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '201200917', true );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '201200917', true );
    wp_enqueue_script( 'helper', get_template_directory_uri() . '/js/helper.js', array( 'jquery' ), '201200917', true );
    wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '201200917', true );
    wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/libs/foundation3/javascripts/modernizr.foundation.js', array('jquery') );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
    if ( is_home() || is_front_page() ) {

        wp_enqueue_script( 'orbit', get_stylesheet_directory_uri() . '/libs/foundation3/javascripts/jquery.orbit-1.4.0.js', array('jquery', 'modernizr') );
        
        wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), false, true);
    }
}
add_action( 'wp_enqueue_scripts', 'peace107_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

function add_featured_slider(){
    if(is_home() && !is_paged()) { ?>
        <!-- featured -->
        <div id="featured">
            <?php
            $idObj = get_category_by_slug('featured'); 
            $catID = $idObj->term_id;
            $args = array('category' => $catID);
            $featured_posts = get_posts($args);
            $c = 0;
            foreach( $featured_posts as $post ) {
                if ( has_post_thumbnail($post->ID)) {
                    echo get_the_post_thumbnail($post->ID);
                }
                $featureTitle[$c]['title'] = $post->post_title;
                $featureTitle[$c]['slug'] = $post->post_name;
                $c++;
            } ?>
            <!-- Captions for Orbit -->
            <?php foreach ($featureTitle as $title) { ?>
                <span class="orbit-caption" id="<?php echo $title['slug']; ?>"><?php echo $title['title']; ?></span>
            <?php } ?>
        </div><!-- /featured -->
    <?php } else {
    
    }
}

function my_post_image_html( $html, $post_id, $post_image_id ) {
    if (in_category('featured')) {
        $custom = get_post_custom($post_id);
        $html = '<a href="' . $custom['link-post-to-page'][0] . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" data-caption="#'.esc_attr( get_post_field( 'post_name', $post_id ) ).'">' . $html . '</a>';
    } else {
        $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" data-caption="#'.esc_attr( get_post_field( 'post_name', $post_id ) ).'">' . $html . '</a>';
    }
    return $html;
}
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function phantom_image_spacer() {
    echo '<img style="height:0" height="" width="1000" src="'.get_stylesheet_directory_uri().'/style/images/phantom.gif">';
}

add_action( 'admin_head', 'my_website_admin_head' );
function my_website_admin_head() {
    wp_dequeue_script( 'custom-post-type-onomies-admin-options-validate' );
}
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Morning_Verse extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_morning_verse_entries', 'description' => __( "Display's latest post in the category \"Morning Verse\"") );
		parent::__construct('morning-verse', __('Morning Verse'), $widget_ops);
		$this->alt_option_name = 'widget_morning_verse_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_morning_verse', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Morning Verse') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
			<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php endif; ?>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_morning_verse', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = (bool) $new_instance['show_date'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_morning_verse_entries']) )
			delete_option('widget_morning_verse_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_morning_verse', 'widget');
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
}