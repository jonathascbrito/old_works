<?php

/**
 * Registra a classe Helper.
 */
App::uses('Helper', 'View');

/**
 * Classe auxiliar da aplicação. Define métodos para a criação de campos, links,
 * botões e urls.
 */
class AppHelper extends Helper {

    /**
     * Define as classes auxiliares utilizadas.
     * @var array
     */
    public $helpers = array('Html', 'Form');

    /**
     * Define os atributos utilizados ao gerar um novo elemento.
     * @var array
     */
    public $attributes = array();

    /**
     * Define se os atributos são mantidos de um elemento para outro.
     * @var array
     */
    public $retainattributes = false;

    /**
     * Carrega um módulo da interface. Carrega o framework app.js na primeira
     * chamada e os scripts e folhas de estilos do módulo selecionado.
     *
     * @param string $module
     */
    public function loadmodule($module) {
        static $dependencies = false;

        $this->_View->start('modules');

        if (! $dependencies) {
            echo $this->Html->css("app.class");
            echo $this->Html->script("app.class");

            echo '<script type="text/javascript">'
               .     'var base_path = "' . $this->Html->url('/', true) . '";'
               . '</script>';
        }

        echo $this->Html->css("app.{$module}")
           . $this->Html->script("app.{$module}");

        $dependencies = true;
        $this->_View->end();
    }

    /**
     * Reseta o conjunto de atributos do helper.
     */
    public function resetattributes() {
        if($this->retainattributes) return;

        $this->attributes = array();
    }

    /**
     * Define se os atributos serão amntidos de um elemento para outro.
     *
     * @param boolean $retain
     */
    public function retainattributes($retain = true) {
        $this->retainattributes = $retain;
    }

    /**
     * Define um atributo para o próximo elemento.
     *
     * @param string $name
     * @param mixed $value
     */
    public function setattribute($name, $value) {
        $this->attributes[$name] = $value;
    }

    /**
     * Define um conjunto de attributos para o próximo elemento.
     * @param array $attributes
     */
    public function setattributes($attributes) {
        $this->attributes = $attributes;
    }

    /**
     * Recebe uma url relativa à aplicação e retorna a url tratada com o caminho
     * completo para a página.
     *
     * @param string $url
     * @return string
     */
    public function createurl($url) {
        return $this->Html->url($url);
    }

    /**
     * Retorna um link tratando a url especificada.
     *
     * @param string $text
     * @param string $url
     * @return string
     */
    public function createlink($text, $url) {
        $options = array(
            'class' => explode('/', $url),
            'escape' => false
        );

        if(strpos($this->here, $this->base . $url) === 0)
            $options['class'][] = 'active';


        $options = array_merge($options, $this->attributes);
        $this->resetattributes();

        return $this->Html->link($text, $url, $options);
    }

    /**
     * Retorna um campo com rótulo definido por $text e do tipo especificado pela
     * variável $type. A classe tentará procurar o valor automaticamente a partir
     * do campo informado em $field.
     *
     * @uses app.form interface module
     *
     * @param string $text
     * @param string $field
     * @param string $type
     * @param mixed $value
     * @return string
     */
    public function createinput($text, $field, $type = 'text', $value = 'auto') {
        if ($text) $text = rtrim($text, ':') . ':';

        $options = array(
            'div' => false,
            'legend' => false,
            'fieldset' => false,
            'type' => $type,
            'label' => $text,
            'autocomplete' => 'off',
            'multiple' => false
        );

        if ( $value !== 'auto' ) $options['value'] = $value;

        $options = array_merge($options, $this->attributes);
        $this->resetattributes();

        $label = '';
        $wrapper = '';

        if ( $options['type'] == 'radio' ) {
            $options['label'] = true;
            $label = $text ? '<label>' . $text . '</label>' : '';
            $wrapper = '<div class="radio-options">';
        }

        if ( $options['type'] == 'select' and $options['multiple'] == 'checkbox' ) {
            $options['label'] = false;

            if ( ! isset($options['selected'])) {
                $selected = explode('.', $field);
                $selectedvalue = &$this->request->data;

                foreach ($selected as $s) {
                    if ( ! isset($selectedvalue[$s])) {
                        $selectedvalue = array();
                        break;
                    }

                    $selectedvalue = &$selectedvalue[$s];
                }

                $options['selected'] = $selectedvalue ? $selectedvalue : array();
            }

            $selected = count($options['selected']);
            for ( $s=0; $s<$selected; $s++ ) {
                $options['selected'][$s] = (int) $options['selected'][$s];
            }

            $label = $text ? '<label>' . $text . '</label>' : '';
            $wrapper = '<div class="checkbox-options">';
        }

        return '<div class="control">'
             .      $label
             .      $wrapper
             .          $this->Form->input($field, $options)
             .      ($wrapper ? '</div>' : '')
             . '</div>';
    }

