<?php

namespace Meus_Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Meu_Primeiro_Widget extends Widget_Base{

  public function get_name(){
    return 'meu-primeiro-widget';
  }

  public function get_title(){
    return 'Meu primeiro widget';
  }

  public function get_icon(){
    return 'fa fa-trophy';
  }

  public function get_categories(){
    return ['meus widgets'];
  }

  protected function _register_controls(){
    $this->start_controls_section(
			'secao_conteudo',
			[
				'label' => 'Conteúdo',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'titulo',
			[
				'label' => __( 'titulo', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Título padrão',
				'placeholder' => 'Insira o título aqui',
			]
		);

		$this->end_controls_section();
  }

  //PHP Render
  protected function render() {
		$settings = $this->get_settings_for_display();
  ?>
    <div><?php echo $settings['titulo']; ?></div>
  <?php
  }
  
  //JS RENDER
  protected function _content_template() {
		?>
		<div>{{{ settings.titulo }}}</div>
		<?php
	}
}
