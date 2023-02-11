<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php $viewport_content = apply_filters( 'hello_elementor_viewport_content', 'width=device-width, initial-scale=1' ); ?>
	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
   <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
   <meta name="format-detection" content="telephone=no">
   <meta name="theme-color" content="#1254a2">
   <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/favicon-light.png" type="image/x-icon" media="(prefers-color-scheme: light)">
   <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/favicon-dark.png" type="image/x-icon" media="(prefers-color-scheme: dark)">
   <meta name="description" content="<?php bloginfo('description'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part('/template-parts/dynamic-header'); ?>
