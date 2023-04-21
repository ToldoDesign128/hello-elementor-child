<?php
/**
 * Paragraph section
 *
 * @since 1.0.0
 */
class FBK_Elementor_Paragraph extends \Elementor\Widget_Base { 
  
   /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-p';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Paragrafo', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-editor-paragraph';
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
		return [ 'paragraph', 'fbk', 'howto' ];
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
            'p_txt',
            [
               'label' => esc_html__( 'Paragrafo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::WYSIWYG,
               'placeholder' => esc_html__( 'Paragrafo di testo', 'custom-FBK-widget' ),
               'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
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
		$text = $settings['p_txt'];
		
		if ( $text ) : ?>
         <div class="fbk-cw fbk-cw-singlepost fbk-cw-single fbk-p container">
            <div class="row">
               <div class="col-12">
                  <div class="wysiwyg"><?php echo $text; ?></div>
               </div>
            </div>
         </div>
      <?php endif;
	}
}