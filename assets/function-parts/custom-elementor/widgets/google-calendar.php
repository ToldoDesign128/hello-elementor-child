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
		return esc_html__( 'FBK Google Calendar', 'custom-FBK-widget' );
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
				'label' => esc_html__( 'Content', 'custom-FBK-widget' ),
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

			$this->add_control(
        'gcalendar_iframe',
        [
          'label' => esc_html__( 'iFrame', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXTAREA,
					'row' => 6,
          'default' => esc_html__( 'Inserisci iframe del Google Calendar', 'custom-FBK-widget' ),
					'separator' => 'before',
          'description' =>  '
						<ol>
							<li><b>#1</b> Open Google Calendar. In the top right, click Settings Settings and then Settings.</li>
							<li><b>#2</b> On the left side of the screen, click the name of the calendar you want to embed.</li>
							<li><b>#3</b> In the “Integrate this calendar” section, copy the iframe code displayed.</li>
							<li><b>#4</b> Choose your options, then copy the HTML code displayed.</li>
							<li><b>#5</b> Make sure your embedded calendar is set as public.</li>
							<li><b>#6</b> Paste the iframe here.</li>
						</ol>
					', 'custom-FBK-widget' ,
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
		$overtitle = $settings['gcalendar_overtitle'];
		$title = $settings['gcalendar_title'];
		$btn_label = $settings['gcalendar_btn_label'];
		if ( ! empty( $settings['gcalendar_btn_link']['url'] ) ) { $this->add_link_attributes( 'gcalendar_btn_link', $settings['gcalendar_btn_link'] ); }
		
		$iframe = $settings['gcalendar_iframe'];
		?>


		<section class="fbk-cw fbk-cw-gcalendar">

			<div class="section-header">
				<p><?php echo $overtitle; ?></p>
				<h2><?php echo $title; ?></h2>
				<a <?php echo $this->get_render_attribute_string( 'gcalendar_btn_link' ); ?>>
					<?php echo $btn_label; ?>
				</a>
			</div>
      
			<div class="gcalendar">
				<?php echo $iframe; ?>
			</div>

    </section>

    <?php
	}
}