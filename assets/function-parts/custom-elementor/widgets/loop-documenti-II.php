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
      return esc_html__( 'Approfondimenti (livello II)', 'custom-FBK-widget' );
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
            'label' => esc_html__( 'Stampa la lista degli approfondimenti', 'custom-FBK-widget' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
         ]
      );

         $this->add_control(
            'loop-docii_title',
            [
               'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
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

      //Content
		$title = $settings['loop-docii_title'];
		?>

		<section class="fbk-cw fbk-cw-doc-II container mb-section">

         <?php 

            //01 - get Current Page
            $current_page = get_queried_object(); 
            if($current_page): $current_page_ID = $current_page->ID;

            //02 - get Current Parent Page
            $current_parent_page_ID = $current_page->post_parent; endif;

            if ( $current_parent_page_ID == 0 ) : // se la pagina in cui è inserito il widget non è di secondo livello 
               ?>
               <h2>Attenzione!</h2>
               <p>Questo widget <b>"Approfondimenti livello II"</b> è utilizzabile solo nelle pagine di secondo livello.</p>
               <?php
            else :
               $current_parent_page = get_post($current_parent_page_ID);

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
               echo 'ID della PAGINA genitore = ' .  $current_parent_page_ID; ?><br><?php
               $current_parent_page_ID_it = apply_filters( 'wpml_object_id', $current_parent_page_ID, 'post', FALSE, 'it' );
               echo 'ID della PAGINA genitore ITALIANA = ' .  $current_parent_page_ID_it; ?><br><?php
               if (in_array($current_parent_page_ID_it, $parent_pages)) : // se la parent page ha una parent cat assegnata
                  $current_parent_cat = array_search ($current_parent_page_ID_it, $parent_pages);
                  echo 'ID della CATEGORIA genitore = ' .  $current_parent_cat; ?> <br><br><br><?php
               else: ?>
                  <p>
                     <?php echo 'La pagina genitore (in lingua italiana) "' . get_the_title($current_parent_page_ID_it) . '" non è stata assegnata a nessuna categoria.'; ?>
                     <br>
                     <?php echo 'Da Wordpress seleziona Approfondimenti > Categorie >  { nome della categoria }  > Modifica > Assegna pagina > ' . get_the_title($current_parent_page_ID_it); ?>
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
               echo 'ID della PAGINA corrente = ' .  $current_page_ID; ?><br><?php
               $current_page_ID_it = apply_filters( 'wpml_object_id', $current_page_ID, 'post', FALSE, 'it' );
               echo 'ID della PAGINA corrente ITALIANA = ' .  $current_page_ID_it; ?><br><?php
               if (in_array($current_page_ID_it, $current_child_page_IDs)) : // se la current page ha una child cat assegnata
                  $current_parent_cat = array_search ($current_page_ID_it, $current_child_page_IDs);
                  echo 'ID della CATEGORIA = ' .  $current_parent_cat; ?> <br><br><br><?php
               else: ?>
                  <p>
                     <br>
                     <?php echo 'La pagina corrente (in lingua italiana) "' . get_the_title($current_page_ID_it) . '" non è stata assegnata a nessuna categoria.'; ?>
                     <br>
                     <?php echo 'Da Wordpress seleziona Approfondimenti > Categorie >  { nome della categoria }  > Modifica > Assegna pagina > ' . get_the_title($current_page_ID_it); ?>
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

               if ( $wp_query->have_posts() ) : 
                  if ( $title ) :?>
                     <div class="section-header">
                        <h2><?php echo $title; ?></h2>
                     </div>
                  <?php endif; ?>
                  <div class="row docII-loop">
                     <?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
                        $cpt_in_evidenza = get_field('cpt_in_evidenza');
                        $cpt_excerpt = get_field('single_doc_excerpt');
                        ?>
                        <div class="col-card col-12 col-lg-6">

                           <a class="card card-primary" href="<?php the_permalink(); ?>">
                              <span class="svg-wrapper"> 
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                                 </svg>
                              </span>
                              <div class="content">
                                 <?php if ($cpt_in_evidenza) : ?><p class="meta"><span class="label_in_evidenza"><?php _e('in evidenza', 'howto'); ?></span></p><?php endif; ?>
                                 <p class="h3-style"><?php echo the_title(); ?></p>
                                 <?php if ($cpt_excerpt) : ?><p class="excerpt"><?php echo $cpt_excerpt; ?></p><?php endif; ?>
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