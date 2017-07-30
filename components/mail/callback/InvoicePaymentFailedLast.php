<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 13:48
 */

namespace app\components\mail\callback;


use app\modules\patient\models\Patient;
use yii\helpers\Html;

class InvoicePaymentFailedLast extends prototype {

	protected function _run(){
		$patient = Patient::findOne(['patients_id' => $this->_model->patients_id]);
		if ($patient){
			echo("Patient exist. Setting status to 'cancel'.");
			$patient->status = Patient::STATUS_CANCEL;
			if (!$patient->save()){
				echo(strip_tags(Html::errorSummary($patient)));
			}
		} else {
			echo("Patient with id = {$this->_model->patients_id} absent in database.");
		}
	}
}