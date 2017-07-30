<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\patient\models\Practices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="practices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'practice_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'practice_umr_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enrollment_code')->textInput() ?>

    <?= $form->field($model, 'demo')->dropDownList(['0'=>'Off', '1'=>'On']) ?>

    <div class="form-group">
        <?= Html::submitButton('OK', ['class' => 'btn btn-success']) ?>
        <?= Html::button('Cancel', ['class' => 'btn btn-default js-close-popup']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

  $this->registerJs("
$('.js-close-popup').on('click', function(e){
  e.preventDefault();
  parent.$('.modal').modal('hide');
});
");
