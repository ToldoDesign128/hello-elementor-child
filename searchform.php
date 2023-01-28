<?php
/* Hero search form */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
   <label class="input-wrapper">
      <span class="screen-reader-text"><?php _e( 'Cerca nel sito:', 'howto' ); ?></span>
      <input type="search" class="search-field"
         placeholder="<?php echo esc_attr_e( 'Cosa stai cercando?', 'howto' ); ?>"
         value="<?php echo get_search_query() ?>" name="s"
         title="<?php esc_attr_e( 'Cerca nel sito:', 'howto' ); ?>" />
   </label>
   <label class="svg-wrapper">
      <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M27.0978 25.2449H26.1893L25.8673 24.9443C26.9943 23.6753 27.6729 22.0278 27.6729 20.2356C27.6729 16.2393 24.3263 13 20.1978 13C16.0692 13 12.7227 16.2393 12.7227 20.2356C12.7227 24.2319 16.0692 27.4712 20.1978 27.4712C22.0493 27.4712 23.7513 26.8145 25.0623 25.7236L25.3728 26.0353V26.9147L31.1229 32.4694L32.8364 30.8108L27.0978 25.2449V25.2449ZM20.1978 25.2449C17.3342 25.2449 15.0227 23.0074 15.0227 20.2356C15.0227 17.4638 17.3342 15.2263 20.1978 15.2263C23.0613 15.2263 25.3728 17.4638 25.3728 20.2356C25.3728 23.0074 23.0613 25.2449 20.1978 25.2449Z" fill="#605E5C"/>
      </svg>
      <input type="submit" class="search-submit" value="" />
   </label>
</form>