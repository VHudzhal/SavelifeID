<?php
/**
 * Base Controller for patient module
 */
namespace app\modules\patient\components;


class Controller extends \app\components\Controller {
	public $publicActions = [];
	public $notActivatedActions = ['activate-complete-registration', 'complete-registration'];

	public function beforeAction($action) {
		if (parent::beforeAction($action)) {
			if (!in_array($action->id, $this->publicActions)){
				if (\Yii::$app->patient->isGuest) {
					\Yii::$app->patient->redirectToLogin();
					return false;
				}
				if (!\Yii::$app->patient->isActivated && !in_array($action->id, $this->notActivatedActions) && !\Yii::$app->request->isAjax) {
					$this->redirect('/activate-complete-registration');
					return false;
				}
			}
			return true;
		} else {
			return false;
		}
	}
}