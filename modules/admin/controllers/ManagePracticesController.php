<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\patient\models\Practices;
use app\modules\patient\models\PracticesSearch;
use app\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManagePracticesController implements the CRUD actions for Practices model.
 */
class ManagePracticesController extends Controller
{
    /**
     * Lists all Practices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PracticesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Practices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Practices();
        $model->fill();
	    $model->save();
	    $model->practice_umr_id = "NewUMRID_".$model->practice_id;
	    $model->auth_user = "auth_".$model->practice_id;
	    $model->save();
	    return $this->redirect(['index']);
    }

    /**
     * Updates an existing Practices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$this->layout = '//popup';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        return $this->render('@app/views/popup/close+reload');
        } else {
	        return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Practices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Practices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Practices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
