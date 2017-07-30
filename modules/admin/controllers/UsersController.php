<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\patient\models\Patient;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Patient model.
 */
class UsersController extends \app\modules\admin\components\Controller
{
	/**
     * Lists all Patient models.
     * @return mixed
     */
    public function actionIndex()
    {
	    $model = new Patient();
	    $message = '';

	    if ($model->load(Yii::$app->request->post())) {
		    $find = Patient::findOne(['email' => $model->email]);
		    if (!$find){
			    $model->addError('email', 'E-mail not found, could not add');
		    } else {
		    	if ($find->email){
				    $find->is_admin = 1;
				    if ($find->save()){
					    $model = new Patient();
					    $message = 'The user is granted administrative privileges';
				    } else {
					    $model->addError('email', strip_tags(Html::errorSummary($find)));
				    }
			    } else {
				    $model->addError('email', 'E-mail can not be empty');
			    }
		    }
	    }


        $dataProvider = new ActiveDataProvider([
            'query' => Patient::find()->where(['is_admin' => 1]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
	        'model' => $model,
	        'message' => $message
        ]);
    }

    /**
     * Deletes an existing Patient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_admin = 0;
        if (!$model->save()){
        	throw new HttpException(500, strip_tags(Html::errorSummary($model)));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Patient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
