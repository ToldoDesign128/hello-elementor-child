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
		return esc_html__( 'Gruppo di Download', 'custom-FBK-widget' );
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
            'label' => esc_html__( 'Introduzione', 'custom-FBK-widget' ),
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

         $this->add_control(
            'group-download_btn_label',
            [
               'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
               'separator' => 'before',
            ]
         );
 
         $this->add_control(
            'group-download_btn_link',
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
            'group-download_txt',
            [
               'label' => esc_html__( 'Paragrafo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::WYSIWYG,
               'placeholder' => esc_html__( 'Paragrafo di testo', 'custom-FBK-widget' ),
               'label_block' => true,
               'dynamic' => [
                  'active' => true,
               ],
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
               'media_types' => ['image', 'video', 'svg', 'application/pdf']
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
      $btn_label = $settings['group-download_btn_label'];
		if ( ! empty( $settings['group-download_btn_link']['url'] ) ) { $this->add_link_attributes( 'group-download_btn_link', $settings['group-download_btn_link'] ); }

      $text = $settings['group-download_txt'];

		//REPEATER - Lista Download
      $repeater = $settings['group-download_downloads']
		?>

		<section class="fbk-cw fbk-cw-group-download container mb-section <?php if (is_singular('documenti') || is_singular('comunicazioni')) : echo " fbk-cw-single"; endif; ?>">

         <div class="row">
            <div class="col-12">
            <div class="section-header">
                  <div class="content">
                     <p class="overtitle"><?php echo $overtitle; ?></p>
                     <?php if ($title) : 
                        // Slugify the title
                        $slug = preg_replace('~[^\pL\d]+~u', '-', $title);
                        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
                        $slug = preg_replace('~[^-\w]+~', '', $slug);
                        $slug = trim($slug, '-');
                        $slug = preg_replace('~-+~', '-', $slug);
                        $slug = strtolower($slug);
                        ?>
                        <h2 id="<?php echo $slug; ?>"><?php echo $title; ?></h2>
                     <?php endif; ?>
                  </div>
                  <div>
                     <?php if ($btn_label) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'group-download_btn_link' ); ?> class="button button-primary"><?php echo $btn_label; ?><span class="svg-wrapper">
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

         <?php if ( $text ) : ?>
            <div class="row">
               <div class="col-12">
                  <div class="wysiwyg"><?php echo $text; ?></div>
               </div>
            </div>
         <?php endif; ?>

         <?php if ($repeater) : ?>
			   <div class="row download-list">

               <?php foreach ( $repeater as $index => $item ) {
                  $download_label = $repeater[$index]['group-download_downloads_label'];
                  $download_file = $repeater[$index]['group-download_downloads_file'];

                  if ( $download_file['url'] ) { ?>
                     <div class="col-download col-12 col-md-6<?php /*if (!is_singular('documenti')) : echo " col-xl-4"; endif;*/ ?> col-xl-4">

                        <a class="download-card" href="<?php echo $download_file['url']; ?> " target="_blank" rel="noopener noreferrer">
                           <div class="flex-wrapper">
                              <p class="download-card__label">
                                 <span>
                                    <?php if ($download_label) : echo $download_label; 
                                    else: echo basename($download_file['url']); endif; ?>
                                 </span>
                              </p>
                              <div class="svg-wrapper">
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.6719 0.444824V17.4366L19.7749 9.33359L20.8861 10.4448L10.8861 20.4448L0.886108 10.4448L1.99735 9.33359L10.1003 17.4366V0.444824H11.6719Z" fill="#A19E9E"/>
                                 </svg>
                              </div>
                           </div>
                        </a>

                     </div>
                     
                  <?php };
               }; ?>

			   </div>
         <?php endif; ?>
			
		</section>

	<?php
	}
}