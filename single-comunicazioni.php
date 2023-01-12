<?php
get_header();

while ( have_posts() ) : the_post(); ?>

   <main id="content" <?php post_class( 'site-main' ); ?> role="main">

      <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
         <header class="single-sub-hero mb-section">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <a class="breadcrumps" href="">Breadcrumps</a>
                     <h1><?php the_title(); ?></h1>
                     <div class="single-sub-hero__cf">
                        <div>
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g opacity="0.64" clip-path="url(#clip0_547_5898)">
                              <path d="M8.5 8.33333C10.0194 8.33333 11.25 7.14 11.25 5.66667C11.25 4.19333 10.0194 3 8.5 3C6.98062 3 5.75 4.19333 5.75 5.66667C5.75 7.14 6.98062 8.33333 8.5 8.33333ZM8.5 9.66667C6.66437 9.66667 3 10.56 3 12.3333V13.6667H14V12.3333C14 10.56 10.3356 9.66667 8.5 9.66667Z" fill="#A19E9E"/>
                              </g>
                              <defs>
                              <clipPath id="clip0_547_5898">
                              <rect width="16" height="16" fill="white"/>
                              </clipPath>
                              </defs>
                           </svg>
                           <p><?php echo the_date(); ?></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
      <?php endif; ?>

      <div class="page-content">
         <?php the_content(); ?>
   </div>

   </main>

<?php endwhile; ?>

single-comunicazioni.php here

<?php get_footer(); ?>