<?php get_header(); ?>

   <main id="content" role="main">

      <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
         <header class="sub-hero">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <h1>Pagina non trovata</h1>
                     <p>Errore 404: questa pagina non esiste</p>
                  </div>
               </div>
            </div>
         </header>
      <?php endif; ?>
   </main>

<?php get_footer(); ?>