<?php
/**
 * DocumentiII section
 *
 * @since 1.0.0
 */
class FBK_Elementor_LoopDocumentiII extends \Elementor\Widget_Base { 

   /**
    * Get widget name.
    *
    * @since 1.0.0
    * @access public
    * @return string Widget name.
    */
   public function get_name() {
      return 'fbk-loop-documenti-II';
   }

   /**
    * Get widget title.
    *
    * @since 1.0.0
    * @access public
    * @return string Widget title.
    */
   public function get_title() {
      return esc_html__( 'Documenti livello II', 'custom-FBK-widget' );
   }

   /**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-document-file';
	}

   /**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'fbk-loops' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'documenti II', 'fbk', 'howto' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
      $this->start_controls_section(
         'content_section',
         [
            'label' => esc_html__( 'Stampa la lista dei documenti', 'custom-FBK-widget' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
         ]
      );

		$this->end_controls_section();
	}

	//Remove tab Avanzato
	public function get_stack( $with_common_controls = true ) {
		return parent::get_stack( false );
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
      $cpt_tax = 'documenti_tax';
		?>

		<section class="fbk-cw fbk-cw-doc-II container mb-section">

         <?php 

            //01 - get Current Page
            $current_page = get_queried_object(); 
            $current_page_ID = $current_page->ID;

            //02 - get Current Parent Page
            $current_parent_page_ID = $current_page->post_parent;
            $current_parent_page = get_post($current_parent_page_ID);


            if ( $current_parent_page_ID == 0 ) : // se la pagina in cui è inserito il widget non è di secondo livello 
               ?>
               <h2>Attenzione!</h2>
               <p>Questo widget <b>"Documenti livello II"</b> è utilizzabile solo nelle pagine di secondo livello.</p>
               <?php
            else :

               //03 - match IDs of Parent Cats with Parent Pages
               $parent_pages = array();
               $parent_cats = get_terms( array(
                  'taxonomy' => 'documenti_tax',
                  'parent' => 0, //only parent cat
                  'hide_empty' => true, //only parent cat with at least one post
               ) );
               foreach ( $parent_cats as $key => $parent_cat ) {
                  $parent_cat_page = get_field('child_cat_page', $parent_cat);
                  $parent_pages[$parent_cat->term_id] = $parent_cat_page;
               }

               //04 - get ID of Current Parent Category
               if (in_array($current_parent_page_ID, $parent_pages)) : // se la parent page ha una parent cat assegnata
                  $current_parent_cat = array_search ($current_parent_page_ID, $parent_pages);
               else: ?>
                  <p>
                     <?php echo 'La pagina genitore "' . $current_parent_page->post_title . '" non è stata assegnata a nessuna categoria.'; ?>
                     <br>
                     <?php echo 'Da Wordpress seleziona Documenti > Categorie >  { nome della categoria }  > Modifica > Assegna pagina > ' . $current_parent_page->post_title; ?>
                  </p>
                  <?php
               endif;

               //05 - match IDs of Child Cats with Child Pages 
               $cat_children_id = get_term_children($current_parent_cat, $cpt_tax); //array con solo i child cat della current parent cat
               $current_child_page_IDs = array();
               foreach ( $cat_children_id as $cat_child ) {
                  $cat_child_term = get_term_by( 'id', $cat_child, $cpt_tax);
                  $child_cat_page = get_field('child_cat_page', $cat_child_term);
                  $current_child_page_IDs[$cat_child_term->term_id] = $child_cat_page;
               }

               //06 - get ID of Current Child Category
               if (in_array($current_page_ID, $current_child_page_IDs)) : // se la current page ha una child cat assegnata
                  $current_parent_cat = array_search ($current_page_ID, $current_child_page_IDs);
               else: ?>
                  <p>
                     <br>
                     <?php echo 'La pagina corrente "' . $current_page->post_title . '" non è stata assegnata a nessuna categoria.'; ?>
                     <br>
                     <?php echo 'Da Wordpress seleziona Documenti > Categorie >  { nome della categoria }  > Modifica > Assegna pagina > ' . $current_page->post_title; ?>
                  </p>
                  <?php
               endif;

               // Loop di tutti i doc della Current Child Category
               $args = array(
                  'post_status'     =>    'publish',
                  'post_type'       =>    'documenti',
                  'posts_per_page'  =>    -1,
                  'tax_query'       =>    array(
                     array(
                        'taxonomy'           =>    $cpt_tax,
                        'field'              =>    'term_id',
                        'terms'              =>    $current_parent_cat,
                        'operator'           =>    'IN',
                     ),
                  ),
               );
               $wp_query = new WP_Query( $args );

               if ( $wp_query->have_posts() ) : ?>
                  <div class="section-header">
                     <h2>Documenti</h2>
                  </div>
                  <div class="row docII-loop">
                     <?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
                        $cpt_in_evidenza = get_field('cpt_in_evidenza');
                        ?>
                        <div class="col-card col-12 col-lg-6">

                           <a class="card card-primary" href="<?php the_permalink(); ?>">
                              <span class="svg-wrapper">
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                                 </svg>
                              </span>
                              <div class="content">
                                 <?php if ($cpt_in_evidenza) : ?><p class="meta"><span class="label_in_evidenza">in evidenza</span></p><?php endif; ?>
                                 <p class="h3-style"><?php echo the_title(); ?></p>
                                 <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                              </div>
                           </a>

                        </div>
                     <?php endwhile; wp_reset_postdata(); ?>
                  </div>
               <?php endif;

            endif;
         ?>

      </section>

	<?php
	}
}