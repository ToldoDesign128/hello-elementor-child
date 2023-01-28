<?php get_header(); ?>

<main id="content" role="main">

   <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
      <header class="sub-hero mb-section">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <h1>Comunicazioni interne</h1>
                  <p>Archivio di tutte le comunicazioni in ordine cronologico.</p>
               </div>
            </div>
         </div>
      </header>
   <?php endif; ?>
   
   <div class="page-content">
      <?php if ( have_posts() ) : ?>
         <section class="fbk-cw fbk-cw-group-link container mb-section">
            <div class="row latest-loop">
               <?php while ( have_posts() ) : the_post();
                  $cpt_in_evidenza = get_field('cpt_in_evidenza');
                  $cpt_comunicazioni_taxonomy = get_field('cpt_comunicazioni_taxonomy');
                  $single_doc_excerpt = get_field('single_doc_excerpt');
                  ?>

                  <div class="col-card col-12 col-lg-6">
                     <a class="card card-primary" href="<?php the_permalink(); ?>">
                        <span class="svg-wrapper">
                           <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                           </svg>
                        </span>
                        <div class="content">
                           <p class="meta">
                              <span class="label_date_cat"><?php echo get_the_date('j F Y'); ?><?php if ($cpt_comunicazioni_taxonomy) : ?> — <?php echo $cpt_comunicazioni_taxonomy->name; endif; ?></span>
                              <?php if ($cpt_in_evidenza) : ?><span class="label_in_evidenza"><?php _e('in evidenza', 'howto'); ?></span><?php endif; ?>
                           </p>
                           <p class="h3-style"><?php echo the_title(); ?></p>
                           <p class="excerpt"><?php echo $single_doc_excerpt; ?></p>
                        </div>
                     </a>
                  </div>

               <?php endwhile; ?>
            </div>
         </section>
      <?php endif; ?>
   </div>

</main>
<?php get_footer();