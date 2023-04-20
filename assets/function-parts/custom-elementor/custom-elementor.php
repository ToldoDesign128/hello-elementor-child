<?php if ( !defined('ABSPATH') ) {exit;}
/**
 * Text Domain: custom-FBK-widget
 */

/* Add widget categories
----------------------------------*/
function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'fbk-pages',
		[
			'title' => esc_html__( 'FBK — Pagine', 'custom-FBK-widget' ),
			'icon' => 'fa fa-plug',
		]
	);

  $elements_manager->add_category(
		'fbk-loops',
		[
			'title' => esc_html__( 'FBK — Loops', 'custom-FBK-widget' ),
			'icon' => 'fa fa-plug',
		]
	);

  $elements_manager->add_category(
		'fbk-single',
		[
			'title' => esc_html__( 'FBK — Articoli', 'custom-FBK-widget' ),
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

  // Intro
  require_once( __DIR__ . '/widgets/intro.php' );
  $widgets_manager->register( new \FBK_Elementor_Intro() );

  // Alert
  require_once( __DIR__ . '/widgets/alert.php' );
  $widgets_manager->register( new \FBK_Elementor_Alert() );

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

  // Gruppo di card
  require_once( __DIR__ . '/widgets/group-card.php' );
  $widgets_manager->register( new \FBK_Elementor_GroupCard() );
  
   // Contacts
   require_once( __DIR__ . '/widgets/contacts.php' );
   $widgets_manager->register( new \FBK_Elementor_Contacts() );
  
   // GoogleCalendar
   require_once( __DIR__ . '/widgets/google-calendar.php' );
   $widgets_manager->register( new \FBK_Elementor_GoogleCalendar() );


  /* FBK - Loops
  ----------------------*/
  
   // DocumentiI
   require_once( __DIR__ . '/widgets/loop-documenti-I.php' );
   $widgets_manager->register( new \FBK_Elementor_LoopDocumentiI() );
   
   // DocumentiII
   require_once( __DIR__ . '/widgets/loop-documenti-II.php' );
   $widgets_manager->register( new \FBK_Elementor_LoopDocumentiII() );
  
   // Latest Comunicazioni
   require_once( __DIR__ . '/widgets/loop-latest-comunicazioni.php' );
   $widgets_manager->register( new \FBK_Elementor_LoopLatestComunicazioni() );

   // Comunicazioni
   require_once( __DIR__ . '/widgets/loop-comunicazioni.php' );
   $widgets_manager->register( new \FBK_Elementor_LoopComunicazioni() );
  


  /* FBK - Single post
  ----------------------*/
  // HeadingTwo
  require_once( __DIR__ . '/widgets/h2.php' );
  $widgets_manager->register( new \FBK_Elementor_HeadingTwo() );

  // HeadingThree
  require_once( __DIR__ . '/widgets/h3.php' );
  $widgets_manager->register( new \FBK_Elementor_HeadingThree() );

  // HeadingFour
  require_once( __DIR__ . '/widgets/h4.php' );
  $widgets_manager->register( new \FBK_Elementor_HeadingFour() );

  // Paragraph
  require_once( __DIR__ . '/widgets/paragraph.php' );
  $widgets_manager->register( new \FBK_Elementor_Paragraph() );
  
  // Image
  require_once( __DIR__ . '/widgets/img.php' );
  $widgets_manager->register( new \FBK_Elementor_Image() );
  
  // Gallery
  require_once( __DIR__ . '/widgets/gallery.php' );
  $widgets_manager->register( new \FBK_Elementor_Gallery() );
  
   // ImageText
   require_once( __DIR__ . '/widgets/img-txt.php' );
   $widgets_manager->register( new \FBK_Elementor_ImageText() );
    
   // Button
   require_once( __DIR__ . '/widgets/btn.php' );
   $widgets_manager->register( new \FBK_Elementor_Button() );
  
  // iframe
  require_once( __DIR__ . '/widgets/iframe.php' );
  $widgets_manager->register( new \FBK_Elementor_iframe() );
  
  // Youtube video
  require_once( __DIR__ . '/widgets/youtube-video.php' );
  $widgets_manager->register( new \FBK_Elementor_YoutubeVideo() );

  // HighlightedPhrase
  require_once( __DIR__ . '/widgets/h-phrase.php' );
  $widgets_manager->register( new \FBK_Elementor_HighlightedPhrase() );

  // HighlightedCode
  require_once( __DIR__ . '/widgets/h-code.php' );
  $widgets_manager->register( new \FBK_Elementor_HighlightedCode() );

  // Spacer
  require_once( __DIR__ . '/widgets/spacer.php' );
  $widgets_manager->register( new \FBK_Elementor_Spacer() );
}
add_action( 'elementor/widgets/register', 'register_fbk_custom_widgets' );








/**
 * Unregister unused widgets.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
if ( ! current_user_can('administrator')) :
   function remove_unused_widgets( $widgets_manager ) {
      $widgets_to_unregister = [
         //Base
         'inner-section',
         'heading',
         'image',
         // 'text-editor', // non si può disattivare nei single
         'video',
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

   //custom CSS in Elementor editor for non admin users
   function HT_css_elementor_for_not_admin(){
      echo '<style>

         /*remove panel core category of widgets*/
         .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-basic {display:none !important;}
         .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-pro-elements {display:none !important;}
         .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-general {display:none !important;}
         .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-theme-elements {display:none !important;}
         .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-theme-elements-single {display:none !important;}
         .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-woocommerce-elements {display:none !important;}
         .elementor-editor-active .elementor-panel .elementor-panel-category#elementor-panel-category-wordpress {display:none !important;}

         /*remove style tab*/
         .elementor-editor-active .elementor-panel .elementor-panel-navigation .elementor-tab-control-style {display:none !important;}
         /*remove advanced tab*/
         .elementor-editor-active .elementor-panel .elementor-panel-navigation .elementor-tab-control-advanced {display:none !important;}
         /*remove layout tab*/
         .elementor-editor-active .elementor-panel .elementor-panel-navigation .elementor-tab-control-layout {display:none !important;}

         /*remove Serve aiuto?*/
         .elementor-editor-active .elementor-panel #elementor-panel-page-editor #elementor-panel__editor__help {display:none !important;}

         /*remove Capolettera switcher from Editor*/
         .elementor-editor-active .elementor-panel .elementor-control.elementor-control-drop_cap {display:none !important;}

         /*castred Wysiwyg*/
         .elementor-editor-active .elementor-panel .elementor-control.elementor-control-type-wysiwyg .wp-editor-container .mce-panel .mce-container .mce-listbox{display:none !important;} /*no switcher p and headings*/
         .elementor-editor-active .elementor-panel .elementor-control.elementor-control-type-wysiwyg .wp-editor-tools {display:none !important;} /*no caricamento media + no switcher modalità*/
         .elementor-editor-active .elementor-panel .elementor-control.elementor-control-type-wysiwyg .mce-top-part.mce-stack-layout-item .mce-widget:nth-of-type(8) {display:none !important;} /*no full screen*/
         .elementor-editor-active .elementor-panel .elementor-control.elementor-control-type-wysiwyg .mce-top-part.mce-stack-layout-item .mce-widget:nth-of-type(9) {display:none !important;} /*no toolbar*/

         /*Remove options for Colonna*/
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-_inline_size,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-content_position,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-align,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-space_between_widgets,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-html_tag {display:none !important;}

         /*Remove options for Sezione*/
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-layout,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-content_width,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-gap,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-height,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-overflow,
         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-stretch_section,

         .elementor-editor-active .elementor-panel #elementor-controls .elementor-control-structure {display:none !important;}

      </style>';
   }
   add_action( 'elementor/editor/after_enqueue_styles', 'HT_css_elementor_for_not_admin' );
else:
   //rimuovo anche per gli admin alcuni widget di default
   function admin_remove_unused_widgets( $widgets_manager ) {
      $widgets_to_unregister = [
         //Base
         'button',
         'icon',

         //Generale
         'star-rating',
         'image-carousel',
         'image-gallery',
         'social-icons',
         'alert',
         'audio',
         'menu-anchor',
         'sidebar',
         'read-more'

         // pro ----------------- //
         ,'facebook-comment'
         ,'facebook-button'
         ,'facebook-comments'
         ,'facebook-embed'
         ,'facebook-page'
         ,'add-to-cart'
         ,'woocommerce'
         ,'template'

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
   add_action( 'elementor/widgets/register', 'admin_remove_unused_widgets' );
endif;

//custom CSS in Elementor editor for non admin users
function HT_css_elementor(){
   echo '<style>
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