<?php get_header();
while ( have_posts() ) : the_post();
   $subhero_text = get_field('subhero_text');
   ?>

   <main id="content" <?php post_class( 'site-main' ); ?> role="main">

      <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
         <header class="sub-hero mb-section">
            <div class="container">
               <div class="row">
                  <div class="col-12">

                     <nav class="breadcrumps<?php if ($post->post_parent == 0) : echo ' parent-breadcrumps'; endif; ?>">
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
                              <?php if ($post->post_parent == 0) : ?>
                                 <a title="pagina attuale" class="bread-link">
                                    <?php echo get_the_title(); ?>
                                 </a>
                              <?php else : ?>
                                 <a href="<?php echo get_the_permalink($post->post_parent); ?>" class="bread-link">
                                    <?php echo get_the_title($post->post_parent); ?>
                                 </a>
                              <?php endif; ?>
                           </li>
                           <?php if ($post->post_parent != 0) : ?>
                              <div class="pointer">
                                 <svg width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 7.9425L3.435 4.5L0 1.0575L1.0575 0L5.5575 4.5L1.0575 9L0 7.9425Z" fill="#A19E9E"/>
                                 </svg>
                              </div>
                              <li>
                                 <a title="pagina attuale" class="bread-link">
                                    <?php echo get_the_title(); ?>
                                 </a>
                              </li>
                           <?php endif; ?>
                        </ul>
                     </nav>

                     <h1><?php the_title(); ?></h1>
                     <?php if($subhero_text) : ?><p><?php echo $subhero_text; ?></p><?php endif; ?>
                  </div>
               </div>
            </div>
         </header>
      <?php endif; ?>

      <div class="page-content">
         <?php the_content(); ?>
      </div>

   </main>

<?php endwhile;
get_footer(); ?>