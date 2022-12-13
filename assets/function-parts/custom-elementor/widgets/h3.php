<?php
/**
 * HeadingThree section
 *
 * @since 1.0.0
 */
class FBK_Elementor_HeadingThree extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-h3';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FBK Titolo h3', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-heading';
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
		return [ 'heading', 'fbk', 'howto' ];
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
        'h3_title',
        [
          'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
        ]
      );

			$this->add_control(
				'h3_img',
				[
					'label' => esc_html__( 'Icona', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'description' => esc_html__( 'Dimensione immagine consigliata: 40x40px', 'custom-FBK-widget' ),
					'media_types' => ['image', 'svg'],
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
		$title = $settings['h3_title'];
		$icon = $settings['h3_img'];
		
		if ( $icon['url'] ) : ?>
			<div id="<?php echo $title; ?>">
				<figure class="icon-wrapper">
					<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
				</figure>
				<h3><?php echo $title; ?></h3>
			</div>
		<?php else : ?>
			<h3 id="<?php echo $title; ?>"><?php echo $title; ?></h3>
    <?php endif;
	}
}