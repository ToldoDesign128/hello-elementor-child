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

			$repeater->add_control(
				'contact_name',
				[
					'label' => esc_html__( 'Nome', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Nome contatto', 'custom-FBK-widget' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'contact_desc',
				[
					'label' => esc_html__( 'Descrizione', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Descrizione contatto', 'custom-FBK-widget' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'contact_email',
				[
					'label' => esc_html__( 'Email', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Email contatto', 'custom-FBK-widget' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'contact_tel',
				[
					'label' => esc_html__( 'Telefono', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Telefono contatto', 'custom-FBK-widget' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'contact_img',
				[
					'label' => esc_html__( 'Immagine contatto', 'custom-FBK-widget' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'media_types' => ['image', 'svg'],
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


		<section class="fbk-cw fbk-cw-contacts">

			<div class="header">
				<p><?php echo $overtitle; ?></p>
				<h2><?php echo $title; ?></h2>
				<a <?php echo $this->get_render_attribute_string( 'contacts_btn_link' ); ?>>
					<?php echo $btn_label; ?>
				</a>
			</div>
      
			<div class="contacts">

				<?php foreach ( $repeater as $index => $item ) {
					$img = $repeater[$index]['contact_img'];
					$name = $repeater[$index]['contact_name'];
					$desc = $repeater[$index]['contact_desc'];
					$email = $repeater[$index]['contact_email'];
					$tel = $repeater[$index]['contact_tel'];
					?>

					<article class="single_contact">
						<figure>
							<?php if ($img) : ?>
								<img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
							<?php endif; ?>
						</figure>
						<div>
							<p><?php echo $name; ?></p>
							<?php if ($desc) : ?><p><?php echo $desc; ?></p><?php endif; ?>
							<?php if ($email) : ?><p><?php echo $email; ?></p><?php endif; ?>
							<?php if ($tel) : ?><p><?php echo $tel; ?></p><?php endif; ?>
						</div>
					</article>
						
					<?php
				}; ?>

			</div>

    </section>

    <?php
	}
}