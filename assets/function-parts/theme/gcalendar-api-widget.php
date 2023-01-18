<?php function HT_widgets_init() {
   register_sidebar( array(
      'name' => __( 'Google Calendar custom API', 'HT' ),
      'id' => 'gc-widget',
      'description' => __( 'Google Calendar custom API', 'HT' ),
   ) );   
}
add_action( 'widgets_init', 'HT_widgets_init' ); ?>