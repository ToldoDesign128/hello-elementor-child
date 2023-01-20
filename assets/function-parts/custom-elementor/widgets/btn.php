<?php
/**
 * Button section
 *
 * @since 1.0.0
 */
class FBK_Elementor_Button extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-btn';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Pulsanti', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-dual-button';
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
		return [ 'intro', 'fbk', 'howto' ];
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
				'label' => esc_html__( 'Pulsante Primario', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

      $this->add_control(
        'button-p_btn_label',
         [
            'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
            'separator' => 'before',
         ]
      );

      $this->add_control(
         'button-p_btn_link',
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

      $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Pulsante Secondario', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

      $this->add_control(
        'button-s_btn_label',
         [
            'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
            'separator' => 'before',
         ]
      );

      $this->add_control(
         'button-s_btn_link',
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
		$btn_label = $settings['button-p_btn_label'];
		if ( ! empty( $settings['button-p_btn_link']['url'] ) ) { $this->add_link_attributes( 'button-p_btn_link', $settings['button-p_btn_link'] ); }

		$btns_label = $settings['button-s_btn_label'];
		if ( ! empty( $settings['button-s_btn_link']['url'] ) ) { $this->add_link_attributes( 'button-s_btn_link', $settings['button-s_btn_link'] ); }
		?>

		<section class="fbk-cw fbk-cw-single fbk-cw-btn container">
         <div class="row">
            <div class="col-12">
               <div class="btns-wrapper">
                  <?php if ($btn_label) : ?>
                     <a <?php echo $this->get_render_attribute_string( 'button-p_btn_link' ); ?> class="button button-primary"><?php echo $btn_label; ?><span class="svg-wrapper">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7239 3.33333H2.66672V2H14V13.3333H12.6667V4.27614L3.13812 13.8047L2.19531 12.8619L11.7239 3.33333Z" fill="white"/>
                           </svg>
                        </span>
                     </a>
                  <?php endif; ?>
                  <?php if ($btns_label) : ?>
                     <a <?php echo $this->get_render_attribute_string( 'button-s_btn_link' ); ?> class="button button-secondary"><?php echo $btns_label; ?><span class="svg-wrapper">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7239 3.33333H2.66672V2H14V13.3333H12.6667V4.27614L3.13812 13.8047L2.19531 12.8619L11.7239 3.33333Z" fill="white"/>
                           </svg>
                        </span>
                     </a>
                  <?php endif; ?>
               </div>
            </div>
         </div>
		</section>
		
			

	<?php
	}
}