<?php
//WPML - Add language switcher to the footer
add_action('wp_footer', 'wpml_floating_language_switcher'); 
function wpml_floating_language_switcher() { 
   echo '<div class="wpml-floating-language-switcher">';
      do_action('wpml_add_language_selector');
   echo '</div>'; 
}
?>