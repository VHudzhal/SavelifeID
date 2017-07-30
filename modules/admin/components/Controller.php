<?php

namespace app\modules\admin\components;

use app\models\Maintenance;
use Yii;
use app\modules\patient\models\Patient;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\components\Controller as BaseController;

/**
 * UsersController implements the CRUD actions for Patient model.
 */
class Controller extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

	public function beforeAction( $action ) {
	    if (\Yii::$app->patient->isGuest || !\Yii::$app->patient->is_admin){
		    if (!Yii::$app->isMaintenance && !Maintenance::isActiveAny()) {
			    \Yii::$app->guestSession->set('loginUrl', '/admin');
			    throw new HttpException(404, 'Page not found.');
		    } else {
			    if (!\Yii::$app->patient->isGuest && !\Yii::$app->patient->is_admin){
				    \Yii::$app->patient->logout();
				    $this->redirect('/admin');
			    }

			    if (!\Yii::$app->request->isPost){
			    	if ($action->id !== 'login') {
					    echo \Yii::$app->runAction('admin/default/login');
					    \Yii::$app->end();
				    } else {
//					    $this->redirect('/admin/login');
				    }
			    }
		    }
	    } else {
		    Yii::$app->isMaintenance = false;
	    }

		$this->view->title = 'Admin Interface';
		$result = parent::beforeAction( $action );
		$this->layout = '//admin';
		return $result;
	}
}
