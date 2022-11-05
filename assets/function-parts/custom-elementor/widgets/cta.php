<?php
/**
 * CTA section
 *
 * @since 1.0.0
 */
class FBK_Elementor_CTA extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-cta';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FBK CTA', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

  /**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'fbk-pages' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'cta', 'fbk', 'howto' ];
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
        'cta_text',
        [
          'label' => esc_html__( 'Testo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXTAREA,
          'rows' => 3,
          'placeholder' => esc_html__( 'Testo della cta', 'custom-FBK-widget' ),
        ]
      );

			$this->add_control(
				'highligh_link',
				[
					'label' => esc_html__( 'Pulsante', 'custom-FBK-widget' ),
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
		
    //get input from controls
		$title = $settings['cta_title'];
		$text = $settings['cta_text'];
		if ( ! empty( $settings['highligh_link']['url'] ) ) { $this->add_link_attributes( 'highligh_link', $settings['highligh_link'] ); }
    ?>


		<section class="fbk-cw fbk-cw-cta">
      <p><?php echo $text; ?></p>
			<a <?php echo $this->get_render_attribute_string( 'highligh_link' ); ?>>
				Testo pulsante
			</a>
    </section>

    <?php
	}
}