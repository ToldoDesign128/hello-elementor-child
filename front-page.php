<?php // Template Name: Homepage
get_header();
	while ( have_posts() ) : the_post(); 
   
   $home_title = get_field('home_title');
   $home_subtitle = get_field('home_subtitle');
   ?>


   <!-- Hero -->
   <section class="hero mb-section">
      <div class="hero-bg">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <h1><?php echo $home_title; ?></h1>
                  <p class="subtitle"><?php echo $home_subtitle; ?></p>
               </div>
               <div class="col-12">
                  <div class="searchform-wrapper">
                     <?php get_search_form(); ?>
                  </div>
               </div>
               <div class="col-12">
                  <?php if(have_rows('home_chips')): ?>
                     <div class="chips-wrapper">
                        <?php while( have_rows('home_chips') ) : the_row();
                           $home_chip = get_sub_field('home_chip');
                           $home_chip_title = $home_chip->post_title;
                           $home_chip_link = get_post_permalink( $home_chip->ID );
                           
                           if ($home_chip) :?>
                              <a class="chip" href="<?php echo $home_chip_link; ?>"><span><?php echo $home_chip_title; ?></span></a>
                           <?php endif;
                        endwhile; ?>
                     </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
      <?php if(have_rows('home_posts')): ?>
         <div class="home_posts container">
            <div class="row justify-content-center">
               <?php while( have_rows('home_posts') ) : the_row();
                  $home_post = get_sub_field('home_post');
                  if ($home_post) :
                     $home_post_title = $home_post->post_title;
                     $home_post_link = get_post_permalink( $home_post->ID );
                     ?>
                     <div class="col-card col-6 col-lg-3">
                        <a class="card card-secondary" href="<?php echo $home_post_link; ?>">
                           <span class="svg-wrapper">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z"/>
                              </svg>
                           </span>
                           <p class="h3-style"><?php echo $home_post_title; ?></p>
                        </a>

                     </div>
                  <?php endif;
               endwhile; ?>
            </div>
         </div>
      <?php endif; ?>
   </section>

   <!-- <label class="dark-mode-label" for="dark-mode-trigger">
      <h2>Going dark</h2>
      <input type="checkbox" class="dark-mode-trigger" id="dark-mode-trigger"/>
      <div>icone sole e luna</div>
   </label> -->

   <?php the_content(); ?>

<?php endwhile;
get_footer();