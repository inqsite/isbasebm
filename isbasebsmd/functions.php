<?php
/**
 * isbase functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package isbase
 */

if ( ! function_exists( 'isbase_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function isbase_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on isbase, use a find and replace
	 * to change 'isbase' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'isbase', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'isbase' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'isbase_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'isbase_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function isbase_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'isbase_content_width', 640 );
}
add_action( 'after_setup_theme', 'isbase_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function isbase_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'isbase' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'isbase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'isbase_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function isbase_scripts() {
    wp_enqueue_style(  'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' );
    wp_enqueue_style(  'material', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material.css',array('bootstrap') );
    wp_enqueue_style(  'ripples', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/ripples.css',array('bootstrap','material') );
    wp_enqueue_style(  'awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css' );
	wp_enqueue_style( 'isbase-style', get_stylesheet_uri(),array('bootstrap','material','ripples') );

// WordPress本体のjquery.jsを読み込まない
wp_deregister_script('jquery');
// jQueryの読み込み
wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', "", "20160608", false );
    wp_enqueue_script( 'flexibility', get_template_directory_uri() . '/js/flexibility.js', "", '20151215', false );

	wp_enqueue_script( 'isbase-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'isbase-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
  wp_enqueue_script( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', "", "20160608", false );
  wp_enqueue_script( 'material', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.js', "", "20160608", false );
  wp_enqueue_script( 'ripples', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.js', "", "20160608", false );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    if ( ! is_admin() ) {
        wp_enqueue_script(
            'html5shiv-script',
            'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js',
            array(),
            '3.7.3'
        );

        wp_script_add_data(
            'html5shiv-script',
            'conditional',
            'lt IE 9'
        );
    }
    if ( ! is_admin() ) {
        wp_enqueue_script(
            'respond-script',
            'https://oss.maxcdn.com/respond/1.4.2/respond.min.js',
            array(),
            '3.7.3'
        );

        wp_script_add_data(
            'respond-script',
            'conditional',
            'lt IE 9'
        );
    }

}
//カテゴリタイトルの変更
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_post_type_archive() ){
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ){
            $title = single_term_title( '', false );
        }
    return $title;
});
add_action( 'wp_enqueue_scripts', 'isbase_scripts' );
//ページネーション
function bootstrap_pagination(){
  global $wp_query;
  $paged = $wp_query->get( 'paged' );
  $posts_per_page = get_option('posts_per_page');
  if ( ( ! $paged || $paged < 2 ) && $wp_query->found_posts < $posts_per_page )
      return;

  $range = 2;//表示件数の指定
  $showitems = ($range * 2)+1;

  global $paged;
  if(empty($paged)) $paged = 1;

  if($pages == ''){
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
      $pages = 1;
    }
  }

  if(1 != $pages){
    echo '<ul class="pagination">';
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
    if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

    for ($i=1; $i <= $pages; $i++){
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
        echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
      }
    }

    if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
    if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
    echo "</ul>\n";
  }
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/wp-bootstrap-navwalker.php';

/*最初の画像取得*/
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
        $first_img = "http://www.inqsite.net/weblog/wp-content/themes/isbasebsmd/images/no_image.png";
    }
    return $first_img;
}
/* excerpt 続きを読む */
function new_excerpt_more($post) {
     return '<a href="'. get_permalink($post->ID) . '">' . '...続きを読む' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* ogp.php設定を変更すること　*/
require get_template_directory() . '/inc/ogp.php';
