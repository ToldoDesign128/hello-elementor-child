<?php
function HT_setup_theme() {
	add_theme_support("title-tag");
	add_theme_support( 'automatic-feed-links' );
	//aggiunta di una posizione del menu
	// register_nav_menu("header", "Navbar Header");
	// Add widgets support
	add_theme_support( 'widgets' );
}
add_action("after_setup_theme", "HT_setup_theme");

add_action('admin_init', 'HT_remove_content_editor');
function HT_remove_content_editor() {
		remove_post_type_support('page', 'editor' ); //remove gutenberg
		remove_post_type_support('post', 'editor' ); //remove gutenberg
		remove_post_type_support('page', 'thumbnail' ); //remove thumbnail
}

//add CSS
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.min.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
	// My JS
	wp_enqueue_script( 'howto-script', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

// Change footer in admin panel
function remove_footer_admin () {
   echo '<p>Website by Officina FBK</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function change_footer_version() {return ' ';}
add_filter( 'update_footer', 'change_footer_version', 9999);

//ADD Automatically check alla parent category when selecting a child one
add_action('save_post', 'assign_parent_terms_targhe_cpt', 10, 2); //CPT documenti
function assign_parent_terms_targhe_cpt($post_id, $post){
   if($post->post_type != 'documenti')
   return $post_id;
   $terms = wp_get_post_terms($post_id, 'documenti_tax' );
   foreach($terms as $term){
      while($term->parent != 0 && !has_term( $term->parent, 'documenti_tax', $post )){
         wp_set_post_terms($post_id, array($term->parent), 'documenti_tax', true);
         $term = get_term($term->parent, 'documenti_tax');
      }
   }
}


// Remove comments
add_action('admin_init', function () {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
			wp_redirect(admin_url());
			exit;
	}
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	foreach (get_post_types() as $post_type) {
			if (post_type_supports($post_type, 'comments')) {
					remove_post_type_support($post_type, 'comments');
					remove_post_type_support($post_type, 'trackbacks');
			}
	}
});
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
});
add_action('init', function () {
	if (is_admin_bar_showing()) {
			remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
});

//Remove emoji
function HT_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'HT_disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
		return array();
		}
}
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
				$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
				$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}
		return $urls;
}



//Remove items from admin bar
function HT_remove_admin_bar_links() {
	global $wp_admin_bar;
	// $wp_admin_bar->remove_node('wp-logo');
	// $wp_admin_bar->remove_node('view-site');
	// $wp_admin_bar->remove_node('site-name');
	$wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('new-content');
	$wp_admin_bar->remove_node('about');
	$wp_admin_bar->remove_node('wporg');
	$wp_admin_bar->remove_node('documentation');
	$wp_admin_bar->remove_node('support-forums');
	$wp_admin_bar->remove_node('feedback');
	$wp_admin_bar->remove_node('updates');
	$wp_admin_bar->remove_node('search');
	$wp_admin_bar->remove_node('customize');
}
add_action( 'wp_before_admin_bar_render', 'HT_remove_admin_bar_links' );

//Remove items from menu
function HT_remove_menus(){
	remove_menu_page( 'edit.php' ); // Posts
	remove_menu_page( 'edit-comments.php' ); //Comments

	//Customize from Appearance
	$customizer_url = add_query_arg( 'return', urlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ), 'customize.php' );
	remove_submenu_page( 'themes.php', $customizer_url );
}
add_action( 'admin_menu', 'HT_remove_menus' );
//Remove theme file editor and plugin file editor
function HT_remove_menus_editors() {
	define( 'DISALLOW_FILE_EDIT', true );
}
add_action('init','HT_remove_menus_editors');

// Remove field descriptions from categories
function NP_hide_cat_descr() {
   ?>
   <style type="text/css">
   .term-description-wrap {
       display: none;
   }
   </style>
   <?php
} 
add_action( 'admin_head-term.php', 'NP_hide_cat_descr' );
add_action( 'admin_head-edit-tags.php', 'NP_hide_cat_descr' );




/*FUNCTION PARTS
-------------------------------------------------*/

//Footer Widget
require dirname(__FILE__).'/assets/function-parts/theme/footer-functions-widget.php';

//CPT
require dirname(__FILE__).'/assets/function-parts/cpt-contatti.php';
require dirname(__FILE__).'/assets/function-parts/cpt-comunicazioni.php';
require dirname(__FILE__).'/assets/function-parts/cpt-documenti.php';

// Custom Elementor
require dirname(__FILE__).'/assets/function-parts/custom-elementor/custom-elementor.php';


?>