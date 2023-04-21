<?php
/**
 * Image section
 *
 * @since 1.0.0
 */
class FBK_Elementor_Image extends \Elementor\Widget_Base { 
  
   /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-img';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Immagine', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-bold';
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
		return [ 'img', 'fbk', 'howto' ];
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
				'img_img',
				[
					'label' => esc_html__( 'Immagine', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'media_types' => ['image'],
				]
			);

         $this->add_control(
            'img_caption',
            [
               'label' => esc_html__( 'Descrizione', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'placeholder' => esc_html__( 'Descrizione immagine', 'custom-FBK-widget' ),
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
		$img = $settings['img_img'];
		$caption = $settings['img_caption'];
		
		if ( $img['url'] ) : ?>

			<div class="fbk-cw fbk-cw-singlepost fbk-cw-single fbk-cw-img container">
            <div class="row">
               <div class="col-12">
                  <figure>
                     <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                     <?php if ( $caption ) : ?>
                        <figcaption><?php echo $caption; ?></figcaption>
                     <?php endif; ?>
                  </figure>
               </div>
            </div>
			</div>

      <?php endif;
	}
}