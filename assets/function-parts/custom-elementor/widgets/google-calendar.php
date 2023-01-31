<?php
/**
 * GoogleCalendar section
 *
 * @since 1.0.0
 */
class FBK_Elementor_GoogleCalendar extends \Elementor\Widget_Base { 
  
   /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-google_calendar';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Google Calendar API', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-calendar';
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
		return [ 'google calendar', 'fbk', 'howto' ];
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
        'gcalendar_overtitle',
        [
          'label' => esc_html__( 'Sopratitolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Sopratitolo della sezione', 'custom-FBK-widget' ),
        ]
      );

      $this->add_control(
        'gcalendar_title',
        [
          'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
        ]
      );

      $this->add_control(
         'gcalendar_btn_label',
         [
            'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
            'separator' => 'before',
         ]
      );

			$this->add_control(
            'gcalendar_btn_link',
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

			/*$this->add_control(
         'gcalendar_iframe',
            [
               'label' => esc_html__( 'iFrame', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'row' => 6,
               'placeholder' => esc_html__( 'Inserisci iframe del Google Calendar', 'custom-FBK-widget' ),
               'separator' => 'before',
               'description' =>  '
                  <ol>
                     <li><b>#1</b> Open Google Calendar. In the top right, click Settings icon and then Settings.</li>
                     <li><b>#2</b> On the left side of the screen, click the name of the calendar you want to embed.</li>
                     <li><b>#3</b> In the “Integrate this calendar” section, hit customize button.</li>
                     <li><b>#4</b> Uncheck all the options, then copy the IFRAME code displayed.</li>
                     <li><b>#5</b> Make sure your embedded calendar is set as public.</li>
                     <li><b>#6</b> Paste the iframe here.</li>
                  </ol>
               ', 'custom-FBK-widget' ,
            ]
         );*/

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
		$overtitle = $settings['gcalendar_overtitle'];
		$title = $settings['gcalendar_title'];
		$btn_label = $settings['gcalendar_btn_label'];
		if ( ! empty( $settings['gcalendar_btn_link']['url'] ) ) { $this->add_link_attributes( 'gcalendar_btn_link', $settings['gcalendar_btn_link'] ); }
		
		$iframe = $settings['gcalendar_iframe'];

      if ( !is_singular('documenti') ) : ?>

         <section class="fbk-cw fbk-cw-group-link container mb-section">

            <div class="section-header">
               <div class="content">
                  <p class="overtitle"><?php echo $overtitle; ?></p>
                  <h2><?php echo $title; ?></h2>
               </div>
               <div>
                  <?php if ($btn_label) : ?>
                     <a <?php echo $this->get_render_attribute_string( 'gcalendar_btn_link' ); ?> class="button button-primary"><?php echo $btn_label; ?><span class="svg-wrapper">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7239 3.33333H2.66672V2H14V13.3333H12.6667V4.27614L3.13812 13.8047L2.19531 12.8619L11.7239 3.33333Z" fill="white"/>
                           </svg>
                        </span>
                     </a>
                  <?php endif; ?>
               </div>
            </div>
         
            <div class="link-list">
               <div class="row">
                  <?php dynamic_sidebar( 'gc-widget' ); ?>
               </div>
            </div>

         </section>
      
      <?php else : ?>
         <div class="container mb-section">
            <div class="row">
               <div class="col-12">
                  <h2>Attenzione!</h2>
                  <p>Questo widget <b>"FBK Google Calendar"</b> non è utilizzabile nei documenti.</p>
               </div>
            </div>
         </div>
		<?php endif; ?>

      <?php
	}
}