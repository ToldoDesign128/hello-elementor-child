<?php
/**
 * DocumentiI section
 *
 * @since 1.0.0
 */
class FBK_Elementor_LoopDocumentiI extends \Elementor\Widget_Base { 

  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-loop-documenti-I';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Approfondimenti (livello I)', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-folder-o';
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
		return [ 'documenti I', 'fbk', 'howto' ];
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
				'label' => esc_html__( 'Contenuto', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


      $options = array();
      $parent_cats = get_terms( array(
         'taxonomy' => 'documenti_tax',
         'parent' => 0, //only parent cat
         'hide_empty' => true, //only parent cat with at least one post
      ) );
      foreach ( $parent_cats as $key => $parent_cat ) {
         $options[$parent_cat->term_id] = $parent_cat->name;
      }
      $this->add_control(
         'selected_cat',
         [
            'label' => esc_html__( 'Categoria Approfondimenti', 'custom-FBK-widget' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'description' => esc_html__( 'Seleziona la categoria di approfondimenti da visualizzare' ),
            'options' => $options,
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
		$selected_cat_id = $settings['selected_cat'];

      if ( !is_singular( array( 'documenti', 'comunicazioni' ) ) ) : ?>
      
         <section class="fbk-cw fbk-cw-doc-I container mb-section">

            <?php $cat_children_id = get_term_children($selected_cat_id, $cpt_tax); //array con solo i child cat della parent cat selezionata
            if (sizeof($cat_children_id) > 0) : // solo se la parent cat selezionata ha dei children
               ?>
               <div class="row with-child-loop">
            
                  <?php foreach ( $cat_children_id as $cat_child ) :
                     $cat_child_term = get_term_by( 'id', $cat_child, $cpt_tax);
                     if ( $cat_child_term->count > 0 ) : //solo se la child cat ha almeno un doc assegnato
                        $child_cat_page = get_field('child_cat_page', $cat_child_term);
                        ?>

                        <div class="col-child-card">
                           <div class="child-card-wrapper">

                              <article class="child-card">
                                 <a class="head" <?php if ($child_cat_page) : ?>href="<?php echo get_permalink( $child_cat_page ); ?>"<?php endif; ?>>
                                    <h3><?php echo get_the_title( $child_cat_page ); ?></h3>
                                    <?php if ($child_cat_page) : ?>
                                       <span class="svg-wrapper">
                                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                                          </svg>
                                       </span>
                                    <?php endif; ?>
                                 </a>
      
                                 <?php $args = array( // loop di tutti i doc della child cat
                                    'post_status'     =>    'publish',
                                    'post_type'       =>    'documenti',
                                    'posts_per_page'  =>    -1,
                                    'tax_query'       =>    array(
                                       array(
                                          'taxonomy'           =>    $cpt_tax,
                                          'field'              =>    'term_id',
                                          'terms'              =>    $cat_child_term->term_id,
                                          'operator'           =>    'IN',
                                       ),
                                    ),
                                 );
                                 $with_child_query = new WP_Query( $args );
      
                                 if ( $with_child_query->have_posts() ) : ?>
                                    <div class="content">
                                       <?php while ( $with_child_query->have_posts() ) : $with_child_query->the_post(); ?>
                                          <a class="child-card-post" href="<?php the_permalink(); ?>">
                                             <span>
                                                <h4><?php echo the_title(); ?></h4>
                                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4934 1.46834H0.519136V0H13V12.4809H11.5317V2.50661L1.03827 13L0 11.9617L10.4934 1.46834Z" fill="#A19E9E"/>
                                                </svg>
                                             </span>
                                          </a>
                                       <?php endwhile; wp_reset_postdata(); ?>
                                    </div>
                                 <?php endif; ?>
      
                              </article>
                           </div>
                        </div>

                        <?php
                     endif;
                  endforeach; ?>
               
               </div>
            <?php endif; ?>
               
            <!-- Docs con solo categorie genitore -->
            <?php $args = array(
                  'post_status'     =>    'publish',
                  'post_type'       =>    'documenti',
                  'posts_per_page'  =>    -1,
                  'tax_query'       =>    array(
                     'relation' => 'AND',
                     array(
                        'taxonomy'           =>    $cpt_tax,
                        'field'              =>    'term_id',
                        'terms'              =>    $selected_cat_id,
                        'operator'           =>    'IN',
                     ),
                     array(
                        'taxonomy'           =>    $cpt_tax,
                        'field'              =>    'term_id',
                        'terms'              =>    $cat_children_id,
                        'operator'           =>    'NOT IN',
                     ),
                  ), 
               );
               $without_child_query = new WP_Query( $args );

               if ( $without_child_query->have_posts() ) : ?>
                  <div class="row">
                     <?php while ( $without_child_query->have_posts() ) : $without_child_query->the_post(); ?>
                        <div class="col-card col-6 col-lg-3">

                           <a class="card card-secondary" href="<?php echo the_permalink() ?>">
                              <span class="svg-wrapper">
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                                 </svg>
                              </span>
                              <p class="h3-style"><?php echo the_title() ?></p>
                           </a>
                        </div>
                     <?php endwhile; wp_reset_postdata(); ?>
                  </div>
               <?php endif; ?>
         
         </section>
		
      <?php else : ?>
         <div class="container mb-section">
            <div class="row">
               <div class="col-12">
                  <h2>Attenzione!</h2>
                  <p>Questo widget <b>"Approfondimenti livello I"</b> non è utilizzabile nelle pagine singole di approfondimenti e comunicazioni.</p>
               </div>
            </div>
         </div>
		<?php endif; ?>

	<?php
	}
}