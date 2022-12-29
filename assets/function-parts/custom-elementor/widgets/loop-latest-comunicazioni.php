<?php
/**
 * Comunicazioni section
 *
 * @since 1.0.0
 */
class FBK_Elementor_LoopComunicazioni extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-loop-comunicazioni';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Comunicazioni recenti', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-commenting-o';
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
		return [ 'comunicazioni', 'fbk', 'howto' ];
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
				'label' => esc_html__( 'Content', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

      $this->add_control(
        'loop-comunicazioni_overtitle',
        [
          'label' => esc_html__( 'Sopratitolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Sopratitolo della sezione', 'custom-FBK-widget' ),
        ]
      );

      $this->add_control(
        'loop-comunicazioni_title',
        [
          'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
        ]
      );

      $this->add_control(
        'loop-comunicazioni_btn_label',
        [
          'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
					'separator' => 'before',
        ]
      );

      $this->add_control(
         'loop-comunicazioni_btn_link',
         [
            'label' => esc_html__( 'Pulsante — Link', 'custom-FBK-widget' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'custom-FBK-widget' ),
            'options' => [ 'url', 'is_external', 'nofollow' ],
            'default' => [
               'url' => '',
               'is_external' => false,
               'nofollow' => false,
            ],
            'label_block' => true,
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

		//Content
		$overtitle = $settings['loop-comunicazioni_overtitle'];
		$title = $settings['loop-comunicazioni_title'];
		$btn_label = $settings['loop-comunicazioni_btn_label'];
		if ( ! empty( $settings['loop-comunicazioni_btn_link']['url'] ) ) { $this->add_link_attributes( 'loop-comunicazioni_btn_link', $settings['loop-comunicazioni_btn_link'] ); }

		?>

		<section class="fbk-cw fbk-cw-group-link container mb-section">

			<div class="section-header">
            <div class="content">
               <p class="overtitle"><?php echo $overtitle; ?></p>
               <h2><?php echo $title; ?></h2>
            </div>
            <div>
               <?php if ($btn_label) : ?>
                  <a <?php echo $this->get_render_attribute_string( 'loop-comunicazioni_btn_link' ); ?> class="button button-primary"><?php echo $btn_label; ?><span class="svg-wrapper">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7239 3.33333H2.66672V2H14V13.3333H12.6667V4.27614L3.13812 13.8047L2.19531 12.8619L11.7239 3.33333Z" fill="white"/>
                        </svg>
                     </span>
                  </a>
               <?php endif; ?>
            </div>
			</div>

			<?php $query_args = array(
            'post_status'     =>    'publish',
            'orderby'         =>    'date',
            'order'           =>    'DESC',
            'post_type'       =>    'comunicazioni',
            'posts_per_page'  =>    4,
         );
         $the_comunicazioni_query = new WP_Query( $query_args );
         if ( $the_comunicazioni_query->have_posts() ) : ?>
            <div class="row latest-loop">
               <?php while ( $the_comunicazioni_query->have_posts() ) : $the_comunicazioni_query->the_post(); 
                  $cpt_in_evidenza = get_field('cpt_in_evidenza');
                  $cpt_comunicazioni_taxonomy = get_field('cpt_comunicazioni_taxonomy');

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
                              <?php if ($cpt_in_evidenza) : ?><span class="label_in_evidenza">in evidenza</span><?php endif; ?>
                           </p>
                           <p class="h3-style"><?php echo the_title(); ?></p>
                           <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                        </div>
                     </a>

                  </div>
               <?php endwhile; wp_reset_postdata(); ?>
            </div>
         <?php endif; ?>

		</section>
		
			

	<?php
	}
}