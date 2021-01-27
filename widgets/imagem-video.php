<?php

namespace Pipefy\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Featured_Horizontal extends Widget_Base{

  public function get_name(){
    return 'featured-horizontal';
  }

  public function get_title(){
    return 'Featured Horizontal';
  }

  public function get_icon(){
    return 'fa fa-arrows-h pipefy-widget'; //pipefy-widget class will add pfy label in the editor
  }

  public function get_categories(){
    return ['pipefy'];
  }

  protected function _register_controls(){


	$this->start_controls_section(
		'image_featured',
		[
		  'label' => __( 'Image / Video', 'pipefy-2020-admin' ),
		  'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		]
	);

	$this->add_control(
		'image_video',
		[
			'label' => __( 'Usar imagem ou vídeo?', 'pipefy-2020-admin' ),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'image' => [
					'title' => __( 'Imagem', 'pipefy-2020-admin' ),
					'icon' => 'fa fa-image',
				],
				'video' => [
					'title' => __( 'Video', 'pipefy-2020-admin' ),
					'icon' => 'fa fa-video',
				],
			],
			'default' => 'left',
			'toggle' => true,
		]
	);

	$this->add_control(
		'image',
		[
			'label'   => __( 'Imagem', 'pipefy-2020-admin' ),
			'type'    => \Elementor\Controls_Manager::MEDIA,
			'default' =>
			  [
				'url'  => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			'condition' => [
				'image_video' => 'image',
			],
		]
	);

	$this->add_control(
		'featured_horizontal_video',
		[
			'label'   => __( 'Video', 'pipefy-2020-admin'),
			'type'    => \Elementor\Controls_Manager::MEDIA,
			'media_type' => 'video',
			'default' =>
			  [
				'url'  => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			'condition' => [
				'image_video' => 'video',
			],
		]
	);

	$this->add_control(
		'class_image',
		[
			'label' => __( 'Image/Video position:', 'pipefy-2020-admin' ),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'pipefy-2020-admin' ),
					'icon' => 'fa fa-long-arrow-left',
				],
				'right' => [
					'title' => __( 'Right', 'pipefy-2020-admin' ),
					'icon' => 'fa fa-long-arrow-right',
				],
			],
			'default' => 'left',
			'toggle' => true,
		]
	);

	$this->end_controls_section();

    $this->start_controls_section(
      'content',
      [
		'label' => __( 'Content', 'pipefy-2020-admin' ),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
	);

	$this->add_control(
		'item_title',
		[
			'label' => __( 'Enter item title', 'plugin-domain' ),,
			'type' => Controls_Manager::TEXT,
			'dynamic' => [
				'active' => true,
			],
			'placeholder' => __( 'Enter item title', 'plugin-domain' ),
		]
    );


	$this->add_control(
		'item_title_tag',
		[
			'label' => __( 'Item Title HTML Tag', 'pipefy-2020-admin' ),
			'type' => Controls_Manager::SELECT,
			'options' => PFY_TAGS,
			'default' => PFY_TAGS_DEFAULT,
		]
	);

	$this->add_control(
		'hr_item',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
		]
	);

    $this->add_control(
		'title',
		[
			'label' => __( 'Title', 'pipefy-2020-admin' ),
			'type' => Controls_Manager::TEXTAREA,
			'dynamic' => [
				'active' => true,
			],
			'placeholder' => __( 'Enter your title', 'pipefy-2020-admin' ),
		]
    );


	$this->add_control(
		'title_tag',
		[
			'label' => __( 'Title HTML Tag', 'pipefy-2020-admin' ),
			'type' => Controls_Manager::SELECT,
			'options' => PFY_TAGS,
			'default' => PFY_TAGS_DEFAULT,
		]
	);

