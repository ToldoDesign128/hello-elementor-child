<?php
/**
 * ImageText section
 *
 * @since 1.0.0
 */
class FBK_Elementor_ImageText extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-imgtxt';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Testo e immagine', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-box';
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
		return [ 'htesto e immagine', 'fbk', 'howto' ];
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
            'imgtxt_img',
            [
               'label' => esc_html__( 'Immagine', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::MEDIA,
               'media_types' => ['image'],
            ]
         );

         $this->add_control(
            'imgtxt_title',
            [
               'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
               'separator' => 'before',
            ]
         );

         $this->add_control(
            'imgtxt_text',
            [
               'label' => esc_html__( 'Testo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::WYSIWYG,
               'placeholder' => esc_html__( 'Paragrafo di testo', 'custom-FBK-widget' ),
               'label_block' => true,
               'dynamic' => [
                  'active' => true,
               ],
            ]
         );

         $this->add_control(
            'imgtxt_btn_label',
             [
                'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
                'separator' => 'before',
             ]
          );
    
          $this->add_control(
             'imgtxt_btn_link',
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

         $this->add_control(
            'imgtxt_position',
            [
               'label' => esc_html__( 'Posizione immagine', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => 'img-s',
               'options' => [
                  'img-s' => esc_html__( 'Sinistra', 'custom-FBK-widget' ),
                  'img-d' => esc_html__( 'Destra', 'custom-FBK-widget' ),
               ],
               'separator' => 'before',
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
      $img = $settings['imgtxt_img'];
      $title = $settings['imgtxt_title'];
      $text = $settings['imgtxt_text'];
      $btn_label = $settings['imgtxt_btn_label'];
		if ( ! empty( $settings['imgtxt_btn_link']['url'] ) ) { $this->add_link_attributes( 'imgtxt_btn_link', $settings['imgtxt_btn_link'] ); }
      $position = $settings['imgtxt_position'];
		
		if ($position) : ?>
         <div class="fbk-cw fbk-cw-singlepost fbk-cw-single fbk-imgtxt container <?php echo $position; ?>">
            <div class="row">
               <?php if ( $img['url'] ) : ?>
                  <div class="col-12 col-lg-6 <?php if ($position == 'img-d') : echo 'order-lg-last'; endif;?>">
                     <div class="content">
                        <figure>
                           <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                        </figure>
                     </div>
                  </div>
               <?php endif; ?>
               <div class="col-12 col-lg-6">
                  <div class="content">
                     <?php if ( $title ) : ?>
                        <h2 class="h-title">
                           <?php echo $title; ?>
                        </h2>
                     <?php endif;
                     if ( $text ) : ?>
                        <div class="wysiwyg"><?php echo $text; ?></div>
                     <?php endif;
                     if ($btn_label) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'imgtxt_btn_link' ); ?> class="button button-primary"><?php echo $btn_label; ?><span class="svg-wrapper">
                              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7239 3.33333H2.66672V2H14V13.3333H12.6667V4.27614L3.13812 13.8047L2.19531 12.8619L11.7239 3.33333Z" fill="white"/>
                              </svg>
                           </span>
                        </a>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      <?php endif;
	}
}