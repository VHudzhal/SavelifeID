<?php

namespace app\modules\patient\models\Log;

use app\modules\patient\models\Log;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.03.17
 * Time: 13:23
 */
class ProfileCategoryVisibilityLog extends LogPrototype {
	public $type = Log::TYPE_PROFILE_CATEGORY_VISIBILITY_CHANGE;
	public $old;
	public $new;

	public $changes = [];
	public $attributes = [
		'by_default'        => 'display_by_default',
		'emergency_summary' => 'display_emergency_summary',
		'allergies'         => 'display_allergies',
		'conditions'        => 'display_conditions',
		'medications'       => 'display_medications',
		'vaccinations'      => 'display_vaccinations',
		'hospital'          => 'display_hospital',
		'insurance'         => 'display_insurance',
		'medical_history'   => 'display_medical_history',
		'procedures'        => 'display_procedures',
		'physician'         => 'display_physician',
		'advance_directives'=> 'display_advance_directives',
		'ekg'               => 'display_ekg',
		'other_documents'   => 'display_other_documents',
	];

	protected $aggregate = false;



	public function save() {
		$this->loadChanges();
		foreach ($this->attributes as $key => $attribute){
			if ($this->old[$attribute] != $this->new[$attribute]){
				$sign = ($this->new[$attribute])?"+":"-";
				if (isset($this->changes[$key]) && $this->changes[$key] != $sign){
					unset($this->changes[$key]);
				} else {
					$this->changes[$key] = $sign;
				}
			}
		}

		if ($this->changes) {
			foreach ($this->changes as $key => $sign){
				$model = new \app\modules\patient\models\Log();
				$model->setAttributes($this->model->attributes);
				$model->log_content = $sign.$key;

				$date_utc = new \DateTime(null, new \DateTimeZone("UTC"));
				$model->log_updated = $date_utc->format(\DateTime::W3C);

				if (\Yii::$app->request->isConsoleRequest){
					$model->ip_address  = '127.0.0.1';
				} else {
					$model->ip_address  = \Yii::$app->request->userIP;
				}
				if (!$model->save()){
					throw new \Exception('Save log error: ' . Html::errorSummary($this->model), 500);
				}
			}
		}
		return true;
	}
}