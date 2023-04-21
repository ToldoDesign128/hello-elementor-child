<?php
get_header();

while ( have_posts() ) : the_post();

   $bread_current = get_the_title();

   $current_tax = 'documenti_tax';
   $current_ID = get_the_ID();
   $current_ID_it = apply_filters( 'wpml_object_id', $current_ID, 'post', FALSE, 'it' );
   $current_cats = get_the_terms($current_ID, $current_tax);
   if ( $current_cats ) :
      foreach ( $current_cats as $key => $cur_cat ) {
         if ($cur_cat->parent == 0) {
            // $bread_first_label = $cur_cat->name;
            $page_ID = get_field('child_cat_page', $cur_cat);
            $bread_first_link = get_permalink($page_ID);
            // $page_ID_it = apply_filters( 'wpml_object_id', $page_ID, 'post', FALSE, 'it' );
            $page_ID_cur = apply_filters( 'wpml_object_id', $page_ID );
            $bread_first_label = get_the_title($page_ID_cur);
         } else { 
            // $bread_second_label = $cur_cat->name;
            $page_ID = get_field('child_cat_page', $cur_cat);
            $bread_second_link = get_permalink($page_ID);
            $page_ID_cur = apply_filters( 'wpml_object_id', $page_ID );
            $bread_second_label = get_the_title($page_ID_cur);
         }
      }
   endif;

   $single_doc_author = get_field('single_doc_author');
   $single_doc_date = get_field('single_doc_date');
   $single_doc_time = get_field('single_doc_time');
	?>

   <main id="content" <?php post_class( 'site-main' ); ?> role="main">

      <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
         <header class="single-sub-hero mb-section">
            <div class="container">
               <div class="row">
                  <div class="col-12">

                     <?php 

                        // echo 'ID approfondimento attuale = ' . $current_ID; ?><br><?php
                        // echo 'ID approfondimento in ITALIANO = ' . $current_ID_it; ?><br><?php
                     
                     if ( $current_cats ) : ?>
                        <nav class="breadcrumps">
                           <ul>
                              <li>
                                 <a href="<?php echo get_home_url(); ?>" class="bread-link">
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
                                 <?php 
                                 /*echo 'ID pagina associata ITA alla cat di primo lvl = ' . $page_ID_it; ?><br><?php*/
                                 echo 'ID pagina associata CORRENTE alla cat di secondo lvl = ' . $page_ID_cur;
                                 ?><br>
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
                                 <a title="pagina attuale" class="bread-link">
                                    <?php echo $bread_current; ?>
                                 </a>
                              </li>
                           </ul>
                        </nav>
                     <?php endif; ?>
                     
                     <h1><?php the_title(); ?></h1>
                     <?php if ($single_doc_author || $single_doc_date || $single_doc_time) : ?>
                        <div class="single-sub-hero__cf">
                           <?php if ($single_doc_author) : ?>
                              <div>
                                 <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 7.5C9.1575 7.5 10.5 6.1575 10.5 4.5C10.5 2.8425 9.1575 1.5 7.5 1.5C5.8425 1.5 4.5 2.8425 4.5 4.5C4.5 6.1575 5.8425 7.5 7.5 7.5ZM7.5 9C5.4975 9 1.5 10.005 1.5 12V13.5H13.5V12C13.5 10.005 9.5025 9 7.5 9Z" fill="#605E5C"/>
                                 </svg>
                                 <p><?php echo $single_doc_author; ?></p>
                              </div>
                           <?php endif; 
                           if ($single_doc_date) : ?>
                              <div>
                                 <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.8 2.18182H12.2V1H11V2.18182H5V1H3.8V2.18182H3.2C2.54 2.18182 2 2.71364 2 3.36364V12.8182C2 13.4682 2.54 14 3.2 14H12.8C13.46 14 14 13.4682 14 12.8182V3.36364C14 2.71364 13.46 2.18182 12.8 2.18182ZM12.8 12.8182H3.2V5.13636H12.8V12.8182Z" fill="#605E5C"/>
                                 </svg>
                                 <p><?php echo $single_doc_date; ?></p>
                              </div>
                           <?php endif; 
                           if ($single_doc_time) : ?>
                              <div>
                                 <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.4935 1C3.9055 1 1 3.912 1 7.5C1 11.088 3.9055 14 7.4935 14C11.088 14 14 11.088 14 7.5C14 3.912 11.088 1 7.4935 1ZM7.5 12.7C4.627 12.7 2.3 10.373 2.3 7.5C2.3 4.627 4.627 2.3 7.5 2.3C10.373 2.3 12.7 4.627 12.7 7.5C12.7 10.373 10.373 12.7 7.5 12.7Z" fill="#605E5C"/>
                                    <path d="M7.99958 3.99994H6.99958V7.93437L10.4996 9.99994L10.9996 9.19338L7.99958 7.44256V3.99994Z" fill="#605E5C"/>
                                 </svg>
                                 <p><?php echo $single_doc_time; ?></p>
                              </div>
                           <?php endif; ?>
                        </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </header>
      <?php endif; ?>

      <div class="single-page-content">
         <?php the_content(); ?>
         <!-- <aside class="sidebar d-none d-xl-block">
            <div class="content-wrapper">
               <nav class="index">
               </nav>
            </div>
         </aside> -->
      </div>

   </main>

<?php endwhile; 
get_footer(); ?>