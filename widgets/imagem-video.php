<?php

namespace Meus_Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Imagem_Video extends Widget_Base{

  public function get_name(){
    return 'imagem-video';
  }

  public function get_title(){
    return 'Imagem ou Vídeo';
  }

  public function get_icon(){
    return 'fa fa-photo-video'; 
  }

  public function get_categories(){
    return ['meus widgets'];
  }

  protected function _register_controls(){


	$this->start_controls_section(
		'secao_imagem_video',
		[
		  'label' => __( 'Imagem ou Video', 'plugin-domain' ),
		  'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		]
	);

	$this->add_control(
		'imagem_ou_video',
		[
			'label' => __( 'Usar imagem ou vídeo?', 'plugin-domain' ),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'image' => [
					'title' => __( 'Imagem', 'plugin-domain' ),
					'icon' => 'fa fa-image',
				],
				'video' => [
					'title' => __( 'Video', 'plugin-domain' ),
					'icon' => 'fa fa-video',
				],
			],
			'default' => 'image',
			'toggle' => true,
		]
	);

	$this->add_control(
		'mostrar_imagem',
		[
			'label'   => __( 'Imagem', 'plugin-domain' ),
			'type'    => \Elementor\Controls_Manager::MEDIA,
			'default' =>
			  [
				'url'  => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			'condition' => [
				'imagem_ou_video' => 'image',
			],
		]
	);

	$this->add_control(
		'mostrar_video',
		[
			'label'   => __( 'Video', 'plugin-domain'),
			'type'    => \Elementor\Controls_Manager::MEDIA,
			'media_type' => 'video',
			'default' =>
			  [
				'url'  => \Elementor\Utils::get_placeholder_image_src(),
			  ],
			'condition' => [
				'imagem_ou_video' => 'video',
			],
		]
	);

	$this->end_controls_section();

    $this->start_controls_section(
      'conteudo',
      [
		'label' => __( 'Conteudo', 'plugin-domain' ),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
	);

	$this->add_control(
		'titulo',
		[
			'label' => __( 'Título', 'plugin-domain' ),,
			'type' => Controls_Manager::TEXT,
			'dynamic' => [
				'active' => true,
			],
			'placeholder' => __( 'Insira o título aqui', 'plugin-domain' ),
		]
    );


	$this->add_control(
		'hr',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
		]
	);

    $this->add_control(
			'paragrafo',
			[
				'label' => __( 'Paragrafo', 'plugin-domain' ),
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Insira seu parágrafo', 'plugin-domain' ),
				'default' => __( 'Insira seu parágrafo aqui', 'plugin-domain' ),
			]
    );

	$this->end_controls_section();

  }

  //PHP Render
  protected function render(){
	$settings = $this->get_settings_for_display();
	$this->add_inline_editing_attributes('titulo', 'basic');
	$this->add_inline_editing_attributes('paragrafo', 'basic');
	$this->add_inline_editing_attributes('paragraph', 'basic');


    ?>
	<div>
        <div>
            <div>
                <?php
                if ( $settings['imagem_ou_video'] === 'imagem' ) {
                echo wp_get_attachment_image( $settings['mostrar_imagem']['id'], "full");
                } else if ( $settings['imagem_ou_video'] === 'video' ) {
                echo '<video autoplay="autoplay" loop="loop" muted="muted" >
                        <source src="'.$settings['mostar_video']['url'].'" type="video/mp4">
                    </video>';
                }
                ?>
            </div>
            <div>
                <div>
                    <h1>
                        <?php echo $settings['titulo'];?>
                    </h1>
                </div>
                <div>
                    <p>
                        <?php echo $settings['paragrafo'];?>
                    </p>
                </div>
            </div>
        </div>
	</div>
    <?php
  }

  //JS RENDER
  protected function _content_template(){

    ?>
<div>
        <div>
            <div>
                <#
                if ( settings.imagem_ou_video === 'imagem' ) {
                #>
                <img src="{{{settings.mostrar_imagem.url}}}" >
                <#
                else if ( settings.imagem_ou_video === 'video' ) {
                #>
                <video autoplay="autoplay" loop="loop" muted="muted" >
                        <source src="{{{ settings.mostrar_video.url}}}" type="video/mp4">
                </video>
                <#   
                }
                #>
            </div>
            <div>
                <div>
                    <h1>
                        {{{settings.titulo}}}
                    </h1>
                </div>
                <div>
                    <p>
                        {{{settings.paragrafo}}}
                    </p>
                </div>
            </div>
        </div>
	</div>
    <?php
  }
}
