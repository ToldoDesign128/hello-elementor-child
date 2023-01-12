<?php
/**
 * Text Domain: custom-FBK-widget
 */

/* Add widget categories
----------------------------------*/
function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'fbk-pages',
		[
			'title' => esc_html__( 'FBK - Pages', 'custom-FBK-widget' ),
			'icon' => 'fa fa-plug',
		]
	);

  $elements_manager->add_category(
		'fbk-loops',
		[
			'title' => esc_html__( 'FBK - Loops', 'custom-FBK-widget' ),
			'icon' => 'fa fa-plug',
		]
	);

  $elements_manager->add_category(
		'fbk-single',
		[
			'title' => esc_html__( 'FBK - Single post', 'custom-FBK-widget' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );


/**
 * Register custom widget
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_fbk_custom_widgets( $widgets_manager ) {

  /* FBK - Pages
  ----------------------*/

  // Highlight section
  require_once( __DIR__ . '/widgets/highlight.php' );
  $widgets_manager->register( new \FBK_Elementor_Highlight() );

  // CTA
  require_once( __DIR__ . '/widgets/cta.php' );
  $widgets_manager->register( new \FBK_Elementor_CTA() );

  // FAQ
  require_once( __DIR__ . '/widgets/faq.php' );
  $widgets_manager->register( new \FBK_Elementor_FAQ() );

  // Gruppo di link 
  require_once( __DIR__ . '/widgets/group-link.php' );
  $widgets_manager->register( new \FBK_Elementor_GroupLink() );

  // Gruppo di download 
  require_once( __DIR__ . '/widgets/group-download.php' );
  $widgets_manager->register( new \FBK_Elementor_GroupDownload() );

  // Contacts
  require_once( __DIR__ . '/widgets/contacts.php' );
  $widgets_manager->register( new \FBK_Elementor_Contacts() );

  // GoogleCalendar
  require_once( __DIR__ . '/widgets/google-calendar.php' );
  $widgets_manager->register( new \FBK_Elementor_GoogleCalendar() );

  // Alert
  require_once( __DIR__ . '/widgets/alert.php' );
  $widgets_manager->register( new \FBK_Elementor_Alert() );


  /* FBK - Loops
  ----------------------*/

  // Comunicazioni
  require_once( __DIR__ . '/widgets/loop-latest-comunicazioni.php' );
  $widgets_manager->register( new \FBK_Elementor_LoopComunicazioni() );

  // DocumentiI
  require_once( __DIR__ . '/widgets/loop-documenti-I.php' );
  $widgets_manager->register( new \FBK_Elementor_LoopDocumentiI() );

  // DocumentiII
  require_once( __DIR__ . '/widgets/loop-documenti-II.php' );
  $widgets_manager->register( new \FBK_Elementor_LoopDocumentiII() );
  


  /* FBK - Single post
  ----------------------*/
  // HeadingTwo
  require_once( __DIR__ . '/widgets/h2.php' );
  $widgets_manager->register( new \FBK_Elementor_HeadingTwo() );

  // HeadingThree
  require_once( __DIR__ . '/widgets/h3.php' );
  $widgets_manager->register( new \FBK_Elementor_HeadingThree() );

  // Images
  require_once( __DIR__ . '/widgets/img.php' );
  $widgets_manager->register( new \FBK_Elementor_Image() );

  // HighlightedPhrase
  require_once( __DIR__ . '/widgets/h-phrase.php' );
  $widgets_manager->register( new \FBK_Elementor_HighlightedPhrase() );

  // HighlightedCode
  require_once( __DIR__ . '/widgets/h-code.php' );
  $widgets_manager->register( new \FBK_Elementor_HighlightedCode() );
}
add_action( 'elementor/widgets/register', 'register_fbk_custom_widgets' );








/**
 * Unregister unused widgets.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function remove_unused_widgets( $widgets_manager ) {

	$widgets_to_unregister = [
      //Base
      'inner-section',
		'heading',
		'image',
		// 'text-editor', // non si può disattivare nei single
		//'video',
		'button',
		'divider',
		'spacer',
		'google-maps', //non funzia
		'icon',

      //Generale
      'image-box',
      'icon-box',
      'star-rating',
      'image-carousel',
      'image-gallery',
      'icon-list',
      'counter',
      'progress',
      'testimonial',
      'tabs',
      'accordion',
      'toggle',
      'social-icons',
      'alert',
      'audio',
      'shortcode',
      'html',
      'menu-anchor',
      'sidebar',
      'read-more',
      'text-path' //non funzia

      // pro ----------------- //
      ,'posts'
      ,'portfolio'
      ,'slides'
      ,'form'
      ,'login'
      ,'media-carousel'
      ,'testimonial-carousel'
      ,'nav-menu'
      ,'pricing'
      ,'facebook-comment'
      ,'nav-menu'
      ,'animated-headline'
      ,'price-list'
      ,'price-table'
      ,'facebook-button'
      ,'facebook-comments'
      ,'facebook-embed'
      ,'facebook-page'
      ,'add-to-cart'
      ,'categories'
      ,'elements'
      ,'products'
      ,'flip-box'
      ,'carousel'
      ,'countdown'
      ,'share-buttons'
      ,'author-box'
      ,'breadcrumbs'
      ,'search-form'
      ,'post-navigation'
      ,'post-comments'
      ,'theme-elements'
      ,'blockquote'
      ,'template'
      ,'wp-widget-audio'
      ,'woocommerce'
      ,'social'
      ,'library'

      // wp widgets ----------------- //
      ,'wp-widget-pages'
      ,'wp-widget-archives'
      ,'wp-widget-media_audio'
      ,'wp-widget-media_image'
      ,'wp-widget-media_gallery'
      ,'wp-widget-media_video'
      ,'wp-widget-meta'
      ,'wp-widget-search'
      ,'wp-widget-text'
      ,'wp-widget-categories'
      ,'wp-widget-recent-posts'
      ,'wp-widget-recent-comments'
      ,'wp-widget-rss'
      ,'wp-widget-tag_cloud'
      ,'wp-widget-nav_menu'
      ,'wp-widget-custom_html'
      ,'wp-widget-polylang'
      ,'wp-widget-calendar'
      ,'wp-widget-elementor-library'
      ,'wp-widget-block'
	];

	foreach ( $widgets_to_unregister as $widget ) {
		$widgets_manager->unregister( $widget );
	}
}
add_action( 'elementor/widgets/register', 'remove_unused_widgets' );



//custom CSS in Elementor editor
function HT_css_elementor(){
   echo '<style>

      /*remove panel core category of widgets*/
      .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-basic {display:none !important;}
      .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-pro-elements {display:none !important;}
      .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-general {display:none !important;}
      .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-theme-elements {display:none !important;}
      .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-theme-elements-single {display:none !important;}
      .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-woocommerce-elements {display:none !important;}

      /*remove style tab*/
      .elementor-editor-active .elementor-panel .elementor-panel-navigation .elementor-tab-control-style {display:none !important;}
      /*remove advanced tab*/
      .elementor-editor-active .elementor-panel .elementor-panel-navigation .elementor-tab-control-advanced {display:none !important;}

      /*remove Serve aiuto?*/
      .elementor-editor-active .elementor-panel #elementor-panel-page-editor #elementor-panel__editor__help {display:none !important;}

      /*remove Capolettera switcher from Editor*/
      .elementor-editor-active .elementor-panel .elementor-control.elementor-control-drop_cap {display:none !important;}

      /*castred Wysiwyg*/
      .elementor-editor-active .elementor-panel .elementor-control.elementor-control-type-wysiwyg .wp-editor-container .mce-panel .mce-container .mce-listbox{display:none !important;} /*no switcher p and headings*/
      .elementor-editor-active .elementor-panel .elementor-control.elementor-control-type-wysiwyg .wp-editor-tools {display:none !important;} /*no caricamento media + no switcher modalità*/
      .elementor-editor-active .elementor-panel .elementor-control.elementor-control-type-wysiwyg .mce-top-part.mce-stack-layout-item .mce-widget:nth-of-type(8) {display:none !important;} /*no full screen*/
      .elementor-editor-active .elementor-panel .elementor-control.elementor-control-type-wysiwyg .mce-top-part.mce-stack-layout-item .mce-widget:nth-of-type(9) {display:none !important;} /*no toolbar*/

   </style>';
}
add_action( 'elementor/editor/after_enqueue_styles', 'HT_css_elementor' );