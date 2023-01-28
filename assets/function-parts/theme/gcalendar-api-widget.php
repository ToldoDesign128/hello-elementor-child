<?php function HT_widgets_init() {
   register_sidebar( array(
      'name' => __( 'Google Calendar custom API', 'howto' ),
      'id' => 'gc-widget',
      'description' => __( 'Google Calendar custom API', 'howto' ),
   ) );   
}
add_action( 'widgets_init', 'HT_widgets_init' ); ?>