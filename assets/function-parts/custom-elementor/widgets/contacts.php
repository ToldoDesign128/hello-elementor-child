<?php
/**
 * CONTACTS section
 *
 * @since 1.0.0
 */
class FBK_Elementor_Contacts extends \Elementor\Widget_Base { 
  
  /**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fbk-contacts';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FBK Contacts', 'custom-FBK-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
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
		return [ 'contacts', 'fbk', 'howto' ];
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
        'contacts_overtitle',
        [
          'label' => esc_html__( 'Sopratitolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Sopratitolo della sezione', 'custom-FBK-widget' ),
        ]
      );

      $this->add_control(
        'contacts_title',
        [
          'label' => esc_html__( 'Titolo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Titolo della sezione', 'custom-FBK-widget' ),
        ]
      );

			$this->add_control(
        'contacts_btn_label',
        [
          'label' => esc_html__( 'Pulsante — Testo', 'custom-FBK-widget' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'placeholder' => esc_html__( 'Testo del pulsante', 'custom-FBK-widget' ),
					'separator' => 'before',
        ]
      );

			$this->add_control(
				'contacts_btn_link',
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
			'contacts_section',
			[
				'label' => esc_html__( 'Lista contatti', 'custom-FBK-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			/* Start repeater registration */
			$repeater = new \Elementor\Repeater();

         
         $options = array();
         $posts = get_posts( array(
            'post_type'       =>    'contatti',
            'numberposts'     =>    -1,
            'post_status'     =>    'publish',
            // 'orderby'         =>    'date',
            // 'order'           =>    'ASC',
         ));
         foreach ( $posts as $key => $post ) {
            $options[$post->ID] = get_the_title($post->ID);
         }
			$repeater->add_control(
				'contact_id',
				[
					'label' => esc_html__( 'Contatto', 'custom-FBK-widget' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'description' => esc_html__( 'Seleziona un contatto da inserire nella lista' ),
               'options' => $options,
				]
			);

			
			/* End repeater registration*/

			/* Start repeater usage*/
			$this->add_control(
				'contacts',
				[
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => "Contatto",
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
		$overtitle = $settings['contacts_overtitle'];
		$title = $settings['contacts_title'];
		$btn_label = $settings['contacts_btn_label'];
		if ( ! empty( $settings['contacts_btn_link']['url'] ) ) { $this->add_link_attributes( 'contacts_btn_link', $settings['contacts_btn_link'] ); }

		//REPEATER - Lista Link
      $repeater = $settings['contacts']
		?>


		<section class="fbk-cw fbk-cw-contacts container mb-section">

         <div class="section-header">
            <div class="content">
               <p class="overtitle"><?php echo $overtitle; ?></p>
               <h2><?php echo $title; ?></h2>
            </div>
            <div>
               <?php if ($btn_label) : ?>
                  <a <?php echo $this->get_render_attribute_string( 'contacts_btn_link' ); ?> class="button button-primary"><?php echo $btn_label; ?><span class="svg-wrapper">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7239 3.33333H2.66672V2H14V13.3333H12.6667V4.27614L3.13812 13.8047L2.19531 12.8619L11.7239 3.33333Z" fill="white"/>
                        </svg>
                     </span>
                  </a>
               <?php endif; ?>
			   </div>
			</div>
      
			<div class="row contacts">

				<?php foreach ( $repeater as $index => $item ) {
					$id = $repeater[$index]['contact_id'];
               $title = get_the_title($id);
               $img = get_field('single_contact_img', $id);
               $text = get_field('single_contact_text', $id);
               $email = get_field('single_contact_email', $id);
               $tel = get_field('single_contact_tel', $id);

               if ($id) :
					?>

               <div class="col-12 col-sm-6 col-lg-4">
                  <article class="single_contact">
                     <?php if ($img) : ?><div>
                        <figure><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>"></figure>
                     </div><?php endif; ?>
                     <div class="content">
                        <h3><?php echo $title; ?></h3>
                        <?php if ($text) : ?><p class="desc"><?php echo $text; ?></p><?php endif; ?>
                        <?php if ($email) : ?><p><?php echo $email; ?></p><?php endif; ?>
                        <?php if ($tel) : ?><p><?php echo $tel; ?></p><?php endif; ?>
                     </div>
                  </article>
               </div>
						
					<?php
               endif;
				}; ?>

			</div>

    </section>

    <?php
	}
}