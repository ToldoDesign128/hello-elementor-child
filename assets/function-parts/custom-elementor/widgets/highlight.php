<?php
/**
 * Highlight section
 *
 * @since 1.0.0
 */
class FBK_Elementor_Highlight extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-highlight';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FBK Highlight', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box';
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
        'highlight_title',
        [
          'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Titolo della highlight', 'custom-FBK-widget' ),
        ]
      );

      $this->add_control(
        'highlight_text',
        [
          'label' => esc_html__( 'Testo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXTAREA,
          'rows' => 8,
          'placeholder' => esc_html__( 'Testo della highlight', 'custom-FBK-widget' ),
        ]
      );

			$this->add_control(
				'highligh_link_primary',
				[
					'label' => esc_html__( 'Pulsante primario', 'custom-FBK-widget' ),
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
			$this->add_control(
				'highligh_link_secondary',
				[
					'label' => esc_html__( 'Pulsante secondario', 'custom-FBK-widget' ),
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
		$title = $settings['highlight_title'];
		$text = $settings['highlight_text'];
		if ( ! empty( $settings['highligh_link_primary']['url'] ) ) { $this->add_link_attributes( 'highligh_link_primary', $settings['highligh_link_primary'] ); }
		if ( ! empty( $settings['highligh_link_secondary']['url'] ) ) { $this->add_link_attributes( 'highligh_link_secondary', $settings['highligh_link_secondary'] ); }
    ?>


		<section class="fbk-cw fbk-cw-highlight">
      <h1><?php echo $title; ?></h1>
      <p><?php echo $text; ?></p>
			<a <?php echo $this->get_render_attribute_string( 'highligh_link_primary' ); ?>>
				Testo pulsante
			</a>
			<a <?php echo $this->get_render_attribute_string( 'highligh_link_secondary' ); ?>>
				Testo pulsante
			</a>
    </section>

    <?php
	}
}