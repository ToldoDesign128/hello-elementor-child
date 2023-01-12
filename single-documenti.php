<?php
get_header();

while ( have_posts() ) : the_post();

   $bread_current = get_the_title();

   $current_tax = 'documenti_tax';
   $current_ID = get_the_ID();
   $current_cats = get_the_terms($current_ID, $current_tax);;
   foreach ( $current_cats as $key => $cur_cat ) {
      if ($cur_cat->parent == 0) {
         $bread_first_label = $cur_cat->name;
         $page_ID = get_field('child_cat_page', $cur_cat);
         $bread_first_link = get_permalink($page_ID);
      } else { 
         $bread_second_label = $cur_cat->name;
         $page_ID = get_field('child_cat_page', $cur_cat);
         $bread_second_link = get_permalink($page_ID);
      }
   }


   $single_doc_author = get_field('single_doc_author');
   $single_doc_date = get_the_date('j F Y');
   $single_doc_time = get_field('single_doc_time');
   
	?>

   <main id="content" <?php post_class( 'site-main' ); ?> role="main">

      <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
         <header class="single-sub-hero mb-section">
            <div class="container">
               <div class="row">
                  <div class="col-12">

                     <nav class="breadcrumps">
                        <ul>
                           <li>
                              <a href="" class="bread-link">
                                 <svg class="home" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.33464 16.6667V11.6667H11.668V16.6667H15.8346V10H18.3346L10.0013 2.5L1.66797 10H4.16797V16.6667H8.33464Z"/>
                                 </svg>
                              </a>
                           </li>
                           <div class="pointer">
                              <svg width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0 7.9425L3.435 4.5L0 1.0575L1.0575 0L5.5575 4.5L1.0575 9L0 7.9425Z" fill="#A19E9E"/>
                              </svg>
                           </div>
                           <li>
                              <a href="<?php echo $bread_first_link; ?>" class="bread-link">
                                 <?php echo $bread_first_label; ?>
                              </a>
                           </li>
                           <div class="pointer">
                              <svg width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0 7.9425L3.435 4.5L0 1.0575L1.0575 0L5.5575 4.5L1.0575 9L0 7.9425Z" fill="#A19E9E"/>
                              </svg>
                           </div>
                           <li>
                              <a href="<?php echo $bread_second_link; ?>" class="bread-link">
                                 <?php echo $bread_second_label; ?>
                              </a>
                           </li>
                           <div class="pointer d-none d-sm-block">
                              <svg width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0 7.9425L3.435 4.5L0 1.0575L1.0575 0L5.5575 4.5L1.0575 9L0 7.9425Z" fill="#A19E9E"/>
                              </svg>
                           </div>
                           <li class="d-none d-sm-inline">
                              <a class="bread-link">
                                 <?php echo $bread_current; ?>
                              </a>
                           </li>
                        </ul>
                     </nav>

                     
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
                           <p><?php echo $single_doc_author ?></p>
                        </div>
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
                           <p><?php echo $single_doc_date ?></p>
                        </div>
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
                           <p><?php echo $single_doc_time ?></p>
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

single-documenti.php here

<?php get_footer(); ?>