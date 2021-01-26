# Passo a passo
## 1- Instale o Elementor
Caso não tenha o plugin do Elementor instalado você pode fazê-lo diretamente na sessão de plugins do WordPress. Ou se preferir faça o download [aqui](https://br.wordpress.org/plugins/elementor/).
## 2- Crie e estrutute os arquivos que serão utilizados
Na pasta do seu tema (preferencialmente no tema filho) crie os seguintes arquivos:

listagem-widgets.php
Crie uma pasta chamada “widgets”
Dentro da pasta widgets crie um arquivo chamado meu-primeiro-widget.php
Estrutura:

* Tema do WordPress
* Tema filho
    * listagem-widgets.php
    * 📁 widgets
      * meu-primeiro-widget.php

## 3- Estrutura do arquivo de listagem (listagem-widgets.php):

Após criar um namespace (que chamei de Meus_Widgets você deverá adicionar basicamente duas funções:
**include_widget_files()**– para anexar o arquivo do widget
**register_widgets()** – para registrar os widgets na listagem do Elementor

    <?php namespace Meus_Widgets;
    // use Elementor\Plugin; 
    class Widget_Loader { 
      private static $_instance = null;
 
      public static function instance() { 
        if ( is_null( self::$_instance ) ) { 
          self::$_instance = new self(); 
        } 
        return self::$_instance; 
      } 
 
      private function include_widgets_files() { 
        require_once __DIR__ . '/widgets/meu-primeiro-widget.php';
      } 
 
      public function register_widgets() { 
        $this-&gt;include_widgets_files(); 
        \Elementor\Plugin::instance()-&gt;;widgets_manager-&gt;;register_widget_type( new Widgets\Meu_Primeiro_Widget() ); 
       } 
 
       public function __construct() { 
         add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ), 99 ); 
      } 
    } 
 
    // Instantiate Plugin Class 
     Widget_Loader::instance();

## 3- Começando a trabalhar no widget
Criar um widget para o Elementor não é muito diferente de criar um widget para o WordPress. Basta criar uma classe que faça a extensão do Widget_Base e preencher os métodor necessários.

Cada widget prescisa de alguns itens básicos tais como:
* Nome único que será identificado pelo nome
* Título para o catálogo do Elementor
* Ìcone para o catálogo do Elementor
```
<?php class Meu_Primeiro_Widget extends \Elementor\Widget_Base {
     public function get_title() {}
     public function get_icon() {}
     public function get_categories() {}
     protected function _register_controls() {}
     protected function render() {}
     protected function _content_template() {}
}
```
**Detalhando:**

**Nome do widget** – O método get_name()  é simples, você só precisa retornar o nome do widget que será usado no código.
**Título do widget** – O método get_title (), que, novamente, é muito simples, você precisa retornar o título do widget que será exibido como o rótulo do widget.
**Ícone do widget** – o método get_icon () é um método opcional, mas recomendado, pois permite definir o ícone do widget. você pode usar qualquer um dos ícones eicon ou font-awesome, basta retornar o nome da classe como uma string.
**Categorias de widget** – o método get_categories permite definir a categoria do widget e retornar o nome da categoria como uma string.
**Controles de widget** – O método _register_controls permite definir quais controles (campos de configuração) seu widget terá.
**Render Frontend Output** – O método render (), que é onde você realmente renderiza o código e gera o HTML final no frontend usando PHP.
**Render Editor Output** – O método _content_template (), é onde você renderiza a saída do editor para gerar a visualização ao vivo usando um modelo Backbone JavaScript.

## Vamos começar a juntar as peças:
Para colocar todas as peças juntas, vamos criar um widget Elementor simples que usará a funcionalidade nativa oEmbed do WordPress.

### Widget Class
Primeiro crie a classe que estenda a Widget_Base class:
```
class Meu_Primeiro_Widget extends \Elementor\Widget_Base {
}
```
### Widget Data
Agora vamos começar a preencher os métodos:

```
<?php
class Elementor_Test_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'meu-primeiro-widget';
	}

	public function get_title() {
		return 'Meu primeiro widget';
	}

	public function get_icon() {
		return 'fa fa-trophy';
	}

	public function get_categories() {
		return [ 'meus widgets' ];
	}

}
```

### Widget Controls

Em seguida, precisamos adicionar os controles do widget usando o método _register_controls (). Optei por utilizar o controle de texto.
Aqui você pode visualizar todos os controls do Elementor e suas aplicações.
```
<?php
class Elementor_Test_Widget extends \Elementor\Widget_Base {

protected function _register_controls() {

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

	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
		<div><?php echo $settings['titulo']; ?></div>
	<?php
	}

	protected function _content_template() {
	?>
		<div>{{{ settings.titulo }}}</div>
	<?php
	}
}
```

### Visualização no Frontend

E, por último, precisamos implementar nosso método render() que obtém o text que o usuário insere no controle de TEXT acima e obtém o conteúdo.

```
<?php 
class Meu_Primeiro_Widget extends \Elementor\Widget_Base {
    protected function render() {
        $settings = $this-&gt;get_settings_for_display();
         echo '<div>'.$settings['titulo'].'</div>';
    }
}
```

### Bônus: Visualização em tempo real no Elementor

Adicionando a função_content_template() é possível observar as alterações em tempo real no editor, permitindo recriar o método render () em JavaScript.
```
<?php 
    protected function _content_template(){ ?>
    <div>{{{{ settings.titulo}}}</div>
<?php } ?>
```
**O widget está pronto!**
Você pode adicionar diversos controles no mesmo widget e obter algo mais complexo! [CLique aqui para acessar a lista de controles do Elementor](https://developers.elementor.com/elementor-controls/)
