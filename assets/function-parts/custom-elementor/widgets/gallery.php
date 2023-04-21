<?php
/**
 * Gallery section
 *
 * @since 1.0.0
 */
class FBK_Elementor_Gallery extends \Elementor\Widget_Base { 
  
   /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-gallery';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Galleria immagini', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
		return [ 'gallery', 'fbk', 'howto' ];
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
				'gallery',
				[
					'label' => esc_html__( 'Galleria immagini', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::GALLERY,
					'default' => [],
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
		$gallery = $settings['gallery'];
		
		if ( !empty($gallery) ) : ?>

			<div class="fbk-cw fbk-cw-singlepost fbk-cw-gallery container<?php if (is_singular('documenti') || is_singular('comunicazioni')) : echo " fbk-cw-single"; endif; ?>">
            <div class="row">
               
               <?php foreach ($gallery as $img) : ?>
                  <div class="col-6 col-md-4<?php /*if (!is_singular('documenti')) : echo " col-xl-3"; endif;*/ ?> col-xl-3">
                     <figure class="gallery-item">
                        <a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="3f43f85" href="<?php echo $img['url']; ?>">
                           <img src="<?php echo $img['url']; ?>" alt="galleria immagini FBK">
                        </a>
                     </figure>
                  </div>
               <?php endforeach; ?>

            </div>
			</div>

      <?php endif;
	}
}