	$this->add_control(
		'hr',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
		]
	);

    $this->add_control(
			'paragraph',
			[
				'label' => __( 'Paragraph', 'pipefy-2020-admin' ),
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your paragraph', 'pipefy-2020-admin' ),
				'default' => __( 'Add Your Paragraph Here', 'pipefy-2020-admin' ),
			]
    );

	$this->add_control(
		'paragraph_tag',
		[
			'label' => __( 'Paragraph HTML Tag', 'pipefy-2020-admin' ),
			'type' => Controls_Manager::SELECT,
			'options' => PFY_TAGS,
			'default' => PFY_TAGS_DEFAULT,
		]
	);

	$this->end_controls_section();

	$this->start_controls_section(
		'section_content',
		[
		  'label' => __('Button', 'pipefy-2020-admin'),
		  'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		]
	);

	$this->add_control(
		'cta',
		[
		  'label' =>  __('CTA: Text', 'pipefy-2020-admin'),
		  'type' => \Elementor\Controls_Manager::TEXT,
		  'default' => 'My Example text',
		]
	);

	// Add link fields
	$base_slug = 'cta'; // only change this name, control functions must remain unchanged
	$this->add_control( $base_slug . '_link_type', elementor_pfy_link_type( $base_slug ) );
	$this->add_control(	$base_slug . '_link', elementor_pfy_link( $base_slug ) );
	$this->add_control(	$base_slug . '_template_type', elementor_pfy_link_template_type( $base_slug ) );
	$this->add_control(	$base_slug . '_template_id', elementor_pfy_link_template_id( $base_slug ) );
	$this->add_control( $base_slug . '_cta_type',	elementor_pfy_cta_type( $base_slug ) );
	$this->add_control( $base_slug . '_taxonomy_code', elementor_pfy_taxonomy_code( $base_slug ) );

	$this->add_control(
		'hr_btn',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
		]
	);

	$this->add_control(
		'cta_secondary',
		[
		  'label' => __('CTA: Secondary', 'pipefy-2020-admin'),
		  'description' => __('Optional', 'pipefy-2020-admin'),
		  'type' => \Elementor\Controls_Manager::TEXT,
		]
	);

	// Add link fields
	$base_slug = 'cta_secondary'; // only change this name, control functions must remain unchanged
	$this->add_control( $base_slug . '_link_type', elementor_pfy_link_type( $base_slug ) );
	$this->add_control(	$base_slug . '_link', elementor_pfy_link( $base_slug ) );
	$this->add_control(	$base_slug . '_template_type', elementor_pfy_link_template_type( $base_slug ) );
	$this->add_control(	$base_slug . '_template_id', elementor_pfy_link_template_id( $base_slug ) );
	$this->add_control( $base_slug . '_cta_type',	elementor_pfy_cta_type( $base_slug ) );
	$this->add_control( $base_slug . '_taxonomy_code', elementor_pfy_taxonomy_code( $base_slug ) );

	$this->end_controls_section();

	$this->start_controls_section(
		'title_color',
		[
		  'label' => __('Colors', 'pipefy-2020-admin'),
		  'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	$this->add_control(
		'color',
		[
			'label' => __( 'Title color', 'pipefy-2020-admin' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => PFY_COLORS,
			'default' => 'dark-headline',
		]
	);

	$this->add_control(
		'hr_style',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
		]
	);

	$this->add_control(
		'spacing_top',
		[
			'label' => __( 'Extra top space?', 'pipefy-2020-admin' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => __( 'Yes', 'pipefy-2020-admin' ),
			'label_off' => __( 'No', 'pipefy-2020-admin' ),
			'return_value' => 'lg:pfy-mt-120 pfy-mt-0',
			'default' => 'No',
		]
	);

	$this->end_controls_section();

	$this->start_controls_section(
			'featured_horizontal_style',
			[
				'label' => __( 'Choose bottom spacing', 'pipefy-2020-admin' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'featured_horizontal_bt_spacing',
			[
				'label' => __( 'Bottom Spacing', 'pipefy-2020-admin' ),
				'type' => Controls_Manager::SELECT,
				'options' => PFY_BOTTOM_SPACE,
				'default' => PFY_BOTTOM_SPACE_DEFAULT,
			]
		);

		$this->end_controls_section();



  }

  //PHP Render
  protected function render(){
	$settings = $this->get_settings_for_display();
	$this->add_inline_editing_attributes('title', 'none');
	$this->add_inline_editing_attributes('paragraph', 'basic');


	$bottom_space = $settings['featured_horizontal_bt_spacing'];
	$bottom_space_desktop = PFY_BOTTOM_SPACE_VALUES[$bottom_space]['desktop'];
	$bottom_space_mobile = PFY_BOTTOM_SPACE_VALUES[$bottom_space]['mobile'];

	$img_position = "left";
	$margin = "pfy-mr-32";
	switch( $settings['class_image'] ) {
		case "left":
		  $position = "pfy-col-start-1";
		  $position_content = "pfy-col-start-8";
		  $size_content = "pfy-col-span-6";
		  $margin = "pfy-mr-32";
		  break;
		case "right":
		  $position = "pfy-col-start-7";
		  $position_content = "pfy-col-start-1";
		  $size_content = "pfy-col-span-5";
		  $margin = "pfy-ml-32";
		  break;
		default:
		  $position = "pfy-col-start-1";
		  $margin = "pfy-mr-32";
	  }

	$start = "left";
    switch( $settings['class_image'] ) {
      case "left":
		$start = 8;
        break;
      case "right":
        $start = 1;
        break;
	  default:
		$start = 7;
    }


	$this->add_inline_editing_attributes('paragraph', 'none');

	// Tracking: Element name (as slug)
	$data_event_category = "featured-horizontal";

	// Tracking: Get link data
	$base_slug = 'cta';
	$cta = get_pipefy_link_data(
		$data_event_category, // category
		"link_similar", // action_type (CHECK THIS)
		$settings[ $base_slug ], // content
		$settings[ $base_slug . '_link_type' ], // link_type
		$settings[ $base_slug . '_link' ], // link
		$settings[ $base_slug . '_template_type' ], // template_type
		$settings[ $base_slug . '_template_id' ], // template_id
		$settings[ $base_slug . '_cta_type' ], // cta_type
		$settings[ $base_slug . '_taxonomy_code' ], // taxonomy_code
		get_the_ID() // post_id
	);

	// Tracking: Get link data
	$base_slug = 'cta_secondary';
	$cta_secondary = get_pipefy_link_data(
		$data_event_category, // category
		"link_similar", // action_type (CHECK THIS)
		$settings[ $base_slug ], // content
		$settings[ $base_slug . '_link_type' ], // link_type
		$settings[ $base_slug . '_link' ], // link
		$settings[ $base_slug . '_template_type' ], // template_type
		$settings[ $base_slug . '_template_id' ], // template_id
		$settings[ $base_slug . '_cta_type' ], // cta_type
		$settings[ $base_slug . '_taxonomy_code' ], // taxonomy_code
		get_the_ID() // post_id
	);
	/**
	 * Declare classes for tailwind
	 *
	 * pfy-row-start-1 pfy-row-end-4 lg:pfy-col-start-6
	 */


    ?>
	<div class="lg:pfy-mb-<?php echo $bottom_space_desktop; ?> pfy-mb-<?php echo $bottom_space_mobile; ?> <?php echo $settings['spacing_top'] ?>">
	<div class="pfy-max-w-default pfy-mr-auto pfy-ml-auto pfy-text-dark-headline pfy-grid pfy-text-24 md:pfy-text-40 pfy-font-semibold pfy-mb-32 md:pfy-mb-100 pfy-px-24 md:pfy-px-48 xl:pfy-px-0">
			<<?php echo $settings['item_title_tag'];?> >
				<?php echo $settings['item_title'];?>
			</<?php echo $settings['item_title_tag'];?>>
	</div>
    <div class="pfy-max-w-default pfy-mr-auto pfy-ml-auto pfy-grid pfy-items-center lg:pfy-grid-cols-12 md:pfy-grid-cols-1 pfy-grid-cols-1 pfy-pl-24 pfy-pr-24 lg:pfy-pl-none lg:pfy-pr-none md:pfy-px-48 xl:pfy-px-0">
		<div class="lg:<?php echo $position;?> lg:<?php echo $margin; ?> lg:pfy-col-span-6 lg:pfy-row-span-2 pfy-items-center lg:pfy-row-start-1 sm:pfy-row-start-2 sm:pfy-order-2 lg:pfy-order-1 pfy-mb-32 lg:pfy-mb-0">
			<?php
			if ( $settings['image']['id'] !== "" ){
			echo wp_get_attachment_image( $settings['image']['id'], "full");
			}else{
			echo '<video autoplay="autoplay" loop="loop" muted="muted" >
 					 <source src="'.$settings['featured_horizontal_video']['url'].'" type="video/mp4">
				</video>';
			}
			?>
		</div>
		<div class="lg:<?php echo $position_content;?> pfy-mr-32 lg:<?php echo $size_content;?> lg:pfy-row-span-2 pfy-items-center lg:pfy-row-start-1 sm:pfy-row-start-2 sm:pfy-order-2 lg:pfy-order-1 pfy-mb-32 lg:pfy-mb-0 ">
			<div class="lg:pfy-col-span-5 lg:pfy-row-span-1 lg:pfy-col-start-<?php echo $start?> sm:pfy-row-start-1 sm:pfy-order-1 lg:pfy-order-2 lg:pfy-mb-40 pfy-mb-20 pfy-order-first">
			<<?php echo $settings['title_tag'];?> class="pfy-text-<?php echo $settings['color']; ?> pfy-grid pfy-text-24 md:pfy-text-40 pfy-font-semibold pfy-mb-10" >
				<?php echo $settings['title'];?>
			</<?php echo $settings['title_tag'];?>>
			</div>
			<div class="lg:pfy-col-span-5  lg:pfy-row-span-1 lg:pfy-col-start-<?php echo $start?> lg:pfy-order-3 ">
			<<?php echo $settings['paragraph_tag'];?>  class="pfy-text-gray-text pfy-text-16 md:pfy-text-18 pfy-font-normal" >
				<?php echo $settings['paragraph'];?>
			</<?php echo $settings['paragraph_tag'];?>>
			<a href="<?php echo $cta['link'];?>" target="_self" class="pfy-w-100 pfy-inline-block pfy-base pfy-font-semibold pfy-text-dark-headline hover:pfy-text-blue pfy-border-solid pfy-border-t-0 pfy-border-r-0 pfy-border-l-0 pfy-border-b-2 pfy-border-blueribbon-main pfy-rounded-none pfy-mt-20 lg:pfy-mt-40 pfy-mr-20 pfy-mb-16 lg:pfy-mb-0 pfy-transition <?php echo $cta['class']; ?>" <?php echo $cta['data_event']; ?>>
				<?php echo $cta['content']; ?>
			</a>
			<?php if ( $cta_secondary['content'] ){ ?>
			<a href="<?php echo $cta_secondary['link'];?>" target="_self" style="width: max-content;" class="pfy-inline-block pfy-base pfy-font-semibold pfy-text-dark-headline hover:pfy-text-blue pfy-border-solid pfy-border-t-0 pfy-border-r-0 pfy-border-l-0 pfy-border-b-2 pfy-border-blueribbon-main pfy-rounded-none pfy-mt-20 lg:pfy-mt-40 <?php echo $cta_secondary['class'];?>" <?php echo $cta_secondary['data_event'];?>>
				<?php echo $cta_secondary['content']; ?>
			</a>
			<?php } ?>
			</div>
		</div>
	</div>
	</div>
    <?php
  }

  //JS RENDER
  protected function _content_template(){

    ?>
	<#

		let image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.thumbnail_size,
			dimension: settings.thumbnail_custom_dimension,
			model: view.getEditModel()
		};
		let image_url = elementor.imagesManager.getImageUrl( image );

		let position = "left";
		let margin = "pfy-mr-32";
		switch( settings.class_image ) {
			case "left":
			position = "pfy-col-start-1";
			margin = "pfy-ml-32";
			break;
			case "right":
			position = "pfy-col-start-7";
			margin = "pfy-mr-32";
			break;
			default:
			position = "pfy-col-start-1";
			margin = "pfy-mr-32";
		}

		let start = "left";
		switch( settings.class_image ) {
		case "left":
			start = 8;
			break;
		case "right":
			start = 1;
			break;
		default:
			start = 7;
		}

      	view.addRenderAttribute( 'title', 'class', 'pfy-text-dark-headline', 'pfy-grid',  'pfy-text-40', 'pfy-font-semibold', 'pfy-mb-10' );

		view.addInlineEditingAttributes( 'title' );

	  	view.addInlineEditingAttributes( 'paragraph' );

      #>

	  <#
	let desktop_space = "";
	let mobile_space = "";
	switch ( settings.featured_horizontal_bt_spacing ){
		case "none":
			mobile_space = 0;
			desktop_space = 0;
			break;
		case "small":
			mobile_space = 40;
			desktop_space = 80;
			break;
		case "medium":
			mobile_space = 60;
			desktop_space = 120;
			break;
		case "large":
			mobile_space = 120;
			desktop_space = 240;
			break;
		default:
			desktop_space = 0;
			mobile_space = 0;
	}
	#>
	<div class="lg:pfy-mb-{{{ desktop_space }}} pfy-mb-{{{ mobile_space }}}">
	<div  class="pfy-text-dark-headline pfy-grid pfy-text-24 md:pfy-text-40 pfy-font-semibold pfy-mb-100 {{{ settings.spacing_top }}} ">
		<{{{ settings.item_title_tag }}}>
			{{{ settings.item_title }}}
		</{{{ settings.item_title_tag }}}>
	</div>
	<div class="pfy-grid pfy-items-center lg:pfy-grid-cols-12 md:pfy-grid-cols-1 pfy-grid-cols-1 lg:pfy-grid-rows-2 pfy-grid-rows-3 pfy-pl-24 pfy-pr-24 lg:pfy-pl-none lg:pfy-pr-none">
		<div class="lg:{{{ position }}} {{{ margin }}} lg:pfy-col-span-6 lg:pfy-row-span-2 pfy-items-center lg:pfy-row-start-1 sm:pfy-row-start-2 sm:pfy-order-2 lg:pfy-order-1 pfy-mb-32 lg:pfy-mb-0">
		<img src=" {{{ settings.image.url }}} ">
		</div>
		<div class="lg:pfy-col-span-6 lg:pfy-row-span-1 lg:pfy-col-start-{{{ start }}} sm:pfy-row-start-1 sm:pfy-order-1 lg:pfy-order-2 lg:pfy-mb-40 pfy-mb-20 pfy-order-first">
			<{{{ settings.title_tag }}}  class="pfy-text-{{{ settings.color }}} pfy-grid pfy-text-40 pfy-font-semibold pfy-mb-10"  >
			{{{ settings.title }}}
			</{{{ settings.title_tag }}}>
		</div>
		<div class="lg:pfy-col-span-5  lg:pfy-row-span-1 lg:pfy-col-start-{{{ start }}} lg:pfy-order-3 ">
			<{{{ settings.paragraph_tag }}}  class="pfy-text-gray-text pfy-text-18 pfy-font-normal"  >
			{{{ settings.paragraph }}}
			</{{{ settings.paragraph_tag }}}>
		<a href="#" target="_self" class="pfy-inline-block pfy-base pfy-font-semibold pfy-text-dark-headline pfy-border-solid pfy-border-t-0 pfy-border-r-0 pfy-border-l-0 pfy-border-b-2 pfy-border-blueribbon-main pfy-rounded-none pfy-mt-20 lg:pfy-mt-40">
			{{{ settings.cta }}}
		</a>
		<# if ( settings.cta_secondary ){
		#>
			<a href="#" target="_self" class="pfy-inline-block pfy-base pfy-font-semibold pfy-text-dark-headline pfy-border-solid pfy-border-t-0 pfy-border-r-0 pfy-border-l-0 pfy-border-b-2 pfy-border-blueribbon-main pfy-rounded-none pfy-mt-20 lg:pfy-mt-40 lg:pfy-ml-20">
				{{{ settings.cta_secondary }}}
			</a>
		<# }
		#>
		</div>
	</div>
	</div>
    <?php
  }
}
