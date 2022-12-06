<?php

function tutsplus_widgets_init() {
 
 // Prima colonna del footer
 register_sidebar( array(
     'name' => __( 'Prima colonna del footer', 'tutsplus' ),
     'id' => 'prima-footer-widget-area',
     'description' => __( 'Prima colonna del footer widget area', 'tutsplus' ),
     'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
     'after_widget' => '</div>',
     'before_title' => '<h3 id="footer-title" class="footer-title">',
     'after_title' => '</h3>',
 ) );

 // Seconda colonna del footer
 register_sidebar( array(
     'name' => __( 'Seconda colonna del footer', 'tutsplus' ),
     'id' => 'seconda-footer-widget-area',
     'description' => __( 'Seconda colonna del footer widget area', 'tutsplus' ),
     'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
     'after_widget' => '</div>',
     'before_title' => '<h3 id="footer-title" class="footer-title">',
     'after_title' => '</h3>',
 ) );

 // Terza colonna del footer
 register_sidebar( array(
     'name' => __( 'Terza colonna del footer', 'tutsplus' ),
     'id' => 'terza-footer-widget-area',
     'description' => __( 'Terza colonna del footer widget area', 'tutsplus' ),
     'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
     'after_widget' => '</div>',
     'before_title' => '<h3 id="footer-title" class="footer-title">',
     'after_title' => '</h3>',
 ) );

 // Quarta colonna del footer
 register_sidebar( array(
     'name' => __( 'Quarta colonna del footer', 'tutsplus' ),
     'id' => 'quarta-footer-widget-area',
     'description' => __( 'Quarta colonna del footer widget area', 'tutsplus' ),
     'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
     'after_widget' => '</div>',
     'before_title' => '<h3 id="footer-title" class="footer-title">',
     'after_title' => '</h3>',
 ) );

  // Quinta colonna del footer
  register_sidebar( array(
    'name' => __( 'Quinta colonna del footer', 'tutsplus' ),
    'id' => 'quinta-footer-widget-area',
    'description' => __( 'Quinta colonna del footer widget area', 'tutsplus' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 id="footer-title" class="footer-title">',
    'after_title' => '</h3>',
 ) );

 // Sesta colonna del footer
 register_sidebar( array(
    'name' => __( 'Sesta colonna del footer', 'tutsplus' ),
    'id' => 'sesta-footer-widget-area',
    'description' => __( 'Sesta colonna del footer widget area', 'tutsplus' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 id="footer-title" class="footer-title">',
    'after_title' => '</h3>',
 ) );
      
}

// Register sidebars by running tutsplus_widgets_init() on the widgets_init hook.
add_action( 'widgets_init', 'tutsplus_widgets_init' );

?>