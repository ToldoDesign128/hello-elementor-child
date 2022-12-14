<?php
/**
 * Group Download section
 *
 * @since 1.0.0
 */
class FBK_Elementor_GroupDownload extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-group-download';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FBK Group Download', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-file-download';
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
		return [ 'group download', 'fbk', 'howto' ];
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
        'group-download_overtitle',
        [
          'label' => esc_html__( 'Sopratitolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Sopratitolo della sezione', 'custom-FBK-widget' ),
        ]
      );

      $this->add_control(
        'group-download_title',
        [
          'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
        ]
      );

		$this->end_controls_section();


		// Lista Download
		$this->start_controls_section(
			'downloads_section',
			[
				'label' => esc_html__( 'Lista Download', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			/* Start repeater registration */
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'group-download_downloads_label',
				[
					'label' => esc_html__( 'Titolo file', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Testo della pulsante', 'custom-FBK-widget' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'group-download_downloads_file',
				[
					'label' => esc_html__( 'File da scaricare', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);
			/* End repeater registration*/

			/* Start repeater usage*/
			$this->add_control(
				'group-download_downloads',
				[
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => "Download",
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
		$overtitle = $settings['group-download_overtitle'];
		$title = $settings['group-download_title'];

		//REPEATER - Lista Download
    $repeater = $settings['group-download_downloads']
		?>

		<section class="fbk-cw fbk-cw-group-download">

			<div class="section-header">
				<p><?php echo $overtitle; ?></p>
				<h2><?php echo $title; ?></h2>
			</div>

			<div class="download-list">

				<?php foreach ( $repeater as $index => $item ) {
					$download_label = $repeater[$index]['group-download_downloads_label'];
					$download_file = $repeater[$index]['group-download_downloads_file'];
					
					//IF il campo Download non è vuoto
					if ( $download_file['url'] ) {
						?>

						<a class="download-card" href="<?php echo $download_file['url']; ?> " target="_blank" rel="noopener noreferrer">
							<p class="download-card__label">
								<?php echo $download_label; ?>
							</p>
						</a>
						
						<?php
					};
				}; ?>

			</div>
			
		</section>
		
			

	<?php
	}
}