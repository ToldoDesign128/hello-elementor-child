<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$footer_nav_menu = wp_nav_menu( [
	'theme_location' => 'footer-how-to',
	'fallback_cb' => false,
	'echo' => false,
] );
?>
<footer  class="" role="contentinfo">
	<div class="container">

        <!-- Sitemap -->
        <div class="row">

        <div class="footer">
            <div class="footer--column">
                <input type="checkbox" id="footer--column-1" name="footer-column">
                <label for="footer--column-1">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div><!-- /footer--column -->

            <div class="footer--column">
                <input type="checkbox" id="footer--column-2" name="footer-column">
                <label for="footer--column-2">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div><!-- /footer--column -->

            <div class="footer--column">
                <input type="checkbox" id="footer--column-3" name="footer-column">
                <label for="footer--column-3">
                <?php dynamic_sidebar( 'footer-3' ); ?>
            </div><!-- /footer--column -->

            <div class="footer--column">
                <input type="checkbox" id="footer--column-4" name="footer-column">
                <label for="footer--column-4">
                <?php dynamic_sidebar( 'footer-4' ); ?>
            </div><!-- /footer--column -->

            <div class="footer--column">
                <input type="checkbox" id="footer--column-5" name="footer-column">
                <label for="footer--column-5">
                <?php dynamic_sidebar( 'footer-5' ); ?>
            </div><!-- /footer--column -->
        </div><!-- /row -->

        </div>


        <div class="row">

            <!-- Site Identity & Social -->
            <div>
                <div class="site-branding show-<?php echo esc_attr( hello_elementor_get_setting( 'hello_footer_logo_type' ) ); ?>">
                    <?php if ( has_custom_logo() && ( 'title' !== hello_elementor_get_setting( 'hello_footer_logo_type' ) || $is_editor ) ) : ?>
                        <div class="site-logo <?php echo esc_attr( hello_show_or_hide( 'hello_footer_logo_display' ) ); ?>">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            
            <!-- Option & Feedback -->
            <div></div>

        </div>

	</div>
</footer>
