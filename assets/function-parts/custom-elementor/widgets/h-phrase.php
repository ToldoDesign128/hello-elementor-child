<?php
/**
 * HighlightedPhrase section
 *
 * @since 1.0.0
 */
class FBK_Elementor_HighlightedPhrase extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-hphrase';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FBK Frase in evidenza', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-pencil';
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
		return [ 'highlight', 'fbk', 'howto' ];
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
        'h-phrase',
        [
          'label' => esc_html__( 'Frase in evidenza', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 20,
					'placeholder' => esc_html__( 'Inserisci la frase in evidenza', 'custom-FBK-widget' ),
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
		$hphrase = $settings['h-phrase'];
		
		if ($hphrase) : ?>
			<p class="h-phrase">
				<span><?php echo $hphrase; ?></span>
			</p>

    <?php endif;
	}
}