<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\patient\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h1><?= Html::encode('Query users') ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $searchModel->onlyBy = $searchModel->onlyBy?$searchModel->onlyBy:'internal_id' ?>

    <?= GridView::widget([
        'emptyText' => '<div class="red">No matching user.</div>',
        'dataProvider' => $dataProvider,
        'columns' => [
            'name' => [
              'label' => 'Name',
              'value' => function ($model) {
                return $model->last_name.' '.$model->first_name;
              },
              'attribute' => 'last_name',
            ],
	        $searchModel->onlyBy,
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}'
            ],
        ],
    ]); ?>
</div>
