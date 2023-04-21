<?php
/**
 * Group Link section
 *
 * @since 1.0.0
 */
class FBK_Elementor_GroupLink extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-group-link';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Gruppo di Link', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-chain-broken';
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
		return [ 'group link', 'fbk', 'howto' ];
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
        'group-link_overtitle',
         [
            'label' => esc_html__( 'Sopratitolo', 'custom-FBK-widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Sopratitolo della sezione', 'custom-FBK-widget' ),
         ]
      );

      $this->add_control(
        'group-link_title',
         [
            'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
         ]
      );

      $this->add_control(
        'group-link_btn_label',
         [
            'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
            'separator' => 'before',
         ]
      );

      $this->add_control(
         'group-link_btn_link',
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
         'group-link_txt',
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


		// Lista Link
		$this->start_controls_section(
			'links_section',
			[
				'label' => esc_html__( 'Lista Link', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

      /* Start repeater registration */
      $repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'group-link_links_label',
				[
					'label' => esc_html__( 'Testo', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Testo della pulsante', 'custom-FBK-widget' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'group-link_links_link',
				[
					'label' => esc_html__( 'Link', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'custom-FBK-widget' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'dynamic' => [
						'active' => true,
					],
				]
			);

      /* End repeater registration*/

      /* Start repeater usage*/
      $this->add_control(
         'group-link_links',
         [
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => "Link",
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
		$overtitle = $settings['group-link_overtitle'];
		$title = $settings['group-link_title'];
		$btn_label = $settings['group-link_btn_label'];
		if ( ! empty( $settings['group-link_btn_link']['url'] ) ) { $this->add_link_attributes( 'group-link_btn_link', $settings['group-link_btn_link'] ); }

      $text = $settings['group-link_txt'];

		//REPEATER - Lista Link
      $repeater = $settings['group-link_links']
		?>

		<section class="fbk-cw fbk-cw-pages fbk-cw-group-link container mb-section<?php if (is_singular('documenti') || is_singular('comunicazioni')) : echo " fbk-cw-single"; endif; ?>">

         <div class="row">
            <div class="col-12">
               <div class="section-header">
                  <div class="content">
                     <?php if ($overtitle) : ?><p class="overtitle"><?php echo $overtitle; ?></p><?php endif; ?>
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
                        <a <?php echo $this->get_render_attribute_string( 'group-link_btn_link' ); ?> class="button button-primary"><?php echo $btn_label; ?><span class="svg-wrapper">
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

			<div class="link-list">
            <div class="row">

               <?php foreach ( $repeater as $index => $item ) {
                  $link_label = $repeater[$index]['group-link_links_label'];
                  
                  //IF il campo Link non è vuoto
                  if ( ! empty( $item['group-link_links_link']['url'] ) ) { $this->add_link_attributes( "link_{$index}", $item['group-link_links_link'] );
                     $removeChar = ["https://", "http://"];
                     ?>
                     <div class="col-card col-6 col-lg-4<?php /*if (!is_singular('documenti')) : echo " col-xl-3"; endif;*/ ?> col-xl-3">

                        <a class="card card-secondary" <?php echo $this->get_render_attribute_string( "link_{$index}" ); ?>>
                           <span class="svg-wrapper">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                              </svg>
                           </span>
                           <p class="h3-style"><?php echo $link_label; ?></p>

                           <?php //Se target _blank
                           if ( $repeater[$index]['group-link_links_link']['is_external'] == 'on') { ?>
                              <p class="link-card__url">
                                 <span><?php $http_referer = str_replace($removeChar, "", $repeater[$index]['group-link_links_link']['url']); echo $http_referer; ?></span>
                              </p>
                              <?php
                           };
                           ?>

                        </a>

                     </div>
                     <?php
                  } else { 
                     ?>
                     <div class="col-card col-6 col-lg-4<?php /*if (!is_singular('documenti')) : echo " col-xl-3"; endif;*/ ?> col-xl-3">
                        <a class="card card-secondary no-href">
                           <span class="svg-wrapper">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                              </svg>
                           </span>
                           <p class="h3-style"><?php echo $link_label; ?></p>
                        </a>
                     </div>
                     <?php
                  };
               }; ?>
            </div>


			</div>
			
		</section>
		
			

	<?php
	}
}