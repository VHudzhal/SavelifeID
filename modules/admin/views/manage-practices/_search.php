<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\patient\models\PracticesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="practices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'practice_id') ?>

    <?= $form->field($model, 'practice_name') ?>

    <?= $form->field($model, 'practice_umr_id') ?>

    <?= $form->field($model, 'auth_user') ?>

    <?= $form->field($model, 'auth_pass') ?>

    <?php // echo $form->field($model, 'enrollment_code') ?>

    <?php // echo $form->field($model, 'partner_id') ?>

    <?php // echo $form->field($model, 'demo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
