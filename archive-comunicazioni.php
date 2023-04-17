<?php get_header(); ?>

<main id="content" role="main">

   <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
      <header class="sub-hero mb-section">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <h1><?php _e('Comunicazioni interne', 'howto'); ?></h1>
                  <p><?php _e('Archivio di tutte le comunicazioni in ordine cronologico.', 'howto'); ?></p>
               </div>
            </div>
         </div>
      </header>
   <?php endif; ?>
   
   <div class="page-content">


      <section class="container">
         <div class="row">
            <div class="col-12">
               <p class="filter-tips"><?php _e('Filtra per categoria:', 'howto'); ?></p>
            </div>
            <div class="col-12 filter-chips">

               <a class="filter-chip" id="all-filter" href="<?php echo get_post_type_archive_link('comunicazioni'); ?>"><?php _e('Tutte', 'howto'); ?></a>

               <?php
               $filter_cats = get_terms( array(
                  'taxonomy' => 'comunicazioni_tax',
                  'parent' => 0, //only parent cat
                  'hide_empty' => true, //only parent cat with at least one post
               ) );
               // var_dump($filter_cats);
               foreach ( $filter_cats as $key => $filter_cat ) {
                  $filter_name = $filter_cat->name;
                  $filter_slug = $filter_cat->slug;
                  $filter_taxonomy = $filter_cat->taxonomy;
                  ?>

                  <a class="filter-chip" id="<?php echo $filter_slug; ?>" href="<?php echo get_post_type_archive_link('comunicazioni') . '/?' . $filter_taxonomy . '=' . $filter_slug; ?>"><?php echo $filter_name; ?></a>

                  <?php
               }
               ?>
            </div>
         </div>
      </section>


      <?php if ( have_posts() ) : ?>
         <section class="fbk-cw fbk-cw-group-link container mb-section">
            <div class="row latest-loop">
               <?php while ( have_posts() ) : the_post();
                  $cpt_in_evidenza = get_field('cpt_in_evidenza');
                  $single_doc_date = get_field('single_doc_date');
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
                              <span class="label_date_cat"><?php if($single_doc_date): echo $single_doc_date; else: echo get_the_date('j F Y'); endif; ?></span>
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