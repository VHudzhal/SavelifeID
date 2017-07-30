<?php

namespace app\controllers;

use app\modules\patient\components\Patient;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class AjaxController extends \app\components\AjaxController
{
	public function actionCountdown(){
		if (Yii::$app->patient->isGuest) {
			$this->setResponse('until', 0);
			$this->setResponse('percent', 0);
			$this->setResponse('text', '');
		} else {
			$duration = Yii::$app->patient->getSessionTime();
			$this->setResponse('until', $duration);
			$this->setResponse('percent', round(100*$duration/Patient::AUTH_TIMEOUT));

			if ($duration > 60) {
				$duration = 60 * ceil($duration / 60);
			}
			$time = time()-$duration;
			$this->setResponse('text', Yii::$app->formatter->asRelativeTime(time(), $time));
		}

		$this->setResult(true);
		return $this->response;
	}
}
