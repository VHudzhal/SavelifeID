<?php
  /**
   * @var $this \yii\web\View
   * @var $model \app\modules\admin\models\SendMailForm
   */
?>

<h2>Test E-mail</h2>

		<?php if ($model->sended){ ?>
			<?php
			  $this->registerJs("
			  $(document).trigger('messageOk', {text: 'E-mail has been sent successfully'});
			  ");
			?>
		<?php } ?>

			<?php $form = \app\components\ActiveForm::begin([
				'id' => 'contact-form', /* Идентификатор формы */
				'type' => \app\components\ActiveForm::TYPE_HORIZONTAL,
			]); ?>

      <?= \yii\helpers\Html::errorSummary($model, ['class' => 'alert alert-danger', 'header' => '']); ?>

			<?= $form->field($model, 'from')->textInput(['readonly' => 'readonly']) ?>
			<?= $form->field($model, 'email')->textInput() ?>
			<?= $form->field($model, 'subject')->textInput() ?>

			<?= $form->field($model, 'body')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'clientOptions' => ['language' => 'en'],
        'preset' => 'basic'
      ]) ?>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<?= \yii\helpers\Html::submitButton('Send', ['class' => 'btn btn-primary form-control', 'name' => 'contact-button']) ?>
				</div>
			</div>

			<?php \app\components\ActiveForm::end(); ?>
        <p>&nbsp;</p>


