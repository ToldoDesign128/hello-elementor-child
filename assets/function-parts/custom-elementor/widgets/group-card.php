<?php
/**
 * Group Cards section
 *
 * @since 1.0.0
 */
class FBK_Elementor_GroupCard extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-group-card';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Gruppo di Cards', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return ' eicon-products';
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
		return [ 'card', 'fbk', 'howto' ];
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
         'group-card_overtitle',
            [
               'label' => esc_html__( 'Sopratitolo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'placeholder' => esc_html__( 'Sopratitolo della sezione', 'custom-FBK-widget' ),
            ]
         );

         $this->add_control(
         'group-card_title',
            [
               'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
            ]
         );

         $this->add_control(
         'group-card_btn_label',
            [
               'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
               'separator' => 'before',
            ]
         );

         $this->add_control(
            'group-card_btn_link',
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
            'group-card_txt',
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
			'cards_section',
			[
				'label' => esc_html__( 'Lista cards', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

         /* Start repeater registration */
         $repeater = new \Elementor\Repeater();

            $repeater->add_control(
               'group-card_cards_link',
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
                  'label_block' => true,
               ]
            );

            $repeater->add_control(
               'group-card_cards_overtitle',
               [
                  'label' => esc_html__( 'Sopratitolo', 'custom-FBK-widget' ),
                  'type' => \Elementor\Controls_Manager::TEXT,
                  'placeholder' => esc_html__( 'Sopratitolo della card', 'custom-FBK-widget' ),
               ]
            );
   
            $repeater->add_control(
            'group-card_cards_title',
               [
                  'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
                  'type' => \Elementor\Controls_Manager::TEXT,
                  'placeholder' => esc_html__( 'Titolo della card', 'custom-FBK-widget' ),
               ]
            );

            $repeater->add_control(
               'group-card_cards_text',
               [
                  'label' => esc_html__( 'Testo', 'custom-FBK-widget' ),
                  'type' => \Elementor\Controls_Manager::TEXTAREA,
                  'rows' => 10,
                  'placeholder' => esc_html__( 'Inserisci il testo della card', 'custom-FBK-widget' ),
               ]
            );


         /* End repeater registration*/

         /* Start repeater usage*/
         $this->add_control(
            'group-card_cards',
            [
               'type' => \Elementor\Controls_Manager::REPEATER,
               'fields' => $repeater->get_controls(),
               'title_field' => "Card",
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
         $overtitle = $settings['group-card_overtitle'];
         $title = $settings['group-card_title'];
         $btn_label = $settings['group-card_btn_label'];
         if ( ! empty( $settings['group-card_btn_link']['url'] ) ) { $this->add_link_attributes( 'group-card_btn_link', $settings['group-card_btn_link'] ); }
   
         $text = $settings['group-card_txt'];
   
         //REPEATER - Lista Link
         $repeater = $settings['group-card_cards']
         ?>
   
         <section class="fbk-cw fbk-cw-group-card container mb-section<?php if (is_singular('documenti')) : echo " fbk-cw-single"; endif; ?>">

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
                           <a <?php echo $this->get_render_attribute_string( 'group-card_btn_link' ); ?> class="button button-primary"><?php echo $btn_label; ?><span class="svg-wrapper">
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


            <div class="row latest-loop">
               <?php foreach ( $repeater as $index => $item ) {
                  $card_link = $repeater[$index]['group-card_cards_link'];
                  $card_overtitle = $repeater[$index]['group-card_cards_overtitle'];
                  $card_title = $repeater[$index]['group-card_cards_title'];
                  $card_title = $repeater[$index]['group-card_cards_title'];
                  $card_text = $repeater[$index]['group-card_cards_text'];
                  ?>

                  <div class="col-card col-12 col-lg-6">

                     <a class="card card-primary"<?php if($card_link['url']) :?> href="<?php echo esc_url($card_link['url']); ?>"<?php endif; if($card_link['is_external']) : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                        <span class="svg-wrapper">
                           <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M16.535 2.02972H0.717616V0H20V19.2824H17.9703V3.46496L1.43523 20L0 18.5648L16.535 2.02972Z" fill="#A19E9E"/>
                           </svg>
                        </span>
                        <div class="content">
                           <p class="meta">
                              <span class="label_date_cat"><?php if ($card_overtitle) : echo $card_overtitle; endif; ?></span>
                           </p>
                           <?php if ($card_title) : ?><p class="h3-style"><?php echo $card_title; ?></p><?php endif; ?>
                           <?php if ($card_text) : ?><p class="excerpt"><?php echo $card_text; ?></p><?php endif; ?>
                        </div>
                     </a>

                  </div>

               <?php }; ?>

            </div>
		
			

	<?php
	}
}