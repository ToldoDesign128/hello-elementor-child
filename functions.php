<?php
function HT_setup_theme() {
	add_theme_support("title-tag");
	add_theme_support( 'automatic-feed-links' );

	// Add widgets support
	add_theme_support( 'widgets' );
   remove_theme_support( 'widgets-block-editor' ); //but without gutenberg
}
add_action("after_setup_theme", "HT_setup_theme");


// ADD Menus locations
if(!function_exists('register_custom_menu')):
   function register_custom_menu() {
      register_nav_menu("header", __("Menù di navigazione"));
      register_nav_menu("footer", __("Footer Sitemap"));
   }
   add_action( 'init', 'register_custom_menu' );
endif;
// Get menu items by slug --------
function NP_get_menu_by_slug( $menu_slug, $multilevel = true ) {
   $menu_items = array();
   if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$menu_slug] ) && $locations[$menu_slug] != 0 ) {
      $menu = wp_get_nav_menu_object( $locations[ $menu_slug ] );
      $menu_items = wp_get_nav_menu_items( $menu->term_id ); // without WPML
      if( $multilevel && is_array( $menu_items ) && !empty( $menu_items ) ) {
         $multilevel_menu = array();
         // echo 'multilevel';
         foreach( $menu_items as $item ) {
            if( $item->menu_item_parent == 0 ){
               $multilevel_menu[$item->ID] = $item;
            } else {
               $multilevel_menu[$item->menu_item_parent] = (array)$multilevel_menu[$item->menu_item_parent];
               $multilevel_menu[$item->menu_item_parent]['item_children'][$item->ID] = $item;
               $multilevel_menu[$item->menu_item_parent] = (object)$multilevel_menu[$item->menu_item_parent];
            }
         }
         return $multilevel_menu;
      }
   }
   return $menu_items;
}


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
   wp_enqueue_style( 'hamburgers-style', get_stylesheet_directory_uri() . '/hamburgers.min.css');
	// My JS
	wp_enqueue_script( 'howto-script', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), false, true );
   if (is_singular('documenti')) : wp_enqueue_script( 'howto-doc-script', get_stylesheet_directory_uri() . '/assets/js/single-doc.js', array('jquery'), false, true ); endif;
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


//ADD svg support
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
   global $wp_version;
   if ( $wp_version !== '4.7.1' ) {
      return $data;
   }
   $filetype = wp_check_filetype( $filename, $mimes );
   return [
       'ext'             => $filetype['ext'],
       'type'            => $filetype['type'],
       'proper_filename' => $data['proper_filename']
   ];
 }, 10, 4 );
 function cc_mime_types( $mimes ){
   $mimes['svg'] = 'image/svg+xml';
   return $mimes;
 }
 add_filter( 'upload_mimes', 'cc_mime_types' );
 function fix_svg() {
   echo '<style type="text/css">
         .attachment-266x266, .thumbnail img {
              width: 100% !important;
              height: auto !important;
         }
         </style>';
 }
 add_action( 'admin_head', 'fix_svg' );


//ADD custom admin column for Comunicazioni Categorie
add_filter('manage_comunicazioni_posts_columns', 'filter_comunicazioni_custom_columns'); //add custom col
function filter_comunicazioni_custom_columns($columns) {
   $columns['comunicazioni_tax'] = 'Categoria';
   return $columns;
}
add_action('manage_comunicazioni_posts_custom_column',  'action_comunicazioni_custom_columns'); //add ACF data to custom col rows
function action_comunicazioni_custom_columns($column) {
   global $post;
   if($column == 'comunicazioni_tax') {
      $IDfield = get_fields($post->ID);
      if ( $IDfield && is_array($IDfield) ) :
         $Namefield = get_term($IDfield['cpt_comunicazioni_taxonomy']);
         if ( !is_wp_error($Namefield) ) : echo $Namefield->name; else: echo '—'; endif;
      else: 
         echo '—';
      endif;
   }
}

//ADD custom admin column for Documenti in Evidenza
add_filter('manage_documenti_posts_columns', 'filter_documenti_custom_columns'); //add custom col
function filter_documenti_custom_columns($columns) {
   $columns['documenti_tax'] = ' ';
   return $columns;
}
add_action('manage_documenti_posts_custom_column',  'action_documenti_custom_columns'); //add ACF data to custom col rows
function action_documenti_custom_columns($column) {
   global $post;
   if($column == 'documenti_tax') {
      $IDfield = get_fields($post->ID);
      if ( $IDfield && is_array($IDfield) ) :
         $Stickyfield = $IDfield['cpt_in_evidenza'];
         if ($Stickyfield) : echo "In evidenza"; endif;
      endif;
   }
}

