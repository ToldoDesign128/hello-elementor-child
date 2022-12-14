<?php
/**
 * FAQ section
 *
 * @since 1.0.0
 */
class FBK_Elementor_FAQ extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-faq';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FBK FAQ', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-help-o';
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
		return [ 'faq', 'fbk', 'howto' ];
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
        'faq_overtitle',
        [
          'label' => esc_html__( 'Sopratitolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Sopratitolo della sezione', 'custom-FBK-widget' ),
        ]
      );

      $this->add_control(
        'faq_title',
        [
          'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
        ]
      );

			$this->add_control(
        'faq_btn_label',
        [
          'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
					'separator' => 'before',
        ]
      );

			$this->add_control(
				'faq_btn_link',
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


		// Lista Link
		$this->start_controls_section(
			'faq_section',
			[
				'label' => esc_html__( 'Domande e Risposte', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			/* Start repeater registration */
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'faq_question',
				[
					'label' => esc_html__( 'Domanda', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Testo della domanda', 'custom-FBK-widget' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'faq_answer',
				[
					'label' => esc_html__( 'Risposta', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'placeholder' => esc_html__( 'Testo della risposta', 'custom-FBK-widget' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);
			/* End repeater registration*/

			/* Start repeater usage*/
			$this->add_control(
				'faqs',
				[
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => "FAQ",
				]
			);
			/* End repeater usage*/

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
		$overtitle = $settings['faq_overtitle'];
		$title = $settings['faq_title'];
		$btn_label = $settings['faq_btn_label'];
		if ( ! empty( $settings['faq_btn_link']['url'] ) ) { $this->add_link_attributes( 'faq_btn_link', $settings['faq_btn_link'] ); }

		//REPEATER - Lista Link
    $repeater = $settings['faqs']
		?>


		<section class="fbk-cw fbk-cw-faq">

			<div class="section-header">
				<p><?php echo $overtitle; ?></p>
				<h2><?php echo $title; ?></h2>
				<a <?php echo $this->get_render_attribute_string( 'faq_btn_link' ); ?>>
					<?php echo $btn_label; ?>
				</a>
			</div>
      
			<div class="faqs">

				<?php foreach ( $repeater as $index => $item ) {
					$question = $repeater[$index]['faq_question'];
					$answer = $repeater[$index]['faq_answer'];
					?>

						<div class="single_faq">
							<div class="question">
								<p><?php echo $question; ?></p>
							</div>
							<div class="answer">
								<p><?php echo $answer; ?></p>
							</div>
						</div>
						
					<?php
				}; ?>

			</div>

    </section>

    <?php
	}
}