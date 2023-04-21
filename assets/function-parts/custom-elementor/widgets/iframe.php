<?php
/**
 * iframe section
 *
 * @since 1.0.0
 */
class FBK_Elementor_iframe extends \Elementor\Widget_Base { 
  
   /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-iframe';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'iframe', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code-highlight';
	}

   /**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'fbk-single' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'iframe', 'fbk', 'howto' ];
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

         $this->add_control(
            'iframe',
            [
               'label' => esc_html__( 'iframe', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::CODE,
               'description' => esc_html__( 'Incolla qui l\'iframe da incorporare nella pagina', 'custom-FBK-widget' ),
				   'language' => 'html',
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
		$iframe = $settings['iframe'];
		
		if ( $iframe ) : ?>

			<div class="fbk-cw fbk-cw-singlepost fbk-cw-single fbk-cw-iframe container">
            <div class="row">
               <div class="col-12">
                  <div class="embed-container">
                     <?php echo $iframe; ?>
                  </div>
               </div>
            </div>
			</div>

      <?php endif;
	}
}