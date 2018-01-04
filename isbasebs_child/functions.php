<?php //子テーマで利用する関数を書く
 
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css',array('bootstrap') );
}
//表示順と件数を変更
add_action('pre_get_posts','my_pre_get_posts');
function my_pre_get_posts( $query ) {
   if ($query -> is_post_type_archive('school')) {
    $query -> set('posts_per_page', 100); 
    $query -> set('order', 'ASC'); 
    $query -> set('orderby', 'meta_value'); 
    $query -> set('meta_key', 'city_id');
  }
     if ($query -> is_tax( 'prefecture' ) ) {
    $query -> set('posts_per_page', -1); 
    $query -> set('order', 'ASC'); 
    $query -> set('orderby', 'meta_value'); 
    $query -> set('meta_key', 'city_id');
  }
}