/*ADD ACF Option Page*/
if( function_exists('acf_add_options_page') ) {
   acf_add_options_page(array(
      'page_title' 	=> 'Social',
      'menu_title'	=> 'Social',
      'menu_slug' 	=> 'social-settings',
      'capability'	=> 'edit_posts',
      'icon_url'      => 'dashicons-twitter',
      'redirect'		=> true
   ));
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

//CSS Soft Remove items from menu
function HT_css_soft_remove_menu() {
   echo '<style type="text/css">

      /*hide Elementor Template*/
      .wp-admin #adminmenuwrap #menu-posts-elementor_library{display:none !important;}
      /*hide ACF*/
      .wp-admin #adminmenuwrap #toplevel_page_edit-post_type-acf-field-group{display:none !important;}
      /*hide Tools*/
      .wp-admin #adminmenuwrap #menu-tools{display:none !important;}
      /*hide Widget*/
      .wp-admin #adminmenuwrap #menu-appearance li a[href="widgets.php"]{display:none !important;}
      /*hide WPML*/
      // .wp-admin #adminmenuwrap #toplevel_page_tm-menu-main{display:none !important;}
      /*Theme e plugin editor on WP engine*/
      .wp-admin #adminmenuwrap #menu-appearance li a[href="theme-editor.php"]{display:none !important;}
      .wp-admin #adminmenuwrap #menu-plugins li a[href="plugin-editor.php"]{display:none !important;}

   </style>';
}
add_action('wp_before_admin_bar_render', 'HT_css_soft_remove_menu');

/*Remove category parent and description
--------------------------------------*/
function NP_css_custom_categories() {
   echo '<style type="text/css"> 
      .wp-admin.post-type-comunicazioni .form-field.term-parent-wrap {display:none !important;} 
      .wp-admin .form-field.term-description-wrap {display:none !important;} 
   </style>';
}
add_action('wp_before_admin_bar_render', 'NP_css_custom_categories');

/*Remove Personalizzate from Theme page
--------------------------------------*/
function NP_css_custom_themes() {
   echo '<style type="text/css"> 
      .wp-admin.themes-php #wpbody .hide-if-no-customize{display:none !important;} 
   </style>';
}
add_action('wp_before_admin_bar_render', 'NP_css_custom_themes');



/* Aspetto > Menu:
/* Remove menu meta-box links under 'Aggiungi voci del menu'
--------------------------------------*/
function HT_custom_remove() {
   global $wp_meta_boxes, $nav_menu_selected_id, $menu_locations;
   foreach ($wp_meta_boxes['nav-menus']['side'] as $nav_menus) {
      // var_dump(wp_list_pluck($nav_menus,'id')); //display a list of all link type IDs
      foreach ($nav_menus as $nav_id => $nav_menu) {
         if ($nav_id == 'add-post-type-e-landing-page' || $nav_id == 'add-post-type-contatti' || $nav_id == 'add-post-type-post' || $nav_id == 'add-post_tag' || $nav_id == 'add-category' || $nav_id == 'add-comunicazioni_tax' || $nav_id == 'add-documenti_tax') {
            remove_meta_box($nav_id, 'nav-menus', 'side');
         }
      }   
   }
}
add_action('admin_head-nav-menus.php', __NAMESPACE__.'\\HT_custom_remove', 10);
/* Aspetto > Menu:
/* Mark menu items with depth level > 3
--------------------------------------*/
function HT_css_mark_menu_item() {
   echo '<style type="text/css">
      .wp-admin.nav-menus-php ul#menu-to-edit li.menu-item-depth-3 .menu-item-handle, .wp-admin.nav-menus-php ul#menu-to-edit li.menu-item-depth-4 .menu-item-handle, .wp-admin.nav-menus-php ul#menu-to-edit li.menu-item-depth-5 .menu-item-handle, .wp-admin.nav-menus-php ul#menu-to-edit li.menu-item-depth-6 .menu-item-handle, .wp-admin.nav-menus-php ul#menu-to-edit li.menu-item-depth-7 .menu-item-handle, .wp-admin.nav-menus-php ul#menu-to-edit li.menu-item-depth-8 .menu-item-handle{background-color:#ff000080!important;border-color:red!important;color:red!important;}
   </style>';
}
add_action('wp_before_admin_bar_render', 'HT_css_mark_menu_item');
/* Pagine:
/* Mark pages with depth level > 2
--------------------------------------*/
function HT_css_mark_pages() {
   echo '<style type="text/css">
      .wp-admin.post-type-page #wpbody table.pages tr.type-page.level-2, .wp-admin.post-type-page #wpbody table.pages tr.type-page.level-3, .wp-admin.post-type-page #wpbody table.pages tr.type-page.level-4, .wp-admin.post-type-page #wpbody table.pages tr.type-page.level-5, .wp-admin.post-type-page #wpbody table.pages tr.type-page.level-6 {background-color:#ff000080!important;}
   </style>';
}
add_action('wp_before_admin_bar_render', 'HT_css_mark_pages');


// Increase default post per page looped posts
function NP_change_wp_search_size($query) { //search.php
   if ( $query->is_search )
      $query->query_vars['posts_per_page'] = -1;
   return $query;
}
add_filter('pre_get_posts', 'NP_change_wp_search_size');
function NP_change_wp_archive_size( $query ) { //archive.php
   if ( !is_admin() && $query->is_main_query() && is_archive() )
       $query->query_vars['posts_per_page'] = -1;
   return $query;
}
add_action( 'pre_get_posts', 'NP_change_wp_archive_size'); 



/*FUNCTION PARTS
-------------------------------------------------*/

//Footer Widget
require dirname(__FILE__).'/assets/function-parts/theme/wpml.php';
require dirname(__FILE__).'/assets/function-parts/theme/gcalendar-api-widget.php';

//CPT
require dirname(__FILE__).'/assets/function-parts/cpt-contatti.php';
require dirname(__FILE__).'/assets/function-parts/cpt-comunicazioni.php';
require dirname(__FILE__).'/assets/function-parts/cpt-documenti.php';

// Custom Elementor
require dirname(__FILE__).'/assets/function-parts/custom-elementor/custom-elementor.php';
