<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\modules\patient\models\Patient */
/* @var $form ActiveForm */
/* @var $message string */

$this->title = 'Current Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($message){ ?>
       <div class="alert alert-success"><?= $message ?></div>
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'email:email',
            'name' => [
	            'label' => 'Name',
	            'value' => function ($model) {
		            return $model->last_name.' '.$model->first_name;
	            },
	            'attribute' => 'last_name',
	          ],
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{delete}',
              'buttons' => [
                'delete' => function ($url, $model) {
                    /** @var $model \app\modules\patient\models\Patient */
                    if ($model->patients_id !== Yii::$app->patient->patients_id) {
	                    return Html::a('Remove', $url, [
		                    'title' => 'Remove',
		                    'class' => 'btn btn-default btn-xs',
		                    'data-confirm' => 'Are you sure you want to remove the user\'s administrative privileges?',
		                    'data-method' => 'post',
	                    ]);
                    } else {
                      return '';
                    }
                  }
               ]
            ],
        ],
    ]); ?>

	<?php $form = ActiveForm::begin(); ?>
    <div class='form-group'>
	    <?= \yii\helpers\Html::errorSummary($model, ['class' => 'alert alert-danger', 'header' => '']); ?>
  	  <?= $form->field($model, 'email', ['template' => "<div class='input-group'>{input}<div class='input-group-btn'><button  type='button' class='btn btn-default btn-forgot' tabindex='999'>Add admin user</button></div></div>"])->textInput(['placeholder' => 'E-mail']) ?>
    </div>
	<?php ActiveForm::end(); ?>

</div>
