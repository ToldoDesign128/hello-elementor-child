<?php get_header(); ?>

<main id="content" role="main">

   <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
      <header class="sub-hero mb-section">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <h1><?php _e('Contatti', 'howto'); ?></h1>
                  <p><?php _e('Archivio di tutti i contatti utili.', 'howto'); ?></p>
               </div>
            </div>
         </div>
      </header>
   <?php endif; ?>
   
   <div class="page-content">
      <?php if ( have_posts() ) : ?>
         <section class="fbk-cw fbk-cw-contacts container mb-section">
            <div class="row contacts">
               <?php while ( have_posts() ) : the_post();
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
                              <h3><?php the_title(); ?></h3>
                              <?php if ($text) : ?><p class="desc"><?php echo $text; ?></p><?php endif; ?>
                              <?php if ($email) : ?><p><?php echo $email; ?></p><?php endif; ?>
                              <?php if ($tel) : ?><p><?php echo $tel; ?></p><?php endif; ?>
                           </div>
                        </article>
                     </div>

               <?php endwhile; ?>
            </div>
         </section>
      <?php endif; ?>
   </div>

</main>
<?php get_footer();