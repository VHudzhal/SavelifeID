<?php

namespace app\modules\admin\controllers;

use app\modules\patient\models\Log\SupportSessionLog;
use Yii;
use app\modules\patient\models\Patient;
use app\modules\patient\models\PatientSearch;
use app\modules\admin\components\Controller;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * QueryUserController implements the CRUD actions for Patient model.
 */
class QueryUserController extends Controller
{
    /**
     * Lists all Patient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatientSearch();
        $searchModel->onlyBy = Yii::$app->request->get('onlyBy', false);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Patient model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	    $model = $this->findModel($id);
	    $tokenProvider = new ArrayDataProvider([
		    'allModels' => $model->tokens,
		    'pagination' => [
			    'pageSize' => 100,
		    ],
	    ]);

        return $this->render('view', [
            'model' => $model,
	        'tokenProvider' => $tokenProvider
        ]);
    }

    public function actionSupportRequestStatus($id){
    	if (Yii::$app->request->isAjax){
		    $model = $this->findModel($id);
		    if ($model){
		    	$ret = ['status' => 0];
			    if ($model->support_request == 1){
			    	$ret['status'] = 1;
			    }
			    Yii::$app->response->format = Response::FORMAT_JSON;
			    return $ret;
		    }
	    }
	    return '';
    }

    public function actionQuery($id){
	    $model = $this->findModel($id);
	    if ($model){
	    	$model->support_request = 0;
	    	if (!$model->save()) {
	    		throw new HttpException(500, strip_tags(Html::errorSummary($model)));
		    }
		    (new SupportSessionLog(['result' => false, 'patient_id' => $model->patients_id]))->save();

	    } else {
		    \Yii::$app->session->setFlash('error', 'No user founded...');
	    }
	    return $this->redirect(['view', 'id' => $id]);
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
