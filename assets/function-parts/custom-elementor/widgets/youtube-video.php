<?php
/**
 * YoutubeVideo section
 *
 * @since 1.0.0
 */
class FBK_Elementor_YoutubeVideo extends \Elementor\Widget_Base { 
  
   /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-youtube-video';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FBK Youtube Video', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-youtube';
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
		return [ 'youtube video', 'fbk', 'howto' ];
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
               'label' => esc_html__( 'Youtube iframe', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::CODE,
               'description' => esc_html__( 'Incolla qui l\'iframe del video youtube che trovi in Condividi > Incorpora > Copia', 'custom-FBK-widget' ),
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
		
		if ( $iframe ) : 
         // Use preg_match to find iframe src.
         preg_match('/src="(.+?)"/', $iframe, $matches);
         $src = $matches[1];
         // Add extra parameters to src and replace HTML.
         $params = array(
            'controls'  => 0,
            'hd'        => 1,
            'autohide'  => 1
         );
         $new_src = add_query_arg($params, $src);
         $iframe = str_replace($src, $new_src, $iframe);
         // Add extra attributes to iframe HTML.
         $attributes = 'frameborder="0"';
         $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
         ?>

			<div class="fbk-cw fbk-cw-single fbk-cw-youtube-video container">
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