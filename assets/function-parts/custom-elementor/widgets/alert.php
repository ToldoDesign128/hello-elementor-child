<?php
/**
 * Alert section
 *
 * @since 1.0.0
 */
class FBK_Elementor_Alert extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-alert';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Avviso', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-alert';
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
		return [ 'alert', 'fbk', 'howto' ];
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
            'alert_title',
            [
               'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'placeholder' => esc_html__( 'Titolo avviso', 'custom-FBK-widget' ),
            ]
         );

         $this->add_control(
            'alert_icon',
            [
               'label' => esc_html__( 'Icona', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::CHOOSE,
               'options' => [
                  'info' => [
                     'title' => esc_html__( 'Info', 'custom-FBK-widget' ),
                     'icon' => 'eicon-info',
                  ],
                  'help' => [
                     'title' => esc_html__( 'Help', 'custom-FBK-widget' ),
                     'icon' => 'eicon-help-o',
                  ],
                  'warning' => [
                     'title' => esc_html__( 'Warning', 'custom-FBK-widget' ),
                     'icon' => 'eicon-warning-full',
                  ],
               ],
               'toggle' => true,
            ]
         );

         $this->add_control(
            'alert_text',
            [
               'label' => esc_html__( 'Testo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::WYSIWYG,
               'placeholder' => esc_html__( 'Testo avviso', 'custom-FBK-widget' ),
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
		
      //get input from controls
		$title = $settings['alert_title'];
		$icon = $settings['alert_icon'];
		$text = $settings['alert_text'];
      ?>


		<section class="fbk-cw fbk-cw-alert container <?php if (is_singular('documenti')) : echo " fbk-cw-single"; endif; ?>">
         <div class="row mb-section">
            <div class="col-12">
               <div class="alert-wrapper">
                  <div class="button-wrapper">
                     <button class="close-alert">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M18.8872 0L20.0001 1.11292L11.1138 9.9992L20.0015 18.8869L18.8886 19.9998L10.0009 11.1121L1.11317 19.9998L0.000244141 18.8869L8.88796 9.9992L0.0016851 1.11292L1.11461 0L10.0009 8.88628L18.8872 0Z" fill="#A19E9E"/>
                        </svg>
                     </button>
                  </div>
                  <h3>
                     <?php if ($icon) : ?>
                        <span class="icon-wrapper">
                           <?php if ($icon == 'info') : ?><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1273_4844)"><path d="M11 7H13V9H11V7ZM11 11H13V17H11V11ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="#1254A2"/></g><defs><clipPath id="clip0_1273_4844"><rect width="24" height="24" fill="white"/></clipPath></defs></svg>
                           <?php elseif ($icon == 'help') : ?><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1273_4841)"><path d="M11 18H13V16H11V18ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10H10C10 8.9 10.9 8 12 8C13.1 8 14 8.9 14 10C14 12 11 11.75 11 15H13C13 12.75 16 12.5 16 10C16 7.79 14.21 6 12 6Z" fill="#1254A2"/></g><defs><clipPath id="clip0_1273_4841"><rect width="24" height="24" fill="white"/></clipPath></defs></svg>
                           <?php elseif ($icon == 'warning') : ?><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1270_4832)"><path d="M0.996094 20.9995H22.9961L11.9961 1.99951L0.996094 20.9995ZM12.9961 17.9995H10.9961V15.9995H12.9961V17.9995ZM12.9961 13.9995H10.9961V9.99951H12.9961V13.9995Z" fill="#D70364"/></g><defs><clipPath id="clip0_1270_4832"><rect width="24" height="24" fill="white"/></clipPath></defs></svg><?php endif; ?>
                        </span>
                     <?php endif; ?>
                     <?php echo $title; ?>
                  </h3>
                  <div class="wysiwyg"><?php echo $text; ?></div>
               </div>
            </div>
         </div>
      </section>

      <?php
	}
}