<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 21.04.17
 * Time: 13:08
 */

namespace app\modules\patient\components\widgets;


use yii\bootstrap\Widget;

class RecordBlock extends Widget {
	const LAYOUT_DEFAULT    = 'index';
	const LAYOUT_ADDITIONAL_TEXT = 'additional-text';
	const LAYOUT_NO_CONTROL = 'no-control';

	public $block_id;
	public $title = [
		'checked' => '',
		'unchecked' => ''
	];
	public $subtitle = [
		'checked' => '',
		'unchecked' => ''
	];
	public $model;
	public $attribute;
	public $content;
	public $scenario;
	public $text;
	public $label;

	public $layout = self::LAYOUT_DEFAULT;

	public function run() {
		return $this->render('record-block/'.$this->layout, [
			'block_id'  => $this->block_id,
			'title'     => $this->title,
			'subtitle'  => $this->subtitle,
			'model'     => $this->model,
			'attribute' => $this->attribute,
			'content'   => $this->content,
			'scenario'  => $this->scenario,
			'text'      => $this->text,
			'label'     => $this->label,
		]);
	}
}