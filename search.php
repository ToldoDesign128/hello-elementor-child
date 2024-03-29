<?php get_header(); ?>

<main id="content" role="main">
   
   <?php if ( have_posts() ) : 
      $result_type_all_posts = array();
      // $result_type_page = array();
      // $result_type_documenti = array();
      // $result_type_comunicazioni = array();
      $result_type_contatti = array();
      // $result_type_altro = array();
      $query = get_search_query();

      if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
         <header class="sub-hero mb-section">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <h1><?php _e('Risultati di ricerca', 'howto'); ?></h1>
                     <p><?php _e('La ricerca ha portato i seguenti risultati.', 'howto'); ?></p>
                  </div>
                  <div class="col-12">
                     <div class="searchform-wrapper">
                        <?php get_search_form(); ?>
                     </div>
                  </div>
               </div>
            </div>
         </header>
      <?php endif; ?>
   
      <div class="page-content">
         <?php while ( have_posts() ) : the_post();
            if ($post->post_type == 'page' && $post->post_name !== 'home' || $post->post_type == 'documenti' || $post->post_type == 'comunicazioni') : $result_type_all_posts[] = $post;
            // if ($post->post_type == 'page' && $post->post_name !== 'home') : $result_type_page[] = $post;
            // elseif ($post->post_type == 'documenti') : $result_type_documenti[] = $post;
            // elseif ($post->post_type == 'comunicazioni') : $result_type_comunicazioni[] = $post;
            elseif ($post->post_type == 'contatti') : $result_type_contatti[] = $post; endif;
         endwhile;
         
         if (!empty($result_type_all_posts)) : ?>
            <!-- layout = loop-comunicazioni -->
            <section class="fbk-cw fbk-cw-group-link container mb-section">
               <div class="row latest-loop">
                  <?php foreach ( $result_type_all_posts as $key => $result_post ) : 

                     // Comunicazioni
                     if ($result_post->post_type == 'comunicazioni') :
                        $cpt_in_evidenza = get_field('cpt_in_evidenza', $result_post);
                        $single_doc_date = get_field('single_doc_date', $result_post);
                        $single_doc_excerpt = get_field('single_doc_excerpt', $result_post);
                        ?>
                        <div class="col-card col-12 col-lg-6">
                           <a class="card card-primary" href="<?php echo get_permalink($result_post->ID); ?>">
                              <span class="svg-wrapper">
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                                 </svg>
                              </span>
                              <div class="content">
                                 <p class="meta">
                                    <span class="label_date_cat"><?php if($single_doc_date): echo $single_doc_date; else: echo get_the_date('j F Y', $result_post->ID); endif; ?></span>
                                    <?php if ($cpt_in_evidenza) : ?><span class="label_in_evidenza"><?php _e('in evidenza', 'howto'); ?></span><?php endif; ?>
                                 </p>
                                 <p class="h3-style"><?php echo $result_post->post_title; ?></p>
                                 <p class="excerpt"><?php echo $single_doc_excerpt; ?></p>
                              </div>
                           </a>
                        </div>
                     <?php // Documenti
                     elseif ($result_post->post_type == 'documenti') :
                        $cpt_in_evidenza = get_field('cpt_in_evidenza', $result_post);
                        $single_doc_date = get_field('single_doc_date', $result_post);
                        $single_doc_excerpt = get_field('single_doc_excerpt', $result_post);
                        ?>
                        <div class="col-card col-12 col-lg-6">
                           <a class="card card-primary" href="<?php echo get_permalink($result_post->ID); ?>">
                              <span class="svg-wrapper">
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                                 </svg>
                              </span>
                              <div class="content">
                                 <?php if($single_doc_date || $cpt_in_evidenza): ?>
                                    <p class="meta">
                                       <?php if($single_doc_date): ?><span class="label_date_cat"><?php echo $single_doc_date; ?></span><?php endif; ?>
                                       <?php if($cpt_in_evidenza): ?><span class="label_in_evidenza"><?php _e('in evidenza', 'howto'); ?></span><?php endif; ?>
                                    </p>
                                 <?php endif; ?>
                                 <p class="h3-style"><?php echo $result_post->post_title; ?></p>
                                 <p class="excerpt"><?php echo $single_doc_excerpt; ?></p>
                              </div>
                           </a>
                        </div>
                     <?php elseif ($result_post->post_type == 'page') : 
                        $subhero_text = get_field('subhero_text', $result_post);
                        ?>
                        <div class="col-card col-12 col-lg-6">
                           <a class="card card-primary" href="<?php echo get_permalink($result_post->ID); ?>">
                              <span class="svg-wrapper">
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                                 </svg>
                              </span>
                              <div class="content">
                                 <p class="h3-style"><?php echo $result_post->post_title; ?></p>
                                 <p class="excerpt"><?php echo $subhero_text; ?></p>
                              </div>
                           </a>
                        </div>
                     <?php endif; 
                  endforeach; ?>
               </div>
            </section>
         <?php endif;

         if (!empty($result_type_contatti)) : ?>
            <section class="fbk-cw fbk-cw-contacts container mb-section">
               <div class="section-header">
                  <div class="content">
                     <h2><?php _e('Contatti', 'howto'); ?></h2>
                  </div>
               </div>
               <div class="row contacts">
                  <?php foreach ( $result_type_contatti as $key => $result_post ) : 
                     $img = get_field('single_contact_img', $result_post);
                     $text = get_field('single_contact_text', $result_post);
                     $email = get_field('single_contact_email', $result_post);
                     $tel = get_field('single_contact_tel', $result_post);
                     ?>

                     <div class="col-12 col-sm-6 col-lg-4">
                        <article class="single_contact">
                           <?php if ($img) : ?><div>
                              <figure><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>"></figure>
                           </div><?php endif; ?>
                           <div class="content">
                              <h3><?php echo $result_post->post_title; ?></h3>
                              <?php if ($text) : ?><p class="desc"><?php echo $text; ?></p><?php endif; ?>
                              <?php if ($email) : ?><p><?php echo $email; ?></p><?php endif; ?>
                              <?php if ($tel) : ?><p><?php echo $tel; ?></p><?php endif; ?>
                           </div>
                        </article>
                     </div>

                  <?php endforeach; ?>
               </div>
            </section>
         <?php endif; ?>
      </div>
                  
   <?php else :
      if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
         <header class="sub-hero">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <h1><?php _e('Nessun risultato', 'howto'); ?></h1>
                     <p><?php _e('La ricerca non ha portato risultati.', 'howto'); ?></p>
                  </div>
                  <div class="col-12">
                     <div class="searchform-wrapper">
                        <?php get_search_form(); ?>
                     </div>
                  </div>
               </div>
            </div>
         </header>
      <?php endif;
   endif; wp_reset_postdata(); ?>

</main>
<?php get_footer();