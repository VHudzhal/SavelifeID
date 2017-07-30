<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\patient\models\PatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-xs-4">
        <div class="form-group">
          <?= \yii\bootstrap\Html::dropDownList('onlyBy', $model->onlyBy, [
            'email' => 'email',
            'internal_id' => 'internal_id',
            'internal_id_hash' => 'internal_id_hash',
            'stripe_subscription_id' => 'stripe_subscription_id',
            'stripe_customer' => 'stripe_customer',
            'cell_phone' => 'cell_phone'
          ], ['class' => 'js-filter-selection form-control']) ?>
        </div>
      </div>
      <div class="col-xs-6 fields-list">
	      <?= $form->field($model, 'internal_id', ['template' => '{input}']) ?>
	      <?= $form->field($model, 'internal_id_hash', ['template' => '{input}']) ?>
	      <?= $form->field($model, 'email', ['template' => '{input}']) ?>
	      <?= $form->field($model, 'cell_phone', ['template' => '{input}']) ?>
	      <?= $form->field($model, 'stripe_customer', ['template' => '{input}']) ?>
	      <?= $form->field($model, 'stripe_subscription_id', ['template' => '{input}']) ?>
      </div>
      <div class="col-xs-2">
        <div class="form-group">
	        <?= Html::submitButton('Fetch', ['class' => 'btn btn-default btn-block']) ?>
        </div>
      </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php

  $this->registerJs("
redraw_search_filter();  
$('.js-filter-selection').on('change', redraw_search_filter);

function redraw_search_filter(){
  $('.fields-list .form-group').hide();
  $('.field-patientsearch-'+$('.js-filter-selection').val()).show();
  $('.fields-list input').not(':visible').val('');
}
");