    /**
     * Cria um botão de envio de formulário ou um botão comum com a ação definida
     * por $action.
     *
     * @uses app.form interface module
     *
     * @param string $text
     * @param string $type
     * @return string
     */
    public function createbutton($text, $type = 'submit') {
        $options = array(
            'div' => false,
            'legend' => false,
            'fieldset' => false
        );

        if ( $type !== 'submit' ) $options['type'] = $type;

        $options = array_merge($options, $this->attributes);
        $this->resetattributes();

        return '<div class="control">' . $this->Form->{$type}($text, $options) . '</div>';
    }

    /**
     * Cria um link do tipo dropdown. Quando clicado, a div definida em $dropdown
     * é exibida.
     *
     * @uses app.dropdown interface module
     *
     * @param string $text
     * @param string $dropdown
     * @param string $position
     * @return string
     */
    public function createdropdownlink($text, $dropdown, $position = 'bottom') {
        $options = array(
            'class' => array($dropdown),
            'dropdown' => $dropdown,
            'dropdown-position' => $position,
            'escape' => false
        );

        $options = array_merge($options, $this->attributes);
        $this->resetattributes();

        return $this->Html->link($text, '#', $options);
    }

    /**
     * Cria um botão do tipo dropdown. Quando clicado, a div definida em
     * $dropdown é exibida.
     *
     * @uses app.dropdown interface module
     *
     * @param string $text
     * @param string $dropdown
     * @param string $position
     * @return string
     */
    public function createdropdownbutton($text, $dropdown, $position = 'bottom') {
        $options = array(
            'div' => false,
            'legend' => false,
            'fieldset' => false,
            'type' => 'button',
            'class' => $dropdown,
            'dropdown' => $dropdown,
            'dropdown-position' => $position
        );

        $options = array_merge($options, $this->attributes);
        $this->resetattributes();

        return '<div class="control">' . $this->Form->button($text, $options) . '</div>';
    }

    /**
     * Cria uma lista de links para o dropdown informado no parâmetro $dropdown
     * utilizando os links definidos em $options.
     *
     * @uses app.dropdown interface module
     *
     * @param string $dropdown
     * @param string $options
     * @return string
     */
    public function createdropdownoptions($dropdown, $options) {
        $links = '';

        foreach($options as $text => $url) {
            $links .= $url == '-' ? '<div class="line"></div>' : $this->createlink($text, $url);
        }

        return '<div class="dropdown ' . $dropdown . '" id="' . $dropdown . '">'
             . '    <div class="inner">' . $links . '</div>'
             . '</div>';
    }

    /**
     * Cria um link para abrir um modal.
     *
     * @uses app.modal interface module
     *
     * @param string $text
     * @param string $action
     * @param string $url
     * @return string
     */
    public function createmodallink($text, $action, $url = null) {
        $options = array(
            'class' => $url ? explode('/', $url) : array(),
            'modal-action' => $action
        );

        if ($url) {
            $options['modal-url'] = $this->createurl($url);
        }

        $options = array_merge($options, $this->attributes);
        $this->resetattributes();

        return $this->Html->link($text, '#', $options);
    }

    /**
     * Cria um botão para abrir um modal.
     *
     * @uses app.modal interface module
     *
     * @param string $text
     * @param string $action
     * @param string $url
     * @return string
     */
    public function createmodalbutton($text, $action, $url = null) {
        $options = array(
            'div' => false,
            'legend' => false,
            'fieldset' => false,
            'type' => 'button',
            'class' => $url ? explode('/', $url) : array(),
            'modal-action' => $action
        );

        if ($url) {
            $options['modal-url'] = $this->createurl($url);
        }

        $options = array_merge($options, $this->attributes);
        $this->resetattributes();

        return '<div class="control">' . $this->Form->button($text, $options) . '</div>';
    }

    /**
     * Cria um botão para anexar arquivos ao modelo atual.
     *
     * @uses app.attachment interface module
     *
     * @param string $text
     * @param string $field
     * @return string
     */
    public function createattachment($text, $field) {
        $options = array();
        $options['class'][] = 'attach';
        $options['attach-field'] = $field;

        $options = array_merge($options, $this->attributes);
        $this->resetattributes();

        $isset = true;
        $steps = explode('.', $field);

        $hidden = '';
        $hidden_name = 'data';
        $attachments = & $this->request->data;

        foreach( $steps as $step ) {
            if ( ! isset($attachments[$step]) ) {
                $isset = false;
                break;
            }

            $hidden_name .= '[' . $step . ']';
            $attachments = & $attachments[$step];
        }

        if ($isset) {
            $hidden_name .= '[]';

            foreach ($attachments as $attachment) {
                $hidden .= '<input type="hidden" name="' . $hidden_name . '" value="' . $attachment . '">';
            }
        }

        return '<div class="attachment">'
             .      $this->Html->link($text, '/upload', $options)
             .      '<div class="files"></div>'
             .      $hidden
             . '</div>';
    }

    /**
     * Cria uma data de acordo com o fuso horário do usuário.
     *
     * @param string $str
     * @return string
     */
    public function createdate($str, $format = 'd/m/Y H:i') {
        $time = strtotime($str);
        return date($format, $time);
    }

}

?>