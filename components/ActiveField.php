<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 15.03.17
 * Time: 10:45
 */

namespace app\components;


use yii\bootstrap\Html;

class ActiveField extends \kartik\form\ActiveField {
	public $errorOptions = ['class' => 'help-block alert alert-danger'];

	/**
	 * Renders a checkbox. This method will generate the "checked" tag attribute according to the model attribute value.
	 *
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially
	 * handled:
	 *
	 * - `uncheck`: _string_, the value associated with the uncheck state of the checkbox. If not set, it will take
	 *   the default value `0`. This method will render a hidden input so that if the checkbox is not checked and is
	 *   submitted, the value of this attribute will still be submitted to the server via the hidden input.
	 * - `label`: _string_, a label displayed next to the checkbox. It will NOT be HTML-encoded. Therefore you can
	 *   pass in HTML code such as an image tag. If this is is coming from end users, you should [[Html::encode()]]
	 *   it to prevent XSS attacks. When this option is specified, the checkbox will be enclosed by a label tag.
	 * - `labelOptions`: _array_, the HTML attributes for the label tag. This is only used when the "label" option is
	 *   specified.
	 * - `container: boolean|array, the HTML attributes for the checkbox container. If this is set to false, no
	 *   container will be rendered. The special option `tag` will be recognized which defaults to `div`. This
	 *   defaults to:
	 *   `['tag' => 'div', 'class'=>'radio']`
	 * The rest of the options will be rendered as the attributes of the resulting tag. The values will be
	 * HTML-encoded using [[Html::encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 *
	 * @param boolean $enclosedByLabel whether to enclose the radio within the label. If `true`, the method will
	 * still use [[template]] to layout the checkbox and the error message except that the radio is enclosed by
	 * the label tag.
	 *
	 * @return \kartik\form\ActiveField object
	 */
  public function eyeCheckbox($options = [], $withLabel = true){
	  $wrapper = [
		  'data-title-checked' => '',
		  'data-title-unchecked' => '',
		  'class' => 'checkbox-type-eye-wrapper',
	  ];
	  return $this->__checkbox($options, $withLabel, $wrapper);
  }

  public function plusMinusCheckbox($options = [], $withLabel = true){
	  $wrapper = [
	  	'data-title-checked' => '',
	  	'data-title-unchecked' => '',
		'class' => 'checkbox-type-plus-minus-wrapper',
	  ];
	  return $this->__checkbox($options, $withLabel, $wrapper);
  }

  private function __checkbox($options, $withLabel, $wrapper){
	  $options['id'] = $this->getInputId().'-'.uniqid();
	  if (isset($options['title']) && is_array($options['title'])){
		  $wrapper['data-title-checked']   = isset($options['title']['checked'])?$options['title']['checked']:'';
		  $wrapper['data-title-unchecked'] = isset($options['title']['unchecked'])?$options['title']['unchecked']:'';
		  $wrapper['class']               .= ' stateful-title';
		  unset($options['title']);
	  }

	  $defaultTemplate = Html::tag('div', "{input}\n{label}\n", $wrapper);

	  $this->template = isset($options['template'])?$options['template']:$defaultTemplate;

	  $checkbox = $this->checkbox($options, false);

	  return $withLabel?$checkbox:$checkbox->label('');
  }
}